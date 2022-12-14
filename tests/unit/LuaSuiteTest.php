<?php
namespace Raudius\Luar\UnitTests;

use PHPUnit\Framework\TestCase;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Luar;

/**
 * Tests the interpreter by running files from the Lua test suite.
 * Assertions are already performed inside the Lua program, which will throw an exception if failed.
 */
class LuaSuiteTest extends TestCase {
	private function testLua(string $program): void {
		ini_set('xdebug.max_nesting_level', -1);
		$successReturn = "Luar OK!";
		$program .= "\nreturn '$successReturn'";

		ini_set('xdebug.max_nesting_level', -1);
		$testLuar = new Luar();
		$testLuar->assign('collectgarbage', static function () { });
		$testLuar->assign('load', new Invokable(function(ObjectList $ol) {
			$program = (string) $ol->getObject(0)->getValue();
			return new Invokable(function (ObjectList $ol) use ($program) {
				$luar = new Luar();
				$luar->assign(Reference::VAR_INTERNAL_ELIPSIS, $ol);
				return $luar->eval($program);
			});
		}));

		$testLuar->assign('_soft', true);
		$testLuar->assign('_port', true);
		$testLuar->assign('_nomsg', true);

		$this->assertEquals($successReturn, $testLuar->eval($program));
	}

	public function testMath(): void {
		$this->testLua(file_get_contents(__DIR__ . '/../lua/math.lua'));
	}

	public function testStrings(): void {
		$this->testLua(file_get_contents(__DIR__ . '/../lua/strings.lua'));
	}

	public function testVararg(): void {
		$this->testLua(file_get_contents(__DIR__ . '/../lua/vararg.lua'));
	}

	public function testClosure(): void {
		$this->testLua(file_get_contents(__DIR__ . '/../lua/closure.lua'));
	}

	public function testLocals(): void {
		$this->testLua(file_get_contents(__DIR__ . '/../lua/locals.lua'));
	}
}
