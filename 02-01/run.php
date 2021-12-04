<?php
$x=0; $y=0;
$inputs=file('input.txt');
foreach ($inputs as $line) {
	$words=explode(' ', $line);
	switch ($words[0]) {
		case 'forward':
			$x+=intval($words[1]);
			break;
		case 'down':
			$y+=intval($words[1]);
			break;
		case 'up':
			$y-=intval($words[1]);
			break;
	}
}
echo ($x*$y)."\n";
