<?php
require_once "lib/config.php";
require_once "lib/valid_form_class.php";
session_start();

$config = new Config();
$valid = new ValidForm($_POST);

if (isset($_GET["upload"])){

	$data = json_decode(file_get_contents ($config->json."json.json"), true);
	$arResult["result"] = true;
	$arResult["message"] = "";
	$arResult["data"] = htmlspecialchars($_POST["size"]);

	$size = htmlspecialchars($_POST["size"]);
	$additionally = json_decode($_POST["additionally"]);



	if (!isset($data["cost_size"]["blocks"][$size])){
		$arResult["result"] = false;
		$arResult["message"] .= "Не найден размер портрета. ";
	}else{
		$arResult["result"] = true;
		$arResult["size_title"] = $data["cost_size"]["blocks"][$size]["size"];
		$arResult["cost"] = $data["cost_size"]["blocks"][$size]["cost"];
		$arResult["count_colors"] = $data["cost_size"]["blocks"][$size]["count_colors"];
		$arResult["cost_add_people"] = $data["cost_add_people"];
		$arResult["cost_post"] = $data["cost_post"];

		// if ($additionally){
		// 	foreach ($additionally as $key => $value) {
		// 		$id = htmlspecialchars($value);
		// 		if (isset($data["additionally"][$id])){
		// 			$sr["id"] = $id;
		// 			$sr["text"] = $data["additionally"][$id]["text"];
		// 			$sr["price"] = $data["additionally"][$id]["price"];
		// 			$sr["type"] = $data["additionally"][$id]["type"];
		// 			$additionally_order[] = $sr;
		// 		}else{
		// 			$arResult["result"] = false;
		// 			$arResult["message"] .= "Не найден данный дополнительный набор. ";
		// 			break;
		// 		}
		// 	}
		// }
		// $arResult["additionally_order"] = json_encode($additionally_order);
		$arResult["additionally_order"] = json_encode($data["additionally"]);
	}

	$val = $valid->getImage($_FILES, session_id());
	$arResult["val"] = $val;
	if ($val){
		$_SESSION['image'] = $val;
		$arResult["image"] = $val;
		$arResult["message"] .= $valid->getMessage()." ";
	}else{
		$arResult["result"] = false;
		$arResult["message"] .= $valid->getMessage()." ";
	}

	echo json_encode($arResult);
}
?>