<?php
namespace Mobile\Controller;
use Think\Controller;
class OrderController extends Controller {
	public function index(){
		$order_mdl = M('orders');
		$order_detail_mdl = M('order_details');
		$own_mdl = M('owns');
		$owns = $own_mdl->where(array('user_id'=>$_SESSION['id']))->select();
		//有认捐
		if(!empty($owns)){
			foreach($owns as $key=>$val){
				$product_id = $val['product_id'];
				$position_data = position_select($product_id);
				$warrant_number = warrant_select($product_id);
				$strname = $position_data['simiao'].$position_data['type'].$position_data['quyu'];
				$pailie = $position_data['weizhi'];
				$position = array(
					'strname'=>	$strname,
					'pailie'=>$pailie,
					'warrant'=>$warrant_number,
				);
				$info[] = $position;
			}
		}

		//待付款
		$filter['user_id'] = $_SESSION['id'];
		$filter['status'] = 0 ;
		$orders = $order_mdl->where($filter)->select();
		if(!empty($orders)){
			foreach($orders as $key=>$val){
				$order_details = $order_detail_mdl->where(array('orderid'=>$val['id']))->select();
				foreach($order_details as $k=>$v){
					$product_id = $v['product_id'];
					$position_data = position_select($product_id);
					$warrant_number = warrant_select($product_id);
					$strname = $position_data['simiao'].$position_data['type'].$position_data['quyu'];
					$pailie = $position_data['weizhi'];
					$position = array(
						'price' => $v['price'],
						'product_id'=>$product_id,
						'strname'=>	$strname,
						'pailie'=>$pailie,
						'warrant'=>$warrant_number,
					);
					$orders[$key]['info'][] = $position;
				}
			}
		}
		$this->assign('orders',$orders);
		$this->assign('positions',$info);
		$this->show();
	}
}

