#! /usr/bin/env php

<?php

$vals = [];
while ($currentrow = trim(fgets(STDIN))) {
	$vals[] = explode(' ', $currentrow);
}

$x = 0;
$y = 0;

foreach ($vals as $val) {
	$direction = $val[0];
	$distance = $val[1];

	switch($direction) {
		case 'up':
			$y += $distance;
			break;
		case 'down':
			$y -= $distance;
			break;
		case 'forward':
			$x += $distance;
			break;
		default:
			throw new \RuntimeException("invalid direction $direction");
	}
}

$depth = $y * -1;
$total = $depth * $x;
echo "Final position was $depth down and $x forward.  Multiplied togeter that is $total !\r\n";
