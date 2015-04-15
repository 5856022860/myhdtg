<?php
/**
 *	首页控制器 
 */
class IndexControl extends CommonControl{
	
	private $cid;		//分类主键
	private $lid;		//地区主键
	private $price;		//价格筛选
	private $url;		//检索的url
	private $order;		//排序规则
	/**
	 * 初始化
	 */
	public function __auto(){
		if(strlen(U('Index/Index/index'))>strlen(__URL__)){
			$this->url = U('Index/Index/index');
		}else{
			$this->url = url_param_remove('keywords',__URL__);
		}
		$this->db = K('goods');
		$this->cid = $this->_get('cid','intval',null);
		$this->lid = $this->_get('lid','intval',null);
		$this->price = $this->_get('price','',null);
		$this->order = $this->_get('order','','t-desc');
		$this->setCategory();
		$this->setLocality();
		$this->setPrice();
		$this->setOrderUrl();
		
	}
	/**
	 * 显示首页
	 */
    function index(){
    	$this->setSearchWhere();
    	$this->setOrder();
    	$total = $this->db->getGoodsTotal();
    	$page = new Page($total,10);
    	$data = $this->db->getGoods($page->limit());
    	$goods = $this->disGoods($data);
    	$this->setHotsGroup();
    	$this->assignHotsGoods();
    	$this->assign('goods',$goods);
    	$this->assign('page',$page->show());
    	$this->display();
    }
    
    
    
    /**
     * 处理查询结果
     */
    private function disGoods($data){
    	if(!is_array($data)) return;
    	foreach ($data as $k=>$v){
    		$pathInfo = pathinfo($v['goods_img']);
    		$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_310x190.'.$pathInfo['extension'];
    		$data[$k]['sub_title'] = mb_substr($v['sub_title'],0,30,'utf8');
    	}
    	return $data;
    }
    /**
     * 设置排序规则
     */
    private function setOrder(){
    	$order = '';
    	$arr = explode('-',$this->order);
    	switch ($arr[0]){
    		case 'd':
    			$order = 'begin_time '.$arr[1];
    		break;
    		case 'b':
    			$order = 'buy '.$arr[1];
    		break;
    		case 'p':
    			$order = 'price '.$arr[1];
    		break;
    		case 't':
    			$order = 'begin_time '.$arr[1];
    		break;
    	}
    	$this->db->order = $order;
    }
    
