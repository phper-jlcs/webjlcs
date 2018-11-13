<?php
namespace Home\Controller;
use Think\Controller;
class WxController extends Controller {

    public function index(){
        //获取参数 timestamp nonce token排序
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $token = 'jlcs';
        $echostr   = $_GET['echostr'];
        $signature = $_GET['signature'];
        //形成数组 进行字典序排序
        $str = array();
        $str = array($nonce, $timestamp, $token);
        sort($str);
        //拼接字符串，sha1加密
        $sha = sha1(implode($str));
        //判断加密后的字符玉signature是否一致，判断是否来自微信的请求
        if($sha == $signature && $echostr){
            //第一次接入weixin api接口的时候
            echo  $echostr;
            exit;
        }else{
            $this->reponseMsg();
        }
    }

    //创建微信菜单
    //创建菜单后 需要取消关注再关注才能生效，微信自动更新需要24小时
    public function definedItem(){
        header("Content-type:text/html;charset=utf-8");
        //菜单postArr
        $accessToken = $this->getAccessToken();
        echo $accessToken;
        echo "<br />";
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=$accessToken";

        $postArr = array(
           'button'=> array(
                array(
                    'name'=>urlencode('通则久'),
                    'type'=>'click',
                    'key'=>'tong',
                ), //------>一级菜单
                array(
                    'name'=>urlencode('认捐'),
                    'type'=>'click',
                    'key'=>'phptuku',
                ),
                array(
                    'name'=>urlencode('选位'),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode('九龙寺'),
                            'type'=>'click',
                            'key'=>'html',
                        ),
                        array(
                            'name'=>urlencode('镇海寺'),
                            'type'=>'view',
                            'url'=>'http://www.zgdigong.com',
                        )
                    ),
                ),
           ),
        );
        //转成json数据格式给微信服务器
        echo $postJson = urldecode(json_encode($postArr));

        //发送到服务器
        $res = $this->http_url($url,'post','json',$postJson);
        echo "<hr />";
        echo $res;
    }

    //curl方法
    public function http_url($url,$type='get',$res='json',$arr=''){
            //初始化curl
            $ch =curl_init();
            //2.设置curl参数
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
             curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            if($type == 'post'){
                 curl_setopt($ch,CURLOPT_POST,1);
                 curl_setopt($ch,CURLOPT_POST,$arr);
            }
            //3.采集
            $output = curl_exec($ch);
            //4.关闭
            curl_close($ch);
            if($res == 'json'){
                if(curl_errno($ch)){
                    //请求失败，返回错误信息
                    return curl_errno($ch);
                }else{
                    //请求成功
                    return json_decode($output,true);
                }
            }
    }

    public function getAccessToken(){
        //把获取到的access_token保存到session中，一天最多请求200次，2小时内有效
        if($_SESSION['access_token'] && $_SESSION['out_time'] > time()){
            //当前access_token未过期
            return $_SESSION['access_token'];
        }else{
            //当前access_token已过期，需要重新请求 需要获取appid appkey
            $appid = "wxd5dcfd315bdc4fd2";
            $appsecret = "20e96025da8ef5deae2da3dba66bfd03";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $res = $this->http_url($url,'get','json');
            $access_token = $res['access_token'];
            $_SESSION['access_token'] = $access_token;
            $_SESSION['out_time'] = time()+7000;
            return $access_token;
        }
    }

    public function getUserInfo(){
        //1.获取到code
        $appid ='wx0e776cea53c5ffba';

        $redirect = urlencode('http://www.zgdigong.com/index.php/Home/Wx/getUser');
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        header("Location: $url");
        //2.获取到access_token
        //3.拉去openid
    }


    public function getUser(){
        //实例化用户表
        $weixin_user_mdl = M('weixin_users');
        $appid = 'wx0e776cea53c5ffba';
        $appsecret = '70af6d65fd051ecde95b15791024166b';
        $code = $_GET['code'];
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code ";
        //拉去到openid
        $res = $this->http_url($url,'get');
        $openid = $res['openid'];
        $access_token = $res['access_token'];
        //拉取详细信息
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $res = $this->http_url($url);
        //判断用户是否登录过（第一次登录即注册）
        if(!empty($res)){
            $weixin_users = $weixin_user_mdl->where(array('openid'=>$res['openid']))->find();
            //未登录，执行注册
            if(!$weixin_users){
                if($res['openid']){
                    $userinfo = array(
                        'name'=>$res['nickname'],
                        'openid'=>$res['openid'],
                        'regtime'=>date('Y-m-d H:i:s',time()),
                    );
                    $weixin_user_mdl->add($userinfo);
                }
            }
            $weixin_users = $weixin_user_mdl->where(array('openid'=>$res['openid']))->find();
            if($weixin_users){
                $_SESSION['id']=$weixin_users['id'];
                $_SESSION['nickname']=$res['nickname'];
                $_SESSION['headimgurl']=$res['headimgurl'];
            }
            if(!empty($_SESSION)){
                $this->redirect('WapHome/Index/index');
            }
        }
    }
