<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarRuntimeException;
use Throwable;

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
	 * @throws LuarRuntimeException
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
		return $this->validateType($objectList->getObject($n), $types, $n + 1);
	}

	protected function validateType(LuarObject $object, array $types, int $argn): LuarObject {
		$objType = $object->getType();
		if (!in_array($objType, $types, true)) {
			$typesString = implode('|', $types);
			throw new LuarRuntimeException("Bad argument, in position #{$argn} expected $typesString, got $objType"); // TODO: replace with specialised BadArgument exception?
		}

		return $object;
	}

	public function __call($name, $arguments) {
		return Invokable::fromPhpCallable(function () use ($name) {
			throw new LuarRuntimeException("Unimplemented function in '{$this->getName()}' library: '$name'");
		});
	}

	protected function fromPhpFunction(string $function, int $nArgs=null): Invokable {
		return Invokable::fromPhpCallable(
			static function (...$args) use ($function, $nArgs) {
				if ($nArgs !== null) {
					$args = array_slice($args, 0, $nArgs);
				}
				try {
					$result = $function(...$args);
					if (is_float($result) && floor($result) === $result && $result < PHP_INT_MAX && $result > PHP_INT_MIN) {
						$result = (int) $result;
					}

					return $result;
				} catch (Throwable $t) {
					throw new LuarRuntimeException($t->getMessage());
				}
			}
		);
	}
}
