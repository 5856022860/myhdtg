<?php
class BuyControl extends CommonControl{
	/**
	 * 订单提交页
	 */
	public function index(){
		//分配收货地址
		$db = K('user');
		$address = $db->getAddress($this->uid);
		$this->assign('address', $address);
		/** 处理订单  ***/
		$gid = $this->_get('gid','intval');
		$db = K('goods');
		$goods = $db->getGoodsFind($gid);
		$this->assign('goods',$goods);
		$this->display();
	}
	/**
	 * 付款页 
	 */
	public function payment(){
		if(IS_POST === true){
			if(!isset($_POST['addressid'])) $this->error('请选择一个收货地址!',U('Member/Account/setAddress'));
			if(is_array($_POST['gid'])){
				$data = $_POST;
				foreach ($data['gid'] as $k=>$v){
					$_POST['gid'] = $v;
					$_POST['price']  =$data['price'][$k];
					$_POST['goods_num']  =$data['goods_num'][$k];
					$_POST['addressid']  =$data['addressid'];
					if(!$this->addOrder()) throw new Exception('订单提交失败!');
				}
			}else{
				if(!$this->addOrder()) throw new Exception('订单提交失败!');
			}
		}
		
		$order = $this->getOrderData();
		$sumArr = array();
		foreach ($order as $v){
			$sumArr[] = $v['price']*$v['goods_num'];
		}
		$this->assign('sumPrice', array_sum($sumArr));
		$this->assign('order',$order);
		$db = K('user');
		$balance = $db->getUserBalance($this->uid);
		$this->assign('balance',$balance);
		$this->display();
	}
	/**
	 * 获取订单数据
	 */
	private  function  getOrderData(){
		$db = K('order');
		$orderid = $this->_get('oid','intval',null);
		if(is_null($orderid)){
			$where = array('user_id'=>$this->uid,'status'=>1);
		}else{
			$where = array('orderid'=>$orderid);
		}
		return  $db->getOrderData($where);
	}
	
	
	/**
	 * 添加订单
	 */
	private function addOrder(){
		$data =  array();
		$data['user_id']  = $this->uid;
		$data['goods_id']  =$this->_post('gid','intval');
		$data['goods_num']  =$this->_post('goods_num','intval');
		$data['addressid']  =$this->_post('addressid','intval');
		$data['total_money']  = $data['goods_num']*$this->_post('price','intval');
		$db = K('order');
		$where = array('user_id'=>$this->uid,'goods_id'=>$data['goods_id'],'status'=>1);
		if(!$db->checkOrder($where)){
			return $db->addOrder($data);
		}
		return true;
	}
	
	/**
	 * 购买成功
	 */
	public function buysuccess($orderids,$totalPrice){
		$db = K('order');
		if(!$db->updateStatus($orderids)){
			$this->error('付款失败!',U('Index/Index/index'));
		}else{
			$db = K('user');
			$db->updateBalance($this->uid,$totalPrice);
			$db = K('cart');
			$db->delCart(array('user_id'=>$this->uid));
			$this->display('buysuccess');
		}
	}
	
	/**
	 * 验证购物信息
	 */
	public function checkBuy(){
		if(IS_POST === false){
			exit;
		}
		$orderids = $_POST['orderid'];
		$db = K('order');
		$data = $db->getOrder($orderids);
		$sumArr = array();
		foreach ($data as $v){
			$sumArr[] = $v['price']*$v['goods_num'];
		}
		$totalPrice = array_sum($sumArr);
		$db = K('user');
		$balance = $db->getUserBalance($this->uid);
		if($balance<$totalPrice){
			$this->error('付款失败，请充值!',U('Member/Account/index'));
		}else{
			$this->buysuccess($orderids,$totalPrice);
		}
	}
}













?>