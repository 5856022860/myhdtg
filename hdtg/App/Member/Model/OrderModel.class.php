<?php
class OrderModel extends ViewModel{
	
	public $table ='order';
	public $view;
	
	public function addOrder($data){
		return $this->add($data);
	}
	
	/**
	 * 获取订单的数据
	 */
	public function getOrderData($where){
		$this->view = array(
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid=order.goods_id'			
			)	
				
		);
		$fields = array(
			'main_title',
			'price',
			'gid',
			'goods_num',
			'orderid',
			'goods_img',
			'status'				
		);
		return $this->field($fields)->where($where)->select();
	}
	/**
	 * 验证订单是否存在
	 */
	public function checkOrder($where){
		return $this->where($where)->count();
	}	
	/**
	 * 通过订单获取数据
	 */
	
	public function getOrder($orderids){
		$this->view = array(
				'goods'=>array(
						'type'=>'inner',
						'on'=>'goods.gid=order.goods_id'
				)
		
		);
		return $this->field(array('price','goods_num'))->in(array('orderid'=>$orderids))->select();
	}
	/**
	 * 修改订单的状态
	 */
	public function updateStatus($orderids){
		return $this->in(array('orderid'=>$orderids))->save(array('status'=>2));
	}
		
	/**
	 * 删除订单
	 */
	public function delOrder($where){
		return $this->where($where)->del();
	}
}









?>