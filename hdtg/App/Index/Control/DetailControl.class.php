<?php
   class DetailControl extends CommonControl{
        private $gid; 
   		public function __auto(){
   			$this->gid = $this->_get('gid','intval',0);
        	$this->db = K('goods');
        	$this->setRecentView();
        }
   		/**
   		 * 显示细节页
   		 */
   		public function index(){
        	$detail = $this->db->getGoodsDetail($this->gid);
			$detail = $this->disDetailData($detail);
        	$this->getRelatedGoods($detail['cid']);
			$this->assign('detail',$detail);        	
        	$this->display();            
        }
    	/**
    	 * 处理商品细节数据
    	 */
        private function disDetailData($detail){
        	$detail['zhekou'] = round(($detail['price']/($detail['old_price']-1)*10),1);
        	$pathInfo = pathinfo($detail['goods_img']);
        	$detail['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_460x280.'.$pathInfo['extension'];
        	if($detail['end_time']-time()>(pow(60,2)*24*3)){
        		$detail['end_time'] = '剩余<span>3</span>天以上';
        	}else{
        		$detail['end_time'] = date('Y-m-d H:i:s').'下架';
        	}
        	$goodsServe = array_slice(unserialize($detail['goods_server']),0,2);
        	$serve = C('goods_server');
        	$detail['serve'] = array(
        			$serve[$goodsServe[0]],
        			$serve[$goodsServe[1]]
        	);
        	return $detail;
        }
        
        /**
         * 设置最近浏览
         */
        private function setRecentView(){
        	$key = encrypt('recent-view');
        	$value = isset($_COOKIE[$key])?unserialize(decrypt($_COOKIE[$key])):array();
        	if(!in_array($this->gid,$value)){
        		array_unshift($value, $this->gid);
        	}
        	setcookie($key,encrypt(serialize($value)),time()+86400,'/');
        } 
		/**
		 * 获得相关的商品数据
		 */        
        private function  getRelatedGoods($cid){
        	$related = $this->db->getRelatedGoods($cid);
        	foreach ($related as $k=> $v){
        		$pathInfo = pathinfo($v['goods_img']);
        		$related[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_200x100.'.$pathInfo['extension'];
        	}
        	$this->assign('related', $related);
        }
   }
?>