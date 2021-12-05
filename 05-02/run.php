<?php
$lines=file('input.txt');

$points=[];

foreach ($lines as $line) {
	$ends=explode(' -> ', trim($line));
	list($x1, $y1)=explode(',', $ends[0]);
	list($x2, $y2)=explode(',', $ends[1]);
	if ($x2<$x1) { // switch points to reduce complexity
		$x3=$x1; $x1=$x2; $x2=$x3;
		$y3=$y1; $y1=$y2; $y2=$y3;
	}
	if ($x1!=$x2 && $y1==$y2) { // horizontal line
		for ($x=$x1; $x<=$x2; ++$x) {
			$points[$x.'_'.$y1]=($points[$x.'_'.$y1]??0)+1;
		}
	}
	if ($y1!=$y2 && $x2==$x1) { // vertical line
		for ($y=min($y1, $y2); $y<=max($y1, $y2); ++$y) {
			$points[$x1.'_'.$y]=($points[$x1.'_'.$y]??0)+1;
		}
	}
	if ($x1!=$x2 && $y1!=$y2) { // diagonal
		$dir=$y1<$y2?1:-1;
		for ($x=$x1; $x<=$x2; ++$x) {
			$diff=$x-$x1;
			$points[$x.'_'.($y1+$diff*$dir)]=($points[$x.'_'.($y1+$diff*$dir)]??0)+1;
		}
	}
}
$count=0;
foreach ($points as $p) {
	if ($p>1) $count++;
}
echo $count."\n";
