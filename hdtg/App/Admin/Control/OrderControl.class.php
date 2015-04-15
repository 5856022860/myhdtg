<?php
class OrderControl extends CommonControl{
	
	public function __auto(){
		$this->db = K('order');
	}
	
	/**
	 * 显示订单
	 */
	public function index(){
		$where = $this->getWhere();
		$total = $this->db->getOrderTotal($where);
		$page = new Page($total);
		$order = $this->db->getOrder($where,$page->limit());
		$this->assign('page',$page->show());
		$this->assign('order',$order);
		$this->display();
	}
	/**
	 * 获取where条件
	 * @return multitype:
	 */
	private  function getWhere(){
		$where = array();
		$status =  $this->_get('status','intval',null);
		if(!is_null($status)){
			$where['status'] = $status;
		}
		return $where;
	}
	/**
	 * 删除订单
	 */
	public function del(){
		$oid=  $this->_get('orderid','intval',null);
		if($this->db->delOrder($oid)){
			$this->success('删除成功!','index');
		}else{
			$this->success('删除失败!','index');
		}
	}
	
	
}















?>