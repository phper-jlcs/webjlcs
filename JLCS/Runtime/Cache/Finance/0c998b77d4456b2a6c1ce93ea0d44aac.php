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
        <span>库存管理</span>
        <a href="<?php echo U('Store/index');?>" target="mainFrame" onFocus="this.blur()">库存统计</a>
        <a href="<?php echo U('Store/select');?>" target="mainFrame" onFocus="this.blur()">记录查询</a>
          <a href="<?php echo U('Store/add');?>" target="mainFrame" onFocus="this.blur()">添加商品</a>
          <a href="<?php echo U('Store/add_store');?>" target="mainFrame" onFocus="this.blur()">增加库存</a>
      </div>

        <div class="collapsed">
            <span>订单管理</span>
            <a href="<?php echo U('Order/index');?>" target="mainFrame" onFocus="this.blur()">订单列表</a>
        </div>

        <div class="collapsed">
            <span>财务管理</span>
            <a href="<?php echo U('Finance/in_account');?>" target="mainFrame" onFocus="this.blur()">进账记录</a>
            <a href="<?php echo U('Finance/out_account');?>" target="mainFrame" onFocus="this.blur()">出账记录</a>
            <a href="<?php echo U('Finance/other_account');?>" target="mainFrame" onFocus="this.blur()">其他账单</a>
            <a href="<?php echo U('Finance/index');?>" target="mainFrame" onFocus="this.blur()">盈利状态</a>
        </div>
    </div>
</body>
</html>