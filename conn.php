<?php
        /** file: conn.php 数据库连接文件 */
	/*连接本地的数据库*/
	$link = mysql_connect("localhost", "root", "root");
				
	if (!$link) {
		die('连接数据库失败: '.mysql_error());
	}
        
	/* 选择bookstore作为默认的数据库 */
	if(!mysql_select_db("waimai")) {
		die('数据库选择失败: '.mysql_error());
	}
?>