<?php

/**
 * A googol (10^100) is a massive number: one followed by one-hundred zeros;
 *
 * 100^100 is almost unimaginably large: one followed by two-hundred zeros.
 *
 * Despite their size, the sum of the digits in each number is only 1.
 *
 * Considering natural numbers of the form, a^b, where a, b < 100, what is the maximum digital sum?
 */

ini_set('memory_limit', '10G');

function getSumOfPower($a, $b)
{
    $power = bcpow($a, $b);
    $sum = array_sum(str_split($power));
    return $sum;
}

function findMaximumDigitalSum($digitUpperLimit = 99)
{
    $maximumSum = 0;
    for ($a = $digitUpperLimit; $a > 1; $a--) {
        for ($b = $digitUpperLimit; $b > 1; $b--) {
            $sum = getSumOfPower($a, $b);
            if ($sum > $maximumSum) {
                $maximumSum = $sum;
                $maxA = $a;
                $maxB = $b;
            }
        }
    }
    
    echo "\nMax A   : $maxA";
    echo "\nMax B   : $maxB";
    echo "\nMax Sum : $maximumSum\n";
    
    return $maximumSum;
}

echo "\nThe maximum digital sum of a^b for a,b < 99:\n";

$start = microtime(true);
$ans = findMaximumDigitalSum(99);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
