<?php

function isPrime($num)
{
	if ($num < 2) {
		return false;
	}
	$prime = true;
	for ($i=2; $i*$i <= $num; $i++) {
		if ($num % $i == 0) {
			$prime = false;
			break;
		}
	}
	return $prime;
}

function getPrimesBelow($limit = 999999)
{
	$primes = array();
	foreach (range(2, $limit) as $num) {
		$primes[$num] = true;
	}
	for ($i = 2; $i*$i <= $limit; $i++) {
		if (!isset($primes[$i])) {
			continue;
		}
		for ($j = $limit; $j > $i; $j--) {
			if (isset($primes[$j]) && $j % $i == 0) {
				unset($primes[$j]);
			}
		}
	}
	return array_keys($primes);
}

function getFactors($num)
{
	$factors = array();
	for ($i=1; $i*$i <= $n; $i++) {
		if (($n % $i) == 0){
			$factors[] = $i;
			$factors[] = $n/$i;
		}
	}
	return $factors;
}

function getPrimeFactors($num)
{
	$primeFactors = array();
	while($num >1) {
		for ($i = 2; $i <= $num; $i++) {
			if ($num % $i == 0) {
				if (isPrime($i)) {
					$primeFactors[] = $i;
				}
				$num /= $i;
				break;
			}
		}
	}
	sort($primeFactors);
	return $primeFactors;
}

function isLeapYear($year)
{
	return ($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0;
}

function permute($str)
{
	if (strlen($str) < 2) {
		return array($str);
	}
	$permutations = array();
	$tail = substr($str, 1);
	foreach (permute($tail) as $permutation) {
		$length = strlen($permutation);
		for ($i = 0; $i <= $length; $i++) {
			$permutations[] = substr($permutation, 0, $i) . $str[0] . substr($permutation, $i);
		}
	}
	return $permutations;
}

function quickSort($inputWords)
{
	$count = count($inputWords);
	if ($count == 1 || $count == 0) {
		return $inputWords;
	} elseif ($count == 2) {
		return $inputWords[0] > $inputWords[1] ? array($inputWords[1], $inputWords[0]) : $inputWords;
	}
	$middle = intval($count/2);
	$pivot = $inputWords[$middle];
	unset($inputWords[$middle]);
	$left = array();
	$right = array();
	foreach ($inputWords as $key => $word) {
		if ($word >= $pivot) {
			$right[] = $word;
		} elseif ($word < $pivot) {
			$left[] = $word;
		}
	}
	return array_merge(quickSort($left), array($pivot), quickSort($right));
}

function mergeSort($array, $count)
{
	if ($count == 1) {
		return $array;
	} elseif ($count == 2) {
		return ($array[0] > $array[1])? array($array[1], $array[0]) : $array;
	} else {
		$middle = intval($count/2);
		$left = array_splice($array, $middle);
		$right = $array;
		$leftSorted = mergeSort($left, count($left));
		$rightSorted = mergeSort($right, count($right));
		return merge($leftSorted, $rightSorted);
	}
}

function merge($left, $right)
{
	$return = array();
	$lc = count($left);
	$rc = count($right);
	for($i = 0, $j = 0; $i != $lc || $j != $rc; ) {
		if (isset($left[$i]) && isset($right[$j])) {
			if ($left[$i] > $right[$j]) {
				$return[] = $right[$j++];
			} else {
				$return[] = $left[$i++];
			}
		} elseif (isset($left[$i])) {
			$return[] = $left[$i++];
		} elseif (isset($right[$j])) {
			$return[] = $right[$j++];
		}
	}
	return $return;
}

function getLowestTerms($numerator, $denominator)
{
	$numeratorFactors = getPrimeFactors($numerator);
	$denominatorFactors = getPrimeFactors($denominator);
	$commonFactors = array_intersect($numeratorFactors, $denominatorFactors);
	$product = array_product($commonFactors);
	$numerator /= $product;
	$denominator /= $product;
	return array($numerator => $denominator);
}

function getFactorial($num = 1)
{
	return $num == 1 || $num == 0 ? 1 : $num * getFactorial($num - 1);
}

function getDigits($num = 1)
{
	$digits = array();
	while ($num > 1) {
		$digits[] = $num % 10;
		$num /= 10;
	}
	return $digits;
}

function isCuriousNumber($num = 1)
{
	$digits = getDigits($num);
	$factorialSum = 0;
	foreach ($digits as $digit) {
		$factorialSum += getFactorial($digit);
	}
	return count($digits) != 1 && $factorialSum == $num;
}

function getRotations($str = "")
{
	$len = strlen($str);
	$rotations = array();
	for ($i = 0; $i < $len; $i++) {
		$prefix = substr($str, 0, $i);
		$char = $str[$i];
		$postfix = substr($str, $i);
		$rotations[] = $char.$postfix.$prefix;
	}
	return $rotations;
}