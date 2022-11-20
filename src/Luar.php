<?php
namespace Raudius\Luar;

use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Library\LibCore;
use Raudius\Luar\Library\LibMath;
use Raudius\Luar\Library\LibString;
use Raudius\Luar\Library\LibTable;

class Luar {
	private Interpreter $interpreter;

	public function __construct() {
		$this->interpreter = new Interpreter();

		$this->interpreter->addCoreLibrary(new LibCore());
		$this->interpreter->addLibrary(new LibString());
		$this->interpreter->addLibrary(new LibTable());
		$this->interpreter->addLibrary(new LibMath());
	}

	public function eval(string $program) {
		return $this->interpreter->eval($program)->getValue();
	}

	public static function makeLuarObject($value): LuarObject {
		if ($value instanceof LuarObject) {
			return $value;
		}
		if (is_array($value)) {
			return Table::fromArray($value);
		}
		if (is_callable($value)) {
			return Invokable::fromPhpCallable($value);
		}
		return new Literal($value);
	}

	public function assign(string $name, $value): void {
		$this->interpreter->getRoot()->assign($name, self::makeLuarObject($value));
	}


	// TODO fix invoke
	public function call(string $name, array $args) {
		$invokable = $this->interpreter->getRoot()->get($name);
		if (!$invokable instanceof Invokable) {
			throw new LuarException('Could not call non-invokable object');
		}

		$invokable->invoke($args);
	}

	public function getGlobals(): array {
		return array_map(
			static function (LuarObject $luarObject) {
				return $luarObject->getValue();
			},
			$this->interpreter->getRoot()->getAssigns()
		);
	}

	public function printScope() {
		var_dump($this->interpreter->getScope());
	}
}
