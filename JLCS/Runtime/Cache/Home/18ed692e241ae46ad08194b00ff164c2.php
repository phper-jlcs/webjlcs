<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
<title>中国帝宫-详情页</title>
<link href="/webjlcs/Public/css/pro_detail.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            .suspend{width:40px;height:198px;position:fixed;top:200px;right:0;overflow:hidden;z-index:9999;}
            .suspend dl{width:120px;height:198px;border-radius:25px 0 0 25px;padding-left:40px;box-shadow:0 0 5px #e4e8ec;}
            .suspend dl dt{width:40px;height:198px;background:url(/webjlcs/Public/images/suspend.png);position:absolute;top:0;left:0;cursor:pointer;}
            .suspend dl dd.suspendQQ{width:120px;height:85px;background:#ffffff;}
            .suspend dl dd.suspendQQ a{width:120px;height:85px;display:block;background:url(/webjlcs/Public/images/suspend.png) -40px 0;overflow:hidden;}
            .suspend dl dd.suspendTel{width:120px;height:112px;background:#ffffff;border-top:1px solid #e4e8ec;}
            .suspend dl dd.suspendTel a{width:120px;height:112px;display:block;background:url(/webjlcs/Public/images/suspend.png) -40px -86px;overflow:hidden;}
            * html .suspend{position:absolute;left:expression(eval(document.documentElement.scrollRight));top:expression(eval(document.documentElement.scrollTop+200))}
        </style>
<script src="/webjlcs/Public/js/jquery-1.9.1.min.js"></script>
<script src="/webjlcs/Public/js/common.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	  var showproduct = {
		  "boxid":"showbox",
		  "sumid":"showsum",
		  "boxw":400,
		  "boxh":550,
		  "sumw":60,//列表每个宽度,该版本中请把宽高填写成一样
		  "sumh":60,//列表每个高度,该版本中请把宽高填写成一样
		  "sumi":7,//列表间隔
		  "sums":5,//列表显示个数
		  "sumsel":"sel",
		  "sumborder":1,//列表边框，没有边框填写0，边框在css中修改
		  "lastid":"showlast",
		  "nextid":"shownext"
		  };//参数定义
	 $.ljsGlasses.pcGlasses(showproduct);//方法调用，务必在加载完后执行
	 $(function(){
		$('.tabs a').click(function(){
			var $this=$(this);
			$('.panel').hide();
			$('.tabs a.active').removeClass('active');
			$this.addClass('active').blur();
			var panel=$this.attr("href");
			$(panel).show();
			return false;  //告诉浏览器  不要纸箱这个链接
			})//end click
			$(".tabs li:first a").click()   //web 浏览器，单击第一个标签吧
		})//end ready
		$(".centerbox li").click(function(){
			$("li").removeClass("now");
			$(this).addClass("now")
		});
});
</script>
</head>
<body scroll="no" style="overflow-x:hidden;">
<!--header部分-->
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
<div class="nav2_ex">
<div id="topLogo">
        <?php if(($biaoshi == 1)): ?><a href="<?php echo U('Index/zhs');?>">
            <img src="/webjlcs/Public/images/zhs_logo.png"/>
            <?php else: ?>
                <a href="<?php echo U('Index/jlcs');?>">
            <img src="/webjlcs/Public/images/logo.jpg"/><?php endif; ?>
    </a></div>
<div id="topMenu" > 
  <a href="<?php echo U('Index/index');?>">首页</a>
    <a href="<?php echo U('Index/smjs');?>">寺庙供奉</a>
    <a href="<?php echo U('Index/smjs');?>">生命关怀</a>
    <a href="/webjlcs/Home/Index/fjzh">佛教智慧</a>
    <a href="/webjlcs/Home/User/info">个人中心</a>
    <a href="/webjlcs/Home/Transfer/index">赠送</a>
