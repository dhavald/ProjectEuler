<?php

/**
 * The fraction 49/98 is a curious fraction,
 * as an inexperienced mathematician in attempting to simplify it may incorrectly believe that 49/98 = 4/8,
 * which is correct, is obtained by cancelling the 9s.
 *
 * We shall consider fractions like, 30/50 = 3/5, to be trivial examples.
 *
 * There are exactly four non-trivial examples of this type of fraction, less than one in value, and containing two digits in the numerator and denominator.
 *
 * If the product of these four fractions is given in its lowest common terms, find the value of the denominator.
 *
 */

require_once(dirname(__FILE__) . '/../bootstrap.php');
require_once(dirname(__FILE__) . '/HelperFunctions.php');
ini_set('memory_limit', '-1');


function isCuriousFraction($numerator, $denominator)
{
	$curious = false;
	$commonDigits = array_intersect(str_split($numerator), str_split($denominator));

	if(!empty($commonDigits) && count($commonDigits) == 1) {
		$commonDigit = array_pop($commonDigits);
		$numerator1 = str_replace($commonDigit, '', $numerator);
		$denominator1 = str_replace($commonDigit, '', $denominator);
		$lt = getLowestTerms($numerator, $denominator);
		$lt1 = getLowestTerms($numerator1, $denominator1);
		if ($lt == $lt1) {
			$curious = true;
		}
	}
	return $curious;
}

function isTrivialFraction($numerator, $denominator)
{
	$digitsNum = str_split($numerator);
	$digitsDen = str_split($denominator);
	return $digitsNum[1] == $digitsDen[1];
}

function getCuriousFactors($start = 1, $end = 99)
{
	$curiousFactors = array();
	foreach (range($start, $end) as $numerator) {
		foreach (range($numerator+1, $end) as $denominator) {
			if (!isTrivialFraction($numerator, $denominator) && isCuriousFraction($numerator, $denominator)) {
				$curiousFactors[$numerator] = $denominator;
			}
		}
	}
	return $curiousFactors;
}

function getCuriousFactorDenominator($start, $end)
{
	$curiousFactors = getCuriousFactors($start, $end);
	$numeratorProduct = array_product(array_keys($curiousFactors));
	$denominatorProduct = array_product(array_values($curiousFactors));
	$lcTerm = getLowestTerms($numeratorProduct, $denominatorProduct);
	return array_pop($lcTerm);
}

echo "\nThe value of the denominator of lowest common terms for four non-trivial curious fractions:\n";

$start = microtime(true);
$ans = getCuriousFactorDenominator(10,99);
$end = microtime(true);
$time = number_format($end - $start, 15);

echo "\nAns\t: $ans";
echo "\nTime\t: $time\n";
