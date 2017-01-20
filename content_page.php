<?php 
	//导入会员验证配置文件
	require_once ("./config.php");
	require_once ("./fliter.php");
	require_once ("./fliter_judge_login.php");
	echo "<!DOCTYPE html>
		 <html lang="zh">
		 <head>
			<meta charset='UTF-8'>
			<title>测试页面</title>
			<style type='text/css'>
				
			</style>
		 </head>
		 <body>
			<p>我的天</p>
			<a href='./logout.php'>登出</a>
		 </body>
		 </html>";
 ?>