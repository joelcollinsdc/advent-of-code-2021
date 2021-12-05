#! /usr/bin/env php

<?php

function readRow($row) {
	$row = trim($row);
	$row = str_replace('  ', ' ', $row);
	return explode(' ', $row);
}

function getColumn($board, $i) {
	$ret = [];
	foreach ($board as $row) {
		$ret[] = $row[$i];
	}

	return $ret;
}

function hasWinningMatch(array $rowOrColumn, array $numbers) {
	return array_diff($rowOrColumn, $numbers) === [];
}

function hasBoardWon(array $board, $numbers) {
	foreach ($board as $row) {
		if (hasWinningMatch($row, $numbers)) {
			return true;
		}
	}

	for ($i = 0; $i < 5; $i++) {
		if (hasWinningMatch(getColumn($board, $i), $numbers)) {
			return true;
		}
	}

	return false;
}

function calculateScore($board, $picked) {
	$flattenedBoard = array_merge(...$board);
	$unpickedNumbers = array_diff($flattenedBoard, $picked);

	print("Sum of unpicked is " . array_sum($unpickedNumbers) . "\r\n");
	print("Total is " . array_sum($unpickedNumbers) * array_pop($picked) . "\r\n");
}


$numbers = explode(',', trim(fgets(STDIN)));

// blank line following numbers
fgets(STDIN);

$boards = [];
$i = 0;
while (false !== ($currentrow = fgets(STDIN))) {
	$board = [];
	$board[] = readRow($currentrow);
	for ($i = 0; $i < 4; $i++) {
		$board[] = readRow(fgets(STDIN));
	}

	// blank line following board
	fgets(STDIN);

	$boards[] = $board;
}

// print_r($boards);

$picked = [];
foreach ($numbers as $number) {
	$picked[] = $number;
	$losingBoards = [];
	$winningBoards = [];
	foreach ($boards as $board) {
		if (!hasBoardWon($board, $picked)) {
			$losingBoards[] = $board;
		} else {
			$winningBoards[] = $board;
		}
	}
	print("After picking " . $number . " there were " . count($winningBoards) . " and " .count($losingBoards) . " losing boards.\r\n");

	if (count($losingBoards) <= 1) {
		$lastBoard = $losingBoards[0];

		// keep picking numbers until the last board becomes a winner
		$remaining = array_diff($numbers, $picked);
		foreach ($remaining as $rem) {
			$picked[] = $rem;
			if (hasBoardWon($lastBoard, $picked)) {
				calculateScore($lastBoard, $picked);
				exit;
			}
		}
	}
}
