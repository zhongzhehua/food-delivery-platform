<?php 
	/** file: mod.inc.php 菜品修改表单 */ 
	include "conn.php";
	/* 通过ID查找指定的一行记录 */
	$sql = "SELECT id, name, price, ps, pic FROM caidan WHERE id='{$_GET["id"]}'";
	$result = mysql_query($sql);
	
	if($result && mysql_num_rows($result) > 0) {
		list($id, $name, $price, $ps, $pic) = mysql_fetch_row($result);
	}else {
		die("没有找到需要修改的菜品");
	}
	mysql_free_result($result);           //释放结果集
	mysql_close($link);                   //关闭数据库的连接
?>
<form enctype="multipart/form-data" action="adminindex.php?action=update" method="POST">
        <fieldset>
                <legend>修改商品</legend>
                <div align="center">
                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                        名称：<input type="text" name="name" value="<?php echo $name ?>" />
                        <br><br>
                        
                        价格：<input type="text" name="price" value="<?php echo $price ?>" />
                        <br><br>
                        
                        说明：<textarea name="ps" cols="30" rows="5"><?php echo $ps ?></textarea>
                        <br><br>
                        
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><br>
                        <img src="./uploads/icon_<?php echo $pic ?>"><br>
                        <input type="hidden" name="picname" value="<?php echo $pic ?>" />
                        图片：<input type="file" name="pic" value="" />
                        <br><br>
                        
                        <input type="submit" name="add" value="修改商品" />
                        <br><br>
                </div>
        </fieldset>
</form>