<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 15:12:59
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-14 16:14:32
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Window_Account_Login extends MY_Model {
    public function __construct(){
		parent::__construct();
	}
	public function verify_window_login($username='',$password=''){
		$wa = new Window_Accounts;
		$search = $wa->search(array('username' => $username,'password' => $password));
		if(count($search) > 0){
			return reset($search);
		}
		return false;
	}
	public function login($user = false){
		$array = array(
			'DP_USER_ID' => $user->wa_id,
			'DP_USER_PRIV' => $user->user_type,
		);
		$this->session->set_userdata( $array );
	}

	public function whose_logged(){
		if ($this->session->userdata('DP_USER_ID')) {
			$ac = new Window_Accounts;
			$ac->toJoin = ['offices' => 'window_accounts'];
			$ac->load($this->session->userdata('DP_USER_ID'));
			return $ac;
		}
		return false;
	}
	public function redirect_user(){
		if($this->whose_logged() && ($this->session->userdata("dp_w_id") == null && $this->uri->segment(2) == 'queueing') ){
			redirect('/queue/window_select','refresh');
		}
		else if(!$this->whose_logged() && $this->uri->segment(1) == 'queue'){
			redirect('/login/window_login','refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('DP_USER_PRIV');
		$this->session->unset_userdata('DP_USER_ID');
		$this->session->unset_userdata('dp_office_id');
		$this->session->unset_userdata('dp_w_id');
		$this->redirect_user();
	}

	public function logon_window($o,$w){
		$array = ["DP_OFFICE_ID" => $o,"DP_WINDOW_ID" => $w];
		$this->session->set_userdata($array);
	}
}
        