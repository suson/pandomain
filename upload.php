<?php
require_once 'common.inc.php';
// var_dump($_POST);
var_dump($_FILES);
$err = array();
if (!empty($_FILES['keyword_file']['tmp_name'])) {
	$upload = new \Dj\Upload('keyword_file');
	$filelist = $upload->save('./keyword_file');
	if(is_array($filelist)){
	    # 返回数组，文件就上传成功了
	    var_dump($filelist);
	}else{
	    # 如果返回负整数(int)就是发生错误了
	    $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
	    $arr[] = '关键词文件：'.$error_msg[$filelist];
	}
	// header('location:upload.php');
}

if (!empty($_FILES['domain_file']['tmp_name'])) {
	$upload = new \Dj\Upload('domain_file');
	$filelist = $upload->save('./domain_file');
	if(is_array($filelist)){
	    # 返回数组，文件就上传成功了
	    var_dump($filelist);
	}else{
	    # 如果返回负整数(int)就是发生错误了
	    $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
	    $arr[] = '域名文件：'.$error_msg[$filelist];
	}
	// header('location:upload.php');
}

if (!empty($_FILES['title_file']['tmp_name'])) {
	$upload = new \Dj\Upload('title_file');
	$filelist = $upload->save('./title_file');
	if(is_array($filelist)){
	    # 返回数组，文件就上传成功了
	    var_dump($filelist);
	}else{
	    # 如果返回负整数(int)就是发生错误了
	    $error_msg = [-1=>'上传失败',-2=>'文件存储路径不合法',-3=>'上传非法格式文件',-4=>'文件大小不合符规定',-5=>'token验证错误'];
	    $arr[] = '标题文件：'.$error_msg[$filelist];
	}
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
		        <input type="file" name="keyword_file"/>
		    <p></p>
		    <span>域名文件</span>
		        <input type="file" name="domain_file"/>
		    <p></p>
		    <span>标题文件</span>
		    <input type="file" name="title_file"/>
		    <p></p>
		    <input type="submit" value="上传"/>
	    </form>
	</div>
	<!-- 本地单文件上传 End-->
</body>
</html>
