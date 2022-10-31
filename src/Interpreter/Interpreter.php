<?php
namespace Raudius\Luar\Interpreter;

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Raudius\Luar\Parser\LuaLexer;
use Raudius\Luar\Parser\LuaParser;

final class Interpreter {
	private Scope $scope;
	private Scope $root;

	public function __construct(Scope $scope = null) {
		$this->scope = $scope ?? new Scope();
		$this->root = $this->scope;
	}

	public function eval(string $program): void {
		$lexer = new LuaLexer(InputStream::fromString($program));
		$tokens = new CommonTokenStream($lexer);
		$parser = new LuaParser($tokens);
		$parser->addErrorListener(new DiagnosticErrorListener());
		$parser->setBuildParseTree(true);

		(new LuarStatementVisitor($this))->visit($parser->chunk());

		var_dump($this->getRoot());
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
