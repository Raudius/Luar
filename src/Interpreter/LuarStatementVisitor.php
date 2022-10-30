<?php
namespace Raudius\Luar\Interpreter;

use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\Tokens\FuncBody;
use Raudius\Luar\Interpreter\Tokens\FuncName;
use Raudius\Luar\Parser\Context;

class LuarStatementVisitor extends LuarExpressionVisitor {
	public function visitStatIf(Context\StatIfContext $context) {
		$conditions = $context->exp();
		$blocks = $context->block();
		if (!$conditions || !$blocks) {
			throw new RuntimeException('Could not parse if statement, missing condition or block.');
		}

		$conditions = is_array($conditions) ? $conditions : [$conditions];
		$blocks = is_array($blocks) ? $blocks : [$blocks];
		foreach ($conditions as $i => $condition) {
			if ($this->visitExp($condition)->getValue()) {
				return $this->visitBlock($blocks[$i]);
			}
		}

		// Else
		if (count($blocks) > count($conditions)) {
			return $this->visitBlock(end($blocks));
		}

		return null;
	}

	public function visitStatFunctionDeclare(Context\StatFunctionDeclareContext $context) {
		$funcName = $this->visitFuncname($context->funcname());
		$funcBody = $this->visitFuncbody($context->funcbody());

		$scope = $this->interpreter->getRoot()->gets($funcName->getChain());
		if (!$scope instanceof Scope) {
			throw new RuntimeException("Attempted to declare function in non-scopable context.", $context);
		}

		$scope->assign($funcName->getName(), $funcBody->asInvokable($this->interpreter));
	}

	public function visitStatLocalFunction(Context\StatLocalFunctionContext $context) {
		$name = $context->NAME()->getText();
		$funcBody = $this->visitFuncbody($context->funcbody());

		$this->interpreter->getScope()->assign($name, $funcBody->asInvokable($this->interpreter));
	}

	public function visitFuncname(Context\FuncnameContext $context): FuncName {
		$names = $this->getNameChain($context);

		$methodContext = $context->funcname_method();
		$method = $methodContext ? $methodContext->NAME()->getText() : null;

		return new FuncName($names, $method);
	}

	public function visitFuncbody(Context\FuncbodyContext $context) {
		$namelist = $context->parlist() ? $context->parlist()->namelist() : null;
		$parameters = $namelist ? $this->getNameChain($namelist) : [];

		if ($context->parlist() && $context->parlist()->elipsis()) {
			$parameters[] = '...';
		}

		return new FuncBody($parameters, $context->block());
	}

	public function visitStatAssign(Context\StatAssignContext $context) {
		$varlist = $this->visitVarlist($context->varlist(), $this->interpreter->getRoot());
		$explist = $this->visitExplist($context->explist());

		foreach ($varlist as $i => $var) {
			$exp = $explist[$i] ?? new Literal(null);
			$var->setValue($exp);
		}
	}

	public function visitStatLocalVariable(Context\StatLocalVariableContext $context) {
		$varlist = $this->visitVarlist($context->varlist());
		$explist = $this->visitExplist($context->explist());

		foreach ($varlist as $i => $var) {
			$exp = $explist[$i] ?? new Literal(null);
			$var->setValue($exp);
		}
	}

	public function visitStatFor(Context\StatForContext $context) {
		$name = $context->NAME()->getText();

		$expContexts = $context->exp();
		$expContexts = is_array($expContexts) ? $expContexts : [$expContexts];

		[$it, $end, $step] = array_map(
			function (Context\ExpContext $exp) {
				return $this->visitExp($exp)->getValue();
			}, $expContexts
		);

		if (!is_numeric($it)) {
			throw new RuntimeException('Numeric for loop: iterator initialisation must be numeric.', $context);
		}
		if ($end !== null && !is_numeric($end)) {
			throw new RuntimeException('Numeric for loop: second expression, "end", must be numeric (or nil).', $context);
		}
		if (($step !== null && !is_numeric($step)) || $step === 0) {
			throw new RuntimeException('Numeric for loop: third expression, "step", must be a non-zero number (or nil).', $context);
		}

		$checkMoreThan = $step < 0;
		while($checkMoreThan ? $it >= $end : $it <= $end) {
			$newScope = new Scope();
			$newScope->assign($name, new Literal($it));
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_BREAK_CONTINUE);

			$scope = $this->visitBlock($context->block(), $newScope);

			if ($scope->getExit() === Scope::EXIT_BREAK || $scope->getExit() === Scope::EXIT_RETURN) {
				break;
			}

			$it += $step;
		}
	}

	public function visitStatBreak(Context\StatBreakContext $context) {
		$this->interpreter->getScope()->setExit(Scope::EXIT_BREAK);
	}

	public function visitLaststat(Context\LaststatContext $context): Scope {
		$firstLetter = $context->getText()[0];
		$scope = $this->interpreter->getScope();

		switch ($firstLetter) {
			case 'r': // return
				$explist = $context->explist() ? $this->visitExplist($context->explist()) : null;
				$scope->setExit(Scope::EXIT_RETURN, $explist);
				break;
			case 'b': // break
				$scope->setExit(Scope::EXIT_BREAK);
				break;
			case 'c': // continue
				$scope->setExit(Scope::EXIT_CONTINUE);
				break;
		}

		return $scope;
	}

	public function visitStatWhile(Context\StatWhileContext $context) {
		$expContext = $context->exp();
		$blockContext = $context->block();

		if (!$expContext || !$blockContext) {
			throw new RuntimeException('[INTERNAL ERROR] Could not parse while loop', $context);
		}

		while ($this->visitExp($expContext)->getValue()) {
			$newScope = new Scope();
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_BREAK_CONTINUE);

			$scope = $this->visitBlock($blockContext, $newScope);

			if ($scope->getExit() === Scope::EXIT_BREAK || $scope->getExit() === Scope::EXIT_RETURN) {
				break;
			}
		}
	}

	public function visitStatRepeat(Context\StatRepeatContext $context) {
		$expContext = $context->exp();
		$blockContext = $context->block();

		if (!$expContext || !$blockContext) {
			throw new RuntimeException('[INTERNAL ERROR] Could not parse while loop', $context);
		}

		do {
			$newScope = new Scope();
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_BREAK_CONTINUE);

			$scope = $this->visitBlock($blockContext, $newScope);

			if ($scope->getExit() === Scope::EXIT_BREAK || $scope->getExit() === Scope::EXIT_RETURN) {
				break;
			}
		} while ($this->visitExp($expContext)->getValue());
	}
}