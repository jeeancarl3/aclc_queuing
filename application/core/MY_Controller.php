<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 09:48:31
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 16:05:10
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $userInfo;

	public function __construct()
	{
		parent::__construct();
		$aa = new Admin_Login;
		$aa->redirect_user();
		$this->userInfo = $aa->whose_logged();
		$wa = new Window_Account_Login;
		$wa->redirect_user();
		$this->userInfo = $wa->whose_logged();
	}

	public function logout(){
		$aa = new Admin_Login;
		$aa->logout();
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */