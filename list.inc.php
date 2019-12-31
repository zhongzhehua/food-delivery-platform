<link href="./list_files/bootstrap.min.css" rel="stylesheet">
<link href="./list_files/dashboard.css" rel="stylesheet">
<div class="table-responsive">
<table class="table table-striped table-sm">
	<tr align="left" bgcolor="#cccccc">
		<th>ID</th><th>名称</th> <th>价格</th> <th>说明</th>  <th>图片</th> <th>操作</th>
	</tr>
	<?php
		include "conn.php";                              	//包含数据库连接文件，连接数据库
		include "page.class.php";                               //包含分页类文件，加数据分页功能
		
		$sql = "SELECT count(*) FROM caidan ";           //按条件获取数据表记录总数  
		$result = mysql_query($sql);
		list($total) = mysql_fetch_row($result);
		
		$page = new Page($total, 10, $param);                   //创建分页类对象
		/* 编写查询语句，使用$where组合查询条件， 使用$page->limit获取LIMIT从句,限制数据条数 */
		$sql = "SELECT id, name, price, ps, pic FROM caidan ORDER BY id ASC {$page->limit}";
		/* 执行查询的SQL语句 */
		$result = mysql_query($sql);
		/*处理结果集，打印数据记录 */
		if($result && mysql_num_rows($result) > 0 ) {
			$i = 0;
			/* 循环数据，将数据表每行数据对应的列转为变量 */
			while(list($id, $name, $price, $ps, $pic) = mysql_fetch_row($result)) {
				if($i++%2==0)
					echo '<tr bgcolor="#eeeeee">';
				else 
					echo '<tr>';
				echo '<td>'.$id.'</td>';
				echo '<td>'.$name.'</td>';
				echo '<td>￥'.number_format($price, 2, '.', ' ').'</td>';
				echo '<td>'.$ps.'</td>';
                                echo '<td>'.$pic.'</td>';
				echo '<td><a href="adminindex.php?action=mod&id='.$id.'">修改</a>/<a onclick="return confirm(\'你确定要删除该菜品'.$name.'吗?\')" href="adminindex.php?action=del&id='.$id.'&pic='.$pic.'">删除</a></td>';
				echo '</tr>';
			}
			echo '<tr><td colspan="6">'.$page->fpage().'</td></tr>';
		}else {
			echo '<tr><td colspan="6" align="center">没有菜单被找到</td></tr>';
		}
		
		mysql_free_result($result);                            //释放结果集
		mysql_close($link);                                    //关闭数据库连接
	?>
<table>
</div>