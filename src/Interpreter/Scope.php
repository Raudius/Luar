<?php

namespace Raudius\Luar\Interpreter;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;

class Scope {
	/** @var LuarObject[] */
	protected array $assigns;
	private ?Scope $parent;

	private ?int $exit = null;
	private ?int $expectExit = null;
	/** @var LuarObject[]|null */
	private ?array $returnList = null;

	public const EXIT_RETURN = 1;
	public const EXIT_BREAK = 2;
	public const EXIT_CONTINUE = 3;

	public const EXIT_EXPECT_RETURN = 1;
	public const EXIT_EXPECT_BREAK_CONTINUE = 2;


	public function __construct(?Scope $parent = null, array $assigns = []) {
		$this->parent = $parent;
		$this->assigns = $assigns;
	}

	public function get(string $key): LuarObject {
		return $this->assigns[$key]
			?? ($this->parent ? $this->parent->get($key) : new Literal(null));
	}

	public function gets(array $keys) {
		$scope = $this;

		foreach ($keys as $key) {
			if (!$scope instanceof self) {
				return new Literal(null);
			}
			$scope = $scope->get($key);
		}

		return $scope;
	}

	/**
	 * @param LuarObject[] $args
	 */
	public function callFunction(string $name, array $args): LuarObject {
		$invokable = $this->get($name);

		if ($invokable === null) {
			throw new RuntimeException('No such function or method: ' . $name);
		}

		if (!$invokable instanceof Invokable) {
			throw new RuntimeException('Cannot perform function call on non-invokable object: ' . get_class($invokable));
		}

		return $invokable->invoke($args);
	}

	/**
	 * @param LuarObject[] $args
	 */
	public function callMethod(string $name, array $args): LuarObject {
		if (!$this instanceof LuarObject) {
			throw new RuntimeException('Attempted to call method on non-object.');
		}

		array_unshift($args, $this);
		return $this->callFunction($name, $args);
	}

	public function setExpectedExit(?int $expectedExit): void{
		$this->expectExit = $expectedExit;
	}

	public function setExit(int $exit_type, array $returnList = null): void {
		$this->exit = $exit_type;
		$this->returnList = $returnList;

		// Propagate exit
		$exit_type_expect = $exit_type === self::EXIT_RETURN ? self::EXIT_EXPECT_RETURN : self::EXIT_EXPECT_BREAK_CONTINUE;
		if (!$this->expectExit || $exit_type_expect !== $this->expectExit) {
			$this->parent && $this->parent->setExit($exit_type, $returnList);
		}
	}

	public function getExit(): ?int {
		return $this->exit;
	}

	/**
	 * @return LuarObject[]|LuarObject|null
	 */
	public function getReturn() {
		if (is_array($this->returnList)) {
			return count($this->returnList) === 1 ? $this->returnList[0] : $this->returnList;
		}
		return new Literal(null);
	}

	public function assign(string $key, LuarObject $value): void {
		$this->$key = $value;
	}

	public function getAssigns() {  // todo: delete?
		return $this->assigns;
	}

	public function getParent(): ?Scope {
		return $this->parent;
	}

	public function __set($name, LuarObject $value): void {
		$this->assigns[$name] = $value;
	}

	public function __isset($name): bool {
		return isset($this->assigns[$name]);
	}

	public function __get($name): ?LuarObject {
		return $this->$name ?? $this->assigns[$name] ?? null;
	}

	public function __debugInfo() {
		$info = [];

		foreach ($this->assigns as $k => $v) {
			$info[$k] = $v->__toString();
		}

		return [$info];
	}
}
