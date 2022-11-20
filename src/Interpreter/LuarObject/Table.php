<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\Scope;
use Raudius\Luar\Luar;

class Table extends Scope implements LuarObject  {
	private ?array $keyList = null;
	private ?int $length = null;
	private ?Table $metaTable = null;

	public function getValue(): array {
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
				$item = Luar::makeLuarObject($item);
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

	public function get(string $key): LuarObject {
		if ($this->has($key)) {
			return parent::get($key);
		}
		return $this->metaTable
			? $this->metaTable->get($key)
			: new Literal(null);
	}

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

	public function setMetaTable(?Table $table): void {
		$this->metaTable = $table;
	}

	public function getMetaTable(): LuarObject {
		return $this->metaTable ?: new Literal(null);
	}
}
