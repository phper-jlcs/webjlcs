<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>中国帝宫</title>
		<link href="/Public/static/css/owl.carousel.css" rel="stylesheet">
		<link href="/Public/static/css/owl.theme.css" rel="stylesheet">
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
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner silder-top" role="listbox">
				<div class="item active">
					<img src="/Public/static/images/banner1.jpg">
					<div class="carousel-caption">
					</div>
				</div>
				<div class="item">
					<img src="/Public/static/images/banner2.jpg">
					<div class="carousel-caption">
					</div>
				</div>
				<div class="item">
					<img src="/Public/static/images/banner3.jpg">
					<div class="carousel-caption">
					</div>
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>

			</a>
		</div>


		<div class="series">
			<div class="container">
				<div class="row">
					<div class="title">
						<h2>
							<i></i>
							认捐禅寺
							<i></i>
						</h2>
						<span>For The Temple</span>
					</div>
					
					<ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<a href="<?php echo U('xuanwei',array('temple'=>1));?>"><img src="/Public/static/images/xl1.png">
							<img src="/Public/static/images/sousu.png" class="sosu"></a>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<a href="<?php echo U('xuanwei',array('temple'=>2));?>"><img src="/Public/static/images/xl2.png">
							<img src="/Public/static/images/sousu.png" class="sosu"></a>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<a href="<?php echo U('xuanwei',array('temple'=>3));?>"><img src="/Public/static/images/xl3.png">
							<img src="/Public/static/images/sousu.png" class="sosu"></a>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<a href="<?php echo U('xuanwei',array('temple'=>4));?>"><img src="/Public/static/images/xl4.png">
							<img src="/Public/static/images/sousu.png" class="sosu"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>



		<div class="series">
			<div class="container">
				<div class="row">
					<div class="title">
						<h2>
							<i></i>
							九龙风光
							<i></i>
						</h2>
						<span>Video reading</span>
					</div>

					<div style="width: 400px;height: 200px; position: relative;
            top:0px;
            left:0px;">
						<video controls width="400" poster="/Public/images/jlcs.jpg">
							<source src="/Public/images/sp.mp4" />
						</video>
					</div>

				</div>
			</div>
		</div>
		<div class="series">
			<div class="container">
				<div class="row">
					<div class="title">
						<h2>
							<i></i>
							镇海风光
							<i></i>
						</h2>
						<span>Video reading</span>
					</div>

					<div style="width: 400px;height: 200px; position: relative;
            top:0px;
            left:0px;">
						<video controls width="400" poster="/Public/images/zhs.jpg">
							<source src="/Public/images/zhs.mp4" />
						</video>
					</div>

				</div>
			</div>
		</div>

		<!--产品展示-->
		<!--<div class="gallery">
			<div class="container">
				<div class="title">
					<h2>
							<i></i>
							莲位详情
							<i></i>
						</h2>
					<span>Buddha Statue Display</span>
				</div>
				<div class="gal-btm">
					<div class="col-md-6 gal-gd-sec">						
							<figure>
								<img src="/Public/static/images/details/01.jpg" class="img-responsive" alt="">

							</figure>						
					</div>
					<div class="col-md-6 gal-gd-sec">						
							<figure>
								<img src="/Public/static/images/details/02.jpg" class="img-responsive" alt="">

							</figure>						
					</div>
					<div class="col-md-4 gal-gd ">						
							<figure>
								<img src="/Public/static/images/details/03.jpg" class="img-responsive" alt="">

							</figure>						
					</div>
					<div class="col-md-4 gal-gd ">				
							<figure>
								<img src="/Public/static/images/details/04.jpg" class="img-responsive" alt="">

							</figure>					
					</div>
					<div class="col-md-4 gal-gd ">					
							<figure>
								<img src="/Public/static/images/details/05.jpg" class="img-responsive" alt="">

							</figure>				
					</div>
					<div class="col-md-6 gal-gd-sec ">				
							<figure>
								<img src="/Public/static/images/details/06.jpg" class="img-responsive" alt="">

							</figure>					
					</div>
					<div class="col-md-6 gal-gd-sec ">					
							<figure>
								<img src="/Public/static/images/details/07.jpg" class="img-responsive" alt="">

							</figure>				
					</div>

					<div class="clearfix"></div>
				</div>
			</div>
		</div>-->
		
		<!--热销产品-->
		<div class="news">
			<div class="container">
				<div class="row">
					<div class="title">
						<h2>
							<i></i>
							  莲位展示
							<i></i>
						</h2>
						<span>Lotus Position Display</span>
					</div>
					<div id="demo">
						<div class="span12">
							<div id="owl-demo" class="owl-carousel">
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx1.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx2.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx3.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx4.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx5.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx6.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx7.jpg">
									<a href="#">莲位</a>
								</div>
								<div class="item rx">
									<img class="lazyOwl" data-src="/Public/static/images/rx8.jpg">
									<a href="#">莲位</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!--探险-->
		<div class="tanxian">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tanxian_top">
						<h1></h1>
						<span></span>
						<P></P>
					</div>
				</div>
			</div>
		</div>
		<!--新闻资讯-->
		<diV class="news">
			<div class="container">

				<div class="row">
					<div class="title">
						<h2>
							<i></i>
							 寺院风光
							<i></i>
						</h2>
						<span>Monastery Scenery</span>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<div id="news_slide" class="news_slide_box">
							<div class="bd">
								<ul>
									<li>
										<a class="pic" href="">
											<img src="/Public/static/images/news7.jpg" />
											<span class="title">
												人情文化
											</span>
										</a>
									</li>
									<li>
										<a class="pic" href="">
											<img src="/Public/static/images/news8.jpg" />
											<span class="title">
												宏伟宫殿
											</span>
										</a>
									</li>
									<li>
										<a class="pic" href="">
											<img src="/Public/static/images/news9.jpg" />
											<span class="title">
												优雅格局
											</span>
										</a>
									</li>
								</ul>
							</div>
							<span class="prev"></span>
							<span class="next"></span>
						</div>
					</div>

				</div>
			</div>
		</diV>
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
		<script src="/Public/static/js/owl.carousel.js"></script>
		<script src="/Public/static/js/TouchSlide.1.1.js"></script>
		<script>
			$(document).ready(function() {

				$("#owl-demo").owlCarousel({
					items: 4,
					lazyLoad: true,
					navigation: true,
					autoPlay: true
				});

			});
		</script>
		<script>
			TouchSlide({
				slideCell: "#slideBox",
				titCell: ".hd li",
				mainCell: ".bd ul",
				effect: "leftLoop"
				//				autoPlay:true//自动播放
			});
			TouchSlide({
				slideCell: "#news_slide",
				mainCell: ".bd ul",
				effect: "leftLoop",
				autoPlay: true //自动播放
			});
		</script>
	</body>

</html>