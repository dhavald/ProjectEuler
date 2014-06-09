<?php

/**
 *
 * It can be seen that the number, 125874, and its double, 251748, contain exactly the same digits, but in a different order.
 *
 * Find the smallest positive integer, x, such that 2x, 3x, 4x, 5x, and 6x, contain the same digits.
 *
 */

ini_set('memory_limit', '1G');

function hasPermutedMultiples($num, $upperLimit = 6)
{
	foreach (range(2, $upperLimit) as $times) {
		$split1 = str_split($num);
		sort($split1);
		$multiple = (int) ($num * $times);
		$split2 = str_split($multiple);
		sort($split2);
		if ($split1 != $split2) {
			return false;
		}
	}
	return true;
}

function findSmallest($upperLimit = 6)
{
	$return = 1;
	// starting at 123456 because its nessesary that the first digit is "1", and 2x6 is 12, which will be 7 digits...
	// And it can't be bigger than 165432 (for 6 digits) as anything bigger results in a 7 digit number.
	// So its most possible that the number is between 123456 and 1654321.
	foreach (range(123456, 1654321) as $num) {
		if (hasPermutedMultiples($num, $upperLimit)) {
			$return = $num;
			break;
		}
	}
	return $return;
}

$primes = array();

echo "\nThe smallest positive integer with Permuted Multiples:\n";

$start = microtime(true);
$ans = findSmallest(6);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";

