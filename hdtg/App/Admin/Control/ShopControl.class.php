<?php
class ShopControl extends CommonControl{
	public $shopid;
	
	
	public function __auto(){
		$this->shopid = $this->_get('shopid','intval',0);
		$this->db = K('shop');
	}
	/**
	 * 显示商铺列表
	 */
	public function index(){
		$total = $this->db->getShopTotal();
		$page = new Page($total,1);
		$data = $this->db->getShop($page->limit());
		$this->assign('data', $data);
		$this->assign('page',$page->show());
		$this->display();
	}
	/**
	 * 添加商铺
	 */
	public function add(){
		//是get请求显示模板
		if(IS_GET === true){
			$this->display();
			exit;
		}
		//post请求，完成数据的添加
		$data = $this->getData();
		if($this->db->addShop($data)){
			$this->success('添加商铺成功','index');
		}else{
			throw new Exception('添加失败!');
		}
	}
	/**
	 * 商铺编辑
	 */
	public function edit(){
		if(IS_GET === true){
			$shop = $this->db->getShopFind($this->shopid);
			$this->assign('shop',$shop);
			$this->display();
			exit;
		}
		$data = $this->getData();
		if($this->db->editShop($data,$this->shopid)){
			$this->success('编辑成功','index');
		}else{
			throw new Exception('编辑失败!');
		}
	}	
	/**
	 * 删除商铺
	 */
	public function del(){
		if($this->db->delShop($this->shopid)){
			$this->success('删除成功','index');
		}else{
			throw new Exception('删除失败');
		}
	}
	/**
	 * 组合数据
	 */	
	private function getData(){
		$data = array();
		$data['shopname'] = $this->_post('shopname','strip_tags');
		$data['shopaddress'] = $this->_post('shopaddress','strip_tags');
		$data['metroaddress'] = $this->_post('metroaddress','strip_tags');
		$data['shoptel'] = $this->_post('shoptel','strip_tags');
		$data['shopcoord'] = $this->_post('shopcoord','strip_tags');
		return $data;
	}
}

















?>