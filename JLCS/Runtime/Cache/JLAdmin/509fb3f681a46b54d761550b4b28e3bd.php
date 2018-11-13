<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="/webjlcs/Public/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/webjlcs/Public/js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(/webjlcs/Public/images/admin/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="/webjlcs/Public/images/admin/main/member.jpg" width="44" height="44" /></div>
    <span>用户：admin<br>角色：超级管理员</span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span>文章管理</span>
        <a href="<?php echo U('Article/index');?>" target="mainFrame" onFocus="this.blur()">文章列表</a>
        <a href="<?php echo U('Article/add');?>" target="mainFrame" onFocus="this.blur()">添加文章</a>
        <!-- <a href="main_info.html" target="mainFrame" onFocus="this.blur()">列表详细页</a> -->
        <!-- <a href="main_message.html" target="mainFrame" onFocus="this.blur()">留言页</a> -->
        <!-- <a href="main_menu.html" target="mainFrame" onFocus="this.blur()">栏目管理</a> -->
      </div>
        <div class="collapsed">
            <span>栏目管理</span>
            <a href="<?php echo U('Assort/index');?>" target="mainFrame" onFocus="this.blur()">栏目列表</a>
            <a href="<?php echo U('Assort/add');?>" target="mainFrame" onFocus="this.blur()">添加栏目</a>
            <!-- <a href="main_info.html" target="mainFrame" onFocus="this.blur()">列表详细页</a> -->
            <!-- <a href="main_message.html" target="mainFrame" onFocus="this.blur()">留言页</a> -->
            <!-- <a href="main_menu.html" target="mainFrame" onFocus="this.blur()">栏目管理</a> -->
        </div>
     <div>
        <span>图片管理</span>
        <a href="<?php echo U('Image/index');?>" target="mainFrame" onFocus="this.blur()">九龙宝鉴</a>
         <a href="<?php echo U('Image/down');?>" target="mainFrame" onFocus="this.blur()">下载专区</a>
         <a href="<?php echo U('Image/add');?>" target="mainFrame" onFocus="this.blur()">添加图片</a>
      </div>
        <!-- <div>
          <span>订单管理</span>
          <a href="<?php echo U('Order/index');?>" target="mainFrame" onFocus="this.blur()">查看订单</a>
         <a href="main_list.html" target="mainFrame" onFocus="this.blur()"></a>
          <a href="main_info.html" target="mainFrame" onFocus="this.blur()">角色管理</a>
          <a href="main.html" target="mainFrame" onFocus="this.blur()">自定义权限</a>
        </div>
          <div>
              <span>库存管理</span>
              <a href="<?php echo U('Store/index');?>" target="mainFrame" onFocus="this.blur()">查看库存</a>
              <a href="main_list.html" target="mainFrame" onFocus="this.blur()"></a>
              <a href="main_info.html" target="mainFrame" onFocus="this.blur()">角色管理</a>
              <a href="main.html" target="mainFrame" onFocus="this.blur()">自定义权限</a>
          </div>
          <div>
              <span>代理商管理</span>
              <a href="<?php echo U('Agent/index');?>" target="mainFrame" onFocus="this.blur()">一级代理商列表</a>
              <a href="<?php echo U('Agent/twoagent');?>" target="mainFrame" onFocus="this.blur()">二级代理商列表</a>
              <a href="<?php echo U('Agent/threeagent');?>" target="mainFrame" onFocus="this.blur()">三级代理商列表</a>
              <a href="<?php echo U('Agent/addagent');?>" target="mainFrame" onFocus="this.blur()">增加代理商</a>
            <a href="main_list.html" target="mainFrame" onFocus="this.blur()"></a>
              <a href="main_info.html" target="mainFrame" onFocus="this.blur()">角色管理</a>
              <a href="main.html" target="mainFrame" onFocus="this.blur()">自定义权限</a>
          </div>-->
    </div>
</body>
</html>