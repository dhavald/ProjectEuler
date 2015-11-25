<?php

/**
 *
 * https://projecteuler.net/problem=54
 *
 * In the card game poker, a hand consists of five cards and are ranked, from lowest to highest, in the following way:
 *
 * High Card: Highest value card.
 * One Pair: Two cards of the same value.
 * Two Pairs: Two different pairs.
 * Three of a Kind: Three cards of the same value.
 * Straight: All cards are consecutive values.
 * Flush: All cards of the same suit.
 * Full House: Three of a kind and a pair.
 * Four of a Kind: Four cards of the same value.
 * Straight Flush: All cards are consecutive values of same suit.
 * Royal Flush: Ten, Jack, Queen, King, Ace, in same suit.
 *
 * The cards are valued in the order: 2, 3, 4, 5, 6, 7, 8, 9, 10, Jack, Queen, King, Ace.
 *
 *
 * If two players have the same ranked hands then the rank made up of the highest value wins; for example, a pair of eights beats a pair of fives (see example 1 below).
 * But if two ranks tie, for example, both players have a pair of queens, then highest cards in each hand are compared (see example 4 below);
 * if the highest cards tie then the next highest cards are compared, and so on.
 *
 * Consider the following five hands dealt to two players:
 *
 * Hand Player 1								Player 2								Winner
 * 5H 5C 6S 7S KD (Pair of Fives)			2C 3S 8S 8D TD (Pair of Eights)			Player 2
 * 5D 8C 9S JS AC (Highest card Ace)		2C 5C 7D 8S QH (Highest card Queen)		Player 1
 * 2D 9C AS AH AC (Three Aces)				3D 6D 7D TD QD (Flush with Diamonds)	Player 2
 * 4D 6S 9H QH QC (2 Queens, 9 Highest)		3D 6D 7H QD QS (2 Queens, 7 Highest)	Player 1
 * 2H 2D 4C 4D 4S (Full House, three 4s)	3C 3D 3S 9S 9D (Full House, three 3s)	Player 1
 *
 * The file, poker.txt, contains one-thousand random hands dealt to two players.
 * Each line of the file contains ten cards (separated by a single space): the first five are Player 1's cards and the last five are Player 2's cards.
 * You can assume that all hands are valid (no invalid characters or repeated cards), each player's hand is in no specific order, and in each hand there is a clear winner.
 *
 * How many hands does Player 1 win?
 */


ini_set('memory_limit', '256m');

$map = array(
    'T' => 10,
    'J' => 11,
    'Q' => 12,
    'K' => 13,
    'A' => 14);

$scores = array(
    'royal_flush'    => 100,
    'straight_flush' => 90,
    'four_a_kind'    => 80,
    'full_house'     => 70,
    'flush'          => 60,
    'straight'       => 50,
    'three_a_kind'   => 40,
    'two_pairs'      => 30,
    'one_pair'       => 20,
    'high_card'      => 10,
);

function findWinCounts($player = 'p1')
{
    $games = getGames();
    $p1 = $p2 = $p = 0;
    foreach ($games as $game) {
    	$winner = decideWinner($game['p1'], $game['p2']);
    	if ($winner == 1 || $winner == 2) {
    		${'p'.$winner}++;
    	}
    }
    echo "\nPlayer1 Won $p1 Times";
    echo "\nPlayer2 Won $p2 Times";
    echo "\nTied $p Times\n";
    return ${$player};
}

function getGames()
{
    global $map;
    $file = dirname(__FILE__) . '/docs/problem54.txt';
    $data = array_map('trim', file($file));
    $games = array();
    $count = 0;
    foreach ($data as $row) {
        $hands = explode(' ', trim($row));
        $h1 = array_slice($hands, 0, 5);
        $h2 = array_slice($hands, -5);
        foreach ($h1 as $k => $a) {
            $h1[$k] = str_split($a);
            $h1[$k][0] = isset($map[$a[0]])? $map[$a[0]] : $h1[$k][0];
            $h1[$k][1] = isset($map[$a[1]])? $map[$a[1]] : $h1[$k][1];
        }
        foreach ($h2 as $k => $b) {
            $h2[$k] = str_split($b);
            $h2[$k][0] = isset($map[$b[0]])? $map[$b[0]] : $h2[$k][0];
            $h2[$k][1] = isset($map[$b[1]])? $map[$b[1]] : $h2[$k][1];
        }
        usort($h1, '_sortHand');
        usort($h2, '_sortHand');
        $games[] = array('p1' => $h1, 'p2' => $h2);
    }
    return $games;
}

function _sortHand($a, $b)
{
    return $a[0] < $b[0];		// sort by face value
}

function decideWinner($hand1, $hand2)
{
    global $scores;
    $handTypes1 = getHandTypes($hand1);
    $handTypes2 = getHandTypes($hand2);
    $commonType = 'high_card';
    foreach ($scores as $handType => $score) {
    	$inP1 = isset($handTypes1[$handType]);
    	$inP2 = isset($handTypes2[$handType]);
    	if ($inP1 && $inP2) {
    		$commonType = $handType;
    		continue;
    	} elseif ($inP1) {
    		return '1';
    	} elseif ($inP2) {
    		return '2';
    	}
    }
    return _decidePerHandType($commonType, $hand1, $hand2);;
}

