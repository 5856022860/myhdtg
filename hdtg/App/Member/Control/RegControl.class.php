<?php
class RegControl extends Control{
	
	public function __init(){
		$this->setNav();
		$this->assign('userIsLogin',isset($_SESSION[C('RBAC_AUTH_KEY')]));
	}
	private function setNav(){
		$db = K('category');
		$nav = $db->getCategoryLevel(0);
		$this->assign('nav',$nav);
	}
	
	/**
	 * 显示注册界面
	 */
	public function index(){
		$this->display();
	}
	/**
	 * 显示验证码
	 */
	public function showCode(){
		$code = new Code();
		$code->show();
	}
	
	/**
	 * 验证表单
	 */
	public function check(){
		$this->db = K('user');
		//验证是否为ajax请求
		if(IS_AJAX === false)	throw new Exception('非法请求');
		$key =  addslashes(key($_POST));
		$value = $this->_post($key);
		switch ($key){
			case 'email':
				if($this->db->check('email',$value)){
					$result = array('status'=>false,'msg'=>'该邮箱已经存在');
				}else{
					$result = array('status'=>true);
				}
			break;	
			case 'username':
				if($this->db->check('uname',$value)){
					$result = array('status'=>false,'msg'=>'用户名已经存在');
				}else{
					$result = array('status'=>true);
				}
			break;	
			case 'code':
				if($_SESSION['code'] != strtoupper($value)){
					$result = array('status'=>false,'msg'=>'验证码输入有误!');
				}else{
					$result = array('status'=>true);
				}
			break;
		}
		exit(json_encode($result));
	}
	
	/**
	 * 添加用户
	 */
	public function addUser(){
		if(IS_POST === false) throw  new Exception('请求非法!');
		$this->db = K('user');
		$data = array();
		$data['email'] = $this->_post('email');
		$data['uname'] = $this->_post('username');
		$data['password'] = $this->_post('password','md5');
		$uid = $this->db->addUser($data);
		if($uid){
			$_SESSION[C('RBAC_AUTH_KEY')] = $uid;
			setcookie(session_name(),session_id(),time()+C('COOKIE_LIFT_TIME'),'/');
			$this->success('注册成功',U('Index/Index/index'));
		}else{
			$this->error('注册失败',U('Index/Index/index'));
		}
	}
	
}















?>