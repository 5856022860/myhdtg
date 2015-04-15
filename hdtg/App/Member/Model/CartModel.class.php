<?php
/**
 * 购物车模型 
 */
class CartModel extends ViewModel{
	public $view = array(
			
	);
	

	/**
	 * 获取商品的数据
	 */
	public function getGoods($where){
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time'		
		);
		return $this->table('goods')->field($fields)->where($where)->find();
	}
	/**
	 * 添加购物车
	 */
	public function addCart($data){
		return $this->add($data);
	}
	/**
	 * 验证购物车信息是否存在
	 */
	public function checkCart($where){
		$result = $this->field('cart_id')->where($where)->find();
		return isset($result['cart_id'])?$result['cart_id']:null;
	}
	
	/**
	 * 自增购物车
	 */
	public function incCart($id,$num){
		return $this->inc('goods_num','cart_id='.$id,$num);
	}
	/**
	 * 统计购物车总数
	 */
	public function countCart($where){
		return $this->where($where)->count();
	}
	/**
	 * 更新购物车商品数量
	 */
	public function updateCartNum($where,$num){
		$this->where($where)->save(array('goods_num'=>$num));
		return $this->getAffectedRows();
	}
	
	/**
	 * 获取所有购物车的数据
	 */
	public function getCartAll($uid){
		$this->view = array(
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid=cart.goods_id'						
			)
		);
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time',
			'cart_id',
			'goods_num'	
		);
		return $this->field($fields)->where(array('user_id'=>$uid))->select();
	}
	/**
	 *删除购物车
	 */
	public function delCart($where){
		return $this->where($where)->del();
	}

}








?>