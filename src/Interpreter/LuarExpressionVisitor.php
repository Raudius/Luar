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
		$numberText = $context->getText();
		if (is_numeric($numberText)) {
			return new Literal($numberText + 0);
		}

		throw new LuarRuntimeException('Could not parse number expression', $context);
	}

	public function visitString(Context\StringContext $context): LuarObject {
		$singleline = $context->NORMALSTRING() ?? $context->CHARSTRING();
		if ($singleline) {
			$str = substr($context->getText(), 1, -1);
		} else {
			$offset = 0;
			foreach (str_split($context->getText()) as $c) { // TODO: optmisiation? without str_split?
				if ($c !== '[' && $c !== '=') {
					break;
				}
				$offset++;
			}
			$str = substr($context->getText(), $offset, -$offset);
		}

		preg_match_all('/\\\\(\\d{1,3})/', $str, $matches, PREG_OFFSET_CAPTURE);
		$offset = -1; // -1 to account for backslash

		foreach ($matches[1] as $match) {
			$start = $match[1] + $offset;
			$len = strlen($match[0]) + 1; // +1 to account for backslash, outside of capture

			$chr = $match[0] + 0;
			if (!is_numeric($match[0]) || $chr > 255) {
				throw new LuarRuntimeException('Unknown escape character');
			}

			$char = chr($chr);
			$str = substr_replace($str, $char, $start, $len);
			$offset -= $len - 1; // -1 because 1 is the length of $char
		}

		$str = stripcslashes($str);
		return new Literal($str);
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
		return new Table(null, $fieldList);
	}

	/**
	 * @return LuarObject[]
	 */
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
			if ($object instanceof Reference) {
				$object = $object->getObject();
			}

			if ($key === null && $object instanceof ObjectList) {
				$count = $object->count();
				for ($i=0; $i<$count; $i++) {
					$fields[$n++] = $object->getObject($i);
				}
			} else {
				$key = $key ?? $n++;
				$fields[$key] = $object;
			}
		}
		return $fields;
	}

	public function visitField(Context\FieldContext $context) {
		$expContexts = $context->exp();
		/** @var Context\ExpContext[] $expContexts */
		$expContexts = is_array($expContexts) ? $expContexts : [$expContexts];

		if (count($expContexts) === 2) {
			$key = $this->visitExp($expContexts[0])->getValue();
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
				throw new LuarRuntimeException('Could not get length of non-countable value.', $context);
			}
		}

		throw new LuarRuntimeException('Could not evaluate the unary expression', $context);
	}

	public function visitExpComparison(Context\ExpComparisonContext $context): LuarObject {
		$op = $context->operatorComparison()->getText();
		$o1 = $this->visitExp($context->exp(0));
		$o2 = $this->visitExp($context->exp(1));
		$v1 = $o1->getValue();
		$v2 = $o2->getValue();

		if (
			(is_float($v1) && is_int($v2))
			|| (is_float($v2) && is_int($v1))
		) {
			$v1 = (float) $v1;
			$v2 = (float) $v2;
		}

		switch ($op) {
			case '==': return new Literal($v1 === $v2); // TODO: Lua vs PHP comparison
			case '~=': return new Literal($v1 !== $v2);
		}

		if ($o1->getType() !== $o2->getType()) {
			throw new LuarRuntimeException("attempt to compare {$o1->getType()} with {$o2->getType()}", $context);
		}

		switch ($op) {
			case '<':  return new Literal(($v1 <=> $v2) === -1);
			case '>':  return new Literal(($v1 <=> $v2) === 1);
			case '<=': return new Literal(($v1 <=> $v2) <= 0);
			case '>=': return new Literal(($v1 <=> $v2) >= 0);
		}

		throw new LuarRuntimeException('Could not evaluate the comparison expression', $context);
	}

	public function visitExpAddSub(Context\ExpAddSubContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		if (!is_numeric($v1)) {
			$value = is_scalar($v1) ? (string) $v1 : gettype($v1);
			throw new LuarRuntimeException('Cannot perform arithmetic operation on non-number: ' . $value);
		}
		if(!is_numeric($v2)) {
			$value = is_scalar($v2) ? (string) $v2 : gettype($v2);
			throw new LuarRuntimeException('Cannot perform arithmetic operation on non-number: ' . $value);
		}

		switch ($context->operatorAddSub()->getText()) {
			case '+':  return new Literal($v1 + $v2);
			case '-':  return new Literal($v1 - $v2);
		}

		throw new LuarRuntimeException('Could not evaluate the add/sub expression', $context);
	}

	public function visitExpMulDivMod(Context\ExpMulDivModContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		if (!is_numeric($v1)) {
			$value = is_scalar($v1) ? (string) $v1 : gettype($v1);
			throw new LuarRuntimeException('Cannot perform arithmetic operation on non-number: ' . $value);
		}
		if(!is_numeric($v2)) {
			$value = is_scalar($v2) ? (string) $v2 : gettype($v2);
			throw new LuarRuntimeException('Cannot perform arithmetic operation on non-number: ' . $value);
		}

		switch ($context->operatorMulDivMod()->getText()) {
			case '*':  return new Literal($v1 * $v2);
			case '/':  return new Literal($v1 / $v2);
			case '%':  return $this->mod($v1, $v2);
			case '//':  return new Literal(floor($v1 / $v2));
		}

		throw new LuarRuntimeException('Could not evaluate the add/sub expression', $context);
	}

	public function visitExpPower(Context\ExpPowerContext $context): LuarObject {
		$v1 = $this->visitExp($context->exp(0))->getValue();
		$v2 = $this->visitExp($context->exp(1))->getValue();

		if (!is_numeric($v1) || !is_numeric($v2)) {
			throw new LuarRuntimeException('Exponent calculations must be performed on numeric values', $context);
		}

		return new Literal($v1 ** $v2);
	}

	public function visitExpOr(Context\ExpOrContext $context): LuarObject {
		$o1 = $this->visitExp($context->exp(0));
		if ($this->isTrue($o1->getValue())) return $o1;

		return $this->visitExp($context->exp(1));
	}

	public function visitExpAnd(Context\ExpAndContext $context): LuarObject {
		$o1 = $this->visitExp($context->exp(0));
		if (!$this->isTrue($o1->getValue())) return $o1;

		return $this->visitExp($context->exp(1));
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
			case '<<': return new Literal($v1 << $v2);
			case '>>': return new Literal($v1 >> $v2);
		}

		throw new LuarRuntimeException('Could not evaluate the bitwise expression', $context);
	}

	public function visitExpElipsis(Context\ExpElipsisContext $context): LuarObject {
		return new Reference($this->interpreter->getScope(), Reference::VAR_INTERNAL_ELIPSIS);
	}
}
