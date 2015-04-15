<?php
/**
 * 用户账户管理控制器
 * @author zhengyin
 */
class AccountControl extends CommonControl{
	/**
	 * 显示账户余额
	 */
	public function index(){
		$db = K('user');
		$balance = $db->getUserBalance($this->uid);
		$this->assign('balance', $balance);
		$this->display();	
	}
	/**
	 * 用户账户设置
	 */
	public function setting(){
		$this->display();
	}
	/**
	 * 设置收货地址
	 */
	public function setAddress(){
		$db = K('user');
		$address = $db->getAddress($this->uid);
		$this->assign('address', $address);
		$this->display();
	}
	
	public function delAddress(){
		$db = K('user');
		$id = $this->_get('addressid','intval');
		if($db->delAddress($id)){
			$this->success('删除成功!','setAddress');
		}else{
			$this->error('删除失败!','setAddress');
		}
	}
	/**
	 * 添加收货地址
	 */
	public function addAddress(){
		$data = array();
		foreach ($_POST as $k=>$v){
			$data[$k] = strip_tags($v);
		}
		$data['user_id'] = $this->uid;
		$db = K('user');
		if($db->addAddress($data)){
			$this->success('添加成功','index');
		}else{
			$this->error('添加失败','index');
		}
	}
	/**
	 * 账户充值
	 */
	public function add(){
		$db = K('user');
		$data = array();
		if($db->addBalance($this->uid)){
			$this->success('充值成功',U('index'));
		}else{
			$this->success('充值失败',U('index'));
		}
	}
}
?>