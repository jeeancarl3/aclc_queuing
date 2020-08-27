<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 09:46:36
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-07 07:12:59
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function admin_login(){
		$this->load->view('login/login');
	}

	public function try_admin_login(){
		$this->load->model('admin_login');
		$aa = new Admin_Login;
		$user = $aa->verify_admin_login($this->input->post('username'),$this->input->post('password'));
		if($user){
			$aa->login($user);
			echo "<script>location.reload();</script>";
		}else{
			echo 'Invalid username or password.';
		}
	}

	public function window_login(){
		$this->load->view('login/window_login');
	}
	public function select_window(){
		$array = [
					'dp_office_id' => $this->input->post('o_id'),
					'dp_w_id' => $this->input->post('w_id')
				 ];
		$this->session->set_userdata( $array );
		redirect('/queue/queuing','refresh');
	}

	public function try_window_login(){
		$this->load->model('window_account_login');
		$aa = new Window_Account_Login;
		$user = $aa->verify_window_login($this->input->post('username'),$this->input->post('password'));
		if($user){
			$aa->login($user);
			echo "<script>location.href = '".base_url('index.php/queue/window_select')."'</script>";
		}else{
			echo 'Invalid username or password.';
		}
	}

	
}
