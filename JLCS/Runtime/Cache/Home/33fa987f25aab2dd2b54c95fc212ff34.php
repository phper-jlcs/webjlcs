<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <title>中国帝宫-九龙禅寺皇家宗祠</title>
    <meta charset="UTF-8" />
    <meta name="description" content="皇家宗祠"/>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/webjlcs/Public/js/jquery-1.4.2.min.js"></script>
    <style type="text/css" src="/webjlcs/Public/css/banner.css"></style>
    <style>
        .body {
            width: 1366px;
            height: 1036px;
            margin: 0 auto;
            position: relative;
            background: url(/webjlcs/Public/images/hjzc3.jpg) no-repeat center;
        }
        .body span{
            position: absolute;
            left:300px;
            top:40px;
        }
        .body span a{
            text-decoration:none;
            color:black;
        }
        .body span a:hover{
            color:red;
        }
        .avatar {
            display: block;
            width: 223px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }

        .avatar img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img{
            height: 105px;
        }
        .avatar1 {
            display: block;
            width: 190px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }

        .avatar1 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar1:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img1{
            height: 105px;
        }
        .avatar2 {
              display: block;
              width: 190px;
              margin: 0 auto;
              overflow: hidden;
              cursor:pointer;
          }

        .avatar2 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar2:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img2{
            height: 198px;
        }
        .avatar3 {
            display: block;
            width: 264px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }

        .avatar3 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar3:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img3{
            height: 203px;
        }
        .avatar4 {
            display: block;
            width: 152px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }
        .avatar4 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar4:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img4{
            height: 137px;
        }
        .avatar5 {
            display: block;
            width: 56px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }
        .avatar5 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar5:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img5{
            height: 116px;
        }
        .avatar6 {
            display: block;
            width: 70px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }
        .avatar6 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar6:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img6{
            height: 70px;
        }
        .avatar7 {
            display: block;
            width: 195px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }
        .avatar7 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar7:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img7{
            height: 202px;
        }
        .avatar8 {
            display: block;
            width: 149px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }
        .avatar8 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar8:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img8{
            height: 105px;
        }
        .avatar9 {
             display: block;
             width: 153px;
             margin: 0 auto;
             overflow: hidden;
             cursor:pointer;
         }
        .avatar9 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar9:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img9{
            height: 225px;
        }
        .avatar10 {
            display: block;
            width: 149px;
            margin: 0 auto;
            overflow: hidden;
            cursor:pointer;
        }
        .avatar10 img {
            display: block;
            border: 0;
            width: 100%;
            transform: scale(1);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1);
            -webkit-transform: all 1s ease 0s;
        }

        .avatar10:hover img {
            transform: scale(1.3);
            transition: all 1s ease 0s;
            -webkit-transform: scale(1.3);
            -webkit-transform: all 1s ease 0s;
        }
        .img10{
            height: 205px;
        }
        .ashou:hover{
            color:red;
        }
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
    <div class="body">
    <a href="/webjlcs/Home/Index/jlcs"><img src="/webjlcs/Public/images/logo1.png" style="background:filter:alpha(Opacity=80);
            -moz-opacity:0.5;
            opacity: 0.5; margin-top: 20px;"/></a>
        <div style="position:absolute;left: 250px;top:40px;"><a href="javascript:history.back(-1)" style="font-size: 24px;color: #000000;
    text-decoration: none;">返回<</a></div>
        <div  class="avatar tishi" style="position:absolute; top:125px; left:675px;"><a href=""><img src='/webjlcs/Public/images/hjzc/dts.jpg' class="img"></a></div>
        <div  class="avatar1 tishi" style="position:absolute; top:125px; left:429px;"><a href=""><img src='/webjlcs/Public/images/hjzc/zdts.jpg' class="img1"></a></div>
        <div  class="avatar2 tishi" style="position:absolute; top:265px; left:429px;"><a href=""><img src='/webjlcs/Public/images/hjzc/zdtx.jpg' class="img2"></a></div>
        <div  class="avatar3 tishi" style="position:absolute; top:262px; left:675px;"><a href=""><img src='/webjlcs/Public/images/hjzc/dtx.png' class="img3"></a></div>
       <div  class="avatar4 tishi" style="position:absolute; top:550px; left:432px;"><a href=""><img src='/webjlcs/Public/images/hjzc/dt.png' class="img4"></a></div>
        <div  class="avatar5 tishi" style="position:absolute; top:768px; left:544px;"><a href=""><img src='/webjlcs/Public/images/hjzc/tqz.png' class="img5"></a></div>
       <div  class="avatar6 tishi" style="position:absolute; top:815px; left:615px;"><a href=""><img src='/webjlcs/Public/images/hjzc/tqy.png' class="img6"></a></div>
        <div  class="avatar7 tishi" style="position:absolute; top:546px; left:751px;"><a href=""><img src='/webjlcs/Public/images/hjzc/pts.png' class="img7"></a></div>
        <div  class="avatar8 tishi" style="position:absolute; top:778px; left:750px;"><a href=""><img src='/webjlcs/Public/images/hjzc/ptx.png' class="img8"></a></div>
        <div  class="avatar9" style="position:absolute; top:408px; left:969px;"><a href="<?php echo U('Product/hjzc',array('owns'=>'g','cat_id'=>3));?>"><img src='/webjlcs/Public/images/hjzc/tjs.png' class="img9"></a></div>
        <div  class="avatar10" style="position:absolute; top:678px; left:970px;"><a href="<?php echo U('Product/hjzc',array('owns'=>'gg','cat_id'=>3));?>"><img src='/webjlcs/Public/images/hjzc/tjx.png' class="img10"></a></div>
        <div style="width:160px;height:280px;float:right;margin-right:225px;margin-top:108px;">
            <h3 style="font-size: 25px;text-align: center;color:#D1955A;">皇族宗祠</h3>
            <br>
            <p style="font-family: Helvetica, 'Hiragino Sans GB', 'Microsoft Yahei', '微软雅黑', Arial, sans-serif;color:#8c8c8c;font-size: 16px;">
                皇族宗祠是匠造的专属家族祠堂，每间都独具匠心。拥有皇族宗祠的家族，是显贵家族的象征，拥有福佑子孙的皇族佛慧，为子孙积福报，护佑家族，为有缘人士倾心打造可以世代传席的家族祠堂，在千年龙脉封疆贵胄之地，共享千年皇族的荣耀与尊崇，永尽当世之孝。
            </p>
        </div>
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
        alert('很抱歉，当前未开放！仅可选择天监坊');
    })

</script>
</html>