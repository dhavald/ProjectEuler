<?php

/**
 * We shall say that an n-digit number is pandigital if it makes use of all the digits 1 to n exactly once; for example, the 5-digit number, 15234, is 1 through 5 pandigital.

The product 7254 is unusual, as the identity, 39 × 186 = 7254, containing multiplicand, multiplier, and product is 1 through 9 pandigital.

Find the sum of all products whose multiplicand/multiplier/product identity can be written as a 1 through 9 pandigital.

HINT: Some products can be obtained in more than one way so be sure to only include it once in your sum.
 *
 */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getPandigitalNumbers($range)
{
	$pandigNumbers = array();
	foreach (range(1, pow(10, $range) - 1) as $num1) {
		if (strpos($num1, "0")) {
			continue;
		}
		foreach (range(1, (int) sqrt(pow(10, $range)) + 1) as $num2) {
			if (strpos($num2, "0")) {
				continue;
			}
			$mult = $num1 * $num2;
			if (strpos($mult, "0")) {
				continue;
			} elseif (strlen($num1.$num2.$mult) != 9) {
				continue;
			}
			$concDigits = str_split($num1.$num2.$mult);
			if (count($concDigits) == count(array_unique($concDigits))) {
				echo "\n" . $num1 . " * " . $num2 . " = " . $mult;
				$pandigNumbers[$mult] = $mult;
			}
		}
	}
	return $pandigNumbers;
}

echo "\nSum of all products whose multiplicand/multiplier/product identity can be written as a 1 through 9 pandigital:\n";

$start = microtime(true);
$ans = array_sum(getPandigitalNumbers(4));
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
