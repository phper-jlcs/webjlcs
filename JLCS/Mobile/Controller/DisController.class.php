<?php
namespace Mobile\Controller;
use Think\Controller;
class DisController extends Controller {

    public function share(){

        $this->display('Dis/share');
    }


    public function dis_regist()
    {
        $user_id = $_SESSION['id'];
        $this->assign('user_id',$user_id);
        $this->show();
    }

    public function center(){
        $this->show();
    }

    public function index(){
        $this->show();
    }


}