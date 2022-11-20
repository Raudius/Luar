<?php
namespace Raudius\Luar\Interpreter;

use Exception;
use Antlr\Antlr4\Runtime\RuleContext;

class RuntimeException extends Exception
{
	/** @var RuleContext[] */
	private array $context;

	public function __construct(
		string $message,
		RuleContext $context = null,
		int $code = 0,
		\Throwable $previous = null
	) {
		$this->context = $context ? [$context] : [];
		parent::__construct($message, $code, $previous);
	}

	public function getContextTrace(): array {
		return $this->context;
	}

	public function pushContext(RuleContext $context): void {
		$this->context[] = $context;
	}
}
