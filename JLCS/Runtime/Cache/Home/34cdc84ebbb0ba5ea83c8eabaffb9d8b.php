<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>中国帝宫-认捐库</title>
		<link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/cart.css" />
        <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
	</head>
	<body style="overflow-x:hidden;">
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
             <li><a href="/webjlcs/Home/User/register">注册</a></li><?php endif; ?>
     </ul>
 </div>
 </div>
 </div>
<!--top_end -->
<div class="nav2_ex">
<div id="topLogo"><a href="<?php echo U('Index/index1');?>"><img src="/webjlcs/Public/images/logo.jpg"/></a></div>
<div id="topMenu" >
    <a href="/webjlcs/Home/Index/index">首页</a>
    <a href="<?php echo U('Index/smjs');?>">寺庙供奉</a>
    <a href="<?php echo U('Index/smgh');?>">生命关怀</a>
    <a href="/webjlcs/Home/Index/fjzh">佛教智慧</a>
    <a href="/webjlcs/Home/User/info">个人中心</a>
    <a href="/webjlcs/Home/Transfer/index">赠送</a>
</div>
</div>
</div>
</div>
<div class="box"><a href="/webjlcs/Home/Index/index">首页</a> / <a href="">认捐库</a></div>

<div class="shopping_content">
    <div class="shopping_table">
        <?php if($status == 1): ?><div style="width=100px;height:100px;font-size: 30px;color:red;float:left;margin-left: 300px;margin-top:50px; ">您的认捐库空空的，<a href="<?php echo U('Index/jlsc_wft');?>">前去认捐吧</a></div>
            <?php else: ?>
            <input name="" type="checkbox" value="全选" id="selectAll" checked>全选
        <table border="1" bordercolor="#ebeae6" cellspacing="0" cellpadding="10" style="width: 100%; text-align: center; background: #ffffff;font-size: 15px;" class="playList">
            <tr>
                <th>图片</th>
                <th>名称</th>
                <th>位置</th>
                <th>价格</th>
                <th>数量</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($carts)): $i = 0; $__LIST__ = $carts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="playList_row">
                <td>
                    <input name="test" type="checkbox" id="<?php echo ($list["products_id"]); ?>" value="<?php echo ($list["price"]); ?>" style="float: left;margin-left: 5px;margin-top: 40px;" num="<?php echo ($list["nums"]); ?>" class="fuzhi">
                    <a href="<?php echo U('Product/details',array('id'=>$list['products_id']));?>"><img src="/webjlcs/Public/images/wft/foxiang.jpg" width="150px" height="100px"/></a>
                </td>
                <td><span><?php echo ($list["name"]); ?></span></td>
                <?php if(($list["sign"] == 1)): ?><td>
                        <div class="idcheck" id="<?php echo ($list["products_id"]); ?>">
                            <span id=""></span><span></span>
                        </div>
                        <div class="">
                            <span id="">------</span><span></span>
                        </div>
                    </td>
                    <?php else: ?>
                    <td>
                        <div class="idcheck" id="<?php echo ($list["products_id"]); ?>">
                            <span id=""><?php echo ($list["own_name"]); ?></span><span></span>
                        </div>
                        <div class="">
                            <span id=""><?php echo ($list["name"]); ?></span><span></span>
                        </div>
                    </td><?php endif; ?>

                <td>
                    <span class="span_momey" class="total1">￥<?php echo ($list["price"]); ?></span>
                </td>
                <!--判断当前购物车物品为商城商品还是莲位-->
                <?php if(($list["sign"] == 1)): ?><td>
                        <!--<button class="btn_reduce" onclick="javascript:onclick_reduce(this);">-</button>-->
                        <button class="btn_reducejian" onclick="">-</button>
                        <input class="momey_input momey_inputs" type="" name="" id="" value="<?php echo ($list["nums"]); ?>" style="width: 30px;" disabled="disabled"/>
                        <button class="btn_reducejia" onclick="" value="<?php echo ($list["product_store"]); ?>">+</button>
                        <!--<button class="btn_add" onclick="javascript:onclick_btnAdd(this);">+</button>-->
                    </td>
                    <?php else: ?>
                    <td>
                        <!--<button class="btn_reduce" onclick="javascript:onclick_reduce(this);">-</button>-->
                        <button class="btn_reduce" onclick="">-</button>
                        <input class="momey_input" type="" name="" id="" value="<?php echo ($list["nums"]); ?>" disabled="disabled" style="width: 30px;" />
                        <button class="btn_reduce" onclick="">+</button>
                        <!--<button class="btn_add" onclick="javascript:onclick_btnAdd(this);">+</button>-->
                    </td><?php endif; ?>

                <td>
                    <button class="btn_r" onclick="aClick(this,'<?php echo ($list["cat_id"]); ?>')" id=<?php echo ($list["cat_id"]); ?> onClick="return confirm('确定删除?删除后不可恢复数据');">删除</button>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
            <div class="box6">


                <a href="<?php echo U('Index/banner');?>">继续够买>></a>
                <div class="box6_list">
                    <div class="tb3_td2">已选商品 <label id="shuliang" style="color:#ff5500;font-size:14px; font-weight:bold;">0</label> 件</div>
                    <div class="tb3_td3">合计(不含运费):<span>￥</span><span style=" color:#ff5500;"><label id="zong1" style="color:#ff5500;font-size:14px; font-weight:bold;"></label></span></div>
                </div>
                <form action="<?php echo U('Order/order_post');?>" method="post" onsubmit="return Settlement() ">
                    <input id="userName" class="cartid" type="hidden" name="cartid" value="">
                    <input id="userName" class="numsid" type="hidden" name="numsid" value="">
                <input name="" type="submit" value="结算"/>
                </form>
            </div><?php endif; ?>
    </div>
