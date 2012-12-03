<?php 

/*
 * The Fibonacci sequence is defined by the recurrence relation: Fn = Fn1 + Fn2, where F1 = 1 and F2 = 1
* Hence the first 12 terms will be: F1 = 1, F2 = 1, F3 = 2, F4 = 3, F5 = 5, F6 = 8, F7 = 13, F8 = 21, F9 = 34, F10 = 55, F11 = 89, F12 = 144
* The 12th term, F12, is the first term to contain three digits.
*
* What is the first term in the Fibonacci sequence to contain 1000 digits?
* 
* ans  : 4782
* time : 4.694934129714966 seconds
*
* */

require_once(dirname(__FILE__) . '/../bootstrap.php');
ini_set('memory_limit', '-1');

function getFebonacciSequenceWithNumberOfDigits($limit)
{
    $series = array("1");
    $prev = "0";
    $current = "1";
    while(true) {
        $sum = sum($prev, $current);
        $series[] = $sum;
        if (strlen($sum) >= $limit) {
            break;
        }
        $prev = $current;
        $current = $sum;
    }
    return count($series);
}

function sum($a, $b)
{
    if ($a + $b < 20) {
        return (string)($a + $b);
    }
    $sum = array();
    $carry = 0;
    $num1 = str_split($a, 1);
    $num2 = str_split($b, 1);
    while (!empty($num1) || !empty($num2)) {
        if (empty($num1)) {
            if ($carry != 0) {
                $sum[] = array_pop($num2) + $carry;
                $carry = 0;
            } else {
                $sum[] = array_pop($num2);
            }
        } elseif (empty($num2)) {
            if ($carry != 0) {
                $sum[] = array_pop($num1) + $carry;
                $carry = 0;
            } else {
                $sum[] = array_pop($num1);
            }
        } else {
            $lastDigit1 = array_pop($num1);
            $lastDigit2 = array_pop($num2);
            $tmp_sum = $lastDigit1 + $lastDigit2 + $carry;
            if ($tmp_sum > 9) {
                $sum[] = ($tmp_sum) % 10;
                $carry = 1;
            } else {
                $sum[] = $tmp_sum;
                $carry = 0;
            }
        }
    }
    $return = $carry? strval($carry) : "";
    while (!empty($sum)) {
        $return .= array_pop($sum);
    }
    return $return;
}

echo "\nThe first term in the Fibonacci sequence to contain 1000 digits:\n";
$start = microtime(true);
$ans = getFebonacciSequenceWithNumberOfDigits(1000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
