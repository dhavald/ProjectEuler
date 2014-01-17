<?php

/**
 *
 * The number, 1406357289, is a 0 to 9 pandigital number because it is made up of each of the digits 0 to 9 in some order,
 * but it also has a rather interesting sub-string divisibility property.
 *
 * Let d1 be the 1st digit, d2 be the 2nd digit, and so on. In this way, we note the following:
 *
 * d2d3d4=406 is divisible by 2
 * d3d4d5=063 is divisible by 3
 * d4d5d6=635 is divisible by 5
 * d5d6d7=357 is divisible by 7
 * d6d7d8=572 is divisible by 11
 * d7d8d9=728 is divisible by 13
 * d8d9d10=289 is divisible by 17
 *
 * Find the sum of all 0 to 9 pandigital numbers with this property.
 *
 */

ini_set('memory_limit', '1G');
require_once(dirname(__FILE__).'/HelperFunctions.php');

$primes = array();

function isSubstringDivisible($number = 1)
{
	global $primes;
	for($i = 1; $i < 8; $i++) {
		$substr = substr($number, $i, 3);
		if ($substr % $primes[$i - 1] != 0) {
			return false;
		}
	}
	return true;
}

function getSubstringDivisiblePandigitalNumbers()
{
	global $primes;
	$substringDivisibleNumbers = array();
	$pandigitals = generatePandigitals(9, false);
	$primes = getPrimes(2, 50);
	foreach ($pandigitals as $pandigital) {
		if (isSubstringDivisible($pandigital)) {
			$substringDivisibleNumbers[] = $pandigital;
		}
	}
	return $substringDivisibleNumbers;
}

function getSumOfSubstringDivisiblePandigitalNumbers($word = "")
{
	return array_sum(getSubstringDivisiblePandigitalNumbers());
}


echo "\nThe sum of all 0 to 9 pandigital numbers which are substring divisible:\n";

$start = microtime(true);
$ans = getSumOfSubstringDivisiblePandigitalNumbers();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