//    public function reponseMsg()
//    {
//
//        //1.获取到微信推送过来post数据（xml格式）
//        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
////2.处理消息类型，并设置回复类型和内容
//        $postObj = simplexml_load_string($postArr);
//        var_dump($postObj);exit;
////用户发送tuwen1关键字的时候，回复一个单图文
//        if (strtolower($postObj->MsgType) == 'text' && trim($postObj->Content) == '多图文'){
//            $toUser = $postObj->FromUserName;
//        $fromUser = $postObj->ToUserName;
//        $arr = array(
//            array(
//                'title' => 'Laravel is very graceful!',
//                'description' => "The trip of playing PHP is so cool!",
//                'picUrl' => 'http://www.phptuku.com/uploads/170207/1-1F20H04SAM.jpg',
//                'url' => 'http://www/phptuku.com/',
//            ),
//        );
//        $template = "<xml>
//                        <ToUserName><![CDATA[%s]]></ToUserName>
//                        <FromUserName><![CDATA[%s]]></FromUserName>
//                        <CreateTime>%s</CreateTime>
//                        <MsgType><![CDATA[%s]]></MsgType>
//                        <ArticleCount>" . count($arr) . "</ArticleCount>
//                        <Articles>";
//        foreach ($arr as $k => $v) {
//            $template .= "<item>
//                            <Title><![CDATA[" . $v['title'] . "]]></Title>
//                            <Description><![CDATA[" . $v['description'] . "]]></Description>
//                            <PicUrl><![CDATA[" . $v['picUrl'] . "]]></PicUrl>
//                            <Url><![CDATA[" . $v['url'] . "]]></Url>
//                            </item>";
//        }
//        $template .= "</Articles>
//                        </xml> ";
//        echo sprintf($template, $toUser, $fromUser, time(), 'news');
//        }
//
//
//        if( strtolower($postObj->MsgType) == 'event'){
//            if( strtolower($postObj->Event) == 'click'){
//                $toUser = $postObj->FromUserName;
//                $fromUser = $postObj->ToUserName;
//                //如果Event是点击事件.判断是哪个点击
//                if(strtolower($postObj->EventKey) == 'tong'){
//                    $contents = '这是通则久的官网';
//                }
//                $indexModel = new IndexModel;
//                $indexModel->responseText($postObj,$contents);
//            }
//        }
//    }



        public function info(){
            $this->display('Wx/index');
        }

        public function aboutus(){
            $this->show();
        }
        public function jlcsinfo(){
            $this->show();
        }
        public function zhsinfo(){
            $this->show();
        }
        public function weixinshop(){
            $this->show();
        }

        public function puji(){
            $this->show();
        }

        public function more(){
            $this->show();
        }

}