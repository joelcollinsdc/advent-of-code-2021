#! /usr/bin/env php

<?php

// if both frequencies equal, must return 1
function findMostFrequentValue(array $vals) {
	$frequencies = array_count_values($vals);
	ksort($frequencies);

	if ($frequencies[1] >= $frequencies[0]) {
		return 1;
	} else {
		return 0;
	}
}

// if both frequencies equal, must return 0
function findLeastFrequentValue(array $vals) {
	$frequencies = array_count_values($vals);
	ksort($frequencies);

	if ($frequencies[0] <= $frequencies[1]) {
		return 0;
	} else {
		return 1;
	}
}

function extractColumnFromRows(array $rows, int $colNum) {
	$ret = [];
	foreach ($rows as $row) {
		$ret[] = $row[$colNum];
	}

	return $ret;
}

function findMostFrequentValueInIthPosition(array $rows, int $colNum) {
	$cols = extractColumnFromRows($rows, $colNum);
	return findMostFrequentValue($cols);
}

function findLeastFrequentValueInIthPosition(array $rows, int $colNum) {
	$cols = extractColumnFromRows($rows, $colNum);
	return findLeastFrequentValue($cols);
}

function filterByMatchingColumnValue($rows, $columnNumber, $matchValue) {
	return array_filter($rows, function ($row) use ($columnNumber, $matchValue) {
		return $row[$columnNumber] == $matchValue;
	});
}

$vals = [];
while ($currentrow = trim(fgets(STDIN))) {
	$vals[] = str_split($currentrow);
}

$i = 0;
$remaining = $vals;
do {
	$mostFrequent = findMostFrequentValueInIthPosition($remaining, $i);
	echo "Most frequnt in column $i is $mostFrequent \r\n";
	$remaining = filterByMatchingColumnValue($remaining, $i, $mostFrequent);
	// print_r(array_values($remaining));

	if (count($remaining) <= 1) {
		break;
	}
	$i++;
} while (true);

$lastRow = implode(array_shift($remaining));
$oxygenGeneratorRating = bindec($lastRow);

echo "Oxygen Generator Rating: $lastRow ($oxygenGeneratorRating) \r\n";

$i = 0;
$remaining = $vals;
do {
	$leastFrequent = findLeastFrequentValueInIthPosition($remaining, $i);
	echo "Least frequnt in column $i is $leastFrequent \r\n";
	$remaining = filterByMatchingColumnValue($remaining, $i, $leastFrequent);

	if (count($remaining) <= 1) {
		break;
	}
	$i++;
} while (true);

print_r($remaining);
$co2Rating = bindec(implode(array_shift($remaining)));

echo "CO2 Rating $co2Rating \r\n";

$total = $co2Rating * $oxygenGeneratorRating;
echo "Total is $total \r\n";
