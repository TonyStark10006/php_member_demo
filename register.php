<?php 
	require_once ("./config.php");
	require_once ("./fliter.php");
	$un=$pw=$tel=$user_permission="";
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		if (empty($_POST['username'])) {
			echo "用户名不能为空<br>";
		} else {
			$un=test_input($_POST['username']);
		}
		
		if (empty($_POST['password'])) {
			echo "密码不能为空<br>";
		} else {
			if (test_input($_POST['password'])<=5) {
				echo "密码不能小于6位数<br>";
			} else {
				$pw=md5(test_input($_POST['password'].密码常量));
			}
		}

		if (empty($_POST['tel'])) {
			echo "电话不能为空<br>";
		} else {
			$tel=test_input($_POST['tel']);
		}

		if (empty($_POST['user_group'])) {
			echo "用户组别不能为空<br>";
		} else {
			$user_group=test_input($_POST['user_group']);
		}

		if (empty($un)||empty($pw)||empty($tel)) {
			echo "注册失败，请重新注册";
		} else {
			$sql_query_user="SELECT * FROM MEMBER WHERE USERNAME='$un'";
			$query_user_exist=$conn->query($sql_query_user);
			if ($query_user_exist->fetchColumn()>'0') {
				echo "用户已存在，请重新输入用户名";
				header("refresh:3;url=./register.php");
				echo "<br>3秒后将自动跳转注册页面";
			} else {
				//设定用户组的权限
				switch ($user_group) {
					case '营销组':
						$user_permission='2';
						break;
					
					default:
						$user_permission='3';
						break;
				}

				$sql_reg="INSERT INTO MEMBER (USERNAME,PASSWORD,PERMISSION,TEL,USER_GROUP) VALUES ('$un','$pw','$user_permission','$tel','$user_group')";
				$query=$conn->exec($sql_reg);
				if ($query>'0') {
					echo "注册成功";
				} else {
					echo "注册失败，请重新注册";
					$conn=null;
				}
			}
		}			
	} else {
		//echo "注册失败"; 
	}
 ?>

 <!DOCTYPE html>
 <html lang="zh">
 <head>
 	<meta charset="UTF-8">
 	<link rel="shortcut icon" href="./imgsrc/icon.ico">
 	<title>注册</title>
 </head>
 <body>
 	<form method="POST" action="">
 		<label>用户名：</label>
 		<input type="text" name="username">
 		<br>
 		<label>密码：</label>
 		<input id="password" type="password" name="password" onchange="checkPW(this)">
 		<br>
 		<label>电话：</label>
 		<input type="text" name="tel" maxlength="15">
 		<br>
 		<label>用户组别：</label>
 		<select name="user_group" id="">
			<option value="营销组">营销组</option>
		</select>
 		<br>
 		<input type="submit" name="" value="注册">
 	</form>
 	<span id="tips" style="color: red;"></span>
 <script type="text/javascript">
 function checkPW(){
	var str=document.getElementById('password').value;
	if(str.length<=5){
		document.getElementById("tips").innerHTML="密码不能小于6位";
		return false;
	}
	else {
		document.getElementById("tips").innerHTML="";
		return true;
	}
}
 </script>
 </body>
 </html><?php $conn=null;exit(); ?>