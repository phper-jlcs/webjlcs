<?php
namespace JLAdmin\Controller;
use Think\Controller;
class AssortController extends Controller {
    public function index(){
        $article_assort_mdl = M('article_assorts');
        $article_mdl = M('articles');
        $temple_mdl = M('temples');
        $articles = $article_assort_mdl->select();
        $temples = $temple_mdl->select();
        //统计下属文章数
        foreach($articles as $key=>$val){
            $article = $article_mdl->where(array('cat_id'=>$val['id']))->count();
            $articles[$key]['count'] = $article;
        }
        $this->assign('temples',$temples);
        $this->assign('articles',$articles);
        $this->show();
    }


    public function  add(){
        $temple_mdl = M('temples');
        $temples = $temple_mdl->select();
        $this->assign('temples',$temples);
        $this->show();
    }


    public function doadd(){
        $article_mdl = M("article_assorts");
        if($_POST){
            if(I('post.title') == ''){
                $this->error('请填写栏目标题！');
            }
            if(I('post.brief') == ''){
                $this->error('请填写栏目简介！');
            }
            $article_info =array(
                'name'=>$_POST['title'],
                'brief'=>$_POST['brief'],
                'time'=>date('Y-m-d H:i:s'),
                'temple'=>$_POST['temple'],
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
        $article_mdl = M('article_assorts');
        $article = $article_mdl->where(array('id'=>$id))->delete();
        if($article == 1){
            $this->success('删除成功',U('index'),1);
        }else{
            $this->error('删除失败',U('index'),1);
        }
    }


    public function edit($id=null){
        $article_mdl = M('article_assorts');
        $filter['id'] = $id;
        $article = $article_mdl->where($filter)->find();
        $info['id'] = $article['id'];
        $info['name'] = $article['name'];
        $info['brief'] = $article['brief'];
        $this->assign('info',$info);
        $this->display();
    }

    public function doedit($id=null){
        $article_mdl = M('article_assorts');
        $filter['id'] = $id;
        $updateinfo['name'] = $_POST['name'];
        $updateinfo['brief'] = $_POST['brief'];
        $data = $article_mdl->where($filter)->save($updateinfo);
        if($data==1){
            $this->success('修改成功', U('index'), 2);
        }else{
            $this->error('修改失败,请重新修改', U('edit',array('id'=>$id)), 2);
        }
    }

}