<?php 
	header('Content-type:text/html; charset=utf-8');
	// 注销后的操作

	session_start();
        if($_SESSION['username'] == null && $_SESSION['username'] == null)
                header('refresh:0; url=login.html');
        
	// 清除Session        
	$username = $_SESSION['username'];  //用于后面的提示信息
        $adminname = $_SESSION['adminname'];
	$_SESSION = array();
	session_destroy();
        
	// 清除Cookie
	setcookie('username', '', time()-99);
	setcookie('code', '', time()-99);
 
	// 提示信息
	echo "欢迎下次光临, ".$username.$adminname.'<br>';
	echo "<a href='login.html'>重新登录</a>";
 
?>