<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>文章内容页</title>
		<link rel="stylesheet" href="/Public/jlcss/inform.css" />
	</head>
	<body>
		<div class="v">
		<div class="v0">
			<!--头部开始-->
			<div class="u1 clear">
				<div class="u6">
					<a href="<?php echo U('index');?>"><img src="/Public/jlimages/logo.png" /></a>
				</div>
			<ul>
				<li><a href="<?php echo U('Home/Index/index');?>">中国帝宫</a></li>
				<li><a href="<?php echo U('index');?>" class="current" style="color: #fff;">九龙禅寺</a></li>
				<li><a href="<?php echo U('culture');?>">九龙文化</a></li>
				<li><a href="<?php echo U('Home/Index/jlcs');?>">认捐祈福</a></li>
				<li><a href="<?php echo U('inform');?>" >寺院通告</a></li>
				<li><a href="<?php echo U('baokam');?>">九龙宝鉴</a></li>
				<li><a href="<?php echo U('down');?>">下载专区</a></li>
				<li><a href="<?php echo U('study');?>">学习园地</a></li>
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
			 		<td><b>九龙文化</b></td>
			 	</tr>
			 </table>
				<?php if(is_array($culture)): foreach($culture as $key=>$list): ?><p><a href="<?php echo U('contents',array('id'=>$list['id']));?>"><?php echo ($list["name"]); ?></a></p><?php endforeach; endif; ?>
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
				 	<b><?php echo ($articles["cat_name"]); ?></b><span>当前位置:<a href="<?php echo U('index');?>">首页</a>><a><?php echo ($articles["cat_name"]); ?></a></span>
				 	<img src="/Public/jlimages/moxian.png" />
				 	</p>
				 </div>
				 <div class="v9">
				<table style="width: 650px;">
					<tr>
						<td align="center">
							<h3><?php echo ($articles["name"]); ?></h3>
						</td>
					</tr>
					<tr>
					 <td>
						 <div id="content" ><?php echo ($articles["content"]); ?></div>
					 </td>
					</tr>
				</table>
				</div>
			</div>
		</div>
	</div>
			<!--底部开始-->
		<div class="footer">
			<div class="u7">
				<p style="margin-left: 150px;font-size: 16px;color: #dadada;"><strong>友情链接:</strong> <a href="http://www.tzjfoxiao.com/" target="_blank"><b>通则久佛教文化网</b></a> <a href="http://www.chinabuddhism.com.cn/" target="_blank"><b>中国佛教协会</b></a> <a href="http://www.fjnet.com/" target="_blank"><b>佛教在线</b></a> <a href="http://www.liaotuo.org/" target="_blank"><b>弘善佛教</b></a> <a href="http://www.pusa123.com/" target="_blank"><b>菩萨在线</b></a> <a href="http://www.simiao.cn/" target="_blank"><b>中国寺庙网</b></a> <a href="http://www.wuys.com" target="_blank"><b>佛学研究网</b></a></p>
				<p style="margin-left: 223px;font-size: 16px;color: #dadada;"><a href="#"><b>少林寺</b></a> <a href="http://www.fomen123.com/" target="_blank"><b>佛门网</b></a> <a href="http://www.lingyinsi.org/" target="_blank"><b>灵隐寺</b></a></p>
			</div>
			<span><img src="/Public/jlimages/address.png"/><b>江苏省常州市新北区九龙路98号 </b> <img src="/Public/jlimages/phone.png"/><strong>0519-8324 7330</strong></span>
			<hr color="#333333" size="1"/>
			<span style="color: #999999;">版权所有:<a href="#">上海通则久文化</a> 沪ICP备16045553号-2</span>
		</div>
		<!--底部结束-->
		
	</body>
</html>