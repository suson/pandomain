<?php
require_once 'common.inc.php';
$httphost = $_SERVER['HTTP_HOST'];
$data = explode('.', $httphost);
$co_ta = count($data);
$cache_dir = APP_PATH.'cache/';
// 泛域名读取读取静态缓存文件
if ($co_ta > 2) {
	if(file_exists($cache_dir.$httphost.'.html')){
		include $cache_dir.$httphost.'.html';
		die();
	}
}




// var_dump(APP_PATH);

// $keyword_file = APP_PATH.'keyword_file/keyword.txt';
// $domain_file = APP_PATH.'domain_file/domain.txt';
// $title_file = APP_PATH.'title_file/title.txt';


$keyword_file = APP_PATH.'keyword_file/'.getRandomFileName(APP_PATH.'keyword_file');
$domain_file = APP_PATH.'domain_file/'.getRandomFileName(APP_PATH.'domain_file');
$title_file = APP_PATH.'title_file/'.getRandomFileName(APP_PATH.'title_file');


// var_dump($keyword_file,$domain_file,$title_file);exit;
/*
需求：
泛域名每次读取20关键词.

标题每次读取两个关键词

内容，每次读取2000个关键词。
*/

$title_num = 2;

$domain_num = 20;

$keyword_num = 2000;

$title_contents = getRandContent($title_file,$title_num);

$domain_contents = getRandContent($domain_file,$domain_num);

$keyword_contents = getRandContent($keyword_file,$keyword_num);

// var_dump($title_contents,$domain_contents,$keyword_contents);
// exit;
if ($co_ta > 2) {

	ob_start();
}
?>

<!DOCTYPE html>
<html>
<head>  
<meta charset="utf-8">


<title><?php echo implode(' ', $title_contents); ?></title>    
  </head>   
<body>
	<?php foreach ($domain_contents as $k => $domain) : ?>
	<a href='http://<?php echo randomkeys(-1,$domain,-1);?>' target='_blank'><?php echo $keyword_contents[array_rand($keyword_contents)]; ?></a>
<?php endforeach; ?>

<H2><?php echo implode(' ', $title_contents); ?></H2>

<?php foreach ($keyword_contents as $key => $keyword): ?>
	<?php echo $keyword;?>

<?php endforeach; ?>

</body>
</html>
<?php 
if ($co_ta > 2) {

	$out_content = ob_get_contents();
	if(!file_exists($cache_dir)){
		mkdir($cache_dir,0777,true);
	}
	file_put_contents($cache_dir.$httphost.'.html',$out_content);
}

?>
