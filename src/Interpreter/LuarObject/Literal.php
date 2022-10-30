<?php
namespace Raudius\Luar\Interpreter\LuarObject;

class Literal implements LuarObject {
	private $value;

	public function __construct($value) {
		$this->value = $value;
	}

	public function getValue() {
		return $this->value;
	}

	public function __toString(): string{
		if (is_bool($this->value)) {
			return $this->getValue() ? 'TRUE' : 'FALSE';
		}
		if ($this->value === null) {
			return $this->value ?? "nil";
		}

		return (string) $this->value;
	}
}
