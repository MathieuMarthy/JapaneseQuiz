<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'system'.DIRECTORY_SEPARATOR.'core'
.DIRECTORY_SEPARATOR."Model.php";

class Symbols extends CI_Model {
    public array $hiragana;
	public array $hiragana_dakuon;
	public array $hiragana_override;

	public array $romanji_hiragana;

    public array $katakana;

	public function IfRomanjiExist(string $romanji): bool {
		return array_key_exists($romanji, $this->romanji_hiragana);
	}


	// Hiragana //
	public function getRandomHiragana(): string {
		return array_rand($this->hiragana);
	}
	
	public function verifyIfRomanjiIsHiragana(string $romanji, string $hiragna) {
		if ($this->IfRomanjiExist($romanji)) {
			return ($this->romanji_hiragana[$romanji] == $hiragna);
		}
		return false;
	}

	public function getRomanjiFromHiragana(string $hiragana): string {
		$response = $this->hiragana[$hiragana];
		if (is_array($response)) {
			$string = "";
			foreach($response as $res) {
				$string = $string.$res." or ";
			}
			$response = substr($string, 0, -4);
		}
		return $response;
	}


    public function __construct() {
		$this->hiragana = array(
			"あ" => "a",
			"い" => "i",
			"う" => "u",
			"え" => "e",
			"お" => "o",

			"か" => "ka",
			"き" => "ki",
			"く" => "ku",
			"け" => "ke",
			"こ" => "ko",
		
			"さ" => "sa",
			"し" => "shi",
			"す" => "su",
			"せ" => "se",
			"そ" => "so",
			
			"た" => "ta",
			"ち" => "chi",
			"つ" => "tsu",
			"て" => "te",
			"と" => "to",
			
			"な" => "na",
			"に" => "ni",
			"ぬ" => "nu",
			"ね" => "ne",
			"の" => "no",

			"は" => "ha",
			"ひ" => "hi",
			"ふ" => "fu",
			"へ" => "he",
			"ほ" => "ho",

			"ま" => "ma",
			"み" => "mi",
			"む" => "mu",
			"め" => "me",
			"も" => "mo",
			
			"や" => "ya",
			"ゆ" => "yu",
			"よ" => "yo",

			"ら" => "ra",
			"り" => "ri",
			"る" => "ru",
			"れ" => "re",
			"ろ" => "ro",

			"わ" => "wa",
			"を" => ["wo", "o"],
			
			"ん" => "n",
		);

		$this->hiragana_dakuon = array(
			"が" => "ga", 
			"ぎ" => "gi", 
			"ぐ" => "gu", 
			"げ" => "ge", 
			"ご" => "go", 
			
			"ざ" => "za", 
			"じ" => "ji", 
			"ず" => "zu", 
			"ぜ" => "ze", 
			"ぞ" => "zo", 
			
			"だ" => "da", 
			"ぢ" => ["ji", "dji"], 
			"づ" => ["zu", "tzu"],
			"で" => "de", 
			"ど" => "do", 
			
			"ば" => "ba", 
			"び" => "bi", 
			"ぶ" => "bu", 
			"べ" => "be", 
			"ぼ" => "bo", 
			
			"ぱ" => "pa", 
			"ぴ" => "pi", 
			"ぷ" => "pu", 
			"ぺ" => "pe", 
			"ぽ" => "po", 
		);

		$this->hiragana_override = array(
			"きゃ" => "kya",
			"きゅ" => "kyu",
			"きょ" => "kyo",
			
			"ぎゃ" => "gya",
			"ぎゅ" => "gyu",
			"ぎょ" => "gyo",

			"しゃ" => "sha",
			"しゅ" => "shu",
			"しょ" => "sho",

			"じゃ" => "ja",
			"じゅ" => "ju",
			"じょ" => "jo",

			"ちゃ" => "cha",
			"ちゅ" => "chu",
			"ちょ" => "cho",

			"にゃ" => "nya",
			"にゅ" => "nyu",
			"にょ" => "nyo",

			"ひゃ" => "hya",
			"ひゅ" => "hyu",
			"ひょ" => "hyo",

			"びゃ" => "bya",
			"びゅ" => "byu",
			"びょ" => "byo",

			"ぴゃ" => "pya",
			"ぴゅ" => "pyu",
			"ぴょ" => "pyo",

			"みゃ" => "mya",
			"みゅ" => "myu",
			"みょ" => "myo",

			"りゃ" => "rya",
			"りゅ" => "ryu",
			"りょ" => "ryo",
		);

		$list_hiragana = array(
			$this->hiragana,
			$this->hiragana_dakuon,
			$this->hiragana_override
		);

		foreach ($list_hiragana as $list) {
			foreach (array_keys($list) as $hiragana) {
				if (is_array($list[$hiragana])) {
					foreach ($list[$hiragana] as $a) {
						$this->romanji_hiragana[$a] = $hiragana;
					}
				} else {
					$this->romanji_hiragana[$list[$hiragana]] = $hiragana;
				}
			}
		}
	}
}

?>
