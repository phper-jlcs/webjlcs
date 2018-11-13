<?php
namespace JLAdmin\Controller;
use Think\Controller;
class ImageController extends Controller{

    public function index(){
        $jl_image_mdl = M('jl_images');
        $temple_mdl = M('temples');
        $jl_image_show = $jl_image_mdl->where(array('own'=>1))->select();
        foreach($jl_image_show as $key=>$val){
            $temples = $temple_mdl->where(array('id'=>$val['temple']))->find();
            $jl_image_show[$key]['temple_name'] = $temples['temple'];
        }
        $this->assign('jl_image_show',$jl_image_show);
        $this->show();
    }

    public function add(){
        $temple_mdl = M('temples');
        $temples = $temple_mdl->select();
        $this->assign('temples',$temples);
        $this->show();
    }

    public function doadd(){
        $jl_image_mdl = M('jl_images');
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     THINK_PATH;
        $upload->savePath  =    '../Public/JL_Uploads/';
        $info   =   $upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            $image = $info['filedata']['savepath'].$info['filedata']['savename'];
            $addinfo = array(
                'image'=>$image,
                'name'=>$_POST['name'],
                'own'=>$_POST['own'],
                'temple'=>$_POST['temple'],
            );
        }

        $jl_image_add = $jl_image_mdl->add($addinfo);

        if($jl_image_add){
            $this->success('上传成功，前去查看',U('index'),2);
        }else{
            $this->error('上传失败',U('add'),2);
        }

    }

    public function del($id=null){
        $jl_image_mdl = M('jl_images');
        $jl_image_show = $jl_image_mdl->where(array('id'=>$id))->find();
        //删除文件
        $arr = explode("..",$jl_image_show['image']);
        $str = implode("",$arr);
        $url=$_SERVER["DOCUMENT_ROOT"].'/webjlcs'.$str;
        $jl_image_del = $jl_image_mdl->where(array('id'=>$id))->delete();
        if($jl_image_del && unlink($url)){
            $this->success('删除成功',U('index'),2);
        }else{
            $this->error('删除失败',U('index'),2);
        }
    }

    public function edit($id=null){
        $jl_image_mdl = M('jl_images');
        $jl_image_show = $jl_image_mdl->where(array('id'=>$id))->find();
        $this->assign('jl_image_show',$jl_image_show);
        $this->show();
    }

    public function doedit($id=null){
        $jl_image_mdl = M('jl_images');
        if($_FILES['filedata']['name'] == ''){
            $addinfo['image'] = $_POST['image'];
            $addinfo['name'] = $_POST['name'];
            $addinfo['own'] = $_POST['own'];
        }else{
            $upload = new \Think\Upload();
            $upload->maxSize   =     3145728 ;
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath  =     THINK_PATH;
            $upload->savePath  =    '../Public/JL_Uploads/';
            $info   =   $upload->upload();
            if(!$info){
                $this->error($upload->getError());
            }else{
                $image = $info['filedata']['savepath'].$info['filedata']['savename'];
                $addinfo['image'] = $image;
                $addinfo['name'] = $_POST['name'];
                $addinfo['own'] = $_POST['own'];
            }
        }

        $jl_image_save = $jl_image_mdl->where(array('id'=>$id))->save($addinfo);
        if($jl_image_save == 1){
            $this->success('修改成功，前去查看',U('index'),2);
        }else{
            $this->error('修改失败',U('edit',array('id'=>$id)),2);
        }
    }

    public function down(){
        $jl_image_mdl = M('jl_images');
        $temple_mdl = M('temples');
        $jl_image_show = $jl_image_mdl->where(array('own'=>0))->select();
        foreach($jl_image_show as $key=>$val){
            $temples = $temple_mdl->where(array('id'=>$val['temple']))->find();
            $jl_image_show[$key]['temple_name'] = $temples['temple'];
        }
        $this->assign('jl_image_show',$jl_image_show);
        $this->show();
    }

    public function select($id=null){
        $jl_image_mdl = M('jl_images');
        $temple_mdl = M('temples');
        $jl_image_show = $jl_image_mdl->where(array('temple'=>$_POST['temple'],'own'=>$id))->select();
        foreach($jl_image_show as $key=>$val){
            $temples = $temple_mdl->where(array('id'=>$val['temple']))->find();
            $jl_image_show[$key]['temple_name'] = $temples['temple'];
        }
        $this->assign('jl_image_show',$jl_image_show);
        if($id == 0){
            $this->display('Image/down');
        }else{
            $this->display('Image/index');
        }

    }
}

?>