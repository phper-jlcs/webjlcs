<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>镇海禅寺</title>
		<link rel="stylesheet" href="/webjlcs/Public/zhcss/index.css" />
	</head>
	<body>
		<div class="u">
		<div class="u0">
			<!--头部开始-->
			<div class="u1 clear">
				<div class="u6">

				</div>
			<ul>
				<li><a href="<?php echo U('Home/Index/index');?>">中国帝宫</a></li>
				<li><a href="<?php echo U('index');?>" class="current" style="color: #fff;">镇海禅寺</a></li>
				<li><a href="<?php echo U('culture');?>">镇海文化</a></li>
				<li><a href="<?php echo U('Home/Index/zhs');?>">认捐祈福</a></li>
				<li><a href="<?php echo U('inform');?>">寺院通告</a></li>			
				<li><a href="<?php echo U('baokam');?>">镇海宝鉴</a></li>
				<li><a href="<?php echo U('down');?>">下载专区</a></li>
				<li><a href="<?php echo U('study');?>">学习园地</a></li>
			</ul>
			</div>
			<!--头部结束-->
		</div>
		</div>
			<!--主题开始-->
			<div class="u8">
			<div class="u5 clear">
			<div class="u2">
				<h2>寺院通告<small><a href="<?php echo U('inform');?>">更多</a></small></h2>
				<div  class="avatar">
				<img src="/webjlcs/Public/zhimages/shouye04.jpg" class="img"/></div>
				<?php if(is_array($inform)): foreach($inform as $key=>$list): ?><p><a href="<?php echo U('contents',array('id'=>$list['id']));?>"><?php echo ($list["name"]); ?></a></p><?php endforeach; endif; ?>
			</div>
			<div class="u3">
				<h2>镇海文化<small><a href="<?php echo U('culture');?>">更多</a></small></h2>
				<img src="/webjlcs/Public/jlimages/shouye01.jpg" style="padding-bottom: 8px;" />
				<?php if(is_array($culture)): foreach($culture as $key=>$list): ?><p><a href="<?php echo U('contents',array('id'=>$list['id']));?>"><?php echo ($list["name"]); ?></a></p><?php endforeach; endif; ?>
			</div>
			<div class="u4">
				<h2>认捐祈福</h2>
				<div  class="avatar1">
					<a href="<?php echo U('Home/Index/zhs');?>"><img src="/webjlcs/Public/zhimages/shouye05.jpg" class="img1"/></a></div>
				<p><b><a href="<?php echo U('Home/Index/zhs');?>">崇明镇海寺</a></b></p>
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
			<span><img src="/webjlcs/Public/jlimages/address.png"/><b>江苏省常州市新北区九龙路98号 </b> <img src="/webjlcs/Public/jlimages/phone.png"/><strong>0519-8324 7330</strong></span>
			<hr color="#333333" size="1"/>
			<span style="color: #999999;">版权所有:<a href="#">上海通则久文化</a> 沪ICP备16045553号-2</span>
		</div>
		<!--底部结束-->
	</body>
</html>