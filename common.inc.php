<?php
header("Content-type: text/html; charset=utf-8");
defined('APP_PATH') 	or define('APP_PATH',       dirname($_SERVER['SCRIPT_FILENAME']).'/');
require_once APP_PATH.'vendor/autoload.php';




/**
 * 获取指定目录下面的某个随机文件名
 * @param  [type] $directory [description]
 * @return [type]            [description]
 */
function getRandomFileName($directory) 
{ 
	$mydir = dir($directory); 
	$files = array(); 
	while($file = $mydir->read())
	{ 
		if(is_dir("$directory/$file")) continue;
		if($file == ".")  continue;
		if($file == "..") continue;
		
		array_push($files, $file);
	} 
	$mydir->close(); 
	
	srand((float) microtime() * 10000000);
	$index = array_rand($files);
	return $files[$index];
} 
 
/**
 * 读取文件n行数据
 * @param  [type]  $filename  [description]
 * @param  integer $startLine [description]
 * @param  integer $limitLine [description]
 * @param  [type]  $method    [description]
 * @return [type]             [description]
 */
function getFileLines($filename, $startLine = 1, $limitLine = 50, $method = 'rb')
{
	$content = array();
	$fp = new SplFileObject($filename, $method);
	$fp->seek($startLine - 1);// 转到第N行, seek方法参数从0开始计数
	// var_dump($fp->getMaxLineLen());exit;

	for($i = 0; $i < $limitLine; $i++) {
		$current = trim($fp->current());// current()获取当前行内容
		if (empty($current)) {
			continue;
		}
		// var_dump(mb_detect_encoding($current, "UTF-8,GBK,ASCII,ANSI,UTF-8,ASCII,ANSI,GBK,LATIN1,BIG5"));
		// if (mb_detect_encoding($current, array('UTF-8','GBK','LATIN1','BIG5')) === 'UTF-8') {
		// 	$content[] = $current;
		// } else {
		// 	$content[] = mb_convert_encoding($current, "UTF-8", array('UTF-8','GBK','LATIN1','BIG5'));
		// }
		!empty($current) && $content[] = mb_convert_encoding($current, "UTF-8", "UTF-8,GBK,ASCII,ANSI");
		$fp->next();// 下一行
		// var_dump($fp->getCurrentLine());
	}

	return $content;
}

/**
 * 获取文件最大行数
 * @param  [type] $filename [description]
 * @param  string $method   [description]
 * @return [type]           [description]
 */
function getFileTotalLine($filename , $method = 'rb')
{
	$fp = new SplFileObject($filename, $method);
	$fp->seek(0);// 转到第N行, seek方法参数从0开始计数
	$i = 0;
	while ($fp->current()) {
		$i++;
		$fp->next();
	}
	return $i;
}

/**
 * 获取文件随机行数内容
 * @param  [type] $filename [description]
 * @param  [type] $num      [description]
 * @return [type]           [description]
 */
function getRandContent($filename , $num)
{
	$line = getFileTotalLine($filename);
	$start = ($line - $num) > 1 ? ($line - $num) : 1;
	$start = mt_rand(1,$start);
	$content = getFileLines($filename,$start,$num);
	shuffle($content);
	return $content;
}
