<?php
class LoginControl extends Control{
	
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
	 * 显示登录界面
	 */	
	public function index(){
		$this->display();
	}
	
	public function login(){
		if(IS_POST === false) throw new Exception('非法请求!');
		//获取post数据
		$username = $this->_post('username');
		$password = $this->_post('password','md5');
		//查询条件
		$where = array('uname'=>$username,'or','email'=>$username);
		$this->db = K('user');
		$userinfo = $this->db->getUser($where);
		//匹配密码
		if($userinfo['password'] == $password){
			$_SESSION[C('RBAC_AUTH_KEY')] = $userinfo['uid'];
			if(isset($_POST['auto_login'])){
				setcookie(session_name(),session_id(),time()+C('COOKIE_LIFT_TIME'),'/');
			}else{
				setcookie(session_name(),session_id(),0,'/');
			}
			$this->success('登陆成功!',U('Index/Index/index'));
		}else{
			$this->error('登陆失败!',U('Index/Index/index'));
		}
	}
	/**
	 * 用户退出
	 */
	public function quit(){
		setcookie(session_name(),session_id(),1,'/');
		session_unset();
		session_destroy();
		$this->success('退出成功',__ROOT__);
	}
}














?>