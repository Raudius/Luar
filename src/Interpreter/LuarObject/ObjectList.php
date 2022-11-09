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
	 * TODO: cache result?
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
		return $this->getObject()->getValue();
	}

	public function getObject(int $idx=0): LuarObject {
		$objects = $this->getObjects();
		return $objects[$idx] ?? new Literal(null);
	}

	public function slice(int $idx): ObjectList {
		$slice = [];
		$objects = $this->getObjects();

		$count = count($objects);
		for (; $idx<$count; $idx++) {
			$slice[] = $objects[$idx];
		}

		return new ObjectList($slice);
	}

	public function __toString(): string{
		return 'ObjectList';
	}
}
