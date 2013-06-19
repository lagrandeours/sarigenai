<pre>
<?php
	$age1=21;$age2=17;$age3=19;$min;
	if($age1 < $age2 && $age1 < $age3) {
		$min = $age1;
	}
		else {
			if ($age2 < $age1 && $age2 < $age3) {
				$min = $age2;
			} else {
				$min=$age3;
			}
	}
	echo "最年少は".$min."才です。\n";
?>
</pre>