</div>
</div>
</div>
</div>
<!---header结束-->
<!--商品详情部分-->
<div class="shopdetails">
	<!--放大镜-->
	<div id="leftbox">
	<div id="showbox">
        <?php if(($image == '1')): ?><img src="/webjlcs/Public/images/hjzc/detail/1.png" width="400" height="400" />
            <img src="/webjlcs/Public/images/hjzc/detail/2.png" width="400" height="400" />
            <img src="/webjlcs/Public/images/hjzc/detail/3.png" width="400" height="400" />
            <?php else: ?>
            <img src="/webjlcs/Public/images/wft/a.png" width="400" height="400" />
            <img src="/webjlcs/Public/images/wft/b.png" width="400" height="400" />
            <img src="/webjlcs/Public/images/wft/c.png" width="400" height="400" />
            <!--<img src="/webjlcs/Public/images/wft/6.jpg" width="400" height="400" />
            <img src="/webjlcs/Public/images/wft/7.jpg" width="400" height="400" />--><?php endif; ?>
	</div><!--展示图片盒子-->
		<div id="showsum"></div><!--展示图片里边-->
		<p class="showpage">
 		 <a href="javascript:void(0);" id="showlast"> < </a>
  		 <a href="javascript:void(0);" id="shownext"> > </a>
		</p>       
	</div>
    <!--中间-->
    <div class="centerbox">
        <?php if(($biaoshi == 1)): ?><p class="imgname"><?php echo ($own_name); ?>-><?php echo ($owns); ?>区-><?php echo ($products["product_name"]); ?></p>
            <?php else: ?>
            <p class="imgname"><?php echo ($own_name); ?>-><?php echo ($products["product_name"]); ?></p><?php endif; ?>
    	<p class="Aprice" style="font-size: 16px;">&nbsp;&nbsp;&nbsp;原&nbsp;&nbsp;&nbsp;价：<samp>￥<?php echo ($products["product_price"]); ?></samp></p>
    	<p class="price" style="font-size: 16px;">&nbsp;&nbsp;&nbsp;结缘价：<samp>￥<?php echo ($products["now_price"]); ?></samp></p>
        <div class="clear"></div>

        <?php if(($image == '1')): ?><p class="chima" style="font-size: 16px;">&nbsp;&nbsp;&nbsp;宗祠尺寸:&nbsp;&nbsp;&nbsp;1.8*2.5m</p>
            <?php else: ?>
            <p class="chima" style="font-size: 16px;">&nbsp;&nbsp;&nbsp;佛像位尺码：<?php echo ($products["size"]); ?></p>
            <p class="chima" style="font-size: 16px;">&nbsp;&nbsp;&nbsp;佛&nbsp;像&nbsp;尺&nbsp;码&nbsp;:&nbsp; 270*270*350mm</p><?php endif; ?>

        <p class="chima" style="font-size: 16px;">&nbsp;&nbsp;&nbsp;详&nbsp;&nbsp;&nbsp;情：&nbsp;&nbsp;&nbsp;&nbsp;<a href="#test" style="font-size: 16px;">如&nbsp;下</a></p>

        <p class="fuwu" style="font-size: 16px;">服务方式：</p>
        <p class="fuwu1" style="font-size: 16px;"></p>
        <span class="ids" id="<?php echo ($id); ?>"></span>
        <p class="buy"><a href="javascript:void(0)" onclick="order()" id='firstbuy' ">立即认捐</a><a href="javascript:void(0)" onclick="cart()">加入认捐库</a></p>
   		<div class="clear"></div>
        <div class="fenx"><a href="#"></a></div>

        <p class="pay" style="font-size: 16px;">支付方式：</p>
        <p class="" style="font-size: 16px;position: relative;left:10px;">实体图：</p>
        <?php if(($image == '1')): ?><img src="/webjlcs/Public/images/details/images/cicun1.jpg" style="width: 225px;position: relative;left: 150px;">
        <?php else: ?>
            <img src="/webjlcs/Public/images/details/image/cicun.jpg" style="width: 225px;position: relative;left: 150px;"><?php endif; ?>

    </div>
	<!-----右边------->
   <div class="rightbox">
    	<p class="name">——认捐商品</p>
       <a href="javascript:void(0);" class="ex0112" id='48184'>
           <img src="/webjlcs/Public/images/shopdetail/remai02.jpg" width="130" height="180">
           <p style="text-align: center">主梁</p>
           <p style="text-align: center">￥100000元/根</p>
       </a>
       <a href="javascript:void(0);" class="ex0112" id='48185'>
           <img src="/webjlcs/Public/images/shopdetail/remai01.jpg" width="130" height="180">
           <p style="text-align: center">次梁</p>
           <p style="text-align: center">￥80000元/根</p>
       </a>
       <a href="javascript:void(0);" class="ex0112" id='48186'>
           <img src="/webjlcs/Public/images/shopdetail/remai03.jpg" width="130" height="180">
           <p style="text-align: center">主柱</p>
           <p style="text-align: center">￥60000元/根</p>
       </a>

    </div>           
