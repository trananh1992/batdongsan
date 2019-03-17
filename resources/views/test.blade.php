<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	{{dd($dd)}}
<?php

foreach ($dd as $key => $value) {
	if($value->tinh !== ""){ 
	echo($value->tinh);
echo "<br>";
	if($value->huyen != NULL){
		for ($i=0; $i < sizeof($value->huyen) ; $i++) {
		if($value->huyen[$i]['ten'] == "Huyện 1"){ 
			echo $value->huyen[$i]['ten']."<br>";
			if($value->huyen[$i]['xa'] != NULL){
				$xa = $value->huyen[$i]['xa'];
				for ($j=0; $j < sizeof($xa) ; $j++) { 
				echo $xa[$j]['ten']."<br>";
				}
			}
				
		}
	}
	}
}
}
?>
</body>
</html>
