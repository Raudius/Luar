<?php
namespace Raudius\Luar\Interpreter;

use Exception;
use Antlr\Antlr4\Runtime\ParserRuleContext;

class LuarRuntimeException extends Exception
{
	/** @var ParserRuleContext[] */
	private array $context;

	public function __construct(
		string $message,
		ParserRuleContext $context = null,
		int $code = 0,
		\Throwable $previous = null
	) {
		$context && $this->pushContext($context);
		parent::__construct($message, $code, $previous);
	}

	public function getContextTrace(): array {
		return $this->context;
	}

	public function pushContext(ParserRuleContext $context): void {
		$this->context[] = [
			'line' => $context->getStart() ? $context->getStart()->getLine() : -1,
			'code' => $context->getText()
		];
	}
}
