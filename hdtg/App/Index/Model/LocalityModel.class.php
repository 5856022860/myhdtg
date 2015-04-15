<?php
class LocalityModel extends Model{
	
	
	/**
	 * 按等级获取地区数据
	 */
	public function getLocalityLevel($pid){
		return $this->field('lname,lid')->where(array('pid'=>$pid,'display'=>1))->order('sort asc')->select();
	}
	/**
	 * 获取地区的父id
	 */
	public function getLocalityPid($lid){
		$result =  $this->field('pid')->where(array('lid'=>$lid))->find();
		return $result['pid'];
	}
	/**
	 * 获取所有的子地区id
	 */
	public function getSonLocality($lid){
		$result = $this->field('lid')->where(array('pid'=>$lid))->select();
		if(is_null($result)){
			$result = array(array('lid'=>$lid));
		}
		return $result;
	}
	
}










?>