</div>
<!-----商品详情部分结束------->
<!-----商品详情评价部分-------> 
<div class="evaluate">
	<div class="classify">
        <div class="shopsee">
        	<p class="name">认捐商品</p>
        	<a href="javascript:void(0);" class="ex0112" id='48187'>
				<img src="/webjlcs/Public/images/shopdetail/see.jpg" width="170" height="245">
				<p style="text-align: center">释迦摩尼佛像</p>
				<p style="text-align: center">商城价:￥300000元/尊</p>
			</a>
			<a href="javascript:void(0);" class="ex0112" id='48188'>
				<img src="/webjlcs/Public/images/shopdetail/see1.jpg" width="170" height="245">
				<p style="text-align: center">三大士</p>
				<p style="text-align: center">商城价:￥100000元/尊</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48189'>
				<img src="/webjlcs/Public/images/shopdetail/see2.jpg" width="170" height="245">
				<p style="text-align: center">十八罗汉</p>
				<p style="text-align: center">商城价:￥100000元/尊</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48190'>
				<img src="/webjlcs/Public/images/shopdetail/see03.png" width="170" height="245">
				<p style="text-align: center">功德箱</p>
				<p style="text-align: center">商城价:￥20000元/个</p>
			</a>
			<a href="javascript:void(0);" class="ex0112" id='48191'>
				<img src="/webjlcs/Public/images/shopdetail/see04.png" width="170" height="245">
				<p style="text-align: center">供桌</p>
				<p style="text-align: center">商城价:￥80000元/张</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48192'>
				<img src="/webjlcs/Public/images/shopdetail/see5.jpg" width="170" height="245">
				<p style="text-align: center">须弥座</p>
				<p style="text-align: center">商城价:￥200000元/座</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48193'>
				<img src="/webjlcs/Public/images/shopdetail/see07.png" width="170" height="245">
				<p style="text-align: center">铜罗汉</p>
				<p style="text-align: center">商城价:￥258元</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48194'>
				<img src="/webjlcs/Public/images/renjuan/see06.png" width="170" >
				<p style="text-align: center">龙翔凤集</p>
				<p style="text-align: center">商城价:￥1888元</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48195'>
				<img src="/webjlcs/Public/images/renjuan/content_04.jpg" width="170" >
				<p style="text-align: center">云龙蒸变</p>
				<p style="text-align: center">商城价:￥998元</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48196'>
				<img src="/webjlcs/Public/images/renjuan/see08.png" width="170" >
				<p style="text-align: center">夜静澜思</p>
				<p style="text-align: center">商城价:￥518元</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48197'>
				<img src="/webjlcs/Public/images/renjuan/see09.png" width="170" >
				<p style="text-align: center">青花瓷礼盒</p>
				<p style="text-align: center">商城价:￥418元</p>
			</a>
            <a href="javascript:void(0);" class="ex0112" id='48198'>
                <img src="/webjlcs/Public/images/renjuan/see10.png" width="170" height="200">
                <p style="text-align: center">檀香长木盒210</p>
                <p style="text-align: center">商城价:￥778元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48199'>
                <img src="/webjlcs/Public/images/renjuan/see11.png" width="170" height="245">
                <p style="text-align: center">沉香长木盒210</p>
                <p style="text-align: center">商城价:￥388元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48200'>
                <img src="/webjlcs/Public/images/renjuan/see12.png" width="170" height="245">
                <p style="text-align: center">双品行禅香70</p>
                <p style="text-align: center">商城价:￥268元</p>
            </a>		
        </div>



          <div class="shopsee1">
            <p class="name">认捐商品</p>
            <a href="javascript:void(0);" class="ex0112" id='48202'>
                <img src="/webjlcs/Public/images/renjuan/see.jpg" width="170" >
                <p style="text-align: center">音高趣远</p>
                <p style="text-align: center">商城价:￥288元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48203'>
                <img src="/webjlcs/Public/images/renjuan/see1.jpg" width="170" >
                <p style="text-align: center">明镜山水</p>
                <p style="text-align: center">商城价:￥218元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48204'>
                <img src="/webjlcs/Public/images/renjuan/see2.png" width="170" >
                <p style="text-align: center">皓月禅心</p>
                <p style="text-align: center">商城价:￥188元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48205'>
                <img src="/webjlcs/Public/images/renjuan/see03.png" width="170" height="100">
                <p style="text-align: center">流云香</p>
                <p style="text-align: center">商城价:￥138元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48206'>
                <img src="/webjlcs/Public/images/renjuan/see04.png" width="170">
                <p style="text-align: center">正圆0.8单串</p>
                <p style="text-align: center">商城价:￥668元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48207'>
                <img src="/webjlcs/Public/images/renjuan/see5.png" width="170" height="250" >
                <p style="text-align: center">老山檀香筒210</p>
                <p style="text-align: center">商城价:￥618元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48208'>
                <img src="/webjlcs/Public/images/renjuan/see07.png" width="170" height="250">
                <p style="text-align: center">沉香香筒210</p>
                <p style="text-align: center">商城价:￥398元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48209'>
                <img src="/webjlcs/Public/images/renjuan/see06.jpg" width="100" >
                <p style="text-align: center">龙脑双瓷罐</p>
                <p style="text-align: center">商城价:￥618元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48210'>
                <img src="/webjlcs/Public/images/renjuan/content01.jpg" width="100" >
                <p style="text-align: center">茶叶礼盒</p>
                <p style="text-align: center">商城价:￥388元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48211'>
                <img src="/webjlcs/Public/images/renjuan/content02.png" width="130" >
                <p style="text-align: center">1.2无花</p>
                <p style="text-align: center">商城价:￥568元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48212'>
                <img src="/webjlcs/Public/images/renjuan/content03.png" width="130" >
                <p style="text-align: center">1.4瓜棱珠</p>
                <p style="text-align: center">商城价:￥398元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48213'>
                <img src="/webjlcs/Public/images/renjuan/content05.png" width="130" >
                <p style="text-align: center">1.8莲花纹珠</p>
                <p style="text-align: center">商城价:￥398元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48214'>
                <img src="/webjlcs/Public/images/renjuan/content06.png" width="130">
                <p style="text-align: center">金钱貔貅裸牌</p>
                <p style="text-align: center">商城价:￥338元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48215'>
                <img src="/webjlcs/Public/images/renjuan/content07.png" width="130" >
                <p style="text-align: center">斋戒裸牌</p>
                <p style="text-align: center">商城价:￥518元</p>
            </a>
            <a href="javascript:void(0);" class="ex0112" id='48216'>
                <img src="/webjlcs/Public/images/renjuan/content08.png" width="130" height="150" >
                <p style="text-align: center">龙脑枕（红晶版）</p>
                <p style="text-align: center">商城价:￥298元</p>
            </a>            
        </div>       
    </div>      
    <div class="tabbedPanels">
    	<ul class="tabs">
        	<li><a href="#panel01" id="test">商品详情</a></li>
       </ul>        
     <div class="panelContainer">
        <?php if(($image == '1')): ?><!--皇族宗祠-->
                <div class="panel" id="panel01">
                    <p class="sell">商品描述</p>
                    <p style="font-size: 16px;">皇族宗祠是匠造的专属家族祠堂</p>
                    <p></p>
                    <p class="sell">整体款式</p>
                    <div style="width:570px;">
                        <img src="/webjlcs/Public/images/details/image/royal.jpg" alt="皇族宗祠详情图" style="width: 100%;margin-left:30px;">  
                    </div>
                    <div class="clear"></div>
                </div>
            <?php else: ?>
                <div class="panel" id="panel01">
                   <p class="sell">商品描述</p>
                   <p style="font-size: 16px;">万佛堂是供奉万家生佛的地方</p>
                   <p></p>
                   <p class="sell">整体款式</p>
                   <div style="width:630px;">
                       <img src="/webjlcs/Public/images/details/image/floor_<?php echo ($floor); ?>.jpg" alt="楼层详情图" style="width: 100%">
                   </div>
                </div><?php endif; ?>
     </div>
     <div class="clear "></div>
    </div>
    <div class="clear "></div>
