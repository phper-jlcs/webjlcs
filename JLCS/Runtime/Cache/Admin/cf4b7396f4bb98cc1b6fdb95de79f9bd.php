<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../include/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../include/images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../include/images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../include/images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../include/images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：商品管理&nbsp;&nbsp;>&nbsp;&nbsp;<?php echo $str;?></td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <!-- <a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">新增管理员</a> -->
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="<?php echo U('doeditproduct',array('id'=>$products['id']));?>" enctype="multipart/form-data" onsubmit="return adds()">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品名称：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="name" value="<?php echo ($products["product_name"]); ?>" class="text-word" id="name">
        </td>
        </tr>

        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
            <td align="right" valign="middle" class="borderright borderbottom bggray">选择所属类别：</td>
            <td align="left" valign="middle" class="borderright borderbottom main-for">
                <select name="owns" id="">
                    <option value="<?php echo ($cats["id"]); ?>"><?php echo ($cats["cat_name"]); ?></option>
                </select>
            </td>
        </tr>

      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品价格：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="price" value="<?php echo ($products["now_price"]); ?>" class="text-word" id="price">
        </td>
        </tr>
           <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品图片：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="file" name="filedata" value="<?php echo ($products["path"]); ?>" class="text-word" id="filedata">
            <input type="hidden" name="imagename" value="<?php echo ($products["image"]); ?>">
            <input type="hidden" name="filedata" value="<?php echo ($products["path"]); ?>">
            <img src="/Public/<?php echo ($products["path"]); ?>" alt="" width="50px;" value="<?php echo ($products["image"]); ?>" name="image_">
        </td>
      </tr>
           <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">库存量：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="store" value="<?php echo ($products["product_store"]); ?>" class="text-word" id="store">
        </td>
      </tr>
         </tr>
     <!-- <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">生产日期：</td>
        <td align="left" valign="middle" class="borderright borderbottom">
              年
                      <select name="year" id="level">
                                <option value="<?php echo isset($date1)?$date1:'';?>"><?php echo $date1.'年';?></option>
									<?php for($i=1980;$i<=2037;$i++){?>
                               <option value="<?php echo $i?>" >&nbsp;&nbsp;<?php echo $i.'年'?></option>
                                <?php }?>
                                
                      </select>
            月
                        <select name="month" id="level">
                                <option value="<?php echo isset($date2)?$date2:'';?>"><?php echo $date2.'月';?></option>
                                <?php for($i=1;$i<13;$i++){ echo '<option value="'.$i.'">'.$i.'月</option>'; }?>
                      </select>
            日
                        <select name="day">
                                <option value="<?php echo isset($date3)?$date3:'';?>"><?php echo $date3.'日';?></option>
									 <?php for($i=1;$i<=31;$i++){ echo '<option value="'.$i.'">'.$i.'日</option>'; }?>
                      </select>
        </td>
      </tr>-->
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品状态：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="state" id="level">
          <option value="xz" >--请选择--</option>
	    <option value="0" >&nbsp;&nbsp;新添加</option>
	    <option value="1" >&nbsp;&nbsp;在售</option>
	    <option value="2" >&nbsp;&nbsp;下架</option>
        </select>
        </td>
      </tr>
           <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品描述：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
              <textarea name="descr" cols="50" rows="5" id="descr"><?php echo ($products["product_description"]); ?></textarea>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="提交" class="text-but">
       </td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
<script type="text/javascript">
    function adds(){
        var name=document.getElementById("name").value;
        if(name == ''){
            alert("商品名不能为空！");
           return false;
        }
        var price=document.getElementById("price").value;
        if(price == ''){
            alert("商品价格不能为空！");
            return false;
        }
        var store=document.getElementById("store").value;
        if(store == ''){
            alert("库存不能为空！");
            return false;
        }
        var descr=document.getElementById("descr").value;
        if(descr == ''){
            alert("描述不能为空！");
            return false;
        }
    }
</script>
</html>