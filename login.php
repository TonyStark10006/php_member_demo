<?php 
	require_once ("./config.php");
	require_once ("./fliter.php");
	$tips_user=$tips_password=$un=$pw=$tips="";
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		if (empty($_POST['username'])) {
			$tips_user="用户名不能为空<br>";
		} else {
			$un=test_input($_POST['username']);
		}
		
		if (empty($_POST['password'])) {
			$tips_password="密码不能为空<br>";
		} else {
			$pw=md5(test_input($_POST['password'].密码常量));
		}

		if (empty($un)||empty($pw)) {
			$tips="登录失败，请检查输入内容后重新登录";
		} else {
			$sql_login="SELECT * FROM MEMBER WHERE username='$un'";
			$query=$conn->query($sql_login);
			$result = $query->setFetchMode(PDO::FETCH_ASSOC); 
			$row=$query->fetch();
			if ($row=='0') {
				$tips="用户不存在";
			} else {
	    		if (strcmp($row['password'],$pw)=='0') {
	    		$_SESSION['user_id']=$row['user_id'];//登录成功后写入session的信息
	    		$tips= "登录成功，3秒后跳转主页";
	    		header("refresh:3;url=./index.php");
		    	} else {
		    	$tips= "密码错误，请重新输入";
		    	session_destroy();
		    	}
			}
		}				
	} else {
		echo "登录异常";
		exit();
	}

 ?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link rel="shortcut icon" href="./imgsrc/icon.ico">
	<style type="text/css">
		#container {height: 200px;width: 400px; position: absolute;left: 50%;top: 50%;margin-left: -200px;margin-top: -100px;}
		#logo {height: 200px;width: 178px;float: left;text-align: center;line-height: 140px;}
		#division {background-color: grey; height: 120px; width: 1px;float: left;}
		#login-window {margin-left :20px;height: 200px;width: 200px;float: left;display: block;}
		#tips {color: red;}
	</style>
</head>
<body>
<div id="container">
	<div id="logo">
		<img src=""><!-- logo图，左右结构 -->
	</div>

	<div id="division"></div>

	<div id="login-window">
	  	<form method="POST" action="">
	 		<label>用户名</label><br>
	 		<input type="text" name="username" id="username">
	 		<br>
	 		<label>密码</label><br>
	 		<input type="password" name="password">
	 		<br>
	 		<input type="submit" name="" value="登录">
	 		<br>
	 		<span id="tips"><?php echo $tips_user.$tips_password.$tips;?></span>
	 	</form>
	 </div>
 </div>
	
<script type="text/javascript">
	document.getElementById("username").focus();
</script>
</body>
</html>
<?php $conn=null;exit();?>