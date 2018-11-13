<?php if (!defined('THINK_PATH')) exit();?><html>
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
        <td width="99%" align="left" valign="top">您的位置：查询管理| 供奉权证</td>
    </tr>
    <tr>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="90%" align="left" valign="middle">
                        <form method="post" action="<?php echo U('selectwarrant');?>">
                            <div style="position: relative;width: 200px;height: 50px;">
                                <span>供奉权证：</span>
                                <input type="text" name="warrant_number" value="" class="text-word" style="width: 120px;">
                                <input name="" type="submit" value="查询" class="text-but" style="color: white;position: relative;top:-40px;left:110px;">
                            </div>
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
                    <th align="center" valign="middle" class="borderright">供奉权证号</th>
                    <th align="center" valign="middle" class="borderright">寺庙</th>
                    <th align="center" valign="middle" class="borderright">区域</th>
                    <th align="center" valign="middle" class="borderright">殿区</th>
                    <th align="center" valign="middle" class="borderright">编号</th>
                    <th align="center" valign="middle" class="borderright">属性</th>
                    <th align="center" valign="middle" class="borderright">id</th>
                    <th align="center" valign="middle" class="borderright">认捐状况</th>
                </tr>
                <?php if(($position != '')): ?><tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["warrant_number"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["simiao"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["type"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["quyu"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["weizhi"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["typesign"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["product_id"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($position["status"]); ?></td>
                    </tr><?php endif; ?>
            </table></td>
    </tr>
    <tr>
        <td align="right" ><ul class="paginList pager"><!-- 分页显示 --><?php echo ($page); ?></ul></td>
    </tr>
</table>
</body>
</html>