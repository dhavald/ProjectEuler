<?php

/**
 *
 * If p is the perimeter of a right angle triangle with integral length sides, {a,b,c}, there are exactly three solutions for p = 120.
 *
 * {20,48,52}, {24,45,51}, {30,40,50}
 *
 * For which value of p ≤ 1000, is the number of solutions maximised?
 *
 */


function getMaxCount($limit = 9999)
{
	$max = 0;
	$maxIndex = 0;
	$maxCount = 0;
	$pythagoreanTriples = array();
	for($a = 1; $a <= $limit; $a++) {
		for($b = $a+1; $b <= $limit; $b++) {
			$c = sqrt($a*$a + $b*$b);
			if(intval($c) == $c) {
				$pythagoreanTriples[$a+$b+$c][] = $a.",".$b.",".$c;
				if(count($pythagoreanTriples[$a+$b+$c]) > $maxCount) {
					$maxCount = count($pythagoreanTriples[$a+$b+$c]);
					$maxParam = $a+$b+$c;
				}
			} elseif($a + $b + $c > 1000) {
				break;
			}
		}
	}
	print_r($pythagoreanTriples[$maxParam]);

	return $maxParam;
}

echo "\nValue of p (perimeter of a right angle triangle) for which the number of solutions maximised:\n";

$start = microtime(true);
$ans = getMaxCount(1000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
