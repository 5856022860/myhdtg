<?php
class ShopModel extends Model{
	
	public $table = 'shop';
	
	/**
	 * 添加商铺
	 * @param  $data
	 * @return mixed
	 */
	public function addShop($data){
		return $this->add($data);
	}
	/**
	 * 获取商铺的总数
	 */
	public function getShopTotal(){
		return $this->count();
	}
	/**
	 * 获得商铺的数据
	 */
	public function getShop($limit){
		return $this->limit($limit)->select();
	}
	/**
	 * 获取单挑商铺的数据
	 * 
	 */
	public function getShopFind($shopid){
		return $this->where(array('shopid'=>$shopid))->find();
	}
	/**
	 * 商铺编辑
	 */
	public function editShop($data,$shopid){
		$this->where(array('shopid'=>$shopid))->save($data);
		return $this->getAffectedRows();
	}
	/**
	 * 删除商铺
	 */
	
	public function delShop($shopid){
		return $this->where(array('shopid'=>$shopid))->del();
	}
	
}















?>