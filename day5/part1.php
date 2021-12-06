#! /usr/bin/env php

<?php

function pluck($key, $arr) {
	$ret = [];
	foreach ($arr as $a) {
		$ret[] = $a[$key];
	}

	return $ret;
}

$maxX = 0;
$maxY = 0;
function readRow($row) {
	global $maxX;
	global $maxY;

	[$left, $right] = explode(' -> ', $row);
	[$x0, $y0] = explode(',', $left);
	[$x1, $y1] = explode(',', $right);

	if (max($x0, $x1) > $maxX) {
		$maxX = max($x0, $x1);
	}
	if (max($y0, $y1) > $maxY) {
		$maxY = max($y0, $y1);
	}

	return [
		['x' => $x0, 'y' => $y0],
		['x' => $x1, 'y' => $y1],
	];
}

function printLine($line) {
	echo $line[0]['x'] . ',' . $line[0]['y'] . ' => ' . $line[1]['x'] . ',' . $line[1]['y'] . "\r\n";
}


function fillInLine(&$grid, $line) {
	// echo "filling line: ";
	// printLine($line);
	['x' => $x0, 'y' => $y0] = $line[0];
	['x' => $x1, 'y' => $y1] = $line[1];
	// $x0 = intval($x0);
	// $x1 = intval($x1);
	if ($x0 < $x1) {
		$xInc = 1;
	} elseif ($x0 > $x1) {
		$xInc = -1;
	} else {
		$xInc = 0;
	}

	echo "xInc is $xInc\r\n";


	if ($y0 < $y1) {
		$yInc = 1;
	} elseif ($y0 > $y1) {
		$yInc = -1;
	} else {
		$yInc = 0;
	}

	$curr = $line[0];
	$count = 0;
	echo "filling point " . $curr['x'] . "," . $curr['y'] . "\r\n";
	$grid[$curr['y']][$curr['x']]++;
	while (($curr['x'] != $x1) || $curr['y'] != $y1) {
		$curr['x'] += $xInc;
		$curr['y'] += $yInc;
		echo "filling point " . $curr['x'] . "," . $curr['y'] . "\r\n";
		$grid[$curr['y']][$curr['x']]++;

		// if (($curr['x'] > 10) || $curr['y'] > 10) {
		// 	exit;
		// }

		// if ($count > 25) {
		// 	exit;
		// }
		$count++;

		// echo "comparing " . $curr['x'] . ' to ' . $x1 . "\r\n";
		// echo "comparing " . $curr['y'] . ' to ' . $y1 . "\r\n";
	}

	// for ($i = $line[0]['y']; $i != $line[1]['y']; $y0 > $y1 ? $i--: $i++) {
	// 	for ($j = $line[0]['x']; $j != $line[1]['x']; $x0 > $x1 ? $j--: $j++) {
	// 		echo "Filling in $i, $j\r\n";
	// 		$grid[$i][$j]++;
	// 	}
	// }
}

$lines = [];
while (false !== ($currentrow = fgets(STDIN))) {
	$lines[] = readRow(trim($currentrow));
}

$grid = [];
echo "Max X is $maxX";
echo "Max Y is $maxY";
for ($i = 0; $i <= $maxX; $i++) {
	$grid[$i] = [];
	for ($j = 0; $j <= $maxY; $j++) {
		$grid[$i][$j] = 0;
	}
}

$count = 0;
foreach ($lines as $line) {
	print_r($line);
	#part 2 was commenting out this line
	// if (($line[0]['y'] == $line[1]['y']) || ($line[0]['x'] == $line[1]['x'])) {
		printLine($line);
		fillInLine($grid, $line);
	// } else {
		// printLine($line);
		// print_r($line);
	// }
}

// print_r($grid);

$overlapping = 0;
for ($i = 0; $i <= $maxX; $i++) {
	for ($j = 0; $j <= $maxY; $j++) {
		if ($grid[$i][$j] >= 2) {
			$overlapping++;
		}
	}
}

print "Overlapping: $overlapping \r\n";
