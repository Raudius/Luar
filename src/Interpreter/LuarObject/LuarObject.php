<?php
namespace Raudius\Luar\Interpreter\LuarObject;


interface LuarObject  {
	/**
	 * Returns the value held by the object.
	 * @return mixed
	 */
	public function getValue();

	/**
	 * Returns the type of the object.
	 * @return string
	 */
	public function getType(): string;
}
