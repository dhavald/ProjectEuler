<?php

/**
 *
 * The decimal number, 585 = 10010010012 (binary), is palindromic in both bases.
 * Find the sum of all numbers, less than one million, which are palindromic in base 10 and base 2.
 * (Please note that the palindromic number, in either base, may not include leading zeros.)
 *
 */

require_once(dirname(__FILE__) . '/HelperFunctions.php');
ini_set('memory_limit', '-1');


function getDoubleBasePalindromicNumbers($limit = 999999)
{
	$doubleBasePalindromes = array();
	foreach (range(1, $limit) as $num) {
		if (isDoubleBasePalindrome($num)) {
			$doubleBasePalindromes[] = $num;
		}
	}
	print_r($doubleBasePalindromes);
	return $doubleBasePalindromes;
}

function isDoubleBasePalindrome($num = 1)
{
	$binary = toBinary($num);
	return $binary[0] != 0 && isPalindrome($binary) && isPalindrome($num);
}


function getSumOfBiPalindromicNumbers($limit = 999999)
{
	return array_sum(getDoubleBasePalindromicNumbers($limit));
}

echo "\nSum of all numbers, less than one million, which are palindromic in base 10 and base 2:\n";

$start = microtime(true);
$ans = getSumOfBiPalindromicNumbers(999999);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime1\t: $time";
