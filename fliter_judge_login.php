<?php 
	header('Content-type:text/html;charset=utf-8');
	//判断session中是否有登录信息，没有则提示登录
	if (isset($_SESSION['username'])&&$_SESSION['shell']&&$_SESSION['active_time']) {
			permission($_SESSION['username'],$_SESSION['shell'],3);//权限为“3”的用户才能查看本页面
			judge_time($_SESSION['active_time']);
	} else {
		$conn=null;
		header("location:login.php");
	 	exit();
	 }
 ?>