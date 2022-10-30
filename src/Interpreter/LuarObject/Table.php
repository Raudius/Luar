<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\Scope;

class Table extends Scope implements LuarObject  {
	public function getValue() {
		return $this->assigns;
	}

	public function __toString() {
		return json_encode($this->__debugInfo()) ?: 'Table';
	}
}
