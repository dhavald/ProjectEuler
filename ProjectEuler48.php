<?php

/**
 *
 * The series, 1^1 + 2^2 + 3^3 + ... + 10^10 = 10405071317.
 *
 * Find the last ten digits of the series, 1^1 + 2^2 + 3^3 + ... + 1000^1000.
 *
 */

ini_set('memory_limit', '1G');
require_once(dirname(__FILE__).'/HelperFunctions.php');

function getSelfPowerSum($limit = 100)
{
	$sum = 0;
	foreach (range(1, $limit) as $number) {
		$selfPow = bcpow($number, $number);
		$sum = strSum($sum, $selfPow);
	}
	return $sum;
}

function solve()
{
	$sum = getSelfPowerSum(1000);
	return substr($sum, -10);
}


echo "\nThe last ten digits of the series, 1^1 + 2^2 + 3^3 + ... + 1000^1000:\n";

$start = microtime(true);
$ans = solve();
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";

