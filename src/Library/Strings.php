<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Util\PatternHelper;

class Strings extends Library {
	private PatternHelper $patternHelper;

	public function __construct() {
		$this->patternHelper = new PatternHelper();
	}

	public function getName(): string {
		return 'string';
	}

	public function getFunctions(): array {
		return [
			'char' => $this->char(),
			'dump' => $this->dump(), // WONTFIX

			// Also are meta-methods:
			'byte' => $this->byte(),
			'find' => $this->find(),
			'format' => $this->format(),
			'gmatch' => $this->gmatch(), // todo
			'gsub' => $this->gsub(), // todo
			'len' => $this->len(),
			'lower' => $this->lower(),
			'match' => $this->match(),
			'rep' => $this->rep(),
			'reverse' => $this->reverse(),
			'sub' => $this->sub(),
			'upper' => $this->upper()
		];
	}

	public function getMetaMethods(): array {
		return [
			'string' => [
				'byte' => $this->byte(),
				'find' => $this->find(),
				'format' => $this->format(),
				'gmatch' => $this->gmatch(), // todo
				'gsub' => $this->gsub(), // todo
				'len' => $this->len(),
				'lower' => $this->lower(),
				'match' => $this->match(),
				'rep' => $this->rep(),
				'reverse' => $this->reverse(),
				'sub' => $this->sub(),
				'upper' => $this->upper()
			]
		];
	}

	private function byte(): Invokable {
		return new Invokable(function (ObjectList $ol): string {
			$subject = $this->validateTypeN($ol, 'string', 0); /** @var string $subject */
			$indices = $this->validateTypes($ol, 'integer', 1); /** @var int[] $indices */

			$bytes = [];
			$chars = str_split($subject);
			foreach ($indices as $index) {
				--$index;
				if (isset($chars[$index])) {
					$bytes[] = new Literal(ord($chars[$index]));
				}
			}
			return new ObjectList($bytes);
		});
	}
	private function char(): Invokable {
		return Invokable::fromPhpCallable(static function (...$chars): string {
			$string = '';
			foreach ($chars as $char) {
				if (is_numeric($char)) {
					$string .= chr((int) $char);
				}
			}
			return $string;
		});
	}

	public function find(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = $this->validateTypeN($ol, 'string', 0); /** @var string $subject */
			$pattern = $this->validateTypeN($ol, 'string', 1); /** @var string $pattern */
			$index = $this->validateTypeN($ol, 'integer', 2, true) ?? 0; /** @var int $index */
			$plain = $this->validateTypeN($ol, 'boolean', 3, true) ?? false; /** @var boolean $plain */

			if ($index !== null) {
				$index = (($index === 0) ? 1 : $index);
				$index = ($index < 0) ? strlen($pattern) - $index : $index - 1;
			}

			$return = [];
			if (!$plain) {
				$matches = $this->patternHelper->matchPattern($subject, $pattern, $index);

				if (isset($matches[0])) {
					$start = $matches[0][1] + $index + 1;
					$end = $start + strlen($matches[0][0]) - 1;
					$return = [new Literal($start), new Literal($end)];

					$idx = 1;
					while (isset($matches[$idx])) {
						$return[] = new Literal($matches[$idx][0]);
						$idx++;
					}
				}
			} else {
				$start = strpos($subject, $pattern, $index);
				if ($start !== false) {
					$end = $start + strlen($pattern) - 1;
					$return = [new Literal($start), new Literal($end)];
				}
			}

			return new ObjectList($return);
		});
	}


	public function match(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = $this->validateTypeN($ol, 'string', 0); /** @var string $subject */
			$pattern = $this->validateTypeN($ol, 'string', 1); /** @var string $pattern */
			$index = $this->validateTypeN($ol, 'integer', 2, true) ?? 0; /** @var int $index */

			if ($index !== null) {
				$index = (($index === 0) ? 1 : $index);
				$index = ($index < 0) ? strlen($pattern) + $index : $index - 1;
			}

			$matches = $this->patternHelper->matchPattern($subject, $pattern, $index);
			if (!isset($matches[0])) {
				return new ObjectList([]);
			}

			(count($matches) > 1) && array_shift($matches); // If we have multiple matches, remove global capture group.
			$return = [];
			foreach ($matches as $match) {
				$return[] = new Literal($match[0]);
			}
			return new ObjectList($return);
		});
	}

	private function format(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = $this->validateTypeN($ol, 'string', 0); /** @var string $subject */
			$values = array_map(
				static function (LuarObject $o) {
					return $o->getValue();
				}, $ol->slice(1)->getObjects()
			);

			str_replace('%i', '%d', $subject);
			str_replace('%f', '%F', $subject);
			str_replace('%%', '%%', $subject);
			// NOTE: %q unimplemented

			return sprintf($subject, ...$values);
		});
	}

	private function lower(): Invokable {
		return Invokable::fromPhpCallable(static function ($string) {
			return is_string($string) ? strtolower($string) : '';
		});
	}

	private function upper(): Invokable {
		return Invokable::fromPhpCallable(static function ($string) {
			return is_string($string) ? strtoupper($string) : '';
		});
	}

	private function reverse(): Invokable {
		return Invokable::fromPhpCallable(static function ($string) {
			return is_string($string) ? strrev($string) : '';
		});
	}

	private function len(): Invokable {
		return Invokable::fromPhpCallable(static function ($string) {
			return is_string($string) ? strlen($string) : 0;
		});
	}

	private function rep(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$string = (string) $ol->getObject( 0);
			$times = $this->validateTypeN($ol, 'integer', 1); /** @var int $times */
			$sep = (string) $ol->getObject( 2);
			if ($times === 0) {
				return '';
			}
			return str_repeat($string . $sep, $times-1) . ($times > 0 ? $string : '');
		});
	}

	private function sub(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = $this->validateTypeN($ol, 'string', 0); /** @var string $subject */
			$i = $this->validateTypeN($ol, 'integer', 1); /** @var int $i */
			$j = $this->validateTypeN($ol, 'integer', 2, true); /** @var int $j */

			$i = ($i === 0) ? 1 : $i;
			$i = ($i < 0) ? strlen($subject) + $i : $i - 1;

			$len = null;
			if ($j !== null) {
				$j = ($j === 0) ? 1 : $j;
				$j = ($j < 0) ? strlen($subject) + $j : $j - 1;

				$len = max(0, $j-$i + 1);
			}

			return substr($subject, $i, $len) ?: '';
		});
	}
}
