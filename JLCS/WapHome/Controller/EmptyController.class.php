<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {
    public function index(){
        $this->redirect('Index/index');
    }


    public  function _empty(){
        $this->redirect('Index/index');
    }
}