<?php 
	header('Content-type:text/html; charset=utf-8');
	// 开启Session
	session_start();
 
	// 首先判断Cookie是否有记住了用户信息
	if (isset($_COOKIE['username'])) {
		# 若记住了用户信息,则直接传给Session
		$_SESSION['username'] = $_COOKIE['username'];
		$_SESSION['islogin'] = 2;
	}
	if (isset($_SESSION['islogin']) == 2) {
?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://img.25pp.com/uploadfile/app/icon/20180907/1536286250809517.jpg">

    <title>外卖菜单</title>

    <!-- Bootstrap core CSS -->
    <link href="./index_files/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./index_files/album.css" rel="stylesheet">
  </head>

  <body>
        <a name="jumptop"></a>
    <header>
      
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a class="navbar-brand d-flex align-items-center">            
            <?php 
                echo '<strong style="color:#fff;">你好! '.$_SESSION['username'].',欢迎光临！</strong>';
                echo "<a href='logout.php'>注销</a>";
            ?>
          </a>          
        </div>
      </div>
      
    </header>

    <main role="main">
      <section class="jumbotron text-center">
      
        <div class="container">
          <h1 class="jumbotron-heading"><strong>ZUCC-PHP外卖菜单</strong></h1>
          <p class="lead text-muted">本外卖店名称为ZUCC-PHP，主要经营中国各大美食。在配料中融入独特的PHP特色，是程序员996用餐佳品。</p>
          <p>
            <a class="btn btn-primary my-2"> 点 赞 👍 </a>
            <a class="btn btn-secondary my-2"> 不 饿 👌 </a>
          </p>
        </div>
       
      </section>
      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
          <?php
          include "conn.php"; 
          $sql = "SELECT id, name, price, ps, pic FROM caidan";
          $result = mysql_query($sql);
          if($result && mysql_num_rows($result) > 0 ) 
          {
            while(list($id, $name, $price, $ps, $pic) = mysql_fetch_row($result)) 
            {          
                echo '
                    <div class="col-md-4">
                      <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="./uploads/'.$pic.'" data-holder-rendered="true">
                        <div class="card-body">
                          <h5>'.$name.'</h5>
                          <p class="card-text">'.$ps.'</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="return confirm(\'你确定要下单'.$name.'吗?\')">订购菜品</button>
                            </div>
                            <strong class="text-muted">￥'.number_format($price, 2, '.', ' ').'</strong>
                          </div>
                        </div>
                      </div>
                    </div>';           
            }
             }
              else {
               echo '<tr><td colspan="6" align="center">没有菜单被找到</td></tr>';
              }
           ?> 
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#jumptop">Back to top</a>
        </p>
        <p>ZUCC-PHP waimai web © zhongzhehua. if you like it, plesae give us a high grade!</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./index_files/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./index_files/popper.min.js"></script>
    <script src="./index_files/bootstrap.min.js"></script>
    <script src="./index_files/holder.min.js"></script>
    
<?php        
	} else {
		// 若没有登录
		echo "您还没有登录,请<a href='login.html'>登录</a>";
	}

?>    