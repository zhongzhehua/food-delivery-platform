<?php 
	header('Content-type:text/html; charset=utf-8');
	// 开启Session
	session_start();
 
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_COOKIE['adminname'])) {
		# 若记住了用户信息,则直接传给Session
		$_SESSION['adminname'] = $_COOKIE['adminname'];
		$_SESSION['adminlogin'] = 1;
	}
	if (isset($_SESSION['adminlogin']) == 1) {
		// 若已经登录
?>
<html>
	<head>
		<title>外卖菜单管理</title>
                <link rel="icon" href="https://img.25pp.com/uploadfile/app/icon/20180907/1536286250809517.jpg">
                
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
                    <link href="./index_files/bootstrap.min.css" rel="stylesheet">
                    <link href="./index_files/album.css" rel="stylesheet">
                        <div class="navbar navbar-dark bg-dark box-shadow">
                        <div class="container d-flex justify-content-between">         
                        <?php
                                echo '<strong style="color:#fff;"><font size="3">你好! '.$_SESSION['adminname'].'&emsp; </font></strong>';
                                echo "<h4><strong style=color:white>外卖菜单管理</strong></h4>";
                                echo '<a href="logout.php"><font size="3">注销</font></a>';
                        ?>        
                        </div>
                </div>
	<head>
	<body>
                        <p>
                        <div align='center'>
                                <a class="btn btn-primary my-2" href="adminindex.php?action=list">菜单列表</a> || 
                                <a class="btn btn-secondary my-2" href="adminindex.php?action=add">添加新菜</a><hr>
                                </div>
                        </p>
                        
			<?php
				/* 包含自定义的函数库文件 */
				include "func.inc.php";
				if($_GET["action"] == "add") 
                                {/* 如果用户的操作是请求添加商品表单action=add，则条件成立 */
					include "add.inc.php";/* 包含add.inc.php获取用户添加表单 */
				}
                                else if ($_GET["action"] == "insert") 
                                {/* 如果用户提交添加表单action=insert，则条件成立 */
                                
					/* 使用func.inc.php文件中声明的 upload()函数处理图片上传 */
					$up = upload();
					/* 如果返回值$up中的第一个元素是false说明上传失败，报告错误原因并退出程序 */
					if(!$up[0]) 
						die($up[1]);
					
					/* 添加数据需要先连接并选数据库，包含conn.php文件连接数据库 */
					include "conn.php";
					
					/* 根据用户通过POST提交的数据组合插入数据库的SQL语句 */
					$sql = "INSERT INTO caidan(name, price, pic, ps) VALUES('{$_POST["name"]}', '{$_POST["price"]}', '{$up[1]}', '{$_POST["ps"]}')";
					/* 执行INSERT语句 */
					$result = mysql_query($sql);
					/* 如果INSERT语句执行成功，并对数据表books有行数影响，则插入数据成功 */
					if($result && mysql_affected_rows() > 0 ) {
						echo "插入一条数据成功!";
                                                header('refresh:1; url=adminindex.php');
					}else {
						echo "数据录入失败!";
					}
					/* 用完后关闭数据库的连接 */
					mysql_close($link);
				
				} 
                                else if($_GET["action"] == "mod") /* 如果用户请求一个修改表单action=mod, 则条件成立 */
                                { 
					include "mod.inc.php";/* 包含文件mod.inc.php获取一个修改表单 */
				} 
                                else if($_GET["action"] == "update") 
                                {
					/* 如果用户需要修改图片，用新上传的图片替换原来的图片 */
					if($_FILES["pic"]["error"] == "0"){
						$up = upload();
						/* 如果有新上传的图片，就使用上传图片名修改数据库 */
						if($up[0])  
							$pic = $up[1];
						else 
							die($up[1]);
								
					} else {
						/* 如果没有上传图片，还是使用原来图片 */
						$pic = $_POST["picname"];
					}
					/* 修改数据需要先连接并选数据库，包含conn.php文件连接数据库 */
					include "conn.php";
					
					/* 根据修改表单提交的POST数据组合一个UPDATE语句 */
					$sql = "UPDATE caidan SET name='{$_POST["name"]}',  price='{$_POST["price"]}',pic='{$pic}', ps='{$_POST["ps"]}' WHERE id='{$_POST["id"]}'";
		
					/* 执行UPDATE语句 */
					$result = mysql_query($sql);
					
					/* 如果语句执行成功，并对记录行有所影响，则表示修改成功 */
					if($result && mysql_affected_rows() > 0 ) {
						if($up[0]) 
							delpic($_POST["picname"]);/* 修改新图片成功后，将原来的图片要删除掉，以免占用磁盘空间 */
						echo "记录修改成功!";
                                                header('refresh:1; url=adminindex.php');
					}else {
						echo "数据修改失败!";
					}
					mysql_close($link);
				} 
                                else if($_GET["action"] == "del") /* 如果用户请求删除一个商品action=del, 则条件成立 */
                                {				
					include "conn.php";
					$result = mysql_query("DELETE FROM caidan WHERE id = '{$_GET["id"]}'");
					if($result && mysql_affected_rows() > 0 ) {	
						delpic($_GET["pic"]);/*删除记录成功后，也要将图书的图片一起删除 */
						echo '<script>window.location="'.$_SERVER["HTTP_REFERER"].'"</script>';/* 删除记录后跳转回到原来的URL */
					}else {
						echo "数据删除失败!";
					}
					mysql_close($link);
				} 
                                else
                                {
					include "list.inc.php";
				}
			?>
	</body>
</html>
<?php        
	} else {
		// 若没有登录
		echo "您还没有登录,请<a href='login.html'>登录</a>";
	}

?>