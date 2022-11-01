<?php
namespace Raudius\Luar\Interpreter;

use Raudius\Luar\Interpreter\LuarObject\ObjectList;
use Raudius\Luar\Interpreter\LuarObject\Literal;
use Raudius\Luar\Interpreter\LuarObject\LuarObject;
use Raudius\Luar\Interpreter\LuarObject\Reference;
use Raudius\Luar\Interpreter\LuarObject\Table;
use Raudius\Luar\Parser\Context;
use Raudius\Luar\Parser\Context\ExplistContext;

abstract class LuarExpressionVisitor extends LuarBaseVisitor {
	public function visitExplist(ExplistContext $context): ObjectList {
		$exps = $context->exp();

		$expressions = [];
		if (is_array($exps)) {
			$expressions = array_map([$this, 'visitExp'], $exps);
		}

		if ($exps instanceof ExplistContext) {
			$expressions = [$this->visitExp($exps)];
		}

		return new ObjectList($expressions);
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
		return $this->evalArgumentedExp($context->varOrExp(), $context->nameAndArgs());
	}

	public function visitFunctiondef(Context\FunctiondefContext $context): LuarObject {
		return $this->visitFuncbody($context->funcbody())
			->asInvokable($this->interpreter);
	}

	public function visitTableconstructor(Context\TableconstructorContext $context): Table {
		$fieldList = $context->fieldlist() ? $this->visitFieldlist($context->fieldlist()) : [];
		return Table::fromArray($fieldList);
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
			/** @var LuarObject $object */
			[$key, $object] = $this->visitField($fieldContext);

			if ($key === null && $object instanceof ObjectList) {
				$objects = $object->getObjects();
				foreach ($objects as $object) {
					$fields[$n++] = $object->getValue();
				}
			} else {
				$key = $key ?? $n++;
				$fields[$key] = $object->getValue();
			}
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

		$object = $this->visitExp(end($expContexts));
		return [$key, $object];
	}

	public function visitExpUnary(Context\ExpUnaryContext $context): LuarObject {
		$v = $this->visitExp($context->exp(0))->getValue();
		switch ($context->operatorUnary()->getText()) {
			case '-':    return new Literal(-$v);
			case '~':    return new Literal(~$v);
			case 'not':  return new Literal(!$v);
			case '#': {
				if (is_string($v)) {
					return new Literal(strlen($v));
				}
				if (is_countable($v)) {
					return new Literal (count($v));
				}
				throw new RuntimeException('Could not get length of non-countable value.', $context);
			}
		}

		throw new RuntimeException('Could not evaluate the unary expression', $context);
	}

	public function visitExpComparison(Context\ExpComparisonContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

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
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		switch ($context->operatorAddSub()->getText()) {
			case '+':  return new Literal($v1 + $v2);
			case '-':  return new Literal($v1 - $v2);
		}

		throw new RuntimeException('Could not evaluate the add/sub expression', $context);
	}

	public function visitExpMulDivMod(Context\ExpMulDivModContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		switch ($context->operatorMulDivMod()->getText()) {
			case '*':  return new Literal($v1 * $v2);
			case '/':  return new Literal($v1 / $v2);
			case '%':  return new Literal($v1 % $v2);
			case '//':  return new Literal(intdiv($v1, $v2));
		}

		throw new RuntimeException('Could not evaluate the add/sub expression', $context);
	}

	public function visitExpPower(Context\ExpPowerContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		if (!is_numeric($v1) || !is_numeric($v2)) {
			throw new RuntimeException('Exponent calculations must be performed on numeric values', $context);
		}

		return new Literal($v1 ** $v2);
	}

	public function visitExpOr(Context\ExpOrContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		if ($v1) return new Literal($v1);
		$v2 = $this->visitExp($context->exp(1))->getValue();
		if ($v2) return new Literal($v2);
		return new Literal(false);
	}

	public function visitExpAnd(Context\ExpAndContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		if (!$v1) return new Literal(false);
		$v2 = $this->visitExp($context->exp(1))->getValue();
		if (!$v2) return new Literal(false);
		return new Literal(true);
	}

	public function visitExpConcat(Context\ExpConcatContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();
		return new Literal($v1 . $v2);
	}

	public function visitExpBitwise(Context\ExpBitwiseContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		switch ($context->operatorBitwise()->getText()) {
			case '&':  return new Literal($v1 & $v2);
			case '|':  return new Literal($v1 | $v2);
			case '~': return new Literal($v1 ^ $v2);
			case '<<': return new Literal($v1 >> $v2);
			case '>>': return new Literal($v1 << $v2);
		}

		throw new RuntimeException('Could not evaluate the bitwise expression', $context);
	}

	public function visitExpElipsis(Context\ExpElipsisContext $context): LuarObject {
		return new Reference($this->interpreter->getScope(), Reference::VAR_INTERNAL_ELIPSIS);
	}
}
