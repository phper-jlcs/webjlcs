<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>中国帝宫-列表</title>
    <link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/product.css" />
    <link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/product1.css" />
    <link type="text/css" rel="stylesheet" href="/webjlcs/Public/css/product2.css" />
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
    <script src="/webjlcs/Public/js/jquery-1.9.1.min.js"></script>
    <script src="/webjlcs/Public/js/common.js"></script>
</head>
<style>
    .bianse2
    {
        background:#FBF49A;
    }
    .bianse1{
        background: blue;
    }
    .huise {
        cursor: not-allowed;
        background-color: #cccccc;
    }
    .check{
        background: #8E542E;
    }
    .bianse3{
        background: red;
    }
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

    .choosing-info{display: none}
    /*.tips{text-align: right;margin-top: 58px;font-size:24px;margin-right:70px;}*/
    .tips{text-align: right;margin-top: 30px;font-size:24px;margin-right:70px;}
    .choose-layer-ul{margin-top:20px;margin-bottom: 50px;height: 40px;}
    .choose-layer-ul li:last-child{margin-right: 0;}
    <?php if($img == 'dd'): ?>.jsons_show{height:438px;width:1100px;float:left;display: block;}
        .choose-layer-ul li{float:left;width:90px;height:40px;text-align:center;line-height:40px;background-color: #ee7e7d;color:#FFF;margin-right: 40.75px;cursor:pointer;}
    <?php else: ?>
        .jsons_show{height:400px;width:1100px;float:left;display: block;}
        .choose-layer-ul li{float:left;width:100px;height:40px;text-align:center;line-height:40px;background-color: #ee7e7d;color:#FFF;margin-right: 37px;cursor:pointer;}<?php endif; ?>
    .c .subscripti-position{text-align: center;font-size: 24px;}
    .operate{text-align: right;margin-top: 52px;margin-right:40px;}
    input[name="add-cart"]{width:200px;height:80px;font-size: 28px;text-align: center;color:#FFF;background-color:#e04040;border:0px;cursor: pointer}
    input[name="subscripti"]{width:200px;height:80px;font-size: 28px;text-align: center;color:#FFF;background-color:#d4bc76;border:0px;cursor: pointer}
</style>


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
                            <li><a href="/webjlcs/Home/User/register">注册</a></li>
                            <li><a href="/webjlcs/Home/User/activation" >激活</a></li><?php endif; ?>
                        <!--<li><a href="">在线留言</a></li>
                        <li><a href="">联系我们</a></li>-->
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="clean"></div>
        <div class="nav2_ex">
            <div id="topLogo"><a href="/webjlcs/Home/Index/index1">
                    <?php if(($biaoshi == 1)): ?><img src="/webjlcs/Public/images/zhs_logo.png"/>
                        <?php else: ?>
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
            <div class="clear"></div>
        </div>
    </div>
</div>
<!--top_end -->
<!-- banner start -->
<div class="c">
    <div>
    <img src="/webjlcs/Public/images/banner.jpg"  style="width: 100%;"/>
</div>
<div class="banner" style="margin-top: -170px;">
    <div class="banner_head"></div>
        <div class="cat_id" id="<?php echo ($cat_id); ?>"></div>
        <div id="main" style="margin-top:160px">
            <h2 class="top_title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;万佛堂
                <?php if(($cat_id == 2)): ?>佛孝殿
                <?php elseif(($cat_id == 1)): ?>
                    佛恩殿
                    <?php else: endif; ?>
                平面示意图:</h2>
            <div class="demo" style="float: left;">

                <?php if(($img == 'a')): ?><div style="float: left;" class="checked">
                        <img  src="/webjlcs/Public/images/foena.png" style="float:left;margin:10px;width: 1000px;">
                        <a href="#test"><div class="white_content1-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-s white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content1-t white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'b')): ?>
                        <div style="float: left;" class="checked">
                            <img src="/webjlcs/Public/images/foenb.png" style="float:left;margin:10px;width: 1000px;">
                            <a href="#test"><div class="white_content1-aa white_content" id="aa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-bb white_content" id="bb" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-cc white_content" id="cc" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-dd white_content" id="dd" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-ee white_content" id="ee" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-ff white_content" id="ff" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-gg white_content" id="gg" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-hh white_content" id="hh" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-ii white_content" id="ii" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-jj white_content" id="jj" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-kk white_content" id="kk" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-ll white_content" id="ll" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-mm white_content" id="mm" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-nn white_content" id="nn" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-oo white_content" id="oo" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-pp white_content" id="pp" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-qq white_content" id="qq" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-rr white_content" id="rr" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-ss white_content" id="ss" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-tt white_content" id="tt" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-uu white_content" id="uu" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-vv white_content" id="vv" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                            <a href="#test"><div class="white_content1-ww white_content" id="ww" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        </div>
                    <?php elseif(($img == 'c')): ?>
                    <div style="float: left;" class="checked">
                        <img src="/webjlcs/Public/images/foxiaoa.png" style="float:left;margin:10px;width: 1000px;">
                        <a href="#test"><div class="white_content-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div>
                        </a>
                        <a href="#test"><div class="white_content-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-s white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-t white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>

                    </div>
                    <?php elseif(($img == 'd')): ?>
                    <div style="float: left;" class="checked">
                        <img src="/webjlcs/Public/images/foxiaob.png" style="float:left;margin:10px;width: 1000px;">
                        <a href="#test"><div class="white_content-aa white_content" id="aa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-bb white_content" id="bb" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-cc white_content" id="cc" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-dd white_content" id="dd" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-ee white_content" id="ee" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-ff white_content" id="ff" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-gg white_content" id="gg" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-hh white_content" id="hh" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-ii white_content" id="ii" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-jj white_content" id="jj" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-kk white_content" id="kk" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-ll white_content" id="ll" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-mm white_content" id="mm" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-nn white_content" id="nn" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-oo white_content" id="oo" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-pp white_content" id="pp" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-qq white_content" id="qq" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-rr white_content" id="rr" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-ss white_content" id="ss" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-tt white_content" id="tt" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-uu white_content" id="uu" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-vv white_content" id="vv" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-ww white_content" id="ww" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-xx white_content" id="xx" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content-yy white_content" id="yy" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'e')): ?>
                    <div class="checked">
                        <img src="/webjlcs/Public/images/foyua.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content2-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-s white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-t white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-u white_content" id="u" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-v white_content" id="v" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-w white_content" id="w" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-x white_content" id="x" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-y white_content" id="y" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-z white_content" id="z" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a1 white_content" id="a1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a2 white_content" id="a2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a3 white_content" id="a3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a4 white_content" id="a4" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a5 white_content" id="a5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a6 white_content" id="a6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a7 white_content" id="a7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a8 white_content" id="a8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a9 white_content" id="a9" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-a10 white_content" id="a10" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'f')): ?>
                     <div class="checked">
                         <img src="/webjlcs/Public/images/foyub.jpg" style="float:left;margin:10px;">
                         <a href="#test"><div class="white_content2-aa white_content" id="aa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-bb white_content" id="bb" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-cc white_content" id="cc" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-dd white_content" id="dd" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-ee white_content" id="ee" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-ff white_content" id="ff" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-gg white_content" id="gg" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-hh white_content" id="hh" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-ii white_content" id="ii" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-jj white_content" id="jj" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-kk white_content" id="kk" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-ll white_content" id="ll" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-mm white_content" id="mm" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-nn white_content" id="nn" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-oo white_content" id="oo" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-pp white_content" id="pp" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-qq white_content" id="qq" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-rr white_content" id="rr" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-ss white_content" id="ss" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-tt white_content" id="tt" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-uu white_content" id="uu" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-vv white_content" id="vv" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-ww white_content" id="ww" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-xx white_content" id="xx" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-yy white_content" id="yy" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-zz white_content" id="zz" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                         <a href="#test"><div class="white_content2-aa1 white_content" id="aa1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>

                     </div>
                    <?php elseif(($img == 'g')): ?>
                    <div class="checked">
                        <img src="/webjlcs/Public/images/foyuc.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content2-aaa white_content" id="aaa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-bbb white_content" id="bbb" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-ccc white_content" id="ccc" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-ddd white_content" id="ddd" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-eee white_content" id="eee" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-fff white_content" id="fff" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-ggg white_content" id="ggg" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-hhh white_content" id="hhh" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-iii white_content" id="iii" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-jjj white_content" id="jjj" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-kkk white_content" id="kkk" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-lll white_content" id="lll" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-mmm white_content" id="mmm" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-nnn white_content" id="nnn" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-ooo white_content" id="ooo" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-ppp white_content" id="ppp" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-qqq white_content" id="qqq" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-rrr white_content" id="rrr" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-sss white_content" id="sss" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-ttt white_content" id="ttt" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-uuu white_content" id="uuu" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-vvv white_content" id="vvv" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content2-www white_content" id="www" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>

                    </div>

                    <?php elseif(($img == 'h')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/frda.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content3-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content3-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>

                    <?php elseif(($img == 'i')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/frdb.jpg" style="float:left;margin:10px;">
                         <a href="#test"><div class="white_content4-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content4-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>

                    <?php elseif(($img == 'j')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/frdc.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content5-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content5-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'k')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fgda.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content6-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content6-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'l')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fgdb.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content7-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content7-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'm')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fgdc.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content8-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class=" white_content8-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 's')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fzda.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content8-aa white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ba white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ca white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-da white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ea white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-fa white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ga white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ha white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ia white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ja white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ka white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-la white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ma white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-na white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-oa white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-pa white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-az white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ab white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ac white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ad white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ae white_content" id="u" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-af white_content" id="v" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ag white_content" id="w" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ah white_content" id="x" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ai white_content" id="y" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-aj white_content" id="z" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content8-ak white_content" id="aa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 't')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fzdb.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content9-aa white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ba white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ca white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-da white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ea white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-fa white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ga white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ha white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ia white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ja white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ka white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-la white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content9-ma white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'u')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fzdc.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content10-aa white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ba white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ca white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-da white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ea white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-fa white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ga white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ha white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ia white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ja white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ka white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-la white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ma white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-na white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-oa white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-pa white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-az white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ab white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ac white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ad white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ae white_content" id="u" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-af white_content" id="v" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ag white_content" id="w" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ah white_content" id="x" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ai white_content" id="y" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-aj white_content" id="z" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content10-ak white_content" id="aa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'v')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fzdd.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content11-aa white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ba white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ca white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-da white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ea white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-fa white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ga white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ha white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ia white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ja white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ka white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-la white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-ma white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-na white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content11-oa white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>

                    <?php elseif(($img == 'w')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/flda.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content12-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-s white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-t white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-u white_content" id="u" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-v white_content" id="v" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-w white_content" id="w" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-x white_content" id="x" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-y white_content" id="y" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-z white_content" id="z" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-a1 white_content" id="a1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-a2 white_content" id="a2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-a3 white_content" id="a3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-a4 white_content" id="a4" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-a5 white_content" id="a5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content12-a6 white_content" id="a6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'x')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fldb.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content13-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content13-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'y')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fldc.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content14-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-s white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-t white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-u white_content" id="u" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-v white_content" id="v" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-w white_content" id="w" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-x white_content" id="x" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-y white_content" id="y" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-z white_content" id="z" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a1 white_content" id="a1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a2 white_content" id="a2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a3 white_content" id="a3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a4 white_content" id="a4" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a5 white_content" id="a5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a6 white_content" id="a6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a7 white_content" id="a7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a8 white_content" id="a8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a9 white_content" id="a9" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a10 white_content" id="a10" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a11 white_content" id="a11" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content14-a12 white_content" id="a12" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'z')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fldd.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content15-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content15-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'aa')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fujijie.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content16-a white_content" id="2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-b white_content" id="1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-c white_content" id="3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-d white_content" id="5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-e white_content" id="6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-f white_content" id="7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-g white_content" id="8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-h white_content" id="9" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-i white_content" id="10" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-j white_content" id="11" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-k white_content" id="12" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-l white_content" id="13" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-m white_content" id="15" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-n white_content" id="16" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-o white_content" id="17" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-p white_content" id="18" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-q white_content" id="19" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-r white_content" id="20" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-s white_content" id="21" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-t white_content" id="22" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-u white_content" id="23" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-v white_content" id="25" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-w white_content" id="26" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-x white_content" id="27" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-y white_content" id="28" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-z white_content" id="29" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a1 white_content" id="30" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-aa white_content" id="31" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-bb white_content" id="32" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-cc white_content" id="33" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-dd white_content" id="53" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-ee white_content" id="52" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-ff white_content" id="ff" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-gg white_content" id="50" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-hh white_content" id="39" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-ii white_content" id="38" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-jj white_content" id="37" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-kk white_content" id="36" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-ll white_content" id="35" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-mm white_content" id="75" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-nn white_content" id="73" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-oo white_content" id="72" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-pp white_content" id="71" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-qq white_content" id="51" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-rr white_content" id="55" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-ss white_content" id="56" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-tt white_content" id="57" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-uu white_content" id="59" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-vv white_content" id="60" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-ww white_content" id="61" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-xx white_content" id="62" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-yy white_content" id="63" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a2 white_content" id="58" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a3 white_content" id="65" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a4 white_content" id="66" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a5 white_content" id="67" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a6 white_content" id="68" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a7 white_content" id="69" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content16-a8 white_content" id="70" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'bb')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fushunjie.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content17-a white_content" id="1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-b white_content" id="2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-c white_content" id="3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-d white_content" id="5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-e white_content" id="6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-f white_content" id="7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-g white_content" id="8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-h white_content" id="9" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-i white_content" id="10" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-j white_content" id="11" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-k white_content" id="12" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-l white_content" id="13" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-m white_content" id="15" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-n white_content" id="16" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-o white_content" id="17" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-p white_content" id="18" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-q white_content" id="20" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-r white_content" id="21" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-s white_content" id="22" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-t white_content" id="19" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-u white_content" id="23" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-v white_content" id="25" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-w white_content" id="26" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-x white_content" id="27" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-y white_content" id="28" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-z white_content" id="29" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a1 white_content" id="30" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-aa white_content" id="31" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-bb white_content" id="32" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-cc white_content" id="33" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-dd white_content" id="72" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ee white_content" id="73" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ff white_content" id="75" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-gg white_content" id="76" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-hh white_content" id="77" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ii white_content" id="35" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-jj white_content" id="36" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-kk white_content" id="37" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ll white_content" id="38" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-mm white_content" id="39" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-nn white_content" id="50" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-oo white_content" id="51" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-pp white_content" id="52" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-qq white_content" id="53" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-rr white_content" id="55" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ss white_content" id="56" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-tt white_content" id="57" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-uu white_content" id="59" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-vv white_content" id="60" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ww white_content" id="61" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-xx white_content" id="62" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-yy white_content" id="63" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a2 white_content" id="65" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a3 white_content" id="66" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a4 white_content" id="67" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a5 white_content" id="68" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a6 white_content" id="69" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a7 white_content" id="70" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a8 white_content" id="71" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a9 white_content" id="58" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'cc')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/fumingjie.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content18-a white_content" id="2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-b white_content" id="1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-c white_content" id="3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-d white_content" id="5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-e white_content" id="6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-f white_content" id="7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-g white_content" id="8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-h white_content" id="9" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-i white_content" id="10" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-j white_content" id="11" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-k white_content" id="62" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-l white_content" id="63" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-m white_content" id="65" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-n white_content" id="66" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-o white_content" id="67" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-p white_content" id="68" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-r white_content" id="69" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-s white_content" id="55" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-t white_content" id="56" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-u white_content" id="57" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-v white_content" id="58" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-w white_content" id="59" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-x white_content" id="60" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-y white_content" id="61" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-z white_content" id="37" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a1 white_content" id="38" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-aa white_content" id="39" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-bb white_content" id="50" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-cc white_content" id="51" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-dd white_content" id="52" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-ee white_content" id="53" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-ff white_content" id="28" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-gg white_content" id="36" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-hh white_content" id="35" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-ii white_content" id="33" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-jj white_content" id="32" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-kk white_content" id="31" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-ll white_content" id="30" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-mm white_content" id="29" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-nn white_content" id="27" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-oo white_content" id="26" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-pp white_content" id="25" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-qq white_content" id="23" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-rr white_content" id="22" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-ss white_content" id="21" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-tt white_content" id="19" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-uu white_content" id="18" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-vv white_content" id="17" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-ww white_content" id="16" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-xx white_content" id="15" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-yy white_content" id="13" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a2 white_content" id="12" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a3 white_content" id="20" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a4 white_content" id="71" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a5 white_content" id="70" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a6 white_content" id="a6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a7 white_content" id="a7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content18-a8 white_content" id="a8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    <?php elseif(($img == 'dd')): ?>
                    <div style="float:left" class="checked"><img src="/webjlcs/Public/images/fuguangjie.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content19-a white_content" id="1" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-b white_content" id="2" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-c white_content" id="3" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-d white_content" id="5" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-e white_content" id="6" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-f white_content" id="7" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-g white_content" id="8" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-h white_content" id="9" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-i white_content" id="10" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-j white_content" id="11" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-k white_content" id="12" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-l white_content" id="13" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-m white_content" id="15" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-n white_content" id="16" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-o white_content" id="17" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-p white_content" id="18" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-q white_content" id="19" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-r white_content" id="20" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-s white_content" id="21" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-t white_content" id="22" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-u white_content" id="23" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-v white_content" id="25" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-w white_content" id="26" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-x white_content" id="27" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-y white_content" id="28" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-z white_content" id="29" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a1 white_content" id="30" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-aa white_content" id="31" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-bb white_content" id="32" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-cc white_content" id="33" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-dd white_content" id="35" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-ee white_content" id="36" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-ff white_content" id="37" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-gg white_content" id="38" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-hh white_content" id="39" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-ii white_content" id="50" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-jj white_content" id="51" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-kk white_content" id="52" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-ll white_content" id="53" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-mm white_content" id="55" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-nn white_content" id="56" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-oo white_content" id="57" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-pp white_content" id="58" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-qq white_content" id="59" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-rr white_content" id="60" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-ss white_content" id="61" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-tt white_content" id="66" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-uu white_content" id="67" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-vv white_content" id="68" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-ww white_content" id="69" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-xx white_content" id="70" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-yy white_content" id="71" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <!-- <a href="#test"><div class="white_content19-a2 white_content" id="23" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a3 white_content" id="" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a4 white_content" id="70" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a5 white_content" id="a5" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a6 white_content" id="a6" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a7 white_content" id="a7" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content19-a8 white_content" id="a8" title="当前墙面为十层，请选择您需要购买的莲位" href="#test"></div></a> -->
                    </div>
                    <?php elseif(($img == 'l2')): ?>
                    <div class="checked"><img src="/webjlcs/Public/images/.jpg" style="float:left;margin:10px;">
                        <a href="#test"><div class="white_content17-a white_content" id="a" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-b white_content" id="b" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-c white_content" id="c" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-d white_content" id="d" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-e white_content" id="e" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-f white_content" id="f" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-g white_content" id="g" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-h white_content" id="h" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-i white_content" id="i" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-j white_content" id="j" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-k white_content" id="k" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-l white_content" id="l" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-m white_content" id="m" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-n white_content" id="n" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-o white_content" id="o" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-p white_content" id="p" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-q white_content" id="q" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-r white_content" id="r" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-s white_content" id="s" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-t white_content" id="t" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-u white_content" id="u" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-v white_content" id="v" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-w white_content" id="w" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-x white_content" id="x" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-y white_content" id="y" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-z white_content" id="z" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a1 white_content" id="a1" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-aa white_content" id="aa" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-bb white_content" id="bb" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-cc white_content" id="cc" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-dd white_content" id="dd" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ee white_content" id="ee" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ff white_content" id="ff" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-gg white_content" id="gg" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-hh white_content" id="hh" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ii white_content" id="ii" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-jj white_content" id="jj" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-kk white_content" id="kk" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ll white_content" id="ll" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-mm white_content" id="mm" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-nn white_content" id="nn" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-oo white_content" id="oo" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-pp white_content" id="pp" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-qq white_content" id="qq" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-rr white_content" id="rr" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ss white_content" id="ss" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-tt white_content" id="tt" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-uu white_content" id="uu" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-vv white_content" id="vv" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-ww white_content" id="ww" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-xx white_content" id="xx" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-yy white_content" id="yy" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a2 white_content" id="a2" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a3 white_content" id="a3" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a4 white_content" id="a4" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a5 white_content" id="a5" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a6 white_content" id="a6" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a7 white_content" id="a7" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                        <a href="#test"><div class="white_content17-a8 white_content" id="a8" title="当前墙面为九层，请选择您需要购买的莲位" href="#test"></div></a>
                    </div>
                    </div>
                    <?php else: endif; ?>
                <br/>
                <br/>
                <div class="wanfot" style="" id="test"  name="test">当前墙面:&nbsp;
                    <a href="/webjlcs/Home/Index/banner">万佛堂-></a>
                    <a href="/webjlcs/Home/Index/dian?cat_id=<?php echo ($cat_id); ?> "><?php echo ($contents); ?></a>

                </div>
                
                <div class="jsons_show"></div>                  
                
                <div class="clear"></div>
                <div>
                    <div class="tips">
                        <span style="margin-right: 40px;"><img src="/webjlcs/Public/images/shuang.png" alt=""  /> ：已认捐</span>
                        <span><img src="/webjlcs/Public/images/hongfang.png" alt=""  /> <span>：未认捐</span>
                    </div>
                    <div class="choosing-info">
                        <span style="font-size: 24px;">第<span class="choose_col">06-07</span>列</span>
                        <?php if(($img == 'dd')): ?><ul class="choose-layer-ul">
                                <li class="row_10">10层</li>
                                <li class="row_09">09层</li>
                                <li class="row_08">08层</li>
                                <li class="row_07">07层</li>
                                <li class="row_06">06层</li>
                                <li class="row_05">05层</li>
                                <li class="row_03">03层</li>
                                <li class="row_02">02层</li>
                                <li class="row_01">01层</li>
                            </ul>   
                        <?php else: ?>
                            <ul class="choose-layer-ul">
                                <li class="row_09">09层</li>
                                <li class="row_08">08层</li>
                                <li class="row_07">07层</li>
                                <li class="row_06">06层</li>
                                <li class="row_05">05层</li>
                                <li class="row_03">03层</li>
                                <li class="row_02">02层</li>
                                <li class="row_01">01层</li>
                            </ul><?php endif; ?>

                        <p class="subscripti-position">认捐位置：第<span class="choose_col">06-07</span>列 <span class="choose_row">08</span>层</p>
                        <div class="operate">
                            <input type="button" name="add-cart"   value="加入认捐库"  />
                            <input type="button" name="subscripti" value="前往认捐"  />
                        </div>
                    </div>
                </div>
  </div>
                </div>

        <script src="http://www.daimasucai.com/daima/template/1/js/jquery.min.js"></script>
        <script type="text/javascript" src="/webjlcs/Public/js/jquery.seat-charts.min.js"></script>
    </div>
