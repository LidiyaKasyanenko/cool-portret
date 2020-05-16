<?php
	$dir = 'bla/origin';
	$files1 = scandir($dir);
	print_r($files1);

	foreach ($files1 as $key => $value) {
		echo '<li data-thumb="img/gallary_block/gallary/thumb/'.$value.'">'."\n".
										'<a class="fancybox-effects-a" href="img/gallary_block/gallary/origin/'.$value.'" title="">'."\n".
											'<img src="img/gallary_block/gallary/preview/'.$value.'" alt="" />'."\n".
											'<div class="hover"></div>'."\n".
										'</a>'."\n".
									'</li>'."\n\n";
	}
?>