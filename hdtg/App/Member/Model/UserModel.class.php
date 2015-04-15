<?php
/**
 * 用户模型
 *
 */
class UserModel extends  viewModel{
	
	public $table = 'user';
	public $view;
	/**
	 * 验证字段是否存在
	 * @param  $field
	 * @param  $value
	 * @return int
	 */
	public function check($field,$value){
		return $this->where(array($field=>$value))->count();
	}
	/**
	 * 添加用户
	 */
	public function addUser($data){
		$uid =  $this->add($data);
		$data = array('user_id'=>$uid);
		$this->table('userinfo')->add($data);
		return $uid;
	}
	/**
	 * 获取用户
	 */
	public function getUser($where){
		return $this->where($where)->find();
	}
	/**
	 * 添加账户余额
	 */
	public function addBalance($uid){
		 return $this->table('userinfo')->inc('balance','user_id='.$uid,10000);
	}
	/**
	 * 添加收货地址
	 * @param unknown $data
	 */
	public function addAddress($data){
		return $this->table('user_address')->add($data);
	}
	/**
	 * 读取收货地址
	 */
	public function getAddress($uid){
		return $this->table('user_address')->where(array('user_id'=>$uid))->select();
	}
	/**
	 * 删除收货地址
	 * @param unknown $id
	 * @return mixed
	 */
	public function delAddress($id){
		return $this->table('user_address')->where(array('addressid'=>$id))->del();
	}
	
	/**
	 * 获取用户的账户余额
	 */
	public function getUserBalance($uid){
		$result = $this->field('balance')->table('userinfo')->where(array('user_id'=>$uid))->find();
		return $result['balance'];
	}
	
	/**
	 * 更新用户余额
	 */
	public function updateBalance($uid,$num){
		$this->table('userinfo')->dec('balance','user_id='.$uid,$num);
	}
	
	/**
	 * 验证时存在商品的收藏
	 */
	public function checkCollect($where){
		return $this->table('collect')->where($where)->count();
	}
	/**
	 * 添加收藏
	 */
	public function addCollect($data){
		return $this->table('collect')->add($data);
	}
	/**
	 * 查询用户收藏的商品
	 */
	public function getCollect($where){
		$this->view = array(
			'collect'=>array(
				'type'=>'inner',
				'on'=>'user.uid=collect.user_id'			
			),
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid=collect.goods_id'		
			)	
		);
		
		$fields = array(
			'main_title',
			'goods_img',
			'price',
			'end_time',
			'gid'					
		);
		
		return $this->field($fields)->where($where)->select();
		
	}
	/**
	 * 删除用户的收藏
	 */
	public function delCollect($where){
		return $this->table('collect')->where($where)->del();
	}
}


?>