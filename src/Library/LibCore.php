<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\LuarRuntimeException;

class LibCore extends Library {public function getName(): string {
		return 'core';
	}

	public function getFunctions(): array {
		return [
			'assert' => $this->assert(),
			'error' => $this->error(),
			'ipairs' => $this->ipairs(),
			'next' => $this->next(),
			'pairs' => $this->pairs(),
			'pcall' => $this->pcall(),
			'print' => $this->print(),
			'select' => $this->select(),
			'tonumber' => $this->tonumber(),
			'tostring' => $this->tostring(),
			'type' => $this->type(),
			'setmetatable' => $this->setmetatable(),
			'getmetatable' => $this->getmetatable(),
		];
	}

	public function getMetaMethods(): array {
		return [];
	}

	private function pcall(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$function = $this->validateObjectListParameter($ol, ['function'], 0); /** @var Invokable $function */
			$args = $ol->slice(1);

			$success = true;
			try {
				$result = $function->invoke($args)->getValue();
			} catch (\Throwable $exception) { // TODO: Only catch LuarException?
				$success = false;
				$result = $exception->getMessage();
			}

			return new ObjectList([new Literal($success), new Literal($result)]);
		});
	}

	private function error(): Invokable {
		return Invokable::fromPhpCallable(static function ($message) {
			$message = is_string($message) ? $message : '';
			throw new LuarRuntimeException($message); // TODO: Special UserError exception?
		});
	}

	private function print(): Invokable {
		return new Invokable(static function (ObjectList $ol) {
			$isFirst = true;
			foreach ($ol->getObjects() as $o) {
				!$isFirst && print("\t");
				print($o);
				$isFirst = false;
			}
			print PHP_EOL;
		});
	}

	private function assert(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$r = $ol->getObject(0)->getValue();
			if ($r === false || $r === null) {
				$message = (string) ($ol->getRawObject(1)->getValue() ?? 'assertion failed');
				$this->error()->invoke(new ObjectList([new Literal($message)]));
			}

			$return = $ol->getRawObject(0);
			return $return instanceof ObjectList ? $return : new ObjectList([$return]);
		});
	}

	private function tonumber(): Invokable {
		return Invokable::fromPhpCallable(static function ($value, $base = null) {
			if (is_string($value) && preg_match('/^[ \\t\\n]*[+-]?[a-zA-Z0-9+-]*(\\.[a-zA-Z0-9+-]*)?[ \\t\\n]*$/', $value) !== 1) {
				return null;
			}

			if ($base) {
				if (strpos($value, '.') !== false) {
					return null; // With base we expect no decimal point
				}
				return intval($value, (int) $base);
			}

			// Calculate hex strings
			if (is_string($value) && preg_match('/^([+-]?0[xX])([A-Fa-f0-9]+)(\\.[\\d]+)?$/', $value, $matches) === 1) {
				$float = 0;
				if (isset($matches[3])) {
					$hexFloat = substr($matches[3],1);
					$float = hexdec($matches[3]) / (16 ** strlen($hexFloat));
				}

				$neg = $value[0] === '-' ? -1 : 1;

				return (hexdec($matches[2]) + $float) * $neg;
			}

			if (!is_numeric($value)) {
				return null;
			}

			return $value + 0;
		});
	}

	private function tostring(): Invokable {
		return new Invokable(static function (ObjectList $objectList) {
			return (string) $objectList->getObject(0);
		});
	}

	private function type(): Invokable {
		return new Invokable(static function (ObjectList $objectList) {
			return $objectList->getObject(0)->getType();
		});
	}

	private function setmetatable(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			$metatable = $this->validateObjectListParameter($ol, ['table', 'nil'], 1);

			if ($metatable instanceof Table) {
				$table->setMetaTable($metatable);
			} else {
				$table->setMetaTable(null);
			}
		});
	}
	private function getmetatable(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			return new ObjectList([$table->getMetaTable()]);
		});
	}

	private function select(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$i = $ol->getObject( 0)->getValue();
			$items = $ol->slice(1);
			$len = $items->count();

			if ($i === '#') {
				return new ObjectList([ new Literal($len) ]);
			}

			if (!is_numeric($i)) {
				throw new LuarRuntimeException("select index argument expects '#' or number");
			}

			$index = (int) $i;
			$index = ($index < 0) ? $len + $index + 1: $index;
			if ($index <= 0) {
				throw new LuarRuntimeException("select index out of range ($index) len=$len");
			}

			return $items->slice($index-1);
		});
	}

	private function ipairs(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */

			$iterator = new Invokable(function (ObjectList $ol) {
				$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
				$index = (int) $this->validateObjectListParameter($ol, ['number'],1)->getValue() + 1; /** @var int $index */

				if ($table->has($index)) {
					return new ObjectList([
						new Literal($index),
						$table->get($index)
					]);
				}

				return new ObjectList([new Literal(null), new Literal(null)]);
			});

			return new ObjectList([$iterator, $table, new Literal(0) ]);
		});
	}

	private function next(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			$prevKey = $ol->getObject(1)->getValue();

			return new ObjectList($table->next($prevKey));
		});
	}

	private function pairs(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			return new ObjectList([$this->next(), $table, new Literal(null)]);
		});
	}
}
