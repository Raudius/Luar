<?php
namespace Raudius\Luar;

include_once __DIR__ . '/vendor/autoload.php';

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Interpreter\RuntimeException;

ini_set('xdebug.max_nesting_level', -1);

/*
$input = InputStream::fromPath(__DIR__ . '/example.lua');

$builtins = [
	'print' => static function ($in) {
		echo $in . PHP_EOL;
	}
];

$print = static function ($in) {
	echo $in . PHP_EOL;
};

try {
	$luar = new Luar();
	$luar->assign('print', $print);
	$luar->eval(file_get_contents(__DIR__ . '/example.lua'));
} catch (RuntimeException $e) {
	echo $e->getMessage() . PHP_EOL . PHP_EOL;
	echo $e->getContext() ? $e->getContext()->getText() : null;
	echo PHP_EOL;
	echo PHP_EOL;
}

echo (json_encode($luar->getGlobals()) ?: 'JSON encode error') . PHP_EOL;
*/

$testLuar = new Luar();
$testLuar->assign('collectgarbage', static function () { });

$testLuar->assign('math', [
	'sin' => function ($n) { return sin($n); },
	'max' => Invokable::fromPhpCallable(function ($v, ...$vals) {
		return max($v, ...$vals);
	})
]);

$testLuar->assign('table', [
	'unpack' => Invokable::fromPhpCallable(function ($t, $i=1, $j=null) {
		if ($t instanceof ObjectList) {
			if ($t->getObject(0) instanceof Table) {
				$t = $t->getObject(0);
			}
		}

		if ($t instanceof Table) {
			$t = $t->getValue();
		}

		$vals = [];

		// echo PHP_EOL . PHP_EOL . PHP_EOL; var_dump([ 'i' => $i, 'j' => $j ]);
		while (isset($t[$i]) && ($j === null || $i <= $j)) {
			$vals[] = Luar::makeLuarObject($t[$i]);
			$i++;
		}

		return new ObjectList($vals);
	}),
]);

$testLuar->assign('printscope',  function () use ($testLuar) { $testLuar->printScope(); });

try {
	$testLuar->eval(file_get_contents(__DIR__ . '/simple.lua'));
	//$testLuar->eval(file_get_contents(__DIR__ . '/vararg.lua'));
	//$testLuar->eval(file_get_contents(__DIR__ . '/closure.lua'));
	//$testLuar->eval(file_get_contents(__DIR__ . '/locals.lua'));
} catch (RuntimeException $e) {
	echo $e->getMessage() . PHP_EOL . PHP_EOL;
	echo $e->getTraceAsString() . PHP_EOL;

	echo "Line: " . $e->getContext()->getStart()->getLine() . PHP_EOL;
	echo $e->getContext() ? $e->getContext()->getText() : null;
	echo PHP_EOL;
	echo PHP_EOL;
} catch (\Exception $e) {
	echo $e->getMessage() . PHP_EOL;
	echo $e->getTraceAsString() . PHP_EOL;
}

echo "Done :)\n";

echo "MAX MEMORY USAGE = " . ini_get('memory_limit'). PHP_EOL;
echo "PEAK MEMORY USAGE = " . memory_get_peak_usage() . PHP_EOL;

