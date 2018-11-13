<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>镇海宝鉴</title>
		<link rel="stylesheet" href="/Public/zhcss/inform.css" />
		<link href="/Public/zhcss/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="/Public/zhcss/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="/Public/zhcss/lightbox.css">
		<script src="/Public/jljs/bootstrap.js"></script>
<link href="/Public/zhcss/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="/Public/jljs/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
	</head>
	<body>
		<div class="v">
		<div class="v0">
			<!--头部开始-->
			<div class="u1 clear">
				<div class="u6">

				</div>
			<ul>
				<li><a href="<?php echo U('Home/Index/index');?>">中国帝宫</a></li>
				<li><a href="<?php echo U('index');?>">镇海禅寺</a></li>
				<li><a href="<?php echo U('culture');?>">镇海文化</a></li>
				<li><a href="<?php echo U('Home/Index/zhs');?>">认捐祈福</a></li>
				<li><a href="<?php echo U('inform');?>">寺院通告</a></li>			
				<li><a href="<?php echo U('baokam');?>" class="current" style="color: #fff;">镇海宝鉴</a></li>
				<li><a href="<?php echo U('down');?>">下载专区</a></li>
				<li><a href="<?php echo U('study');?>">学习园地</a></li>

				</ul>
			</div>
			<!--头部结束-->
			</div>
			</div>
			<!--主题开始-->
			<div class="v7">
			<div class="v6 clear">
			<div class="v5">
			<div class="v1">
			 <table>
			 	<tr>
			 		<td><b>镇海文化</b></td>
			 	</tr>
			 </table>
				<?php if(is_array($culture)): foreach($culture as $key=>$list): ?><p><a href="<?php echo U('contents',array('id'=>$list['id']));?>">卍 <?php echo ($list["name"]); ?></a></p><?php endforeach; endif; ?>
		    </div>
		    <div class="v2">
			 <table>
			 	<tr>
			 		<td><b>寺院通告</b></td>
			 	</tr>
			 </table>
				<?php if(is_array($inform)): foreach($inform as $key=>$list): ?><p><a href="<?php echo U('contents',array('id'=>$list['id']));?>"><?php echo ($list["name"]); ?></a></p><?php endforeach; endif; ?>
			</div>
			</div>
			<div class="v3">
				<div class="v8">
				 	<p>
				 	<img src="/Public/jlimages/wawa.png" />
				 	<b>镇海宝鉴</b><span>当前位置:<a href="<?php echo U('index');?>">首页</a>><a>镇海宝鉴</a></span>
				 	<img src="/Public/jlimages/moxian.png" />
				 	</p>
				 </div>
				 <div class="gallery-heading w3layouts">
					<h2>镇海宝鉴</h2>
					<p>Vivamus efficitur scelerisque nulla nec lobortis. Nullam ornare metus vel dolor feugiat maximus.Aenean nec nunc et metus volutpat dapibus ac vitae ipsum. Pellentesque sed rhoncus nibh</p>
				</div>
				 <div class="v11">
					 <?php if(is_array($jl_images)): foreach($jl_images as $key=>$list): ?><div class="col-md-6 gallery-grid wow fadeInUp animated" data-wow-delay=".5s">
							 <div class="grid">
								 <figure class="effect-apollo">
									 <a class="example-image-link" href="/Public/jlimages/4.jpg" data-lightbox="example-set" data-title="">
										 <img src="/Public/<?php echo ($list["image"]); ?>" alt="" />
										 <figcaption>
											 <h3>Triplex</h3>
											 <p>Proin vitae luctus dui, sit amet ultricies leo</p>
										 </figcaption>
									 </a>
								 </figure>
							 </div>
						 </div><?php endforeach; endif; ?>
				


			    <div class="clearfix"> </div>
					<script src="/Public/jljs/lightbox-plus-jquery.min.js"> </script>
				</div>
			</div>					
		</div>
		</div>
		<!--主题结束-->
		<!--底部开始-->
		<div class="footer">
			<div class="u7">
				<p style="margin-left: 150px;font-size: 16px;color: #dadada;"><strong>友情链接:</strong> <a href="http://www.tzjfoxiao.com/" target="_blank"><b>通则久佛教文化网</b></a> <a href="http://www.chinabuddhism.com.cn/" target="_blank"><b>中国佛教协会</b></a> <a href="http://www.fjnet.com/" target="_blank"><b>佛教在线</b></a> <a href="http://www.liaotuo.org/" target="_blank"><b>弘善佛教</b></a> <a href="http://www.pusa123.com/" target="_blank"><b>菩萨在线</b></a> <a href="http://www.simiao.cn/" target="_blank"><b>中国寺庙网</b></a> <a href="http://www.wuys.com" target="_blank"><b>佛学研究网</b></a></p>
				<p style="margin-left: 223px;font-size: 16px;color: #dadada;"><a href="#"><b>少林寺</b></a> <a href="http://www.fomen123.com/" target="_blank"><b>佛门网</b></a> <a href="http://www.lingyinsi.org/" target="_blank"><b>灵隐寺</b></a></p>
			</div>
			<span><img src="/Public/jlimages/address.png"/><b>江苏省常州市新北区镇海路98号 </b> <img src="/Public/jlimages/phone.png"/><strong>0519-8324 7330</strong></span>
			<hr color="#333333" size="1"/>
			<span style="color: #999999;">版权所有:<a href="#">上海通则久文化</a> 沪ICP备16045553号-2</span>
		</div>
		<!--底部结束-->
		
	</body>
</html>