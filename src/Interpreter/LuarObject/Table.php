<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\Scope;

class Table extends Scope implements LuarObject  {

	public function getValue() {
		return $this->assigns;
	}

	public static function fromArray(array $array): self {
		return new self(null, self::reindexAndObjectify($array));
	}

	/**
	 * Reindexes a PHP array to a Lua array.
	 * // TODO: Move this function somewhere else?
	 */
	protected static function reindexAndObjectify(array $array): array {
		if (isset($array[0])) {
			array_unshift($array, null);
			unset($array[0]);
		}

		foreach ($array as $key => $item) {
			if (!$item instanceof LuarObject) {
				$item = self::objectify($item);
			}

			$array[$key] = $item;
		}

		return $array;
	}

	/**
	 * TODO: move this function elswehere
	 */
	private static function objectify($item): LuarObject {
		if (is_array($item)) {
			return self::fromArray($item);
		}

		if (is_callable($item)) {
			return new Invokable($item);
		}

		return new Literal($item);
	}

	public function getType(): string {
		return 'table';
	}

	public function __toString() {
		return sprintf('%s: 0x%06x', $this->getType(), spl_object_id($this));
	}
}
