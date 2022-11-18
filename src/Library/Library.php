<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\RuntimeException;

abstract class Library {
	/**
	 * Returns an array of Invokable LuarObjects.
	 * Keys are the function names.
	 *
	 * @return Invokable[]
	 */
	abstract public function getFunctions(): array;

	/**
	 * Returns an array of arrays of Invokable LuarObjects.
	 * Keys are primitive object type.
	 *
	 * @return array
	 */
	abstract public function getMetaMethods(): array;

	abstract public function getName(): string;

	/**
	 * @return LuarObject[]
	 * @throws RuntimeException
	 */
	protected function validateTypes(ObjectList $objectList, array $types, int $offset = 0): array {
		$objectList = $offset > 0 ? $objectList->slice($offset) : $objectList;
		$argn = 1 + $offset;

		$vals = [];
		foreach ($objectList->getObjects() as $object) {
			$value = $object->getValue();
			$this->validateType($value, $types, $argn++);

			$vals[] = $value;
		}
		return $vals;
	}

	protected function validateTypeN(ObjectList $objectList, array $types, int $n): LuarObject {
		return $this->validateType($objectList->getObject($n), $types, $n);
	}

	protected function validateType(LuarObject $object, array $types, int $argn): LuarObject {
		$objType = $object->getType();
		if (in_array($object, $types, true)) {
			$typesString = implode('|', $types);
			throw new RuntimeException("Bad argument, in position #{$argn} expected $typesString, got $objType"); // TODO: replace with specialised BadArgument exception?
		}

		return $object;
	}

	public function __call($name, $arguments) {
		return Invokable::fromPhpCallable(function () use ($name) {
			throw new RuntimeException("Unimplemented function in '{$this->getName()}' library: '$name'");
		});
	}
}
