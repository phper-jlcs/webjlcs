<?php
namespace Mobile\Controller;
use Think\Controller;
class ContactController extends Controller {

    public function contact(){
        $this->display('Contact/contact');
    }
    
    public function map(){
        $this->display('Contact/map');
    }

}