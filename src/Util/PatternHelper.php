<?php
namespace Raudius\Luar\Util;


class PatternHelper {

	public function matchPattern(string $subject, string $pattern, int $offset): array {
		$regex = $this->patternToRegex($pattern);

		preg_match($regex, $subject, $matches, PREG_OFFSET_CAPTURE, $offset);
		return $matches;
	}

	public function patternToRegex(string $pattern): string {
		$regex = '';
		$patternChars = str_split($pattern);
		$escaping = false;
		$count = count($patternChars);

		for ($i=0; $i<$count; $i++) {
			$char = $patternChars[$i];
			if ($escaping) {
				$r = $this->escapedCharToRegex($char);
				$escaping = false;
			} else {
				if ($char === '%') {
					$escaping = true;
					continue;
				}
				$r = $this->controlCharToRegex($char);

				if ($char === '^' && $i > 0 && $patternChars[$i-1] === '[') {
					$r = "\\^";
				} elseif ($char === '$' && ($i+1) === $count) {
					$r = "$";
				}

				$r = $r ?? $this->escapeCharRegex($char);
			}

			$regex .= $r;
		}

		return "/$regex/";
	}

	private function escapedCharToRegex(string $char): string {
		switch ($char) {
			case 'a': return "[a-zA-Z]";
			case 'c': return "[\\x00-\\x1F]";
			case 'd': return "\\d";
			case 'g': return "[\\x33-\\x7E]";
			case 'l': return "[a-z]";
			case 'p': return "[!\"#$%&'()*+,-./[\%\\]^_`{|}~]";
			case 's'; return "[ \\t\\n\\v\\f\\r]";
			case 'u'; return "[A-Z]";
			case 'w'; return "[a-zA-Z0-9]";
			case 'x'; return "[0-9a-fA-F]";
		}

		// Reference capture group
		if (is_numeric($char) && (int) $char > 0) {
			return "\\" . $char;
		}

		return $this->escapeCharRegex($char);
	}

	private function escapeCharRegex(string $char): string 	{
		if (in_array($char, ["\\", "^", "$", ".", "|", "?", "*", "+", "(", ")", "[", "]", "{", "}"], true)) {
			return "\\" . $char;
		}

		return $char;
	}

	private function controlCharToRegex($char): ?string {
		// Note ^ and $ need to be handled separately
		// ^ and $ are context aware: if not in first/last position they are matched literally
		// Additionally ^ should not be escaped if inside a character group, e.g. [^abc]
		switch ($char) {
			case ".": return ".";
			case "[": return "[";
			case "]": return "]";
			case "(": return "(";
			case ")": return ")";
			case "*": return "*";
			case "+": return "+";
			case "-": return "*?";
			case "?": return "?";
		}

		return null;
	}
}
