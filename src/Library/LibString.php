<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\LuarRuntimeException;
use Raudius\Luar\Util\PatternHelper;

class LibString extends Library {
	private PatternHelper $patternHelper;
	public const MAX_STRLEN_FORMAT = 3200000;

	public function __construct() {
		$this->patternHelper = new PatternHelper();
	}

	public function getName(): string {
		return 'string';
	}

	public function getFunctions(): array {
		return [
			'dump' => $this->dump(), // WONTFIX
			'pack' => $this->pack(), // WONTFIX
			'packsize' => $this->packSize(), // WONTFIX
			'unpack' => $this->unpack(), // WONTFIX

			'char' => $this->char(),

			// Also are meta-methods:
			'byte' => $this->byte(),
			'find' => $this->find(),
			'format' => $this->format(),
			'gmatch' => $this->gmatch(), // todo
			'gsub' => $this->gsub(),
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
		return new Invokable(function (ObjectList $ol) {
			$subject = $this->validateObjectListParameter($ol, ['string'], 0); /** @var string $subject */
			$i = $this->validateObjectListParameter($ol, ['number', 'nil'], 1)->getValue() ?? 1;
			$j = $this->validateObjectListParameter($ol, ['number', 'nil'], 2)->getValue() ?? $i;

			$i = ($i < 0) ? strlen($subject) + $i + 1 : $i;
			$i = max($i, 1);
			$j = ($j < 0) ? strlen($subject) + $j + 1 : $j;
			$j = min($j, strlen($subject));

			$bytes = [];
			$chars = str_split($subject);
			for (; $i<=$j; $i++) {
				if (isset($chars[$i-1])) {
					$bytes[] = new Literal(ord($chars[$i-1]));
				}
			}


			return new ObjectList($bytes);
		});
	}
	private function char(): Invokable {
		return Invokable::fromPhpCallable(static function (...$chars) {
			$string = '';
			foreach ($chars as $char) {
				if (!is_numeric($char)) {
					continue;
				}

				$char = $char + 0;
				if ($char > 255 || $char < 0) {
					throw new LuarRuntimeException('chr() value out of range');
				}
				$string .= chr((int) $char);
			}
			return $string;
		});
	}

	public function find(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = (string) $this->validateObjectListParameter($ol, ['string'], 0)->getValue();
			$pattern = (string) $this->validateObjectListParameter($ol, ['string'], 1)->getValue();
			$index = $this->validateObjectListParameter($ol, ['number', 'nil'], 2)->getValue() ?? 0;
			$plain = $this->validateObjectListParameter($ol, ['boolean', 'number','nil'],  3)->getValue() ?: false;

			if ($index !== null) {
				$index = (($index === 0) ? 1 : $index);
				$index = ($index < 0) ? strlen($pattern) - $index : $index - 1;
			}

			$return = [];
			if (!$plain) {
				$matches = $this->patternHelper->matchPattern($subject, $pattern, $index);

				if (isset($matches[0])) {
					$start = $matches[0][1] + 1;
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
					++$start;
					$end = $start + strlen($pattern) - 1;
					$return = [new Literal($start), new Literal($end)];
				}
			}

			if ($return === []) {
				$return[] = new Literal(null);
			}
			return new ObjectList($return);
		});
	}


	public function match(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = $this->validateObjectListParameter($ol, ['string'], 0)->getValue(); /** @var string $subject */
			$pattern = $this->validateObjectListParameter($ol, ['string'], 1)->getValue(); /** @var string $pattern */
			$index = $this->validateObjectListParameter($ol, ['number', 'nil'], 2)->getValue() ?? 0; /** @var int $index */

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
			$subject = $this->validateObjectListParameter($ol, ['string'], 0)->getValue(); /** @var string $subject */
			$values = array_map(
				static function (LuarObject $o) {
					$value = $o->getValue();
					if ($value === true) {
						return 'true';
					}
					if ($value === false) {
						return 'false';
					}
					return $value ?? 'nil';
				}, $ol->slice(1)->getObjects()
			);

			// FIXME: embedded zeros not allowed for arguments with modifiers (e.g. %10f)
			// FIXME: %q does not escape characters
			$subject = str_replace(
				['%i', '%f', '%q', '%%', '%a', '%A'],
				['%d', '%F', '%s', '%%', '%%', '%%'],
				$subject
			);

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
			$string = (string) $this->validateObjectListParameter($ol, ['string'], 0)->getValue();
			$times = (int) $this->validateObjectListParameter($ol, ['number'], 1)->getValue();
			$sep = $this->validateObjectListParameter($ol, ['string', 'nil'], 2)->getValue() ?? '';

			$len = strlen($string) + strlen($sep);
			if ($times === 0 || $len === 0) {
				return '';
			}

			$max_reps = static::MAX_STRLEN_FORMAT / $len;
			if ($times > $max_reps) {
				throw new LuarRuntimeException('rep(): resulting string too large');
			}

			return str_repeat($string . $sep, $times-1) . $string ;
		});
	}

	private function sub(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = (string) $this->validateObjectListParameter($ol, ['string'], 0)->getValue();
			$i = (int) $this->validateObjectListParameter($ol, ['number'], 1)->getValue();
			$j = $this->validateObjectListParameter($ol, ['number', 'nil'], 2)->getValue() ?? -1;

			$i = ($i < 0) ? strlen($subject) + $i + 1 : $i;
			$i = max($i, 1);
			$j = ($j < 0) ? strlen($subject) + $j + 1 : $j;
			$j = min($j, strlen($subject));

			if ($i > $j) {
				return '';
			}

			$len = $j - $i + 1;
			return substr($subject, $i-1, $len) ?: '';
		});
	}

	private function gsub(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = (string) $this->validateObjectListParameter($ol, ['string'], 0)->getValue();
			$pattern = (string) $this->validateObjectListParameter($ol, ['string'], 1)->getValue();
			$repl = $this->validateObjectListParameter($ol, ['string', 'number', 'table', 'function'], 2);
			$n = $this->validateObjectListParameter($ol, ['number', 'nil'], 3)->getValue() ?? -1;

			$regex = $this->patternHelper->patternToRegex($pattern);

			// FIXME: efficiency gains: preg_match_all + preg_replace inefficient
			preg_match_all($regex, $subject, $matches);
			$repls = [];
			$patterns = [];
			foreach ($matches[0] as $match) {
				$obj = $repl;
				if ($obj instanceof Invokable) {
					$obj = $obj->invoke(new ObjectList([new Literal($match)]));
				} elseif ($obj instanceof Table) {
					$obj = $obj->get($match);
				}

				$repls[] = (string) $obj->getValue();
				$patterns[] = $regex;
			}

			$return = preg_replace($patterns, $repls, $subject, $n);

			return new ObjectList([ new Literal($return) ]);
		});
	}

	private function gmatch(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$subject = (string) $this->validateObjectListParameter($ol, ['string'], 0)->getValue();
			$pattern = (string) $this->validateObjectListParameter($ol, ['string'], 1)->getValue();

			$regex = $this->patternHelper->patternToRegex($pattern);
			preg_match_all($regex, $subject, $matches);

			$countMatches = count($matches);
			$results = [];
			foreach ($matches[0] as $i => $match) {
				$result = [];

				for ($group=1; $group<$countMatches; $group++) {
					$result[] = new Literal($matches[$group][$i]);
				}

				if ($result === []) { // No groups -> return full match
					$result[] = new Literal($match);
				}

				$results[] = new ObjectList($result);
			}

			return Invokable::fromPhpCallable(function () use (&$results) {
				$current = current($results);
				next($results);
				return $current ?: new ObjectList([]);
			});
		});
	}
}
