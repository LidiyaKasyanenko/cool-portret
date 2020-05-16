<?php
mb_internal_encoding("UTF-8");
require_once "lib/view.php";
require_once "lib/pages/view_discount.php";
require_once "lib/pages/view_delivery.php";
require_once "lib/pages/terms_of_use.php";

if (count($_GET)){
// 	if (count($_GET) > 1){
// 		header("Location: /err404.php");
// 	}
	$url = trim(htmlspecialchars($_GET['page']));
	switch ($url) {
		case 'discount':
			$view = new ViewDiscount();
			break;
		case 'delivery':
			$view = new ViewDelivery();
			break;
		case 'terms-of-use':
			$view = new ViewTermsOfUse();
			break;
		default:
// 			header("Location: /err404.php");
			$view = new View();
			break;
	}
}else{
	$view = new View();
}

echo $view->getContent();

?>