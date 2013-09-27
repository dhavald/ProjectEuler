<?php

// By listing the first six prime numbers: 2, 3, 5, 7, 11, and 13, we can see that the 6th prime is 13.
// What is the 10001st prime number?

require_once(dirname(__FILE__) . '/HelperFunctions.php');
ini_set('memory_limit', '-1');

$start = microtime(true);
$ans = getNthPrine(10001);
$end = microtime(true);
$time = number_format($end - $start, 15);
echo "\n10001st Prime\t: $ans";
echo "\nExecution time\t: $time\n";


function getNthPrine($n)
{
    $prime = 2;
    $count = 0;
    for($i = 2; $count < $n; $i++) {
        if (isPrime($i)) {
            $count++;
            $prime = $i;
        }
    }
    return $prime;
}