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