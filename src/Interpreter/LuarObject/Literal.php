<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\LuarRuntimeException;

class Literal implements LuarObject {
	private $value;

	public function __construct($value) {
		if ($value instanceof LuarObject) {
			throw new LuarRuntimeException('[INTERNAL ERROR] Literal value cannot be an object');
		}

		$this->value = $value;
	}

	public function getValue() {
		return $this->value;
	}

	public function __toString(): string{
		if (is_bool($this->value)) {
			return $this->getValue() ? 'true' : 'false';
		}
		if ($this->value === null) {
			return $this->value ?? "nil";
		}

		return (string) $this->value;
	}

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
