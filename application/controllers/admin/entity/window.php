<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:12:25
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 15:06:45
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Window extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
    	$data['offices'] = $this->load_office();
        $this->load->view('admin/header');
        $this->load->view('admin/entity/window/body',$data);
        $this->load->view('admin/footer');
    }

    public function load_office(){
    	$this->load->model('offices');
    	$off = new Offices;
    	$off = $off->search(['mode' => 'active']);
    	return $off;

    }
    public function save_window(){
    	$this->load->model('windows');
    	$win = new Windows;

    	if($this->input->post('w_id') == ""){
    		$win->o_id = $this->input->post('o_id');
    		$win->window_name =  $this->input->post('window_name');
    		$win->w_mode = "active";
    		$win->save();
            echo json_encode("success");
    	}else if($this->input->post('w_id') != ""){
    		$win->load($this->input->post('w_id'));
    		$win->o_id = $this->input->post('o_id');
    		$win->window_name =  $this->input->post('window_name');
    		$win->save();
            echo json_encode("success");
    	}

    }

    public function autoload_window(){
        $this->load->model('windows');
        $win = new Windows;
        $win->toJoin = [
        					'offices' => 'windows'
        				 ];
        $win = $win->get();
        $data = [];
        if(!empty($win)){
	        foreach ($win as $key => $value) {
	            $data["data"][] = [		
	            						ucwords($value->office_name),
	                                    ucwords($value->window_name),
	                                    "<a href='#' attr='$value->w_id' class='act-button' style='text-decoration:none;'>".strtoupper($value->w_mode)."</a>",
	                                    "<center>
	                                        <a href='#' class='delete-win' attr='$value->w_id'><i class='glyphicon glyphicon-trash' style='color:#222;'></i></a>
	                                        <a href='#' class='edit-win' attr='$value->w_id'><i class='glyphicon glyphicon-edit' style='color:#84f3cf;'></i></a>
	                                    </center>" 
	                              ];
	        }
        }
        echo json_encode($data);
    }

    public function get_info(){
        $this->load->model('windows');
        $win = new Windows;
        $win->toJoin = ['offices' => 'windows'];
        $win = $win->search(["w_id" => $this->input->post('id')]);
        echo json_encode($win);
    }

    public function activate_deactivate(){
    	$this->load->model('windows');
        $win = new Windows;
        $status = $this->input->post('status');
        $win->load($this->input->post('id'));
        if($status == "ACTIVE"){
        	$win->w_mode = 'inactive';
        	$win->save();
        	$data['msg'] = 'has been inactive';
        	$data['success'] = 'success';

        }else{
        	$win->w_mode = 'active';
        	$win->save();
        	$data['msg'] = "has been active";
        	$data['success'] = 'success';
        }
        $ret = [];
        $ret = $data;
        
        echo json_encode($ret);
    }

    public function delete_win(){
        $this->load->model('windows');
        $win = new Windows;
        echo json_encode("success");
        $win->load($this->input->post("id"));
        $win->delete();
    }
}
        