</div>
<div class="clear "></div>
<!-----商品详情评价部结束分-------> 
<!----bottom_页脚部分----->
 <div class="c">
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



	</div>
<div class="clear "></div>
<div class="suspend">
    <dl>
        <dt class="IE6PNG"></dt>
        <dd class="suspendQQ"><a href="http://wpa.qq.com/msgrd?v=3&uin=1581893936&site=qq&menu=yes" target="_blank"></a></dd>
        <dd class="suspendTel"><a href="http://wpa.qq.com/msgrd?v=3&uin=1581893936&site=qq&menu=yes" target="_blank"></a></dd>
    </dl>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $(".suspend").mouseover(function() {
            $(this).stop();
            $(this).animate({width: 160}, 400);
        })

        $(".suspend").mouseout(function() {
            $(this).stop();
            $(this).animate({width: 40}, 400);
        });

    });
</script>
</body>
    <script type="text/javascript">
        var ids = [];
        function cart(){
            var root = '/webjlcs/Home/Product/ajax_cart';
            var id=$('.ids').attr('id');

            $.post(root,{id:id},function(data){
                if(data == 1){
                    alert('您还没有登录，请登录后再购买');
                    var nowurl='/webjlcs/Home/Product/details?id=7166';
                    window.location.href = "/webjlcs/Home/User/login?url="+nowurl;
//                    $(window).attr('location','<?php echo U('User/login',array('a'=>nowurl));?>');
                }else if(data == 2){
                    alert('该商品已经存在您的认捐库了，请勿重新添加');
                    location.reload();
                }else if(data == 3){
                    alert('添加成功，请去您的认捐库查看');
                }else if(data == 4){
                    alert('加入失败，请再次添加');
                }
            })
        }

        function order(){
            var root = '/webjlcs/Home/Order/ajax_order';
            var id=$('.ids').attr('id');
            $.post(root,{id:id},function(data){
                if(data == 111){
                    window.location.href = "/webjlcs/Home/Order/index?id="+id;
                }else if(data == 1){
					alert('请登录');
                    var nowurl='/webjlcs/Home/Product/details?id=7166';
                    window.location.href = "/webjlcs/Home/User/login?url="+nowurl;
//					  $(window).attr('location','<?php echo U('User/login');?>');
				}else if(data == 222){
                    alert('该商品已经售罄');
                }
            })
        }

		$('.ex0112').click(function(){
            var ids=$(this).attr('id');
            window.location.href = "/webjlcs/Home/Product/product?id="+ids;
        })
    </script>
</html>