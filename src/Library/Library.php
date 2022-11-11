<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
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

	protected function validateTypes(ObjectList $objectList, string $type, int $offset = 0): array {
		$objectList = $offset > 0 ? $objectList->slice($offset) : $objectList;
		$argn = 1 + $offset;

		$vals = [];
		foreach ($objectList->getObjects() as $object) {
			$value = $object->getValue();
			$this->validateType($value, $type, $argn++);

			$vals[] = $value;
		}
		return $vals;
	}

	protected function createIterator(array $array): Invokable {
		$prevK = null;
		$keys = [];
		foreach (array_keys($array) as $k) {
			$keys[$prevK] = $k;
			$prevK = $k;
		}

		return Invokable::fromPhpCallable(static function ($array, $idx = null) use ($keys) {
			$k = $keys[$idx] ?? null;
			$v = $k ? ($array[$k] ?? null) : null;

			return new ObjectList([new Literal($k), new Literal($v)]);
		});
	}

	protected function validateTypeN(ObjectList $objectList, string $type, int $n, bool $allowNull = false) {
		return $this->validateType($objectList->getObject($n)->getValue(), $type, $n, $allowNull);
	}

	protected function validateType($object, string $type, int $argn, bool $allowNull = false) {
		$objType = gettype($object);
		if ($objType !== $type && (!$allowNull || $objType !== 'NULL')) {
			throw new RuntimeException("Bad argument, in position #{$argn} expected $type, got $objType"); // TODO: replace with specialised BadArgument exception?
		}

		return $object;
	}

	public function __call($name, $arguments) {
		return Invokable::fromPhpCallable(function () use ($name) {
			throw new RuntimeException("Unimplemented function in '{$this->getName()}' library: '$name'");
		});
	}
}
