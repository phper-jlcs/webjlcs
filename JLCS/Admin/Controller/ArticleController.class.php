<?php
namespace Admin\Controller;
use \Think\Controller;
class ArticleController extends Controller{
    public function index(){
        $article_list_mdl = M('article_lists');
        $article_lists = $article_list_mdl->select();
        $this->assign('article_lists',$article_lists);
        $this->show();
    }

    public function add(){
        $this->show();
    }

    public function doadd(){
        $article_mdl = M("article_lists");
        if($_POST){
            $article_info =array(
                'article_name'=>$_POST['title'],
                'content'=>$_POST['content'],
                'author'=>$_POST['author'],
                'time'=>date('Y-m-d H:i:s',time()),
            );

            $add = $article_mdl->add($article_info);
            if($add){
                $this->success('添加成功',U('index'),2);
            }else{
                $this->error('添加失败',U('add'),2);
            }
        }

    }


    public function del($id=null){
        $article_mdl = M("article_lists");
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
        $article_mdl = M("article_lists");
        $articles = $article_mdl->where(array('id'=>$id))->find();
        $this->assign('articles',$articles);
        $this->show();
    }

    public function doedit($id=null){
        $article_mdl = M("article_lists");
        $info = array(
            'article_name'=>$_POST['title'],
            'content'=>$_POST['content'],
            'author'=>$_POST['author'],
            'time'=>date('Y-m-d H:i:s'),
        );
        $articles = $article_mdl->where(array('id'=>$id))->save($info);
        if($articles == 1){
            $this->success('修改成功',U('index'),2);
        }else{
            $this->error('修改失败',U('index',array('id'=>$id)),2);
        }
    }

}
?>