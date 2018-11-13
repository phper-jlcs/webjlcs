<?php
namespace Finance\Controller;
use Think\Controller;
class InoutController extends Controller {
    public function index(){
        $this->show();
    }

    /**
     *导出订单
     */
    public function export(){
        $id_str = I('get.id_str','','addslashes');
        $id_str = trim($id_str,',');
        //实例化订单表
        $order_mdl = M('orders');
        $user_mol = M('users');
        $agent_mdl = M('agents');
        $user_info_mdl = M('user_infos');
        $order_detail_mdl = M('order_details');
        $product_mdl = M('products');
        $good_mdl = M('goods');
        $orders = $order_mdl->where('id in('.$id_str.')')->select();
        foreach ($orders as $key => $value) {
            //认捐客户名称
            $users = $user_mol->where(array('id'=>$value['user_id']))->find();
            $orders[$key]['name'] = $users['name'];
            //佣金率 寺庙留 应付佣金
            $agents = $agent_mdl->where(array('agent_aid'=>$value['agent_aid']))->find();
            $orders[$key]['agent_ciny'] = $agents['agent_ciny'];
            $orders[$key]['yinfu'] = $value['order_total_price']*$agents['agent_ciny'];
            $orders[$key]['simiao'] = $value['order_total_price']-$orders[$key]['yinfu'];
            //付款人名称 客户身份证 电话 地址
            $user_infos = $user_info_mdl->where(array('id'=>$value['user_info_id']))->find();
            $orders[$key]['relname'] = $user_infos['relname'];
            $orders[$key]['cid'] = $user_infos['cid'];
            $orders[$key]['phone'] = $user_infos['phone'];
            $orders[$key]['address'] = $user_infos['address'];
            //echo '<pre>';print_r($orders);exit;
        }
        //引入框架核心类库
        Vendor('Excel.PHPExcel');
        //实例化类库
        $objPHPExcel=new \PHPExcel();
        //设置表格属性
        $objPHPExcel->getProperties()->setCreator('a')
            ->setLastModifiedBy('b')
            ->setTitle('标题')
            ->setSubject('主题')
            ->setDescription('描述')
            ->setKeywords('关键字')
            ->setCategory('c');

        //设置表格标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','订单号')
            ->setCellValue('B1','认捐日期')
            ->setCellValue('C1','会员卡号')
            ->setCellValue('D1','姓名')
            ->setCellValue('E1','手机号码')
            ->setCellValue('F1','身份证号')
            ->setCellValue('G1','地址')
            ->setCellValue('H1','位置')
            ->setCellValue('I1','标准价格')
            ->setCellValue('J1','备注')
        ;

        $i=2;
        //print_r($orders);exit;
        foreach($orders as $k=>$v){
            if($v['status'] == 0) {
                $status = '未支付';
            }else if($v['status'] == 1) {
                $status = '已支付';
            }else {
                $status = '已收货';
            }
            //订单属性（线上订单OR线下订单--->会员卡激活订单及后台手动付款订单）
            $Transaction_mode = $v['attr'] == 1?'线上':'线下';
            $Sales_method = isset($v['agent_aid'])?'1':'0';
            //代理商模式
            if($Sales_method == '1'){
                $agent_select = $agent_mdl->where(array('agent_aid'=>$v['agent_aid']))->find();
                $salemethod = $agent_select['relname'];
            }else{
                $salemethod = '自营';
            }
            //此处bug 若一个订单，2个莲位，应该有2个供奉权证号。  导出订单因为详情单
            $order_details = $order_detail_mdl->where(array('orderid'=>$v['id']))->select();
            foreach($order_details as $key=>$val){
                $warrant_number = $val['description'];
                $position = position_select($val['product_id']);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$v['order_id'])
                    ->setCellValue('B'.$i,$v['createtime'])
                    ->setCellValue('C'.$i,$v['user_number'])
                    ->setCellValue('D'.$i,$v['relname'])
                    ->setCellValue('E'.$i,$v['phone'])
                    ->setCellValue('F'.$i,$v['cid'])
                    ->setCellValue('G'.$i,$v['address'])
                    ->setCellValue('H'.$i,$position['weizhi'])
                    ->setCellValue('I'.$i,$val['price'])
                    ->setCellValue('J'.$i,$v['beizhu'])
                ;
                $i++;
            }



        }
        $objPHPExcel->getActiveSheet()->setTitle('订单管理');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename=urlencode('订单信息统计表').'_'.date('Y-m-dHis');

