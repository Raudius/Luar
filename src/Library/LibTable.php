<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\LuarRuntimeException;

class LibTable extends Library {
	public function getName(): string {
		return 'table';
	}

	public function getFunctions(): array {
		return [
			'concat' => $this->concat(),
			'insert' => $this->insert(),
			'move' => $this->move(),
			'pack' => $this->pack(),
			'remove' => $this->remove(),
			'sort' => $this->sort(),
			'unpack' => $this->unpack(),
		];
	}

	public function getMetaMethods(): array {
		return [];
	}

	private function concat(): Invokable {
		return new Invokable(function (ObjectList $ol): ObjectList {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			$sep = $this->validateObjectListParameter($ol, ['string', 'nil'], 1)->getValue() ?? ''; /** @var string $sep */
			$start = (int) ($this->validateObjectListParameter($ol, ['number', 'nil'], 2)->getValue() ?? 1); /** @var int $start */
			$end = (int) ($this->validateObjectListParameter($ol, ['number', 'nil'], 3)->getValue() ?? $table->getLength()); /** @var int|null $end */

			$string = '';
			for ($i=$start; $i<=$end; $i++) {
				if (!$table->has($i)){
					throw new LuarRuntimeException("table.concat index out of bounds ($i)");
				}

				$obj = $table->get($i);

				if (!$obj instanceof Literal) {
					throw new LuarRuntimeException("concat(): disallowed type: {$obj->getType()}");
				}

				$string .= $table->get($i);

				if ($i !== $end) {
					$string .= $sep;
				}
			}

			return new ObjectList([new Literal($string)]);
		});
	}

	private function insert(): Invokable {
		return new Invokable(function (ObjectList $ol): void {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			if ($ol->count() === 3) {
				$pos = (int) $this->validateObjectListParameter($ol, ['number'], 1)->getValue();
				$value = $ol->getObject(3);
			} else {
				$pos = $table->getLength() + 1;
				$value = $ol->getObject(2);
			}

			if ($pos <= 0) {
				throw new LuarRuntimeException('table.insert position out of range: ' . $pos);
			}

			// Shift other elements
			if ($table->has($pos)) {
				for ($i=$table->getLength(); $i>=$pos; $i--) {
					$table->assign($i+1, $table->get($i));
				}
			}

			$table->assign($pos, $value);
		});
	}

	private function pack(): Invokable {
		return new Invokable(static function (ObjectList $ol): ObjectList {
			$table = new Table();
			$idx = 1;
			foreach ($ol->getObjects() as $obj) {
				$table->assign((string) $idx, $obj);
				++$idx;
			}
			$table->assign('n', new Literal($idx - 1));

			return new ObjectList( [$table] );
		});
	}

	private function remove(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			$length = $table->getLength();
			$index = (int) ($this->validateObjectListParameter($ol, ['number', 'nil'], 1)->getValue() ?? $length);


			if ($index < 1 || $index > $length) {
				return new ObjectList([ new Literal(null) ]);
			}

			$item = $table->get($index);
			// Shift other elements
			for ($i=$index; $i<$length; $i++) {
				$table->assign($i, $table->get($i+1));
			}
			$table->remove($length);

			return new ObjectList([ $item ]);
		});
	}

	private function unpack(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			$length = $table->getLength();

			$start = (int) ($this->validateObjectListParameter($ol, ['number', 'nil'], 1)->getValue() ?? 1);
			$end = (int) ($this->validateObjectListParameter($ol, ['number', 'nil'], 2)->getValue() ?? $length);

			$objects = [];
			for ($i=$start; $i<=$end; $i++) {
				$objects[] = $table->get($i);
			}

			return new ObjectList($objects);
		});
	}

	private function sort(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$table = $this->validateObjectListParameter($ol, ['table'], 0); /** @var Table $table */
			$cmp = $this->validateObjectListParameter($ol, ['function', 'nil'], 1) ?? $this->compare(); /** @var Invokable|null $cmp */

			$length = $table->getLength();
			$items = [];
			for ($i=1; $i<=$length; $i++) {
				$items[] = $table->get($i);
			}

			usort($items, static function ($item1, $item2) use ($cmp) {
				return $cmp->invoke(new ObjectList([$item1, $item2])) ? -1 : 1;
			});

			return Table::fromArray($items);
		});
	}

	/**
	 * @return Invokable
	 */
	private function move(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			/** @var Table $table */
			$table = $this->validateObjectListParameter($ol, ['table'], 0);
			$f = (int) $this->validateObjectListParameter($ol, ['number'], 1)->getValue();
			$e = (int) $this->validateObjectListParameter($ol, ['number'], 2)->getValue();
			$t = (int) $this->validateObjectListParameter($ol, ['number'], 3)->getValue();

			/** @var Table $table2 */
			$table2 = $this->validateObjectListParameter($ol, ['table', 'nil'], 4) ?? $table;

			$e = min($e, $table->getLength());
			while ($f <= $e) {
				$table2->assign($t, $table->get($f));
				$f++;
				$t++;
			}

			return new ObjectList([ $table2 ]);
		});
	}

	/**
	 * Default comparison function for sorting.
	 * @return Invokable
	 */
	private function compare(): Invokable {
		return new Invokable(function (ObjectList $ol) {
			$item1 = $ol->getObject(0);
			$item2 = $ol->getObject(1);

			if ($item1->getType() !== $item2->getType()) {
				throw new LuarRuntimeException("attempt to compare {$item1->getType()} with {$item2->getType()}");
			}

			// TODO: compare PHP's spaceship `<=>` operator results with Lua's `<` (less-than) operator
			return ($item1 <=> $item2) === -1;
		});
	}
}
