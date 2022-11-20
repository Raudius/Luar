<?php
namespace Raudius\Luar\UnitTests;

use PHPUnit\Framework\TestCase;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Luar;


class LuarTest extends TestCase {
	public function testAssignFunction(): void {
		$luar = new Luar();
		$luar->assign('sum', function ($a, $b) {
			return $a+$b;
		});
		$luar->assign('sum2', new Invokable(function (ObjectList $ol) {
			return $ol->getObject(0)->getValue() + $ol->getObject(1)->getValue();
		}));

		$this->assertEquals(3, $luar->call('sum', [1,2]));
		$this->assertEquals(3, $luar->call('sum2', [1,2]));
	}

	public function testCall(): void {
		$program = <<<LUA
function sum(a,b)
	return a+b
end
LUA;

		$luar = new Luar();
		$luar->eval($program);
		$this->assertEquals(
			3,
			$luar->call('sum', [1,2])
		);
	}

	public function testGetGlobals(): void {
		$program = <<<LUA
function foo(a,b)
	return 'bar'
end
a,b = 'a', 'b'
local c = 'c'
LUA;

		$luar = new Luar();
		$global_keys = array_keys($luar->getGlobals());
		$global_keys = [...$global_keys, 'foo', 'a', 'b', 'manual'];

		$luar->assign('manual', false);

		$luar->eval($program);
		$this->assertEqualsCanonicalizing(
			$global_keys,
			array_keys($luar->getGlobals())
		);
	}

	public function testMakeLuarObject(): void {
		$values = [
			'boolean' => [true, false, new Literal(false)],
			'number' => [0, 1, 1.2],
			'function' => [function () {}],
			'string' => [new Literal('a'), 'abc', ''],
			'table' => [['a'=>1], []],
			'nil' => [null, new Literal(null)]
		];

		foreach ($values as $type => $vs) {
			foreach ($vs as $v) {
				$luarObj = Luar::makeLuarObject($v);
				$this->assertEquals($type, $luarObj->getType());
			}
		}
	}
}
