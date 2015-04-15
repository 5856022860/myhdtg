<?php
class GoodsModel extends ViewModel{
	public $table ='goods';

	public function getGoods($in){
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time',
			'old_price'	
		);
		return $this->in(array('gid'=>$in))->select();
	}
	
	/**
	 * 查询单条商品的记录
	 */
	public function getGoodsFind($gid){
		$fields = array(
				'main_title',
				'gid',
				'price'
		);
		return $this->where(array('gid'=>$gid))->find();
	}
}
















?>