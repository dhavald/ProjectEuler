<?php

/**
 *
 * An irrational decimal fraction is created by concatenating the positive integers:
 *
 * 0.123456789101112131415161718192021...
 *
 * It can be seen that the 12th digit of the fractional part is 1.
 *
 * If dn represents the nth digit of the fractional part, find the value of the following expression.
 *
 * d1 × d10 × d100 × d1000 × d10000 × d100000 × d1000000
 *
 */


function getChampernowneConstant($n = 1)
{
	$strconcat = implode("", range(1, $n));
	return $strconcat[$n-1];
}

function getChampernowneConstantProduct()
{
	$toProduct = array(
			'1' 	  => getChampernowneConstant(1),
			'10' 	  => getChampernowneConstant(10),
			'100' 	  => getChampernowneConstant(100),
			'1000'    => getChampernowneConstant(1000),
			'10000'   => getChampernowneConstant(10000),
			'100000'  => getChampernowneConstant(100000),
			'1000000' => getChampernowneConstant(1000000)
	);
	print_r($toProduct);
	return  array_product($toProduct);
}

echo "\nValue of p (perimeter of a right angle triangle) for which the number of solutions maximised:\n";

$start = microtime(true);
$ans = getChampernowneConstantProduct(1000);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n\n";
