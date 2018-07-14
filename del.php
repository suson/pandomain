<?php

require_once 'common.inc.php';
$dir = !empty($_GET['dir']) ? trim($_GET['dir']) : '';

if (empty($dir)) {
	echo 'empty';exit;
}
$cache_dir = APP_PATH.'cache/'.$dir.'/';
if (!is_dir($cache_dir)) {
	echo 'not dir';
}

delFileUnderDir($cache_dir);
//循环目录下的所有文件 
function delFileUnderDir($dirName='') 
{ 
	if ( $handle = opendir( "$dirName" ) ) { 
	while ( false !== ( $item = readdir( $handle ) ) ) { 
		if ( $item != "." && $item != ".." ) {
			if ( is_dir( "$dirName/$item" ) ) {
				delFileUnderDir( "$dirName/$item" );
			} else {
				//开源代码phpfensi.com 
				if( unlink( "$dirName/$item" ) ) echo "成功删除文件： $dirName/$item<br />\n"; 
			} 
		} 
	} 
	closedir( $handle ); 
	} 
} 