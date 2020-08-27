<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:37:01
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 15:06:51
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/accounts/administrator/administrator');
        $this->load->view('admin/footer');
    }
    public function save_admin(){
    	$this->load->model('admin_account');
    	$aa = new Admin_Account;

    	if($this->input->post('aa_id') == ""){
    		$aa->fullname =  $this->input->post('fullname');
    		$aa->username =  $this->input->post('username');
    		$aa->password =  $this->input->post('password');
    		$aa->save();
            echo json_encode("success");
    	}else if($this->input->post('aa_id') != ""){
    		$aa->load($this->input->post('aa_id'));
    		$aa->fullname =  $this->input->post('fullname');
    		$aa->username =  $this->input->post('username');
    		$aa->password =  $this->input->post('password');
    		$aa->save();
            echo json_encode("success");
    	}

    }

    public function autoload_admin(){
        $this->load->model('admin_account');
        $aa = new Admin_Account;
        $aa = $aa->get();
        $data = [];
        if(!empty($aa)){
	        foreach ($aa as $key => $value) {
	            $data["data"][] = [		
	                                    $value->fullname,
	                                    $value->username,
	                                    $value->password,
	                                    "<center>
	                                        <a href='#' class='delete-aa' attr='$value->aa_id'><i class='glyphicon glyphicon-trash' style='color:#222;'></i></a>
	                                        <a href='#' class='edit-aa' attr='$value->aa_id'><i class='glyphicon glyphicon-pencil' style='color:#84f3cf;'></i></a>
	                                    </center>" 
	                              ];
	        }
        }
        echo json_encode($data);
    }

    public function get_info(){
        $this->load->model('admin_account');
        $aa = new Admin_Account;
        $aa = $aa->search(["aa_id" => $this->input->post('id')]);
        echo json_encode($aa);
    }

    public function delete_aa(){
        $this->load->model('admin_account');
        $aa = new Admin_Account;
        echo json_encode("success");
        $aa->load($this->input->post("id"));
        $aa->delete();
    }
}
        