<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\RuntimeException;

class LibMath extends Library {
	public function getName(): string {
		return 'math';
	}

	public function getFunctions(): array {
		return [
			'abs' => $this->fromPhpFunction('abs' ,1),
			'acos' => $this->fromPhpFunction('acos' ,1),
			'asin' => $this->fromPhpFunction('asin' ,1),
			'atan ' => $this->atan(),
			'ceil' => $this->fromPhpFunction('ceil' ,1),
			'cos' => $this->fromPhpFunction('cos' ,1),
			'deg' => $this->fromPhpFunction('deg' ,1),
			'exp' => $this->fromPhpFunction('exp' ,1),
			'floor' => $this->fromPhpFunction('floor' ,1),
			'fmod' => $this->fromPhpFunction('fmod' ,2),
			'huge' => PHP_FLOAT_MAX,
			'log' => $this->fromPhpFunction('log'),
			'max' => $this->fromPhpFunction('max'),
			'maxinteger' => PHP_INT_MAX,
			'min' => $this->fromPhpFunction('min'),
			'mininteger' => PHP_INT_MIN,
			'modf' => $this->modf(),
			'pi' => M_PI,
			'rad' => $this->fromPhpFunction('rad2deg' ,1),
			'random' => $this->random(),
			'randomseed' => $this->randomseed(),
			'sin' => $this->fromPhpFunction('sin' ,1),
			'sqrt' => $this->fromPhpFunction('sqrt' ,1),
			'tan' => $this->fromPhpFunction('tan' ,1),
			'tointeger' => $this->fromPhpFunction('intval' ,1),
			'type' => $this->type()
		];
	}

	public function getMetaMethods(): array {
		return [];
	}

	private function atan(): Invokable {
		return Invokable::fromPhpCallable(
			static function (...$args) {
				if (count($args) === 1) {
					return atan($args[0]);
				}

				if (count($args) > 1) {
					return atan2($args[0], $args[1]);
				}

				throw new RuntimeException('math.atan expects at least one argument.');
			}
		);
	}

	private function modf(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$n = (float) $this->validateTypeN($ol, ['number'], 0)->getValue();
			$int = floor($n);
			$float = $n - $int;

			return new ObjectList([new Literal($int), new Literal($float)]);
		});
	}

	private function type(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$n = $this->validateTypeN($ol, ['number'], 0)->getValue();
			$type = is_int($n) ? 'integer' : 'float';
			return new ObjectList([new Literal($type)]);
		});
	}

	private function random(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$m = $this->validateTypeN($ol, ['number', 'nil'], 0)->getValue();
			$n = $this->validateTypeN($ol, ['number', 'nil'], 1)->getValue();

			if ($m === null && $n === null) {
				$m = 0;
				$n = 1;
			} elseif ($m !== null && $n === null) {
				$n = $m;
				$m = 1;
			}
			$n = (int) $n;
			$m = (int) $m;

			if ($n < $m) {
				throw new RuntimeException('bad arguments to \'math.random\' (interval is empty)');
			}

			return new ObjectList( [new Literal(mt_rand($m,$n))] );
		});
	}

	private function randomseed(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$x = (int) $this->validateTypeN($ol, ['number'], 0)->getValue();
			mt_srand($x);
		});
	}
}
