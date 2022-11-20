<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\Interpreter;

interface LuarObject {
	public function getValue();

	public function getType(): string;
}
