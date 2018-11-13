<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    protected function _initialize(){
        //判断当前域名
        $jlcs = 'jlcs.zgdigong.com';
        $zhs =  'zhs.zgdigong.com';
        if($_SERVER['HTTP_HOST'] == $jlcs){
            $this->redirect('JLHome/Index/index');
        }elseif($_SERVER['HTTP_HOST'] == $zhs){
            $this->redirect('ZHHome/Index/index');
        }
        //判断当前登录设备为手机还是pc
       if($this->isMobile()){
           $this->redirect('Mobile/Index/index');
       }else{
           C('DEFAULT_MODULE','Home');
       }

    }

    public function index(){

        $this->display('Index/index');
    }

    function isMobile(){
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
            return true;

        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
            return true;
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            );
            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }

    //九龙禅寺
    public function  jlcs(){
        $this->show();
    }
    //镇海寺
    public function zhs(){
        $this->show();
    }
	public function zhs_wft1(){
        $this->show();
    }
    public function zhs_wft2(){
        $this->show();
    }
	public function jlcs_wft(){
		$this->display('Index/jlcs_wft');
	}

    public  function  jlcs_hjzc(){
        $this->display('Index/jlcs_hjzc');
    }
    public  function _empty(){
        $this->redirect('Index/index');
    }
    public function smjs(){
        $article_list_mdl = M('article_lists');
        $article_lists = $article_list_mdl->where(array('article_name'=>'寺庙供奉'))->find();
        $this->assign('article_lists',$article_lists);
        $this->show();
    }
    public function smgh(){
        $article_list_mdl = M('article_lists');
        $article_lists = $article_list_mdl->where(array('article_name'=>'生命关怀','temple'=>1))->find();
        $this->assign('article_lists',$article_lists);
        $this->show();
    }
    public function fjzh(){
        $article_list_mdl = M('article_lists');
        $article_lists = $article_list_mdl->where(array('article_name'=>'佛教智慧','temple'=>1))->find();
        $this->assign('article_lists',$article_lists);
        $this->show();
    }
    public function dian($cat_id=null){
        if($cat_id == '1'){
            $name= '佛恩殿';
        }elseif($cat_id == '2'){
            $name = '佛孝殿';
        }elseif($cat_id == '4'){
            $name = '佛裕殿';
        }elseif($cat_id == '10'){
            $name = '佛仁殿';
        }elseif($cat_id == '5') {
            $name = '佛光殿';
        }elseif($cat_id == '6') {
            $name = '佛仪殿';
        }elseif($cat_id == '7') {
            $name = '佛泽殿';
        }elseif($cat_id == '8') {
            $name = '佛照殿';
        }elseif($cat_id == '9') {
            $name = '佛禄殿';
        }
        $this->assign('name',$name);
        $this->assign('cat_id',$cat_id);
        $this->show();
    }



}