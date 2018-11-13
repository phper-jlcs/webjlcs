<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>中国帝宫-订单页</title>
		<link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/order1.css" />
		<style>
			.content{width:80%;margin:200px auto;}
			.check{
				background: red;
			}
			.hide_box{z-index:999;filter:alpha(opacity=50);background:#666;opacity: 0.5;-moz-opacity: 0.5;left:0;top:0;height:99%;width:100%;position:fixed;display:none;}
			.shang_box{width:500px;height:460px;padding:10px;background-color:#fff;border-radius:10px;position:fixed;z-index:1000;left:50%;top:50%;margin-left:-280px;margin-top:-280px;border:1px dotted #dedede;display:none;}
			.shang_box img{border:none;border-width:0;}
			.dashang{display:block;width:100px;margin:5px auto;height:25px;line-height:25px;padding:10px;background-color:#E74851;color:#fff;text-align:center;text-decoration:none;border-radius:10px;font-weight:bold;font-size:16px;transition: all 0.3s;}
			.dashang:hover{opacity:0.8;padding:15px;font-size:18px;}
			.shang_close{float:right;display:inline-block;}
			.shang_logo{display:block;text-align:center;margin:20px auto;}
			.shang_tit{width: 100%;height: 75px;text-align: center;line-height: 66px;color: #a3a3a3;font-size: 16px;background: url('img/cy-reward-title-bg.jpg');font-family: 'Microsoft YaHei';margin-top: 7px;margin-right:2px;}
			.shang_tit p{color:#a3a3a3;text-align:center;font-size:16px;}
			.shang_payimg{width:140px;padding:10px;border:6px solid #EA5F00;margin:0 auto;border-radius:3px;height:140px;}
			.shang_payimg img{display:block;text-align:center;width:140px;height:140px; }
			.pay_explain{text-align:center;margin:10px auto;font-size:12px;color:#545454;}
			.radiobox{width: 16px;height: 16px;background: url('__PUBLIC/images/radio2.jpg');display: block;float: left;margin-top: 5px;margin-right: 14px;}
			.checked .radiobox{background:url('/webjlcs/Public/images/radio1.jpg');}
			.shang_payselect{text-align:center;margin:0 auto;margin-top:40px;cursor:pointer;height:60px;width:280px;}
			.shang_payselect .pay_item{display:inline-block;margin-right:10px;float:left;}
			.shang_info{clear:both;}
			.shang_info p,.shang_info a{color:#C3C3C3;text-align:center;font-size:12px;text-decoration:none;line-height:2em;}
			*{margin:0;padding:0;list-style-type:none;}
			a,img{border:0;}
			/* suspend */
			.suspend{width:40px;height:198px;position:fixed;top:200px;right:0;overflow:hidden;z-index:9999;}
			.suspend dl{width:120px;height:198px;border-radius:25px 0 0 25px;padding-left:40px;box-shadow:0 0 5px #e4e8ec;}
			.suspend dl dt{width:40px;height:198px;background:url(/webjlcs/Public/images/suspend.png);position:absolute;top:0;left:0;cursor:pointer;}
			.suspend dl dd.suspendQQ{width:120px;height:85px;background:#ffffff;}
			.suspend dl dd.suspendQQ a{width:120px;height:85px;display:block;background:url(/webjlcs/Public/images/suspend.png) -40px 0;overflow:hidden;}
			.suspend dl dd.suspendTel{width:120px;height:112px;background:#ffffff;border-top:1px solid #e4e8ec;}
			.suspend dl dd.suspendTel a{width:120px;height:112px;display:block;background:url(/webjlcs/Public/images/suspend.png) -40px -86px;overflow:hidden;}
			* html .suspend{position:absolute;left:expression(eval(document.documentElement.scrollRight));top:expression(eval(document.documentElement.scrollTop+200))}
		</style>
		<script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="/webjlcs/Public/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript">
			$(function() {
				var region = $("#region");
				var address = $("#address");
				var number_this = $("#number_this");
				var name = $("#name_");
				var phone = $("#phone");

				var span_momey = $(".span_momey");
				var b = 0;
				for (var i = 0; i < span_momey.length; i++) {
					b += parseFloat($(span_momey[i]).html());
				}
				var out_momey = $(".out_momey");
				out_momey.html(b);
				$(".shade_content").hide();
				$(".shade").hide();
				$(".shad_content").hide();
				$(".shad").hide();
				$('.nav_mini ul li').hover(function() {
					$(this).find('.two_nav').show(100);
				}, function() {
					$(this).find('.two_nav').hide(100);
				})
				$('.left_nav').hover(function() {
					$(this).find('.nav_mini').show(100);
				}, function() {
					$(this).find('.nav_mini').hide(100);
				})
				$('#jia').click(function() {
					$('input[name=num]').val(parseInt($('input[name=num]').val()) + 1);
				})
				$('#jian').click(function() {
					$('input[name=num]').val(parseInt($('input[name=num]').val()) - 1);
				})
				$(".add_mi_child").click(function(){
					event.stopPropagation();

					var id=$(this).attr('id');
					var url='/webjlcs/Home/Order/del_address';
					$.post(url,{id:id},function(data){
						if(data == 'a'){
							location.reload();
						}
					})
				})
				$('.add_mi').click(function() {

//					给当前选择的添加一个背景，同级的换成另外一个背景
					$(this).css('background', 'url("/webjlcs/Public/images/mail_1.jpg") no-repeat')
							.siblings('.add_mi')
							.css('background', 'url("/webjlcs/Public/images/mail.jpg") no-repeat');
					$(this).attr('ids','1').siblings('.add_mi').attr('ids','2');
//遍历所有地址div

				})
			})
			var x = Array();

			function func(a, b) {
				x[b] = a.html();
				alert(x)
				a.css('border', '2px solid #f00').siblings('.min_mx').css('border', '2px solid #ccc');
			}
			function onclick_clo() {
				var shad_content = $(".shad_content");
				var shad = $(".shad");
				if (confirm("确认关闭么?")) {
					shad_content.hide();
					shad.hide();
				}
			}

			function onclick_op() {
				$(".shad_content").show();
				$(".shad").show();
				var input_out = $(".input_style");
				for (var i = 0; i <= input_out.length; i++) {
					if ($(input_out[i]).val() != "") {
						$(input_out[i]).val("");
					}
				}
			}

			function onclick_close() {
				var shade_content = $(".shade_content");
				var shade = $(".shade");
				if (confirm("确认关闭么?")) {
					shade_content.hide();
					shade.hide();
				}
			}

			function onclick_open() {
				$(".shade_content").show();
				$(".shade").show();
				var input_out = $(".input_style");
				for (var i = 0; i <= input_out.length; i++) {
					if ($(input_out[i]).val() != "") {
						$(input_out[i]).val("");
					}
				}
			}

			function onclick_remove(r) {
				if (confirm("确认删除么！此操作不可恢复")) {
					var out_momey = $(".out_momey");
					var input_val = $(r).parent().prev().children().eq(1).val();
					var span_html = $(r).parent().prev().prev().children().html();
					var out_add = parseFloat(input_val).toFixed(2) * parseFloat(span_html).toFixed(2);
					var reduce = parseFloat(out_momey.html()).toFixed(2)- parseFloat(out_add).toFixed(2);
					console.log(parseFloat(reduce).toFixed(2));
					out_momey.text(parseFloat(reduce).toFixed(2))
					$(r).parent().parent().remove();
				}
			}

			function onclick_btnAdd(a) {
				var out_momey = $(".out_momey");
				var input_ = $(a).prev();
				var input_val = $(a).prev().val();
				var input_add = parseInt(input_val) + 1;
				input_.val(input_add);
				var btn_momey = parseFloat($(a).parent().prev().children().html());
				var out_momey_float = parseFloat(out_momey.html()) + btn_momey;
				out_momey.text(out_momey_float.toFixed(2));
			}

			function onclick_reduce(b) {
				var out_momey = $(".out_momey");
				var input_ = $(b).next();
				var input_val = $(b).next().val();
				if (input_val <= 1) {
					alert("商品个数不能小于1！")
				} else {
					var input_add = parseInt(input_val) - 1;
					input_.val(input_add);
					var btn_momey = parseFloat($(b).parent().prev().children().html());
					var out_momey_float = parseFloat(out_momey.html()) - btn_momey;
					out_momey.text(out_momey_float.toFixed(2));
				}
			}
		</script>
	</head>
	<body style="overflow-x:hidden;">
		<div id="glideDiv0">
<div id="nav2_ex" class="nav2_index">
<!--top -->
<div id="headTopBg"> 
<div id="headTop" class="w1024">
 <div class="headTopRight">
	 <ul id="nav_all">
		 <?php if($_SESSION['name']): ?><li><a href="/webjlcs/Home/User/login" ><?php echo ($_SESSION['name']); ?></a></li>
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
<div id="topLogo">
	<?php if(($biaoshi == 1)): ?><a href="<?php echo U('Index/zhs');?>">
			<img src="/webjlcs/Public/images/zhs_logo.png"/>
			<?php else: ?>
			<a href="<?php echo U('Index/jlcs');?>">
				<img src="/webjlcs/Public/images/logo.jpg"/><?php endif; ?>
	</a></div>
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
<div class="box">首页 / 购物车 / 填写订单</div>
<div class="box1"><img src="/webjlcs/Public/images/dd.jpg" /></div>
		<div class="appen">

		</div>

		<div class="Caddress" >
			<div class="open_new">
				<button class="open_btn" onclick="javascript:onclick_open();">代理商信息</button>
			</div>
			<?php if(is_array($user_infos)): $i = 0; $__LIST__ = $user_infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="add_mi" id="<?php echo ($list["id"]); ?>">
					<input type="hidden" name="idd" value="<?php echo ($list["id"]); ?>">
					<p style="text-align: right;font-size: 24px;color:red;" class="add_mi_child1" id="<?php echo ($list["id"]); ?>"></p>
					<p style="border-bottom:1px dashed #ccc;line-height:28px;" ><?php echo ($list["relname"]); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;代理编号:<?php echo ($list["agent_aid"]); ?></p>
					<p>手机号码:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($list["phone"]); ?></p>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>

		</div>
		<div style="width: 900px;height: 60px;float: left;margin-left:100px"></div>
		<div class="shopping_content">
			<div class="shopping_table">

				<?php if(($sign == 1)): ?><table border="1" bordercolor="#ebeae6" cellspacing="0" cellpadding="0" style="width: 100%; text-align: center; background: #ffffff;">
						<tr>
							<th>商品图片</th>
							<th>商品名称</th>
							<th>商品位置</th>
							<th>商品价格</th>
							<th>商品数量</th>
							<th>小计</th>
						</tr>
						<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="createnum">
								<td>
									<a href="<?php echo U('Product/details',array('id'=>$list['id']));?>"><img src="/webjlcs/Public/<?php echo ($list["path"]); ?>" width="150px" height="120px"/></a>
								</td>
								<td><span><?php echo ($list["owns"]); ?></span></td>
								<td>
									<div class="">
										<span id="">------</span><span></span>
									</div>
									<div class="order_id" id="<?php echo ($list["id"]); ?>">
										<span id=""></span><span></span>
									</div>
								</td>
								<td>
									<span class="span_momey">￥<?php echo ($list["now_price"]); ?></span>
								</td>
								<td>
									<!--<button class="btn_reduce" onclick="javascript:onclick_reduce(this);">-</button>-->
									<button class="btn_reducejian" onclick="" price="<?php echo ($list["now_price"]); ?>">-</button>
									<input class="momey_input" type="" name="" id="" value="<?php echo ($list["nums"]); ?>" disabled="disabled" />
									<button class="btn_reducejia" onclick="" value="<?php echo ($list["product_store"]); ?>" price="<?php echo ($list["now_price"]); ?>">+</button>
									<!--<button class="btn_add" onclick="javascript:onclick_btnAdd(this);">+</button>-->
								</td>
								<td>
									<!--<button class="btn_r" onclick="javascript:onclick_remove(this);">删除</button>--><span class="xiaoji">￥<?php echo ($list["now_price"]); ?></span>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>

					</table>
					<?php else: ?>
					<table border="1" bordercolor="#ebeae6" cellspacing="0" cellpadding="0" style="width: 100%; text-align: center; background: #ffffff;">
						<tr >
							<th>商品图片</th>
							<th>商品名称</th>
							<th>商品位置</th>
							<th>商品价格</th>
							<th>商品数量</th>
							<th>小计</th>
						</tr>
						<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="createnum">
								<td>
									<a href="<?php echo U('Product/details',array('id'=>$list['id']));?>"><img src="/webjlcs/Public/<?php echo ($list["path"]); ?>" width="150px" height="120px"/></a>
								</td>
								<td><span><?php echo ($list["owns"]); ?></span></td>
								<?php if(($list["sign"] == 1)): ?><td>
										<div class="">
											<span id="">------</span><span></span>
										</div>
										<div class="order_id" id="<?php echo ($list["id"]); ?>">
											<span id=""></span><span></span>
										</div>
									</td>
									<?php else: ?>
									<td>
										<div class="">
											<span id=""><?php echo ($list["own_name"]); ?></span><span></span>
										</div>
										<div class="order_id" id="<?php echo ($list["id"]); ?>">
											<span id=""></span><?php echo ($list["product_name"]); ?><span></span>
										</div>
									</td><?php endif; ?>

								<td>
									<span class="span_momey">￥<?php echo ($list["now_price"]); ?></span>
								</td>
								<?php if(($list["sign"] == 1)): ?><td>
										<!--<button class="btn_reduce" onclick="javascript:onclick_reduce(this);">-</button>-->
										<button class="btn_reducejian btn_reduce" onclick="" price="<?php echo ($list["now_price"]); ?>">-</button>
										<input class="momey_input" type="" name="" id="" value="<?php echo ($list["nums"]); ?>" disabled="disabled" />
										<button class="btn_reducejia btn_reduce" onclick="" value="<?php echo ($list["product_store"]); ?>" price="<?php echo ($list["now_price"]); ?>">+</button>
										<!--<button class="btn_add" onclick="javascript:onclick_btnAdd(this);">+</button>-->
									</td>
									<?php else: ?>
									<td>
										<!--<button class="btn_reduce" onclick="javascript:onclick_reduce(this);">-</button>-->
										<button class="btn_reduce btn_reduces" onclick="">-</button>
										<input class="momey_input" type="" name="" id="" value="<?php echo ($list["nums"]); ?>" disabled/>
										<button class="btn_reduce btn_reduces" onclick="">+</button>
										<!--<button class="btn_add" onclick="javascript:onclick_btnAdd(this);">+</button>-->
									</td><?php endif; ?>

								<td>
									<!--<button class="btn_r" onclick="javascript:onclick_remove(this);">删除</button>--><span class="xiaoji">￥<?php echo ($list["total"]); ?></span>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>

					</table><?php endif; ?>



				<div class="" style="width: 100%; text-align: right; margin-top: 20px; padding-bottom: 20px;">
					<div style="float:left;margin-left:460px;margin-top:10px;height:40px;padding-right:20px;">
						<input type="checkbox" value="0" style="cursor:pointer;" class="gouxuan">

						<button onclick="javascript:onclick_op();" >认捐声明</button>
					</div>
					<form action="<?php echo U('create_order');?>" method="post" onsubmit="return createorder()">
						<input type="hidden" name="cartid" value="<?php echo ($cartid); ?>">
						<input type="hidden" name="numsid" value="" class="numsid">
						<input type="hidden" name="id" value="" class="hide_id">
						<input type="hidden" name="num" value="" class="hide_num">
						<input type="hidden" name="addressid" value="" class="addressid">
						<!--<p><a href="javascript:void(0)" class="dashang" title="">提交订单</a></p>-->
						<input type="submit" value="提交订单" style="display:block;width:150px;margin:5px auto;height:40px;line-height:25px;padding:10px;background-color:#E74851;color:#fff;text-align:center;text-decoration:none;border-radius:10px;font-weight:bold;font-size:16px;transition: all 0.3s;cursor: pointer;">
					</form>
					<!--<p><a href="javascript:void(0)" onClick="dashangToggle()" class="dashang" title="">支付</a></p>-->

					<div class="hide_box"></div>
					<div class="shang_box">

						<img class="shang_logo" src="/webjlcs/Public/images/logos.png" alt="金林苑" />
						<div class="shang_tit">
							<p>感谢您的支持，我会继续努力的!</p>
						</div>
						<div class="shang_payimg">
							<img src="/webjlcs/Public/images/alipayimg.jpg" alt="扫码支持" title="扫一扫" />
						</div>
						<div class="pay_explain">扫码支付</div>
						<div class="shang_payselect">
							<div class="pay_item checked" data-id="alipay">
								<span class="radiobox"></span>
								<span class="pay_logo"><img src="/webjlcs/Public/images/alipay.jpg" alt="支付宝" /></span>
							</div>
							<div class="pay_item" data-id="weipay">
								<span class="radiobox"></span>
								<span class="pay_logo"><img src="/webjlcs/Public/images/wechat.jpg" alt="微信" /></span>
							</div>

						</div>
						<div class="shang_info">
							<p>打开<span id="shang_pay_txt">支付宝</span>扫一扫，即可进行扫码支付哦</p>
							<p>Powered by <a href="" target="_blank" title="通则久">通则久</a>，分享从这里开始，精彩与您同在</p>
						</div>
					</div>
					<!--<button class="btn_closing">结算</button>-->
				</div>
			</div>
		</div>

		<div class="shade">
		</div>

		<div class="shade_content">
			<div class="col-xs-12 shade_colse">
				<button onclick="javascript:onclick_close();">x</button>
			</div>
			<div class="nav shade_content_div">
				<div class="col-xs-12 shade_title">
					添加代理商信息
				</div>
				<div class="col-xs-12 shade_from">
					<form action="" method="post" id="saveReportForm" onsubmit="return saveReport()">
						<div class="col-xs-12">
							<span class="span_style" id="">代理商名</span>
							<input class="input_style" type="" name="address" id="agentname" value="" placeholder="&nbsp;&nbsp;请输入您的代理顾问名字" />
						</div>
						<div class="col-xs-12">
							<span class="span_style" id="">代理编号</span>
							<input class="input_style" type="" name="agent_aid" id="agent_aid" value="<?php echo ($agent["agent_aid"]); ?>" placeholder="&nbsp;&nbsp;请输入您的代理顾问编号" />
						</div>
						<div class="col-xs-12">
							<input class="btn_remove" type="button" id="" onclick="javascript:onclick_close();" value="取消" />
							<input type="button" class="sub_set" id="sub_setID" value="提交" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="shad"></div>
		<div class="shad_content">
			<div class="col-xs-12 shad_colse">
				<button onclick="javascript:onclick_clo();">x</button>
			</div>
			<div class="shad_content_div">
				<h3 style="text-align: center;">九龙寺万佛堂佛像位认捐声明</h3>
				<div class="shad_div">
					<p>根据广大信教群众的要求，九龙禅寺在寺内建筑清净庄严的万佛堂，用于供奉装藏“种生基佛像位”。现就九龙禅寺万佛堂佛像位认捐事宜郑重声明如下：</p>
					<p>一、由于九龙禅寺是佛教活动场所，认捐人必须严格遵守国家法律法规和有关佛教戒律以及宗教仪式的相关规定和要求。具体包括但不限以下内容：</p>
					<p>1.认捐人的意向和认捐行为必须是认捐人的自愿行为，是认捐人的真实意思表示；</p>
					<p>2.认捐人或捐赠人必须是具有完全民事行为能力的自然人；</p>
					<p>3.认捐或捐赠的善款必须是合法方式取得的；</p>
					<p>二、凡在本寺供奉佛像位的，费用一次性缴纳，后期维护管理费二十年免费；认捐人交清认捐费用后将获得本寺颁发的供奉权证及认捐缴费收据各一份。认捐人在获得本寺颁发的供奉权证后，即获得该佛像位，该佛像位为永久安放供奉使用。</p>
					<p>三、凡获得九龙禅寺颁发的供奉权证并已在本寺供奉佛像位的供奉人及其亲属自愿向本寺提出退供或迁出佛像位的，必须凭本寺颁发的供奉权证及身份证至本寺客堂办理相关退供或迁出手续，原供奉的佛像位作自动放弃处理，且本寺不退付任何费用。</p>
					<p>四、供奉人及其亲属不得私自将佛像位转让或赠送，如须转让或转赠佛像位，必须凭本寺颁发的供奉权证及身份证至本寺客堂申请办理转让或转赠登记手续并第一次转让或转赠免费，第二次转让或转赠收取10%管理费，如发现有私自转让或赠送佛像位的，本寺有权无条件收回私自转让或赠送的佛像位。</p>
					<p>五、本寺每逢农历初一、十五日及每年举行的法会活动皆为万佛堂内供奉者举行上供加持仪式。</p>
					<p>六、为了本寺及万佛堂的防火安全，供奉人及其家属供奉时禁止在万佛堂内使用明火、香烛等不安全供奉行为，本寺将为供奉人及其家属提供指定地方供奉。</p>
					<p>七、如果认捐认的联系方式发生变更，应在一个月内通知本寺，否则以上述联系地址电话、传真所发出的信件、通知、传真视为传达；</p>
					<p>八、本声明一式两份，声明人与认捐人各执一份，经双方签字盖章确认后生效。</p>
					<p>特此声明:</p>
					<p style="display:inline-block;margin-left:150px;">声明人（盖章）：常州孟河镇小河小黄山九龙禅寺</p>
				</div>
			</div>
		</div>
		<div class="c">
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
            margin:0 auto;
            
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
        	width: 700px;
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



		</div>
		<div class="suspend">
			<dl>
				<dt class="IE6PNG"></dt>
				<dd class="suspendQQ"><a href="http://wpa.qq.com/msgrd?v=3&uin=1581893936&site=qq&menu=yes" target="_blank"></a></dd>
				<dd class="suspendTel"><a href="http://wpa.qq.com/msgrd?v=3&uin=1581893936&site=qq&menu=yes" target="_blank"></a></dd>
			</dl>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){

				$(".suspend").mouseover(function() {
					$(this).stop();
					$(this).animate({width: 160}, 400);
				})

				$(".suspend").mouseout(function() {
					$(this).stop();
					$(this).animate({width: 40}, 400);
				});

			});
		</script>

	</body>
	<script type="text/javascript">

		$(".sub_set").click(function(){
			var agentname=$("#agentname").val();
			var relname=$("#relname").val();
			var phone=$("#phone").val();
			var agent_aid=$("#agent_aid").val();
			var ccid=$("#ccid").val();
			if(agentname=="" ||relname==""||phone== ""||agent_aid== ""||ccid==''){
				alert('以下信息都为必填项');
				var mare = false;
			}else{
				$.ajax({
					url:"/webjlcs/Home/Order/add_info",
					type:"post",
					data:{agentname:agentname,relname:relname,phone:phone,agent_aid:agent_aid,ccid:ccid},
					success:function(data){
						if(data == 'a'){
							var shade_content = $(".shade_content");
							var shade = $(".shade");
							shade_content.hide();
							shade.hide();
							location.reload();
						}else if(data == 'c'){
							alert('当前代理商不存在!');
						}else if(data == 'd'){
							//加上手机验证后不存在这种情况
							alert('请您去个人中心完善个人信息!');
						}
						else{
							alert("您未有所更改!");
						}
					},
				});

			}

		})

		$(".gouxuan").click(function(){
			if($(this).val() == 0){
				$(this).attr('value','1');
			}else{
				$(this).attr('value','0');
			}

		})

		function createorder(){
					if($('.Caddress .add_mi').attr('style')){
						if($(".gouxuan").val() == '0'){
							alert('请勾选认捐声明');
							return false;
						}
						//获取从立即购买点过来的id
						var id=window.location.search;
						var str1 = id.replace('?id=', '');
						var num = $(".momey_input").val();
						$(".hide_id").val(str1);
						$(".hide_num").val(num);
						$(".add_mi").each(function(i,dom){
							if($(this).attr('ids') == '1'){
								var id = $(this).attr('id');
								$(".addressid").val(id);
							}
						})

						//生成购物车过来的num
						$(".createnum").each(function(){
							var num =$(this).find('.momey_input').attr('value');
							var nums = ','+num;
							$(".numsid").val($(".numsid").val()+nums);
						})
					}else{
						alert('请选择您的个人信息');
						return false;
					}
				}

		$(".btn_reduces").click(function(){
			alert('当前位置莲位仅有一个');
		})
		$(".btn_reducejian").click(function(){
			var num =$(".momey_input").attr('value');
			if(num == 1){
				alert('认捐数量最少为1');
			}else{
				var num = parseInt($(".momey_input").val()) - 1;
//				$(".momey_input").val(num);
				$(this).next().attr('value',num);
				var num = $(this).next().attr('value');
				var total = parseInt(num)*parseInt($(this).attr('price'));
				$(this).parents('tr').find('.xiaoji').html('￥'+total);
			};
		})
		$(".btn_reducejia").click(function(){
			var num =parseInt($(".momey_input").attr('value'));
			var store =parseInt($(this).attr('value'));
			if(num >= store){
				alert('认捐数量不能超过库存哦');
			}else{
				var num = parseInt($(".momey_input").val()) + 1;
				$(this).prev().attr('value',num);
				var num = $(this).prev().attr('value');
				var total = parseInt(num)*parseInt($(this).attr('price'));
				$(this).parents('tr').find('.xiaoji').html('￥'+total);
			};
		})

	</script>
</html>