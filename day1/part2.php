#! /usr/bin/env php

<?php

const WINDOW_SIZE = 3;

$vals = [];
while ($currentval = intval(trim(fgets(STDIN)))) {
	$vals[] = $currentval;
}

$increases = 0;
$window = [];
for ($i=0; $i < WINDOW_SIZE; $i++) {
	$window[] = array_shift($vals);
}

foreach ($vals as $val) {
	$next = $window;
	array_push($next, $val);
	array_shift($next);
	if (array_sum($next) > array_sum($window)) {
		$increases += 1;
	}
	$window = $next;
}

echo "There were $increases increases in depth!\r\n";
