<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>中国帝宫-赠送</title>
		<link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/transfer.css" />
		<script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
		<style type="text/css">
			.checkred{
				background: red;
			}
		</style>
	</head>
	<body scroll="no" style="overflow-x:hidden;">
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
<div id="topLogo"><a href="<?php echo U('Index/jlcs');?>"><img src="/webjlcs/Public/images/logo.jpg"/></a></div>
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
<div class="ddd">
<div style="width: 1200px;margin: 0 auto;">
        <div id="ms-center" class="container">
        <div class="content">
             <div class="menu1 menu_tab">
                 <!--TAB1-->
                    <div id="tab1" class="tab active1" style="margin-top: 30px;display: block;">
                         <div class="public_m1">
                              <div class="divv">
                                  <span style="display:inline-block;font-size: 18px;color:green;margin-top:30px;margin-left: 270px;">赠送人:</span><br/>
                                  <form action="<?php echo U('dolist');?>" method="post" onsubmit="return add()">
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 居 士 姓 名: <input type="text" name="relname" id="relname" value="" style="margin-left:30px;width: 240px;height: 25px;" placeholder="请输入居士姓名"></br></div>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 联 系 电 话: <input type="text" name="phone" id="phone" value="" style="margin-left:30px;width:240px;height: 25px;" placeholder="请输入联系电话"></br></div>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 认 捐 金 额: <input type="text" name="price" id="price" value="" style="margin-left:30px;width: 240px;height: 25px;" placeholder="请输入认捐金额"></br></div>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 交 易 地 点: <input type="text" name="city" id="city" value="" style="margin-left:30px;width: 240px;height: 25px;" placeholder="请输入交易地点"></br></div>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 供 奉 权 证 号: <input type="text" name="warrant" id="warrant" value="" style="margin-left:12px;width: 240px;height: 25px;" placeholder="请输入供奉权证号"></br></div>
                                      <span style="display:inline-block;font-size: 18px;color:green;margin-top:50px;margin-left: 220px;">被赠送人:</span><br/>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 居 士 姓 名: <input type="text" name="traname" id="traname" value="" style="margin-left:30px;width: 240px;height: 25px;" placeholder="请输入居士姓名"></br></div>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 联 系 电 话: <input type="text" name="traphone" id="traphone" value="" style="margin-left:30px;width:240px;height: 25px;" placeholder="请输入联系电话"></br></div>
                                      <div style="position: relative;left:300px;font-size: 15px;color:black;font-weight: bold;margin-top: 30px;height: 20px;"> 认 捐 金 额: <input type="text" name="traprice" id="traprice" value="" style="margin-left:30px;width: 240px;height: 25px;" placeholder="请输入认捐金额"></br></div>
                                      <div><h5 style="color: #8C8C8C;margin-top: 80px;margin-left:390px;"><input type="checkbox" value="1" id="checke" checked/> 该申请提交后不可撤销</h5></div>
                                      <input type="submit" name="" class="xiugai" value="提交申请" style="width: 250px;height: 40px;font-size: 18px;border: 1px solid #efa350;border-radius: 5px;background: #efa350;color: white;position: relative;left: 350px; top:5px;"/>
                                  </form>
                              </div>
                         </div>
                    </div>
                </div>
            </div>

</div> 
        <div class="clear "></div>
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



</div>
</div>
	</body>
	<script type="text/javascript">

		$("#checke").click(function(){
			if($(this).attr('value') == 1){
				$(this).attr('value','0');
			}else{
				$(this).attr('value','1');
			}
		});

		function add(){
			var relname=document.getElementById("relname").value;
			var phone=document.getElementById("phone").value;
			var price=document.getElementById("price").value;
			var city=document.getElementById("city").value;
			var warrant=document.getElementById("warrant").value;
			var traname = document.getElementById("traname").value;
			var traphone = document.getElementById("traphone").value;
			var traprice = document.getElementById("traprice").value;
			var checke = document.getElementById("checke").value;
			var matchResult=true;
			if(relname==""||phone==""||price==""||city==""||warrant==""||traname==""||traphone==""||traprice==""){
				alert("以上信息都为必填项");
				matchResult=false;
			}else if(checke == '0'){
				alert('请勾选协议');
				matchResult=false;
			}

			return matchResult;
		}



	</script>
</html>