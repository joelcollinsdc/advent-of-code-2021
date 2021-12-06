#! /usr/bin/env php

<?php

const BORN_FISH_COUNT = 8;
const EXISTING_FISH_COUNT = 6;

$fish = explode(',', trim(fgets(STDIN)));

function addNewLanternfish(&$fish) {
	$next = count($fish);
	$fish[$next] = BORN_FISH_COUNT;
}

function processFishAt(&$fish, $i) {
	$current = $fish[$i];
	$next = $current - 1;
	if ($next < 0) {
		addNewLanternfish($fish);
		$next = EXISTING_FISH_COUNT;
	}
	$fish[$i] = $next;
}

function processFish(&$fish) {
	foreach ($fish as $k => $_) {
		processFishAt($fish, $k);
	}
}

function printFish(&$fish) {
	print implode(',', $fish) . "\r\n";
}


printFish($fish);
$days = $argv[1];
for ($i=1; $i <= $days; $i++) {
	// echo "Before $i:\r\n";

	processFish($fish);

	echo "After $i:\r\n";
	echo memory_get_usage();
	// printFish($fish);
}

print "There were a total of " . count($fish) . " fish after $days days\r\n";
