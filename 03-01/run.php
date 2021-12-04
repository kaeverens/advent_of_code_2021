<?php
$gamma=0; $epsilon=0;
$inputs=array_map(function($line) {
	return array_reverse(str_split(trim($line)));
}, file('input.txt'));
$counts=[];
$num_inputs=count($inputs);
for ($j=0;$j<count($inputs[0]);++$j) {
	for ($i=0;$i<$num_inputs;++$i) {
		$counts[$j]=($counts[$j]??0)+intval($inputs[$i][$j]);
	}
	$gamma+=pow(2, $j)*($counts[$j]>$num_inputs/2?1:0);
	$epsilon+=pow(2, $j)*($counts[$j]<$num_inputs/2?1:0);
}
echo $gamma*$epsilon."\n";
