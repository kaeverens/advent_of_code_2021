<?php
$oxygen=0; $co2=0;
$inputs=array_map(function($line) {
	return array_reverse(str_split(trim($line)));
}, file('input.txt'));
// { oxygen generator
$remaining=json_decode(json_encode($inputs));
for ($j=count($inputs[0])-1;$j>-1;--$j) {
	$count=0;
	$num_remaining=count($remaining);
	for ($i=0;$i<$num_remaining;++$i) {
		$count+=intval($remaining[$i][$j]);
	}
	$bit=$count==$num_remaining/2
		?1
		:( ($count>$num_remaining/2)?1:0 );
	$new_remaining=[];
	for ($i=0;$i<$num_remaining;++$i) {
		if (intval($remaining[$i][$j])==$bit) {
			$new_remaining[]=$remaining[$i];
		}
	}
	if (count($new_remaining)==1) {
		$oxygen=$new_remaining[0];
		break;
	}
	$remaining=$new_remaining;
}
// }
// { CO2 scrubber
$remaining=json_decode(json_encode($inputs));
for ($j=count($inputs[0])-1;$j>-1;--$j) {
	$count=0;
	$num_remaining=count($remaining);
	for ($i=0;$i<$num_remaining;++$i) {
		$count+=intval($remaining[$i][$j]);
	}
	$bit=$count==$num_remaining/2
		?0
		:( ($count<$num_remaining/2)?1:0 );
	$new_remaining=[];
	for ($i=0;$i<$num_remaining;++$i) {
		if (intval($remaining[$i][$j])==$bit) {
			$new_remaining[]=$remaining[$i];
		}
	}
	if (count($new_remaining)==1) {
		$co2=$new_remaining[0];
		break;
	}
	$remaining=$new_remaining;
}
// }
function bin2dec($arr) {
	$val=0;
	for ($i=0;$i<count($arr);++$i) {
		$val+=pow(2, $i)*intval($arr[$i]);
	}
	return $val;
}
echo bin2dec($oxygen)*bin2dec($co2)."\n";
