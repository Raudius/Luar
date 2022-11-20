<?php
namespace Raudius\Luar;

include_once __DIR__ . '/vendor/autoload.php';

use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\RuntimeException;

ini_set('xdebug.max_nesting_level', -1);

$testLuar = new Luar();
$testLuar->assign('collectgarbage', static function () { });
$testLuar->assign('printscope',  function () use ($testLuar) { $testLuar->printScope(); });

$testLuar->assign('load', new Invokable(function(ObjectList $ol) use ($testLuar) {
	$program = (string) $ol->getObject(0)->getValue();
	return new Invokable(function (ObjectList $ol) use ($program) {
		$luar = new Luar();
		$luar->assign(Reference::VAR_INTERNAL_ELIPSIS, $ol);
		return $luar->eval($program);
	});
}));

$testLuar->assign('_soft', true);
$testLuar->assign('_port', true);
$testLuar->assign('_nomsg', true);

try {
	$testLuar->eval(file_get_contents(__DIR__ . '/tests/lua/simple.lua'));
	$testLuar->eval(file_get_contents(__DIR__ . '/tests/lua/vararg.lua'));
} catch (RuntimeException $e) {
	echo $e->getMessage() . PHP_EOL . PHP_EOL;
	echo $e->getTraceAsString() .PHP_EOL . PHP_EOL;

	echo $e->getPrevious() ? $e->getPrevious()->getTraceAsString() : PHP_EOL;


	foreach ($e->getContextTrace() as $context) {
		echo "Line: " . $context['line'] . PHP_EOL;
		echo $context['code'] . PHP_EOL;
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

