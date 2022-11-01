<?php
namespace Raudius\Luar\Interpreter\LuarObject;

class ObjectList implements LuarObject {
	/** @var LuarObject[] */
	private array $expressions;

	/** @var null|LuarObject[] */
	private ?array $expressionsFlattened = null;

	/**
	 * @param LuarObject[] $expressions
	 */
	public function __construct(array $expressions = []) {
		$this->expressions = $expressions;
	}

	/**
	 * TODO: cache result?
	 * @return LuarObject[]
	 */
	public function getObjects(): array {
		if ($this->expressionsFlattened !== null) {
			return $this->expressionsFlattened;
		}

		$this->expressionsFlattened = [];

		foreach ($this->expressions as $expression) {
			if ($expression instanceof ObjectList) {
				$expression = $expression->getObjects();
				$this->expressionsFlattened = [...$this->expressionsFlattened, ...$expression];
			} else {
				$this->expressionsFlattened[] = $expression;
			}
		}

		return $this->expressionsFlattened;
	}

	public function getValue() {
		return $this->getExpression(0)->getValue();
	}

	public function getExpression(int $idx): LuarObject {
		$objects = $this->getObjects();
		return $objects[$idx] ?? new Literal(null);
	}

	public function __toString(): string{
		return $this->getValue()->__toString();
	}
}
