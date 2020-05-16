<?php
	header("HTTP/1.1 302");

	mb_internal_encoding("UTF-8");
	require_once "lib/view_err.php";

	$view = new ViewErr(302);
	echo $view->getContent();

?>