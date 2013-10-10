<?php

/**
 *
 * The nth term of the sequence of triangle numbers is given by, t(n) = ½n(n+1);
 * so the first ten triangle numbers are:
 *
 * 1, 3, 6, 10, 15, 21, 28, 36, 45, 55, ...
 *
 * By converting each letter in a word to a number corresponding to its alphabetical position and adding these values we form a word value. For example, the word value for SKY is 19 + 11 + 25 = 55 = t(10).
 * If the word value is a triangle number then we shall call the word a triangle word.
 *
 * Using words.txt (right click and 'Save Link/Target As...'), a 16K text file containing nearly two-thousand common English words, how many are triangle words?
 *
 */

ini_set('memory_limit', '128M');
require_once(dirname(__FILE__).'/HelperFunctions.php');

$triangleNumbers = array();
function countTriangleWords()
{
	global $triangleNumbers;
	$triangleWords = array();
	$words = explode(",", str_replace('"', '', file_get_contents(dirname(__FILE__).'/docs/problem42.txt')));

	generateTriangleNumbers(99);

	foreach ($words as $word) {
		if (isTriangleWord($word)) {
			$triangleWords[] = $word;
		}
	}
	print_r($triangleWords);
	return count($triangleWords);
}

function isTriangleWord($word = "")
{
	global $triangleNumbers;
	$wordValue = getWordValue($word);
	return in_array($wordValue, $triangleNumbers);
}

function generateTriangleNumbers($limit = 9999)
{
	global $triangleNumbers;
	for($i = 1; $i <= $limit; $i++) {
		$triangleNumbers[$i] = $i*($i+1)/2;
	}
}

echo "\nTotal number of Triangular Words in given file:\n";

$start = microtime(true);
$ans = countTriangleWords();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
