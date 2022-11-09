<?php
namespace Raudius\Luar\Interpreter;

use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
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

		$names = $funcName->getChain();
		$funcName->isMethod() && array_pop($names); // TODO maybe refactor this?

		$scope = $this->interpreter->getScope();
		foreach ($names as $name) {
			$scope = $scope->getScope($name);
			if ($scope->isRoot()) {
				break;
			}
		}

		if (isset($name) && $funcName->isMethod()) {
			$scope = $scope->get($name);
			if (!$scope instanceof Table) {
				throw new RuntimeException('Attempting to declare method on non-table variable.', $context);
			}
		}

		echo "\n\nDeclaring {$funcName->getName()}\n";
		var_dump($scope);

		$scope->assign($funcName->getName(), $funcBody->asInvokable($this->interpreter, $funcName->isMethod()));
	}

	public function visitStatLocalFunction(Context\StatLocalFunctionContext $context) {
		$name = $context->NAME()->getText();
		$funcBody = $this->visitFuncbody($context->funcbody());

		$this->interpreter->getScope()->assign($name, $funcBody->asInvokable($this->interpreter));
	}

	public function visitStatAssign(Context\StatAssignContext $context) {
		$varlist = $this->visitVarlist($context->varlist());
		$explist = $this->visitExplist($context->explist());

		foreach ($varlist as $i => $var) {
			$exp = $explist->getObject($i);
			$var->setValue($exp);
		}
	}

	public function visitStatLocalVariable(Context\StatLocalVariableContext $context) {
		$varlist = $this->visitVarlist($context->varlist(), true);
		$explist = $context->explist() ? $this->visitExplist($context->explist()) : new ObjectList([]);

		foreach ($varlist as $i => $var) {
			$exp = $explist->getObject($i);
			$var->setValue($exp);
		}
	}

	public function visitStatFor(Context\StatForContext $context) {
		$name = $context->NAME()->getText();

		$expContexts = $context->exp();
		$expContexts = is_array($expContexts) ? $expContexts : [$expContexts];

		$exps = array_map(
			function (Context\ExpContext $exp) {
				return $this->visitExp($exp)->getValue();
			}, $expContexts
		);

		[$it, $end, $step] = [$exps[0], $exps[1], $exps[2] ?? 1];

		if (!is_numeric($it)) {
			throw new RuntimeException('Numeric for loop: start expression must be numeric.', $context);
		}
		if (!is_numeric($end)) {
			throw new RuntimeException('Numeric for loop: end expression, must be numeric.', $context);
		}
		if (!is_numeric($step) || $step === 0) {
			throw new RuntimeException('Numeric for loop: step expression must be a non-zero number (or nil).', $context);
		}

		$checkMoreThan = $step < 0;
		while($checkMoreThan ? $it >= $end : $it <= $end) {
			$newScope = new Scope($this->interpreter->getScope());
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_BREAK_CONTINUE);
			$newScope->assign($name, new Literal($it));
			$scope = $this->visitBlock($context->block(), $newScope);

			if ($scope->getExit() === Scope::EXIT_BREAK || $scope->getExit() === Scope::EXIT_RETURN) {
				$scope->resetExit();
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
				$explist = $context->explist() ? $this->visitExplist($context->explist()) : new ObjectList();
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
			$newScope = new Scope($this->interpreter->getScope());
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_BREAK_CONTINUE);

			$scope = $this->visitBlock($blockContext, $newScope);

			if ($scope->getExit() === Scope::EXIT_BREAK || $scope->getExit() === Scope::EXIT_RETURN) {
				$scope->resetExit();
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
			$newScope = new Scope($this->interpreter->getScope());
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_BREAK_CONTINUE);
			$scope = $this->visitBlock($blockContext, $newScope);

			if ($scope->getExit() === Scope::EXIT_BREAK || $scope->getExit() === Scope::EXIT_RETURN) {
				$scope->resetExit();
				break;
			}
		} while (!$this->visitExp($expContext, $newScope)->getValue());

	}
}
