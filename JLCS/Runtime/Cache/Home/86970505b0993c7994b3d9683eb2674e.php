<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>中国帝宫-会员登录</title>
		<link rel="stylesheet" type="text/css" href="/webjlcs/Public/css/login.css">
	<link rel="stylesheet" type="text/javascript" href="/webjlcs/Public/js/jquery-1.8.3.min.js">

	</head>
	<body>
		<!-- login -->
		<div style="width: 100%;">
			<div class="top center">
				<div class="logo center">
					<a href="/webjlcs/Home/Index/index" target="_blank"><img src="/webjlcs/Public/static/images/logo.png" alt=""></a>
				</div>
			</div>
		<div>
			<form method="post" action="/webjlcs/Home/User/dologin" class="form center" onsubmit="return login()">
				<div class="login">
					<div class="login_center">
						<div class="login_top">
							<div class="left fl">会员登录</div>
							<div class="right fr">您还不是我们的会员？<a href="<?php echo U('register');?>" target="_self">立即注册</a></div>
							<div class="clear"></div>
							<div class="xian center"></div>
						</div>
						<div class="login_main center">
							<div class="username">用户名:&nbsp;<input id="userName" class="shurukuang" type="text" name="name" placeholder="请输入您的手机号或用户名" ></div>
							<div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;<input id="pwd" class="shurukuang" type="password" name="password" placeholder="请输入您的登录密码"></div>
						</div>
						<div class="checkbox icheck">
							<!--<label>
                                <input type="checkbox" name="remember" value="1"> 记住密码
                            </label>-->
						</div>
						<div class="checkbox icheck">
							<label>
								<input type="hidden" name="url" value="<?php echo ($url); ?>">
								<input type="hidden" name="zhuan" value="<?php echo ($zhuan); ?>">
								<input type="hidden" name="sign" value="<?php echo ($sign); ?>">
							</label>
						</div>
						<div class="login_submit">
							<input class="submit" type="submit" name="submit" value="立即登录">
						</div>
						<div class="login_submit">
							<a href="<?php echo U('User/activation');?>"><input class="submit" type="button" name="submit" value="在线激活"></a>
						</div>
					</div>
				</div>
			</form>

		</div>
    </div>

</body>
<script type="text/javascript">
	function login(){
		var userName=document.getElementById("userName").value;
		var pwd=document.getElementById("pwd").value;
		var matchResult=true;
		if(userName==""||pwd==""){
			alert("请确认是否有空缺项！");
			matchResult=false;
		}
		return matchResult;
	}
</script>
</html>