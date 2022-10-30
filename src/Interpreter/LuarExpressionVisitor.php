<?php
namespace Raudius\Luar\Interpreter;

use Antlr\Antlr4\Runtime\Tree\RuleNode;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Parser\Context;
use Raudius\Luar\Parser\Context\ExplistContext;

abstract class LuarExpressionVisitor extends LuarBaseVisitor {


	/**
	 * @return LuarObject[]
	 */
	public function visitExplist(ExplistContext $context): array {
		// todo check instanceof visit === LuarObject
		$exps = $context->exp();
		if (is_array($exps)) {
			return array_map([$this, 'visitExp'], $exps);
		}

		if ($exps instanceof ExplistContext) {
			return [$this->visitExp($exps)];
		}

		return [];
	}

	public function visitExpNull(Context\ExpNullContext $context): LuarObject {
		return new Literal(null);
	}

	public function visitExpBool(Context\ExpBoolContext $context): LuarObject {
		return new Literal($context->getText() === 'true');
	}

	public function visitExpNumber(Context\ExpNumberContext $context) {
		$number = $context->number();
		if ($number && $int = $number->INT()) {
			return new Literal( (int) $int->getText() );
		}

		if ($float = $number->FLOAT()) {
			return new Literal((float) $float->getText());
		}

		throw new RuntimeException('Could not parse number expression', $context);
	}

	public function visitExpString(Context\ExpStringContext $context): LuarObject {
		$string = $context->string();
		if (!$string) {
			throw new RuntimeException('Could not parse string expression', $context);
		}

		$singleline = $string->NORMALSTRING() ?? $string->CHARSTRING();
		if ($singleline) {
			return new Literal(substr($string->getText(), 1, -1));
		}

		$offset = 0;
		foreach (str_split($string->getText()) as $c) {
			if ($c !== '[' && $c !== '=') {
				break;
			}
			$offset++;
		}
		return new Literal(substr($string->getText(), $offset, -$offset));
	}


	public function visitPrefixexp(Context\PrefixexpContext $context): LuarObject {
		$varOrExp = $this->visit($context->varOrExp());

		if (!$varOrExp instanceof LuarObject) {
			var_dump($varOrExp);
			throw new RuntimeException('Unexpected resolution of varOrExp context ' , $context);
		}

		if ($varOrExp instanceof Reference) {
			$varOrExp = $varOrExp->getObject();
		}

		$nameAndArgsContexts = $context->nameAndArgs();
		if (!$nameAndArgsContexts) {
			return $varOrExp;
		}

		$nameAndArgsContexts = is_array($nameAndArgsContexts) ? $nameAndArgsContexts : [$nameAndArgsContexts];
		return $this->applyNameAndArgs($varOrExp, $nameAndArgsContexts);
	}

	public function visitTableconstructor(Context\TableconstructorContext $context): Table {
		$fieldList = $this->visitFieldlist($context->fieldlist());
		return new Table(null, $fieldList);
	}

	public function visitFieldlist(Context\FieldlistContext $context): array {
		$fieldContexts = $context->field();
		if (!$fieldContexts) {
			return [];
		}

		$fieldContexts = is_array($fieldContexts) ? $fieldContexts : [$fieldContexts];
		$fields = [];
		$n = 1;
		foreach ($fieldContexts as $fieldContext) {
			[$key, $value] = $this->visitField($fieldContext);
			$fields[$key ?? $n++] = $value;
		}

		return $fields;
	}


	public function visitField(Context\FieldContext $context) {
		$expContexts = $context->exp();
		/** @var Context\ExpContext[] $expContexts */
		$expContexts = is_array($expContexts) ? $expContexts : [$expContexts];

		if (count($expContexts) === 2) {
			$key = $this->visitExp($expContexts[0]);
		} else {
			$key = $context->NAME() ? $context->NAME()->getText() : null;
		}

		$value = $this->visitExp(end($expContexts));
		return [$key, $value];
	}

	public function visitExpComparison(Context\ExpComparisonContext $context): LuarObject {
		$expContexts = $context->exp();
		$v1 = $this->visitExp($expContexts[0])->getValue();
		$v2 = $this->visitExp($expContexts[1])->getValue();

		switch ($context->operatorComparison()->getText()) {
			case '<':  return new Literal($v1 < $v2);
			case '>':  return new Literal($v1 > $v2);
			case '<=': return new Literal($v1 <= $v2);
			case '>=': return new Literal($v1 >= $v2);
			case '==': return new Literal($v1 === $v2); // TODO: Lua vs PHP comparison
			case '~=': return new Literal($v1 !== $v2);
		}

		throw new RuntimeException('Could not evaluate the comparison expression', $context);
	}

	public function visitExpAddSub(Context\ExpAddSubContext $context): LuarObject {
		$expContexts = $context->exp();
		$v1 = $this->visitExp($expContexts[0])->getValue();
		$v2 = $this->visitExp($expContexts[1])->getValue();

		switch ($context->operatorAddSub()->getText()) {
			case '+':  return new Literal($v1 + $v2);
			case '-':  return new Literal($v1 - $v2);
		}

		throw new RuntimeException('Could not evaluate the add/sub expression', $context);
	}

	public function shouldVisitNextChild(RuleNode $node, $currentResult): bool {
		return $this->interpreter->getScope()->getExit() === null;
	}
}