#! /usr/bin/env php

<?php

$vals = [];
while ($currentrow = trim(fgets(STDIN))) {
	$vals[] = str_split($currentrow);
}

$length = count($vals[0]);

$columns = [];
for ($i=0; $i<$length; $i++) {
	foreach ($vals as $val) {
		$columns[$i][] = $val[$i];
	}
}

# columns[0] now contains all the first characters, etc

$mostFrequents = [];
$leastFrequents = [];
foreach ($columns as $column) {
	$frequencies = array_flip(array_count_values($column));
	ksort($frequencies);
	$frequencies = array_reverse($frequencies, true);
	$mostFrequent = array_shift($frequencies);
	$mostFrequents[] = $mostFrequent;
	$leastFrequents[] = $mostFrequent == '1' ? '0' : '1';
}

$mostFrequents = implode($mostFrequents);
$binFrequents = bindec($mostFrequents);

$leastFrequents = implode($leastFrequents);
$binLeastFrequents = bindec($leastFrequents);
$total = $binFrequents * $binLeastFrequents;
echo "Most frequent chars: $mostFrequents, ($binFrequents), least frequent chars $leastFrequents ($binLeastFrequents) for a total of $total\r\n";
