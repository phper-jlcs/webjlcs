<?php if (!defined('THINK_PATH')) exit();?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>主要内容区main</title>
    <link href="css/css.css" type="text/css" rel="stylesheet" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="/webjlcs/Public/images/admin/main/favicon.ico" />
    <style>
        body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
        #searchmain{ font-size:12px;}
        #search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
        #search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
        #search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
        #search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
        #search a.add{ background:url(images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
        #search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
        #main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
        #main-tab th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
        #main-tab td{ font-size:12px; line-height:40px;}
        #main-tab td a{ font-size:12px; color:#548fc9;}
        #main-tab td a:hover{color:#565656; text-decoration:underline;}
        .bordertop{ border-top:1px solid #ebebeb}
        .borderright{ border-right:1px solid #ebebeb}
        .borderbottom{ border-bottom:1px solid #ebebeb}
        .borderleft{ border-left:1px solid #ebebeb}
        .gray{ color:#dbdbdb;}
        td.fenye{ padding:10px 0 0 0; text-align:right;}
        .bggray{ background:#f9f9f9}
        .pager span {
            background: #8FC41F;
            color: #fff;
            border: 1px solid #8FC41F;
            padding: 3px 10px;
            margin-left: 8px;
        }
        .pager a {
            border: 1px solid #666666;
            padding: 3px 10px;
            margin-left: 8px;
            text-decoration: none;
            color: #333;
            outline: none;
        }
    </style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
    <tr>
        <td width="99%" align="left" valign="top">您的位置：库存统计</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="90%" align="left" valign="middle">

                        <form method="post" action="">
                            <span>商品名：</span>
                            <input type="text" name="keyword" value="<?php echo ($keyword); ?>" class="text-word" style="width: 70px;">
                            <input name="" type="submit" value="查询" class="text-but">
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top">

            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
                <tr>
                    <th align="center" valign="middle" class="borderright">商品id</th>
                    <th align="center" valign="middle" class="borderright">商品名</th>
                    <th align="center" valign="middle" class="borderright">图片</th>
                    <th align="center" valign="middle" class="borderright">库存量</th>
                    <th align="center" valign="middle" class="borderright">价格</th>
                    <th align="center" valign="middle" class="borderright">供应商</th>
                    <th align="center" valign="middle">操作</th>
                </tr>
                <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="center" valign="middle" class="borderright borderbottom"> <?php echo ($list["id"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"> <?php echo ($list["product_name"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><img src="/webjlcs/Public/<?php echo ($list["path"]); ?>" alt="" style="width: 120px;height: 80px;"></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["product_store"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["now_price"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($hand_man); ?></td>
                        <td align="center" valign="middle" class="borderbottom">
                            <a href="" target="mainFrame" onclick="return del()" class="add">编辑</a>
                            <span class="gray">&nbsp;|&nbsp;</span><a href="" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table></td>
    </tr>

    <tr>
        <td align="right" ><ul class="paginList pager"><!-- 分页显示 --><?php echo ($page); ?></ul></td>
        <!--<td align="left" valign="top" class="fenye">共<?php echo ($count); ?>条数据 1/1 页&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">尾页</a></td>-->
    </tr>
</table>
</body>
<script type="text/javascript">
</script>
</html>