</div>
<!-- banner end-->
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



<!--foot_end -->
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
    //start  默认先显示id==a的图
    //alert($('.checked div').eq(0).attr('id'));  //第一个对应的id
    $.ajax({
        url:"/webjlcs/Home/Product/ajax_show",
        type: 'POST',
        data:{own:$('.checked div').eq(0).attr('id'),cat_id:$(".cat_id").attr('id')},
        success: function(data){
            if(data != ''){
                $('.jsons_show').html('');
                $('.jsons_show').append(data);
                $(".checked div").eq(0).addClass('check');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //console.log(XMLHttpRequest);
            //console.log(textStatus);
            //console.log(errorThrown);
        },
    })
    //end  默认先显示id==a的图

    var ids = [];
    function cart(){
        var root = '/webjlcs/Home/Product/ajax_cart';
        $('.bianse').each(function(i,dom){
            if($(this).hasClass('bianse1')){
                ids.push($(this).attr('id'));
            }
        })
        if(ids.length == 0){
            alert('您还没有选择需要加入购物车的商品');
        }
        $.post(root,ids,function(data){
            if(data == 1){
                alert('您还没有登录，请登录后再购买');
                $(window).attr('location','<?php echo U('User/login');?>');
            }else if(data == 3){
                alert('加入失败，请再次添加');
            }else if(data == 4){

            }else if(data == 5){
                alert('该商品已经存在您的购物车了，请勿重新添加');
                location.reload();
            }else{
                alert('加入成功，需要查看请去您的购物车');
                location.reload();
            }
        })
        }

    function order(){
        var root = '/webjlcs/Home/Order/ajax_order';
        $('.bianse').each(function(i,dom){
            if($(this).hasClass('bianse1')){
                ids.push($(this).attr('id'));
            }
        })
        if(ids.length == 0){
            alert('您还没有选择需要购买的商品');
        }
        $.post(root,ids,function(data){
            if(data == 111){
                alert('购买成功，请前去付款');
                location.reload();
            }
        })
    }

    $('.bianse').mouseover(function(){
        var ids=$(this).attr('id');
        var url='/webjlcs/Home/Product/ajax_check';
        $.ajax({
            url:url,
            type: 'POST',
            data:{id:ids},
            success: function(data){
               if(data != ''){
                   $('.jsons').html('');
                   $('.jsons').append(data);
               }
            }
        })
    })

    $('.fanhui').click(function(){
        window.history.back();
    })

    $(".checked div").click(function(){
        var owns=$(this).attr('id');
        var cat_id=$(".cat_id").attr('id');
        var url='/webjlcs/Home/Product/ajax_show';
        $(this).each(function(i,dom){

            if($(".checked div").hasClass('check')){
                $(".checked div").removeClass("check");
                $(this).addClass("check");
            }else{
                $(this).addClass("check");
            }

        })
        // alert(owns);alert(cat_id);
        $.ajax({
            url:url,
            type: 'POST',
            data:{own:owns,cat_id:cat_id},
            success: function(data){
                if(data != ''){
                    $('.jsons_show').html('');
                    $('.jsons_show').append(data);
                }
            }
        })
    })

    $(".white_content").mouseover(function(){

    })

    $(".closewebcat").click(function(){
        $(".webcat").css('display','none');
    })

    //加入认捐库
    $('input[name="add-cart"]').click(function(){
        $.post('/webjlcs/Home/Product/ajax_cart',{id:$('.choosing').attr('id')},function(data){
            if(data == 1){
                alert('您还没有登录，请登录后再购买');
                var nowurl='/webjlcs/Home/Product/index/cat_id/2/img/c.html';
                window.location.href = "/webjlcs/Home/User/login?url="+nowurl;
            }else if(data == 2){
                alert('该商品已经存在您的认捐库了，请勿重新添加');
                location.reload();
            }else if(data == 3){
                alert('添加成功，请去您的认捐库查看');
            }else if(data == 4){
                alert('加入失败，请再次添加');
            }
        });
    });

    $('input[name="subscripti"]').click(function(){
        // $.post('/webjlcs/Home/Order/ajax_order',{id:$('.choosing').attr('id')},function(data){
        //     if(data == 111){
        //         window.location.href = "/webjlcs/Home/Order/index?id="+$('.choosing').attr('id');
        //     }else if(data == 1){
        //         alert('请登录');
        //         var nowurl='/webjlcs/Home/Product/index/cat_id/2/img/c.html';
        //         window.location.href = "/webjlcs/Home/User/login?url="+nowurl;
        //     }else if(data == 222){
        //         alert('该商品已经售罄');
        //     }
        // })

        //处理方法二：前往认捐详细页面
        window.location.href = "/webjlcs/Home/Product/details?id="+$('.choosing').attr('id');
    });

    function webcat(){
        var top  = ($(window).height() - $(".webcat").height())/2;
        var left = ($(window).width() - $(".webcat").width())/2;
        var scrollTop  = $(document).scrollTop();
        var scrollLeft = $(document).scrollLeft();
        $(".webcat").css( { position : 'absolute', 'top' : top + scrollTop, left : left + scrollLeft } ).show();
    }

</script>
</html>