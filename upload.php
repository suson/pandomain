<?php
require_once 'common.inc.php';
// var_dump($_POST);
// var_dump($_FILES);
$allow = array(
	'ext'=> array('txt')
);
    
$err = array();
if (!empty($_FILES['keyword_file']['tmp_name'])) {
	$upload = new \Dj\Upload('keyword_file');
	$upload->savename = 'keyword';
	$upload->use_source_name = 1;
	$filelist = $upload->save('./keyword_file',$allow);
	if(is_array($filelist)){
	    # 返回数组，文件就上传成功了
	    // var_dump($filelist);
	}else{
	    # 如果返回负整数(int)就是发生错误了
	    $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
	    $arr['keyword_file'] = '关键词文件：'.$error_msg[$filelist];
	}
	// header('location:upload.php');
}

if (!empty($_FILES['domain_file']['tmp_name'])) {
	$upload = new \Dj\Upload('domain_file');
	$upload->savename = 'domain';
	$upload->use_source_name = 1;
	$filelist = $upload->save('./domain_file',$allow);
	if(is_array($filelist)){
	    # 返回数组，文件就上传成功了
	    // var_dump($filelist);
	}else{
	    # 如果返回负整数(int)就是发生错误了
	    $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
	    $arr['domain_file'] = '域名文件：'.$error_msg[$filelist];
	}
	// header('location:upload.php');
}

if (!empty($_FILES['title_file']['tmp_name'])) {
	$upload = new \Dj\Upload('title_file');
	$upload->savename = 'title';
	$upload->use_source_name = 1;
	$filelist = $upload->save('./title_file',$allow);
	if(is_array($filelist)){
	    # 返回数组，文件就上传成功了
	    // var_dump($filelist);
	}else{
	    # 如果返回负整数(int)就是发生错误了
	    $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
	    $arr['title_file'] = '标题文件：'.$error_msg[$filelist];
	}
}

if (!empty($_FILES) && empty($arr)) {
	header('location:upload.php?success=1');
}

if (!empty($_GET['success'])) {
	$success = 1;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>文件上传</title>
</head>
<body>
	<!-- 本地单文件上传 Start-->
	<div>
	    <form action="upload.php" method="post" enctype="multipart/form-data">
		    <span>关键词文件</span>
		        <input type="file" name="keyword_file"/><span style="color:red"><?php if(!empty($arr['keyword_file'])) echo $arr['keyword_file']?></span>
		    <p></p>
		    <span>域名文件</span>
		        <input type="file" name="domain_file"/><span style="color:red"><?php if(!empty($arr['domain_file'])) echo $arr['domain_file']?></span>
		    <p></p>
		    <span>标题文件</span>
		    <input type="file" name="title_file"/><span style="color:red"><?php if(!empty($arr['title_file'])) echo $arr['title_file']?></span>
		    <p></p>
		    <input type="submit" value="上传"/>
	    </form>
	</div>
	<span><?php if(!empty($success)) echo '上传成功';?></span>
	<!-- 本地单文件上传 End-->
</body>
</html>
