<?php
namespace ZHHome\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $article_mdl = M('articles');
        $inform = $article_mdl->where(array('cat_id'=>7))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>5))->order('time desc')->limit(2)->select();
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }

    public function amity(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('zhiding'=>1,'temple'=>2))->find();
        $amity = $article_mdl->where(array('cat_id'=>4))->order('time desc')->limit(5)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('amity',$amity);
        $this->show();
    }
    public function inform(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('zhiding'=>1,'temple'=>2))->find();
        $inform = $article_mdl->where(array('cat_id'=>7,'zhiding'=>0))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>5,'zhiding'=>0))->order('time desc')->limit(2)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }
    public function focus(){
        $this->show();
    }
    public function culture(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('zhiding'=>1,'temple'=>2))->find();
        $inform = $article_mdl->where(array('cat_id'=>7,'zhiding'=>0))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>5,'zhiding'=>0))->order('time desc')->limit(2)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }
    public function study(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('zhiding'=>1,'temple'=>2))->find();
        $inform = $article_mdl->where(array('cat_id'=>7))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>5))->order('time desc')->limit(2)->select();
        $study = $article_mdl->where(array('cat_id'=>8))->order('time desc')->limit(5)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->assign('study',$study);
        $this->show();
    }

    public function baokam(){
        $article_mdl = M('articles');
        $jl_image_mdl = M('jl_images');
        $inform = $article_mdl->where(array('cat_id'=>7))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>5))->order('time desc')->limit(2)->select();
        $jl_images = $jl_image_mdl->where(array('own'=>1,'temple'=>2))->select();
        $this->assign('jl_images',$jl_images);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }

    public function down(){
        $article_mdl = M('articles');
        $jl_image_mdl = M('jl_images');
        $inform = $article_mdl->where(array('cat_id'=>7))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>5))->order('time desc')->limit(2)->select();
        $jl_images = $jl_image_mdl->where(array('own'=>0,'temple'=>2))->select();
        $this->assign('jl_images',$jl_images);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }
    public function contents($id=null){
        $article_mdl = M('articles');
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>5))->order('time desc')->limit(5)->select();
        $articles = $article_mdl->where(array('id'=>$id))->find();
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->assign('articles',$articles);
        $this->show();
    }

    public function download($id){
        $jl_image_mdl = M('jl_images');
        $jl_image_show = $jl_image_mdl->where(array('id'=>$id))->find();
        //下载文件
        $arr = explode("..",$jl_image_show['image']);
        $str = implode("",$arr);
        $file=$_SERVER["DOCUMENT_ROOT"].'/webjlcs'.$str;
        //$file = 'http://'.$_SERVER['HTTP_HOST'] . $str;  //放到我们官网上的时候的处理
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="'.basename($file) .'"');
        header("Content-Length: ".filesize($file));
        readfile($file);
    }
}