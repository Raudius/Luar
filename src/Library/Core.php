<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\RuntimeException;
use Raudius\Luar\Util\PatternHelper;

class Core extends Library {
	public function __construct() {
		$this->patternHelper = new PatternHelper();
	}

	public function getName(): string {
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
			$function = $ol->getObject(0);
			$args = $ol->slice(1);

			$success = true;
			try {
				if (!$function instanceof Invokable) {
					throw new RuntimeException("attempt to call a {$function->getType()} value"); // TODO: move this to LuarObject->invoke() ?
				}
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

	private function pairs(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$i = $ol->getObject();
			$values = $this->validateTypeN($ol, 'array', 0); /** @var array $values */

			return $this->createIterator($values);
		});
	}
}
