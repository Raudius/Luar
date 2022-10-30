<?php
namespace Raudius\Luar\Interpreter;

final class Interpreter {
	private Scope $scope;
	private Scope $root;

	public function __construct(Scope $scope = null) {
		$this->scope = $scope ?? new Scope();
		$this->root = $this->scope;
	}

	public function eval(string $program): void {
	}

	public function getScope(): Scope {
		return $this->scope;
	}

	public function getRoot(): Scope {
		return $this->root;
	}

	public function pushScope(?Scope $scope = null): Scope {
		if ($scope) {
			$scope->setParent($this->scope);
		}

		$this->scope = $scope ?? new Scope($this->scope);
		return $this->scope;
	}

	public function popScope(): void {
		$scope = $this->scope->getParent();
		if ($scope === null) {
			throw new RuntimeException("FATAL ERROR! Attempted to pop root scope.");
		}
		$this->scope = $scope;
	}
}
