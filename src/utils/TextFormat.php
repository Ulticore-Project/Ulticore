<?php

const FORMAT_BLACK = "§0";
const FORMAT_DARK_BLUE = "§1";
const FORMAT_DARK_GREEN = "§2";
const FORMAT_DARK_AQUA = "§3";
const FORMAT_DARK_RED = "§4";
const FORMAT_DARK_PURPLE = "§5";
const FORMAT_GOLD = "§6";
const FORMAT_GRAY = "§7";
const FORMAT_DARK_GRAY = "§8";
const FORMAT_BLUE = "§9";
const FORMAT_GREEN = "§a";
const FORMAT_AQUA = "§b";
const FORMAT_RED = "§c";
const FORMAT_LIGHT_PURPLE = "§d";
const FORMAT_YELLOW = "§e";
const FORMAT_WHITE = "§f";

const FORMAT_OBFUSCATED = "§k";
const FORMAT_BOLD = "§l";
const FORMAT_STRIKETHROUGH = "§m";
const FORMAT_UNDERLINE = "§n";
const FORMAT_ITALIC = "§o";
const FORMAT_RESET = "§r";

class TextFormat{
    public static function tokenize($string){
		return preg_split("/(§[0123456789abcdefklmnor])/", $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	}

	public static function clean($string){
		return preg_replace("/§[0123456789abcdefklmnor]/", "", $string);
	}

	public static function toHTML($string){
		if(!is_array($string)){
			$string = self::tokenize($string);
		}
		$newString = "";
		$tokens = 0;
		foreach($string as $token){
			switch($token){
				case FORMAT_BOLD:
					$newString .= "<span style=font-weight:bold>";
					++$tokens;
					break;
				case FORMAT_OBFUSCATED:
					//$newString .= "<span style=text-decoration:line-through>";
					//++$tokens;
					break;
				case FORMAT_ITALIC:
					$newString .= "<span style=font-style:italic>";
					++$tokens;
					break;
				case FORMAT_UNDERLINE:
					$newString .= "<span style=text-decoration:underline>";
					++$tokens;
					break;
				case FORMAT_STRIKETHROUGH:
					$newString .= "<span style=text-decoration:line-through>";
					++$tokens;
					break;
				case FORMAT_RESET:
					$newString .= str_repeat("</span>", $tokens);
					$tokens = 0;
					break;

				//Colors
				case FORMAT_BLACK:
					$newString .= "<span style=color:#000>";
					++$tokens;
					break;
				case FORMAT_DARK_BLUE:
					$newString .= "<span style=color:#00A>";
					++$tokens;
					break;
				case FORMAT_DARK_GREEN:
					$newString .= "<span style=color:#0A0>";
					++$tokens;
					break;
				case FORMAT_DARK_AQUA:
					$newString .= "<span style=color:#0AA>";
					++$tokens;
					break;
				case FORMAT_DARK_RED:
					$newString .= "<span style=color:#A00>";
					++$tokens;
					break;
				case FORMAT_DARK_PURPLE:
					$newString .= "<span style=color:#A0A>";
					++$tokens;
					break;
				case FORMAT_GOLD:
					$newString .= "<span style=color:#FA0>";
					++$tokens;
					break;
				case FORMAT_GRAY:
					$newString .= "<span style=color:#AAA>";
					++$tokens;
					break;
				case FORMAT_DARK_GRAY:
					$newString .= "<span style=color:#555>";
					++$tokens;
					break;
				case FORMAT_BLUE:
					$newString .= "<span style=color:#55F>";
					++$tokens;
					break;
				case FORMAT_GREEN:
					$newString .= "<span style=color:#5F5>";
					++$tokens;
					break;
				case FORMAT_AQUA:
					$newString .= "<span style=color:#5FF>";
					++$tokens;
					break;
				case FORMAT_RED:
					$newString .= "<span style=color:#F55>";
					++$tokens;
					break;
				case FORMAT_LIGHT_PURPLE:
					$newString .= "<span style=color:#F5F>";
					++$tokens;
					break;
				case FORMAT_YELLOW:
					$newString .= "<span style=color:#FF5>";
					++$tokens;
					break;
				case FORMAT_WHITE:
					$newString .= "<span style=color:#FFF>";
					++$tokens;
					break;
				default:
					$newString .= $token;
					break;
			}
		}

		$newString .= str_repeat("</span>", $tokens);
		return $newString;
	}

	public static function toANSI($string){
		if(!is_array($string)){
			$string = self::tokenize($string);
		}
		$newString = "";
		foreach($string as $token){
			switch($token){
				case FORMAT_BOLD:
					break;
				case FORMAT_OBFUSCATED:
					$newString .= "\x1b[8m";
					break;
				case FORMAT_ITALIC:
					$newString .= "\x1b[3m";
					break;
				case FORMAT_UNDERLINE:
					$newString .= "\x1b[4m";
					break;
				case FORMAT_STRIKETHROUGH:
					$newString .= "\x1b[9m";
					break;
				case FORMAT_RESET:
					$newString .= "\x1b[0m";
					break;
				//Colors
				case FORMAT_BLACK:
					$newString .= "\x1b[30m";
					break;
				case FORMAT_DARK_BLUE:
					$newString .= "\x1b[34m";
					break;
				case FORMAT_DARK_GREEN:
					$newString .= "\x1b[32m";
					break;
				case FORMAT_DARK_AQUA:
					$newString .= "\x1b[36m";
					break;
				case FORMAT_DARK_RED:
					$newString .= "\x1b[31m";
					break;
				case FORMAT_DARK_PURPLE:
					$newString .= "\x1b[35m";
					break;
				case FORMAT_GOLD:
					$newString .= "\x1b[33m";
					break;
				case FORMAT_GRAY:
					$newString .= "\x1b[37m";
					break;
				case FORMAT_DARK_GRAY:
					$newString .= "\x1b[30;1m";
					break;
				case FORMAT_BLUE:
					$newString .= "\x1b[34;1m";
					break;
				case FORMAT_GREEN:
					$newString .= "\x1b[32;1m";
					break;
				case FORMAT_AQUA:
					$newString .= "\x1b[36;1m";
					break;
				case FORMAT_RED:
					$newString .= "\x1b[31;1m";
					break;
				case FORMAT_LIGHT_PURPLE:
					$newString .= "\x1b[35;1m";
					break;
				case FORMAT_YELLOW:
					$newString .= "\x1b[33;1m";
					break;
				case FORMAT_WHITE:
					$newString .= "\x1b[37;1m";
					break;
				default:
					$newString .= $token;
					break;
			}
		}
		return $newString;
	}

}