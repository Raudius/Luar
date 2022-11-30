<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarRuntimeException;

class LibMath extends Library {
	public function getName(): string {
		return 'math';
	}

	public function getFunctions(): array {
		return [
			'abs' => $this->fromPhpFunction('abs' ,1),
			'acos' => $this->fromPhpFunction('acos' ,1),
			'asin' => $this->fromPhpFunction('asin' ,1),
			'atan' => $this->atan(),
			'ceil' => $this->fromPhpFunction('ceil' ,1),
			'cos' => $this->fromPhpFunction('cos' ,1),
			'deg' => $this->fromPhpFunction('rad2deg' ,1),
			'exp' => $this->fromPhpFunction('exp' ,1),
			'floor' => $this->fromPhpFunction('floor' ,1),
			'fmod' => $this->fromPhpFunction('fmod' ,2),
			'huge' => new Literal(PHP_FLOAT_MAX),
			'log' => $this->fromPhpFunction('log'),
			'max' => $this->max(),
			'maxinteger' => new Literal(PHP_INT_MAX),
			'min' => $this->min(),
			'mininteger' => new Literal(PHP_INT_MIN),
			'modf' => $this->modf(),
			'pi' => new Literal(M_PI),
			'rad' => $this->fromPhpFunction('deg2rad' ,1),
			'random' => $this->random(),
			'randomseed' => $this->randomseed(),
			'sin' => $this->fromPhpFunction('sin' ,1),
			'sqrt' => $this->fromPhpFunction('sqrt' ,1),
			'tan' => $this->fromPhpFunction('tan' ,1),
			'tointeger' => $this->tointeger(),
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

				throw new LuarRuntimeException('math.atan expects at least one argument.');
			}
		);
	}

	private function modf(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$n = (float) $this->validateObjectListParameter($ol, ['number'], 0)->getValue();
			$int = floor(abs($n));
			$float = (float) (abs($n) - $int);

			if ($n < 0) {
				$int = -$int;
				$float = -$float;
			}

			if ($int <= PHP_INT_MAX && $int >= PHP_INT_MIN) {
				$int = (int) $int;
			}

			return new ObjectList([new Literal($int), new Literal($float)]);
		});
	}

	private function type(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$n = $ol->getObject(0)->getValue();
			$type = null;
			if (is_int($n)) {
				$type = 'integer';
			}
			if (is_float($n)) {
				$type = 'float';
			}
			return new ObjectList([new Literal($type)]);
		});
	}

	private function random(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$m = $this->validateObjectListParameter($ol, ['number', 'nil'], 0)->getValue();
			$n = $this->validateObjectListParameter($ol, ['number', 'nil'], 1)->getValue();

			$rand = null;
			if ($m === null && $n === null) {
				$rand = rand(PHP_INT_MIN, PHP_INT_MAX) / PHP_INT_MAX;
			} elseif ($m === 0 && $n === null) {
				$rand = rand(PHP_INT_MIN, PHP_INT_MAX);
			} elseif ($m !== null && $n === null) {
				$n = $m;
				$m = 1;
			}

			if ($rand === null) {
				if ($n < $m) {
					throw new LuarRuntimeException('bad arguments to \'math.random\' (interval is empty)');
				}
				$rand = rand($m, $n);
			}
			return new ObjectList( [new Literal($rand)] );
		});
	}

	private function randomseed(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$x = (int) $this->validateObjectListParameter($ol, ['number'], 0)->getValue();
			mt_srand($x);
		});
	}

	private function tointeger(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$x = $ol->getObject(0)->getValue();
			if (!is_numeric($x)) {
				return null;
			}

			if (floor((float) $x) != $x) {
				return null;
			}

			return (int) $x;
		});
	}

	private function max(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$values = [];
			foreach ($ol->getObjects() as $object) {
				$v = $object->getValue();
				if (!is_numeric($v)) {
					throw new LuarRuntimeException('Non-numeric argument passed to max()');
				}

				$values[] = $v;
			}

			return max($values);
		});
	}

	private function min(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$values = [];
			foreach ($ol->getObjects() as $object) {
				$v = $object->getValue();
				if (!is_numeric($v)) {
					throw new LuarRuntimeException('Non-numeric argument passed to max()');
				}

				$values[] = $v;
			}

			return min($values);
		});
	}
}
