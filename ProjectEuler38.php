<?php

/**
 *
 * Take the number 192 and multiply it by each of 1, 2, and 3:
 * 192 × 1 = 192
 * 192 × 2 = 384
 * 192 × 3 = 576
 
 * By concatenating each product we get the 1 to 9 pandigital, 192384576. We will call 192384576 the concatenated product of 192 and (1,2,3)
 * The same can be achieved by starting with 9 and multiplying by 1, 2, 3, 4, and 5, giving the pandigital, 918273645, which is the concatenated product of 9 and (1,2,3,4,5).
 * 
 * What is the largest 1 to 9 pandigital 9-digit number that can be formed as the concatenated product of an integer with (1,2, ... , n) where n > 1?
 *
 */

require_once(dirname(__FILE__) . '/HelperFunctions.php');


function getConcatedPandigitals($limit = 999999)
{
	$concatedPandigitals = array();
	foreach (range(1, $limit) as $int) {
		$products = array();
		foreach (range(1, 9) as $prod) {
			$products[$prod] = $int * $prod;
			$catProd = implode("", $products);
			if (isPandigital($catProd, 1, 9)) {
				$concatedPandigitals[$catProd] = $int."\twith (".implode(",", range(1, $prod)).")";
			}
		}
	}
	print_r($concatedPandigitals);
	return $concatedPandigitals;
}

function getLargestConcatedPandigital($limit = 999999)
{
	return max(array_keys(getConcatedPandigitals($limit)));
}

echo "\nThe largest 1 to 9 pandigital 9-digit number that can be formed as the concatenated product of an integer:\n";

$start = microtime(true);
$ans = getLargestConcatedPandigital(9999);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
