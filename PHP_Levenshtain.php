<?php
function leven($s1,$s2){
	$l1 = strlen($s1);                    // Länge des $s1 Strings
	$l2 = strlen($s2);                    // Länge des $s2 Strings
	$dis = range(0,$l2);                  // Erste Zeile mit (0,1,2,...,n) erzeugen
                                              // $dis stellt die vorrangeganene Zeile da.
	for($x=1;$x<=$l1;$x++){
		$dis_new[0]=$x;               // Das erste element der darauffolgenden Zeile ist $x, $dis_new ist damit die aktuelle Zeile mit der gearbeitet wird
		for($y=1;$y<=$l2;$y++){
			$c = ($s1[$x-1] == $s2[$y-1])?0:1;
			$dis_new[$y] = min($dis[$y]+1,$dis_new[$y-1]+1,$dis[$y-1]+$c);
		}
		$dis = $dis_new;
	}

	return $dis[$l2];
}

$output = leven("Jason", "Juan");
echo $output;
?>
