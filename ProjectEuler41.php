<?php

/**
 *
 * We shall say that an n-digit number is pandigital if it makes use of all the digits 1 to n exactly once.
 * For example, 2143 is a 4-digit pandigital and is also prime.
 * What is the largest n-digit pandigital prime that exists?
 *
 */

ini_set('memory_limit', '128M');
require_once(dirname(__FILE__).'/HelperFunctions.php');

function getLargestPandigitalPrime()
{
	for ($i = 9; $i >= 1; $i--) {
		$nums = generatePandigitals($i);
		arsort($nums);
		$return = 0;
		foreach($nums as $num) {
			if (isPrime($num)) {
				return $num;
			}
		}
	}
	return 0;
}

echo "\nThe largest pandigital prime that exists:\n";

$start = microtime(true);
$ans = getLargestPandigitalPrime();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
