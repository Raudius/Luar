<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\RuntimeException;

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
		];
	}

	public function getMetaMethods(): array {
		return [];
	}

	private function pcall(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$function = $this->validateTypeN($ol, ['function'], 0); /** @var Invokable $function */
			$args = $ol->slice(1);

			$success = true;
			try {
				$result = $function->invoke($args);
			} catch (\Exception $exception) { // TODO: Only catch LuarException?
				$success = false;
				$result = $exception->getMessage();
			}

			return new ObjectList([new Literal($success), new Literal($result)]);
		});
	}

	private function error(): Invokable {
		return Invokable::fromPhpCallable(static function ($message) {
			$message = is_string($message) ? $message : '';
			throw new RuntimeException($message); // TODO: Special UserError exception?
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
		return Invokable::fromPhpCallable(function ($value, $message = null) {
			if (!$value) {
				$message = new Literal(is_string($message) ? $message : 'assertion failed!');
				$this->error()->invoke(new ObjectList([$message]));
			}
		});
	}

	private function tonumber(): Invokable {
		return Invokable::fromPhpCallable(static function ($value, $base = null) {
			if (!is_numeric($value)) {
				return null;
			}

			if ($base) {
				if (strpos($value, '.') !== false) {
					return null; // With base we expect no decimal point
				}
				return intval($value, (int) $base);
			}

			return (float) $value;
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

	private function select(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$index = $ol->getObject( 0)->getValue();
			$items = $ol->slice(1);
			$len = $items->count();

			if ($index === '#') {
				return new ObjectList([ new Literal($len) ]);
			}

			if (!is_numeric($index)) {
				throw new RuntimeException("select index argument expects '#' or number");
			}

			$index = (int) $index;
			$index = ($index < 0) ? $len - $index + 1: $index;
			if ($index === 0 || $index > $len) {
				throw new RuntimeException("select index out of range");
			}

			return $items->slice($index-1);
		});
	}

	private function ipairs(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateTypeN($ol, ['table'], 0); /** @var Table $table */

			$iterator = new Invokable(function (ObjectList $ol) {
				$table = $this->validateTypeN($ol, ['table'], 0); /** @var Table $table */
				$index = (int) $this->validateTypeN($ol, ['number'],1)->getValue() + 1; /** @var int $index */

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
			$table = $this->validateTypeN($ol, ['table'], 0); /** @var Table $table */
			$prevKey = $ol->getObject(1)->getValue();

			return new ObjectList($table->next($prevKey));
		});
	}

	private function pairs(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateTypeN($ol, ['table'], 0); /** @var Table $table */
			return new ObjectList([$this->next(), $table, new Literal(null)]);
		});
	}
}
