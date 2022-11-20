<?php
namespace Raudius\Luar\Interpreter;

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Library\Library;
use Raudius\Luar\Parser\LuaLexer;
use Raudius\Luar\Parser\LuaParser;

final class Interpreter {
	private Scope $scope;
	private Scope $root;
	private array $metaMethods = [];

	public function __construct(Scope $scope = null) {
		$this->scope = $scope ?? new Scope();
		$this->root = $this->scope;
	}

	public function eval(string $program) {
		$lexer = new LuaLexer(InputStream::fromString($program));
		$tokens = new CommonTokenStream($lexer);
		$parser = new LuaParser($tokens);
		$parser->addErrorListener(new DiagnosticErrorListener());
		$parser->setBuildParseTree(true);

		return (new LuarStatementVisitor($this))->visitBlock($parser->block())->getReturn();
	}

	public function getScope(): Scope {
		return $this->scope;
	}

	public function getRoot(): Scope {
		return $this->root;
	}

	public function pushScope(?Scope $scope = null): Scope {
		$this->scope = $scope ?? new Scope($this->scope);
		return $this->scope;
	}

	public function popScope(): Scope {
		$oldScope = $this->scope;
		$scope = $oldScope->getParent();
		if ($scope === null) {
			throw new RuntimeException("FATAL ERROR! Attempted to pop root scope.");
		}
		$this->scope = $scope;
		return $oldScope;
	}

	public function setScope(Scope $scope) {
		$this->scope = $scope;
	}

	public function addLibrary(Library $library): void {
		$functions = new Table(null, $library->getFunctions());
		$this->scope->assign($library->getName(), $functions);
		$this->metaMethods = array_merge_recursive($this->metaMethods, $library->getMetaMethods());
	}

	/**
	 * Core library functions get added directly to the root scope. No meta-methods are expected.0
	 */
	public function addCoreLibrary(Library $library): void {
		foreach ($library->getFunctions() as $name => $func) {
			$this->root->assign($name, $func);
		}
	}

	public function getMetaMethod(string $type, string $method): ?Invokable {
		return ($this->metaMethods[$type] ?? [])[$method] ?? null;
	}
}
