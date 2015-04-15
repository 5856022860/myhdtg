<?php
class OrderModel extends ViewModel{
	
	public $table = 'order';
	public $view = array(
		'goods'=>array(
			'type'=>'inner',
			'on'=>'goods.gid=order.goods_id'			
		)
	);
	/**
	 * 获取订单总数
	 */
	public function getOrderTotal($where){
		return $this->where($where)->count();
	}
	
	/**
	 * 获取订单
	 */
	public function getOrder($where,$limit){
		$fields = array(
			'main_title',
			'goods_num',
			'price',
			'orderid',
			'total_money',
			'status'		
		);
		return $this->field($fields)->where($where)->order('orderid desc')->limit($limit)->select();
	}
	
	/**
	 * 删除订单
	 */
	public function delOrder($oid){
		return $this->where(array('orderid'=>$oid))->del();
	}
	
	
}












?>