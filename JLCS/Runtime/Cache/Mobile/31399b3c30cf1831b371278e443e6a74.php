<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>中国帝宫-详情</title>
		<link href="/Public/static/css/style.css" rel="stylesheet">
		<link href="/Public/static/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
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
			<img src="/Public/static/images/news1.jpg">
		</section>
		<!--公司新闻 -->
		<section class="news1">
			<div class="container">
				<div class="row">
					<div class="page clearfix">
						<div class="title1">
							<h2>莲位展示</h2>
							<span>Lotus Position Display</span>
							<div class="curre">您当前位置：
								<a href="<?php echo U('index');?>">首页</a> >
								<a href="<?php echo U('xuanwei',array('temple'=>$productinfo['templeid']));?>"><?php echo ($productinfo["temple"]); ?></a> >
								<a href="<?php echo U('region');?>"><?php echo ($productinfo["region"]); ?></a>
							</div>
						</div>
					</div>
					<div class="news_top">
						<div class="news_div col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<a href="javascript:void(0);"><img src="/Public/static/images/news7.jpg" /></a>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<h3><a href="<?php echo U('region');?>"><?php echo ($productinfo["region"]); ?></a></h3>
								<p><?php echo ($productinfo["palace"]); ?>-><?php echo ($productinfo["productname"]); ?></p>
							</div>
						</div>
						<div class="news_div col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<p>最初原价：<s>￥<?php echo ($productinfo["old_price"]); ?></s></p>
							</div>
						</div>
						
						<div class="news_div col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<p>结善缘价：<span style="color: red;">￥<?php echo ($productinfo["now_price"]); ?></span></p>
							</div>
						</div>
						<div class="news_div col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<p>佛像尺寸：<span>270*270*350mm</span></p>
							</div>
						</div>
						<div class="news_div col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<p>佛位尺寸：<span><?php echo ($productinfo["size"]); ?></span></p>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<a href="javascript:void(0);"><img src="/Public/static/images/xiangqing.png" /></a>
						</div>
						
					</div>
				</div>
			</div>
		</section>
		<!--联系我们-->
		<footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div style="padding-bottom: 50px;" class="container-fluid">
				<div class="row">
				<div class="footera-article">
					<div class="footera-sa"><span class="top">＜</span></div>
					<div class="footera-sm">
						
						</div>
						<div class="footera-sg">
								<div class="renjuan" value="<?php echo ($productinfo["productid"]); ?>">
									<a href="<?php echo U('order',array('id'=>$productinfo['productid']));?>" onclick="return confirm('是否删除此节点？');" >立即认捐</a>
								</div>
						</div>
				</div>
			 </div>
		  </div>
		</footer>
		<script src="/Public/static/js/jquery-3.1.1.min.js"></script>
		<script src="/Public/static/js/main.js"></script>
		<script src="/Public/static/js/bootstrap.min.js"></script>
	</body>
	<script type="text/javascript">
		function confirm(){
			var url = '/index.php/Mobile/Personal/islogin';
			var id = $(".renjuan").attr('value');
			$.post(url,{id:id},function(data){
				if(data == 'b'){
					alert('未登录,请前去登录');
					window.location.href = "/index.php/Mobile/Personal/login?id="+id;
				}else{
					window.location.href = "/index.php/Mobile/Index/order?id="+id;
				}
			})
			return false;
		}
	</script>

</html>