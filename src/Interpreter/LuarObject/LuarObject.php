<?php
namespace Raudius\Luar\Interpreter\LuarObject;


interface LuarObject  {
	public function getValue();

	public function getType(): string;
}
