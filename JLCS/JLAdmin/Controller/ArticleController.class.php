<?php
namespace JLAdmin\Controller;
use Think\Controller;
class ArticleController extends Controller {
    public function index(){
        $article_mdl = M('articles');
        $article_assort_mdl = M('article_assorts');
        $_GET['p'] = isset($_GET['p'])? $_GET['p'] : '1';
        $articles = $article_mdl->page($_GET['p'],8)->select();
        $count = $article_mdl->count();
        $Page = new\Think\Page($count,8);
        $Page->lastSuffix=false;
//        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>4</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();
        foreach($articles as $key=>$val){
            $article_assorts = $article_assort_mdl->where(array('id'=>$val['cat_id']))->find();
            $articles[$key]['cat_name'] = $article_assorts['name'];
        }
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('articles',$articles);
        $this->show();
    }


    public function  add(){
        $article_assort_mdl = M('article_assorts');
        $temple_mdl = M('temples');
        $article_assorts = $article_assort_mdl->where(array('temple'=>1))->select();
        $temples = $temple_mdl->select();
        $this->assign('temples',$temples);
        $this->assign('article_assorts',$article_assorts);
        $this->show();
    }


    public function doadd(){
        $article_mdl = M("articles");
        if($_POST){
            $article_info =array(
                'name'=>$_POST['title'],
                'cat_id'=>$_POST['cat_id'],
                'content'=>$_POST['content'],
                'author'=>$_POST['author'],
                'time'=>date('Y-m-d H:i:s',time()),
                'temple'=>$_POST['temple'],
                'brief'=>$_POST['brief'],
                'zhiding'=>$_POST['zhiding'],
            );
            $this->checkzhiding($_POST['zhiding'],$_POST['temple']);
            $add = $article_mdl->add($article_info);
            if($add){
                $this->success('添加成功',U('index'),2);
            }else{
                $this->error('添加失败',U('add'),2);
            }
        }

    }


    public function del($id=null){
        $article_mdl = M("articles");
        if($id){
            $articles = $article_mdl->where(array('id'=>$id))->delete();
            if($articles == 1){
                $this->success('删除成功',U('index'),2);
            }else{
                $this->error('删除失败',U('index'),2);
            }
        }
    }

    public function edit($id=null){
        $article_mdl = M('articles');
        $article_assort_mdl = M('article_assorts');
        $articles = $article_mdl->where(array('id'=>$id))->find();
        $article_assorts = $article_assort_mdl->where(array('id'=>$articles['cat_id']))->find();
        $article_assort_show = $article_assort_mdl->where(array('temple'=>$articles['temple']))->select();
        $articles['cat_name'] = $article_assorts['name'];
        $this->assign('article_assort_show',$article_assort_show);
        $this->assign('articles',$articles);
        $this->show();
    }

    public function doedit($id=null){
        $article_mdl = M("articles");
        $info = array(
          'name'=>$_POST['title'],
          'cat_id'=>$_POST['assort'],
          'content'=>$_POST['content'],
          'author'=>$_POST['author'],
          'time'=>date('Y-m-d H:i:s'),
          'temple'=>$_POST['temple'],
          'brief'=>$_POST['brief'],
          'zhiding'=>$_POST['zhiding'],
        );
        //判断当前寺庙是否有置顶文章
        $this->checkzhiding($_POST['zhiding'],$_POST['temple']);
        $articles = $article_mdl->where(array('id'=>$id))->save($info);
        if($articles == 1){
            $this->success('修改成功',U('index'),2);
        }else{
            $this->error('修改失败',U('index',array('id'=>$id)),2);
        }
    }

    //封装的判定是应该是否置顶方法
    public function checkzhiding($zhiding,$simiao){
        $article_mdl = M("articles");
        if($zhiding == 1){
            $articles = $article_mdl->where(array('temple'=>$simiao,'zhiding'=>1))->find();
            if($articles){
                $update = array(
                    'zhiding'=>0,
                );
                $article_mdl->where(array('id'=>$articles['id']))->save($update);
            }
        }
    }
    public function checktemple(){
        header("Content-type:text/php;charset=utf-8");
        $article_assort_mdl = M('article_assorts');
        $article_assorts = $article_assort_mdl->where(array('temple'=>$_POST['id']))->select();

        if(!empty($article_assorts)){
            $returnData = json_encode($article_assorts);
            $this->ajaxReturn($returnData);
        }else{
           echo 'a';
        }
    }


}