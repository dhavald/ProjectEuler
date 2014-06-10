<?php

function isPrime($num)
{
	if ($num < 2) {
		return false;
	} elseif ($num == 2 || $num == 3 || $num == 5) {
		return true;
	} elseif ($num % 2 == 0 || $num % 3 == 0 || $num % 5 == 0) {
		return false;
	}

	$sqrt = intval(sqrt($num));

	for ($i=3; $i <= $sqrt; $i+=2) {
		if ($num % $i == 0) {
			return false;
		}
	}
	return true;
}

function getPrimes($start = 2, $end = 999999)
{
	$primes = array();
	foreach (range($start, $end) as $num) {
		$primes[$num] = true;
	}
	for ($i = 2; $i*$i <= $end; $i++) {
		for ($j = $end; $j > $i; $j--) {
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

function ncr($n = 2, $r = 1) {
	if ($r > $n / 2) {
		$r = $n - $r;
	}
	$nFact = getFactorial($n);
	$rFact = getFactorial($r);
	$nrFact = getFactorial($n-$r);
	return ($nFact) / ($rFact * $nrFact);
}

function isPalindrome($str)
{
	$str = (string) $str;
	$len = strlen($str);
	if ($len == 1) {
		return true;
	} elseif ($len == 2) {
		return $str[0] == $str[$len - 1];
	} else {
		$remaining = substr($str, 1, $len - 2);
		return $str[0] == $str[$len - 1] && (empty($remaining) || isPalindrome($remaining));
	}
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
	// if xdebug is enabled, make sure to set xdebug.max_nesting_level to accomodate recursion or use the linear factorial function below
	return $num == 1 || $num == 0 ? 1 : $num * getFactorial($num - 1);
}

function getFactorialLinear($num = 1)
{
	if ($num < 0) {
		return 0;
	}
	$factorial = 1;
	for ($i = 2; $i <= $num; $i++) {
		$factorial *= $i;
	}
	return $factorial;
}

function strSum($a, $b)
{
	$arr1 = str_split($a);
	$arr2 = str_split($b);
	$sum = '';
	$carry = 0;
	while (!empty($arr1) || !empty($arr2)) {
		$lastDigit1 = !empty($arr1)? array_pop($arr1) : 0;
		$lastDigit2 = !empty($arr2)? array_pop($arr2) : 0;
		$sumLastDigits = $lastDigit1 + $lastDigit2 + $carry;
		$carry = 0;
		if ($sumLastDigits > 9) {
			$carry = 1;
			$sumLastDigits -= 10;
		}
		$sum = $sumLastDigits . $sum;
	}
	return $sum;
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

function toBinary($num)
{
	$binary = "";
	do {
		$binary = ((string) $num % 2) . $binary;
		$num /= 2;
	} while($num > 1);
	return $binary;
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

function isPandigital($num, $start = 0, $end = 9)
{
	if (strlen($num) != ($end-$start+1)) {
		return false;
	}
	$numArr = str_split($num);
	sort($numArr);
	return implode("", range($start, $end)) == implode("", $numArr);
}

function generatePandigitals($digits = 9, $zeroless = true)
{
	$digitsArr = $zeroless? range(1, $digits) : range(0, $digits);
	return permute(implode("", $digitsArr));
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

function getWordValue($word = "")
{
	$chars = range('A', 'Z');
	$ints = range(1, count($chars));
	$intValues = array_combine($chars, $ints);
	$wordVal = 0;
	foreach (str_split($word) as $char) {
		if (isset($intValues[strtoupper($char)])) {
			$wordVal += $intValues[strtoupper($char)];
		}
	}
	return $wordVal;
}