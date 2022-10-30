<?php
namespace Raudius\Luar;

include_once __DIR__ . '/vendor/autoload.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Raudius\Luar\Interpreter\Interpreter;
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

$scope = new Scope(null, $builtins);

$lexer = new LuaLexer($input);
$tokens = new CommonTokenStream($lexer);
$parser = new LuaParser($tokens);
$parser->addErrorListener(new DiagnosticErrorListener());
$parser->setBuildParseTree(true);
$tree = $parser->chunk();


$interpreter = new Interpreter();
try {
	(new LuarStatementVisitor($interpreter))->visit($tree);
} catch (RuntimeException $e) {
	echo $e->getMessage() . PHP_EOL . PHP_EOL;
	echo $e->getContext() ? $e->getContext()->getText() : null;
	echo PHP_EOL;
	echo PHP_EOL;
}

var_dump($interpreter->getRoot());
