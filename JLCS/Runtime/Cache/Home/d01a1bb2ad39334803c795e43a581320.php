<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>中国帝宫</title>
    <link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/product.css" />
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
</head>
<style>

</style>
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
                            <li><a href="/webjlcs/Home/User/register">注册</a></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--top_end -->
        <div class="clean"></div>
        <div class="nav2_ex">
            <div id="topLogo"><a href="/webjlcs/Home/Index/index1"><img src="/webjlcs/Public/images/logo.jpg"/></a></div>
            <div id="topMenu" >
                <a href="/webjlcs/Home/Index/index">首页</a>
                <a href="<?php echo U('Index/smjs');?>">寺庙供奉</a>
                <a href="<?php echo U('Index/smjs');?>">生命关怀</a>
                <a href="/webjlcs/Home/Index/fjzh">佛教智慧</a>
                <a href="/webjlcs/Home/User/info">个人中心</a>
                <a href="/webjlcs/Home/Transfer/index">赠送</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<div class="clear"></div>
<!-- banner start -->
<div class="c">
	<div>
	   <img src="/webjlcs/Public/images/banner.jpg" style="width: 100%;"/>

</div>
<div class="banner">
    <div id="main" style="width:800px;float: left; margin-left: 200px;">
        <h2 class="top_title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;皇家宗祠
                <?php if(($owns == 'a')): ?>大中通坊
                    <?php elseif(($owns == 'aa')): ?>大中通坊
                <?php elseif(($owns == 'b')): ?>大通坊
                    <?php elseif(($owns == 'bb')): ?>大通坊
                <?php elseif(($owns == 'c')): ?>大同坊
                <?php elseif(($owns == 'd')): ?>太清坊
                    <?php elseif(($owns == 'dd')): ?>太清坊
                <?php elseif(($owns == 'f')): ?>天成坊
                    <?php elseif(($owns == 'ff')): ?>普通坊
                <?php elseif(($owns == 'g')): ?>天监坊
                    <?php elseif(($owns == 'gg')): ?>天监坊
                <?php else: endif; ?>平面示意图：</h2>
        <div class="demo" style="float: left;margin-left: 40px;width: 900px;">
            <?php if(($owns == 'g')): ?><img src="/webjlcs/Public/images/hjzc/list/tjs.jpg" style="float:left;margin-top:10px;" class="imgsrc">
                <?php elseif(($owns == 'a')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/zds.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'aa')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/zdx.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'b')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/dts.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'bb')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/dtx.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'c')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/dt.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'd')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/tqz.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'f')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/pts.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'ff')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/ptx.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'gg')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/tjx.jpg" style="float:left;margin-top:10px;">
                <?php elseif(($owns == 'dd')): ?>
                <img src="/webjlcs/Public/images/hjzc/list/tqy.jpg" style="float:left;margin-top:10px;">
            <?php else: endif; ?>
            <br/>
            <br/>
            <div style="width: 200px;height: 50px;position: relative;display: inline;font-size: 25px;color:#A84C10;left:-710px;top:-35px;" id="test"  name="test">您所在的区域:</div>
            <div id="seat-map" style="height:500px;width:450px;float:left;margin-left:20px;margin-top:-20px;display: block;background:url('/webjlcs/Public/images/hjzcback.jpg')" >
               <br/>
                <br/>
                <span style="font-size: 25px;color:#A84C10;float: left;">&nbsp;&nbsp;&nbsp;选择你要认捐的皇家宗祠:</span>
                <div style="width: 100px;height: 30px;"></div>
                <div style="width: 450px;height: 50px;float: left;margin-left: 15px;">
               <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list["product_store"] == 0)): ?><div class="huise" style="border:1px solid #c3c3c3;width:40px;height: 30px;cursor: pointer;float:left;text-align:center; line-height:30px;-webkit-box-shadow:5px 5px 5px #B37731;
-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px;     -webkit-border-radius: 8px; border-radius:8px;margin: 5px;" id=<?php echo ($list["goods_id"]); ?> >
                           已售
                       </div>
                       <?php else: ?>
                    <div class="bianse bianse2" style="border:1px solid #c3c3c3;width:40px;height: 30px;cursor: pointer;float:left;text-align:center; line-height:30px;-webkit-box-shadow:5px 5px 5px #B37731;
-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px;     -webkit-border-radius: 8px; border-radius:8px;margin: 5px;" id=<?php echo ($list["goods_id"]); ?> >
                        <?php echo ($list["product_name"]); ?>
                    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div style="width: 100px;height: 300px;float: left;" class="jsons"></div>
            <br/>

            <script src="http://www.daimasucai.com/daima/template/1/js/jquery.min.js"></script>
            <script type="text/javascript" src="/webjlcs/Public/js/jquery.seat-charts.min.js"></script>
        </div>
    </div>
    <!-- banner end-->
    <div class="clear"></div>

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

</body>
<link >
<script type="text/javascript">
    $('.bianse').click(function(){
        var id = $(this).attr('id');
        var url='/webjlcs/Home/Product/ajax_return';
        $.post(url,{id:id},function(data){
            if(data == 'a'){
                alert('该商品不存在');
            }else{
                var id=JSON.parse( data );
                window.location.href = "/webjlcs/Home/Product/details?id="+id;
            }
        })
    })
</script>
</html>