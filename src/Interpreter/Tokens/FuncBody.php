<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
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
				if (isset($parameters[$i])) {
					$arg = is_array($args[$i]) ? $args[$i][0] : $args[$i]; // todo fix list argument

					$scope->assign($parameterNames[$i], $arg);
				} elseif (is_array($args[$i])) {
					$extraParams = [...$extraParams, ...$args[$i]];
				} else {
					$extraParams[] = $args[$i];
				}
			}

			if ($isVariadic) {
				$scope->assign('arg', new Table(null, $extraParams));
			}

			// TODO: interpreter -> visit()?
			return (new LuarStatementVisitor($interpreter))->visitBlock($this->block, Scope::EXIT_EXPECT_RETURN);
		};

		return new Invokable($function);
	}
}
