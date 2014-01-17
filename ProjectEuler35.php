<?php

/**
 * The number, 197, is called a circular prime because all rotations of the digits: 197, 971, and 719, are themselves prime.
 * There are thirteen such primes below 100: 2, 3, 5, 7, 11, 13, 17, 31, 37, 71, 73, 79, and 97.
 * How many circular primes are there below one million?
 *
 */

require_once(dirname(__FILE__) . '/HelperFunctions.php');
ini_set('memory_limit', '-1');


function getCircularPrimes($limit = 999999)
{
	$circularPrimes = array();
	foreach (range(1, $limit) as $num) {
		$rotations = getRotations($num);
		$allPrimes = true;
		foreach ($rotations as $rotation) {
			if (!isPrime($rotation)) {
				$allPrimes = false;
			}
		}
		if ($allPrimes) {
			$circularPrimes[] = $num;
		}
	}
	return $circularPrimes;
}

function getCircularPrimes2($limit = 999999)
{
	$primes = getPrimes(2, $limit);
	$circularPrimes = array();
	foreach ($primes as $prime) {
		$rotations = getRotations($prime);
		$allPrimes = true;
		foreach ($rotations as $rotation) {
			if (!isPrime($rotation)) {
				$allPrimes = false;
			}
		}
		if ($allPrimes) {
			$circularPrimes[] = $prime;
		}
	}
	return $circularPrimes;
}

function countCircularPrimes($limit = 999999, $method = 1)
{
	return $method = 1? count(getCircularPrimes($limit)) : count(getCircularPrimes2($limit));
}

echo "\nNumber of circular primes below one million:\n";

$start = microtime(true);
$ans = countCircularPrimes(999999, 1);
$end = microtime(true);
$time1 = number_format($end - $start, 15);

$start = microtime(true);
$ans = countCircularPrimes(999999, 2);
$end = microtime(true);
$time2 = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime1\t: $time1";
echo "\nTime2\t: $time2\n";
