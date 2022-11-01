<?php
namespace Raudius\Luar\Interpreter;

use Exception;
use Antlr\Antlr4\Runtime\RuleContext;

class RuntimeException extends Exception
{
	private ?RuleContext $context;

	public function __construct(
		string $message,
		RuleContext $context = null,
		int $code = 0,
		\Throwable $previous = null
	) {
		$this->context = $context;
		parent::__construct($message, $code, $previous);
	}

	public function setContext(RuleContext $context): void {
		$this->context = $context;
	}

	public function getContext(): ?RuleContext {
		return $this->context;
	}
}
