<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
  <title>通则久后台登录</title>
  <link href="/webjlcs/Public/css/alogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1"  action="<?php echo U('dologin');?>" method="post" onsubmit="return check()">
  <div class="Main">
    <ul>
      <li class="top"></li>
      <li class="top2"></li>
      <li class="topA"></li>
      <li class="topB"><span>
                <img src="/webjlcs/Public/images/admin/login/logo.gif" alt="" style="" />
            </span></li>
      <li class="topC"></li>
      <li class="topD">
        <ul class="login">
          <li><span class="left">用户名</span> <span style="left">
                        <input id="Text1" type="text" class="txt" name="name" placeholder="请输入您的用户名"/>

                    </span></li>
          </br>
          <li><span class="left">密码</span> <span style="left">
                       <input id="Text2" type="password" class="txt" name="pwd" placeholder="请输入您的密码"/>
                    </span></li>

          <li>
          </li>

        </ul>
      </li>
      <li class="topE"></li>
      <li class="middle_A"></li>
      <li class="middle_B"></li>
      <li class="middle_C">
            <span class="btn">
                <!--<img alt="" src="/webjlcs/Public/images/admin/login/btnlogin.gif" />-->
                <input type="submit" value="登录" style="width: 100px;height: 40px;background: #214781;border: 1px solid #214781;cursor: pointer;color:#fff;font-size: 18px;"">
            </span>
      </li>
      <li class="middle_D">
          <span style="position: relative;left:-300px;">
            <a href="">寺庙官网后台管理</a>
          </span>
      </li>
      <li class="bottom_A"></li>
    </ul>
      <a href="<?php echo U('JLAdmin/Index/index');?>" style="font-size: 20px;font-weight: 600;color:white;position: relative;left: 68px;text-decoration: none;">寺庙官网后台管理系统</a>&nbsp;&nbsp;&nbsp;||
      <a href="<?php echo U('WapAdmin/Index/index');?>" style="font-size: 20px;font-weight: 600;color:white;position: relative;left: 68px;text-decoration: none;">微信商城后台管理系统</a>&nbsp;&nbsp;&nbsp;||
      <a href="<?php echo U('Adminagent/Index/index');?>" style="font-size: 20px;font-weight: 600;color:white;position: relative;left: 68px;text-decoration: none;">代理商后台管理系统</a>&nbsp;&nbsp;&nbsp;||
      <a href="<?php echo U('Finance/Index/index');?>" style="font-size: 20px;font-weight: 600;color:white;position: relative;left: 68px;text-decoration: none;">财务后台管理系统</a>&nbsp;&nbsp;&nbsp;||
  </div>
</form>
</body>
<script type="text/javascript">
    function check(){
        var name = document.getElementById('Text1').value;
        var pwd = document.getElementById('Text2').value;
        var matchResult=true;
        if(name == ""||pwd == ""){
            alert('以上内容不能为空');
            matchResult=false;
        }
        return matchResult;
    }
</script>
</html>