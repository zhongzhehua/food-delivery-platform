<form enctype="multipart/form-data" action="adminindex.php?action=insert" method="POST">
        <fieldset>
                <legend>添加新菜</legend>
                <div align="center">
                        新菜名称：<input type="text" name="name" value="" />
                        <br><br>
                        
                        价&emsp;&emsp;格：<input type="text" name="price" value="" />
                        <br><br>
                        
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                        菜品图片：<input type="file"  name="pic" value="" style="width:180" />
                        <br><br>
                        
                        
                        说&emsp;&emsp;明：<textarea name="ps" cols="26" rows="5"></textarea><br>
                        <br><br>
                        
                        <input type="submit" name="add" value="添加新菜" />
                        <br><br>
                </div>
        </fieldset>
</form>