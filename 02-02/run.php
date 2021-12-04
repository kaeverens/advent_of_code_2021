<?php
$x=0; $y=0;
$aim=0;
$inputs=file('input.txt');
foreach ($inputs as $line) {
	$words=explode(' ', $line);
	$val=intval($words[1]);
	switch ($words[0]) {
		case 'forward':
			$x+=$val;
			$y+=$val*$aim;
			break;
		case 'down':
			$aim+=$val;
			break;
		case 'up':
			$aim-=$val;
			break;
	}
}
echo ($x*$y)."\n";
