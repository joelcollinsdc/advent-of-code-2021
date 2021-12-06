#! /usr/bin/env php

<?php

const BORN_FISH_COUNT = 8;
const EXISTING_FISH_COUNT = 6;

$fish = explode(',', trim(fgets(STDIN)));

$fishCounts = [0, 0, 0, 0, 0, 0, 0, 0, 0];
foreach ($fish as $f) {
	$fishCounts[$f]++;
}

function processFish(&$fishCounts) {
	// moves all fish counts left by 1
	$fishThatWereAtZero = array_shift($fishCounts);
	$fishCounts[BORN_FISH_COUNT] = $fishThatWereAtZero;
	$fishCounts[EXISTING_FISH_COUNT] += $fishThatWereAtZero;
}

function printFish(&$fishCounts) {
	print_r($fishCounts);
}


printFish($fishCounts);
$days = $argv[1];
for ($i=1; $i <= $days; $i++) {
	// echo "Before $i:\r\n";

	processFish($fishCounts);

	echo "After $i:\r\n";
	printFish($fishCounts);
}

print "There were a total of " . array_sum($fishCounts) . " fish after $days days\r\n";
