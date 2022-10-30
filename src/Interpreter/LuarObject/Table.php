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

	public static function fromArray(array $array): self {
		return new self(null, self::reindex($array));
	}

	/**
	 * Reindexes a PHP array to a Lua array.
	 * // TODO: Move this function somewhere else?
	 */
	protected static function reindex(array $array): array {
		if (isset($array[0])) {
			array_unshift($array, null);
			unset($array[0]);
		}

		foreach ($array as $key => $item) {
			if (is_array($item)) {
				$item = self::reindex($item);
			}

			$array[$key] = $item;
		}

		return $array;
	}
}
