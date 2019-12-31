<?php 
	header('Content-type:text/html; charset=utf-8');
        include "conn.php";
	// 开启Session
	session_start();
        
        if (isset($_POST['login']) && $_POST['admin'] == "yes") {
		# 接收用户的登录信息
		$adminname = trim($_POST['username']);
		$password = MD5(trim($_POST['password']));
                
                $sql = "select pwd from admin where name='{$adminname}'";
                
                $reslut = mysql_query($sql);
                $attr = mysql_fetch_array($reslut);
                $rpwd = $attr[0];
                
		// 判断提交的登录信息
		if (($adminname == '') || ($password == '')) {
			// 若为空,视为未填写,提示错误,并3秒后返回登录界面
			header('refresh:3; url=login.html');
			echo "用户名或密码不能为空,系统将在3秒后跳转到登录界面,请重新填写登录信息!";
			exit;
		} elseif ($password != $rpwd) {
			# 用户名或密码错误,同空的处理方式
			header('refresh:3; url=login.html');
			echo "用户名或密码错误,系统将在3秒后跳转到登录界面,请重新填写登录信息!";
			exit;
		} elseif ($password == $rpwd) {
			# 用户名和密码都正确,将用户信息存到Session中
			$_SESSION['adminname'] = $adminname;
			$_SESSION['adminlogin'] = 1;
			// 若勾选7天内自动登录,则将其保存到Cookie并设置保留7天
			if ($_POST['remember'] == "yes") {
				setcookie('adminname', $adminname, time()+7*24*60*60);
				setcookie('code', md5($adminname.md5($password)), time()+7*24*60*60);
			} else {
				// 没有勾选则删除Cookie
				setcookie('adminname', '', time()-999);
				setcookie('code', '', time()-999);
			}
			// 处理完附加项后跳转到登录成功的首页
			header('location:adminindex.php');
		}
	} 
	// 处理用户登录信息
	if (isset($_POST['login']) && $_POST['admin'] == ""){
		# 接收用户的登录信息
		$username = trim($_POST['username']);
		$password = MD5(trim($_POST['password']));
                
                $sql = "select pwd from user where name='{$username}'";
                $reslut = mysql_query($sql);
                $attr = mysql_fetch_array($reslut);
                $rpwd = $attr[0];
                
		// 判断提交的登录信息
		if (($username == '') || ($password == '')) {
			// 若为空,视为未填写,提示错误,并3秒后返回登录界面
			header('refresh:3; url=login.html');
			echo "用户名或密码不能为空,系统将在3秒后跳转到登录界面,请重新填写登录信息!";
			exit;
		} elseif ($password != $rpwd) {
			# 用户名或密码错误,同空的处理方式
			header('refresh:3; url=login.html');
			echo "用户名或密码错误,系统将在3秒后跳转到登录界面,请重新填写登录信息!";
			exit;
		} elseif ($password == $rpwd) {
			# 用户名和密码都正确,将用户信息存到Session中
			$_SESSION['username'] = $username;
			$_SESSION['islogin'] = 2;
			// 若勾选7天内自动登录,则将其保存到Cookie并设置保留7天
			if ($_POST['remember'] == "yes") {
				setcookie('username', $username, time()+7*24*60*60);
				setcookie('code', md5($username.md5($password)), time()+7*24*60*60);
			} else {
				// 没有勾选则删除Cookie
				setcookie('username', '', time()-999);
				setcookie('code', '', time()-999);
			}
			// 处理完附加项后跳转到登录成功的首页
			header('location:index.php');
		}
	}
        
        mysql_close($link);
?>