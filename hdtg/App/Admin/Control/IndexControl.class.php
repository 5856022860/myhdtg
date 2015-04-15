<?php
/**
 * 后台首页控制器
 * @author zhengyin
 * 
 */
class IndexControl extends CommonControl{
	/**
	 * 显示首页
	 */
    public function index(){
       $this->display();
    }
    /**
     * 欢迎界面
     */
    public function welcome(){
    	$this->assign('server',$_SERVER);
    	$this->display();
    }
    
}
?>