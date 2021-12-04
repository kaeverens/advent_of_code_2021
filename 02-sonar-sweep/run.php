<?php
$inputs=array_map(function($n) { // convert strings to ints
	return intval($n);
}, file('input.txt'));
$increases=0;
for ($i=3;$i<count($inputs);++$i) {
	if ($inputs[$i]>$inputs[$i-3]) {
		$increases++;
	}
}
echo $increases."\n";
