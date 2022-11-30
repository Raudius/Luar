<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\LuarRuntimeException;
use Raudius\Luar\Interpreter\Scope;

/**
 * This class is for internal use for holding references to objects and should generally NOT be used when using this library.
 */
class Reference implements LuarObject {
	public const VAR_INTERNAL_ELIPSIS = '__elipsis__';
	public const VAR_INTERNAL_GLOBAL = '_G';
	private string $key;
	/** @var Reference|Scope $scope */
	private $parent;

	/**
	 * @param Scope|Reference $parent
	 * @param string $key
	 */
	public function __construct($parent, string $key) {
		$this->parent = $parent;
		$this->key = $key;
	}

	public function getObject(): LuarObject {
		$object = $this->parent;
		if ($this->parent instanceof Reference) {
			$object = $this->parent->getObject();
		}

		if ($object instanceof Scope) {
			return $object->get($this->key) ?: new Literal(null);
		}

		throw new LuarRuntimeException('Cannot get property of non-object. ' . get_class($this->parent));
	}

	public function getValue(){
		return $this->getObject()->getValue();
	}

	public function setValue(LuarObject $value): void {
		$scope = $this->parent;
		if ($scope instanceof Reference) {
			$scope = $scope->getObject();
		}

		if (!$scope instanceof Scope) {
			throw new LuarRuntimeException('Cannot assign value to non-object.');
		}

		// TODO: Remove dereference?
		if ($value instanceof Reference) {
			$value = $value->getObject();
		}

		$scope->assign($this->key, $value);
	}

	public function __toString(): string {
		return (string) $this->getObject();
	}

	public function getKey(): string {
		return $this->key;
	}

	public function getType(): string {
		return $this->getObject()->getType();
	}
}
