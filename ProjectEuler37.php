<?php

/**
 *
 * The number 3797 has an interesting property.
 * Being prime itself, it is possible to continuously remove digits from left to right, and remain prime at each stage: 3797, 797, 97, and 7.
 *
 * Similarly we can work from right to left: 3797, 379, 37, and 3.
 *
 * Find the sum of the only eleven primes that are both truncatable from left to right and right to left.
 *
 * NOTE: 2, 3, 5, and 7 are not considered to be truncatable primes.
 *
 */

require_once(dirname(__FILE__) . '/HelperFunctions.php');


function getTruncatablePrimes($limit = 999999)
{
	$truncatablePrimes = array();
	$isPrime = array();
	// only check for primes greter than 10 (all primes except 2 are odd thus step 2)
	foreach (range(11, $limit, 2) as $num) {
		$truncatablePrime = true;
		$temp1 = $num;
		$temp2 = $num;
		// remove from left
		while (!empty($temp1)) {
			if (isset($isPrime[$temp1]) && !$isPrime[$temp1]) {
				$truncatablePrime = false;
				break;
			}
			if (!isPrime($temp1)) {
				$isPrime[$temp1] = false;
				$truncatablePrime = false;
				break;
			}
			$isPrime[$temp1] = true;
			$temp1 = substr($temp1, 1);
		}
		if (!$truncatablePrime) {
			continue;
		}
		// remove from right
		while (!empty($temp2)) {
			if (isset($isPrime[$temp2]) && !$isPrime[$temp2]) {
				$truncatablePrime = false;
				break;
			}
			if (!isPrime($temp2)) {
				$isPrime[$temp2] = false;
				$truncatablePrime = false;
				break;
			}
			$isPrime[$temp2] = true;
			$temp2 = substr($temp2, 0, -1);
		}
		if ($truncatablePrime) {
			$truncatablePrimes[] = $num;
		}
	}
	print_r($truncatablePrimes);
	return $truncatablePrimes;
}

function isDoubleBasePalindrome($num = 1)
{
	$binary = toBinary($num);
	return $binary[0] != 0 && isPalindrome($binary) && isPalindrome($num);
}


function getSumOfTruncatablePrimes($limit = 999999)
{
	return array_sum(getTruncatablePrimes($limit));
}

echo "\nSum of the only eleven primes that are both truncatable from left to right and right to left:\n";

$start = microtime(true);
$ans = getSumOfTruncatablePrimes();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
