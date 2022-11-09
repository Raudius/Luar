<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarStatementVisitor;
use Raudius\Luar\Interpreter\Scope;
use Raudius\Luar\Parser\Context\BlockContext;

class FuncBody {
	public array $parameterNames;
	public BlockContext $block;

	public function __construct(array $parameterNames, BlockContext $blockCallback) {
		$this->parameterNames = $parameterNames;
		$this->block = $blockCallback;
	}


	public function asInvokable(Interpreter $interpreter, bool $isMethod = false): Invokable {
		$parameterNames = $this->parameterNames;
		$parentScope = $interpreter->getScope();

		if ($isMethod) {
			array_unshift($parameterNames, 'self');
		}

		$function = function (ObjectList $arglist) use ($interpreter, $parentScope, $parameterNames) {
			$currentScope = $interpreter->getScope();

			$scope = new Scope($parentScope);
			$scope->setExpectedExit(Scope::EXIT_EXPECT_RETURN);

			$isVariadic = end($parameterNames) === '...';
			$isVariadic && array_pop($parameterNames);

			$i = 0;
			foreach ($parameterNames as $parameterName) {
				$obj = $arglist->getObject($i++);
				$scope->assign($parameterName, $obj);
			}

			if ($isVariadic) {
				$slice = $arglist->slice($i);
				$scope->assign(Reference::VAR_INTERNAL_ELIPSIS, $slice);
			}
			$return = (new LuarStatementVisitor($interpreter))->visitBlock($this->block, $scope);
			$interpreter->setScope($currentScope);

			return $return->getReturn();
		};

		return new Invokable($function);
	}
}
