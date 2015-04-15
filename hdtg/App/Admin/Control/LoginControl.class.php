<?php
class LoginControl extends Control{
	
	
	public function index(){
		
		
		$this->display();
	}
	
	/**
	 * 登陆
	 */
	public function login(){
		if(IS_POST === false) exit();
		
		$username = $this->_post('username','addslashes','');
		$password = $this->_post('password','md5');
		$db = M('admin');
		$where = array('adminname'=>$username);
		$info = $db->where($where)->find();
		if($info['adminpass'] !=$password){
			$this->error('登陆失败!','index');
		}else{
			$_SESSION[C('RBAC_SUPER_ADMIN')] = $info['adminid'];
			$this->success('登陆成功!',U('Admin/Index/index'));
		}
	}
	
	
	/**
	 * 显示验证码
	 */
	public function showCode(){
		$code = new Code();
		$code->show();
	}
	/**
	 * 校验验证码
	 */
	public function checkCode(){
		$data =  array('statis'=>false);
		if($_SESSION['code'] == strtoupper($_POST['code'])){
			$data['status'] = true;
		}
		exit(json_encode($data));
	}
	
	/**
	 * 退出登录
	 */
	public function logout(){
		session_destroy();
		session_unset();
		$this->success('已退出!',__APP__);
	}
	
	
	
}
?>