<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>中国帝宫-选殿</title>
		<link href="/Public/static/css/style.css" rel="stylesheet">
		<link href="/Public/static/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <link href="static/css/IE8.css" rel="stylesheet">
        <![endif]-->
	</head>

	<body>

		<!--头部-->
		<header>
			<!--导航-->
			<nav class="nav_top">
				<div class="container">
					<div class="navbar-header">
						<div class="fanhui"><a href="javascript:history.go(-1)"><img src="/Public/static/images/fanhui.png"/></a></div>
						<button class="navbar-toggle collapsed mean" data-toggle="collapse" data-target="#mynavbar">                     
		                      <span class="icon-bar"></span>
		                      <span class="icon-bar"></span>
		                      <span class="icon-bar"></span>
		                 </button>
						<a href="<?php echo U('Index/index');?>" class="navbar-brand logo"><img src="/Public/static/images/logo.png"></a>
					</div>
					<div id="mynavbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav nav_li navbar-right">
							<li>
								<a href="<?php echo U('Index/index');?>">首页</a>
							</li>
							<li>
								<a href="<?php echo U('Index/smgf');?>">寺庙供奉</a>
							</li>
							<li>
								<a href="<?php echo U('Index/smgh');?>">生命关怀</a>
							</li>
							<li>
								<a href="<?php echo U('Index/fjzh');?>">佛教智慧</a>
							</li>
							<li>
								<a href="<?php echo U('Personal/index');?>">个人中心</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<!--幻灯片-->
		<section class="banner">
		   <img src="/Public/static/images/news.jpg">	
		</section>
        <div class="product">
			<div class="container">
				<div class="row">
					<div class="page clearfix">
						<div class="title1">
							<h2>认捐位置</h2>
							<span>Pledging Position</span>
							<div class="curre">您当前位置：
								<a href="#"><?php echo ($temple_select["temple"]); ?></a> >								
							</div>
						</div>
						<ul class="sub-list sub_lists">
							<?php if(is_array($region_select)): foreach($region_select as $key=>$list): ?><li class="active">
									<div class="xqtpq">
										<?php if(($list["id"] == 1)): ?><img src="/Public/static/images/timg.jpg">
											<?php else: ?>
											<img src="/Public/static/images/huangjia.png"><?php endif; ?>
						            </div>
									<a href="<?php echo U('region',array('id'=>$list['id']));?>"><?php echo ($list["region"]); ?></a>
								</li><?php endforeach; endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		

	   <!--联系我们-->
		<footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="container-fluid">
				<div class="row">
				<div class="footera-article">
					<div class="footera-sa"><span class="top">＜</span></div>
					<div class="footera-sm">
						<ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<li>
									<a href="<?php echo U('Index/index');?>">首页</a>
								</li>
								<li>
									<a href="<?php echo U('Index/smgf');?>">寺庙供奉</a>
								</li>
								
								<li>
									<a href="<?php echo U('Index/smgh');?>">生命关怀</a>
								</li>

								<li>
									<a href="<?php echo U('Index/fjzh');?>">佛教智慧</a>
								</li>
								<li>
								    <a href="<?php echo U('Personal/index');?>">个人中心</a>
							    </li>

							</ul>
						</div>
						<div class="footera-sg">
							<p class="footera-sgp">公司名称：通则久&nbsp;&nbsp;&nbsp;联系电话：0519-8324-7330&nbsp;&nbsp;&nbsp;地址：江苏省常州市新北区九龙路98号</p>
							<p class="footera_p">@2017-2027 通则久&nbsp;&nbsp;苏ICP证000000号 苏公网备111012066666611号</p>
						</div>
				</div>
			 </div>
		  </div>
		</footer>
		<script src="/Public/static/js/jquery-3.1.1.min.js"></script>
		<script src="/Public/static/js/main.js"></script>
		<script src="/Public/static/js/bootstrap.min.js"></script>
		<script>
			$(function() {
				$(".sub_lists li").click(function() {
					$(this).siblings().removeClass('active');
					$(this).addClass('active');
					$('.lists ul').removeClass('show');
					$('.lists ul').eq($(this).index()).addClass('show');
				})

			});
		</script>
	</body>

</html>