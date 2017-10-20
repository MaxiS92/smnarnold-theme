<?php
	$jsonPath = 'colors.json';
	$json = json_decode(file_get_contents($jsonPath), true);
	array_push($json, [$_POST["c1"], $_POST["c2"]]);

	if ($json != null) {
		$file = fopen($jsonPath, 'w+');
		fwrite($file, json_encode($json));
		fclose($file);
	}
?>