<?php
namespace Raudius\Luar\Interpreter\LuarObject;

/**
 * The literal is the most basic Luar object, it is used for encapsulating "primitive" values such as strings, booleans, numbers and `NULL`.
 *
 * May be used for encapsulating other types (such as objects) but this use is generally not encouraged. Instead, consider serializing your object as a `Table`.
 */
class Literal implements LuarObject {
	private $value;

	/**
	 * @param $value - The value to be stored in the literal.
	 */
	public function __construct($value) {
		$this->value = $value;
	}

	/**
	 * Always returns the value as provided in the constructor.
	 *
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @inheritDoc
	 */
	public function __toString(): string{
		if (is_bool($this->value)) {
			return $this->getValue() ? 'true' : 'false';
		}
		if ($this->value === null) {
			return $this->value ?? "nil";
		}

		return (string) $this->value;
	}

	/**
	 * @inheritDoc
	 */
	public function getType(): string {
		$phpType = gettype($this->value);
		switch ($phpType) {
			case 'NULL': return 'nil';
			case 'double':
			case 'integer': return 'number';
		}

		return $phpType;
	}
}
