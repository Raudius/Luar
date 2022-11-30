<?php
namespace Raudius\Luar\Library;

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarRuntimeException;
use Throwable;

/**
 * This abstract class can be extended to define a "library" of functions which can be injected into a Luar instance, via `Luar->addLibrary()` or `Luar->addCoreLibrary()`.
 *
 * Libraries are currently the only way to set meta methods to non-table types in Luar, via `getMetaMethods()`.
 *
 * You can find some implementations in [Luar/tree/main/src/Library](https://github.com/Raudius/Luar/tree/main/src/Library)
 */
abstract class Library {
	/**
	 * Returns an array of `Invokable` functions to be assigned to the global scope. The names of the arguments are defined via the keys.
	 *
	 * Example:
	 * ```php
	 * public function getFunctions(): array {
	 *   returns [
	 *     'foo' => $this->foo(),
	 *     'bar' => new Invokable(function (ObjectList $ol) { ... }),
	 *     'test' => Invokable::fromPhpCallable(function($arg1, $arg2, $arg3) { ... }),
	 *   ];
	 * }
	 * ```
	 *
	 * @return Invokable[]
	 */
	abstract public function getFunctions(): array;

	/**
	 * Returns an array of arrays of `Invokable` functions, to be set as meta-methods.
	 * The type for which the meta-methods should be defined is determined by the key.
	 *
	 * Example:
	 * ```php
	 * [
	 *   'string' => [
	 *     'isFoo' => Invokable::fromPhpCallable(function ($string) {
	 *       return $string === 'foo';
	 *     })
	 *   ]
	 * ]
	 * ```
	 *
	 * This example creates the `isFoo` meta-method for the `string` type.
	 * ```lua
	 * local str1 = 'foo'
	 * local str2 = 'bar'
	 *
	 * print(str1::isFoo()) -- true
	 * print(str2::isFoo()) -- false
	 * ```
	 *
	 * @return array
	 */
	abstract public function getMetaMethods(): array;

	/**
	 * Determines how the functions will be accessed.
	 * For example if we have a library with the name `alice` and a function `do()` the function will be accessible via `alice.do()`
	 *
	 * @return string
	 */
	abstract public function getName(): string;

	/**
	 * Helper function for validating `Invokable` parameters.
	 *
	 * If the validation fails, an exception is raised.
	 * If the validation succeeds, the corresponding `LuarObject` is returned.
	 *
	 * @param ObjectList $objectList - object list containing the parameters
	 * @param array $types - array of allowed Lua types (e.g. `['table', 'nil']`)
	 * @param int $n - index (starting from 0) of the parameter, the function validates the types
	 * @return LuarObject
	 * @throws LuarRuntimeException
	 */
	protected function validateObjectListParameter(ObjectList $objectList, array $types, int $n): LuarObject {
		return $this->validateType($objectList->getObject($n), $types, $n + 1);
	}

	/**
	 * Validates the type of a LuarObject, similarly to `validateObjectListParameter()`
	 *
	 * @param LuarObject $object - object to validate
	 * @param array $types - array of allowed Lua types (e.g. `['table', 'nil']`)
	 * @param int $argn - 1-indexed, position of the argument, used to return a standardised error message.
	 * @return LuarObject
	 * @throws LuarRuntimeException
	 */
	protected function validateType(LuarObject $object, array $types, int $argn): LuarObject {
		$objType = $object->getType();
		if (!in_array($objType, $types, true)) {
			$typesString = implode('|', $types);
			throw new LuarRuntimeException("Bad argument, in position #{$argn} expected $typesString, got $objType"); // TODO: replace with specialised BadArgument exception?
		}

		return $object;
	}

	/**
	 * Helper magic-methods can be useful in `getFunctions()` for generating placeholder code.
	 *
	 * Functions generated via this method will always raise an error in runtime:
	 * > `Unimplemented function in '<function-name>' library: '<lib-name>'`
	 */
	public function __call($name, $arguments) {
		return Invokable::fromPhpCallable(function () use ($name) {
			throw new LuarRuntimeException("Unimplemented function in '{$this->getName()}' library: '$name'");
		});
	}

	/**
	 * Helper function which can generate an `Invokable` from a string-reference to a PHP function.
	 * The second argument determines how many arguments are expected for the function, and will truncate any excess arguments passed in Lua.
	 *
	 * This can be a quick and easy way to wrap PHP functions, but is generally not recommended as you cannot properly validate the parameters.
	 *
	 * For example:
	 * ```
	 * $var_dump = $this->fromPhpCallable('var_dump')
	 * $strtolower = $this->fromPhpCallable('strtolower', 1)
	 * ```
	 *
	 * @param string $function - string reference to the PHP function
	 * @param int|null $nArgs - Number of arguments expected (`NULL` for any)
	 * @return Invokable
	 */
	protected function fromPhpFunction(string $function, int $nArgs=null): Invokable {
		return Invokable::fromPhpCallable(
			static function (...$args) use ($function, $nArgs) {
				if ($nArgs !== null) {
					$args = array_slice($args, 0, $nArgs);
				}
				try {
					$result = $function(...$args);
					if (is_float($result) && floor($result) === $result && $result < PHP_INT_MAX && $result > PHP_INT_MIN) {
						$result = (int) $result;
					}

					return $result;
				} catch (Throwable $t) {
					throw new LuarRuntimeException($t->getMessage());
				}
			}
		);
	}
}
