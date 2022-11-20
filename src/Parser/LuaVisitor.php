<?php

/*
 * Generated from Lua.g4 by ANTLR 4.9.3
 */

namespace Raudius\Luar\Parser;

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see LuaParser}.
 */
interface LuaVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see LuaParser::chunk()}.
	 *
	 * @param Context\ChunkContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitChunk(Context\ChunkContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::block()}.
	 *
	 * @param Context\BlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBlock(Context\BlockContext $context);

	/**
	 * Visit a parse tree produced by the `semicolon` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\SemicolonContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSemicolon(Context\SemicolonContext $context);

	/**
	 * Visit a parse tree produced by the `statAssign` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatAssignContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatAssign(Context\StatAssignContext $context);

	/**
	 * Visit a parse tree produced by the `statFunctionCall` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatFunctionCallContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatFunctionCall(Context\StatFunctionCallContext $context);

	/**
	 * Visit a parse tree produced by the `statBreak` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatBreakContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatBreak(Context\StatBreakContext $context);

	/**
	 * Visit a parse tree produced by the `statDo` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatDoContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatDo(Context\StatDoContext $context);

	/**
	 * Visit a parse tree produced by the `statWhile` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatWhileContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatWhile(Context\StatWhileContext $context);

	/**
	 * Visit a parse tree produced by the `statRepeat` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatRepeatContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatRepeat(Context\StatRepeatContext $context);

	/**
	 * Visit a parse tree produced by the `statIf` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatIfContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatIf(Context\StatIfContext $context);

	/**
	 * Visit a parse tree produced by the `statFor` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatForContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatFor(Context\StatForContext $context);

	/**
	 * Visit a parse tree produced by the `statForEach` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatForEachContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatForEach(Context\StatForEachContext $context);

	/**
	 * Visit a parse tree produced by the `statFunctionDeclare` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatFunctionDeclareContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatFunctionDeclare(Context\StatFunctionDeclareContext $context);

	/**
	 * Visit a parse tree produced by the `statLocalFunction` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatLocalFunctionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatLocalFunction(Context\StatLocalFunctionContext $context);

	/**
	 * Visit a parse tree produced by the `statLocalVariable` labeled alternative
	 * in {@see LuaParser::stat()}.
	 *
	 * @param Context\StatLocalVariableContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatLocalVariable(Context\StatLocalVariableContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::laststat()}.
	 *
	 * @param Context\LaststatContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLaststat(Context\LaststatContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::funcname()}.
	 *
	 * @param Context\FuncnameContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncname(Context\FuncnameContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::funcname_method()}.
	 *
	 * @param Context\Funcname_methodContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncname_method(Context\Funcname_methodContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::varlist()}.
	 *
	 * @param Context\VarlistContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarlist(Context\VarlistContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::namelist()}.
	 *
	 * @param Context\NamelistContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNamelist(Context\NamelistContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::explist()}.
	 *
	 * @param Context\ExplistContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExplist(Context\ExplistContext $context);

	/**
	 * Visit a parse tree produced by the `expNumber` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpNumberContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpNumber(Context\ExpNumberContext $context);

	/**
	 * Visit a parse tree produced by the `expBool` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpBoolContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpBool(Context\ExpBoolContext $context);

	/**
	 * Visit a parse tree produced by the `expComparison` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpComparisonContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpComparison(Context\ExpComparisonContext $context);

	/**
	 * Visit a parse tree produced by the `expBitwise` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpBitwiseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpBitwise(Context\ExpBitwiseContext $context);

	/**
	 * Visit a parse tree produced by the `expOr` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpOrContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpOr(Context\ExpOrContext $context);

	/**
	 * Visit a parse tree produced by the `expMulDivMod` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpMulDivModContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpMulDivMod(Context\ExpMulDivModContext $context);

	/**
	 * Visit a parse tree produced by the `expNull` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpNullContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpNull(Context\ExpNullContext $context);

	/**
	 * Visit a parse tree produced by the `expString` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpStringContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpString(Context\ExpStringContext $context);

	/**
	 * Visit a parse tree produced by the `expPrefix` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpPrefixContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpPrefix(Context\ExpPrefixContext $context);

	/**
	 * Visit a parse tree produced by the `expUnary` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpUnaryContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpUnary(Context\ExpUnaryContext $context);

	/**
	 * Visit a parse tree produced by the `expAnd` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpAndContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpAnd(Context\ExpAndContext $context);

	/**
	 * Visit a parse tree produced by the `expElipsis` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpElipsisContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpElipsis(Context\ExpElipsisContext $context);

	/**
	 * Visit a parse tree produced by the `expFunction` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpFunctionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpFunction(Context\ExpFunctionContext $context);

	/**
	 * Visit a parse tree produced by the `expPower` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpPowerContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpPower(Context\ExpPowerContext $context);

	/**
	 * Visit a parse tree produced by the `expConcat` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpConcatContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpConcat(Context\ExpConcatContext $context);

	/**
	 * Visit a parse tree produced by the `expAddSub` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpAddSubContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpAddSub(Context\ExpAddSubContext $context);

	/**
	 * Visit a parse tree produced by the `expTable` labeled alternative
	 * in {@see LuaParser::exp()}.
	 *
	 * @param Context\ExpTableContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpTable(Context\ExpTableContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::prefixexp()}.
	 *
	 * @param Context\PrefixexpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPrefixexp(Context\PrefixexpContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::functioncall()}.
	 *
	 * @param Context\FunctioncallContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctioncall(Context\FunctioncallContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::varOrExp()}.
	 *
	 * @param Context\VarOrExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarOrExp(Context\VarOrExpContext $context);

	/**
	 * Visit a parse tree produced by the `nameVariable` labeled alternative
	 * in {@see LuaParser::variable()}.
	 *
	 * @param Context\NameVariableContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNameVariable(Context\NameVariableContext $context);

	/**
	 * Visit a parse tree produced by the `expVariable` labeled alternative
	 * in {@see LuaParser::variable()}.
	 *
	 * @param Context\ExpVariableContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpVariable(Context\ExpVariableContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::varSuffix()}.
	 *
	 * @param Context\VarSuffixContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarSuffix(Context\VarSuffixContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::nameAndArgs()}.
	 *
	 * @param Context\NameAndArgsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNameAndArgs(Context\NameAndArgsContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::args()}.
	 *
	 * @param Context\ArgsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArgs(Context\ArgsContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::functiondef()}.
	 *
	 * @param Context\FunctiondefContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctiondef(Context\FunctiondefContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::funcbody()}.
	 *
	 * @param Context\FuncbodyContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncbody(Context\FuncbodyContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::parlist()}.
	 *
	 * @param Context\ParlistContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParlist(Context\ParlistContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::elipsis()}.
	 *
	 * @param Context\ElipsisContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitElipsis(Context\ElipsisContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::tableconstructor()}.
	 *
	 * @param Context\TableconstructorContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitTableconstructor(Context\TableconstructorContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::fieldlist()}.
	 *
	 * @param Context\FieldlistContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFieldlist(Context\FieldlistContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::field()}.
	 *
	 * @param Context\FieldContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitField(Context\FieldContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::fieldsep()}.
	 *
	 * @param Context\FieldsepContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFieldsep(Context\FieldsepContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorOr()}.
	 *
	 * @param Context\OperatorOrContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorOr(Context\OperatorOrContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorAnd()}.
	 *
	 * @param Context\OperatorAndContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorAnd(Context\OperatorAndContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorComparison()}.
	 *
	 * @param Context\OperatorComparisonContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorComparison(Context\OperatorComparisonContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorStrcat()}.
	 *
	 * @param Context\OperatorStrcatContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorStrcat(Context\OperatorStrcatContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorAddSub()}.
	 *
	 * @param Context\OperatorAddSubContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorAddSub(Context\OperatorAddSubContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorMulDivMod()}.
	 *
	 * @param Context\OperatorMulDivModContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorMulDivMod(Context\OperatorMulDivModContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorBitwise()}.
	 *
	 * @param Context\OperatorBitwiseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorBitwise(Context\OperatorBitwiseContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorUnary()}.
	 *
	 * @param Context\OperatorUnaryContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorUnary(Context\OperatorUnaryContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::operatorPower()}.
	 *
	 * @param Context\OperatorPowerContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperatorPower(Context\OperatorPowerContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::number()}.
	 *
	 * @param Context\NumberContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNumber(Context\NumberContext $context);

	/**
	 * Visit a parse tree produced by {@see LuaParser::string()}.
	 *
	 * @param Context\StringContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitString(Context\StringContext $context);
}