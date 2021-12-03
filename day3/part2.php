#! /usr/bin/env php

<?php

function findMostFrequentValue(array $vals) {
	$frequencies = array_flip(array_count_values($vals));
	ksort($frequencies);
	$frequencies = array_reverse($frequencies, true);
	return array_shift($frequencies);
}

function findLeastFrequentValue(array $vals) {
	$frequencies = array_flip(array_count_values($vals));
	ksort($frequencies);
	return array_shift($frequencies);
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

	if (count($remaining) <= 1) {
		break;
	}
	$i++;
} while (true);

print_r($remaining);
$oxygenGeneratorRating = bindec(implode(array_shift($remaining)));

echo "Oxygen Generator Rating $oxygenGeneratorRating \r\n";

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
