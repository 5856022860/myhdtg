<?php
class LocalityModel extends Model{
	
	public $table = 'locality';
	
	/***
	 * 查询所有的地区数据
	 */
	public function getLocalityAll(){
		return $this->select();
	}
	/**
	 * 添加地区
	 */
	public function addLocality($data){
		return $this->add($data);
	}
	/**
	 * 获取上级地区的信息
	 */
	
	public function getParentInfo($lid){
		$result = $this->field('lname,lid')->where(array('lid'=>$lid))->find();
		return $result?$result:array('lname'=>'顶级地区','lid'=>0);
	}
	
	/**
	 * 获取单挑数据
	 */
	public function getLocalityFind($lid){
		return $this->where(array('lid'=>$lid))->find();
	}
	/**
	 * 编辑地区
	 */
	public function editLocality($data,$lid){
		$this->where(array('lid'=>$lid))->save($data);
		return $this->getAffectedRows();
	}
	/**
	 * 验证是否存在子地区
	 */
	
	public function checkSonLocality($lid){
		return $this->where(array('pid'=>$lid))->count();
	}
	/**
	 * 删除子地区
	 */
	public function delLocality($lid){
		return $this->where(array('lid'=>$lid))->del();
	}
}


?>