</div>
<div class="clear"></div>
<div class="c">
<!--foot_start -->
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



<!--foot_end -->
</div>
</div>
	</body>
    <script type="text/javascript">
        var conts = 0;
        function aClick(obj,id){
            if (!confirm("您确认要删除吗？")) {  //判断出过来的购物车id是否为空
                return false;
            }
            var url = '/webjlcs/Home/Cart/clear_cart';
            $.ajax({
                type: "post",
                url: url,//对应的路径和action方法
                data: { "id": id },
                dataType: "json",
                beforeSend: function (XMLHttpRequest) {
                    //发送前动作
                },
                success: function (data) {  //执行成功的动作
                    if(data ==1){
                        location.reload();  //重新刷新页面
                    }else{
                        alert('系统异常，请再次删除');
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
//                    alert("状态：" + textStatus + "；出错提示：" + errorThrown);
                },
                timeout: 20000
            });
            return false;
        }


        function Settlement(){
            $(".playList input[name=test]").each(function(){
               if($(this).prop('checked')){
                   var id = $(this).attr('id');
                   var ids = ','+id;
                   var num = $(this).attr('num');
                   var nums = ','+num;
//                   $(".cartid").attr('value',id);
                   $(".cartid").val($(".cartid").val()+ids);
                   $(".numsid").val($(".numsid").val()+nums);
               }
            })

            if($(".cartid").val() == ''){
                alert('请选择您要购买的商品');
                return false;
            }
        }
        //全选 反选 全不选结算购物车数量、价格
//        $(function(){

        window.onload=reload;
        var $choose =  $(".playList input[name=test]");
        //进入页面默认全选
        if($("#selectAll").prop('checked')){
            $choose.each(function(){
                $(this).prop("checked",true);
            });
            GetCount1();
        }
        function reload(){
//            var $choose =  $(".playList input[name=test]");
            //进入页面默认全选
            if($("#selectAll").prop('checked')){
                $choose.each(function(){
                    $(this).prop("checked",true);
                });
                GetCount1();
            }
            //全选
            $("#selectAll").click(function(){
                if($(this).prop('checked')){
                    $choose.each(function(){
                        $(this).prop("checked",true);
                    });
                    GetCount1();
                }else{
                    $choose.each(function (){
                        if ($(this).attr("checked")) {
                            $(this).attr("checked", false);
                        } else {
                            $(this).attr("checked", true);
                        }
                    })
                    GetCount1();
                }
            });

            //单选
            $(".playList input[name=test]").click(function () {
                $(this).each(function(){
                    if($(this).attr("checked")){
                        GetCount();
                    }else{
                        GetCount();
                    }
                })
            });
        }



            //计算数量和价格函数
            function GetCount1() {
                var aa = 0;
                var conts=0;
                $(".playList input[name=test]").each(function () {
                    if ($(this).attr("checked")) {
                        for (var i = 0; i < $(this).length; i++) {
                            aa = parseInt(aa)+parseInt($(this).attr('num'));
                            conts = parseInt(conts)+parseInt($(this).attr('value')*$(this).attr('num'));
                        }
                    }else{
                        conts = 0;
                    }
                });

                $("#shuliang").text(aa);
                $("#zong1").html((conts).toFixed(2));
            }

            function GetCount() {
                // alert('a');
                var conts = 0;
                var aa = 0;
                $(".playList input[name=test]").each(function () {
                    if ($(this).attr("checked")) {
                        for (var i = 0; i < $(this).length; i++) {
                            aa = parseInt(aa)+parseInt($(this).attr('num'));
                            conts = parseInt(conts)+parseInt($(this).attr('value')*$(this).attr('num'));
                        }
                    }
                });

                $("#shuliang").text(aa);
                $("#zong1").html((conts).toFixed(2));
            }

//                     });


        $(".btn_reduce").click(function(){
            alert('该位置莲位仅有一个');
        })
        $(".btn_reducejian").click(function(){
            var num =$(".momey_inputs").attr('value');
            if(num == 1){
                alert('认捐数量最少为1');
            }else{
                var num = parseInt($(".momey_inputs").val()) - 1;
                $(".momey_inputs").val(num);
                //改变input =>num
                var states=$(this).next().attr('value');
                $(this).parents("tr").find(".fuzhi").attr('num',states);
                reload();
            };
        })
        $(".btn_reducejia").click(function(){
            var num =parseInt($(".momey_inputs").attr('value'));
            var store =parseInt($(this).attr('value'));
            if(num >= store){
                alert('认捐数量不能超过库存哦');
            }else{
                var num = parseInt($(".momey_inputs").val()) + 1;
                $(".momey_inputs").val(num);
                //改变input =>num
                var states=$(this).prev().attr('value');
                $(this).parents("tr").find(".fuzhi").attr('num',states);
                reload();
            };
        })
    </script>
</html>