<?php
namespace Raudius\Luar\Interpreter;

use Antlr\Antlr4\Runtime\RuleContext;
use Antlr\Antlr4\Runtime\Tree\RuleNode;
use Antlr\Antlr4\Runtime\Tree\TerminalNode;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarObject\Table;
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
		$this->interpreter->pushScope($scopeToPush);

		parent::visitBlock($context);

		return $this->interpreter->popScope();
	}

	protected function visitExp(Context\ExpContext $context, Scope $scope = null): LuarObject {
		$scope && $this->interpreter->pushScope($scope);

		$result = $this->visit($context);

		$scope && $this->interpreter->popScope();

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

	public function visitVarlist(Context\VarlistContext $context, bool $declareLocal = false): array {
		$variableContexts = $context->variable();
		$variableContexts = is_array($variableContexts) ? $variableContexts : [$variableContexts];

		/** @var Reference[] $variables */
		$variables =  array_map(
			function (Context\VariableContext $context) use ($declareLocal) {
				if ($context instanceof Context\NameVariableContext) {
					return $this->visitNameVariable($context, $declareLocal);
				}

				return $this->visit($context);
			},
			$variableContexts
		);
		return $variables;
	}

	public function visitNameVariable(Context\NameVariableContext $context, ?bool $declareLocal = false): LuarObject {
		$name = $context->NAME() ? $context->NAME()->getText() : null;
		if (!$name) {
			throw new RuntimeException('[ERROR INTERNAL] Unknown name variable declaration.', $context);
		}


		if ($name === Reference::VAR_INTERNAL_GLOBAL) {
			$reference = new Table(null, $this->interpreter->getRoot()->getAssigns());
		} else {
			$scope = $this->interpreter->getScope();
			$scope = $declareLocal ? $scope : $scope->getScope($name);
			$reference = new Reference($scope, $name);
		}

		$varSuffixes = $context->varSuffix() ?: [];
		$varSuffixes = is_array($varSuffixes) ? $varSuffixes : [$varSuffixes];

		return $this->applyVarSuffixes($reference, array_map([$this, 'visitVarSuffix'], $varSuffixes));
	}

	public function visitExpVariable(Context\ExpVariableContext $context): LuarObject {
		$expContext = $context->exp();
		if (!$expContext) {
			throw new RuntimeException('[ERROR INTERNAL] Unknown expression variable declaration.', $context);
		}

		$object = $this->visitExp($expContext);
		if (!$object instanceof Scope) {
			throw new RuntimeException('Cannot get properties of non-scopable expression.', $context);
		}


		$varSuffixes = $context->varSuffix() ?: [];
		$varSuffixes = is_array($varSuffixes) ? $varSuffixes : [$varSuffixes];
		return $this->applyVarSuffixes($object, array_map([$this, 'visitVarSuffix'], $varSuffixes));
	}

	/**
	 * @param Reference|Scope $variable
	 * @param VarSuffix[] $suffixes
	 */
	protected function applyVarSuffixes($variable, array $suffixes): LuarObject {
		foreach ($suffixes as $suffix) {
			$obj = $this->applyNameAndArgs($variable, $suffix->nameAndArgs);
			if ($obj instanceof ObjectList) {
				$obj = $obj->getObject(0);
			}

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

	public function visitArgs(Context\ArgsContext $context): ObjectList {
		if ($explist = $context->explist()) {
			return $this->visitExplist($explist);
		}

		return new ObjectList([]);
		// TODO fix table / single arguments
		throw new RuntimeException('[UNIMPLEMENTED] Function calls only possible as expression list');
	}

	/**
	 * @param Scope|LuarObject|null $object
	 * @param Context\NameAndArgsContext[] $nameAndArgsContexts
	 * @return LuarObject
	 */
	public function applyNameAndArgs($object, array $nameAndArgsContexts): LuarObject {
		$oo = $object;
		foreach ($nameAndArgsContexts as $nameAndArgsContext) {
			$nameAndArgs = $this->visitNameAndArgs($nameAndArgsContext);

			if ($nameAndArgs->name) {
				// FIXME: prevent calling getObject x2 (here + in callMethod)
				if (!$object instanceof Reference || !($object->getObject()) instanceof Scope) {
					throw new RuntimeException("Attempted to call method ({$nameAndArgs->name}) on non-object", $nameAndArgsContext);
				}
				$object = $object->callMethod($nameAndArgs->name, $nameAndArgs->args);
			} else {
				if ($object instanceof Reference) {
					$object = $object->getObject();
				}

				// TODO: check this (dereferencing return list during chained function calls)
				if ($object instanceof ObjectList) {
					$object = $object->getObject();
				}
				if (!$object instanceof Invokable) {
					throw new RuntimeException('Attempted to call a non-function' . get_class($oo) . $oo->getKey(), $nameAndArgsContext);
				}

				$object = $object->invoke($nameAndArgs->args);
			}
		}

		return $object;
	}

	public function visitVarOrExp(Context\VarOrExpContext $context): LuarObject {
		if ($var = $context->variable()) {
			$varOrExp = $this->visit($var);
			if ($varOrExp instanceof LuarObject) {
				return $varOrExp;
			}
		}

		if ($exp = $context->exp()) {
			return $this->visitExp($exp);
		}

		throw new RuntimeException('Variable or expression could not be evaluated.', $context);
	}

	public function shouldVisitNextChild(RuleNode $node, $currentResult): bool {
		return $this->interpreter->getScope()->getExit() === null;
	}

	public function visitFunctioncall(Context\FunctioncallContext $context) {
		return $this->evalArgumentedExp($context->varOrExp(), $context->nameAndArgs());
	}

	/**
	 * @param Context\NameAndArgsContext|Context\NameAndArgsContext[]|null $nameAndArgsContexts
	 */
	public function evalArgumentedExp(Context\VarOrExpContext $varOrExpContext, $nameAndArgsContexts): LuarObject {
		$varOrExp = $this->visitVarOrExp($varOrExpContext);

		if (!$nameAndArgsContexts) {
			return $varOrExp;
		}

		$nameAndArgsContexts = is_array($nameAndArgsContexts) ? $nameAndArgsContexts : [$nameAndArgsContexts];
		return $this->applyNameAndArgs($varOrExp, $nameAndArgsContexts);
	}
}
