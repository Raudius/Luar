<?php
namespace Raudius\Luar\Interpreter\Tokens;

class FuncName {
	private array $nameChain;
	private bool $isMethod = false;

	public function __construct(array $nameChain, ?string $method) {
		$this->nameChain = $nameChain;

		if ($method) {
			$this->nameChain[] = $method;
			$this->isMethod = true;
		}
	}

	public function getChain(): array {
		return $this->nameChain;
	}

	public function getName(): string {
		return end($this->nameChain);
	}

	public function isMethod(): bool {
		return $this->isMethod;
	}
}
