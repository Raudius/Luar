<?php
namespace Raudius\Luar;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Library\LibCore;
use Raudius\Luar\Library\LibMath;
use Raudius\Luar\Library\Library;
use Raudius\Luar\Library\LibString;
use Raudius\Luar\Library\LibTable;

class Luar {
	private Interpreter $interpreter;

	public function __construct() {
		$this->interpreter = new Interpreter();

		$this->addCoreLibrary(new LibCore());
		$this->addLibrary(new LibString());
		$this->addLibrary(new LibTable());
		$this->addLibrary(new LibMath());
	}

	public function eval(string $program) {
		return static::objectToPhp($this->interpreter->eval($program));
	}

	public static function objectToPhp(LuarObject $object) {
		if ($object instanceof Table) {
			$table = [];
			foreach ($object->getValue() as $k => $value) {
				$table[$k] = self::objectToPhp($value);
			}

			return $table;
		}

		return $object->getValue();
	}

	public static function makeLuarObject($value): LuarObject {
		if ($value instanceof LuarObject) {
			return $value;
		}

		if (!is_string($value) && is_callable($value)) {
			return Invokable::fromPhpCallable($value);
		}

		if (is_array($value)) {
			return Table::fromArray($value);
		}
		return new Literal($value);
	}

	public function assign(string $name, $value): void {
		$this->interpreter->getRoot()->assign($name, self::makeLuarObject($value));
	}

	public function call(string $name, array $args) {
		$invokable = $this->interpreter->getRoot()->get($name);
		if (!$invokable instanceof Invokable) {
			throw new LuarException('Could not call non-invokable object');
		}

		$args = array_map(static function ($arg): LuarObject {
			return self::makeLuarObject($arg);
		}, $args);

		return static::objectToPhp($invokable->invoke(new ObjectList($args)));
	}

	public function getGlobals(): array {
		$globals = [];
		foreach ($this->interpreter->getRoot()->getAssigns() as $k => $o) {
			$globals[$k] = $o->getValue();
		}

		return $globals;
	}

	public function addLibrary(Library $library): void {
		$functions = new Table(null, $library->getFunctions());
		$this->interpreter->getRoot()->assign($library->getName(), $functions);
		$this->interpreter->setMetaMethods(array_merge_recursive($this->interpreter->getMetaMethods(), $library->getMetaMethods()));
	}

	/**
	 * Core library functions get added directly to the root scope. No meta-methods are expected.
	 */
	public function addCoreLibrary(Library $library): void {
		foreach ($library->getFunctions() as $name => $func) {
			$this->interpreter->getRoot()->assign($name, $func);
		}
	}
}
