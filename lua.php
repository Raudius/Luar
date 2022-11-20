<?php
namespace Raudius\Luar;

include_once __DIR__ . '/vendor/autoload.php';

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\RuntimeException;

ini_set('xdebug.max_nesting_level', -1);

$testLuar = new Luar();
$testLuar->assign('collectgarbage', static function () { });
$testLuar->assign('printscope',  function () use ($testLuar) { $testLuar->printScope(); });

$testLuar->assign('load', new Invokable(function(ObjectList $ol) use ($testLuar) {
	$program = (string) $ol->getObject(0)->getValue();
	return Invokable::fromPhpCallable(function () use ($testLuar, $program) {
		return $testLuar->eval($program);
	});
}));

$testLuar->assign('_soft', true);
$testLuar->assign('_port', true);
$testLuar->assign('_nomsg', true);

try {
	$testLuar->eval(file_get_contents(__DIR__ . '/simple.lua'));
	$testLuar->eval(file_get_contents(__DIR__ . '/vararg.lua'));
	$testLuar->eval(file_get_contents(__DIR__ . '/closure.lua'));
	$testLuar->eval(file_get_contents(__DIR__ . '/locals.lua'));
	$testLuar->eval(file_get_contents(__DIR__ . '/math.lua'));
} catch (RuntimeException $e) {
	echo $e->getMessage() . PHP_EOL . PHP_EOL;
	echo $e->getTraceAsString() .PHP_EOL . PHP_EOL;

	echo $e->getPrevious() ? $e->getPrevious()->getTraceAsString() : PHP_EOL;


	foreach ($e->getContextTrace() as $context) {
		echo "Line: " . $context->getStart()->getLine() . PHP_EOL;
		echo $context->getText();
		echo PHP_EOL;
	}
	echo PHP_EOL;
	echo PHP_EOL;
} catch (\Exception $e) {
	echo $e->getMessage() . PHP_EOL;
}

echo "Done :)\n";

echo "MAX MEMORY USAGE = " . ini_get('memory_limit'). PHP_EOL;
echo "PEAK MEMORY USAGE = " . memory_get_peak_usage() . PHP_EOL;

