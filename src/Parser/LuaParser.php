<?php

/*
 * Generated from Lua.g4 by ANTLR 4.13.2
 */

namespace Raudius\Luar\Parser {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class LuaParser extends Parser
	{
		public const T__0 = 1, T__1 = 2, T__2 = 3, T__3 = 4, T__4 = 5, T__5 = 6, 
               T__6 = 7, T__7 = 8, T__8 = 9, T__9 = 10, T__10 = 11, T__11 = 12, 
               T__12 = 13, T__13 = 14, T__14 = 15, T__15 = 16, T__16 = 17, 
               T__17 = 18, T__18 = 19, T__19 = 20, T__20 = 21, T__21 = 22, 
               T__22 = 23, T__23 = 24, T__24 = 25, T__25 = 26, T__26 = 27, 
               T__27 = 28, T__28 = 29, T__29 = 30, T__30 = 31, T__31 = 32, 
               T__32 = 33, T__33 = 34, T__34 = 35, T__35 = 36, T__36 = 37, 
               T__37 = 38, T__38 = 39, T__39 = 40, T__40 = 41, T__41 = 42, 
               T__42 = 43, T__43 = 44, T__44 = 45, T__45 = 46, T__46 = 47, 
               T__47 = 48, T__48 = 49, T__49 = 50, T__50 = 51, T__51 = 52, 
               T__52 = 53, T__53 = 54, NAME = 55, NORMALSTRING = 56, CHARSTRING = 57, 
               LONGSTRING = 58, INT = 59, FLOAT = 60, COMMENT = 61, LINE_COMMENT = 62, 
               WS = 63, SHEBANG = 64;

		public const RULE_chunk = 0, RULE_block = 1, RULE_stat = 2, RULE_laststat = 3, 
               RULE_funcname = 4, RULE_funcname_method = 5, RULE_varlist = 6, 
               RULE_namelist = 7, RULE_explist = 8, RULE_exp = 9, RULE_prefixexp = 10, 
               RULE_functioncall = 11, RULE_varOrExp = 12, RULE_variable = 13, 
               RULE_varSuffix = 14, RULE_nameAndArgs = 15, RULE_args = 16, 
               RULE_functiondef = 17, RULE_funcbody = 18, RULE_parlist = 19, 
               RULE_elipsis = 20, RULE_tableconstructor = 21, RULE_fieldlist = 22, 
               RULE_field = 23, RULE_fieldsep = 24, RULE_operatorOr = 25, 
               RULE_operatorAnd = 26, RULE_operatorComparison = 27, RULE_operatorStrcat = 28, 
               RULE_operatorAddSub = 29, RULE_operatorMulDivMod = 30, RULE_operatorBitwise = 31, 
               RULE_operatorUnary = 32, RULE_operatorPower = 33, RULE_number = 34, 
               RULE_string = 35;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'chunk', 'block', 'stat', 'laststat', 'funcname', 'funcname_method', 
			'varlist', 'namelist', 'explist', 'exp', 'prefixexp', 'functioncall', 
			'varOrExp', 'variable', 'varSuffix', 'nameAndArgs', 'args', 'functiondef', 
			'funcbody', 'parlist', 'elipsis', 'tableconstructor', 'fieldlist', 'field', 
			'fieldsep', 'operatorOr', 'operatorAnd', 'operatorComparison', 'operatorStrcat', 
			'operatorAddSub', 'operatorMulDivMod', 'operatorBitwise', 'operatorUnary', 
			'operatorPower', 'number', 'string'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "';'", "'='", "'break'", "'do'", "'end'", "'while'", "'repeat'", 
		    "'until'", "'if'", "'then'", "'elseif'", "'else'", "'for'", "','", 
		    "'in'", "'function'", "'local'", "'return'", "'continue'", "'.'", 
		    "':'", "'nil'", "'false'", "'true'", "'...'", "'('", "')'", "'['", 
		    "']'", "'{'", "'}'", "'or'", "'and'", "'<'", "'>'", "'<='", "'>='", 
		    "'~='", "'=='", "'..'", "'+'", "'-'", "'*'", "'/'", "'%'", "'//'", 
		    "'&'", "'|'", "'~'", "'<<'", "'>>'", "'not'", "'#'", "'^'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    "NAME", "NORMALSTRING", "CHARSTRING", "LONGSTRING", "INT", "FLOAT", 
		    "COMMENT", "LINE_COMMENT", "WS", "SHEBANG"
		];

