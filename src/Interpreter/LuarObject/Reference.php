<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\RuntimeException;
use Raudius\Luar\Interpreter\Scope;

class Reference implements LuarObject {
	public const VAR_INTERNAL_ELIPSIS = '__internal__';
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
		return $this->parent->get($this->key) ?: new Literal(null);
	}

	public function getValue(){
		return $this->getObject()->getValue();
	}

	public function setValue(LuarObject $value): void {
		$scope = $this->parent;
		if ($scope instanceof Reference) {
			$scope = $scope->getValue();
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
}
