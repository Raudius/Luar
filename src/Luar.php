<?php
namespace Raudius\Luar;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarException;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\Table;

class Luar {
	private Interpreter $interpreter;

	public function __construct() {
		$this->interpreter = new Interpreter();
	}

	public function eval(string $program): void {
		$this->interpreter->eval($program);
	}

	public function assign(string $name, $value): void {
		if (is_array($value)) {
			$object = Table::fromArray($value);
		} elseif(is_callable($value)) {
			$object = new Invokable($value);
		} else {
			$object = new Literal($value);
		}

		$this->interpreter->getRoot()->assign($name, $object);
	}

	public function call(string $name, array $args) {
		$invokable = $this->interpreter->getRoot()->get($name);
		if (!$invokable instanceof Invokable) {
			throw new LuarException('Could not call non-invokable object');
		}

		$invokable->invoke($args);
	}
}
