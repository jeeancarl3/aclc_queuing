<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 10:10:02
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 15:17:31
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Login extends MY_Model {
    public function __construct(){
		parent::__construct();
	}
	public function verify_admin_login($username='',$password=''){
		$aa = new Admin_Account;
		$search = $aa->search(array('username' => $username,'password' => $password));
		if(count($search) > 0){
			return reset($search);
		}
		return false;
	}
	public function login($user = false){
		$array = array(
			'DP_USER_ID' => $user->aa_id,
			'DP_USER_PRIV' => $user->user_type,
		);

		$this->session->set_userdata( $array );
	}
	public function whose_logged(){
		if ($this->session->userdata('DP_USER_ID')) {
			$ac = new Admin_Account;
			$ac->load($this->session->userdata('DP_USER_ID'));
			return $ac;
		}
		return false;
	}
	public function redirect_user(){
		if($this->whose_logged() && $this->session->userdata("DP_USER_PRIV") == "admin" && $this->uri->segment(1) != "admin"){
			redirect('/admin/entity/office','refresh');
		}
		else if(!$this->whose_logged() && ($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == "employee")){
			redirect('/login/admin_login','refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('DP_USER_PRIV');
		$this->session->unset_userdata('DP_USER_ID');
		$this->redirect_user();
	}
}
        