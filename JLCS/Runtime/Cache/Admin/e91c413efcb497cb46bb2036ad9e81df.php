<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>主要内容区main</title>
    <link href="css/css.css" type="text/css" rel="stylesheet" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="/webjlcs/Public/images/admin/main/favicon.ico" />
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
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
        .pager{margin-left: 650px;}
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
        <td width="99%" align="left" valign="top">您的位置：订单管理:&nbsp;&nbsp;&nbsp;
            <select name="pay_status" id="pay_status" onchange="temples()">
                <option value="3">全部订单</option>
                <option value="1">已付款</option>
                <option value="0">未支付</option>
            </select>
        </td>
    </tr>
    <tr class="afterall">
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
                <tr>
                    <td width="40%"  valign="middle">

                        <form method="post" action="<?php echo U('select',array('cat'=>'order'));?>">
                            <div style="position: relative;width: 200px;height: 50px;">
                                <span>订单号：</span>
                                <input type="text" name="keyword" value="<?php echo ($keyword1); ?>" class="text-word" style="width: 120px;">
                                <input name="" type="submit" value="查询" class="text-but" style="color: white;position: relative;top:-40px;left:110px;">
                            </div>
                        </form>

                    </td>
                    <td width="40%"  valign="middle">

                        <form method="post" action="<?php echo U('select',array('cat'=>'phone'));?>">
                            <div style="position: relative;width: 200px;height: 50px;">
                                <span>手机号：</span>
                                <input type="text" name="keyword" value="<?php echo ($keyword2); ?>" class="text-word" style="width: 120px;">
                                <input name="" type="submit" value="查询" class="text-but" style="color: white;position: relative;top:-40px;left:110px;">
                            </div>
                        </form>

                    </td>
                    <td width="30%"  valign="middle">

                        <form method="post" action="<?php echo U('select',array('cat'=>'cid'));?>">
                            <div style="position: relative;width: 200px;height: 50px;">
                                <span>协议编号：</span>
                                <input type="text" name="keyword" value="<?php echo ($keyword3); ?>" class="text-word" style="width: 120px;">
                                <input name="" type="submit" value="查询" class="text-but" style="color: white;position: relative;top:-40px;left:110px;">
                            </div>
                        </form>

                    </td>
                    <div style="position: relative;top:-20px;left: 700px;"><a href="javascript:put_out();" class="add fb J_showdialog"><em>选中要导出的订单</em></a></div>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="shanchu">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
            <thead class="beitianjia">
            <tr>
                <th width="5%"><input type="checkbox" id="check_all" onclick="change_all()"/></th>
                <th align="center" valign="middle" class="borderright">订单号</th>
                <th align="center" valign="middle" class="borderright">会员名</th>
                <th align="center" valign="middle" class="borderright">会员卡号</th>
                <th align="center" valign="middle" class="borderright">供奉权证号</th>
                <th align="center" valign="middle" class="borderright">
                    总价</th>
                <th align="center" valign="middle" class="borderright">
                    状态</th>
                <th align="center" valign="middle" class="borderright">
                    数量</th>
                <th align="center" valign="middle" class="borderright">下单时间</th>
                <th align="center" valign="middle" class="borderright">管理费时间（倒计时）</th>
                <th align="center" valign="middle" class="borderright">代理商</th>
                <th align="center" valign="middle">操作</th>
            </tr>
            </thead>

                <tbody id="clearbody">
                <?php if(is_array($orders)): foreach($orders as $key=>$list): ?><tr id="order<?php echo ($list["id"]); ?>" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
                        <td align="center"><input type="checkbox" class="checkboxa" value="<?php echo ($list["id"]); ?>"/></td>
                        <td align="center" valign="middle" class="borderright borderbottom"> <?php echo ($list["order_id"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["name"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["user_cartid"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom">
                            <?php if(is_array($list["warrants"])): foreach($list["warrants"] as $key=>$test): echo ($test); endforeach; endif; ?>
                        </td>
                        <td align="center" valign="middle" class="borderright borderbottom"> <?php echo ($list["order_total_price"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom">
                            <?php if($list['status'] == 0): ?><span style="color:red;font-size: 18px;">未付款</span>
                                <?php elseif($list['status'] == 1): ?>
                                <span style="color:blue;">已付款</span>
                                <?php else: ?>
                                <span style="color:green;">已收货</span><?php endif; ?>
                        </td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["order_num"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["createtime"]); ?></td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["count_down"]); ?>天</td>
                        <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($list["agent_aid"]); ?></td>
                        <td align="center" valign="middle" class="borderbottom">
                            <a href="<?php echo U(edit,array('id'=>$list['id']));?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a>
                            <span class="gray">&nbsp;|&nbsp;</span>
                            <a href="<?php echo U('del_wuxiao',array('id'=>$list['id'] ));?>" target="mainFrame" onFocus="this.blur()" class="add" onClick="return confirm('确定作废?作废后不再显示');">作废无效订单</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>

        </table>
    </tr>

    <tr class="pagers">
        <!--<td align="right" ><ul class="paginList pager"><?php echo ($page); ?></ul></td>-->
        <!--<td align="left" valign="top" class="fenye">共<?php echo ($count); ?>条数据 1/1 页&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">尾页</a></td>-->
    </tr>
</table>
</body>
<script type="text/javascript">
    //全选反选
    function change_all() {
        if($('#check_all').attr('checked') == 'checked'){
            $('input[type="checkbox"]').attr('checked','checked');
        }else{
            $('input[type="checkbox"]').attr('checked',false);
        }
    }


    //选中导出的订单
    function put_out() {
        var all = $('tbody input[type="checkbox"]:checked');
//        var all = $(".checkboxa");
        if(all.length != 0) {
            //声明变量接受选中订单id
            var id_str = '';
            all.each(function(k,v) {
                id_str += $(v).val()+',';
            })
            window.location.href="<?php echo U('Inout/export');?>?id_str="+id_str;
        }else {
            alert('请选中你要导出的订单');
        }
    }
    function temples(){
        var templeid = document.getElementById('pay_status').value;
        var url= '/webjlcs/Admin/Order/select_order';
        var txt1="<tbody class='clearbody'>11111111</tbody>";
        var txt1="<tr class='clearalls'>11111111</tr>";
        $.post(url,{id:templeid},function(data){
            if(data != ''){
                $("#main-tab").remove();
                $(".shanchu").append(data);
            }else{
                alert('当前查询无结果');
                $("#main-tab").remove();
                $(".shanchu").append(data);
            }
        })
    }
</script>
</html>