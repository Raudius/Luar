<?php

/*
 * Generated from Lua.g4 by ANTLR 4.9.3
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

		public const RULE_chunk = 0, RULE_block = 1, RULE_stat = 2, RULE_attnamelist = 3, 
               RULE_attrib = 4, RULE_laststat = 5, RULE_funcname = 6, RULE_funcname_method = 7, 
               RULE_varlist = 8, RULE_namelist = 9, RULE_explist = 10, RULE_exp = 11, 
               RULE_prefixexp = 12, RULE_functioncall = 13, RULE_varOrExp = 14, 
               RULE_variable = 15, RULE_varSuffix = 16, RULE_nameAndArgs = 17, 
               RULE_args = 18, RULE_functiondef = 19, RULE_funcbody = 20, 
               RULE_parlist = 21, RULE_elipsis = 22, RULE_tableconstructor = 23, 
               RULE_fieldlist = 24, RULE_field = 25, RULE_fieldsep = 26, 
               RULE_operatorOr = 27, RULE_operatorAnd = 28, RULE_operatorComparison = 29, 
               RULE_operatorStrcat = 30, RULE_operatorAddSub = 31, RULE_operatorMulDivMod = 32, 
               RULE_operatorBitwise = 33, RULE_operatorUnary = 34, RULE_operatorPower = 35, 
               RULE_number = 36, RULE_string = 37;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'chunk', 'block', 'stat', 'attnamelist', 'attrib', 'laststat', 'funcname', 
			'funcname_method', 'varlist', 'namelist', 'explist', 'exp', 'prefixexp', 
			'functioncall', 'varOrExp', 'variable', 'varSuffix', 'nameAndArgs', 'args', 
			'functiondef', 'funcbody', 'parlist', 'elipsis', 'tableconstructor', 
			'fieldlist', 'field', 'fieldsep', 'operatorOr', 'operatorAnd', 'operatorComparison', 
			'operatorStrcat', 'operatorAddSub', 'operatorMulDivMod', 'operatorBitwise', 
			'operatorUnary', 'operatorPower', 'number', 'string'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "';'", "'='", "'break'", "'do'", "'end'", "'while'", "'repeat'", 
		    "'until'", "'if'", "'then'", "'elseif'", "'else'", "'for'", "','", 
		    "'in'", "'function'", "'local'", "'<'", "'>'", "'return'", "'continue'", 
		    "'.'", "':'", "'nil'", "'false'", "'true'", "'...'", "'('", "')'", 
		    "'['", "']'", "'{'", "'}'", "'or'", "'and'", "'<='", "'>='", "'~='", 
		    "'=='", "'..'", "'+'", "'-'", "'*'", "'/'", "'%'", "'//'", "'&'", 
		    "'|'", "'~'", "'<<'", "'>>'", "'not'", "'#'", "'^'"
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

		/**
		 * @var string
		 */
		private const SERIALIZED_ATN =
			"\u{3}\u{608B}\u{A72A}\u{8133}\u{B9ED}\u{417C}\u{3BE7}\u{7786}\u{5964}" .
		    "\u{3}\u{42}\u{1AD}\u{4}\u{2}\u{9}\u{2}\u{4}\u{3}\u{9}\u{3}\u{4}\u{4}" .
		    "\u{9}\u{4}\u{4}\u{5}\u{9}\u{5}\u{4}\u{6}\u{9}\u{6}\u{4}\u{7}\u{9}" .
		    "\u{7}\u{4}\u{8}\u{9}\u{8}\u{4}\u{9}\u{9}\u{9}\u{4}\u{A}\u{9}\u{A}" .
		    "\u{4}\u{B}\u{9}\u{B}\u{4}\u{C}\u{9}\u{C}\u{4}\u{D}\u{9}\u{D}\u{4}" .
		    "\u{E}\u{9}\u{E}\u{4}\u{F}\u{9}\u{F}\u{4}\u{10}\u{9}\u{10}\u{4}\u{11}" .
		    "\u{9}\u{11}\u{4}\u{12}\u{9}\u{12}\u{4}\u{13}\u{9}\u{13}\u{4}\u{14}" .
		    "\u{9}\u{14}\u{4}\u{15}\u{9}\u{15}\u{4}\u{16}\u{9}\u{16}\u{4}\u{17}" .
		    "\u{9}\u{17}\u{4}\u{18}\u{9}\u{18}\u{4}\u{19}\u{9}\u{19}\u{4}\u{1A}" .
		    "\u{9}\u{1A}\u{4}\u{1B}\u{9}\u{1B}\u{4}\u{1C}\u{9}\u{1C}\u{4}\u{1D}" .
		    "\u{9}\u{1D}\u{4}\u{1E}\u{9}\u{1E}\u{4}\u{1F}\u{9}\u{1F}\u{4}\u{20}" .
		    "\u{9}\u{20}\u{4}\u{21}\u{9}\u{21}\u{4}\u{22}\u{9}\u{22}\u{4}\u{23}" .
		    "\u{9}\u{23}\u{4}\u{24}\u{9}\u{24}\u{4}\u{25}\u{9}\u{25}\u{4}\u{26}" .
		    "\u{9}\u{26}\u{4}\u{27}\u{9}\u{27}\u{3}\u{2}\u{3}\u{2}\u{3}\u{2}\u{3}" .
		    "\u{3}\u{7}\u{3}\u{53}\u{A}\u{3}\u{C}\u{3}\u{E}\u{3}\u{56}\u{B}\u{3}" .
		    "\u{3}\u{3}\u{5}\u{3}\u{59}\u{A}\u{3}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}" .
		    "\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}" .
		    "\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{7}\u{4}\u{7A}\u{A}\u{4}\u{C}\u{4}\u{E}\u{4}" .
		    "\u{7D}\u{B}\u{4}\u{3}\u{4}\u{3}\u{4}\u{5}\u{4}\u{81}\u{A}\u{4}\u{3}" .
		    "\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{5}\u{4}\u{8D}\u{A}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}" .
		    "\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}" .
		    "\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}" .
		    "\u{4}\u{3}\u{4}\u{3}\u{4}\u{3}\u{4}\u{5}\u{4}\u{A7}\u{A}\u{4}\u{5}" .
		    "\u{4}\u{A9}\u{A}\u{4}\u{3}\u{5}\u{3}\u{5}\u{3}\u{5}\u{3}\u{5}\u{3}" .
		    "\u{5}\u{7}\u{5}\u{B0}\u{A}\u{5}\u{C}\u{5}\u{E}\u{5}\u{B3}\u{B}\u{5}" .
		    "\u{3}\u{6}\u{3}\u{6}\u{3}\u{6}\u{5}\u{6}\u{B8}\u{A}\u{6}\u{3}\u{7}" .
		    "\u{3}\u{7}\u{5}\u{7}\u{BC}\u{A}\u{7}\u{3}\u{7}\u{3}\u{7}\u{3}\u{7}" .
		    "\u{5}\u{7}\u{C1}\u{A}\u{7}\u{5}\u{7}\u{C3}\u{A}\u{7}\u{3}\u{8}\u{3}" .
		    "\u{8}\u{3}\u{8}\u{7}\u{8}\u{C8}\u{A}\u{8}\u{C}\u{8}\u{E}\u{8}\u{CB}" .
		    "\u{B}\u{8}\u{3}\u{8}\u{5}\u{8}\u{CE}\u{A}\u{8}\u{3}\u{9}\u{3}\u{9}" .
		    "\u{3}\u{9}\u{3}\u{A}\u{3}\u{A}\u{3}\u{A}\u{7}\u{A}\u{D6}\u{A}\u{A}" .
		    "\u{C}\u{A}\u{E}\u{A}\u{D9}\u{B}\u{A}\u{3}\u{B}\u{3}\u{B}\u{3}\u{B}" .
		    "\u{7}\u{B}\u{DE}\u{A}\u{B}\u{C}\u{B}\u{E}\u{B}\u{E1}\u{B}\u{B}\u{3}" .
		    "\u{C}\u{3}\u{C}\u{3}\u{C}\u{7}\u{C}\u{E6}\u{A}\u{C}\u{C}\u{C}\u{E}" .
		    "\u{C}\u{E9}\u{B}\u{C}\u{3}\u{C}\u{3}\u{C}\u{3}\u{D}\u{3}\u{D}\u{3}" .
		    "\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}" .
		    "\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{5}\u{D}\u{F9}\u{A}\u{D}\u{3}\u{D}" .
		    "\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}" .
		    "\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}" .
		    "\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}" .
		    "\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}" .
		    "\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{3}\u{D}\u{7}\u{D}\u{11B}" .
		    "\u{A}\u{D}\u{C}\u{D}\u{E}\u{D}\u{11E}\u{B}\u{D}\u{3}\u{E}\u{3}\u{E}" .
		    "\u{7}\u{E}\u{122}\u{A}\u{E}\u{C}\u{E}\u{E}\u{E}\u{125}\u{B}\u{E}\u{3}" .
		    "\u{F}\u{3}\u{F}\u{6}\u{F}\u{129}\u{A}\u{F}\u{D}\u{F}\u{E}\u{F}\u{12A}" .
		    "\u{3}\u{10}\u{3}\u{10}\u{3}\u{10}\u{3}\u{10}\u{3}\u{10}\u{5}\u{10}" .
		    "\u{132}\u{A}\u{10}\u{3}\u{11}\u{3}\u{11}\u{7}\u{11}\u{136}\u{A}\u{11}" .
		    "\u{C}\u{11}\u{E}\u{11}\u{139}\u{B}\u{11}\u{3}\u{11}\u{3}\u{11}\u{3}" .
		    "\u{11}\u{3}\u{11}\u{6}\u{11}\u{13F}\u{A}\u{11}\u{D}\u{11}\u{E}\u{11}" .
		    "\u{140}\u{5}\u{11}\u{143}\u{A}\u{11}\u{3}\u{12}\u{7}\u{12}\u{146}" .
		    "\u{A}\u{12}\u{C}\u{12}\u{E}\u{12}\u{149}\u{B}\u{12}\u{3}\u{12}\u{3}" .
		    "\u{12}\u{3}\u{12}\u{3}\u{12}\u{3}\u{12}\u{3}\u{12}\u{5}\u{12}\u{151}" .
		    "\u{A}\u{12}\u{3}\u{13}\u{3}\u{13}\u{5}\u{13}\u{155}\u{A}\u{13}\u{3}" .
		    "\u{13}\u{3}\u{13}\u{3}\u{14}\u{3}\u{14}\u{5}\u{14}\u{15B}\u{A}\u{14}" .
		    "\u{3}\u{14}\u{3}\u{14}\u{3}\u{14}\u{5}\u{14}\u{160}\u{A}\u{14}\u{3}" .
		    "\u{15}\u{3}\u{15}\u{3}\u{15}\u{3}\u{16}\u{3}\u{16}\u{5}\u{16}\u{167}" .
		    "\u{A}\u{16}\u{3}\u{16}\u{3}\u{16}\u{3}\u{16}\u{3}\u{16}\u{3}\u{17}" .
		    "\u{3}\u{17}\u{3}\u{17}\u{5}\u{17}\u{170}\u{A}\u{17}\u{3}\u{17}\u{5}" .
		    "\u{17}\u{173}\u{A}\u{17}\u{3}\u{18}\u{3}\u{18}\u{3}\u{19}\u{3}\u{19}" .
		    "\u{5}\u{19}\u{179}\u{A}\u{19}\u{3}\u{19}\u{3}\u{19}\u{3}\u{1A}\u{3}" .
		    "\u{1A}\u{3}\u{1A}\u{3}\u{1A}\u{7}\u{1A}\u{181}\u{A}\u{1A}\u{C}\u{1A}" .
		    "\u{E}\u{1A}\u{184}\u{B}\u{1A}\u{3}\u{1A}\u{5}\u{1A}\u{187}\u{A}\u{1A}" .
		    "\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1B}" .
		    "\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1B}\u{3}\u{1B}\u{5}\u{1B}\u{193}\u{A}" .
		    "\u{1B}\u{3}\u{1C}\u{3}\u{1C}\u{3}\u{1D}\u{3}\u{1D}\u{3}\u{1E}\u{3}" .
		    "\u{1E}\u{3}\u{1F}\u{3}\u{1F}\u{3}\u{20}\u{3}\u{20}\u{3}\u{21}\u{3}" .
		    "\u{21}\u{3}\u{22}\u{3}\u{22}\u{3}\u{23}\u{3}\u{23}\u{3}\u{24}\u{3}" .
		    "\u{24}\u{3}\u{25}\u{3}\u{25}\u{3}\u{26}\u{3}\u{26}\u{3}\u{27}\u{3}" .
		    "\u{27}\u{3}\u{27}\u{2}\u{3}\u{18}\u{28}\u{2}\u{4}\u{6}\u{8}\u{A}\u{C}" .
		    "\u{E}\u{10}\u{12}\u{14}\u{16}\u{18}\u{1A}\u{1C}\u{1E}\u{20}\u{22}" .
		    "\u{24}\u{26}\u{28}\u{2A}\u{2C}\u{2E}\u{30}\u{32}\u{34}\u{36}\u{38}" .
		    "\u{3A}\u{3C}\u{3E}\u{40}\u{42}\u{44}\u{46}\u{48}\u{4A}\u{4C}\u{2}" .
		    "\u{B}\u{3}\u{2}\u{1B}\u{1C}\u{4}\u{2}\u{3}\u{3}\u{10}\u{10}\u{4}\u{2}" .
		    "\u{14}\u{15}\u{26}\u{29}\u{3}\u{2}\u{2B}\u{2C}\u{3}\u{2}\u{2D}\u{30}" .
		    "\u{3}\u{2}\u{31}\u{35}\u{5}\u{2}\u{2C}\u{2C}\u{33}\u{33}\u{36}\u{37}" .
		    "\u{3}\u{2}\u{3D}\u{3E}\u{3}\u{2}\u{3A}\u{3C}\u{2}\u{1C7}\u{2}\u{4E}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{4}\u{54}\u{3}\u{2}\u{2}\u{2}\u{6}\u{A8}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{8}\u{AA}\u{3}\u{2}\u{2}\u{2}\u{A}\u{B7}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{C}\u{C2}\u{3}\u{2}\u{2}\u{2}\u{E}\u{C4}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{10}\u{CF}\u{3}\u{2}\u{2}\u{2}\u{12}\u{D2}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{14}\u{DA}\u{3}\u{2}\u{2}\u{2}\u{16}\u{E7}\u{3}\u{2}\u{2}\u{2}\u{18}" .
		    "\u{F8}\u{3}\u{2}\u{2}\u{2}\u{1A}\u{11F}\u{3}\u{2}\u{2}\u{2}\u{1C}" .
		    "\u{126}\u{3}\u{2}\u{2}\u{2}\u{1E}\u{131}\u{3}\u{2}\u{2}\u{2}\u{20}" .
		    "\u{142}\u{3}\u{2}\u{2}\u{2}\u{22}\u{147}\u{3}\u{2}\u{2}\u{2}\u{24}" .
		    "\u{154}\u{3}\u{2}\u{2}\u{2}\u{26}\u{15F}\u{3}\u{2}\u{2}\u{2}\u{28}" .
		    "\u{161}\u{3}\u{2}\u{2}\u{2}\u{2A}\u{164}\u{3}\u{2}\u{2}\u{2}\u{2C}" .
		    "\u{172}\u{3}\u{2}\u{2}\u{2}\u{2E}\u{174}\u{3}\u{2}\u{2}\u{2}\u{30}" .
		    "\u{176}\u{3}\u{2}\u{2}\u{2}\u{32}\u{17C}\u{3}\u{2}\u{2}\u{2}\u{34}" .
		    "\u{192}\u{3}\u{2}\u{2}\u{2}\u{36}\u{194}\u{3}\u{2}\u{2}\u{2}\u{38}" .
		    "\u{196}\u{3}\u{2}\u{2}\u{2}\u{3A}\u{198}\u{3}\u{2}\u{2}\u{2}\u{3C}" .
		    "\u{19A}\u{3}\u{2}\u{2}\u{2}\u{3E}\u{19C}\u{3}\u{2}\u{2}\u{2}\u{40}" .
		    "\u{19E}\u{3}\u{2}\u{2}\u{2}\u{42}\u{1A0}\u{3}\u{2}\u{2}\u{2}\u{44}" .
		    "\u{1A2}\u{3}\u{2}\u{2}\u{2}\u{46}\u{1A4}\u{3}\u{2}\u{2}\u{2}\u{48}" .
		    "\u{1A6}\u{3}\u{2}\u{2}\u{2}\u{4A}\u{1A8}\u{3}\u{2}\u{2}\u{2}\u{4C}" .
		    "\u{1AA}\u{3}\u{2}\u{2}\u{2}\u{4E}\u{4F}\u{5}\u{4}\u{3}\u{2}\u{4F}" .
		    "\u{50}\u{7}\u{2}\u{2}\u{3}\u{50}\u{3}\u{3}\u{2}\u{2}\u{2}\u{51}\u{53}" .
		    "\u{5}\u{6}\u{4}\u{2}\u{52}\u{51}\u{3}\u{2}\u{2}\u{2}\u{53}\u{56}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{54}\u{52}\u{3}\u{2}\u{2}\u{2}\u{54}\u{55}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{55}\u{58}\u{3}\u{2}\u{2}\u{2}\u{56}\u{54}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{57}\u{59}\u{5}\u{C}\u{7}\u{2}\u{58}\u{57}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{58}\u{59}\u{3}\u{2}\u{2}\u{2}\u{59}\u{5}\u{3}\u{2}\u{2}\u{2}\u{5A}" .
		    "\u{A9}\u{7}\u{3}\u{2}\u{2}\u{5B}\u{5C}\u{5}\u{12}\u{A}\u{2}\u{5C}" .
		    "\u{5D}\u{7}\u{4}\u{2}\u{2}\u{5D}\u{5E}\u{5}\u{16}\u{C}\u{2}\u{5E}" .
		    "\u{A9}\u{3}\u{2}\u{2}\u{2}\u{5F}\u{A9}\u{5}\u{1C}\u{F}\u{2}\u{60}" .
		    "\u{A9}\u{7}\u{5}\u{2}\u{2}\u{61}\u{62}\u{7}\u{6}\u{2}\u{2}\u{62}\u{63}" .
		    "\u{5}\u{4}\u{3}\u{2}\u{63}\u{64}\u{7}\u{7}\u{2}\u{2}\u{64}\u{A9}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{65}\u{66}\u{7}\u{8}\u{2}\u{2}\u{66}\u{67}\u{5}\u{18}" .
		    "\u{D}\u{2}\u{67}\u{68}\u{7}\u{6}\u{2}\u{2}\u{68}\u{69}\u{5}\u{4}\u{3}" .
		    "\u{2}\u{69}\u{6A}\u{7}\u{7}\u{2}\u{2}\u{6A}\u{A9}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{6B}\u{6C}\u{7}\u{9}\u{2}\u{2}\u{6C}\u{6D}\u{5}\u{4}\u{3}\u{2}\u{6D}" .
		    "\u{6E}\u{7}\u{A}\u{2}\u{2}\u{6E}\u{6F}\u{5}\u{18}\u{D}\u{2}\u{6F}" .
		    "\u{A9}\u{3}\u{2}\u{2}\u{2}\u{70}\u{71}\u{7}\u{B}\u{2}\u{2}\u{71}\u{72}" .
		    "\u{5}\u{18}\u{D}\u{2}\u{72}\u{73}\u{7}\u{C}\u{2}\u{2}\u{73}\u{7B}" .
		    "\u{5}\u{4}\u{3}\u{2}\u{74}\u{75}\u{7}\u{D}\u{2}\u{2}\u{75}\u{76}\u{5}" .
		    "\u{18}\u{D}\u{2}\u{76}\u{77}\u{7}\u{C}\u{2}\u{2}\u{77}\u{78}\u{5}" .
		    "\u{4}\u{3}\u{2}\u{78}\u{7A}\u{3}\u{2}\u{2}\u{2}\u{79}\u{74}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{7A}\u{7D}\u{3}\u{2}\u{2}\u{2}\u{7B}\u{79}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{7B}\u{7C}\u{3}\u{2}\u{2}\u{2}\u{7C}\u{80}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{7D}\u{7B}\u{3}\u{2}\u{2}\u{2}\u{7E}\u{7F}\u{7}\u{E}\u{2}\u{2}\u{7F}" .
		    "\u{81}\u{5}\u{4}\u{3}\u{2}\u{80}\u{7E}\u{3}\u{2}\u{2}\u{2}\u{80}\u{81}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{81}\u{82}\u{3}\u{2}\u{2}\u{2}\u{82}\u{83}\u{7}" .
		    "\u{7}\u{2}\u{2}\u{83}\u{A9}\u{3}\u{2}\u{2}\u{2}\u{84}\u{85}\u{7}\u{F}" .
		    "\u{2}\u{2}\u{85}\u{86}\u{7}\u{39}\u{2}\u{2}\u{86}\u{87}\u{7}\u{4}" .
		    "\u{2}\u{2}\u{87}\u{88}\u{5}\u{18}\u{D}\u{2}\u{88}\u{89}\u{7}\u{10}" .
		    "\u{2}\u{2}\u{89}\u{8C}\u{5}\u{18}\u{D}\u{2}\u{8A}\u{8B}\u{7}\u{10}" .
		    "\u{2}\u{2}\u{8B}\u{8D}\u{5}\u{18}\u{D}\u{2}\u{8C}\u{8A}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{8C}\u{8D}\u{3}\u{2}\u{2}\u{2}\u{8D}\u{8E}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{8E}\u{8F}\u{7}\u{6}\u{2}\u{2}\u{8F}\u{90}\u{5}\u{4}\u{3}\u{2}" .
		    "\u{90}\u{91}\u{7}\u{7}\u{2}\u{2}\u{91}\u{A9}\u{3}\u{2}\u{2}\u{2}\u{92}" .
		    "\u{93}\u{7}\u{F}\u{2}\u{2}\u{93}\u{94}\u{5}\u{14}\u{B}\u{2}\u{94}" .
		    "\u{95}\u{7}\u{11}\u{2}\u{2}\u{95}\u{96}\u{5}\u{16}\u{C}\u{2}\u{96}" .
		    "\u{97}\u{7}\u{6}\u{2}\u{2}\u{97}\u{98}\u{5}\u{4}\u{3}\u{2}\u{98}\u{99}" .
		    "\u{7}\u{7}\u{2}\u{2}\u{99}\u{A9}\u{3}\u{2}\u{2}\u{2}\u{9A}\u{9B}\u{7}" .
		    "\u{12}\u{2}\u{2}\u{9B}\u{9C}\u{5}\u{E}\u{8}\u{2}\u{9C}\u{9D}\u{5}" .
		    "\u{2A}\u{16}\u{2}\u{9D}\u{A9}\u{3}\u{2}\u{2}\u{2}\u{9E}\u{9F}\u{7}" .
		    "\u{13}\u{2}\u{2}\u{9F}\u{A0}\u{7}\u{12}\u{2}\u{2}\u{A0}\u{A1}\u{7}" .
		    "\u{39}\u{2}\u{2}\u{A1}\u{A9}\u{5}\u{2A}\u{16}\u{2}\u{A2}\u{A3}\u{7}" .
		    "\u{13}\u{2}\u{2}\u{A3}\u{A6}\u{5}\u{8}\u{5}\u{2}\u{A4}\u{A5}\u{7}" .
		    "\u{4}\u{2}\u{2}\u{A5}\u{A7}\u{5}\u{16}\u{C}\u{2}\u{A6}\u{A4}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{A6}\u{A7}\u{3}\u{2}\u{2}\u{2}\u{A7}\u{A9}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{A8}\u{5A}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{5B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{A8}\u{5F}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{60}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{A8}\u{61}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{65}\u{3}\u{2}\u{2}\u{2}\u{A8}" .
		    "\u{6B}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{70}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{84}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{A8}\u{92}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{9A}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{A8}\u{9E}\u{3}\u{2}\u{2}\u{2}\u{A8}\u{A2}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{A9}\u{7}\u{3}\u{2}\u{2}\u{2}\u{AA}\u{AB}\u{7}\u{39}\u{2}" .
		    "\u{2}\u{AB}\u{B1}\u{5}\u{A}\u{6}\u{2}\u{AC}\u{AD}\u{7}\u{10}\u{2}" .
		    "\u{2}\u{AD}\u{AE}\u{7}\u{39}\u{2}\u{2}\u{AE}\u{B0}\u{5}\u{A}\u{6}" .
		    "\u{2}\u{AF}\u{AC}\u{3}\u{2}\u{2}\u{2}\u{B0}\u{B3}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{B1}\u{AF}\u{3}\u{2}\u{2}\u{2}\u{B1}\u{B2}\u{3}\u{2}\u{2}\u{2}\u{B2}" .
		    "\u{9}\u{3}\u{2}\u{2}\u{2}\u{B3}\u{B1}\u{3}\u{2}\u{2}\u{2}\u{B4}\u{B5}" .
		    "\u{7}\u{14}\u{2}\u{2}\u{B5}\u{B6}\u{7}\u{39}\u{2}\u{2}\u{B6}\u{B8}" .
		    "\u{7}\u{15}\u{2}\u{2}\u{B7}\u{B4}\u{3}\u{2}\u{2}\u{2}\u{B7}\u{B8}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{B8}\u{B}\u{3}\u{2}\u{2}\u{2}\u{B9}\u{BB}\u{7}" .
		    "\u{16}\u{2}\u{2}\u{BA}\u{BC}\u{5}\u{16}\u{C}\u{2}\u{BB}\u{BA}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{BB}\u{BC}\u{3}\u{2}\u{2}\u{2}\u{BC}\u{C3}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{BD}\u{C3}\u{7}\u{5}\u{2}\u{2}\u{BE}\u{C0}\u{7}\u{17}" .
		    "\u{2}\u{2}\u{BF}\u{C1}\u{7}\u{3}\u{2}\u{2}\u{C0}\u{BF}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{C0}\u{C1}\u{3}\u{2}\u{2}\u{2}\u{C1}\u{C3}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{C2}\u{B9}\u{3}\u{2}\u{2}\u{2}\u{C2}\u{BD}\u{3}\u{2}\u{2}\u{2}\u{C2}" .
		    "\u{BE}\u{3}\u{2}\u{2}\u{2}\u{C3}\u{D}\u{3}\u{2}\u{2}\u{2}\u{C4}\u{C9}" .
		    "\u{7}\u{39}\u{2}\u{2}\u{C5}\u{C6}\u{7}\u{18}\u{2}\u{2}\u{C6}\u{C8}" .
		    "\u{7}\u{39}\u{2}\u{2}\u{C7}\u{C5}\u{3}\u{2}\u{2}\u{2}\u{C8}\u{CB}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{C9}\u{C7}\u{3}\u{2}\u{2}\u{2}\u{C9}\u{CA}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{CA}\u{CD}\u{3}\u{2}\u{2}\u{2}\u{CB}\u{C9}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{CC}\u{CE}\u{5}\u{10}\u{9}\u{2}\u{CD}\u{CC}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{CD}\u{CE}\u{3}\u{2}\u{2}\u{2}\u{CE}\u{F}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{CF}\u{D0}\u{7}\u{19}\u{2}\u{2}\u{D0}\u{D1}\u{7}\u{39}\u{2}" .
		    "\u{2}\u{D1}\u{11}\u{3}\u{2}\u{2}\u{2}\u{D2}\u{D7}\u{5}\u{20}\u{11}" .
		    "\u{2}\u{D3}\u{D4}\u{7}\u{10}\u{2}\u{2}\u{D4}\u{D6}\u{5}\u{20}\u{11}" .
		    "\u{2}\u{D5}\u{D3}\u{3}\u{2}\u{2}\u{2}\u{D6}\u{D9}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{D7}\u{D5}\u{3}\u{2}\u{2}\u{2}\u{D7}\u{D8}\u{3}\u{2}\u{2}\u{2}\u{D8}" .
		    "\u{13}\u{3}\u{2}\u{2}\u{2}\u{D9}\u{D7}\u{3}\u{2}\u{2}\u{2}\u{DA}\u{DF}" .
		    "\u{7}\u{39}\u{2}\u{2}\u{DB}\u{DC}\u{7}\u{10}\u{2}\u{2}\u{DC}\u{DE}" .
		    "\u{7}\u{39}\u{2}\u{2}\u{DD}\u{DB}\u{3}\u{2}\u{2}\u{2}\u{DE}\u{E1}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{DF}\u{DD}\u{3}\u{2}\u{2}\u{2}\u{DF}\u{E0}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{E0}\u{15}\u{3}\u{2}\u{2}\u{2}\u{E1}\u{DF}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{E2}\u{E3}\u{5}\u{18}\u{D}\u{2}\u{E3}\u{E4}\u{7}\u{10}" .
		    "\u{2}\u{2}\u{E4}\u{E6}\u{3}\u{2}\u{2}\u{2}\u{E5}\u{E2}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{E6}\u{E9}\u{3}\u{2}\u{2}\u{2}\u{E7}\u{E5}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{E7}\u{E8}\u{3}\u{2}\u{2}\u{2}\u{E8}\u{EA}\u{3}\u{2}\u{2}\u{2}\u{E9}" .
		    "\u{E7}\u{3}\u{2}\u{2}\u{2}\u{EA}\u{EB}\u{5}\u{18}\u{D}\u{2}\u{EB}" .
		    "\u{17}\u{3}\u{2}\u{2}\u{2}\u{EC}\u{ED}\u{8}\u{D}\u{1}\u{2}\u{ED}\u{F9}" .
		    "\u{7}\u{1A}\u{2}\u{2}\u{EE}\u{F9}\u{9}\u{2}\u{2}\u{2}\u{EF}\u{F9}" .
		    "\u{5}\u{4A}\u{26}\u{2}\u{F0}\u{F9}\u{5}\u{4C}\u{27}\u{2}\u{F1}\u{F9}" .
		    "\u{7}\u{1D}\u{2}\u{2}\u{F2}\u{F9}\u{5}\u{28}\u{15}\u{2}\u{F3}\u{F9}" .
		    "\u{5}\u{1A}\u{E}\u{2}\u{F4}\u{F9}\u{5}\u{30}\u{19}\u{2}\u{F5}\u{F6}" .
		    "\u{5}\u{46}\u{24}\u{2}\u{F6}\u{F7}\u{5}\u{18}\u{D}\u{A}\u{F7}\u{F9}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{F8}\u{EC}\u{3}\u{2}\u{2}\u{2}\u{F8}\u{EE}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{F8}\u{EF}\u{3}\u{2}\u{2}\u{2}\u{F8}\u{F0}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{F8}\u{F1}\u{3}\u{2}\u{2}\u{2}\u{F8}\u{F2}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{F8}\u{F3}\u{3}\u{2}\u{2}\u{2}\u{F8}\u{F4}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{F8}\u{F5}\u{3}\u{2}\u{2}\u{2}\u{F9}\u{11C}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{FA}\u{FB}\u{C}\u{B}\u{2}\u{2}\u{FB}\u{FC}\u{5}\u{48}\u{25}\u{2}" .
		    "\u{FC}\u{FD}\u{5}\u{18}\u{D}\u{B}\u{FD}\u{11B}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{FE}\u{FF}\u{C}\u{9}\u{2}\u{2}\u{FF}\u{100}\u{5}\u{42}\u{22}\u{2}" .
		    "\u{100}\u{101}\u{5}\u{18}\u{D}\u{A}\u{101}\u{11B}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{102}\u{103}\u{C}\u{8}\u{2}\u{2}\u{103}\u{104}\u{5}\u{40}\u{21}" .
		    "\u{2}\u{104}\u{105}\u{5}\u{18}\u{D}\u{9}\u{105}\u{11B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{106}\u{107}\u{C}\u{7}\u{2}\u{2}\u{107}\u{108}\u{5}\u{3E}\u{20}" .
		    "\u{2}\u{108}\u{109}\u{5}\u{18}\u{D}\u{7}\u{109}\u{11B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{10A}\u{10B}\u{C}\u{6}\u{2}\u{2}\u{10B}\u{10C}\u{5}\u{3C}\u{1F}" .
		    "\u{2}\u{10C}\u{10D}\u{5}\u{18}\u{D}\u{7}\u{10D}\u{11B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{10E}\u{10F}\u{C}\u{5}\u{2}\u{2}\u{10F}\u{110}\u{5}\u{3A}\u{1E}" .
		    "\u{2}\u{110}\u{111}\u{5}\u{18}\u{D}\u{6}\u{111}\u{11B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{112}\u{113}\u{C}\u{4}\u{2}\u{2}\u{113}\u{114}\u{5}\u{38}\u{1D}" .
		    "\u{2}\u{114}\u{115}\u{5}\u{18}\u{D}\u{5}\u{115}\u{11B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{116}\u{117}\u{C}\u{3}\u{2}\u{2}\u{117}\u{118}\u{5}\u{44}\u{23}" .
		    "\u{2}\u{118}\u{119}\u{5}\u{18}\u{D}\u{4}\u{119}\u{11B}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11A}\u{FA}\u{3}\u{2}\u{2}\u{2}\u{11A}\u{FE}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11A}\u{102}\u{3}\u{2}\u{2}\u{2}\u{11A}\u{106}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11A}\u{10A}\u{3}\u{2}\u{2}\u{2}\u{11A}\u{10E}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11A}\u{112}\u{3}\u{2}\u{2}\u{2}\u{11A}\u{116}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11B}\u{11E}\u{3}\u{2}\u{2}\u{2}\u{11C}\u{11A}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11C}\u{11D}\u{3}\u{2}\u{2}\u{2}\u{11D}\u{19}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{11E}\u{11C}\u{3}\u{2}\u{2}\u{2}\u{11F}\u{123}\u{5}\u{1E}\u{10}" .
		    "\u{2}\u{120}\u{122}\u{5}\u{24}\u{13}\u{2}\u{121}\u{120}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{122}\u{125}\u{3}\u{2}\u{2}\u{2}\u{123}\u{121}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{123}\u{124}\u{3}\u{2}\u{2}\u{2}\u{124}\u{1B}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{125}\u{123}\u{3}\u{2}\u{2}\u{2}\u{126}\u{128}\u{5}\u{1E}" .
		    "\u{10}\u{2}\u{127}\u{129}\u{5}\u{24}\u{13}\u{2}\u{128}\u{127}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{129}\u{12A}\u{3}\u{2}\u{2}\u{2}\u{12A}\u{128}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{12A}\u{12B}\u{3}\u{2}\u{2}\u{2}\u{12B}\u{1D}\u{3}" .
		    "\u{2}\u{2}\u{2}\u{12C}\u{132}\u{5}\u{20}\u{11}\u{2}\u{12D}\u{12E}" .
		    "\u{7}\u{1E}\u{2}\u{2}\u{12E}\u{12F}\u{5}\u{18}\u{D}\u{2}\u{12F}\u{130}" .
		    "\u{7}\u{1F}\u{2}\u{2}\u{130}\u{132}\u{3}\u{2}\u{2}\u{2}\u{131}\u{12C}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{131}\u{12D}\u{3}\u{2}\u{2}\u{2}\u{132}\u{1F}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{133}\u{137}\u{7}\u{39}\u{2}\u{2}\u{134}\u{136}" .
		    "\u{5}\u{22}\u{12}\u{2}\u{135}\u{134}\u{3}\u{2}\u{2}\u{2}\u{136}\u{139}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{137}\u{135}\u{3}\u{2}\u{2}\u{2}\u{137}\u{138}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{138}\u{143}\u{3}\u{2}\u{2}\u{2}\u{139}\u{137}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{13A}\u{13B}\u{7}\u{1E}\u{2}\u{2}\u{13B}\u{13C}" .
		    "\u{5}\u{18}\u{D}\u{2}\u{13C}\u{13E}\u{7}\u{1F}\u{2}\u{2}\u{13D}\u{13F}" .
		    "\u{5}\u{22}\u{12}\u{2}\u{13E}\u{13D}\u{3}\u{2}\u{2}\u{2}\u{13F}\u{140}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{140}\u{13E}\u{3}\u{2}\u{2}\u{2}\u{140}\u{141}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{141}\u{143}\u{3}\u{2}\u{2}\u{2}\u{142}\u{133}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{142}\u{13A}\u{3}\u{2}\u{2}\u{2}\u{143}\u{21}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{144}\u{146}\u{5}\u{24}\u{13}\u{2}\u{145}\u{144}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{146}\u{149}\u{3}\u{2}\u{2}\u{2}\u{147}\u{145}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{147}\u{148}\u{3}\u{2}\u{2}\u{2}\u{148}\u{150}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{149}\u{147}\u{3}\u{2}\u{2}\u{2}\u{14A}\u{14B}" .
		    "\u{7}\u{20}\u{2}\u{2}\u{14B}\u{14C}\u{5}\u{18}\u{D}\u{2}\u{14C}\u{14D}" .
		    "\u{7}\u{21}\u{2}\u{2}\u{14D}\u{151}\u{3}\u{2}\u{2}\u{2}\u{14E}\u{14F}" .
		    "\u{7}\u{18}\u{2}\u{2}\u{14F}\u{151}\u{7}\u{39}\u{2}\u{2}\u{150}\u{14A}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{150}\u{14E}\u{3}\u{2}\u{2}\u{2}\u{151}\u{23}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{152}\u{153}\u{7}\u{19}\u{2}\u{2}\u{153}\u{155}" .
		    "\u{7}\u{39}\u{2}\u{2}\u{154}\u{152}\u{3}\u{2}\u{2}\u{2}\u{154}\u{155}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{155}\u{156}\u{3}\u{2}\u{2}\u{2}\u{156}\u{157}" .
		    "\u{5}\u{26}\u{14}\u{2}\u{157}\u{25}\u{3}\u{2}\u{2}\u{2}\u{158}\u{15A}" .
		    "\u{7}\u{1E}\u{2}\u{2}\u{159}\u{15B}\u{5}\u{16}\u{C}\u{2}\u{15A}\u{159}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{15A}\u{15B}\u{3}\u{2}\u{2}\u{2}\u{15B}\u{15C}" .
		    "\u{3}\u{2}\u{2}\u{2}\u{15C}\u{160}\u{7}\u{1F}\u{2}\u{2}\u{15D}\u{160}" .
		    "\u{5}\u{30}\u{19}\u{2}\u{15E}\u{160}\u{5}\u{4C}\u{27}\u{2}\u{15F}" .
		    "\u{158}\u{3}\u{2}\u{2}\u{2}\u{15F}\u{15D}\u{3}\u{2}\u{2}\u{2}\u{15F}" .
		    "\u{15E}\u{3}\u{2}\u{2}\u{2}\u{160}\u{27}\u{3}\u{2}\u{2}\u{2}\u{161}" .
		    "\u{162}\u{7}\u{12}\u{2}\u{2}\u{162}\u{163}\u{5}\u{2A}\u{16}\u{2}\u{163}" .
		    "\u{29}\u{3}\u{2}\u{2}\u{2}\u{164}\u{166}\u{7}\u{1E}\u{2}\u{2}\u{165}" .
		    "\u{167}\u{5}\u{2C}\u{17}\u{2}\u{166}\u{165}\u{3}\u{2}\u{2}\u{2}\u{166}" .
		    "\u{167}\u{3}\u{2}\u{2}\u{2}\u{167}\u{168}\u{3}\u{2}\u{2}\u{2}\u{168}" .
		    "\u{169}\u{7}\u{1F}\u{2}\u{2}\u{169}\u{16A}\u{5}\u{4}\u{3}\u{2}\u{16A}" .
		    "\u{16B}\u{7}\u{7}\u{2}\u{2}\u{16B}\u{2B}\u{3}\u{2}\u{2}\u{2}\u{16C}" .
		    "\u{16F}\u{5}\u{14}\u{B}\u{2}\u{16D}\u{16E}\u{7}\u{10}\u{2}\u{2}\u{16E}" .
		    "\u{170}\u{5}\u{2E}\u{18}\u{2}\u{16F}\u{16D}\u{3}\u{2}\u{2}\u{2}\u{16F}" .
		    "\u{170}\u{3}\u{2}\u{2}\u{2}\u{170}\u{173}\u{3}\u{2}\u{2}\u{2}\u{171}" .
		    "\u{173}\u{5}\u{2E}\u{18}\u{2}\u{172}\u{16C}\u{3}\u{2}\u{2}\u{2}\u{172}" .
		    "\u{171}\u{3}\u{2}\u{2}\u{2}\u{173}\u{2D}\u{3}\u{2}\u{2}\u{2}\u{174}" .
		    "\u{175}\u{7}\u{1D}\u{2}\u{2}\u{175}\u{2F}\u{3}\u{2}\u{2}\u{2}\u{176}" .
		    "\u{178}\u{7}\u{22}\u{2}\u{2}\u{177}\u{179}\u{5}\u{32}\u{1A}\u{2}\u{178}" .
		    "\u{177}\u{3}\u{2}\u{2}\u{2}\u{178}\u{179}\u{3}\u{2}\u{2}\u{2}\u{179}" .
		    "\u{17A}\u{3}\u{2}\u{2}\u{2}\u{17A}\u{17B}\u{7}\u{23}\u{2}\u{2}\u{17B}" .
		    "\u{31}\u{3}\u{2}\u{2}\u{2}\u{17C}\u{182}\u{5}\u{34}\u{1B}\u{2}\u{17D}" .
		    "\u{17E}\u{5}\u{36}\u{1C}\u{2}\u{17E}\u{17F}\u{5}\u{34}\u{1B}\u{2}" .
		    "\u{17F}\u{181}\u{3}\u{2}\u{2}\u{2}\u{180}\u{17D}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{181}\u{184}\u{3}\u{2}\u{2}\u{2}\u{182}\u{180}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{182}\u{183}\u{3}\u{2}\u{2}\u{2}\u{183}\u{186}\u{3}\u{2}\u{2}\u{2}" .
		    "\u{184}\u{182}\u{3}\u{2}\u{2}\u{2}\u{185}\u{187}\u{5}\u{36}\u{1C}" .
		    "\u{2}\u{186}\u{185}\u{3}\u{2}\u{2}\u{2}\u{186}\u{187}\u{3}\u{2}\u{2}" .
		    "\u{2}\u{187}\u{33}\u{3}\u{2}\u{2}\u{2}\u{188}\u{189}\u{7}\u{20}\u{2}" .
		    "\u{2}\u{189}\u{18A}\u{5}\u{18}\u{D}\u{2}\u{18A}\u{18B}\u{7}\u{21}" .
		    "\u{2}\u{2}\u{18B}\u{18C}\u{7}\u{4}\u{2}\u{2}\u{18C}\u{18D}\u{5}\u{18}" .
		    "\u{D}\u{2}\u{18D}\u{193}\u{3}\u{2}\u{2}\u{2}\u{18E}\u{18F}\u{7}\u{39}" .
		    "\u{2}\u{2}\u{18F}\u{190}\u{7}\u{4}\u{2}\u{2}\u{190}\u{193}\u{5}\u{18}" .
		    "\u{D}\u{2}\u{191}\u{193}\u{5}\u{18}\u{D}\u{2}\u{192}\u{188}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{192}\u{18E}\u{3}\u{2}\u{2}\u{2}\u{192}\u{191}\u{3}\u{2}" .
		    "\u{2}\u{2}\u{193}\u{35}\u{3}\u{2}\u{2}\u{2}\u{194}\u{195}\u{9}\u{3}" .
		    "\u{2}\u{2}\u{195}\u{37}\u{3}\u{2}\u{2}\u{2}\u{196}\u{197}\u{7}\u{24}" .
		    "\u{2}\u{2}\u{197}\u{39}\u{3}\u{2}\u{2}\u{2}\u{198}\u{199}\u{7}\u{25}" .
		    "\u{2}\u{2}\u{199}\u{3B}\u{3}\u{2}\u{2}\u{2}\u{19A}\u{19B}\u{9}\u{4}" .
		    "\u{2}\u{2}\u{19B}\u{3D}\u{3}\u{2}\u{2}\u{2}\u{19C}\u{19D}\u{7}\u{2A}" .
		    "\u{2}\u{2}\u{19D}\u{3F}\u{3}\u{2}\u{2}\u{2}\u{19E}\u{19F}\u{9}\u{5}" .
		    "\u{2}\u{2}\u{19F}\u{41}\u{3}\u{2}\u{2}\u{2}\u{1A0}\u{1A1}\u{9}\u{6}" .
		    "\u{2}\u{2}\u{1A1}\u{43}\u{3}\u{2}\u{2}\u{2}\u{1A2}\u{1A3}\u{9}\u{7}" .
		    "\u{2}\u{2}\u{1A3}\u{45}\u{3}\u{2}\u{2}\u{2}\u{1A4}\u{1A5}\u{9}\u{8}" .
		    "\u{2}\u{2}\u{1A5}\u{47}\u{3}\u{2}\u{2}\u{2}\u{1A6}\u{1A7}\u{7}\u{38}" .
		    "\u{2}\u{2}\u{1A7}\u{49}\u{3}\u{2}\u{2}\u{2}\u{1A8}\u{1A9}\u{9}\u{9}" .
		    "\u{2}\u{2}\u{1A9}\u{4B}\u{3}\u{2}\u{2}\u{2}\u{1AA}\u{1AB}\u{9}\u{A}" .
		    "\u{2}\u{2}\u{1AB}\u{4D}\u{3}\u{2}\u{2}\u{2}\u{28}\u{54}\u{58}\u{7B}" .
		    "\u{80}\u{8C}\u{A6}\u{A8}\u{B1}\u{B7}\u{BB}\u{C0}\u{C2}\u{C9}\u{CD}" .
		    "\u{D7}\u{DF}\u{E7}\u{F8}\u{11A}\u{11C}\u{123}\u{12A}\u{131}\u{137}" .
		    "\u{140}\u{142}\u{147}\u{150}\u{154}\u{15A}\u{15F}\u{166}\u{16F}\u{172}" .
		    "\u{178}\u{182}\u{186}\u{192}";

		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize() : void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.9.3', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName() : string
		{
			return "Lua.g4";
		}

		public function getRuleNames() : array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN() : string
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN() : ATN
		{
			return self::$atn;
		}

		public function getVocabulary() : Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function chunk() : Context\ChunkContext
		{
		    $localContext = new Context\ChunkContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_chunk);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(76);
		        $this->block();
		        $this->setState(77);
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
		public function block() : Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(82);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 0, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(79);
		        		$this->stat(); 
		        	}

		        	$this->setState(84);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 0, $this->ctx);
		        }
		        $this->setState(86);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__2) | (1 << self::T__19) | (1 << self::T__20))) !== 0)) {
		        	$this->setState(85);
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
		public function stat() : Context\StatContext
		{
		    $localContext = new Context\StatContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_stat);

		    try {
		        $this->setState(166);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 6, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\SemicolonContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(88);
		        	    $this->match(self::T__0);
		        	break;

		        	case 2:
		        	    $localContext = new Context\StatAssignContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(89);
		        	    $this->varlist();
		        	    $this->setState(90);
		        	    $this->match(self::T__1);
		        	    $this->setState(91);
		        	    $this->explist();
		        	break;

		        	case 3:
		        	    $localContext = new Context\StatFunctionCallContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(93);
		        	    $this->functioncall();
		        	break;

		        	case 4:
		        	    $localContext = new Context\StatBreakContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(94);
		        	    $this->match(self::T__2);
		        	break;

		        	case 5:
		        	    $localContext = new Context\StatDoContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(95);
		        	    $this->match(self::T__3);
		        	    $this->setState(96);
		        	    $this->block();
		        	    $this->setState(97);
		        	    $this->match(self::T__4);
		        	break;

		        	case 6:
		        	    $localContext = new Context\StatWhileContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(99);
		        	    $this->match(self::T__5);
		        	    $this->setState(100);
		        	    $this->recursiveExp(0);
		        	    $this->setState(101);
		        	    $this->match(self::T__3);
		        	    $this->setState(102);
		        	    $this->block();
		        	    $this->setState(103);
		        	    $this->match(self::T__4);
		        	break;

		        	case 7:
		        	    $localContext = new Context\StatRepeatContext($localContext);
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(105);
		        	    $this->match(self::T__6);
		        	    $this->setState(106);
		        	    $this->block();
		        	    $this->setState(107);
		        	    $this->match(self::T__7);
		        	    $this->setState(108);
		        	    $this->recursiveExp(0);
		        	break;

		        	case 8:
		        	    $localContext = new Context\StatIfContext($localContext);
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(110);
		        	    $this->match(self::T__8);
		        	    $this->setState(111);
		        	    $this->recursiveExp(0);
		        	    $this->setState(112);
		        	    $this->match(self::T__9);
		        	    $this->setState(113);
		        	    $this->block();
		        	    $this->setState(121);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::T__10) {
		        	    	$this->setState(114);
		        	    	$this->match(self::T__10);
		        	    	$this->setState(115);
		        	    	$this->recursiveExp(0);
		        	    	$this->setState(116);
		        	    	$this->match(self::T__9);
		        	    	$this->setState(117);
		        	    	$this->block();
		        	    	$this->setState(123);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	    $this->setState(126);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__11) {
		        	    	$this->setState(124);
		        	    	$this->match(self::T__11);
		        	    	$this->setState(125);
		        	    	$this->block();
		        	    }
		        	    $this->setState(128);
		        	    $this->match(self::T__4);
		        	break;

		        	case 9:
		        	    $localContext = new Context\StatForContext($localContext);
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(130);
		        	    $this->match(self::T__12);
		        	    $this->setState(131);
		        	    $this->match(self::NAME);
		        	    $this->setState(132);
		        	    $this->match(self::T__1);
		        	    $this->setState(133);
		        	    $this->recursiveExp(0);
		        	    $this->setState(134);
		        	    $this->match(self::T__13);
		        	    $this->setState(135);
		        	    $this->recursiveExp(0);
		        	    $this->setState(138);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__13) {
		        	    	$this->setState(136);
		        	    	$this->match(self::T__13);
		        	    	$this->setState(137);
		        	    	$this->recursiveExp(0);
		        	    }
		        	    $this->setState(140);
		        	    $this->match(self::T__3);
		        	    $this->setState(141);
		        	    $this->block();
		        	    $this->setState(142);
		        	    $this->match(self::T__4);
		        	break;

		        	case 10:
		        	    $localContext = new Context\StatForEachContext($localContext);
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(144);
		        	    $this->match(self::T__12);
		        	    $this->setState(145);
		        	    $this->namelist();
		        	    $this->setState(146);
		        	    $this->match(self::T__14);
		        	    $this->setState(147);
		        	    $this->explist();
		        	    $this->setState(148);
		        	    $this->match(self::T__3);
		        	    $this->setState(149);
		        	    $this->block();
		        	    $this->setState(150);
		        	    $this->match(self::T__4);
		        	break;

		        	case 11:
		        	    $localContext = new Context\StatFunctionDeclareContext($localContext);
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(152);
		        	    $this->match(self::T__15);
		        	    $this->setState(153);
		        	    $this->funcname();
		        	    $this->setState(154);
		        	    $this->funcbody();
		        	break;

		        	case 12:
		        	    $localContext = new Context\StatLocalFunctionContext($localContext);
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(156);
		        	    $this->match(self::T__16);
		        	    $this->setState(157);
		        	    $this->match(self::T__15);
		        	    $this->setState(158);
		        	    $this->match(self::NAME);
		        	    $this->setState(159);
		        	    $this->funcbody();
		        	break;

		        	case 13:
		        	    $localContext = new Context\StatLocalVariableContext($localContext);
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(160);
		        	    $this->match(self::T__16);
		        	    $this->setState(161);
		        	    $this->attnamelist();
		        	    $this->setState(164);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__1) {
		        	    	$this->setState(162);
		        	    	$this->match(self::T__1);
		        	    	$this->setState(163);
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
		public function attnamelist() : Context\AttnamelistContext
		{
		    $localContext = new Context\AttnamelistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_attnamelist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(168);
		        $this->match(self::NAME);
		        $this->setState(169);
		        $this->attrib();
		        $this->setState(175);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(170);
		        	$this->match(self::T__13);
		        	$this->setState(171);
		        	$this->match(self::NAME);
		        	$this->setState(172);
		        	$this->attrib();
		        	$this->setState(177);
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
		public function attrib() : Context\AttribContext
		{
		    $localContext = new Context\AttribContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_attrib);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(181);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__17) {
		        	$this->setState(178);
		        	$this->match(self::T__17);
		        	$this->setState(179);
		        	$this->match(self::NAME);
		        	$this->setState(180);
		        	$this->match(self::T__18);
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
		public function laststat() : Context\LaststatContext
		{
		    $localContext = new Context\LaststatContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_laststat);

		    try {
		        $this->setState(192);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__19:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(183);
		            	$this->match(self::T__19);
		            	$this->setState(185);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__15) | (1 << self::T__23) | (1 << self::T__24) | (1 << self::T__25) | (1 << self::T__26) | (1 << self::T__27) | (1 << self::T__31) | (1 << self::T__41) | (1 << self::T__48) | (1 << self::T__51) | (1 << self::T__52) | (1 << self::NAME) | (1 << self::NORMALSTRING) | (1 << self::CHARSTRING) | (1 << self::LONGSTRING) | (1 << self::INT) | (1 << self::FLOAT))) !== 0)) {
		            		$this->setState(184);
		            		$this->explist();
		            	}
		            	break;

		            case self::T__2:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(187);
		            	$this->match(self::T__2);
		            	break;

		            case self::T__20:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(188);
		            	$this->match(self::T__20);
		            	$this->setState(190);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__0) {
		            		$this->setState(189);
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
		public function funcname() : Context\FuncnameContext
		{
		    $localContext = new Context\FuncnameContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_funcname);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(194);
		        $this->match(self::NAME);
		        $this->setState(199);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__21) {
		        	$this->setState(195);
		        	$this->match(self::T__21);
		        	$this->setState(196);
		        	$this->match(self::NAME);
		        	$this->setState(201);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(203);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__22) {
		        	$this->setState(202);
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
		public function funcname_method() : Context\Funcname_methodContext
		{
		    $localContext = new Context\Funcname_methodContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_funcname_method);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(205);
		        $this->match(self::T__22);
		        $this->setState(206);
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
		public function varlist() : Context\VarlistContext
		{
		    $localContext = new Context\VarlistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_varlist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(208);
		        $this->variable();
		        $this->setState(213);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(209);
		        	$this->match(self::T__13);
		        	$this->setState(210);
		        	$this->variable();
		        	$this->setState(215);
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
		public function namelist() : Context\NamelistContext
		{
		    $localContext = new Context\NamelistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_namelist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(216);
		        $this->match(self::NAME);
		        $this->setState(221);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 15, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(217);
		        		$this->match(self::T__13);
		        		$this->setState(218);
		        		$this->match(self::NAME); 
		        	}

		        	$this->setState(223);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 15, $this->ctx);
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
		public function explist() : Context\ExplistContext
		{
		    $localContext = new Context\ExplistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_explist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(229);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(224);
		        		$this->recursiveExp(0);
		        		$this->setState(225);
		        		$this->match(self::T__13); 
		        	}

		        	$this->setState(231);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx);
		        }
		        $this->setState(232);
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
		public function exp() : Context\ExpContext
		{
			return $this->recursiveExp(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursiveExp(int $precedence) : Context\ExpContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\ExpContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 22;
			$this->enterRecursionRule($localContext, 22, self::RULE_exp, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(246);
				$this->errorHandler->sync($this);

				switch ($this->input->LA(1)) {
				    case self::T__23:
				    	$localContext = new Context\ExpNullContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;


				    	$this->setState(235);
				    	$this->match(self::T__23);
				    	break;

				    case self::T__24:
				    case self::T__25:
				    	$localContext = new Context\ExpBoolContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(236);

				    	$_la = $this->input->LA(1);

				    	if (!($_la === self::T__24 || $_la === self::T__25)) {
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
				    	$this->setState(237);
				    	$this->number();
				    	break;

				    case self::NORMALSTRING:
				    case self::CHARSTRING:
				    case self::LONGSTRING:
				    	$localContext = new Context\ExpStringContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(238);
				    	$this->string();
				    	break;

				    case self::T__26:
				    	$localContext = new Context\ExpElipsisContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(239);
				    	$this->match(self::T__26);
				    	break;

				    case self::T__15:
				    	$localContext = new Context\ExpFunctionContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(240);
				    	$this->functiondef();
				    	break;

				    case self::T__27:
				    case self::NAME:
				    	$localContext = new Context\ExpPrefixContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(241);
				    	$this->prefixexp();
				    	break;

				    case self::T__31:
				    	$localContext = new Context\ExpTableContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(242);
				    	$this->tableconstructor();
				    	break;

				    case self::T__41:
				    case self::T__48:
				    case self::T__51:
				    case self::T__52:
				    	$localContext = new Context\ExpUnaryContext($localContext);
				    	$this->ctx = $localContext;
				    	$previousContext = $localContext;
				    	$this->setState(243);
				    	$this->operatorUnary();
				    	$this->setState(244);
				    	$this->recursiveExp(8);
				    	break;

				default:
					throw new NoViableAltException($this);
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(282);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(280);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx)) {
							case 1:
							    $localContext = new Context\ExpPowerContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(248);

							    if (!($this->precpred($this->ctx, 9))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 9)");
							    }
							    $this->setState(249);
							    $this->operatorPower();
							    $this->setState(250);
							    $this->recursiveExp(9);
							break;

							case 2:
							    $localContext = new Context\ExpMulDivModContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(252);

							    if (!($this->precpred($this->ctx, 7))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 7)");
							    }
							    $this->setState(253);
							    $this->operatorMulDivMod();
							    $this->setState(254);
							    $this->recursiveExp(8);
							break;

							case 3:
							    $localContext = new Context\ExpAddSubContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(256);

							    if (!($this->precpred($this->ctx, 6))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 6)");
							    }
							    $this->setState(257);
							    $this->operatorAddSub();
							    $this->setState(258);
							    $this->recursiveExp(7);
							break;

							case 4:
							    $localContext = new Context\ExpConcatContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(260);

							    if (!($this->precpred($this->ctx, 5))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 5)");
							    }
							    $this->setState(261);
							    $this->operatorStrcat();
							    $this->setState(262);
							    $this->recursiveExp(5);
							break;

							case 5:
							    $localContext = new Context\ExpComparisonContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(264);

							    if (!($this->precpred($this->ctx, 4))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 4)");
							    }
							    $this->setState(265);
							    $this->operatorComparison();
							    $this->setState(266);
							    $this->recursiveExp(5);
							break;

							case 6:
							    $localContext = new Context\ExpAndContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(268);

							    if (!($this->precpred($this->ctx, 3))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 3)");
							    }
							    $this->setState(269);
							    $this->operatorAnd();
							    $this->setState(270);
							    $this->recursiveExp(4);
							break;

							case 7:
							    $localContext = new Context\ExpOrContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(272);

							    if (!($this->precpred($this->ctx, 2))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 2)");
							    }
							    $this->setState(273);
							    $this->operatorOr();
							    $this->setState(274);
							    $this->recursiveExp(3);
							break;

							case 8:
							    $localContext = new Context\ExpBitwiseContext(new Context\ExpContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_exp);
							    $this->setState(276);

							    if (!($this->precpred($this->ctx, 1))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 1)");
							    }
							    $this->setState(277);
							    $this->operatorBitwise();
							    $this->setState(278);
							    $this->recursiveExp(2);
							break;
						} 
					}

					$this->setState(284);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx);
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
		public function prefixexp() : Context\PrefixexpContext
		{
		    $localContext = new Context\PrefixexpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_prefixexp);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(285);
		        $this->varOrExp();
		        $this->setState(289);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 20, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(286);
		        		$this->nameAndArgs(); 
		        	}

		        	$this->setState(291);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 20, $this->ctx);
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
		public function functioncall() : Context\FunctioncallContext
		{
		    $localContext = new Context\FunctioncallContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_functioncall);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(292);
		        $this->varOrExp();
		        $this->setState(294); 
		        $this->errorHandler->sync($this);

		        $alt = 1;

		        do {
		        	switch ($alt) {
		        	case 1:
		        		$this->setState(293);
		        		$this->nameAndArgs();
		        		break;
		        	default:
		        		throw new NoViableAltException($this);
		        	}

		        	$this->setState(296); 
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 21, $this->ctx);
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
		public function varOrExp() : Context\VarOrExpContext
		{
		    $localContext = new Context\VarOrExpContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_varOrExp);

		    try {
		        $this->setState(303);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 22, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(298);
		        	    $this->variable();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(299);
		        	    $this->match(self::T__27);
		        	    $this->setState(300);
		        	    $this->recursiveExp(0);
		        	    $this->setState(301);
		        	    $this->match(self::T__28);
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
		public function variable() : Context\VariableContext
		{
		    $localContext = new Context\VariableContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_variable);

		    try {
		        $this->setState(320);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NAME:
		            	$localContext = new Context\NameVariableContext($localContext);
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(305);
		            	$this->match(self::NAME);
		            	$this->setState(309);
		            	$this->errorHandler->sync($this);

		            	$alt = $this->getInterpreter()->adaptivePredict($this->input, 23, $this->ctx);

		            	while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		            		if ($alt === 1) {
		            			$this->setState(306);
		            			$this->varSuffix(); 
		            		}

		            		$this->setState(311);
		            		$this->errorHandler->sync($this);

		            		$alt = $this->getInterpreter()->adaptivePredict($this->input, 23, $this->ctx);
		            	}
		            	break;

		            case self::T__27:
		            	$localContext = new Context\ExpVariableContext($localContext);
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(312);
		            	$this->match(self::T__27);
		            	$this->setState(313);
		            	$this->recursiveExp(0);
		            	$this->setState(314);
		            	$this->match(self::T__28);
		            	$this->setState(316); 
		            	$this->errorHandler->sync($this);

		            	$alt = 1;

		            	do {
		            		switch ($alt) {
		            		case 1:
		            			$this->setState(315);
		            			$this->varSuffix();
		            			break;
		            		default:
		            			throw new NoViableAltException($this);
		            		}

		            		$this->setState(318); 
		            		$this->errorHandler->sync($this);

		            		$alt = $this->getInterpreter()->adaptivePredict($this->input, 24, $this->ctx);
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
		public function varSuffix() : Context\VarSuffixContext
		{
		    $localContext = new Context\VarSuffixContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_varSuffix);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(325);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__22) | (1 << self::T__27) | (1 << self::T__31) | (1 << self::NORMALSTRING) | (1 << self::CHARSTRING) | (1 << self::LONGSTRING))) !== 0)) {
		        	$this->setState(322);
		        	$this->nameAndArgs();
		        	$this->setState(327);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(334);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__29:
		            	$this->setState(328);
		            	$this->match(self::T__29);
		            	$this->setState(329);
		            	$this->recursiveExp(0);
		            	$this->setState(330);
		            	$this->match(self::T__30);
		            	break;

		            case self::T__21:
		            	$this->setState(332);
		            	$this->match(self::T__21);
		            	$this->setState(333);
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
		public function nameAndArgs() : Context\NameAndArgsContext
		{
		    $localContext = new Context\NameAndArgsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_nameAndArgs);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(338);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__22) {
		        	$this->setState(336);
		        	$this->match(self::T__22);
		        	$this->setState(337);
		        	$this->match(self::NAME);
		        }
		        $this->setState(340);
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
		public function args() : Context\ArgsContext
		{
		    $localContext = new Context\ArgsContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_args);

		    try {
		        $this->setState(349);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__27:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(342);
		            	$this->match(self::T__27);
		            	$this->setState(344);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__15) | (1 << self::T__23) | (1 << self::T__24) | (1 << self::T__25) | (1 << self::T__26) | (1 << self::T__27) | (1 << self::T__31) | (1 << self::T__41) | (1 << self::T__48) | (1 << self::T__51) | (1 << self::T__52) | (1 << self::NAME) | (1 << self::NORMALSTRING) | (1 << self::CHARSTRING) | (1 << self::LONGSTRING) | (1 << self::INT) | (1 << self::FLOAT))) !== 0)) {
		            		$this->setState(343);
		            		$this->explist();
		            	}
		            	$this->setState(346);
		            	$this->match(self::T__28);
		            	break;

		            case self::T__31:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(347);
		            	$this->tableconstructor();
		            	break;

		            case self::NORMALSTRING:
		            case self::CHARSTRING:
		            case self::LONGSTRING:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(348);
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
		public function functiondef() : Context\FunctiondefContext
		{
		    $localContext = new Context\FunctiondefContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_functiondef);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(351);
		        $this->match(self::T__15);
		        $this->setState(352);
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
		public function funcbody() : Context\FuncbodyContext
		{
		    $localContext = new Context\FuncbodyContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_funcbody);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(354);
		        $this->match(self::T__27);
		        $this->setState(356);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__26 || $_la === self::NAME) {
		        	$this->setState(355);
		        	$this->parlist();
		        }
		        $this->setState(358);
		        $this->match(self::T__28);
		        $this->setState(359);
		        $this->block();
		        $this->setState(360);
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
		public function parlist() : Context\ParlistContext
		{
		    $localContext = new Context\ParlistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_parlist);

		    try {
		        $this->setState(368);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::NAME:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(362);
		            	$this->namelist();
		            	$this->setState(365);
		            	$this->errorHandler->sync($this);
		            	$_la = $this->input->LA(1);

		            	if ($_la === self::T__13) {
		            		$this->setState(363);
		            		$this->match(self::T__13);
		            		$this->setState(364);
		            		$this->elipsis();
		            	}
		            	break;

		            case self::T__26:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(367);
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
		public function elipsis() : Context\ElipsisContext
		{
		    $localContext = new Context\ElipsisContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_elipsis);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(370);
		        $this->match(self::T__26);
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
		public function tableconstructor() : Context\TableconstructorContext
		{
		    $localContext = new Context\TableconstructorContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_tableconstructor);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(372);
		        $this->match(self::T__31);
		        $this->setState(374);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__15) | (1 << self::T__23) | (1 << self::T__24) | (1 << self::T__25) | (1 << self::T__26) | (1 << self::T__27) | (1 << self::T__29) | (1 << self::T__31) | (1 << self::T__41) | (1 << self::T__48) | (1 << self::T__51) | (1 << self::T__52) | (1 << self::NAME) | (1 << self::NORMALSTRING) | (1 << self::CHARSTRING) | (1 << self::LONGSTRING) | (1 << self::INT) | (1 << self::FLOAT))) !== 0)) {
		        	$this->setState(373);
		        	$this->fieldlist();
		        }
		        $this->setState(376);
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
		public function fieldlist() : Context\FieldlistContext
		{
		    $localContext = new Context\FieldlistContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_fieldlist);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(378);
		        $this->field();
		        $this->setState(384);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(379);
		        		$this->fieldsep();
		        		$this->setState(380);
		        		$this->field(); 
		        	}

		        	$this->setState(386);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx);
		        }
		        $this->setState(388);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__0 || $_la === self::T__13) {
		        	$this->setState(387);
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
		public function field() : Context\FieldContext
		{
		    $localContext = new Context\FieldContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_field);

		    try {
		        $this->setState(400);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(390);
		        	    $this->match(self::T__29);
		        	    $this->setState(391);
		        	    $this->recursiveExp(0);
		        	    $this->setState(392);
		        	    $this->match(self::T__30);
		        	    $this->setState(393);
		        	    $this->match(self::T__1);
		        	    $this->setState(394);
		        	    $this->recursiveExp(0);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(396);
		        	    $this->match(self::NAME);
		        	    $this->setState(397);
		        	    $this->match(self::T__1);
		        	    $this->setState(398);
		        	    $this->recursiveExp(0);
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(399);
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
		public function fieldsep() : Context\FieldsepContext
		{
		    $localContext = new Context\FieldsepContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_fieldsep);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(402);

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
		public function operatorOr() : Context\OperatorOrContext
		{
		    $localContext = new Context\OperatorOrContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_operatorOr);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(404);
		        $this->match(self::T__33);
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
		public function operatorAnd() : Context\OperatorAndContext
		{
		    $localContext = new Context\OperatorAndContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_operatorAnd);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(406);
		        $this->match(self::T__34);
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
		public function operatorComparison() : Context\OperatorComparisonContext
		{
		    $localContext = new Context\OperatorComparisonContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_operatorComparison);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(408);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__17) | (1 << self::T__18) | (1 << self::T__35) | (1 << self::T__36) | (1 << self::T__37) | (1 << self::T__38))) !== 0))) {
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
		public function operatorStrcat() : Context\OperatorStrcatContext
		{
		    $localContext = new Context\OperatorStrcatContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_operatorStrcat);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(410);
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
		public function operatorAddSub() : Context\OperatorAddSubContext
		{
		    $localContext = new Context\OperatorAddSubContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_operatorAddSub);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(412);

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
		public function operatorMulDivMod() : Context\OperatorMulDivModContext
		{
		    $localContext = new Context\OperatorMulDivModContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_operatorMulDivMod);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(414);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__42) | (1 << self::T__43) | (1 << self::T__44) | (1 << self::T__45))) !== 0))) {
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
		public function operatorBitwise() : Context\OperatorBitwiseContext
		{
		    $localContext = new Context\OperatorBitwiseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_operatorBitwise);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(416);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__46) | (1 << self::T__47) | (1 << self::T__48) | (1 << self::T__49) | (1 << self::T__50))) !== 0))) {
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
		public function operatorUnary() : Context\OperatorUnaryContext
		{
		    $localContext = new Context\OperatorUnaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_operatorUnary);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(418);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::T__41) | (1 << self::T__48) | (1 << self::T__51) | (1 << self::T__52))) !== 0))) {
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
		public function operatorPower() : Context\OperatorPowerContext
		{
		    $localContext = new Context\OperatorPowerContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_operatorPower);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(420);
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
		public function number() : Context\NumberContext
		{
		    $localContext = new Context\NumberContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 72, self::RULE_number);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(422);

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
		public function string() : Context\StringContext
		{
		    $localContext = new Context\StringContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 74, self::RULE_string);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(424);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & ((1 << self::NORMALSTRING) | (1 << self::CHARSTRING) | (1 << self::LONGSTRING))) !== 0))) {
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

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex) : bool
		{
			switch ($ruleIndex) {
					case 11:
						return $this->sempredExp($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredExp(?Context\ExpContext $localContext, int $predicateIndex) : bool
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_chunk;
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function EOF() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::EOF, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

	    public function laststat() : ?LaststatContext
	    {
	    	return $this->getTypedRuleContext(LaststatContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_stat;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
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

	    public function functioncall() : ?FunctioncallContext
	    {
	    	return $this->getTypedRuleContext(FunctioncallContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function accept(ParseTreeVisitor $visitor)
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

	    public function namelist() : ?NamelistContext
	    {
	    	return $this->getTypedRuleContext(NamelistContext::class, 0);
	    }

	    public function explist() : ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function attnamelist() : ?AttnamelistContext
	    {
	    	return $this->getTypedRuleContext(AttnamelistContext::class, 0);
	    }

	    public function explist() : ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function NAME() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

	    public function funcbody() : ?FuncbodyContext
	    {
	    	return $this->getTypedRuleContext(FuncbodyContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function exp() : ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function funcname() : ?FuncnameContext
	    {
	    	return $this->getTypedRuleContext(FuncnameContext::class, 0);
	    }

	    public function funcbody() : ?FuncbodyContext
	    {
	    	return $this->getTypedRuleContext(FuncbodyContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function varlist() : ?VarlistContext
	    {
	    	return $this->getTypedRuleContext(VarlistContext::class, 0);
	    }

	    public function explist() : ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function exp() : ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function accept(ParseTreeVisitor $visitor)
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

	    public function NAME() : ?TerminalNode
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

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitStatFor($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AttnamelistContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_attnamelist;
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

	    /**
	     * @return array<AttribContext>|AttribContext|null
	     */
	    public function attrib(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(AttribContext::class);
	    	}

	        return $this->getTypedRuleContext(AttribContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitAttnamelist($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AttribContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_attrib;
	    }

	    public function NAME() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitAttrib($this);
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_laststat;
	    }

	    public function explist() : ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

	    public function funcname_method() : ?Funcname_methodContext
	    {
	    	return $this->getTypedRuleContext(Funcname_methodContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_funcname_method;
	    }

	    public function NAME() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_exp;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
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

	    public function number() : ?NumberContext
	    {
	    	return $this->getTypedRuleContext(NumberContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function accept(ParseTreeVisitor $visitor)
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

	    public function operatorComparison() : ?OperatorComparisonContext
	    {
	    	return $this->getTypedRuleContext(OperatorComparisonContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpComparison($this);
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

	    public function operatorOr() : ?OperatorOrContext
	    {
	    	return $this->getTypedRuleContext(OperatorOrContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpOr($this);
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

	    public function operatorBitwise() : ?OperatorBitwiseContext
	    {
	    	return $this->getTypedRuleContext(OperatorBitwiseContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitExpBitwise($this);
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

	    public function operatorMulDivMod() : ?OperatorMulDivModContext
	    {
	    	return $this->getTypedRuleContext(OperatorMulDivModContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function accept(ParseTreeVisitor $visitor)
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

	    public function string() : ?StringContext
	    {
	    	return $this->getTypedRuleContext(StringContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function prefixexp() : ?PrefixexpContext
	    {
	    	return $this->getTypedRuleContext(PrefixexpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function operatorUnary() : ?OperatorUnaryContext
	    {
	    	return $this->getTypedRuleContext(OperatorUnaryContext::class, 0);
	    }

	    public function exp() : ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function operatorAnd() : ?OperatorAndContext
	    {
	    	return $this->getTypedRuleContext(OperatorAndContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function accept(ParseTreeVisitor $visitor)
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

	    public function functiondef() : ?FunctiondefContext
	    {
	    	return $this->getTypedRuleContext(FunctiondefContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function operatorPower() : ?OperatorPowerContext
	    {
	    	return $this->getTypedRuleContext(OperatorPowerContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function operatorStrcat() : ?OperatorStrcatContext
	    {
	    	return $this->getTypedRuleContext(OperatorStrcatContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function operatorAddSub() : ?OperatorAddSubContext
	    {
	    	return $this->getTypedRuleContext(OperatorAddSubContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

	    public function tableconstructor() : ?TableconstructorContext
	    {
	    	return $this->getTypedRuleContext(TableconstructorContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_prefixexp;
	    }

	    public function varOrExp() : ?VarOrExpContext
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_functioncall;
	    }

	    public function varOrExp() : ?VarOrExpContext
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_varOrExp;
	    }

	    public function variable() : ?VariableContext
	    {
	    	return $this->getTypedRuleContext(VariableContext::class, 0);
	    }

	    public function exp() : ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_variable;
	    }
	 
		public function copyFrom(ParserRuleContext $context) : void
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

	    public function NAME() : ?TerminalNode
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

		public function accept(ParseTreeVisitor $visitor)
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

	    public function exp() : ?ExpContext
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_varSuffix;
	    }

	    public function exp() : ?ExpContext
	    {
	    	return $this->getTypedRuleContext(ExpContext::class, 0);
	    }

	    public function NAME() : ?TerminalNode
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_nameAndArgs;
	    }

	    public function args() : ?ArgsContext
	    {
	    	return $this->getTypedRuleContext(ArgsContext::class, 0);
	    }

	    public function NAME() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_args;
	    }

	    public function explist() : ?ExplistContext
	    {
	    	return $this->getTypedRuleContext(ExplistContext::class, 0);
	    }

	    public function tableconstructor() : ?TableconstructorContext
	    {
	    	return $this->getTypedRuleContext(TableconstructorContext::class, 0);
	    }

	    public function string() : ?StringContext
	    {
	    	return $this->getTypedRuleContext(StringContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_functiondef;
	    }

	    public function funcbody() : ?FuncbodyContext
	    {
	    	return $this->getTypedRuleContext(FuncbodyContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_funcbody;
	    }

	    public function block() : ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parlist() : ?ParlistContext
	    {
	    	return $this->getTypedRuleContext(ParlistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_parlist;
	    }

	    public function namelist() : ?NamelistContext
	    {
	    	return $this->getTypedRuleContext(NamelistContext::class, 0);
	    }

	    public function elipsis() : ?ElipsisContext
	    {
	    	return $this->getTypedRuleContext(ElipsisContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_elipsis;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_tableconstructor;
	    }

	    public function fieldlist() : ?FieldlistContext
	    {
	    	return $this->getTypedRuleContext(FieldlistContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
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

	    public function NAME() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NAME, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_fieldsep;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorOr;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorAnd;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorComparison;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorStrcat;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorAddSub;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorMulDivMod;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorBitwise;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorUnary;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_operatorPower;
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_number;
	    }

	    public function INT() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::INT, 0);
	    }

	    public function FLOAT() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::FLOAT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
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

		public function getRuleIndex() : int
		{
		    return LuaParser::RULE_string;
	    }

	    public function NORMALSTRING() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::NORMALSTRING, 0);
	    }

	    public function CHARSTRING() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::CHARSTRING, 0);
	    }

	    public function LONGSTRING() : ?TerminalNode
	    {
	        return $this->getToken(LuaParser::LONGSTRING, 0);
	    }

		public function accept(ParseTreeVisitor $visitor)
		{
			if ($visitor instanceof LuaVisitor) {
			    return $visitor->visitString($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}