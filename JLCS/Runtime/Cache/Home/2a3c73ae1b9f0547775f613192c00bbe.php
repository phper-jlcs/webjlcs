<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中国帝宫-镇海寺</title>
<link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/style.css" />
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
        window.onload = function (){
            document.querySelector(".rotate-circle").addEventListener("mouseover",function (){
                if(this.classList.contains('rotate')){
                    this.classList.remove('rotate');
                }else{
                    this.classList.add('rotate');
                }
            },false)

            document.querySelector(".rotate-circle1").addEventListener("mouseover",function (){
                if(this.classList.contains('rotate1')){
                    this.classList.remove('rotate1');
                }else{
                    this.classList.add('rotate1');
                }
            },false)
        }
    </script>
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
<div id="topLogo"><a href="<?php echo U('Index/zhs');?>"><img src="/webjlcs/Public/images/zhs_logo.png"/></a></div>
<div id="topMenu" > 
  <a href="/webjlcs/Home/Index/index" style="color:red;" >首页</a>
    <a href="<?php echo U('Index/smjs');?>">寺庙供奉</a>
    <a href="<?php echo U('Index/smjs');?>">生命关怀</a>
    <a  href="/webjlcs/Home/Index/fjzh">佛教智慧</a>
    <a href="/webjlcs/Home/User/info">个人中心</a>
    <a href="/webjlcs/Home/Transfer/index">赠送</a>
</div>
<div class="clear"></div>
</div>
</div>
</div>

<div class="clear"></div>
<!-- banner start -->
    <div class="banner">
        <div style="width: 1200px;margin: 0 auto" >
     <img src="/webjlcs/Public/images/banner1.jpg"  style="width: 100%;"/>
	    
        <div>
            <div style="margin-bottom: 10px;margin-left: 200px">
            	<div style="float: left;"><img src="/webjlcs/Public/images/zb.png"/></div>
            	<div style="float: left;font-size: 24px;margin: 5px 5px;">镇海禅寺宣传视频</b></div>
            	<div style="float: left;"><img src="/webjlcs/Public/images/yb.png"/></div>
            </div>
            <div>
                <video controls  style="margin-top: 20px;margin-left: 180px;">
                    <source src="/webjlcs/Public/images/zhs.mp4" />
                </video>
            </div>
        </div>
        <div>
            <div style="margin: 10px -30px;margin-left:260px;">
            	<div style="float: left;"><img src="/webjlcs/Public/images/zb.png"/></div>
            	<div style="float: left;font-size: 24px;margin: 5px 5px;">镇海迎佛</b></div>
            	<div style="float: left;"><img src="/webjlcs/Public/images/yb.png"/></div>
            </div>
            <div class="clear"></div>
            <div style="float: left;margin-right: 36px;margin-left: 180px;">
             	<div class="avatar1">
             	    <a href="/webjlcs/Home/Index/zhs_wft1">
             	    	<img class="img1" src="/webjlcs/Public/images/wanfo1.jpg" style="width: 410px;margin-top: 20px;"/>
             	    </a>
             	</div>
             	<p>万佛堂-1层</p>
            </div>
            <div style="float: left;">
             	<div class="avatar2">
             	    <a href="/webjlcs/Home/Index/zhs_wft2">
             		    <img class="img2" src="/webjlcs/Public/images/wanfo2.jpg" style="width: 410px;margin-top: 20px;"/>            	
             	    </a>            	
             	</div>
             	<p>万佛堂-2层</p>
            </div>
        </div>
</div>
</div>
<!-- banner end-->
<div class="clear"></div>
<div class="c">
<!--foot_start -->
<html>
<head>
    <title></title>
    <style type="text/css">
        .backf{
            margin-top:20px;
            border-top:1px solid #ccc;
        }
        #footer{
            width:1200px;
            margin:0 auto;
            
            margin-top: 30px;
        }
        #footer ul{
            float:left;
            margin-left:30px;
            width:200px;
            text-decoration:none;

        }
        #footer .sy{
            text-align:center;
            font-size:16px;
            color:#333;
            font-weight:bold;
        }
        #footer ul li{
            width:180px;
            padding:5px;
        }
        #footer ul li a,#footer ul li a:visited{
            font-size:12px;
            color:#000;
            margin-left:60px;
            text-decoration:none;
            font-family: "微软雅黑";
            font-weight: 500;
        }
        #footer ul li a:hover{
            color:#F36;
        }
        .x{
        	width: 700px;
        	margin: 0 auto;    	
        }
        .x p{
        	font-size: 20px;
	        margin-top: 10px;
	        margin-left: -10px;
        }
    </style>
</head>
<body>
<div class="backf">
	<div class="x">
    		<div style="float: left;">
             		<img src="/webjlcs/Public/images/mian.png" style="width: 60px;height: 68px;margin-top: 10px;"/>
             		<p>免5年管理费</p>
             </div>
             <div style="float: left;margin-left: 100px;">
             		<img src="/webjlcs/Public/images/zheng.png" style="width: 60px;height: 68px;margin-top: 10px;"/>
             		<p>皇室正统</p>
             </div>
             <div style="float: left;margin-left: 100px;">
             		<img src="/webjlcs/Public/images/li.png" style="width: 60px;height: 68px;margin-top: 10px;"/>
             		<p>臻选好礼</p>
             </div>
             <div style="float: left;margin-left: 100px;">
             		<img src="/webjlcs/Public/images/suo.png" style="width: 60px;height: 68px;margin-top: 10px;"/>
             		<p>安全支付</p>
             </div>
    </div>
    <div class="clear"></div>
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
            <li><a href="JavaScript:void(0)">免费注册</a></li>
            <li><a href="JavaScript:void(0)">申请会员</a></li>
            <li><a href="JavaScript:void(0)">开通支付宝</a></li>
            <li><a href="JavaScript:void(0)">支付宝充值</a></li>
        </ul>
        <ul>
            <li class="sy">商家服务</li>
            <li><a href="JavaScript:void(0)">联系我们</a></li>
            <li><a href="JavaScript:void(0)">客服服务</a></li>
            <li><a href="JavaScript:void(0)">物流服务</a></li>
            <li><a href="JavaScript:void(0)">缺货赔付</a></li>
        </ul>
        <ul>
            <li class="sy">关于我们</li>
            <li><a href="JavaScript:void(0)">知识产权</a></li>
            <li><a href="JavaScript:void(0)">网站合作</a></li>
            <li><a href="JavaScript:void(0)">规则意见</a></li>
            <li><a href="JavaScript:void(0)">帮助中心</a></li>
        </ul>
        <ul>
            <li class="sy">联系我们</li>
            <li>
            	<a href="JavaScript:void(0);" onclick="alert('aaa')">微信公众号</a>
            </li>
            <li  style="cursor:pointer;">
            	<img src="/webjlcs/Public/images/max_code.png" alt="" style="position: relative;left:55px;">
            	<p>400-088-6888</p>
            	<p style="font-size: 12px;">24h客服热线(仅收市话费)</p>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    <div style="width: 1200px;margin-bottom: 10px;">
    	<p style="text-align: center;font-size: 12px;">版权所有:上海通则久文化 沪ICP备16045553号-2</p>
    </div>
</div>
</body>
</html>



<!--foot_end -->
</div>
</body>
</html>