<?php
class CommonControl extends Control{
	
	protected $db;		//数据库连接
	
	public function __init(){
		if(method_exists($this,'__auto')){
			$this->__auto();
		}
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