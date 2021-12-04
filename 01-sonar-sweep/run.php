<?php
$inputs=file('input.txt');
$increases=0;
for ($i=1;$i<count($inputs);++$i) {
	if (intval($inputs[$i])>intval($inputs[$i-1])) {
		$increases++;
	}
}
echo $increases."\n";
