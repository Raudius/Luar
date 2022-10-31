<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarObject\Table;
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


	public function asInvokable(Interpreter $interpreter): Invokable {
		$parameterNames = $this->parameterNames;

		$function = function (...$args) use ($interpreter, $parameterNames) {
			$scope = $interpreter->getScope();
			$isVariadic = end($this->parameterNames) === '...';
			$isVariadic && array_pop($parameterNames);


			$extraParams = [];
			$argc = count($args);
			for ($i=0; $i<$argc; $i++) {
				if (isset($parameterNames[$i])) {
					$scope->assign($parameterNames[$i], new Literal($args[$i]));
				} elseif (is_array($args[$i])) {
					$extraParams = [...$extraParams, ...$args[$i]];
				} else {
					$extraParams[] = $args[$i];
				}
			}

			if ($isVariadic) {
				$scope->assign(Reference::VAR_INTERNAL_ELIPSIS, Table::fromArray($extraParams));
			}

			$newScope = new Scope();
			$newScope->setExpectedExit(Scope::EXIT_EXPECT_RETURN);
			return (new LuarStatementVisitor($interpreter))->visitBlock($this->block, $newScope);
		};

		return new Invokable($function);
	}
}