function getHandTypes($hand)
{
	$counts = _getCounts($hand);
	$colors = $counts['colors'];
	$numbers = $counts['numbers'];
	$faceValues = array_keys($numbers);
	$types = array();
	if (count($colors) == 1 && count($numbers == 5) && ((max($faceValues) - min($faceValues)) == 5)) {
		if (max($faceValues) == 14) {
			$types['royal_flush'] = 1;
		}
		$types['straight_flush'] = 1;
	}
	if ($key4 = array_search(4, $numbers)) {
		if (!empty($key4)) {
			$types['four_a_kind'] = 1;
		}
	}
	$key3 = array_search(3, $numbers);
	$key2 = array_search(2, $numbers);
	if (!empty($key3) && !empty($key2)) {
		$types['full_house'] = 1;
	}
	if (count($colors) == 1) {
		$types['flush'] = 1;
	}
	if (count($numbers) == 5 && (max($faceValues) - min($faceValues)) == 4) {
		$types['straight'] = 1;
	}
	if (!empty($key3)) {
		$types['three_a_kind'] = 1;
	}
	if ($keys = array_keys($numbers, 2)) {
		if (!empty($keys) && count($keys) == 2) {
			$types['two_pairs'] = 1;
		} elseif (!empty($keys) && count($keys) == 1) {
			$types['one_pair'] = 1;
		}
	}
	if (empty($types)) {
		$types['high_card'] = 1;
	}
	return $types;
}

function _decidePerHandType($handType, $hand1, $hand2, $card = 0)
{
	global $called;
	$called++;
    $counts1 = _getCounts($hand1);
    $counts2 = _getCounts($hand2);
    if ($handType == 'straight' || $handType == 'flush' || $handType == 'straight_flush') {
    	return _decidePerHandType('high_card', $hand1, $hand2);
    }
    if ($handType == 'four_a_kind') {
    	$fourKindCard1 = array_search(4, $counts1['numbers']);
    	$fourKindCard2 = array_search(4, $counts2['numbers']);
    	if($fourKindCard1 != $fourKindCard2){
    		return $fourKindCard1 > $fourKindCard2? '1' : '2';
    	} else {
    		return _decidePerHandType('high_card', $hand1, $hand2);
    	}
    }
    if ($handType == 'full_house' || $handType == 'three_a_kind') {
    	$threeKindCard1 = array_search(3, $counts1['numbers']);
    	$threeKindCard2 = array_search(3, $counts2['numbers']);
    	if($threeKindCard1 != $threeKindCard2){
    		return $threeKindCard1 > $threeKindCard2? '1' : '2';
    	} elseif ($handType == 'full_house') {
    		return _decidePerHandType('one_pair', $hand1, $hand2);
    	} else {
    		return _decidePerHandType('high_card', $hand1, $hand2);
    	}
    }
    if ($handType == 'two_pairs') {
    	$pairCard1 = array_keys($counts1['numbers'], 2);
    	$pairCard2 = array_keys($counts2['numbers'], 2);
    	if($pairCard1[0] != $pairCard2[0]){
    		return $pairCard1[0] > $pairCard2[0]? '1' : '2';
    	} elseif($pairCard1[1] != $pairCard2[1]){
    		return $pairCard1[1] > $pairCard2[1]? '1' : '2';
    	} else {
    		return _decidePerHandType('high_card', $hand1, $hand2);
    	}
    }
    if ($handType == 'one_pair') {
    	$pairCard1 = array_search(2, $counts1['numbers']);
    	$pairCard2 = array_search(2, $counts2['numbers']);
    	if($pairCard1 != $pairCard2){
    		return $pairCard1 > $pairCard2? '1' : '2';
    	} else {
    		return _decidePerHandType('high_card', $hand1, $hand2);
    	}
    }
    if ($handType == 'high_card') {
    	$cards1 = array_keys($counts1['numbers']);
    	$cards2 = array_keys($counts2['numbers']);
    	foreach ($cards1 as $key => $val) {
    		if ($cards1[$key] != $cards2[$key]) {
    			return $cards1[$key] > $cards2[$key]? '1' : '2';
    		}
    	}
    	return '';
    }
}

function _getCounts($hand)
{
    $colors = array();
    $numbers = array();
    foreach ($hand as $card) {
        @$numbers[$card[0]]++;
        @$colors[$card[1]]++;
    }
    return array('numbers' => $numbers, 'colors' => $colors);
}

$start = microtime(true);
$ans = findWinCounts('p1');
$end = microtime(true);
$time = ($end - $start)*1000;

echo "\nNumber of hands Player 1 Won:\n";
echo "\nAns\t: $ans";
echo "\nTime\t: $time ms\n\n";

