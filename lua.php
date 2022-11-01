<?php
namespace Raudius\Luar;

include_once __DIR__ . '/vendor/autoload.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Raudius\Luar\Interpreter\Interpreter;
use Raudius\Luar\Interpreter\LuarObject\Invokable;
use Raudius\Luar\Interpreter\LuarStatementVisitor;
use Raudius\Luar\Interpreter\RuntimeException;
use Raudius\Luar\Interpreter\Scope;
use Raudius\Luar\Parser\LuaLexer;
use Raudius\Luar\Parser\LuaParser;

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
$testLuar->assign('print', static function ($in) {
	if (is_array($in)) {
		$in = json_encode($in) ?: 'Array';
	}
	if (is_callable($in)) {
		$in = "Callable";
	}
	echo $in . PHP_EOL;
});
$testLuar->assign('assert', static function ($assertion) {
	if (!$assertion) {
		throw new RuntimeException('Assert error');
	}
});
$testLuar->assign('collectgarbage', static function () { });

$testLuar->assign('gettype', static function ($o) {
	return is_object($o) ? get_class($o) : gettype($o);
});

$testLuar->assign('math', [
	'sin' => function ($n) { return sin($n); }
]);

$testLuar->assign('printscope',  function () use ($testLuar) { $testLuar->printScope(); });

try {
	$testLuar->eval(file_get_contents(__DIR__ . '/closure.lua'));
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
