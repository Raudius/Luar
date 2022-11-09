<?php
namespace Raudius\Luar\Interpreter\Tokens;


class VarSuffix {
	/** @var NameAndArgs[] */
	public array $nameAndArgs;
	public string $suffix;

	public function __construct(array $nameAndArgs, string $suffix) {
		$this->nameAndArgs = $nameAndArgs;
		$this->suffix = $suffix;
	}
}
