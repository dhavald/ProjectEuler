<?php

/**
 * 145 is a curious number, as 1! + 4! + 5! = 1 + 24 + 120 = 145.
 * Find the sum of all numbers which are equal to the sum of the factorial of their digits.
 * Note: as 1! = 1 and 2! = 2 are not sums they are not included.
 *
 */

require_once(dirname(__FILE__) . '/HelperFunctions.php');
ini_set('memory_limit', '-1');


function getCuriousNumbers($limit = 999)
{
	$curiousNumbers = array();
	foreach (range(1, $limit) as $num) {
		if (isCuriousNumber($num)) {
			$curiousNumbers[] = $num;
		}
	}
	print_r($curiousNumbers);
	return $curiousNumbers;
}

function getCuriousNumbersSum($limit = 999)
{
	return array_sum(getCuriousNumbers($limit));
}

echo "\nSum of all numbers which are equal to the sum of the factorial of their digits:\n";

$start = microtime(true);
$ans = getCuriousNumbersSum(5500000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
