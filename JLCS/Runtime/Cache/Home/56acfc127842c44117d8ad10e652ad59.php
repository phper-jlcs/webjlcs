<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
</head>

<body>
<div style="display:flex;overflow-y: hidden;" class="xinye">
	<div style="float: left;padding-right: 20px;margin-top: 75px;">
        <ul>
            <?php if(($cat_id == '14')): ?><!--对于福广界才加这个第10层(特殊处理)-->
                <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  10层
                </li>
                <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  09层
                </li>
            <?php else: ?>
                <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  09层
                </li><?php endif; ?>

            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  08层
            </li>
            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  07层
            </li>
            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  06层
            </li>
            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  05层
            </li>
            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  03层
            </li>
            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  02层
            </li>
            <li style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 12px;-webkit-box-shadow:5px 5px 5px #B37731;text-align:center;line-height:30px;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;">
                  01层
            </li>
        </ul>
    </div>

    <?php if(is_array($data)): foreach($data as $key=>$list): ?><div style="background: #a2a2a0;color: white;font-weight: 500;height: 30px;width: 63px;margin-top: 10px;text-align:center;line-height:30px;-webkit-box-shadow:5px 5px 5px #B37731;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px;float: left;margin-right: 10px;" ><?php echo ($list["goods_name"]); ?>
            <div style="<?php if(($cat_id == '14')): ?>height: 392px;<?php else: ?>height: 350px;<?php endif; ?>width: 50px;float: left;margin-top: 20px;padding-right: 20px;background: #e9d7cb;">
            <?php if(is_array($list['Data'])): foreach($list['Data'] as $key=>$test): if(($test["danshuang"] == '单位')): ?><!--单个话就限制该div的width和margin-left，使得背景图只显示左侧的半个-->        
                    <div  class="checkdiv" style="height: 30px;width: 31.5px;margin-left:15px;margin-top: 12px;<?php if(($test["product_store"] == '0')): ?>background: url(/webjlcs/Public/images/shuang.png) no-repeat;cursor: default;<?php else: ?>background: url(/webjlcs/Public/images/hongfang.png) no-repeat;cursor: pointer;<?php endif; ?>-webkit-box-shadow:5px 5px 5px #B37731;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px; float: left;" id=<?php echo ($test["id"]); ?> title="您已选<?php echo ($test["product_name"]); ?>,确认请点击">
                    </div>
                <?php elseif($test["danshuang"] == '佛龛'): ?> 
                    <div  class="checkdiv shrines" style="height: 30px;width: 63px;margin-top: 12px;background: url(/webjlcs/Public/images/shuang.png) no-repeat;cursor: default;-webkit-box-shadow:5px 5px 5px #B37731;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px; float: left;" id=<?php echo ($test["id"]); ?> title="<?php echo ($test["product_name"]); ?>,不可认捐">
                    </div>
                <?php else: ?>  <!--正常的双位的处理-->
                    <div  class="checkdiv" style="height: 30px;width: 63px;margin-top: 12px;<?php if(($test["product_store"] == '0')): ?>background: url(/webjlcs/Public/images/shuang.png) no-repeat;cursor: default;<?php else: ?>background: url(/webjlcs/Public/images/hongfang.png) no-repeat;cursor: pointer;<?php endif; ?>-webkit-box-shadow:5px 5px 5px #B37731;-moz-box-shadow:5px 5px 5px #B37731;-moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius:8px; float: left;" id=<?php echo ($test["id"]); ?> title="您已选<?php echo ($test["product_name"]); ?>,确认请点击">
                    </div><?php endif; endforeach; endif; ?>
            </div>
        </div><?php endforeach; endif; ?>
</div>
</body>
    <script type="text/javascript">
        $('.bianse').click(function(){
            var ids=$(this).attr('id');
            var url='/webjlcs/Home/Product/ajax_check';
            $.ajax({
                type: 'POST',
                data:{id:ids},
                success: function(data){
                    if(data != ''){
                        $('.jsons').html('');
                        $('.jsons').append(data);
                    }
                }
            });
        })


        $('.checkdiv').click(function(){
            var ids=$(this).attr('id');
            if($(this).hasClass('shrines')){
                alert('佛龛不可认捐！');
            }else{  //不是佛龛的情况,这时候又分已认捐和未认捐的情况
                //跳转到认捐页面进行认捐
               // window.location.href = "/webjlcs/Home/Product/details?id="+ids;
                if($(this).css('cursor') == 'pointer'){  //该莲位未认捐的情况
                    $('.choosing-info').show();
                    $('.choosing').css('background','url(/webjlcs/Public/images/hongfang.png) no-repeat');  //把之前选中的图标的背景图进行还原
                    $('.checkdiv').removeClass('choosing');//移除之前的选中
                    $(this).addClass('choosing');  //给当前选中的加.choosing
                    $(this).css('background','url(/webjlcs/Public/images/brownhouse.png) no-repeat');  //当前图标背景图改为褐色
                    var title = $(this).attr('title');
                    <?php if(($cat_id == '14')): ?>//对福广界特殊处理，因为它的product_name与佛恩殿、佛孝殿的都不一样
                        var choose_row_col = title.substr(5,4); //包含行列信息的字符串,010907中前面的01只是佛广殿的标识而已，后面四位才是行列信息
                        if(choose_row_col){
                            var choose_col = choose_row_col.substr(0,2); //选中的列
                            var choose_row = choose_row_col.substr(2,2); //选中的行
                        }
                    <?php else: ?>
                        var choose_row_col = title.substr(3,(title.indexOf(',')-3)); //包含行列信息的字符串
                        if(choose_row_col){
                            var choose_col = choose_row_col.substr(0,choose_row_col.indexOf('-')); //选中的列
                            var choose_row = choose_row_col.substr(choose_row_col.indexOf('-')+1,2); //选中的行
                        }<?php endif; ?>
                    if(choose_row){
                        $('.choose-layer-ul li').css('background-color','#ee7e7d');
                        $('.row_'+choose_row).css('background-color','#b1a277');
                    }
                    $('.choose_row').html(choose_row);
                    $('.choose_col').html(choose_col);
                    
                }else{  //该莲位已认捐的情况，也就是库存为0
                    alert('该莲位已被认捐！');
                }
            }
        })
        $(".fokan").click(function(){
            alert('佛龛不可认捐');
            return false;
        })
    </script>
</html>