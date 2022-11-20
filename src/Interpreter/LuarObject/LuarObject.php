<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use JsonSerializable;

interface LuarObject extends JsonSerializable {
	public function getValue();

	public function getType(): string;
}
