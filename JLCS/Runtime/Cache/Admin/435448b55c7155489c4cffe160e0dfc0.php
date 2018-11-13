<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="css/css.css" type="text/css" rel="stylesheet" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#div{border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#div th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#div td{ font-size:12px; line-height:40px;}
#div td a{ font-size:12px; color:#548fc9;}
#div td a:hover{color:#565656; text-decoration:underline;}

#div1{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#div1 th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#div1 td{ font-size:12px; line-height:40px;}
#div1 td a{ font-size:12px; color:#548fc9;}
#div1 td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：核心统计</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search"   style="cursor:pointer" onclick="isHidden('div')">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="post" action="">
	         <span style="font-size: 18px;">已售数量：<?php echo ($owns); ?>个</span>
	         </form>
         </td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table id="div" style="display: none;">
      <tr>
        <th align="center" valign="middle" class="borderright" width="20%">编号</th>
        <th align="center" valign="middle" class="borderright" width="20%">位置</th>
        <th align="center" valign="middle" class="borderright" width="20%">价格</th>
        <th align="center" valign="middle" class="borderright" width="20%">数量</th>
      </tr>
      <?php if(is_array($orders)): foreach($orders as $key=>$list): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["pri_key"]); ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["position"]); ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["order_total_price"]); ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["order_num"]); ?></td>
        </tr><?php endforeach; endif; ?>
    </table></td>
    </tr>
    
     <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search" style="cursor:pointer" onclick="isHidden('div1')">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="post" action="">
	         <span style="font-size: 18px;">销售额：<?php echo ($total); ?>元</span>
	         </form>
         </td>

  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table id="div1" style="display: none;">
      <tr>
        <th align="center" valign="middle" class="borderright" width="20%">编号</th>
        <th align="center" valign="middle" class="borderright" width="20%">位置</th>
        <th align="center" valign="middle" class="borderright" width="20%">价格</th>
        <th align="center" valign="middle" class="borderright" width="20%">数量</th>
      </tr>
      <?php if(is_array($orders)): foreach($orders as $key=>$list): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["pri_key"]); ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["position"]); ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["order_total_price"]); ?></td>
          <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["order_num"]); ?></td>
        </tr><?php endforeach; endif; ?>
    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search"   style="cursor:pointer" >
        <tr>
          <td width="90%" align="left" valign="middle">
            <form method="post" action="">
              <span style="font-size: 18px;">会员总数：<?php echo ($users); ?>人</span>
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search"   style="cursor:pointer" >
        <tr>
          <td width="90%" align="left" valign="middle">
            <form method="post" action="">
              <span style="font-size: 18px;">代理商总数：<?php echo ($agent); ?>人</span>
            </form>
          </td>

        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
<script>
    function isHidden(oDiv){
      var vDiv = document.getElementById(oDiv);
      vDiv.style.display = (vDiv.style.display == 'none')?'block':'none';
    }
  </script>
</html>