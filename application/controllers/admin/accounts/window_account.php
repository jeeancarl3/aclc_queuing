<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:36:14
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 15:06:53
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Window_Account extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
    	$data['offices'] = $this->load_office();
        $this->load->view('admin/header');
        $this->load->view('admin/accounts/window_account/body',$data);
        $this->load->view('admin/footer');
    }
    public function load_office(){
    	$this->load->model('offices');
    	$off = new Offices;
    	$off = $off->search(['mode' => 'active']);
    	return $off;

    }
    public function save_window_account(){
    	$this->load->model('window_accounts');
    	$wa = new Window_Accounts;

    	if($this->input->post('wa_id') == ""){
    		$wa->o_id = $this->input->post('o_id');
    		$wa->fullname =  $this->input->post('fullname');
    		$wa->username =  $this->input->post('username');
    		$wa->password =  $this->input->post('password');
    		$wa->save();
            echo json_encode("success");
    	}else if($this->input->post('wa_id') != ""){
    		$wa->load($this->input->post('wa_id'));
    		$wa->o_id = $this->input->post('o_id');
    		$wa->fullname =  $this->input->post('fullname');
    		$wa->username =  $this->input->post('username');
    		$wa->password =  $this->input->post('password');
    		$wa->save();
            echo json_encode("success");
    	}

    }

    public function autoload_window(){
        $this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->toJoin =  [
        					'offices' => 'window_accounts',
        				];
        $wa = $wa->get();
        $data = [];
        if(!empty($wa)){
	        foreach ($wa as $key => $value) {
	            $data["data"][] = [		
	            						ucwords($value->office_name),
	                                    $value->fullname,
	                                    $value->username,
	                                    $value->password,
	                                    "<center>
	                                        <a href='#' class='delete-wa' attr='$value->wa_id'><i class='glyphicon glyphicon-trash' style='color:#222;'></i></a>
	                                        <a href='#' class='edit-wa' attr='$value->wa_id'><i class='glyphicon glyphicon-pencil' style='color:#84f3cf;'></i></a>
	                                    </center>" 
	                              ];
	        }
        }
        echo json_encode($data);
    }

    public function get_info(){
        $this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->toJoin = ['offices' => 'window_accounts'];
        $wa = $wa->search(["wa_id" => $this->input->post('id')]);
        echo json_encode($wa);
    }

    public function delete_wa(){
        $this->load->model('window_accounts');
        $wa = new Window_Accounts;
        echo json_encode("success");
        $wa->load($this->input->post("id"));
        $wa->delete();
    }
}
        