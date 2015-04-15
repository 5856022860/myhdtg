<?php
class UserControl extends  CommonControl{
	
	
	public function __auto(){
		$this->db  = K('user');
	}
	/**
	 * 显示用户列表
	 */
	public function index(){
		$where = $this->getWhere();
		$total = $this->db->getUserTotal($where);
		$page=  new Page($total);
		$user = $this->db->getUser($where,$page->limit());
		$this->assign('page',$page);
		$this->assign('user', $user);
		$this->display();
	}
	/**
	 * 获取where条件
	 * @return multitype:
	 */
	private function getWhere(){
		$where = array();
		
		return $where;
	}
	
	public function del(){
		$uid = $this->_get('uid','intval',0);
		if($this->db->delUser($uid)){
			$this->success('删除成功!','index');
		}else{
			$this->success('删除失败!','index');
		}
	}
	
}












?>