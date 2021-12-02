#! /usr/bin/env php

<?php

$vals = [];
while ($currentval = intval(trim(fgets(STDIN)))) {
	$vals[] = $currentval;
}

$increases = 0;
# dont count first one as an increase
$previous = array_shift($vals);
foreach ($vals as $val) {
	if ($val > $previous) {
		$increases += 1;
	}
	$previous = $val;
}

echo "There were $increases increases in depth!\r\n";
