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
