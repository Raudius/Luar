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

	/**
	 * @param LuarObject[] $args
	 */
	public function invoke(array $args): LuarObject {
		$argValues = [];
		foreach ($args as $arg) {
			$argValues[] = $arg->getValue();
		}

		// TODO: revisit returning values
		$result = ($this->value)(...$argValues);

		if ($result instanceof LuarObject) {
			// TODO: verify whether this is a possible outcome
			// 	Might be the case with injected functions.???
			throw new RuntimeException("Does this ever happen?");
			return $result;
		}

		if ($result instanceof Scope) {
			return $result->getReturn();
		}

		if (is_array($result)) {
			return new Table(null, $result);
		}

		return new Literal($result);
	}


	public function __toString(): string{
		return 'Function';
	}
}
