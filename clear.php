<?php

require_once "lib/config.php";

$config = new Config();


//Очистка буферной папки от старых изображений.
$files = scandir($config->img_tmp);
$d2 = time();


foreach ($files as $key => $value) {
	if (strlen($value)>15){
		$file = $config->img_tmp."/".$value;
		$d1 = filectime($file);
		$d3 = ($d2 - $d1)/3600/24;
		if ($d3 > 30){
			if (file_exists($file)){
				unlink($file);
			}
		}
	}
}