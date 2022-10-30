<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\LuarStatementVisitor;
use Raudius\Luar\Parser\Context\BlockContext;

class VarSuffix {
	/** @var NameAndArgs[] */
	public array $nameAndArgs;
	public string $suffix;

	public function __construct(array $nameAndArgs, string $suffix) {
		$this->nameAndArgs = $nameAndArgs;
		$this->suffix = $suffix;
	}
}
