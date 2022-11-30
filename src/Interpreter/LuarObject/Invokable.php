<?php
namespace Raudius\Luar\Interpreter\LuarObject;

use Raudius\Luar\Interpreter\Scope;
use Raudius\Luar\Luar;

/**
 * This type of `LuarObject` is how Lua functions are stored during runtime. It is also used for defining functions aheead of runtime via a `Library` or via `Luar->assign`.
 *
 * - `Invokable::fromPhpCallbale()`, is the most convenient way to instantiate this class, as you can simply write the function as you would in PHP.
 * - `new Invokable()`, requires understanding how `ObjectList` operates, but offers more direct access to the underlying `LuarObjects` passed in the parameters.
 */
class Invokable implements LuarObject {
	/** @var callable $value */
	private $value;

	/**
	 * The function must expect a single argument of type `ObjectList`
	 *
	 * @param callable $function
	 */
	public function __construct(callable $function) {
		$this->value = $function;
	}

	public function getValue(): callable {
		return $this->value;
	}

	/**
	 * Calls the function.
	 *
	 * You generally should not need to do call this function directly.
	 * @param ObjectList $args
	 * @return ObjectList
	 */
	public function invoke(ObjectList $args): ObjectList {
		$result = ($this->value)($args);

		if ($result instanceof ObjectList) {
			return $result;
		}

		if ($result instanceof LuarObject) {
			return new ObjectList( [$result] );
		}

		if ($result instanceof Scope) {
			$result = $result->getReturn();
		}

		if (is_array($result)) {
			return new ObjectList( [Table::fromArray($result)] );
		}

		if (is_callable($result)) {
			return new ObjectList( [new Invokable($result)] );
		}

		return new ObjectList( [new Literal($result)] );
	}


	/**
	 * Creates an `Invokable` from a PHP function
	 *
	 * ```php
	 * $add = Invokable::fromPhpCallable(function ($a, $b) {
	 *   return $a + $b;
	 * });
	 * ```
	 *
	 * @param callable $callable
	 * @return Invokable
	 */
	public static function fromPhpCallable(callable $callable): Invokable {
		$newCallable = static function (ObjectList $objectList) use ($callable) {
			$args = array_map(
				static function (LuarObject $object) {
					return Luar::unpackLuarObject($object);
				}, $objectList->getObjects()
			);

			return $callable(...$args);
		};

		return new Invokable($newCallable);
	}

	/**
	 * @inheritDoc
	 */
	public function getType(): string {
		return 'function';
	}

	public function __toString(): string{
		return sprintf('%s: 0x%06x', $this->getType(), spl_object_id($this));
	}
}
