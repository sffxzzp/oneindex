<?php

require 'init.php';

!defined('SITE_NAME') && define('SITE_NAME', $_SERVER['HTTP_HOST']);

//未初始化
if( empty(onedrive::$app_url) ){
	route::any('/','AdminController@install');
}

if (isset($_GET["cache"])) {
	if ($_GET["cache"]=="clear") {
		$dir=opendir(CACHE_PATH);
		while ($file=readdir($dir)) {
			@unlink(CACHE_PATH.$file);
		}
	}
}
//列目录
route::any('{path:#all}','IndexController@index');
