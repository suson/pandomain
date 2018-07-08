<?php
require_once 'common.inc.php';

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
?>


<head>  
<meta charset="utf-8">
<?php foreach ($domain_contents as $k => $domain) : ?>
	<a href='http://<?php echo randomkeys(-1,$domain,-1);?>' target='_blank'><?php echo $keyword_contents[array_rand($keyword_contents)]; ?></a>
<?php endforeach; ?>

<title><?php echo implode(' ', $title_contents); ?></title>    
  </head>   
<body>
<H2><?php echo implode(' ', $title_contents); ?></H2>

<?php foreach ($keyword_contents as $key => $keyword): ?>
	<?php echo $keyword;?>

<?php endforeach; ?>

</body>
</html>

</div>
    		
