<?php
namespace Raudius\Luar\Interpreter;

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarObject\Table;
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

	public function eval(string $program): LuarObject {
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
			throw new LuarRuntimeException("FATAL ERROR! Attempted to pop root scope.");
		}
		$this->scope = $scope;
		return $oldScope;
	}

	public function setScope(Scope $scope): void {
		$this->scope = $scope;
	}

	public function getMetaMethod(string $type, string $method): ?Invokable {
		return ($this->metaMethods[$type] ?? [])[$method] ?? null;
	}

	public function getMethod(LuarObject $object, string $name): ?Invokable {
		if ($object instanceof Reference) {
			$object = $object->getObject();
		}
		if ($object instanceof Table && $object->has($name)) {
			$invokable = $object->get($name);
			return $invokable instanceof Invokable ? $invokable : null;
		}
		return $this->getMetaMethod($object->getType(), $name);
	}

	public function setMetaMethods(array $metaMethods): void {
		$this->metaMethods = $metaMethods;
	}

	public function getMetaMethods(): array {
		return $this->metaMethods;
	}
}
