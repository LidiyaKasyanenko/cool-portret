<?php

require_once "lib/config.php";

$config = new Config();
$data = json_decode(file_get_contents ($config->json."json.json"), true);

if (isset($_GET["info"])){
	$size = htmlspecialchars($_POST["size"]);

	if (!isset($data["cost_size"]["blocks"][$size])){
		$arResult["result"] = false;
	}else{
		$arResult["result"] = true;
		$arResult["size_title"] = $data["cost_size"]["blocks"][$size]["size"];
		$arResult["cost"] = $data["cost_size"]["blocks"][$size]["cost"];
		$arResult["count_colors"] = $data["cost_size"]["blocks"][$size]["count_colors"];
		$arResult["cost_add_people"] = $data["cost_add_people"];
	}

	echo json_encode($arResult);

}elseif (isset($_GET["colors"])){
	$arResult["colors"] = $data["colors"];
	echo json_encode($arResult);
}elseif (isset($_GET["additionally"])){
	$arResult["additionally_order"] = json_encode($data["additionally"]);
	echo json_encode($arResult);
}