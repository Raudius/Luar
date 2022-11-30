<?php
namespace Raudius\Luar\Interpreter\LuarObject;

/**
 * Luar-objects are how variables and expression results are stored in the Luar interpreter.
 * Variables assigned via `Luar::assign` are also converted to `LuarObjects`.
 *
 * PHP values may be converted to and from `LuarObjects` via `Luar::packLuarObject` and `Luar::unpackLuarObject`.
 */
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
