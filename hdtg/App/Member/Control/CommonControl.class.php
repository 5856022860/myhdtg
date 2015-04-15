<?php
class CommonControl extends Control{
	protected $db;	//数据库连接
	protected $uid;
	public function __init(){
		//如果没有登录，跳转到登录界面
		if(!isset($_SESSION[C('RBAC_AUTH_KEY')])){
			go(U('Member/Login/index'));
			exit;
		}
		//执行子控制器的方法
		if(method_exists($this,'__auto')){
			$this->__auto();
		}
		//配置uid
		$this->uid = (int)$_SESSION[C('RBAC_AUTH_KEY')];
		$this->setNav();
		$this->assign('userIsLogin',isset($_SESSION[C('RBAC_AUTH_KEY')]));
	}
	private function setNav(){
		$db = K('category');
		$nav = $db->getCategoryLevel(0);
		$this->assign('nav',$nav);
	}
	
	
	
}

?>