        /*
         *生成xlsx文件
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
         header('Cache-Control: max-age=0');
         $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        */

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;

    }
    
    
    /**
     *导出进账
     */
    public function houston(){
        $id_str = I('get.id_str','','addslashes');
        $id_str = trim($id_str,',');
        $product_mdl = M('products');
        $finance_mdl = M('finances');
        $str = str_replace('on,','',$id_str);
        $stock_lists = $finance_mdl->where('id in('.$str.')')->select();
           //echo '<pre>';print_r($stock_lists);exit;
        foreach($stock_lists as $key=>$val){
            $total = $val['stock_price']*$val['num'];
            $stock_lists[$key]['total'] = $total;
            $products = $product_mdl->where(array('id'=>$val['product_id']))->find();
            $stock_lists[$key]['product_name'] = $products['product_name'];
        }
        //引入框架核心类库
        Vendor('Excel.PHPExcel');
        //实例化类库
        $objPHPExcel=new \PHPExcel();
        //设置表格属性
        $objPHPExcel->getProperties()->setCreator('a')
            ->setLastModifiedBy('b')
            ->setTitle('标题')
            ->setSubject('主题')
            ->setDescription('描述')
            ->setKeywords('关键字')
            ->setCategory('c');

        //设置表格标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','项目')
            ->setCellValue('B1','商品名')
            ->setCellValue('C1','数量')
            ->setCellValue('D1','单价')
            ->setCellValue('E1','总价')
            ->setCellValue('F1','时间')
            ->setCellValue('G1','票据')
            ->setCellValue('H1','录入方式')
            ->setCellValue('I1','经手人')
            ->setCellValue('J1','属性')
        ;
        $i=2;       
            foreach($stock_lists as $key=>$v){
               //echo '<pre>';print_r($v);exit;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$v['project'])
                    ->setCellValue('B'.$i,$v['product_name'])
                    ->setCellValue('C'.$i,$v['num'])
                    ->setCellValue('D'.$i,$v['price'])
                    ->setCellValue('E'.$i,$v['allprice'])
                    ->setCellValue('F'.$i,$v['time'])
                    ->setCellValue('G'.$i,$v['ways'])
                    ->setCellValue('H'.$i,$v['entry_mode'])
                    ->setCellValue('I'.$i,$v['hand_man'])
                    ->setCellValue('J'.$i,$v['attr'])
                ;
                $i++;
            } 
        $objPHPExcel->getActiveSheet()->setTitle('进账管理');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename=urlencode('进账信息统计表').'_'.date('Y-m-dHis');

        /*
         *生成xlsx文件
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
         header('Cache-Control: max-age=0');
         $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        */

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;

    }
    
    
    
    /**
     *导出出账
     */
    public function out(){
    	$id_str = I('get.id_str','','addslashes');
        $id_str = trim($id_str,',');
        $product_mdl = M('products');
        $finance_mdl = M('finances');
        $str = str_replace('on,','',$id_str);
        $finances = $finance_mdl->where('id in('.$str.')')->select();
        //echo '<pre>';print_r($stock_lists);exit;
        //引入框架核心类库
        Vendor('Excel.PHPExcel');
        //实例化类库
        $objPHPExcel=new \PHPExcel();
        //设置表格属性
        $objPHPExcel->getProperties()->setCreator('a')
            ->setLastModifiedBy('b')
            ->setTitle('标题')
            ->setSubject('主题')
            ->setDescription('描述')
            ->setKeywords('关键字')
            ->setCategory('c');

        //设置表格标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','项目')
            ->setCellValue('B1','商品名')
            ->setCellValue('C1','单价')
            ->setCellValue('D1','数量')
            ->setCellValue('E1','采购总价')
            ->setCellValue('F1','时间')
        ;
        $i=2;       
            foreach($finances as $key=>$v){
            	$products = $product_mdl->where(array('id'=>$v['product_id']))->find();
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$v['project'])
                    ->setCellValue('B'.$i,$products['product_name'])
                    ->setCellValue('C'.$i,$v['price'])
                    ->setCellValue('D'.$i,$v['num'])
                    ->setCellValue('E'.$i,$v['allprice'])
                    ->setCellValue('F'.$i,$v['time'])
                ;
                $i++;
            } 
        $objPHPExcel->getActiveSheet()->setTitle('出账管理');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename=urlencode('出账信息统计表').'_'.date('Y-m-dHis');

        /*
         *生成xlsx文件
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
         header('Cache-Control: max-age=0');
         $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        */

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;

    }
    
    
    /**
     *导出盈利
     */
    public function profit(){
        //总利润----成本
        $finances = M('finances');
        $inventory_records = $finances->where(array('attr'=>1))->select();
        $inventory_record_other = $finances->where(array('attr'=>array('neq','1')))->select();
        //总利润
        $alltotal = 0;
        foreach($inventory_records as $k=>$val){
            $alltotal += $val['allprice'];
        }
        //echo '<pre>';print_r($alltotal);exit;
        //成本
        $stocktotal = 0;
        foreach($inventory_record_other as $ke=>$va){
            $stocktotal += $va['allprice'];
        }
        //利润
        $profit = $alltotal - $stocktotal;
        $datat = array(
          'alltotal'=> $alltotal,
          'stocktotal'=> $stocktotal,
          'profit'=> $profit,
        );
        $data[0] = $datat;
        //echo '<pre>';print_r($datat);exit;
        //引入框架核心类库
        Vendor('Excel.PHPExcel');
        //实例化类库
        $objPHPExcel=new \PHPExcel();
        //设置表格属性
        $objPHPExcel->getProperties()->setCreator('a')
            ->setLastModifiedBy('b')
            ->setTitle('标题')
            ->setSubject('主题')
            ->setDescription('描述')
            ->setKeywords('关键字')
            ->setCategory('c');

        //设置表格标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','总利润')
            ->setCellValue('B1','成本')
            ->setCellValue('C1','纯利润')

        ;
        $i=2;       
            foreach($data as $key=>$v){
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,$alltotal)
                    ->setCellValue('B'.$i,$stocktotal)
                    ->setCellValue('C'.$i,$profit)
                ;
                $i++;
            } 
        $objPHPExcel->getActiveSheet()->setTitle('盈利管理');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename=urlencode('盈利信息统计表').'_'.date('Y-m-dHis');

        /*
         *生成xlsx文件
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
         header('Cache-Control: max-age=0');
         $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        */

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;

    }
}