<?php
namespace Raudius\Luar\Interpreter\LuarObject;

class ObjectList implements LuarObject {
	/** @var LuarObject[] */
	private array $objects;

	/** @var null|LuarObject[] */
	private ?array $objectsFlattened = null;

	/**
	 * @param LuarObject[] $expressions
	 */
	public function __construct(array $expressions = []) {
		$this->objects = $expressions;
	}

	/**
	 * @return LuarObject[]
	 */
	public function getObjects(): array {
		if ($this->objectsFlattened !== null) {
			return $this->objectsFlattened;
		}

		$this->objectsFlattened = [];

		$lastKey = array_key_last($this->objects);
		foreach ($this->objects as $k => $object) {
			if ($object instanceof Reference) {
				$object = $object->getObject();
			}

			if ($object instanceof ObjectList) {
				if ($k === $lastKey) {
					$objects = $object->getObjects();

					$this->objectsFlattened = [...$this->objectsFlattened, ...$objects];
				} else {
					$this->objectsFlattened[] = $object->getObject();
				}
			} else {
				$this->objectsFlattened[] = $object;
			}
		}

		return $this->objectsFlattened;
	}

	/** **/
	//  TODO: list should return NULL see:
	//			function f()
	//			  return 1,2,3
	//			end
	//			--
	//			a = {x= f()}
	//			--
	//			local b  = f()
	//			--
	//			print(a[x])
	//			print(b)
	 /** **/
	public function getValue() {
		return $this->getObject(0)->getValue();
	}

	public function getObject(int $idx=0): LuarObject {
		$objects = $this->getObjects();
		return $objects[$idx] ?? new Literal(null);
	}

	/**
	 * Returns the "raw" object at the specified index.
	 * Raw object means that other ObjectLists contained in the ObjectList do not get expanded/flattened.
	 *
	 * Example:
	 * ```lua
	 * function foo(...)
	 *   return ..., 'foo', 'bar', ...
	 * end
	 *
	 * print(foo(1,2,3))
	 * ```
	 * In this example the raw objects would be:
	 * [ `0`=> `ObjectList<1,2,3>`, `1`=> `'foo'`, `3`=> `'bar'`, `4`=> `ObjectList<1,2,3>` ]
	 *
	 * While the expanded objets would correspond with the value printed by the snippet:
	 * [ `0`=> `1`, `1`=> `'foo'`, `3`=> `'bar'`, `4`=> `1`, `5`=> `2`, `6`=> `3` ]
	 * @param int $idx
	 * @return LuarObject
	 */
	public function getRawObject(int $idx=0): LuarObject {
		return $this->objects[$idx] ?? new Literal(null);
	}

	/**
	 * Slices the list, returning a sub-list.
	 *
	 * @param int $idx - Index where we want the sublist to start
	 * @param int|null $size - Size of the subindex (if null, will return all the items following the starting index)
	 * @return ObjectList
	 */
	public function slice(int $idx, ?int $size=null): ObjectList {
		$slice = [];
		$objects = $this->getObjects();

		$count = $size ?? count($objects);
		for (; $idx<$count; $idx++) {
			$slice[] = $objects[$idx];
		}

		return new ObjectList($slice);
	}

	/**
	 * @inheritDoc
	 */
	public function __toString(): string{
		return 'ObjectList';
	}

	/**
	 * @inheritDoc
	 */
	public function getType(): string {
		return $this->getObject(0)->getType();
	}

	/**
	 * @inheritDoc
	 */
	public function count(): int {
		return count($this->getObjects());
	}
}
