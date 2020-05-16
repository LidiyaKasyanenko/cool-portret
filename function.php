<?php
require_once "lib/mail.php";
require_once "lib/config.php";
require_once "lib/manage_class.php";
require_once "lib/valid_form_class.php";

$config = new Config();
$manage = new Manage();
$valid = new ValidForm($_POST);

if (isset($_POST["auth"])){
	$manage->auth();
}
if (isset($_POST["logout"])){
	$manage->logout();
}
if (isset($_POST["save_data"])){
	$manage->saveData();
}

if (isset($_GET["call_form"])){
	$arResult["phone"] = htmlspecialchars($_POST["phone"]);
	if (!$valid->validPhone($arResult["phone"])){
		$arResult["rezult"] = "err";
	}else{
		$mail = new Mail();
		if ($mail->sendAppFormPhone($arResult) === true){
			$arResult["rezult"] = "ok";
		}else{
			$arResult["rezult"] = "err";
		}
	}
	echo json_encode($arResult);
}




if (isset($_GET["add_order"])){

	$sr["name"] = htmlspecialchars($_POST["name"]);
	$sr["phone"] = htmlspecialchars($_POST["phone"]);
	$sr["city"] = htmlspecialchars($_POST["city"]);
	$sr["email"] = htmlspecialchars($_POST["email"]);
	$sr["date"] = htmlspecialchars($_POST["date"]);
	$sr["size"] = htmlspecialchars($_POST["size"]);
	$sr["count_people"] = htmlspecialchars($_POST["count_people"]);
	$sr["palette"] = $_POST["palette"];
	$sr["type_post"] = htmlspecialchars($_POST["type_post"]);
	$sr["cost_post"] = htmlspecialchars($_POST["cost_post"]);
	$sr["additionally"] = $_POST["additionally"];
	$sr["where_send"] = json_decode($_POST["where_send"], true);
	$sr["message"] = htmlspecialchars($_POST["message"]);



	$arResult["rezult"] = "ok";

	if (!$valid->validName($sr["name"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validPhone($sr["phone"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validCity($sr["city"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validEmail($sr["email"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	// if (!$valid->validDate($sr["date"])){
	// 	$arResult["rezult"] = "err";
	// 	$arResult["message"] .= $valid->getMessage();
	// }
	if (!$valid->validSize($sr["size"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}else{
		if (!$valid->validCountPeople($sr["count_people"], $sr["size"])){
			$arResult["rezult"] = "err";
			$arResult["message"] .= $valid->getMessage();
		}
		// if (!$valid->validPalette($sr["palette"], $sr["size"])){
		// 	$arResult["rezult"] = "err";
		// 	$arResult["message"] .= $valid->getMessage();
		// }
	}
	if (!$valid->validTypePost($sr["type_post"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validCostPost($sr["cost_post"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validAdditionally($sr["additionally"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}

	if (!strcmp($arResult["rezult"],"ok")){
		$sr["image"] = $_SESSION['image'];
		$sr["session_id"] = session_id();

		// $sr["size_title"] = $manage->getSizeTitle($sr["size"]);
		$sr["post"] = $manage->getPost($sr["type_post"], $sr["cost_post"]);
		$sr["portret"] = $manage->getPortret($sr["size"]);
		$sr["additionally"] = $manage->getAdditionally($sr["additionally"]);
		// $sr["palette"] = $manage->getPalette($sr["palette"]);


		$mail = new Mail();
		if ($mail->sendAppForm($sr) === true){
			$arResult["rezult"] = "ok";
		}else{
			$arResult["rezult"] = "err";
		}
	}


	echo json_encode($arResult);
}




if (isset($_GET["add_sketch"])){


	$sr["name"] = htmlspecialchars($_POST["name"]);
	$sr["phone"] = htmlspecialchars($_POST["phone"]);
	$sr["city"] = htmlspecialchars($_POST["city"]);
	$sr["email"] = htmlspecialchars($_POST["email"]);
	$sr["date"] = htmlspecialchars($_POST["date"]);
	$sr["size"] = htmlspecialchars($_POST["size"]);
	$sr["count_people"] = htmlspecialchars($_POST["count_people"]);
	$sr["where_send"] = json_decode($_POST["where_send"], true);
	$sr["message"] = htmlspecialchars($_POST["message"]);



	$arResult["rezult"] = "ok";

	if (!$valid->validName($sr["name"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validPhone($sr["phone"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validCity($sr["city"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	if (!$valid->validEmail($sr["email"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}
	// if (!$valid->validDate($sr["date"])){
	// 	$arResult["rezult"] = "err";
	// 	$arResult["message"] .= $valid->getMessage();
	// }
	if (!$valid->validSize($sr["size"])){
		$arResult["rezult"] = "err";
		$arResult["message"] .= $valid->getMessage();
	}else{
		if (!$valid->validCountPeople($sr["count_people"], $sr["size"])){
			$arResult["rezult"] = "err";
			$arResult["message"] .= $valid->getMessage();
		}

	}

	if (!strcmp($arResult["rezult"],"ok")){
		$sr["image"] = $_SESSION['image'];
		$sr["session_id"] = session_id();

		$sr["portret"] = $manage->getPortret($sr["size"]);
		$sr["additionally"] = $manage->getAdditionally($sr["additionally"]);


		$mail = new Mail();
		if ($mail->sendSketch($sr) === true){
			$arResult["rezult"] = "ok";
		}else{
			$arResult["rezult"] = "err";
		}
	}


	echo json_encode($arResult);
}




// if (isset($_POST["add_order"])){
// 	$arResult["delivery"] = htmlentities($_POST["delivery"]);

// 	$sr["delivery"] = htmlentities($_POST["delivery"]);
// 	$sr["delivery_text"] = htmlentities($_POST["delivery_text"]);
// 	$sr["name"] = $_SESSION['name'];
// 	$sr["phone"] = $_SESSION['phone'];
// 	$sr["size"] = $_SESSION['size_title'];
// 	$sr["count_people"] = $_SESSION['count_people'];
// 	$sr["city"] = $_SESSION['city_title'];
// 	$sr["date"] = $_SESSION['date'];
// 	$sr["cost"] = $_SESSION['cost'];
// 	$sr["image"] = $_SESSION['image'];
// 	$sr["session_id"] = session_id();

// 	$mail = new Mail();
// 	if ($mail->sendAppForm($sr) === true){
// 		$arResult["rezult"] = "ok";
// 	}else{
// 		$arResult["rezult"] = "err";
// 	}
// 	echo json_encode($arResult);
// }




?>