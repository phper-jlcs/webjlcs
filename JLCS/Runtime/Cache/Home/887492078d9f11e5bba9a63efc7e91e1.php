<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>中国帝宫-功德证书</title>
    <link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/order1.css" />
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.2.min.js"></script>
    <style type="text/css">
        #goodcover {
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 133%;
            background-color: black;
            z-index: 1001;
            -moz-opacity: 0.8;
            opacity: 0.50;
            filter: alpha(opacity=80);
        }
        #code {
            width: 300px;
            height: 440px;
            background-color: #fff;
            padding: 10px;
            position: absolute;
            display: none;
            left: 45%;
            margin-top: 20px;
            z-index: 1002;
        }
        .close1 {
            width: 300px;
            height: 60px;
        }
        #closebt {
            float: right;
        }
        #closebt img {
            width: 20px;
        }
        .goodtxt {
            text-align: center;
        }
        .goodtxt p {
            height: 30px;
            line-height: 30px;
            font-size: 16px;
            color: #000;
            font-weight: 600;
        }
        .code-img {
            width: 250px;
            margin: 30px auto 0 auto;
            padding: 10px;
        }
        .code-img img {
            width: 240px;
        }
    </style>
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
                            <a href="/webjlcs/index.php/Home/Cart/index">我的认捐库</a>
                            <li><a href="/webjlcs/index.php/Home/User/dologot">退出</a></li>
                            <?php else: ?>
                            <li><a href="/webjlcs/index.php/Home/User/login" >登录</a></li>
                            <li><a href="/webjlcs/index.php/Home/User/register">注册</a></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--top_end -->
        <div class="nav2_ex">
            <div id="topLogo"><a href="<?php echo U('Index/index1');?>"><img src="/webjlcs/Public/images/logo.jpg"/></a></div>
            <div id="topMenu" >
                <a href="/webjlcs/index.php/Home/Index/index">首页</a>
                <a href="<?php echo U('Index/smjs');?>">寺庙供奉</a>
                <a href="<?php echo U('Index/smjs');?>">生命关怀</a>
                <a href="/webjlcs/index.php/Home/Index/fjzh">佛教智慧</a>
                <a href="/webjlcs/index.php/Home/User/info">个人中心</a>
                <a href="/webjlcs/index.php/Home/Transfer/index">赠送</a>
            </div>
        </div>
    </div>
</div>
<div style="width: 1200px;margin: 0 auto;">
    <div style="width: 500px;height: 700px;background:url('/webjlcs/Public/images/gongde2.jpg')  no-repeat;margin: 0 auto;margin-top: 100px;">
        <div style="width: 100px;height: 20px;position: relative;top:335px;left:290px;"><span style="font-size: 18px;">￥<?php echo ($total); ?></span></div>
        <div style="width: 100px;height: 20px;position: relative;top:175px;left:290px;"><span style="font-size: 18px;"><?php echo ($relname); ?></span></div>
        <div style="width: 100px;height: 20px;position: relative;top:258px;left:290px;"><span style="font-size: 18px;">
            <?php if(is_array($position)): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; echo ($list); endforeach; endif; else: echo "" ;endif; ?>
        </span></div>
        <div style="width: 59px;height: 59px;background:url('/webjlcs/Public/images/timg.jpg') center no-repeat;position: relative;top:540px;left:330px;"></div>
        <a href="javascript:void(0)" id="ClickMe">
            <div style="width: 320px;height: 60px;position: relative;top:450px;left: 90px;">

            </div>
        </a>
        <!-- <div style="width: 320px;height: 60px;position: relative;top:455px;left: 90px;background: white;">
             <span style="font-size: 15px;color:#B98947">分享到您的微信朋友圈，截图联系客服，即可获得50元现金红包！机会只有一次，千万不要错过哦</span>
         </div>-->
        <div id="code">
            <div class="close1"><a href="javascript:void(0)" id="closebt"><img src="/webjlcs/Public/images/close.gif"></a></div>
            <div class="goodtxt">
                <p>微信扫一扫</p>
                <p>将您的功德分享到朋友圈</p>
                <p>让更多朋友知道哦~</p>
            </div>
            <div class="code-img"> <img id="ewmsrc"  /></div>
        </div>
    </div>
</div>
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
        	width: 1200px;
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
<script type="text/javascript">
    $('#ClickMe').click(function() {
        ajax();
        $('#code').center();
        $('#goodcover').show();
        $('#code').fadeIn();
    });
    $('#closebt').click(function() {
        $('#code').hide();
        $('#goodcover').hide();
    });
    $('#goodcover').click(function() {
        $('#code').hide();
        $('#goodcover').hide();
    });
    function ajax(){
        var url= window.location.href ;
        var urls='/webjlcs/index.php/Home/Order/verify';
        var imgname=new Date().getTime()+parseInt(100*Math.random());
        var imgurl='/webjlcs/Public/images/code/'+imgname+'.png';
        $.post(urls,{url:url,imgname:imgname},function(data){
            if(data !== 1){
                document.getElementById("ewmsrc").src = imgurl;
            }
        })
    }

    /*var val=$(window).height();
     var codeheight=$("#code").height();
     var topheight=(val-codeheight)/2;
     $('#code').css('top',topheight);*/
    jQuery.fn.center = function(loaded) {
        var obj = this;
        body_width = parseInt($(window).width());
        body_height = parseInt($(window).height());
        block_width = parseInt(obj.width());
        block_height = parseInt(obj.height());

        left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
        if (body_width < block_width) {
            left_position = 0 + $(window).scrollLeft();
        };

//        top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
//        if (body_height < block_height) {
//            top_position = 0 + $(window).scrollTop();
//        };

        if (!loaded) {

            obj.css({
                'position': 'absolute'
            });
            obj.css({
                'top': ($(window).height() - $('#code').height()) * 0.5,
                'left': left_position
            });
            $(window).bind('resize', function() {
                obj.center(!loaded);
            });
            $(window).bind('scroll', function() {
                obj.center(!loaded);
            });

        } else {
            obj.stop();
            obj.css({
                'position': 'absolute'
            });
            obj.animate({
                'top': top_position
            }, 200, 'linear');
        }
    }
</script>
</html>