<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\RuntimeException;
use Raudius\Luar\Interpreter\Scope;

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

		throw new RuntimeException('Cannot get property of non-object. ' . get_class($this->parent));
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
			throw new RuntimeException('Cannot assign value to non-object.');
		}

		if ($value instanceof Reference) {
			$value = $value->getObject();
		}

		$scope->assign($this->key, $value);
	}

	public function __toString(): string {
		return "Reference {$this->parent->__toString()}->{$this->key}";
	}

	public function getKey(): string {
		return $this->key;
	}

	public function callMethod(string $name, ObjectList $args): ObjectList {
		$object = $this->getObject();
		if (!$object instanceof Table) {
			throw new RuntimeException("Attempted to call method ($name) on non-object.");
		}

		$invokable = $object->get($name);
		if (!$invokable instanceof Invokable) {
			throw new RuntimeException("Attempted to call method ($name) on an object property.");
		}

		// FIXME optimise args creation
		$args = new ObjectList([$object, ...$args->getObjects()]);
		return $invokable->invoke($args);
	}
}
