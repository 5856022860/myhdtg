<?php
class GoodsControl extends  CommonControl{
	
	private $gid;
	
	public function __auto(){
		$this->db = K('goods');
		$this->gid = $this->_get('gid','intval');
	}
	/**
	 * 展示商品列表
	 * 
	 */
	public function index(){
		$total = $this->db->getGoodsTotal();
		$page = new Page($total,10);
		$goods = $this->db->getGoodsAll($page->limit());
		$this->assign('goods',$goods);
		$this->assign('page',$page->show());
		$this->display();
	}
	/**
	 * 添加商品的
	 */
	public function add(){
		if(IS_GET === true){
			$this->setShop();	 //设置当前商品对应的商铺
			$this->setCategory();//设置分类选择
			$this->setLocality();//设置地区选择
			$this->assign('goods_server',C('goods_server'));
			$this->display();
			exit;
		}
		$data = $this->getData();
		if($this->db->addGoods($data)){
			$this->success('添加成功','index');
		}else{
			throw new Exception('添加商品失败！');
		}
	}
	
	/**
	 * 商品编辑
	 */
	public function edit(){
		//是get请求显示模板
		if(IS_GET === true){
			$goods = $this->db->getGoodsFind($this->gid);
			$this->setCategory();//设置分类选择
			$this->setLocality();//设置地区选择
			$this->assign('server',C('goods_server'));
			$goods['goods_server'] = unserialize($goods['goods_server']);
			$this->assign('goods', $goods);
			$this->display();
			exit;
		}
		$data = $this->getData();
		if($this->db->editGoods($data,$this->gid)){
			$this->success('编辑成功','index');
		}else{
			throw new Exception('编辑失败!');
		}
	}
	
	public function del(){
		if($this->db->delGoods($this->gid)){
			$this->success('删除成功!','index');
		}else{
			throw new Exception('删除失败!');
		}
	}
	
	
	/***
	 * 组合数据
	 */
	private function getData(){
		$data = array();
		$data['goods']['cid'] = $this->_post('cid','intval');
		$data['goods']['lid'] = $this->_post('lid','intval');
		$data['goods']['shopid'] = $this->_post('shopid','intval');
		$data['goods']['price'] = $this->_post('price','intval');
		$data['goods']['old_price'] = $this->_post('old_price','intval');
		$data['goods']['main_title'] = $this->_post('main_title','strip_tags');
		$data['goods']['sub_title'] = $this->_post('sub_title','strip_tags');
		$data['goods']['begin_time'] = $this->_post('begin_time','strtotime');
		$data['goods']['end_time'] = $this->_post('end_time','strtotime');
		//编辑时删除旧的图片
		if(isset($_POST['goods_img'])){
			if(isset($_POST['old_img'])){
				$this->delOldFile($_POST['old_img']);
			}
			$data['goods']['goods_img'] = $_POST['goods_img'][1]['path'];
		}
		$data['goods_detail']['detail'] = $_POST['detail'];
		$data['goods_detail']['goods_server'] = serialize($_POST['goods_server']);
		return $data;
	}
	
	/**
	 * 删除旧的图片
	 * @param  $img
	 */
	private function delOldFile($img){
		$pathInfo = pathinfo($img);
		//460,280,200,100,310,185,90,55
		$oldFiles = array(
			ROOT_PATH.$img,
			ROOT_PATH.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_460x280.'.$pathInfo['extension'],
			ROOT_PATH.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_200x100.'.$pathInfo['extension'],
			ROOT_PATH.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_310x185.'.$pathInfo['extension'],
			ROOT_PATH.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_90x55.'.$pathInfo['extension'],
		);
		foreach ($oldFiles as $v){
			if(file_exists($v)) unlink($v);
		}
	}
	
	
	/**
	 * 分配当前商品对应商铺的信息
	 */
	private function setShop(){
		$shopid = $this->_get('shopid','intval');
		$db = K('shop');
		$shop = $db->getShopFind($shopid);		
		$this->assign('shop',$shop);
	}
	/**
	 * 设置分类选择的数据
	 */
	private function setCategory(){
		$db = K('category');
		$data = $db->getCategoryAll();
		$category = Data::channel($data,'cid','pid',0,0,2,'--');
		$this->assign('category',$category);
	}
	/**
	 * 设置地区的选择数据
	 */
	private function setLocality(){
		$db = K('locality');
		$data = $db->getLocalityAll();
		$locality = Data::channel($data,'lid','pid',0,0,2,'--');
		$this->assign('locality',$locality);
	}
}

















?>