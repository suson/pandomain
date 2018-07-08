<?php
header("Content-type: text/html; charset=utf-8");
defined('APP_PATH') 	or define('APP_PATH',       dirname($_SERVER['SCRIPT_FILENAME']).'/');
require_once APP_PATH.'vendor/autoload.php';

/**
 * 随机泛域名
 * @param  [type]  $length  [description]
 * @param  [type]  $domains [description]
 * @param  integer $level   [description]
 * @return [type]           [description]
 */
function randomkeys($length,$domains,$level=-1) {
    if($level == -1){
        $level = mt_rand(1,3); //随机层级
    }
    if($length == -1){
        $length = mt_rand(1,3);
    }
    $returnStr='';
    for($j=0;$j<$level;$j++){
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        for($i = 0; $i < $length; $i ++) {
            $returnStr .= $pattern {mt_rand ( 0, 61 )}; //生成php随机数
        }
        $returnStr .= '.';
    }
    if (is_array($domains)) {
    	$domain_key = array_rand($domains);
    	$returnStr .= $domains[$domain_key]; 
    } else {
    	$returnStr .= $domains;
    }
    
    return $returnStr;
}
// $cik1 = file_get_contents($cikufile);
// $ci01 = explode("\r\n", $cik1);
// array_pop($ci01);

// for($i=0;$i<10;$i++){
//     shuffle($ci01);
//     $url = randomkeys(3,$domains);
//     echo '<a class="noa" href="[图片]http://'.$url.'">'.iconv("GBK", "UTF-8//IGNORE", $ci01[0]).'</a><br />';
// }

// for($i=0;$i<10;$i++){
//     shuffle($ci01);
//     $url = randomkeys(-1,$domains,1);
//     echo '<a class="noa" href="[图片]http://'.$url.'">'.iconv("GBK", "UTF-8//IGNORE", $ci01[0]).'</a><br />';
// }

// for($i=0;$i<10;$i++){
//     shuffle($ci01);
//     $url = randomkeys(-1,$domains,-1);
//     echo '<a class="noa" href="[图片]http://'.$url.'">'.iconv("GBK", "UTF-8//IGNORE", $ci01[0]).'</a><br />';
// }
// echo '<div></body></html>';

// $out_content = ob_get_contents();


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
