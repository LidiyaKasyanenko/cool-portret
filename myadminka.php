<?php
	session_start();

	mb_internal_encoding("UTF-8");
	require_once "lib/view_admin.php";

	$view = new ViewAdmin();

	if (!isset($_SESSION["auth"])){
		echo $view->getContentAuth($_SESSION["message"]);
		unset($_SESSION["message"]);
	}else{
		echo $view->getContent2($_SESSION["message"]);
		unset($_SESSION["message"]);
	}

?>