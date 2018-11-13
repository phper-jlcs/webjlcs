<?php
namespace WapAdmin\Controller;
use Think\Controller;
class CatController extends Controller {
    public function index(){
        $cat_mdl = M('weixin_cats');
        if(I('post.name')){
            $map['pid'] = ",";
            $map['name'] = array('like','%'.I('post.name').'%');
            $cats = $cat_mdl->where($map)->select();
        }else{
            $cats = $cat_mdl->where(array('pid'=>','))->select();
        }
        
        foreach($cats as $key=>$val){
            $str = ','.$val['id'];
            $cat_s = $cat_mdl->where(array('pid'=>$str))->select();
            foreach($cat_s as $key1=>$val1){
                $cat_s[$key1]['level'] = '二级';
                $pid = $val1['pid'];
                $pids = substr($pid, -1);
                $cat_ch = $cat_mdl->where(array('id'=>$pids))->find();
                $cat_s[$key1]['owns'] = $cat_ch['name'];
            }
            $cats[$key]['catinfo'] = $cat_s;
            $cats[$key]['level'] = '一级';
            $cats[$key]['owns'] = '';
        }
        $this->assign('cats',$cats);
        $this->assign('keyword',I('post.name'));
        $this->show();
    }

    public function add(){
        $cat_mdl = M('weixin_cats');
        $cats = $cat_mdl->where(array('pid'=>','))->select();
        foreach($cats as $key=>$val){
            $str = ','.$val['id'];
            $cat_s = $cat_mdl->where(array('pid'=>$str))->select();
            $cats[$key]['catinfo'] = $cat_s;
        }
        $this->assign('cats',$cats);
        $this->show();
    }

    public function doadd(){
        $cat_mdl = M('weixin_cats');
        //一级分类
        if($_POST['owns'] == ''){
            $info =array(
              'pid'=>',',
              'name'=>$_POST['name'],
            );
            $cats = $cat_mdl->add($info);
        }else{
            $cats = $cat_mdl->where(array('id'=>$_POST['owns']))->find();
            if($cats['pid'] == ','){
                $str = $cats['pid'].$cats['id'];
            }else{
                $str = $cats['pid'].','.$cats['id'];
            }
            $info = array(
                'pid'=>$str,
                'name'=>$_POST['name'],
            );
            $cats = $cat_mdl->add($info);
        }
        if($cats){
            $this->success('添加成功',U('index'),1);
        }else{
            $this->error('添加失败',U('add'),1);
        }
    }

    public function edit($id=null){
        $cat_mdl = M('weixin_cats');
        $cat_s = $cat_mdl->where(array('id'=>$id))->find();
        //查询当前分类
        if($cat_s['pid'] == ','){
            $cat_s['owns'] = '一级';
        }else{
           $pid =  substr($cat_s['pid'], -1);
            $cat_d = $cat_mdl->where(array('id'=>$pid))->find();
            $cat_s['owns'] = $cat_d['name'];
            $cat_s['own_id'] = $cat_d['id'];
        }
        //查询所有的分类显示
        $cats = $cat_mdl->where(array('pid'=>','))->select();
        foreach($cats as $key=>$val){
            $str = ','.$val['id'];
            $cat_sa = $cat_mdl->where(array('pid'=>$str))->select();
            $cats[$key]['catinfo'] = $cat_sa;
        }
        $this->assign('cats',$cats);
        $this->assign('cat_s',$cat_s);
        $this->show();
    }

    public function doedit($id=null){
        $cat_mdl = M('weixin_cats');
        if($_POST['owns'] == ''){
            $info =array(
                'pid'=>',',
                'name'=>$_POST['name'],
            );
            $cats = $cat_mdl->where(array('id'=>$id))->save($info);
        }else{

            $cats = $cat_mdl->where(array('id'=>$_POST['owns']))->find();
            if($cats['pid'] == ','){
                $str = $cats['pid'].$cats['id'];
            }
            $info = array(
                'pid'=>$str,
                'name'=>$_POST['name'],
            );
            $cats = $cat_mdl->where(array('id'=>$id))->save($info);
        }

        if($cats == 1){
            $this->success('修改成功',U('index'),1);
        }else{
            $this->error('修改失败',U('edit',array('id'=>$id)),1);
        }
    }

    public function del($id){
        $cat_mdl = M('weixin_cats');
        $cats = $cat_mdl->where(array('id'=>$id))->find();
        $pid = $cats['id'];
        $like['pid'] = array('like','%'.$pid);
        $cats_ch = $cat_mdl->where($like)->select();
        if(!empty($cats_ch)){
            $this->error('该分类下还有分类，不允许删除，请删除下级分类',U('index'),2);
        }else{
            $cat_del = $cat_mdl->where(array('id'=>$id))->delete();
            if($cat_del == 1){
                $this->success('删除成功',U('index'),2);
            }else{
                $this->error('删除失败',U('index'),2);
            }
        }

    }
}