    /**
     * 设置搜索条件
     */
    private function setSearchWhere(){
    	if(isset($_GET['keywords'])){
    		$this->db->keywords = $_GET['keywords'];
    		return;
    	}
    	//组合分类条件
    	if(!is_null($this->cid)){
    		$db = K('category');
    		$sonCids = $db->getSonCategory($this->cid);
    		foreach ($sonCids as $v){
    			$this->db->cids['goods.cid'][] = $v['cid'];
    		}
    	}
    	//组合地区条件
    	if(!is_null($this->lid)){
    		$db = K('locality');
    		$sonLids = $db->getSonLocality($this->lid);
    		foreach ($sonLids as $v){
    			$this->db->lids['goods.lid'][] = $v['lid'];
    		}
    	}
    	//组合价格的条件
    	if(!is_null($this->price)){
    		$arr = explode('-',$this->price);
    		if(isset($arr[1])){
    			$this->db->price = 'price>'.$arr[0].' and price<'.$arr[1];	
    		}else{
    			$this->db->price = 'price>'.$arr[0];
    		}
    	}
    	
    }
    
    
    /**
     * 设置分类的模板
     * 1 没有cid 显示顶级分类
     * 2 有cid 显示顶级分类与子类
     */
    private function setCategory(){
    	$url = url_param_remove('cid',$this->url);
    	$db = K('category');
    	//当没有cid的时候
    	if(is_null($this->cid)){
    		$topCategory = $db->getCategoryLevel(0);
    		$tmpArr = array();
    		$tmpArr[] = '<a class="active" href="'.$url.'">全部</a>';
    		foreach ($topCategory as $v){
    			$tmpArr[] = '<a href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}
    		$this->assign('topCategory',$tmpArr);
    		return ;
    	}
    	//有cid的情况
    	/**
    	 * {
    	 * 		1. cid 是顶级的分类id   =>pid=?
    	 * 	
    	 * 		2. cid 不是顶级分类的id
    	 * 
    	 * }
    	 */
    	$pid = $db->getCategoryPid($this->cid);
    	$topCategory = $db->getCategoryLevel(0);
    	$tmpArr = array();
    	$tmpArr[] = '<a  href="'.$url.'">全部</a>';
    	foreach ($topCategory as $v){
    		if($pid == $v['cid'] || $this->cid == $v['cid']){
		    	$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
		    }else{
		    	$tmpArr[] = '<a href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
		    }
    	}
    	$this->assign('topCategory',$tmpArr);
    	if($pid == 0){
    		$sonCategory = $db->getCategoryLevel($this->cid);
    	}else{
    		$sonCategory = $db->getCategoryLevel($pid);
    	}
    	if(is_null($sonCategory)) return;
    	//组合子分类模板
    	$tmpArr = array();
    	if($pid == 0){
    		$tmpArr[] = '<a class="active"  href="'.$url.'/cid/'.$this->cid.'">全部</a>';
    	}else{
    		$tmpArr[] = '<a  href="'.$url.'/cid/'.$pid.'">全部</a>';
    	}
    	foreach ($sonCategory as $v){
    		if($v['cid'] == $this->cid){
    			$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}else{
    			$tmpArr[] = '<a  href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}
    	}
    	$this->assign('sonCategory', $tmpArr);
    }
    /**
     * 设置地区筛选模板
     */
    private function setLocality(){
    	$url = url_param_remove('lid',$this->url);
    	$db = K('locality');
    	//当没有cid的时候
    	if(is_null($this->lid)){
    		$topLocality = $db->getLocalityLevel(0);
    		$tmpArr = array();
    		$tmpArr[] = '<a class="active" href="'.$url.'">全部</a>';
    		foreach ($topLocality as $v){
    			$tmpArr[] = '<a href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    		}
    		$this->assign('topLocality',$tmpArr);
    		return ;
    	}
    	$pid = $db->getLocalityPid($this->lid);
    	$topLocality = $db->getLocalityLevel(0);
    	$tmpArr = array();
    	$tmpArr[] = '<a  href="'.$url.'">全部</a>';
    	foreach ($topLocality as $v){
    		if($pid == $v['lid'] || $this->lid == $v['lid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    		}else{
    			$tmpArr[] = '<a href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    		}
    	}
    	$this->assign('topLocality',$tmpArr);
    	if($pid == 0){
    		$sonLocality = $db->getLocalityLevel($this->lid);
    	}else{
    		$sonLocality = $db->getLocalityLevel($pid);
    	}
    	if(is_null($sonLocality)) return;
    	//组合子地区模板
    	$tmpArr = array();
    	if($pid == 0){
    		$tmpArr[] = '<a class="active"  href="'.$url.'/lid/'.$this->lid.'">全部</a>';
    	}else{
    		$tmpArr[] = '<a  href="'.$url.'/lid/'.$pid.'">全部</a>';
    	}
    	foreach ($sonLocality as $v){
    		if($v['lid'] == $this->lid){
    			$tmpArr[] = '<a class="active" href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    		}else{
    			$tmpArr[] = '<a  href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    		}
    	}
    	$this->assign('sonLocality', $tmpArr);
    }
    /**
     * 设置价格筛选模板
     */
    private function setPrice(){
    	$url = url_param_remove('price',$this->url);
    	
    	$db = K('category');
    	$key = '';
    	if(is_null($this->cid)){
    		$key = 'all';
    	}else{
    		$pid = $db->getCategoryPid($this->cid);
    		$key = $pid?$pid:$this->cid;
    	}
    	$prices = C('price');
    	$price = $prices[$key];
    	$tmpArr = array();
    	if(is_null($this->price)){
    		$tmpArr[] = '<a class="active" href="'.$url.'">全部</a>';
    	}else{
    		$tmpArr[] = '<a  href="'.$url.'">全部</a>';
    	}
    	foreach ($price as $v){
    		if($this->price == $v[1]){
    			$tmpArr[] = '<a  class="active" href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
    		}else{
    			$tmpArr[] = '<a  href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
    		}
    	}
    	$this->assign('price', $tmpArr);
    }
    /**
     * 设置排序的模板
     */
    private function setOrderUrl(){
    	$url = url_param_remove('order',$this->url);
		$orderUrl = array();
		//default 默认排序
		$orderUrl['d'] = $url.'/order/t-desc';
		//buy 销量降序
		$orderUrl['b'] = $url.'/order/b-desc';
		//price 价格降序
		$orderUrl['p_d'] = $url.'/order/p-desc';
		//price 价格升序
		$orderUrl['p_a'] = $url.'/order/p-asc';
		//begin_time 发表时间，降序
		$orderUrl['t'] = $url.'/order/t-desc';
		$this->assign('orderUrl', $orderUrl);
    }
    
    
    /**
     * 分配热卖商品
     */
	private function assignHotsGoods(){
		$hotsGoods = $this->db->getHotsGoods();
		$data = array();
		foreach ($hotsGoods as $k=> $v){
			$data[$k+1] = $v;
			$pathInfo = pathinfo($v['goods_img']);
			$data[$k+1]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_92x54.'.$pathInfo['extension'];
		}
		$this->assign('hotsGoods', $data);
	}
	/**
	 * 设置热门团购
	 */
	private function setHotsGroup(){
		$hotsGroup = $this->db->getHotsGroup();
		$this->assign('hotsGroup', $hotsGroup);
	}
}


?>