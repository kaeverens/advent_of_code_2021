<?php
$lines=file('input.txt');
$bingo_numbers=explode(',', trim($lines[0]));

$boards=[];
for ($i=2;$i<count($lines);$i+=6) {
	$rows=[];
	$cols=[[], [], [], [], []];
	$numbers=[];
	for ($j=0;$j<5;++$j) {
		$row=preg_split('/ +/', trim($lines[$i+$j]));
		for ($k=0;$k<count($row);++$k) {
			$cols[$k][]=$row[$k];
			$numbers[]=$row[$k];
		}
		$rows[]=$row;
	}
	$boards[]=[
		'numbers'=>$numbers,
		'rows'=>$rows,
		'cols'=>$cols
	];
}

function bingo($num, $nums) {
	$sum=0;
	foreach ($nums as $num2) {
		$sum+=intval($num2);
	}
	echo $sum*$num."\n";
}
foreach ($bingo_numbers as $num) {
	foreach ($boards as $bidx=>$board) {
		if (in_array($num, $board['numbers'])) {
			$board['numbers'][array_search($num, $board['numbers'])]=$board['numbers'][count($board['numbers'])-1];
			array_pop($board['numbers']);
		}
		foreach ($board['cols'] as $idx=>$col) {
			if (in_array($num, $col)) {
				$col[array_search($num, $col)]=$col[count($col)-1];
				array_pop($col);
				$board['cols'][$idx]=$col;
				if (count($col)==0) {
					if (count($boards)==1) {
						die(bingo($num, $board['numbers']));
					}
					else {
						$board['remove']=1;
					}
				}
			}
		}
		foreach ($board['rows'] as $idx=>$row) {
			if (in_array($num, $row)) {
				$row[array_search($num, $row)]=$row[count($row)-1];
				array_pop($row);
				$board['rows'][$idx]=$row;
				if (count($row)==0) {
					if (count($boards)==1) {
						die(bingo($num, $board['numbers']));
					}
					else {
						$board['remove']=1;
					}
				}
			}
		}
		$boards[$bidx]=$board;
	}
	for ($j=count($boards)-1; $j>=-1;--$j) {
		if (isset($boards[$j]['remove'])) {
			$boards[$j]=$boards[count($boards)-1];
			array_pop($boards);
		}
	}
}
