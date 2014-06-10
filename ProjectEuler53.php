<?php

/**
 *
 * There are exactly ten ways of selecting three from five, 12345: 123, 124, 125, 134, 135, 145, 234, 235, 245, and 345
 *
 * In combinatorics, we use the notation, 5C3 = 10.
 * In general, nCr = n! / r!(n−r)!, where r ≤ n, n! = n×(n−1)×...×3×2×1, and 0! = 1.
 *
 * It is not until n = 23, that a value exceeds one-million: 23C10 = 1144066.
 *
 * How many, not necessarily distinct, values of  nCr, for 1 ≤ n ≤ 100, are greater than one-million?
 *
 */

ini_set('memory_limit', '128M');
require_once('HelperFunctions.php');

if (extension_loaded('xdebug')) {
	ini_set('xdebug.max_nesting_level', 1000);		// set higher nested limit from default 100
}

function findCombinations($limit = 100)
{
	$ncr = array();
	foreach (range(1, $limit) as $n) {
		foreach (range(1, $n - 1) as $r) {
			if ($r > $n/2) {
				$r = $n - $r;
			}
			if (ncr($n, $r) > 1000000) {
				$ncr[] = array('n' => $n, 'c' => $r);
			}
		}
	}
	return count($ncr);
}

echo "\nThe Possible nCr combinations, for 1 ≤ n ≤ 100, are:\n";

$start = microtime(true);
$ans = findCombinations(100);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";

