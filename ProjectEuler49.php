<?php

/**
 *
 * The arithmetic sequence, 1487, 4817, 8147, in which each of the terms increases by 3330, is unusual in two ways:
 * (i) each of the three terms are prime, and,
 * (ii) each of the 4-digit numbers are permutations of one another.
 *
 * There are no arithmetic sequences made up of three 1-, 2-, or 3-digit primes, exhibiting this property.
 *
 * But there is one other 4-digit increasing sequence.
 *
 * What 12-digit number do you form by concatenating the three terms in this sequence?
 *
 */

ini_set('memory_limit', '1G');
require_once(dirname(__FILE__).'/HelperFunctions.php');

function getPrimePermutationSequence($start = 1000, $end = 9999)
{
	$return = array();
	$done = array();

	foreach (getPrimes($start, $end) as $number) {

		$found = false;
		$permutations = array_unique(permute((string) $number));
		sort($permutations);
		$alreadyIn = false;
		foreach ($permutations as $perm) {
			if (isset($done[$perm])) {
				$alreadyIn = true;
				break;
			}
			$done[$perm] = true;
		}
		if ($alreadyIn) {
			continue;
		}
		$primes = array();
		foreach ($permutations as $perm) {
			if (intval($perm) > 999 && isPrime($perm)) {
				$primes[] = $perm;
			}
		}
		if (count($primes) <= 2) {
			continue;
		}
		sort($primes);
		$diffs = array();
		for ($i=0; $i < count($primes); $i++) {
			for ($j=$i+1; $j < count($primes); $j++) {
				$currDiff = $primes[$j] - $primes[$i];
				if (in_array($primes[$j]+$currDiff, $primes)) {
					$return = array($primes[$i], $primes[$j], ($primes[$j]+$currDiff));
					$found = true;
					break;
				}
			}
			if ($found) {
				break;
			}
		}
	}
	return $return;
}

function solve()
{
	$numbers = getPrimePermutationSequence(1488);
	return implode($numbers, '');
}


echo "\nThe 12-digit number formed by concatenating the three terms in Prime Permutations sequence:\n";

$start = microtime(true);
$ans = solve();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";

