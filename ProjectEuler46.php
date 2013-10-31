<?php

/**
 *
 * It was proposed by Christian Goldbach that every odd composite number can be written as the sum of a prime and twice a square.
 *
 * 9 = 7 + 2 × 1^2
 * 15 = 7 + 2 × 2^2
 * 21 = 3 + 2 × 3^2
 * 25 = 7 + 2 × 3^2
 * 27 = 19 + 2 × 2^2
 * 33 = 31 + 2 × 1^2
 *
 * It turns out that the conjecture was false.
 *
 * What is the smallest odd composite that cannot be written as the sum of a prime and twice a square?
 *
 */

ini_set('memory_limit', '1G');
require_once(dirname(__FILE__).'/HelperFunctions.php');

/*
 * n = p + 2(x^2)
 * x = sqrt((n - p) / 2)
 *
 */
function satisfiesGolbachsConjucture($n)
{
	global $primes;

	foreach ($primes as $p) {
		if ($p > $n) {
			break;
		}
		$x = sqrt(($n - $p) / 2);
		if (intval($x) == $x) {
			return true;
		}
	}
	return false;
}


function proveGoldbachWrong($start = 7)
{
	global $primes;
	$number = $start;
	$primes = getPrimesBelow(9999);
	$found = false;
	while (!$found) {
		$number += 2;
		if (!satisfiesGolbachsConjucture($number)) {
			break;
		}
	}
	return $number;
}

$primes = array();

echo "\nThe smallest odd composite that cannot be written as the sum of a prime and twice a square:\n";

$start = microtime(true);
$ans = proveGoldbachWrong();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";

