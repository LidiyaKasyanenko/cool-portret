<?php
	header("HTTP/1.1 404 Not Found");

	mb_internal_encoding("UTF-8");
	require_once "lib/view_err.php";

	$view = new ViewErr(404);
	echo $view->getContent();

?>