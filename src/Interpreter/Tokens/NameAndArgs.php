<?php
namespace Raudius\Luar\Interpreter\Tokens;

use Raudius\Luar\Interpreter\LuarObject\ObjectList;

class NameAndArgs {
	public ?string $name;
	public ObjectList $args;

	public function __construct(ObjectList $args, ?string $name) {
		$this->name = $name;
		$this->args = $args;
	}

}