		private const SERIALIZED_ATN =
			[4, 1, 64, 408, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 2, 35, 7, 35, 1, 0, 1, 0, 1, 0, 1, 1, 5, 1, 77, 
		    8, 1, 10, 1, 12, 1, 80, 9, 1, 1, 1, 3, 1, 83, 8, 1, 1, 2, 1, 2, 1, 
		    2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 
		    2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 
		    2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 5, 2, 116, 8, 2, 10, 2, 12, 
		    2, 119, 9, 2, 1, 2, 1, 2, 3, 2, 123, 8, 2, 1, 2, 1, 2, 1, 2, 1, 2, 
		    1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 3, 2, 135, 8, 2, 1, 2, 1, 2, 1, 
		    2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 
		    2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 3, 
		    2, 161, 8, 2, 3, 2, 163, 8, 2, 1, 3, 1, 3, 3, 3, 167, 8, 3, 1, 3, 
		    1, 3, 1, 3, 3, 3, 172, 8, 3, 3, 3, 174, 8, 3, 1, 4, 1, 4, 1, 4, 5, 
		    4, 179, 8, 4, 10, 4, 12, 4, 182, 9, 4, 1, 4, 3, 4, 185, 8, 4, 1, 5, 
		    1, 5, 1, 5, 1, 6, 1, 6, 1, 6, 5, 6, 193, 8, 6, 10, 6, 12, 6, 196, 
		    9, 6, 1, 7, 1, 7, 1, 7, 5, 7, 201, 8, 7, 10, 7, 12, 7, 204, 9, 7, 
		    1, 8, 1, 8, 1, 8, 5, 8, 209, 8, 8, 10, 8, 12, 8, 212, 9, 8, 1, 8, 
		    1, 8, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 
		    1, 9, 1, 9, 3, 9, 228, 8, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 
		    9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 
		    9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 
		    9, 1, 9, 1, 9, 1, 9, 5, 9, 262, 8, 9, 10, 9, 12, 9, 265, 9, 9, 1, 
		    10, 1, 10, 5, 10, 269, 8, 10, 10, 10, 12, 10, 272, 9, 10, 1, 11, 1, 
		    11, 4, 11, 276, 8, 11, 11, 11, 12, 11, 277, 1, 12, 1, 12, 1, 12, 1, 
		    12, 1, 12, 3, 12, 285, 8, 12, 1, 13, 1, 13, 5, 13, 289, 8, 13, 10, 
		    13, 12, 13, 292, 9, 13, 1, 13, 1, 13, 1, 13, 1, 13, 4, 13, 298, 8, 
		    13, 11, 13, 12, 13, 299, 3, 13, 302, 8, 13, 1, 14, 5, 14, 305, 8, 
		    14, 10, 14, 12, 14, 308, 9, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 
		    1, 14, 3, 14, 316, 8, 14, 1, 15, 1, 15, 3, 15, 320, 8, 15, 1, 15, 
		    1, 15, 1, 16, 1, 16, 3, 16, 326, 8, 16, 1, 16, 1, 16, 1, 16, 3, 16, 
		    331, 8, 16, 1, 17, 1, 17, 1, 17, 1, 18, 1, 18, 3, 18, 338, 8, 18, 
		    1, 18, 1, 18, 1, 18, 1, 18, 1, 19, 1, 19, 1, 19, 3, 19, 347, 8, 19, 
		    1, 19, 3, 19, 350, 8, 19, 1, 20, 1, 20, 1, 21, 1, 21, 3, 21, 356, 
		    8, 21, 1, 21, 1, 21, 1, 22, 1, 22, 1, 22, 1, 22, 5, 22, 364, 8, 22, 
		    10, 22, 12, 22, 367, 9, 22, 1, 22, 3, 22, 370, 8, 22, 1, 23, 1, 23, 
		    1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 3, 23, 382, 
		    8, 23, 1, 24, 1, 24, 1, 25, 1, 25, 1, 26, 1, 26, 1, 27, 1, 27, 1, 
		    28, 1, 28, 1, 29, 1, 29, 1, 30, 1, 30, 1, 31, 1, 31, 1, 32, 1, 32, 
		    1, 33, 1, 33, 1, 34, 1, 34, 1, 35, 1, 35, 1, 35, 0, 1, 18, 36, 0, 
		    2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 
		    38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 66, 68, 70, 
		    0, 9, 1, 0, 23, 24, 2, 0, 1, 1, 14, 14, 1, 0, 34, 39, 1, 0, 41, 42, 
		    1, 0, 43, 46, 1, 0, 47, 51, 3, 0, 42, 42, 49, 49, 52, 53, 1, 0, 59, 
		    60, 1, 0, 56, 58, 434, 0, 72, 1, 0, 0, 0, 2, 78, 1, 0, 0, 0, 4, 162, 
		    1, 0, 0, 0, 6, 173, 1, 0, 0, 0, 8, 175, 1, 0, 0, 0, 10, 186, 1, 0, 
		    0, 0, 12, 189, 1, 0, 0, 0, 14, 197, 1, 0, 0, 0, 16, 210, 1, 0, 0, 
		    0, 18, 227, 1, 0, 0, 0, 20, 266, 1, 0, 0, 0, 22, 273, 1, 0, 0, 0, 
		    24, 284, 1, 0, 0, 0, 26, 301, 1, 0, 0, 0, 28, 306, 1, 0, 0, 0, 30, 
		    319, 1, 0, 0, 0, 32, 330, 1, 0, 0, 0, 34, 332, 1, 0, 0, 0, 36, 335, 
		    1, 0, 0, 0, 38, 349, 1, 0, 0, 0, 40, 351, 1, 0, 0, 0, 42, 353, 1, 
		    0, 0, 0, 44, 359, 1, 0, 0, 0, 46, 381, 1, 0, 0, 0, 48, 383, 1, 0, 
		    0, 0, 50, 385, 1, 0, 0, 0, 52, 387, 1, 0, 0, 0, 54, 389, 1, 0, 0, 
		    0, 56, 391, 1, 0, 0, 0, 58, 393, 1, 0, 0, 0, 60, 395, 1, 0, 0, 0, 
		    62, 397, 1, 0, 0, 0, 64, 399, 1, 0, 0, 0, 66, 401, 1, 0, 0, 0, 68, 
		    403, 1, 0, 0, 0, 70, 405, 1, 0, 0, 0, 72, 73, 3, 2, 1, 0, 73, 74, 
		    5, 0, 0, 1, 74, 1, 1, 0, 0, 0, 75, 77, 3, 4, 2, 0, 76, 75, 1, 0, 0, 
		    0, 77, 80, 1, 0, 0, 0, 78, 76, 1, 0, 0, 0, 78, 79, 1, 0, 0, 0, 79, 
		    82, 1, 0, 0, 0, 80, 78, 1, 0, 0, 0, 81, 83, 3, 6, 3, 0, 82, 81, 1, 
		    0, 0, 0, 82, 83, 1, 0, 0, 0, 83, 3, 1, 0, 0, 0, 84, 163, 5, 1, 0, 
		    0, 85, 86, 3, 12, 6, 0, 86, 87, 5, 2, 0, 0, 87, 88, 3, 16, 8, 0, 88, 
		    163, 1, 0, 0, 0, 89, 163, 3, 22, 11, 0, 90, 163, 5, 3, 0, 0, 91, 92, 
		    5, 4, 0, 0, 92, 93, 3, 2, 1, 0, 93, 94, 5, 5, 0, 0, 94, 163, 1, 0, 
		    0, 0, 95, 96, 5, 6, 0, 0, 96, 97, 3, 18, 9, 0, 97, 98, 5, 4, 0, 0, 
		    98, 99, 3, 2, 1, 0, 99, 100, 5, 5, 0, 0, 100, 163, 1, 0, 0, 0, 101, 
		    102, 5, 7, 0, 0, 102, 103, 3, 2, 1, 0, 103, 104, 5, 8, 0, 0, 104, 
		    105, 3, 18, 9, 0, 105, 163, 1, 0, 0, 0, 106, 107, 5, 9, 0, 0, 107, 
		    108, 3, 18, 9, 0, 108, 109, 5, 10, 0, 0, 109, 117, 3, 2, 1, 0, 110, 
		    111, 5, 11, 0, 0, 111, 112, 3, 18, 9, 0, 112, 113, 5, 10, 0, 0, 113, 
		    114, 3, 2, 1, 0, 114, 116, 1, 0, 0, 0, 115, 110, 1, 0, 0, 0, 116, 
		    119, 1, 0, 0, 0, 117, 115, 1, 0, 0, 0, 117, 118, 1, 0, 0, 0, 118, 
		    122, 1, 0, 0, 0, 119, 117, 1, 0, 0, 0, 120, 121, 5, 12, 0, 0, 121, 
		    123, 3, 2, 1, 0, 122, 120, 1, 0, 0, 0, 122, 123, 1, 0, 0, 0, 123, 
		    124, 1, 0, 0, 0, 124, 125, 5, 5, 0, 0, 125, 163, 1, 0, 0, 0, 126, 
		    127, 5, 13, 0, 0, 127, 128, 5, 55, 0, 0, 128, 129, 5, 2, 0, 0, 129, 
		    130, 3, 18, 9, 0, 130, 131, 5, 14, 0, 0, 131, 134, 3, 18, 9, 0, 132, 
		    133, 5, 14, 0, 0, 133, 135, 3, 18, 9, 0, 134, 132, 1, 0, 0, 0, 134, 
		    135, 1, 0, 0, 0, 135, 136, 1, 0, 0, 0, 136, 137, 5, 4, 0, 0, 137, 
		    138, 3, 2, 1, 0, 138, 139, 5, 5, 0, 0, 139, 163, 1, 0, 0, 0, 140, 
		    141, 5, 13, 0, 0, 141, 142, 3, 14, 7, 0, 142, 143, 5, 15, 0, 0, 143, 
		    144, 3, 16, 8, 0, 144, 145, 5, 4, 0, 0, 145, 146, 3, 2, 1, 0, 146, 
		    147, 5, 5, 0, 0, 147, 163, 1, 0, 0, 0, 148, 149, 5, 16, 0, 0, 149, 
		    150, 3, 8, 4, 0, 150, 151, 3, 36, 18, 0, 151, 163, 1, 0, 0, 0, 152, 
		    153, 5, 17, 0, 0, 153, 154, 5, 16, 0, 0, 154, 155, 5, 55, 0, 0, 155, 
		    163, 3, 36, 18, 0, 156, 157, 5, 17, 0, 0, 157, 160, 3, 12, 6, 0, 158, 
		    159, 5, 2, 0, 0, 159, 161, 3, 16, 8, 0, 160, 158, 1, 0, 0, 0, 160, 
		    161, 1, 0, 0, 0, 161, 163, 1, 0, 0, 0, 162, 84, 1, 0, 0, 0, 162, 85, 
		    1, 0, 0, 0, 162, 89, 1, 0, 0, 0, 162, 90, 1, 0, 0, 0, 162, 91, 1, 
		    0, 0, 0, 162, 95, 1, 0, 0, 0, 162, 101, 1, 0, 0, 0, 162, 106, 1, 0, 
		    0, 0, 162, 126, 1, 0, 0, 0, 162, 140, 1, 0, 0, 0, 162, 148, 1, 0, 
		    0, 0, 162, 152, 1, 0, 0, 0, 162, 156, 1, 0, 0, 0, 163, 5, 1, 0, 0, 
		    0, 164, 166, 5, 18, 0, 0, 165, 167, 3, 16, 8, 0, 166, 165, 1, 0, 0, 
		    0, 166, 167, 1, 0, 0, 0, 167, 174, 1, 0, 0, 0, 168, 174, 5, 3, 0, 
		    0, 169, 171, 5, 19, 0, 0, 170, 172, 5, 1, 0, 0, 171, 170, 1, 0, 0, 
		    0, 171, 172, 1, 0, 0, 0, 172, 174, 1, 0, 0, 0, 173, 164, 1, 0, 0, 
		    0, 173, 168, 1, 0, 0, 0, 173, 169, 1, 0, 0, 0, 174, 7, 1, 0, 0, 0, 
		    175, 180, 5, 55, 0, 0, 176, 177, 5, 20, 0, 0, 177, 179, 5, 55, 0, 
		    0, 178, 176, 1, 0, 0, 0, 179, 182, 1, 0, 0, 0, 180, 178, 1, 0, 0, 
		    0, 180, 181, 1, 0, 0, 0, 181, 184, 1, 0, 0, 0, 182, 180, 1, 0, 0, 
		    0, 183, 185, 3, 10, 5, 0, 184, 183, 1, 0, 0, 0, 184, 185, 1, 0, 0, 
		    0, 185, 9, 1, 0, 0, 0, 186, 187, 5, 21, 0, 0, 187, 188, 5, 55, 0, 
		    0, 188, 11, 1, 0, 0, 0, 189, 194, 3, 26, 13, 0, 190, 191, 5, 14, 0, 
		    0, 191, 193, 3, 26, 13, 0, 192, 190, 1, 0, 0, 0, 193, 196, 1, 0, 0, 
		    0, 194, 192, 1, 0, 0, 0, 194, 195, 1, 0, 0, 0, 195, 13, 1, 0, 0, 0, 
		    196, 194, 1, 0, 0, 0, 197, 202, 5, 55, 0, 0, 198, 199, 5, 14, 0, 0, 
		    199, 201, 5, 55, 0, 0, 200, 198, 1, 0, 0, 0, 201, 204, 1, 0, 0, 0, 
		    202, 200, 1, 0, 0, 0, 202, 203, 1, 0, 0, 0, 203, 15, 1, 0, 0, 0, 204, 
		    202, 1, 0, 0, 0, 205, 206, 3, 18, 9, 0, 206, 207, 5, 14, 0, 0, 207, 
		    209, 1, 0, 0, 0, 208, 205, 1, 0, 0, 0, 209, 212, 1, 0, 0, 0, 210, 
		    208, 1, 0, 0, 0, 210, 211, 1, 0, 0, 0, 211, 213, 1, 0, 0, 0, 212, 
		    210, 1, 0, 0, 0, 213, 214, 3, 18, 9, 0, 214, 17, 1, 0, 0, 0, 215, 
		    216, 6, 9, -1, 0, 216, 228, 5, 22, 0, 0, 217, 228, 7, 0, 0, 0, 218, 
		    228, 3, 68, 34, 0, 219, 228, 3, 70, 35, 0, 220, 228, 5, 25, 0, 0, 
		    221, 228, 3, 34, 17, 0, 222, 228, 3, 20, 10, 0, 223, 228, 3, 42, 21, 
		    0, 224, 225, 3, 64, 32, 0, 225, 226, 3, 18, 9, 8, 226, 228, 1, 0, 
		    0, 0, 227, 215, 1, 0, 0, 0, 227, 217, 1, 0, 0, 0, 227, 218, 1, 0, 
		    0, 0, 227, 219, 1, 0, 0, 0, 227, 220, 1, 0, 0, 0, 227, 221, 1, 0, 
		    0, 0, 227, 222, 1, 0, 0, 0, 227, 223, 1, 0, 0, 0, 227, 224, 1, 0, 
		    0, 0, 228, 263, 1, 0, 0, 0, 229, 230, 10, 9, 0, 0, 230, 231, 3, 66, 
		    33, 0, 231, 232, 3, 18, 9, 9, 232, 262, 1, 0, 0, 0, 233, 234, 10, 
		    7, 0, 0, 234, 235, 3, 60, 30, 0, 235, 236, 3, 18, 9, 8, 236, 262, 
		    1, 0, 0, 0, 237, 238, 10, 6, 0, 0, 238, 239, 3, 58, 29, 0, 239, 240, 
		    3, 18, 9, 7, 240, 262, 1, 0, 0, 0, 241, 242, 10, 5, 0, 0, 242, 243, 
		    3, 56, 28, 0, 243, 244, 3, 18, 9, 5, 244, 262, 1, 0, 0, 0, 245, 246, 
		    10, 4, 0, 0, 246, 247, 3, 62, 31, 0, 247, 248, 3, 18, 9, 5, 248, 262, 
		    1, 0, 0, 0, 249, 250, 10, 3, 0, 0, 250, 251, 3, 54, 27, 0, 251, 252, 
		    3, 18, 9, 4, 252, 262, 1, 0, 0, 0, 253, 254, 10, 2, 0, 0, 254, 255, 
		    3, 52, 26, 0, 255, 256, 3, 18, 9, 3, 256, 262, 1, 0, 0, 0, 257, 258, 
		    10, 1, 0, 0, 258, 259, 3, 50, 25, 0, 259, 260, 3, 18, 9, 2, 260, 262, 
		    1, 0, 0, 0, 261, 229, 1, 0, 0, 0, 261, 233, 1, 0, 0, 0, 261, 237, 
		    1, 0, 0, 0, 261, 241, 1, 0, 0, 0, 261, 245, 1, 0, 0, 0, 261, 249, 
		    1, 0, 0, 0, 261, 253, 1, 0, 0, 0, 261, 257, 1, 0, 0, 0, 262, 265, 
		    1, 0, 0, 0, 263, 261, 1, 0, 0, 0, 263, 264, 1, 0, 0, 0, 264, 19, 1, 
		    0, 0, 0, 265, 263, 1, 0, 0, 0, 266, 270, 3, 24, 12, 0, 267, 269, 3, 
		    30, 15, 0, 268, 267, 1, 0, 0, 0, 269, 272, 1, 0, 0, 0, 270, 268, 1, 
		    0, 0, 0, 270, 271, 1, 0, 0, 0, 271, 21, 1, 0, 0, 0, 272, 270, 1, 0, 
		    0, 0, 273, 275, 3, 24, 12, 0, 274, 276, 3, 30, 15, 0, 275, 274, 1, 
		    0, 0, 0, 276, 277, 1, 0, 0, 0, 277, 275, 1, 0, 0, 0, 277, 278, 1, 
		    0, 0, 0, 278, 23, 1, 0, 0, 0, 279, 285, 3, 26, 13, 0, 280, 281, 5, 
		    26, 0, 0, 281, 282, 3, 18, 9, 0, 282, 283, 5, 27, 0, 0, 283, 285, 
		    1, 0, 0, 0, 284, 279, 1, 0, 0, 0, 284, 280, 1, 0, 0, 0, 285, 25, 1, 
		    0, 0, 0, 286, 290, 5, 55, 0, 0, 287, 289, 3, 28, 14, 0, 288, 287, 
		    1, 0, 0, 0, 289, 292, 1, 0, 0, 0, 290, 288, 1, 0, 0, 0, 290, 291, 
		    1, 0, 0, 0, 291, 302, 1, 0, 0, 0, 292, 290, 1, 0, 0, 0, 293, 294, 
		    5, 26, 0, 0, 294, 295, 3, 18, 9, 0, 295, 297, 5, 27, 0, 0, 296, 298, 
		    3, 28, 14, 0, 297, 296, 1, 0, 0, 0, 298, 299, 1, 0, 0, 0, 299, 297, 
		    1, 0, 0, 0, 299, 300, 1, 0, 0, 0, 300, 302, 1, 0, 0, 0, 301, 286, 
		    1, 0, 0, 0, 301, 293, 1, 0, 0, 0, 302, 27, 1, 0, 0, 0, 303, 305, 3, 
		    30, 15, 0, 304, 303, 1, 0, 0, 0, 305, 308, 1, 0, 0, 0, 306, 304, 1, 
		    0, 0, 0, 306, 307, 1, 0, 0, 0, 307, 315, 1, 0, 0, 0, 308, 306, 1, 
		    0, 0, 0, 309, 310, 5, 28, 0, 0, 310, 311, 3, 18, 9, 0, 311, 312, 5, 
		    29, 0, 0, 312, 316, 1, 0, 0, 0, 313, 314, 5, 20, 0, 0, 314, 316, 5, 
		    55, 0, 0, 315, 309, 1, 0, 0, 0, 315, 313, 1, 0, 0, 0, 316, 29, 1, 
		    0, 0, 0, 317, 318, 5, 21, 0, 0, 318, 320, 5, 55, 0, 0, 319, 317, 1, 
		    0, 0, 0, 319, 320, 1, 0, 0, 0, 320, 321, 1, 0, 0, 0, 321, 322, 3, 
		    32, 16, 0, 322, 31, 1, 0, 0, 0, 323, 325, 5, 26, 0, 0, 324, 326, 3, 
		    16, 8, 0, 325, 324, 1, 0, 0, 0, 325, 326, 1, 0, 0, 0, 326, 327, 1, 
		    0, 0, 0, 327, 331, 5, 27, 0, 0, 328, 331, 3, 42, 21, 0, 329, 331, 
		    3, 70, 35, 0, 330, 323, 1, 0, 0, 0, 330, 328, 1, 0, 0, 0, 330, 329, 
		    1, 0, 0, 0, 331, 33, 1, 0, 0, 0, 332, 333, 5, 16, 0, 0, 333, 334, 
		    3, 36, 18, 0, 334, 35, 1, 0, 0, 0, 335, 337, 5, 26, 0, 0, 336, 338, 
		    3, 38, 19, 0, 337, 336, 1, 0, 0, 0, 337, 338, 1, 0, 0, 0, 338, 339, 
		    1, 0, 0, 0, 339, 340, 5, 27, 0, 0, 340, 341, 3, 2, 1, 0, 341, 342, 
		    5, 5, 0, 0, 342, 37, 1, 0, 0, 0, 343, 346, 3, 14, 7, 0, 344, 345, 
		    5, 14, 0, 0, 345, 347, 3, 40, 20, 0, 346, 344, 1, 0, 0, 0, 346, 347, 
		    1, 0, 0, 0, 347, 350, 1, 0, 0, 0, 348, 350, 3, 40, 20, 0, 349, 343, 
		    1, 0, 0, 0, 349, 348, 1, 0, 0, 0, 350, 39, 1, 0, 0, 0, 351, 352, 5, 
		    25, 0, 0, 352, 41, 1, 0, 0, 0, 353, 355, 5, 30, 0, 0, 354, 356, 3, 
		    44, 22, 0, 355, 354, 1, 0, 0, 0, 355, 356, 1, 0, 0, 0, 356, 357, 1, 
		    0, 0, 0, 357, 358, 5, 31, 0, 0, 358, 43, 1, 0, 0, 0, 359, 365, 3, 
		    46, 23, 0, 360, 361, 3, 48, 24, 0, 361, 362, 3, 46, 23, 0, 362, 364, 
		    1, 0, 0, 0, 363, 360, 1, 0, 0, 0, 364, 367, 1, 0, 0, 0, 365, 363, 
		    1, 0, 0, 0, 365, 366, 1, 0, 0, 0, 366, 369, 1, 0, 0, 0, 367, 365, 
		    1, 0, 0, 0, 368, 370, 3, 48, 24, 0, 369, 368, 1, 0, 0, 0, 369, 370, 
		    1, 0, 0, 0, 370, 45, 1, 0, 0, 0, 371, 372, 5, 28, 0, 0, 372, 373, 
		    3, 18, 9, 0, 373, 374, 5, 29, 0, 0, 374, 375, 5, 2, 0, 0, 375, 376, 
		    3, 18, 9, 0, 376, 382, 1, 0, 0, 0, 377, 378, 5, 55, 0, 0, 378, 379, 
		    5, 2, 0, 0, 379, 382, 3, 18, 9, 0, 380, 382, 3, 18, 9, 0, 381, 371, 
		    1, 0, 0, 0, 381, 377, 1, 0, 0, 0, 381, 380, 1, 0, 0, 0, 382, 47, 1, 
		    0, 0, 0, 383, 384, 7, 1, 0, 0, 384, 49, 1, 0, 0, 0, 385, 386, 5, 32, 
		    0, 0, 386, 51, 1, 0, 0, 0, 387, 388, 5, 33, 0, 0, 388, 53, 1, 0, 0, 
		    0, 389, 390, 7, 2, 0, 0, 390, 55, 1, 0, 0, 0, 391, 392, 5, 40, 0, 
		    0, 392, 57, 1, 0, 0, 0, 393, 394, 7, 3, 0, 0, 394, 59, 1, 0, 0, 0, 
		    395, 396, 7, 4, 0, 0, 396, 61, 1, 0, 0, 0, 397, 398, 7, 5, 0, 0, 398, 
		    63, 1, 0, 0, 0, 399, 400, 7, 6, 0, 0, 400, 65, 1, 0, 0, 0, 401, 402, 
		    5, 54, 0, 0, 402, 67, 1, 0, 0, 0, 403, 404, 7, 7, 0, 0, 404, 69, 1, 
		    0, 0, 0, 405, 406, 7, 8, 0, 0, 406, 71, 1, 0, 0, 0, 36, 78, 82, 117, 
		    122, 134, 160, 162, 166, 171, 173, 180, 184, 194, 202, 210, 227, 261, 
		    263, 270, 277, 284, 290, 299, 301, 306, 315, 319, 325, 330, 337, 346, 
		    349, 355, 365, 369, 381];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Lua.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function chunk(): Context\ChunkContext
		{
		    $localContext = new Context\ChunkContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_chunk);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(72);
		        $this->block();
		        $this->setState(73);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(78);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 0, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(75);
		        		$this->stat(); 
		        	}

		        	$this->setState(80);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 0, $this->ctx);
		        }
		        $this->setState(82);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 786440) !== 0)) {
		        	$this->setState(81);
		        	$this->laststat();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function stat(): Context\StatContext
		{
		    $localContext = new Context\StatContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_stat);

		    try {
		        $this->setState(162);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 6, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\SemicolonContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(84);
		        	    $this->match(self::T__0);
		        	break;

		        	case 2:
		        	    $localContext = new Context\StatAssignContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(85);
		        	    $this->varlist();
		        	    $this->setState(86);
		        	    $this->match(self::T__1);
		        	    $this->setState(87);
		        	    $this->explist();
		        	break;

		        	case 3:
		        	    $localContext = new Context\StatFunctionCallContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(89);
		        	    $this->functioncall();
		        	break;

		        	case 4:
		        	    $localContext = new Context\StatBreakContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(90);
		        	    $this->match(self::T__2);
		        	break;

		        	case 5:
		        	    $localContext = new Context\StatDoContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(91);
		        	    $this->match(self::T__3);
		        	    $this->setState(92);
		        	    $this->block();
		        	    $this->setState(93);
		        	    $this->match(self::T__4);
		        	break;

		        	case 6:
		        	    $localContext = new Context\StatWhileContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(95);
		        	    $this->match(self::T__5);
		        	    $this->setState(96);
		        	    $this->recursiveExp(0);
		        	    $this->setState(97);
		        	    $this->match(self::T__3);
		        	    $this->setState(98);
		        	    $this->block();
		        	    $this->setState(99);
		        	    $this->match(self::T__4);
		        	break;

		        	case 7:
		        	    $localContext = new Context\StatRepeatContext($localContext);
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(101);
		        	    $this->match(self::T__6);
		        	    $this->setState(102);
		        	    $this->block();
		        	    $this->setState(103);
		        	    $this->match(self::T__7);
		        	    $this->setState(104);
		        	    $this->recursiveExp(0);
		        	break;

		        	case 8:
		        	    $localContext = new Context\StatIfContext($localContext);
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(106);
		        	    $this->match(self::T__8);
		        	    $this->setState(107);
		        	    $this->recursiveExp(0);
		        	    $this->setState(108);
		        	    $this->match(self::T__9);
		        	    $this->setState(109);
		        	    $this->block();
		        	    $this->setState(117);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::T__10) {
		        	    	$this->setState(110);
		        	    	$this->match(self::T__10);
		        	    	$this->setState(111);
		        	    	$this->recursiveExp(0);
		        	    	$this->setState(112);
		        	    	$this->match(self::T__9);
		        	    	$this->setState(113);
		        	    	$this->block();
		        	    	$this->setState(119);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	    $this->setState(122);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__11) {
		        	    	$this->setState(120);
		        	    	$this->match(self::T__11);
		        	    	$this->setState(121);
		        	    	$this->block();
		        	    }
		        	    $this->setState(124);
		        	    $this->match(self::T__4);
		        	break;

		        	case 9:
		        	    $localContext = new Context\StatForContext($localContext);
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(126);
		        	    $this->match(self::T__12);
		        	    $this->setState(127);
		        	    $this->match(self::NAME);
		        	    $this->setState(128);
		        	    $this->match(self::T__1);
		        	    $this->setState(129);
		        	    $this->recursiveExp(0);
		        	    $this->setState(130);
		        	    $this->match(self::T__13);
		        	    $this->setState(131);
		        	    $this->recursiveExp(0);
		        	    $this->setState(134);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__13) {
		        	    	$this->setState(132);
		        	    	$this->match(self::T__13);
		        	    	$this->setState(133);
		        	    	$this->recursiveExp(0);
		        	    }
		        	    $this->setState(136);
		        	    $this->match(self::T__3);
		        	    $this->setState(137);
		        	    $this->block();
		        	    $this->setState(138);
		        	    $this->match(self::T__4);
		        	break;

		        	case 10:
		        	    $localContext = new Context\StatForEachContext($localContext);
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(140);
		        	    $this->match(self::T__12);
		        	    $this->setState(141);
		        	    $this->namelist();
		        	    $this->setState(142);
		        	    $this->match(self::T__14);
		        	    $this->setState(143);
		        	    $this->explist();
		        	    $this->setState(144);
		        	    $this->match(self::T__3);
		        	    $this->setState(145);
		        	    $this->block();
		        	    $this->setState(146);
		        	    $this->match(self::T__4);
		        	break;

		        	case 11:
		        	    $localContext = new Context\StatFunctionDeclareContext($localContext);
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(148);
		        	    $this->match(self::T__15);
		        	    $this->setState(149);
		        	    $this->funcname();
		        	    $this->setState(150);
		        	    $this->funcbody();
		        	break;

		        	case 12:
		        	    $localContext = new Context\StatLocalFunctionContext($localContext);
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(152);
		        	    $this->match(self::T__16);
		        	    $this->setState(153);
		        	    $this->match(self::T__15);
		        	    $this->setState(154);
		        	    $this->match(self::NAME);
		        	    $this->setState(155);
		        	    $this->funcbody();
		        	break;

		        	case 13:
		        	    $localContext = new Context\StatLocalVariableContext($localContext);
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(156);
		        	    $this->match(self::T__16);
		        	    $this->setState(157);
		        	    $this->varlist();
		        	    $this->setState(160);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__1) {
		        	    	$this->setState(158);
		        	    	$this->match(self::T__1);
		        	    	$this->setState(159);
		        	    	$this->explist();
		        	    }
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function laststat(): Context\LaststatContext
		{
		    $localContext = new Context\LaststatContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_laststat);

		    try {
		        $this->setState(173);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__17:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(164);
		            	$this->match(self::T__17);
		            	$this->setState(166);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2283892360280604672) !== 0)) {
		            		$this->setState(165);
		            		$this->explist();
		            	}
		            	break;

		            case self::T__2:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(168);
		            	$this->match(self::T__2);
		            	break;

		            case self::T__18:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(169);
		            	$this->match(self::T__18);
		            	$this->setState(171);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__0) {
		            		$this->setState(170);
		            		$this->match(self::T__0);
		            	}
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function funcname(): Context\FuncnameContext
		{
		    $localContext = new Context\FuncnameContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_funcname);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(175);
		        $this->match(self::NAME);
		        $this->setState(180);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__19) {
		        	$this->setState(176);
		        	$this->match(self::T__19);
		        	$this->setState(177);
		        	$this->match(self::NAME);
		        	$this->setState(182);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(184);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__20) {
		        	$this->setState(183);
		        	$this->funcname_method();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function funcname_method(): Context\Funcname_methodContext
		{
		    $localContext = new Context\Funcname_methodContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_funcname_method);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(186);
		        $this->match(self::T__20);
		        $this->setState(187);
		        $this->match(self::NAME);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varlist(): Context\VarlistContext
		{
		    $localContext = new Context\VarlistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_varlist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(189);
		        $this->variable();
		        $this->setState(194);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(190);
		        	$this->match(self::T__13);
		        	$this->setState(191);
		        	$this->variable();
		        	$this->setState(196);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function namelist(): Context\NamelistContext
		{
		    $localContext = new Context\NamelistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_namelist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(197);
		        $this->match(self::NAME);
		        $this->setState(202);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 13, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(198);
		        		$this->match(self::T__13);
		        		$this->setState(199);
		        		$this->match(self::NAME); 
		        	}

		        	$this->setState(204);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 13, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function explist(): Context\ExplistContext
		{
		    $localContext = new Context\ExplistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_explist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(210);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 14, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(205);
		        		$this->recursiveExp(0);
		        		$this->setState(206);
		        		$this->match(self::T__13); 
		        	}

		        	$this->setState(212);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 14, $this->ctx);
		        }
		        $this->setState(213);
		        $this->recursiveExp(0);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function exp(): Context\ExpContext
		{
			return $this->recursiveExp(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursiveExp(int $precedence): Context\ExpContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\ExpContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 18;
			$this->enterRecursionRule($localContext, 18, self::RULE_exp, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(227);
				$this->errorHandler->sync($this);

				switch ($this->input->LA(1)) {
				    case self::T__21:
				    	$localContext = new Context\ExpNullContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;


				    	$this->setState(216);
				    	$this->match(self::T__21);
				    	break;

				    case self::T__22:
				    case self::T__23:
				    	$localContext = new Context\ExpBoolContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(217);

				    	$_la = $this->input->LA(1);

				    	if (!($_la === self::T__22 || $_la === self::T__23)) {
				    	$this->errorHandler->recoverInline($this);
				    	} else {
				    		if ($this->input->LA(1) === Token::EOF) {
				    		    $this->matchedEOF = true;
				    	    }

				    		$this->errorHandler->reportMatch($this);
				    		$this->consume();
				    	}
				    	break;

				    case self::INT:
				    case self::FLOAT:
				    	$localContext = new Context\ExpNumberContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(218);
				    	$this->number();
				    	break;

				    case self::NORMALSTRING:
				    case self::CHARSTRING:
				    case self::LONGSTRING:
				    	$localContext = new Context\ExpStringContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(219);
				    	$this->string();
				    	break;

				    case self::T__24:
				    	$localContext = new Context\ExpElipsisContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(220);
				    	$this->match(self::T__24);
				    	break;

				    case self::T__15:
				    	$localContext = new Context\ExpFunctionContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(221);
				    	$this->functiondef();
				    	break;

				    case self::T__25:
				    case self::NAME:
				    	$localContext = new Context\ExpPrefixContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(222);
				    	$this->prefixexp();
				    	break;

				    case self::T__29:
				    	$localContext = new Context\ExpTableContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(223);
				    	$this->tableconstructor();
				    	break;

				    case self::T__41:
				    case self::T__48:
				    case self::T__51:
				    case self::T__52:
				    	$localContext = new Context\ExpUnaryContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(224);
				    	$this->operatorUnary();
				    	$this->setState(225);
				    	$this->recursiveExp(8);
				    	break;

				default:
					throw new NoViableAltException($this);
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(263);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(261);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx)) {
							case 1:
							    $localContext = new Context\ExpPowerContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(229);

							    if (!($this->precpred($this->ctx, 9))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 9)");
							    }
							    $this->setState(230);
							    $this->operatorPower();
							    $this->setState(231);
							    $this->recursiveExp(9);
							break;

							case 2:
							    $localContext = new Context\ExpMulDivModContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(233);

							    if (!($this->precpred($this->ctx, 7))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 7)");
							    }
							    $this->setState(234);
							    $this->operatorMulDivMod();
							    $this->setState(235);
							    $this->recursiveExp(8);
							break;

							case 3:
							    $localContext = new Context\ExpAddSubContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(237);

							    if (!($this->precpred($this->ctx, 6))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 6)");
							    }
							    $this->setState(238);
							    $this->operatorAddSub();
							    $this->setState(239);
							    $this->recursiveExp(7);
							break;

							case 4:
							    $localContext = new Context\ExpConcatContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(241);

							    if (!($this->precpred($this->ctx, 5))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 5)");
							    }
							    $this->setState(242);
							    $this->operatorStrcat();
							    $this->setState(243);
							    $this->recursiveExp(5);
							break;

							case 5:
							    $localContext = new Context\ExpBitwiseContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(245);

							    if (!($this->precpred($this->ctx, 4))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 4)");
							    }
							    $this->setState(246);
							    $this->operatorBitwise();
							    $this->setState(247);
							    $this->recursiveExp(5);
							break;

							case 6:
							    $localContext = new Context\ExpComparisonContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(249);

							    if (!($this->precpred($this->ctx, 3))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 3)");
							    }
							    $this->setState(250);
							    $this->operatorComparison();
							    $this->setState(251);
							    $this->recursiveExp(4);
							break;

							case 7:
							    $localContext = new Context\ExpAndContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(253);

							    if (!($this->precpred($this->ctx, 2))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 2)");
							    }
							    $this->setState(254);
							    $this->operatorAnd();
							    $this->setState(255);
							    $this->recursiveExp(3);
							break;

							case 8:
							    $localContext = new Context\ExpOrContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(257);

							    if (!($this->precpred($this->ctx, 1))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 1)");
							    }
							    $this->setState(258);
							    $this->operatorOr();
							    $this->setState(259);
							    $this->recursiveExp(2);
							break;
						} 
					}

					$this->setState(265);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function prefixexp(): Context\PrefixexpContext
		{
		    $localContext = new Context\PrefixexpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_prefixexp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(266);
		        $this->varOrExp();
		        $this->setState(270);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(267);
		        		$this->nameAndArgs(); 
		        	}

		        	$this->setState(272);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functioncall(): Context\FunctioncallContext
		{
		    $localContext = new Context\FunctioncallContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_functioncall);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(273);
		        $this->varOrExp();
		        $this->setState(275); 
		        $this->errorHandler->sync($this);

		        $alt = 1;

		        do {
		        	switch ($alt) {
		        	case 1:
		        		$this->setState(274);
		        		$this->nameAndArgs();
		        		break;
		        	default:
		        		throw new NoViableAltException($this);
		        	}

		        	$this->setState(277); 
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx);
		        } while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varOrExp(): Context\VarOrExpContext
		{
		    $localContext = new Context\VarOrExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_varOrExp);

		    try {
		        $this->setState(284);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 20, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(279);
		        	    $this->variable();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(280);
		        	    $this->match(self::T__25);
		        	    $this->setState(281);
		        	    $this->recursiveExp(0);
		        	    $this->setState(282);
		        	    $this->match(self::T__26);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function variable(): Context\VariableContext
		{
		    $localContext = new Context\VariableContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_variable);

		    try {
		        $this->setState(301);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NAME:
		            	$localContext = new Context\NameVariableContext($localContext);
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(286);
		            	$this->match(self::NAME);
		            	$this->setState(290);
		            	$this->errorHandler->sync($this);

		            	$alt = $this->getInterpreter()->adaptivePredict($this->input, 21, $this->ctx);

		            	while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		            		if ($alt === 1) {
		            			$this->setState(287);
		            			$this->varSuffix(); 
		            		}

		            		$this->setState(292);
		            		$this->errorHandler->sync($this);

		            		$alt = $this->getInterpreter()->adaptivePredict($this->input, 21, $this->ctx);
		            	}
		            	break;

		            case self::T__25:
		            	$localContext = new Context\ExpVariableContext($localContext);
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(293);
		            	$this->match(self::T__25);
		            	$this->setState(294);
		            	$this->recursiveExp(0);
		            	$this->setState(295);
		            	$this->match(self::T__26);
		            	$this->setState(297); 
		            	$this->errorHandler->sync($this);

		            	$alt = 1;

		            	do {
		            		switch ($alt) {
		            		case 1:
		            			$this->setState(296);
		            			$this->varSuffix();
		            			break;
		            		default:
		            			throw new NoViableAltException($this);
		            		}

		            		$this->setState(299); 
		            		$this->errorHandler->sync($this);

		            		$alt = $this->getInterpreter()->adaptivePredict($this->input, 22, $this->ctx);
		            	} while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varSuffix(): Context\VarSuffixContext
		{
		    $localContext = new Context\VarSuffixContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_varSuffix);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(306);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 504403159408443392) !== 0)) {
		        	$this->setState(303);
		        	$this->nameAndArgs();
		        	$this->setState(308);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(315);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__27:
		            	$this->setState(309);
		            	$this->match(self::T__27);
		            	$this->setState(310);
		            	$this->recursiveExp(0);
		            	$this->setState(311);
		            	$this->match(self::T__28);
		            	break;

		            case self::T__19:
		            	$this->setState(313);
		            	$this->match(self::T__19);
		            	$this->setState(314);
		            	$this->match(self::NAME);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function nameAndArgs(): Context\NameAndArgsContext
		{
		    $localContext = new Context\NameAndArgsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_nameAndArgs);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(319);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__20) {
		        	$this->setState(317);
		        	$this->match(self::T__20);
		        	$this->setState(318);
		        	$this->match(self::NAME);
		        }
		        $this->setState(321);
		        $this->args();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function args(): Context\ArgsContext
		{
		    $localContext = new Context\ArgsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_args);

		    try {
		        $this->setState(330);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__25:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(323);
		            	$this->match(self::T__25);
		            	$this->setState(325);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2283892360280604672) !== 0)) {
		            		$this->setState(324);
		            		$this->explist();
		            	}
		            	$this->setState(327);
		            	$this->match(self::T__26);
		            	break;

		            case self::T__29:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(328);
		            	$this->tableconstructor();
		            	break;

		            case self::NORMALSTRING:
		            case self::CHARSTRING:
		            case self::LONGSTRING:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(329);
		            	$this->string();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functiondef(): Context\FunctiondefContext
		{
		    $localContext = new Context\FunctiondefContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_functiondef);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(332);
		        $this->match(self::T__15);
		        $this->setState(333);
		        $this->funcbody();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function funcbody(): Context\FuncbodyContext
		{
		    $localContext = new Context\FuncbodyContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_funcbody);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(335);
		        $this->match(self::T__25);
		        $this->setState(337);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__24 || $_la === self::NAME) {
		        	$this->setState(336);
		        	$this->parlist();
		        }
		        $this->setState(339);
		        $this->match(self::T__26);
		        $this->setState(340);
		        $this->block();
		        $this->setState(341);
		        $this->match(self::T__4);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parlist(): Context\ParlistContext
		{
		    $localContext = new Context\ParlistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_parlist);

		    try {
		        $this->setState(349);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NAME:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(343);
		            	$this->namelist();
		            	$this->setState(346);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__13) {
		            		$this->setState(344);
		            		$this->match(self::T__13);
		            		$this->setState(345);
		            		$this->elipsis();
		            	}
		            	break;

		            case self::T__24:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(348);
		            	$this->elipsis();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function elipsis(): Context\ElipsisContext
		{
		    $localContext = new Context\ElipsisContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_elipsis);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(351);
		        $this->match(self::T__24);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function tableconstructor(): Context\TableconstructorContext
		{
		    $localContext = new Context\TableconstructorContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_tableconstructor);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(353);
		        $this->match(self::T__29);
		        $this->setState(355);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2283892360549040128) !== 0)) {
		        	$this->setState(354);
		        	$this->fieldlist();
		        }
		        $this->setState(357);
		        $this->match(self::T__30);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function fieldlist(): Context\FieldlistContext
		{
		    $localContext = new Context\FieldlistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_fieldlist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(359);
		        $this->field();
		        $this->setState(365);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(360);
		        		$this->fieldsep();
		        		$this->setState(361);
		        		$this->field(); 
		        	}

		        	$this->setState(367);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx);
		        }
		        $this->setState(369);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__0 || $_la === self::T__13) {
		        	$this->setState(368);
		        	$this->fieldsep();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function field(): Context\FieldContext
		{
		    $localContext = new Context\FieldContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_field);

		    try {
		        $this->setState(381);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(371);
		        	    $this->match(self::T__27);
		        	    $this->setState(372);
		        	    $this->recursiveExp(0);
		        	    $this->setState(373);
		        	    $this->match(self::T__28);
		        	    $this->setState(374);
		        	    $this->match(self::T__1);
		        	    $this->setState(375);
		        	    $this->recursiveExp(0);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(377);
		        	    $this->match(self::NAME);
		        	    $this->setState(378);
		        	    $this->match(self::T__1);
		        	    $this->setState(379);
		        	    $this->recursiveExp(0);
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(380);
		        	    $this->recursiveExp(0);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function fieldsep(): Context\FieldsepContext
		{
		    $localContext = new Context\FieldsepContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_fieldsep);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(383);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::T__0 || $_la === self::T__13)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorOr(): Context\OperatorOrContext
		{
		    $localContext = new Context\OperatorOrContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_operatorOr);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(385);
		        $this->match(self::T__31);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorAnd(): Context\OperatorAndContext
		{
		    $localContext = new Context\OperatorAndContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_operatorAnd);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(387);
		        $this->match(self::T__32);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorComparison(): Context\OperatorComparisonContext
		{
		    $localContext = new Context\OperatorComparisonContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_operatorComparison);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(389);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1082331758592) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorStrcat(): Context\OperatorStrcatContext
		{
		    $localContext = new Context\OperatorStrcatContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_operatorStrcat);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(391);
		        $this->match(self::T__39);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorAddSub(): Context\OperatorAddSubContext
		{
		    $localContext = new Context\OperatorAddSubContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_operatorAddSub);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(393);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::T__40 || $_la === self::T__41)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorMulDivMod(): Context\OperatorMulDivModContext
		{
		    $localContext = new Context\OperatorMulDivModContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_operatorMulDivMod);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(395);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 131941395333120) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorBitwise(): Context\OperatorBitwiseContext
		{
		    $localContext = new Context\OperatorBitwiseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_operatorBitwise);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(397);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4362862139015168) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorUnary(): Context\OperatorUnaryContext
		{
		    $localContext = new Context\OperatorUnaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_operatorUnary);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(399);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 14078146882043904) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operatorPower(): Context\OperatorPowerContext
		{
		    $localContext = new Context\OperatorPowerContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_operatorPower);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(401);
		        $this->match(self::T__53);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function number(): Context\NumberContext
		{
		    $localContext = new Context\NumberContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_number);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(403);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::INT || $_la === self::FLOAT)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function string(): Context\StringContext
		{
		    $localContext = new Context\StringContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_string);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(405);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 504403158265495552) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex): bool
		{
			switch ($ruleIndex) {
					case 9:
						return $this->sempredExp($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredExp(?Context\ExpContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 0:
			        return $this->precpred($this->ctx, 9);

			    case 1:
			        return $this->precpred($this->ctx, 7);

			    case 2:
			        return $this->precpred($this->ctx, 6);

			    case 3:
			        return $this->precpred($this->ctx, 5);

			    case 4:
			        return $this->precpred($this->ctx, 4);

			    case 5:
			        return $this->precpred($this->ctx, 3);

			    case 6:
			        return $this->precpred($this->ctx, 2);

			    case 7:
			        return $this->precpred($this->ctx, 1);
			}

			return true;
		}
	}
}

