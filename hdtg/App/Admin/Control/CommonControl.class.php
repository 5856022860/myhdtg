<?php
class CommonControl extends Control{
	protected $db;	//数据连接
	//初始化的
	public function __init(){
		if(!isset($_SESSION[C('RBAC_SUPER_ADMIN')])){
			$this->error('请登陆！',U('Admin/Login/index'));
		}
		if(method_exists($this,'__auto')){
			$this->__auto();
		}
	}
	
	
}













?>