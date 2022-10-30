<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\LuarStatementVisitor;
use Raudius\Luar\Parser\Context\BlockContext;

class NameAndArgs {
	public ?string $name;
	/** @var LuarObject[] */
	public array $args;

	public function __construct(array $args, ?string $name) {
		$this->name = $name;
		$this->args = $args;
	}

}