namespace Raudius\Luar\Parser\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use Raudius\Luar\Parser\LuaParser;
	use Raudius\Luar\Parser\LuaVisitor;

	class ChunkContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_chunk;
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::EOF, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitChunk($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_block;
	    }

	    /**
	     * @return array<StatContext>|StatContext|null
	     */
	    public function stat(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatContext::class);
	    	}

	        return $this->getTypedRuleContext(StatContext::class, $index);
	    }

	    public function laststat(): ?LaststatContext
	    {
	    	return $this->getTypedRuleContext(LaststatContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_stat;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class StatFunctionCallContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function functioncall(): ?FunctioncallContext
	    {
	    	return $this->getTypedRuleContext(FunctioncallContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatFunctionCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatBreakContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatBreak($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatForEachContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function namelist(): ?NamelistContext
	    {
	    	return $this->getTypedRuleContext(NamelistContext::class, 0);
	    }

	    public function explist(): ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatForEach($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatLocalVariableContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function varlist(): ?VarlistContext
	    {
	    	return $this->getTypedRuleContext(VarlistContext::class, 0);
	    }

	    public function explist(): ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatLocalVariable($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatLocalFunctionContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

	    public function funcbody(): ?FuncbodyContext
	    {
	    	return $this->getTypedRuleContext(FuncbodyContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatLocalFunction($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatDoContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatDo($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatWhileContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function exp(): ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatWhile($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatFunctionDeclareContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function funcname(): ?FuncnameContext
	    {
	    	return $this->getTypedRuleContext(FuncnameContext::class, 0);
	    }

	    public function funcbody(): ?FuncbodyContext
	    {
	    	return $this->getTypedRuleContext(FuncbodyContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatFunctionDeclare($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatAssignContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function varlist(): ?VarlistContext
	    {
	    	return $this->getTypedRuleContext(VarlistContext::class, 0);
	    }

	    public function explist(): ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatAssign($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatRepeatContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function exp(): ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatRepeat($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatIfContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatIf($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class SemicolonContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitSemicolon($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StatForContext extends StatContext
	{
		public function __construct(StatContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatFor($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LaststatContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_laststat;
	    }

	    public function explist(): ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitLaststat($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FuncnameContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_funcname;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NAME(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(LuaParser::NAME);
	    	}

	        return $this->getToken(LuaParser::NAME, $index);
	    }

	    public function funcname_method(): ?Funcname_methodContext
	    {
	    	return $this->getTypedRuleContext(Funcname_methodContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFuncname($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class Funcname_methodContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_funcname_method;
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFuncname_method($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarlistContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_varlist;
	    }

	    /**
	     * @return array<VariableContext>|VariableContext|null
	     */
	    public function variable(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(VariableContext::class);
	    	}

	        return $this->getTypedRuleContext(VariableContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitVarlist($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class NamelistContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_namelist;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NAME(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(LuaParser::NAME);
	    	}

	        return $this->getToken(LuaParser::NAME, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitNamelist($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExplistContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_explist;
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExplist($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_exp;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class ExpNumberContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function number(): ?NumberContext
	    {
	    	return $this->getTypedRuleContext(NumberContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpNumber($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpBoolContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpBool($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpComparisonContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorComparison(): ?OperatorComparisonContext
	    {
	    	return $this->getTypedRuleContext(OperatorComparisonContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpComparison($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpBitwiseContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorBitwise(): ?OperatorBitwiseContext
	    {
	    	return $this->getTypedRuleContext(OperatorBitwiseContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpBitwise($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpOrContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorOr(): ?OperatorOrContext
	    {
	    	return $this->getTypedRuleContext(OperatorOrContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpMulDivModContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorMulDivMod(): ?OperatorMulDivModContext
	    {
	    	return $this->getTypedRuleContext(OperatorMulDivModContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpMulDivMod($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpNullContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpNull($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpStringContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function string(): ?StringContext
	    {
	    	return $this->getTypedRuleContext(StringContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpString($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpPrefixContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function prefixexp(): ?PrefixexpContext
	    {
	    	return $this->getTypedRuleContext(PrefixexpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpPrefix($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpUnaryContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function operatorUnary(): ?OperatorUnaryContext
	    {
	    	return $this->getTypedRuleContext(OperatorUnaryContext::class, 0);
	    }

	    public function exp(): ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpAndContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorAnd(): ?OperatorAndContext
	    {
	    	return $this->getTypedRuleContext(OperatorAndContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpElipsisContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpElipsis($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpFunctionContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function functiondef(): ?FunctiondefContext
	    {
	    	return $this->getTypedRuleContext(FunctiondefContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpFunction($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpPowerContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorPower(): ?OperatorPowerContext
	    {
	    	return $this->getTypedRuleContext(OperatorPowerContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpPower($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpConcatContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorStrcat(): ?OperatorStrcatContext
	    {
	    	return $this->getTypedRuleContext(OperatorStrcatContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpConcat($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpAddSubContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function operatorAddSub(): ?OperatorAddSubContext
	    {
	    	return $this->getTypedRuleContext(OperatorAddSubContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpAddSub($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpTableContext extends ExpContext
	{
		public function __construct(ExpContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function tableconstructor(): ?TableconstructorContext
	    {
	    	return $this->getTypedRuleContext(TableconstructorContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpTable($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrefixexpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_prefixexp;
	    }

	    public function varOrExp(): ?VarOrExpContext
	    {
	    	return $this->getTypedRuleContext(VarOrExpContext::class, 0);
	    }

	    /**
	     * @return array<NameAndArgsContext>|NameAndArgsContext|null
	     */
	    public function nameAndArgs(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(NameAndArgsContext::class);
	    	}

	        return $this->getTypedRuleContext(NameAndArgsContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitPrefixexp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctioncallContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_functioncall;
	    }

	    public function varOrExp(): ?VarOrExpContext
	    {
	    	return $this->getTypedRuleContext(VarOrExpContext::class, 0);
	    }

	    /**
	     * @return array<NameAndArgsContext>|NameAndArgsContext|null
	     */
	    public function nameAndArgs(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(NameAndArgsContext::class);
	    	}

	        return $this->getTypedRuleContext(NameAndArgsContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFunctioncall($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarOrExpContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_varOrExp;
	    }

	    public function variable(): ?VariableContext
	    {
	    	return $this->getTypedRuleContext(VariableContext::class, 0);
	    }

	    public function exp(): ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitVarOrExp($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VariableContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_variable;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class NameVariableContext extends VariableContext
	{
		public function __construct(VariableContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

	    /**
	     * @return array<VarSuffixContext>|VarSuffixContext|null
	     */
	    public function varSuffix(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(VarSuffixContext::class);
	    	}

	        return $this->getTypedRuleContext(VarSuffixContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitNameVariable($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExpVariableContext extends VariableContext
	{
		public function __construct(VariableContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function exp(): ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

	    /**
	     * @return array<VarSuffixContext>|VarSuffixContext|null
	     */
	    public function varSuffix(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(VarSuffixContext::class);
	    	}

	        return $this->getTypedRuleContext(VarSuffixContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpVariable($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarSuffixContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_varSuffix;
	    }

	    public function exp(): ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

	    /**
	     * @return array<NameAndArgsContext>|NameAndArgsContext|null
	     */
	    public function nameAndArgs(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(NameAndArgsContext::class);
	    	}

	        return $this->getTypedRuleContext(NameAndArgsContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitVarSuffix($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class NameAndArgsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_nameAndArgs;
	    }

	    public function args(): ?ArgsContext
	    {
	    	return $this->getTypedRuleContext(ArgsContext::class, 0);
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitNameAndArgs($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArgsContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_args;
	    }

	    public function explist(): ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

	    public function tableconstructor(): ?TableconstructorContext
	    {
	    	return $this->getTypedRuleContext(TableconstructorContext::class, 0);
	    }

	    public function string(): ?StringContext
	    {
	    	return $this->getTypedRuleContext(StringContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitArgs($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctiondefContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_functiondef;
	    }

	    public function funcbody(): ?FuncbodyContext
	    {
	    	return $this->getTypedRuleContext(FuncbodyContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFunctiondef($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FuncbodyContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_funcbody;
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parlist(): ?ParlistContext
	    {
	    	return $this->getTypedRuleContext(ParlistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFuncbody($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParlistContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_parlist;
	    }

	    public function namelist(): ?NamelistContext
	    {
	    	return $this->getTypedRuleContext(NamelistContext::class, 0);
	    }

	    public function elipsis(): ?ElipsisContext
	    {
	    	return $this->getTypedRuleContext(ElipsisContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitParlist($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ElipsisContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_elipsis;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitElipsis($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TableconstructorContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_tableconstructor;
	    }

	    public function fieldlist(): ?FieldlistContext
	    {
	    	return $this->getTypedRuleContext(FieldlistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitTableconstructor($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FieldlistContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_fieldlist;
	    }

	    /**
	     * @return array<FieldContext>|FieldContext|null
	     */
	    public function field(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(FieldContext::class);
	    	}

	        return $this->getTypedRuleContext(FieldContext::class, $index);
	    }

	    /**
	     * @return array<FieldsepContext>|FieldsepContext|null
	     */
	    public function fieldsep(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(FieldsepContext::class);
	    	}

	        return $this->getTypedRuleContext(FieldsepContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFieldlist($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FieldContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_field;
	    }

	    /**
	     * @return array<ExpContext>|ExpContext|null
	     */
	    public function exp(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpContext::class, $index);
	    }

	    public function NAME(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitField($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FieldsepContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_fieldsep;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitFieldsep($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorOrContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorOr;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorAndContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorAnd;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorComparisonContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorComparison;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorComparison($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorStrcatContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorStrcat;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorStrcat($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorAddSubContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorAddSub;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorAddSub($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorMulDivModContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorMulDivMod;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorMulDivMod($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorBitwiseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorBitwise;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorBitwise($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorUnaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorUnary;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperatorPowerContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_operatorPower;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitOperatorPower($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class NumberContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_number;
	    }

	    public function INT(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::INT, 0);
	    }

	    public function FLOAT(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::FLOAT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitNumber($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StringContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return LuaParser::RULE_string;
	    }

	    public function NORMALSTRING(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NORMALSTRING, 0);
	    }

	    public function CHARSTRING(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::CHARSTRING, 0);
	    }

	    public function LONGSTRING(): ?TerminalNode
	    {
	        return $this->getToken(LuaParser::LONGSTRING, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitString($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}