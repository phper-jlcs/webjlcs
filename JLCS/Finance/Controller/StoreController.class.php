<?php
namespace Finance\Controller;
use Think\Controller;

class StoreController extends Controller{

    //库存统计
    public function index(){
        $product_mdl = M('products');
        $products = $product_mdl->where(array('cat_id'=>15))->select();
        $this->assign('products',$products);
        $this->show();
    }

    //记录查询
    public function select(){
        $inventory_record_mdl = M('inventory_records');
        $records = $inventory_record_mdl->select();
        $this->assign('records',$records);
        $this->show();
    }


    //新增商品
    public function add(){
        $this->show();
    }

    //执行添加
    public function  doadd(){
        $product_mdl = M('products');
        //开启事物
        $product_mdl->startTrans();
        $stock_list_mdl = M('stock_lists');
        $finance_mdl = M('finances');
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public' ;
        $upload->savePath  =    '/uploads__/';
        $info   =   $upload->upload();
        if(!$info){
            $this->error($upload->getError());
        }else{
            //上传图片名
            $imagename = $info['file']['savename'];
            $path = $info['file']['savepath'].$info['file']['savename'];
        }
        $productData = array(
            'product_name'=>$_POST['name'],
            'product_store'=>$_POST['num'],
            'product_description'=>$_POST['descr'],
            'product_image'=>$path,
            'now_price'=>$_POST['sale_price'],
            'danshuang'=>'shop',
            'path'=>$path,
            'cat_id'=>15,
            'supplier'=>$_POST['supplier'],
        );
        $product_add = $product_mdl->add($productData);

        if(!$product_add){
            //回滚事物
            $product_mdl->rollback();
            exit();
        }
        $stock_listData = array(
            'product_id'=>  $product_add,
            'stock_price'=> $_POST['stock_price'],
            'sale_price'=> $_POST['sale_price'],
            'num'=> $_POST['num'],
            'time'=> date('Y-m-d H:i:s',time()),
            'supplier'=> $_POST['supplier'],
        );

        $stock_list_add = $stock_list_mdl->add($stock_listData);
        if($product_add && $stock_list_add){
            //录入账单表
            $this->insert_finance($product_add);
            //录入库存变化表
            $this->inventory_records($product_add);
            $product_mdl->commit();
            $this->success('添加商品成功！',U('index'));
        }else{
            $product_mdl->rollback();
            $this->error('添加商品失败！');
        }
    }
    //添加商品或库存时 录入财务账单表
    public function insert_finance($productid){
        $finance_mdl = M('finances');
        //录入账单表
        $financeData = array(
            'project'=>'商品进货',
            'product_id'=>$productid,
            'num'=>$_POST['num'],
            'price'=>$_POST['stock_price'],
            'allprice'=>$_POST['num']*$_POST['stock_price'],
            'time'=>date('Y-m-d H:i:s',time()),
            'entry_mode'=>1,
            'attr'=>2,
        );
        $finance_mdl->add($financeData);
    }

    //库存变化
    public function inventory_records($productid){
        $inventory_record_mdl = M('inventory_records');
        $Data = array(
          'product_id'=>$productid,
          'status'=>+$_POST['num'],
          'time'=>date('Y-m-d H:i:s',time()),
          'remark'=>'库存增加',
        );
        $inventory_record_mdl->add($Data);
    }
    //添加库存
    public function add_store(){
        $product_mdl = M('products');
        $products = $product_mdl->where(array('cat_id'=>15))->field('id,product_name')->select();
        $this->assign('products',$products);
        $this->show();
    }


    public function doadd_store(){
        $product_mdl = M('products');
        $product_mdl->startTrans();
        $stock_list_mdl = M('stock_lists');
        $products = $product_mdl->where(array('id'=>$_POST['name']))->find();
        if($products){
            $product_store = $products['product_store']+$_POST['num'];
        }
        $product_save = $product_mdl->where(array('id'=>$_POST['name']))->save(array('product_store'=>$product_store));
        if(!$product_save){
            //回滚事物
            $product_mdl->rollback();
            exit();
        }
        $stock_listData = array(
            'product_id'=>  $_POST['name'],
            'stock_price'=> $_POST['stock_price'],
            'sale_price'=> $products['now_price'],
            'num'=> $_POST['num'],
            'time'=> date('Y-m-d H:i:s',time()),
            'supplier'=> $_POST['supplier'],
        );
        $stock_list_add = $stock_list_mdl->add($stock_listData);
        if($product_save && $stock_list_add){
            //录入账单表
            $this->insert_finance($_POST['name']);
            //录入库存变化表
            $this->inventory_records($_POST['name']);
            $product_mdl->commit();
            $this->success('添加成功',U('index'),1);
        }else{
            $this->success('添加失败',U('doadd'),1);
            $product_mdl->rollback();
        }

    }

    public function edit_store(){  //库存统计->编辑
        $id = intval(I('get.id'));
        $products = M('products')->where(array('cat_id'=>15,'id'=>$id))->field('id,product_name,now_price,product_store,supplier')->find();
        $this->assign('products',$products);
        $this->display();
    }

    public function editSubmit(){    //对库存统计->编辑页面提交数据的处理
        $productsModel = M('products');
        $productsModel->startTrans();
        if(is_numeric(I('post.now_price'))){
            $now_price = I('post.now_price');
        }else{
            $this->error('价格必须是数字！');
            exit;
        }

        if(is_numeric(I('post.product_store'))){
            $product_store = I('post.product_store');
        }else{
            $this->error('库存量必须是数字！');
            exit;
        }
        $update = array(
            'product_name'  => I('post.product_name'),
            'now_price' => $now_price,
            'product_store' => $product_store,
            'supplier'      => I('post.supplier'),
        ); 
        $result = $productsModel->where(array('id'=>I('post.id')))->save($update);
        
        if($result){
            $productsModel->commit();
            $this->success('修改成功！',U('index'));
        }else{
            $this->success('发生错误，修改失败！');
            $productsModel->rollback();
        }
    } 

    public function delete(){  //删除操作
        $result = M('products')->where(array('id'=>I('get.id')))->delete();
        if($result){
            $this->success('删除成功！',U('index'));
        }else{
            $this->error('删除失败!');
        }
    }

}