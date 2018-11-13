<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>中国帝宫</title>
    <link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/order1.css" />
    <style>

    </style>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.7.2.min.js"></script>
</head>
<body>
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
                            <li><a href="/webjlcs/Home/User/register">注册</a></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--top_end -->
        <div class="nav2_ex">
            <div id="topLogo"><a href="<?php echo U('Index/index1');?>"><img src="/webjlcs/Public/images/logo.jpg"/></a></div>
            <div id="topMenu" >
                <a href="/webjlcs/Home/Index/index">首页</a>
                <a href="<?php echo U('Index/smjs');?>">寺庙供奉</a>
                <a href="<?php echo U('Index/smjs');?>">生命关怀</a>
                <a href="/webjlcs/Home/Index/fjzh">佛教智慧</a>
                <a href="/webjlcs/Home/User/info">个人中心</a>
                <a href="/webjlcs/Home/Transfer/index">赠送</a>
            </div>
        </div>
    </div>
</div>
<div style="width: 1200px;margin: 0 auto;">
<div class="box">首页 / 购物车 / 填写订单 / 支付</div>
<div class="box1"><img src="/webjlcs/Public/images/zhif.jpg" /></div>
    <div class="content" style="text-align: center;line-height: 100px;">


        <div class="content_info">您的订单号为:<?php echo ($info["order_id"]); ?>,请您在<div class="time">尽快</div>付款，逾期订单自动删除。</div>
        <div class="content_infos">应付金额:<div class="time">￥<?php echo ($info["order_total_price"]); ?></div></div>
    </div>
<div class="pay">
    <p><a href="javascript:void(0)" class="dashang" title="">选择支付平台:</a></p>
    <form action="<?php echo U('Pay/pay_');?>" method="post">
        <div class="alipay">
            <input type="radio" id="forever" name="myradio" value="1" checked><label for="forever"><img src="/webjlcs/Public/images/alipay.jpg" alt="支付宝支付人生"></label>
        </div>
        <div class="wechtpay">
            <input type="radio" id="casual" name="myradio" value="2"><label for="casual"><img src="/webjlcs/Public/images/wechat.jpg" alt=""></label>
        </div>
        <div class="yinpay">
            <input type="radio" id="yinpay" name="myradio" value="3"><label for="yinpay"><div style="width: 70px;height: 48px;background:url('/webjlcs/Public/images/yinpay.jpg') center no-repeat;position: relative;top:-40px;left: 30px;"></div></label>
        </div>
        <input type="hidden" name="order_id" value="<?php echo ($_SESSION['order_id']); ?>"/>
        <input type="hidden" name="total" value="<?php echo ($_SESSION['total']); ?>" />
        <div class="tijiao">
            <input type="submit" value="确认支付"/>
        </div>

    </form>

</div>
<!--
<div style="width: 1160px;height: 200px;background:white;margin: 0 auto;margin-top:10px; ">
    <!--<img src="/webjlcs/Home/Order/verify" alt="">
    <img id="pic" alt="">
</div>-->
<script type="text/javascript">

</script>
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
            /*margin:0 auto;*/
            margin-left: 80px;
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
        	width: 620px;
            height: 118px;
        	margin: 0 auto;
            padding:0 auto;    	
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



</div>

</body>
<script type="text/javascript">
    $(document).ready(function(){
        ajax();
    });

    function ajax(){
        var url= window.location.href ;
        var urls='/webjlcs/Home/Order/verify';
        var imgname=new Date().getTime()+parseInt(100*Math.random());
        var imgurl='/webjlcs/Public/images/code/'+imgname+'.png';
        $.post(urls,{url:url,imgname:imgname},function(data){
                if(data !== 1){
                    document.getElementById("pic").src = imgurl;
                }
        })
    }


//    alert(imgurl);
</script>
</html>