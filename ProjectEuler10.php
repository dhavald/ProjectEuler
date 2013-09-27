<?php

// The sum of the primes below 10 is 2 + 3 + 5 + 7 = 17.
// Find the sum of all the primes below two million.

require_once(dirname(__FILE__) . '/HelperFunctions.php');

echo "\nSum of all the primes below two million";

$start = microtime(true);
$ans = getSumOfPrimes(2000000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";


function getSumOfPrimes($num)
{
    $sum = 5;
    for($i=5; $i<=$num; $i+=2) {
        if (isPrime($i)) {
            $sum += $i;
        }
    }
    return $sum;
}
