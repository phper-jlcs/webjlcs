<?php
namespace WapAdmin\Controller;
use Think\Controller;
class InoutController extends Controller {
    public function index(){
        $this->show();
    }

    public function export(){
    	$ids = array_filter(explode(',', I('get.id_str')));
    	$map['id'] = array("in",$ids);
    	$orders = M('weixin_orders')->where($map)->select();
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
            ->setCellValue('B1','总价')
            ->setCellValue('C1','会员名')
            ->setCellValue('D1','订单状态')
            ->setCellValue('E1','数量')
            ->setCellValue('F1','下单时间')
            ->setCellValue('G1','配送方式')
        ;
        $i=2;

        foreach($orders as $k=>$v){
        	$username = M('weixin_users')->where(array('id'=>$v['user_id']))->getField('name');
            if($v['status'] == 0) {
                $status = '未支付';
            }else if($v['status'] == 1) {
                $status = '已支付';
            }else {
                $status = '已收货';
            }

            if($v['peisong'] == 0){
            }else{
            	$delivery = "自提点自提";
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,$v['order_id'])
                ->setCellValue('B'.$i,$v['order_total_price'])
                ->setCellValue('C'.$i,$username)  //要根据user_id进行组装
                ->setCellValue('D'.$i,$status)
                ->setCellValue('E'.$i,$v['order_num'])
                ->setCellValue('F'.$i,$v['createtime'])
                ->setCellValue('G'.$i,$delivery)
            ;
            $i++;
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
}