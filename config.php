<?php 
	header('Content-type:text/html;charset=utf-8');
	session_start();
	
	//数据库连接信息
	$servername='localhost';
	$username="";
	$password="";

	try {
	$conn=new PDO("mysql:host=$servername;dbname=",$username,$password);//数据库名称

	//设置PDO错误模式为抛出 exceptions 异常
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	} catch (PDOException $e) {
	echo "<br>"."错误提示：".$e->getMessage();
	}

	//用户判断用户是否登录，以及其是否具有访问权限
	define('', "");//定义密码附加值差量
	function permission($username,$shell,$permission){
		global $conn;
		$sql="SELECT * FROM MEMBER WHERE username ='$username'";
		$query = $conn->query($sql);
		$row = $query->fetch();
		//判断登录后定义的密钥是否跟用户的密钥一致
		if (strcmp($shell, md5($row['username'].$row['password'].密码常量（define值）))=='0') {//填写密码常量值
			if ($row['permission']<=$permission) {//对比页面查看权限跟用户权限
				return $row;
			} else {
				echo "你的权限不足,不能查看本页面";
				$conn=null;
				echo "<br><input type='button' onclick='javascript:window.history.back()' value='后退'>";
				exit();
			}
			
		} else {
			echo "登录异常，请重新<a href='./login.php'>登录</a>";
			$conn=null;
			exit();
		}
	}

	// 查看会员登录是否超时
	function judge_time ($online_time)
	{
		$now_time = time();
		if ($now_time-$online_time>'5') {
			session_destroy();
			echo "登录超时,请重新登录";
			$conn=null;
			header("refresh:3;url=./login.php");
			exit();
		} else {
			$_SESSION['active_time']=time();
			$conn=null;
		}
	}


 ?>
