<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>中国帝宫-生命关怀</title>
		<link rel="stylesheet" href="/webjlcs/Public/css/smgh.css" />
	</head>
	<body style="overflow-x:hidden;">
		<div id="glideDiv0">
<div id="nav2_ex" class="nav2_index">
<!--top -->
<div id="headTopBg"> 
<div id="headTop" class="w1024">
 <div class="headTopRight">
    <ul id="nav_all">
        <?php if($_SESSION['name']): ?><li><a href="" ><?php echo ($_SESSION['name']); ?></a></li>
            <a href="/webjlcs/Home/Cart/index">我的认捐库</a>
            <li><a href="/webjlcs/Home/User/dologot">退出</a></li>
        <?php else: ?>
      <li><a href="/webjlcs/Home/User/login" >登录</a></li>
      <li><a href="/webjlcs/Home/User/register">注册</a></li>
            <li><a href="/webjlcs/Home/User/activation" >激活</a></li>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php endif; ?>
    </ul>
 </div>
 </div>
 </div>
<!--top_end -->
<div class="clean"></div>
<div class="nav2_ex">
<div id="topLogo"><a href="/webjlcs/Home/Index/index1"><img src="/webjlcs/Public/static/images/logo.png"/></a></div>
<div id="topMenu" > 
  <a href="/webjlcs/Home/Index/index">首页</a>
    <a href="<?php echo U('smjs');?>">寺庙供奉</a>
    <a href="<?php echo U('smgh');?>" style="color:red;">生命关怀</a>
  <a href="/webjlcs/Home/Index/fjzh">佛教智慧</a>
    <a href="/webjlcs/Home/User/info">个人中心</a>
    <a href="/webjlcs/Home/Transfer/index">赠送</a>
</div>
<div class="clear"></div>
</div>
</div>
</div>
<div class="clear"></div>
<div class="themes">

        <div class="clear"></div>
		<div class="master">
            <?php echo ($article_lists['content']); ?>

		</div>

        <div class="backf">
    <div id="footer">
        <ul>
            <li class="sy">友情链接</li>
            <li><a href="http://tzjfoxiao.com/" target="_blank">通则久佛孝网</a></li>
            <li><a href="http://www.fjnet.com/" target="_blank">佛教在线</a></li>
            <li><a href="http://www.pusa123.com/" target="_blank">菩萨在线</a></li>
            <li><a href="http://www.liaotuo.org/" target="_blank">弘扬佛教网</a></li>
            <li><a href="http://www.chinabuddhism.com.cn/" target="_blank">中国佛教协会</a></li>

        </ul>
        <ul>
            <li class="sy">购物指南</li>
            <li><a href="#">免费注册</a></li>
            <li><a href="#">申请会员</a></li>
            <li><a href="#">开通支付宝</a></li>
            <li><a href="#">支付宝充值</a></li>
        </ul>
        <ul>
            <li class="sy">商家服务</li>
            <li><a href="#">联系我们</a></li>
            <li><a href="#">客服服务</a></li>
            <li><a href="#">物流服务</a></li>
            <li><a href="#">缺货赔付</a></li>
        </ul>
        <ul>
            <li class="sy">关于我们</li>
            <li><a href="#">知识产权</a></li>
            <li><a href="#">网站合作</a></li>
            <li><a href="#">规则意见</a></li>
            <li><a href="#">帮助中心</a></li>
        </ul>
        <ul>
            <li class="sy">其他服务</li>
            <li><a href="#">诚聘英才</a></li>
            <li><a href="#">法律声明</a></li>

        </ul><div class="clear"></div>
    </div>
</div>
<!--foot_end -->
</div>
	</body>
</html>