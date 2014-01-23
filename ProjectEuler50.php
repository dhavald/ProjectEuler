<?php

/**
 *
 * The prime 41, can be written as the sum of six consecutive primes:
 *
 * 41 = 2 + 3 + 5 + 7 + 11 + 13
 *
 * This is the longest sum of consecutive primes that adds to a prime below one-hundred.
 *
 * The longest sum of consecutive primes below one-thousand that adds to a prime, contains 21 terms, and is equal to 953.
 *
 * Which prime, below one-million, can be written as the sum of the most consecutive primes?
 *
 */

ini_set('memory_limit', '1G');
require_once(dirname(__FILE__).'/HelperFunctions.php');


function getPrimeWithMaxConsicutivePrimeSum($sumLimit = 1000)
{
	$primes = getPrimes(2, intval($sumLimit/log($sumLimit)));
	$longestSequence = 0;
	$longestSequencePrime = 2;

	// find the upper limit for loop to
	$max = 0;
	$tmpSum = 0;
	foreach ($primes as $prime) {
		if ($tmpSum + $prime > 1000000) {
			break;
		}
		$max++;
		$tmpSum += $prime;
	}

	for ($i = 0; $i < $max; $i++) {
		for ($j = $i+$longestSequence; $j < $max; $j++) {
			$slice = array_slice($primes, $i, $j - $i + 1);
			$sum = array_sum($slice);
			if ($sum > $sumLimit) {
				break;
			}
			if (count($slice) > $longestSequence && isPrime($sum)) {
				$longestSequence = count($slice);
				$longestSequencePrime = $sum;
			}
		}
	}
	return $longestSequencePrime;
}

function solve()
{
	return getPrimeWithMaxConsicutivePrimeSum(1000000);
}


echo "\nThe prime, below one-million, which can be written as the sum of the most consecutive primes:\n";

$start = microtime(true);
$ans = solve();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";

