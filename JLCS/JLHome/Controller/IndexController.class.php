<?php
namespace JLHome\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $article_mdl = M('articles');
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(2)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(2)->select();
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }

    public function amity(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('temple'=>1,'zhiding'=>1))->find();
        $amity = $article_mdl->where(array('cat_id'=>4))->order('time desc')->limit(5)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('amity',$amity);
        $this->show();
    }
    public function inform(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('cat_id'=>2,'temple'=>1,'zhiding'=>1))->find();
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(5)->select();
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
        $zhiding = $article_mdl->where(array('temple'=>1,'zhiding'=>1))->find();
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(5)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }
    public function study(){
        $article_mdl = M('articles');
        $zhiding = $article_mdl->where(array('temple'=>1,'zhiding'=>1))->find();
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(5)->select();
        $study = $article_mdl->where(array('cat_id'=>3))->order('time desc')->limit(5)->select();
        $this->assign('zhiding',$zhiding);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->assign('study',$study);
        $this->show();
    }

    public function baokam(){
        $article_mdl = M('articles');
        $jl_image_mdl = M('jl_images');
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(5)->select();
        $jl_images = $jl_image_mdl->where(array('own'=>1,'temple'=>1))->select();
        $this->assign('jl_images',$jl_images);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }

    public function down(){
        $article_mdl = M('articles');
        $jl_image_mdl = M('jl_images');
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(5)->select();
        $jl_images = $jl_image_mdl->where(array('own'=>0,'temple'=>1))->select();
        $this->assign('jl_images',$jl_images);
        $this->assign('culture',$culture);
        $this->assign('inform',$inform);
        $this->show();
    }
    public function contents($id=null){
        $article_mdl = M('articles');
        $article_assort_mdl = M('article_assorts');
        $inform = $article_mdl->where(array('cat_id'=>2))->order('time desc')->limit(5)->select();
        $culture = $article_mdl->where(array('cat_id'=>1))->order('time desc')->limit(5)->select();
        $articles = $article_mdl->where(array('id'=>$id))->find();
        $article_assorts = $article_assort_mdl->where(array('id'=>$articles['cat_id']))->find();
        $articles['cat_name'] = $article_assorts['name'];
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