<?php

namespace Raudius\Luar\Interpreter;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;

class Scope {
	public const EXIT_RETURN = 1;
	public const EXIT_BREAK = 2;
	public const EXIT_CONTINUE = 3;

	public const EXIT_EXPECT_RETURN = 1;
	public const EXIT_EXPECT_BREAK_CONTINUE = 2;

	/** @var LuarObject[] */
	protected array $assigns;
	private ?Scope $parent;

	private ?int $exit = null;
	private ?int $expectExit = null;
	private ?LuarObject $return = null;

	public function __construct(?Scope $parent = null, array $assigns = []) {
		$this->parent = $parent;
		$this->assigns = $assigns;
	}

	public function has(string $key): bool {
		return isset($this->assigns[$key]);
	}

	public function get(string $key): LuarObject {
		return $this->assigns[$key]
			?? ($this->parent ? $this->parent->get($key) : new Literal(null));
	}

	public function getScope(string $key): Scope {
		return (isset($this->assigns[$key]) || !$this->parent)
			? $this
			: $this->parent->getScope($key);
	}

	public function setExpectedExit(?int $expectedExit): void{
		$this->expectExit = $expectedExit;
	}

	public function setExit(int $exit_type, ?LuarObject $return = null): void {
		$this->exit = $exit_type;
		$this->return = $return;

		// Propagate exit
		$exit_type_expect = $exit_type === self::EXIT_RETURN ? self::EXIT_EXPECT_RETURN : self::EXIT_EXPECT_BREAK_CONTINUE;
		if (!$this->expectExit || $exit_type_expect !== $this->expectExit) {
			$this->parent && $this->parent->setExit($exit_type, $return);
		}
	}

	public function resetExit(): void {
		$this->exit = null;
	}

	public function getExit(): ?int {
		return $this->exit;
	}

	public function getReturn(): LuarObject {
		return $this->return ?? new Literal(null);
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

	// TODO: remove magic methods
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
			$s = $v instanceof LuarObject ? $v->__toString() : $v;
			$info[$k] = $s;
		}

		return [$info];
	}

	public function __toString() {
		return json_encode($this->__debugInfo()) ?: 'Scope';
	}

	public function isRoot(): bool {
		return $this->parent === null;
	}
}
