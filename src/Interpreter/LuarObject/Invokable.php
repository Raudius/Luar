<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\RuntimeException;
use Raudius\Luar\Interpreter\Scope;

class Invokable implements LuarObject {
	/** @var callable $value */
	private $value;

	/**
	 * @param callable $function
	 */
	public function __construct(callable $function) {
		$this->value = $function;
	}

	public function getValue() {
		return $this->value;
	}

	public function invoke(ObjectList $args): ObjectList {
		$argValues = [];
		foreach ($args->getObjects() as $arg) {
			$argValues[] = $arg->getValue();
		}

		$result = ($this->value)(...$argValues);

		if ($result instanceof Scope) { // TODO instanceof Table?
			$result = $result->getReturn();
		}

		if ($result instanceof ObjectList) {
			return $result;
		}

		if (is_array($result)) {
			return new ObjectList( [new Table(null, $result)] );
		}

		if (is_callable($result)) {
			return new ObjectList( [new Invokable($result)] );
		}

		return new ObjectList( [new Literal($result)] );
	}


	public function __toString(): string{
		return 'Function';
	}
}
