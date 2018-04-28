<?php
namespace Admin\Model;
use Think\Model;

class MemberModel extends Model{
	protected $tableName = 'member';
	protected $pk        = 'memberid';
	
	//获取全部设置信息
	public function getSetting(){
		
	}
	
	//保存设置
	public function dosave($datas = array()){
		
	}
	
	//清除设置相关缓存
	public function clearCatche(){
		S('setting_site', null);
		S('common_setting_behavior', null);
	}

	public function getUserInfo($userid){
	    $admin_role_db = D('Member');
	    $info = $this->where(array('memberid'=>$userid))->find();
		//if($info) $info['rolename'] = $admin_role_db->getRoleName($info['memberid']);    //获取角色名称
	    return $info;
	}
}