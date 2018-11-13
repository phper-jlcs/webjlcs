<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <title>中国帝宫-镇海寺万佛堂-2层</title>
    <meta charset="UTF-8" />
    <meta name="description" content=""/>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.4.2.min.js"></script>
    <link rel="stylesheet" href="/webjlcs/Public/css/banner.css">
    <style type="text/css">
        *{margin:0;padding:0;list-style-type:none;}
        a,img{border:0;}
        body{font:12px/180% Arial, Helvetica, sans-serif, "宋体";}
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
</head>
<body style="overflow-x:hidden;">
<div class="zhs_wft2">
    <a href="/webjlcs/Home/Index/zhs"><img src="/webjlcs/Public/images/zhs_logo.png" style="background:filter:alpha(Opacity=80);
            -moz-opacity:0.5;
            opacity: 0.5; margin-top: 15px;"/></a>
    <div style="position:absolute;left: 250px;top:40px;"><a href="javascript:history.back(-1)" style="font-size: 24px;">返回<</a></div>
    <div  class="fumingjie tishi" style="position:absolute; top:433px; left:295px;"><a href="<?php echo U('Product/index',array('cat_id'=>13,'img'=>cc));?>"><img src='/webjlcs/Public/images/wft/zhs/fumingjie.png' class="img_fumingjie"></a></div>
    <div  class="fuguangjie" style="position:absolute; top:433px; left:668px;"><a href="<?php echo U('Product/index',array('cat_id'=>14,'img'=>dd));?>"><img src='/webjlcs/Public/images/wft/zhs/fuguangjie.png' class="img_fuguangjie"></a></div>
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
    $(".tishi").click(function(){
        alert('还未开放，请关注后续公告!福广界可认捐');
        return false;
    });
</script>
</html>