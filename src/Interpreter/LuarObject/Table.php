<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use JsonSerializable;
use Raudius\Luar\Interpreter\Scope;
use Raudius\Luar\Luar;

/**
 * This class represents the Lua table type inside the Luar interpreter.
 */
class Table extends Scope implements LuarObject, JsonSerializable  {
	private ?array $keyList = null;
	private ?int $length = null;
	private ?Table $metaTable = null;

	/**
	 * @return LuarObject[]
	 */
	public function getValue(): array {
		return $this->assigns;
	}

	/**
	 * Table instantiation from a PHP array.
	 *
	 * @param array $array
	 * @return static
	 */
	public static function fromArray(array $array): self {
		return new self(null, self::reindexAndObjectify($array));
	}

	/**
	 * Re-indexes a PHP array to a Lua array and converts all values to `LuarObject`s.
	 * The operation is also done for arrays inside the array.
	 *
	 * Returns the same array as a `1-indexed` array of LuarObjects.
	 *
	 * @param array $array
	 * @return array
	 */
	protected static function reindexAndObjectify(array $array): array {
		if (isset($array[0])) {
			array_unshift($array, null);
			unset($array[0]);
		}

		foreach ($array as $key => $item) {
			if (!$item instanceof LuarObject) {
				$item = Luar::packLuarObject($item);
			}

			$array[$key] = $item;
		}
		return $array;
	}

	/**
	 * Returns the value that comes after the specified key. If key is NULL, the first value is returned.
	 * @return LuarObject[] [key, value]
	 */
	public function next($key): array {
		$keyList = $this->getKeyList();

		if (isset($keyList[$key])) {
			$nextKey = $keyList[$key];
			return [new Literal($nextKey), $this->assigns[$nextKey]];
		}

		return [new Literal(null), new Literal(null)];
	}

	/**
	 * Returns the value for the given key.
	 *
	 * @param string $key
	 * @return LuarObject
	 */
	public function get(string $key): LuarObject {
		if ($this->has($key)) {
			return parent::get($key);
		}
		return $this->metaTable
			? $this->metaTable->get($key)
			: new Literal(null);
	}

	/**
	 * Adds a key/value to a table.
	 *
	 * @param string $key
	 * @param LuarObject $value
	 * @return void
	 */
	public function assign(string $key, LuarObject $value): void {
		parent::assign($key, $value);
		$this->keyList = null;
		$this->length = null;
	}

	/**
	 * Returns a linked list of the `assigns` array keys.
	 */
	private function getKeyList(): array {
		if ($this->keyList !== null) {
			return $this->keyList;
		}

		$this->keyList = [];
		$prevKey = null;
		foreach ($this->assigns as $k => $_) {
			$this->keyList[$prevKey] = $k;
			$prevKey = $k;
		}

		return $this->keyList;
	}

	public function getType(): string {
		return 'table';
	}

	/**
	 * Returns the length of the table. This is the length as defined by Lua:
	 * https://www.lua.org/manual/5.3/manual.html#3.4.7
	 *
	 * @return int
	 */
	public function getLength(): int {
		if ($this->length !== null) {
			return $this->length;
		}

		$this->length = 0;
		while ($this->has($this->length + 1)) { $this->length++; }
		return $this->length;
	}

	public function __toString() {
		return sprintf('%s: 0x%06x', $this->getType(), spl_object_id($this));
	}

	/**
	 * Sets the meta-table for this object.
	 * See Lua documentation for more information on meta-tables.
	 * https://www.lua.org/manual/5.3/manual.html#pdf-setmetatable
	 *
	 * @param Table|null $table
	 * @return void
	 */
	public function setMetaTable(?Table $table): void {
		$this->metaTable = $table;
	}

	/**
	 * Returns the meta table for this table. If none, returns a `nil` literal `LuaObject`
	 * See: https://www.lua.org/manual/5.3/manual.html#pdf-getmetatable
	 *
	 * @return LuarObject
	 */
	public function getMetaTable(): LuarObject {
		return $this->metaTable ?: new Literal(null);
	}

	/**
	 * Converts the table to a JSON-serializable array.
	 *
	 * @return array
	 */
	public function jsonSerialize(): array {
		return Luar::unpackLuarObject($this);
	}
}
