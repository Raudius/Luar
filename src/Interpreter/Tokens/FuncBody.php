<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\LuarStatementVisitor;
use Raudius\Luar\Interpreter\Scope;
use Raudius\Luar\Luar;
use Raudius\Luar\Parser\Context\BlockContext;

class FuncBody {
	public array $parameterNames;
	public BlockContext $block;

	public function __construct(array $parameterNames, BlockContext $blockCallback) {
		$this->parameterNames = $parameterNames;
		$this->block = $blockCallback;
	}


	public function asInvokable(Interpreter $interpreter): Invokable {
		$parameterNames = $this->parameterNames;
		$parentScope = $interpreter->getScope();

		$function = function (...$args) use ($interpreter, $parentScope, $parameterNames) {
			$currentScope = $interpreter->getScope();

			$scope = new Scope($parentScope);
			$scope->setExpectedExit(Scope::EXIT_EXPECT_RETURN);

			$isVariadic = end($this->parameterNames) === '...';
			$isVariadic && array_pop($parameterNames);

			$extraParams = [];
			$argc = count($args);
			for ($i=0; $i<$argc; $i++) {
				if (isset($parameterNames[$i])) {
					$scope->assign($parameterNames[$i], Luar::makeLuarObject($args[$i]));
				} elseif (is_array($args[$i])) {
					$extraParams = [...$extraParams, ...$args[$i]];
				} else {
					$extraParams[] = $args[$i];
				}
			}

			if ($isVariadic) {
				$scope->assign(Reference::VAR_INTERNAL_ELIPSIS, Table::fromArray($extraParams));
			}
			$return = (new LuarStatementVisitor($interpreter))->visitBlock($this->block, $scope);
			$interpreter->setScope($currentScope);

			return $return->getReturn();
		};

		return new Invokable($function);
	}
}
