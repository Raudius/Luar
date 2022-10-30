<?php
namespace Raudius\Luar\Interpreter;

use Antlr\Antlr4\Runtime\RuleContext;
use Antlr\Antlr4\Runtime\Tree\RuleNode;
use Antlr\Antlr4\Runtime\Tree\TerminalNode;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\Tokens\FuncBody;
use Raudius\Luar\Interpreter\Tokens\FuncName;
use Raudius\Luar\Interpreter\Tokens\NameAndArgs;
use Raudius\Luar\Interpreter\Tokens\VarSuffix;
use Raudius\Luar\Parser\LuaBaseVisitor;
use Raudius\Luar\Parser\Context;

abstract class LuarBaseVisitor extends LuaBaseVisitor {
	protected Interpreter $interpreter;

	final public function __construct(Interpreter $interpreter) {
		$this->interpreter = $interpreter;
	}

	public function visitBlock(Context\BlockContext $context, Scope $scopeToPush = null): Scope {
		$scope = $this->interpreter->pushScope($scopeToPush);

		parent::visitBlock($context);

		$this->interpreter->popScope();
		return $scope;
	}

	protected function visitExp(Context\ExpContext $context): LuarObject {
		$result = $this->visit($context);

		if ($result instanceof LuarObject) {
			return $result;
		}

		throw new RuntimeException("Expression did not resolve to LuarObject.", $context);
	}

	public function visitFuncname(Context\FuncnameContext $context): FuncName {
		$names = $this->getNameChain($context);

		$methodContext = $context->funcname_method();
		$method = $methodContext ? $methodContext->NAME()->getText() : null;

		return new FuncName($names, $method);
	}

	public function visitFuncbody(Context\FuncbodyContext $context): FuncBody {
		$namelist = $context->parlist() ? $context->parlist()->namelist() : null;
		$parameters = $namelist ? $this->getNameChain($namelist) : [];

		if ($context->parlist() && $context->parlist()->elipsis()) {
			$parameters[] = '...';
		}

		return new FuncBody($parameters, $context->block());
	}

	/**
	 * @return string[]
	 */
	protected function getNameChain(RuleContext $context): array {
		if (!method_exists($context, 'NAME')) {
			return [];
		}

		$nameContexts = $context->NAME();
		if ($nameContexts instanceof TerminalNode) {
			return [$nameContexts->getText()];
		}

		$names = [];
		foreach ($nameContexts as $nameContext) {
			if (!$nameContext instanceof TerminalNode) {
				return [];
			}

			$names[] = $nameContext->getText();
		}

		return $names;
	}

	public function visitVarlist(Context\VarlistContext $context, Scope $scope = null): array {
		$variableContexts = $context->variable();
		$variableContexts = is_array($variableContexts) ? $variableContexts : [$variableContexts];

		/** @var Reference[] $variables */
		$variables =  array_map(
			function (Context\VariableContext $context) use ($scope) {
				if ($context instanceof Context\NameVariableContext) {
					return $this->visitNameVariable($context, $scope);
				}

				return $this->visit($context);
			},
			$variableContexts
		);
		return $variables;
	}

	public function visitNameVariable(Context\NameVariableContext $context, ?Scope $scope = null) {
		$nameContext = $context->NAME();
		if (!$nameContext) {
			throw new RuntimeException('[ERROR INTERNAL] Unknown name variable declaration.', $context);
		}

		$scope = $scope ?? $this->interpreter->getScope();

		$reference = new Reference($scope, $nameContext->getText());
		$varSuffixes = $context->varSuffix() ?: [];
		$varSuffixes = is_array($varSuffixes) ? $varSuffixes : [$varSuffixes];


		return $this->applyVarSuffixes($reference, array_map([$this, 'visitVarSuffix'], $varSuffixes));
	}

	public function visitExpVariable(Context\ExpVariableContext $context) {
		$expContext = $context->exp();
		if (!$expContext) {
			throw new RuntimeException('[ERROR INTERNAL] Unknown expression variable declaration.', $context);
		}

		$object = $this->visitExp($expContext);
		if (!$object instanceof Scope) {
			throw new RuntimeException('Cannot get properties of non-scopable expression.', $context);
		}

		return $this->applyVarSuffixes($object, $context->varSuffix());
	}

	/**
	 * @param Reference|Scope $variable
	 * @param VarSuffix[] $suffixes
	 */
	protected function applyVarSuffixes($variable, array $suffixes): Reference {
		foreach ($suffixes as $suffix) {
			$obj = $this->applyNameAndArgs($variable, $suffix->nameAndArgs);
			if (!$obj instanceof Reference && !$obj instanceof Scope) {
				throw new RuntimeException('Cannot get properties of non-scopable expression.');
			}

			$variable = new Reference(
				$obj,
				$suffix->suffix
			);
		}

		return $variable;
	}

	public function visitVarSuffix(Context\VarSuffixContext $context): VarSuffix {
		$suffix = $context->NAME() ? $context->NAME()->getText() : '';
		if ($exp = $context->exp()) {
			$suffix = $this->visitExp($exp)->getValue();
		}

		$nameAndArgsContexts = $context->nameAndArgs() ?: [];
		$nameAndArgsContexts = is_array($nameAndArgsContexts) ? $nameAndArgsContexts : [$nameAndArgsContexts];


		return new VarSuffix($nameAndArgsContexts, $suffix);
	}

	public function visitNameAndArgs(Context\NameAndArgsContext $context): NameAndArgs {
		$nameContext = $context->NAME();
		$name = $nameContext ? $nameContext->getText() : null;
		$args = $this->visitArgs($context->args());

		return new NameAndArgs($args, $name);
	}

	public function visitArgs(Context\ArgsContext $context) {
		if ($explist = $context->explist()) {
			return $this->visitExplist($explist);
		}

		return [];
		// TODO fix table / single arguments
		throw new RuntimeException('[UNIMPLEMENTED] Function calls only possible as expression list');
	}

	/**
	 * @param Scope|LuarObject|LuarObject[]|null $object
	 * @param Context\NameAndArgsContext[] $nameAndArgsContexts
	 * @return LuarObject
	 */
	public function applyNameAndArgs($object, array $nameAndArgsContexts): LuarObject {
		foreach ($nameAndArgsContexts as $nameAndArgsContext) {
			$nameAndArgs = $this->visitNameAndArgs($nameAndArgsContext);
			if ($nameAndArgs->name) {
				if (!$object instanceof Scope) {
					throw new RuntimeException("Attempted to call method ({$nameAndArgs->name}) on non-object", $nameAndArgsContext);
				}
				$object = $object->callMethod($nameAndArgs->name, $nameAndArgs->args);
			} else {
				if ($object instanceof Reference) {
					$object = $object->getObject();
				}

				if (!$object instanceof Invokable) {
					throw new RuntimeException('Attempted to call a non-function ' . get_class($object), $nameAndArgsContext);
				}

				$object = $object->invoke($nameAndArgs->args);
			}
		}

		return $object;
	}

	public function visitVarOrExp(Context\VarOrExpContext $context) {
		if ($var = $context->variable()) {
			$varOrExp = $this->visit($var);
			if ($varOrExp instanceof LuarObject) {
				return $varOrExp;
			}
		}

		if ($exp = $context->exp()) {
			return $this->visitExp($exp);
		}
		return null;
	}

	public function shouldVisitNextChild(RuleNode $node, $currentResult): bool {
		return $this->interpreter->getScope()->getExit() === null;
	}
}
