<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 14:51:33
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-29 02:21:04
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Office extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/entity/office/body');
        $this->load->view('admin/footer');

    }
    public function save_office(){
    	$this->load->model('offices');
    	$office = new Offices;

    	if($this->input->post('o_id') == ""){
    		$office->office_name =  $this->input->post('office_name');
    		$office->initial_code =  $this->input->post('initial_code');
    		$office->color = $this->input->post('color');
    		$office->mode = "active";
    		$office->save();
    		if ((isset($_FILES['file']) && !($_FILES['file']['name']) == "")){
                $this->up_image($office->o_id);
            }else{
                echo json_encode("success");
            }
    	}else if($this->input->post('o_id') != ""){
    		$office->load($this->input->post('o_id'));
    		$office->office_name =  $this->input->post('office_name');
    		$office->initial_code =  $this->input->post('initial_code');
    		$office->color = $this->input->post('color');
    		$office->mode = "active";
    		$office->save();
    		if ((isset($_FILES['file']) && !($_FILES['file']['name']) == "")){
                $this->up_image($office->o_id);
            }else{
                echo json_encode("success");
            }
    	}

    }

    public function up_image($id){
    	$this->load->model('offices');
    	$of = new Offices;
        $_FILES['userfile']['name'] = $_FILES['file']['name'];
        $_FILES['userfile']['type'] = $_FILES['file']['type'];
        $_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
        $_FILES['userfile']['error'] = $_FILES['file']['error'];
        $_FILES['userfile']['size'] = $_FILES['file']['size'];

        $uploadPath = 'assets/images/entity/office/';
        $ext = explode("/", $_FILES['userfile']['type']);
        $of->load($id);
        if($ext[1] == "jpeg" || $ext[1] == "JPEG"){
            $of->img_path = $uploadPath.$id.".jpg";
        }else{
            $of->img_path = $uploadPath.$id.".".$ext[1];
        }
        $of->save();
        $config['file_name'] = $id;
        $config['upload_path'] = $uploadPath;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'jpg|png|PNG|JPG';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('userfile')){
            echo json_encode("success");
        }
    }
    public function autoload_office(){
        $this->load->model('offices');
        $off = new Offices;
        $off = $off->get();
        $data = [];
        foreach ($off as $key => $value) {
            $data["data"][] = [
                                    ucwords($value->office_name),
                                    "<a href='#' attr='$value->o_id' class='act-button' style='text-decoration:none;'>".strtoupper($value->mode)."</a>",
                                    "<center>
                                        <a href='#' class='delete-office' attr='$value->o_id'><i class='glyphicon glyphicon-trash' style='color:#222;'></i></a>
                                        <a href='#' class='edit-office' attr='$value->o_id'><i class='glyphicon glyphicon-edit' style='color:#84f3cf;'></i></a>
                                    </center>" 
                              ];
        }
        
        echo json_encode($data);
    }

    public function get_info(){
        $this->load->model('offices');
        $off = new Offices;
        $off = $off->search(["o_id" => $this->input->post('id')]);
        echo json_encode($off);
    }

    public function activate_deactivate(){
    	$this->load->model('offices');
        $off = new Offices;
        $status = $this->input->post('status');
        $off->load($this->input->post('id'));
        if($status == "ACTIVE"){
        	$off->mode = 'inactive';
        	$off->save();
        	$data['msg'] = 'has been inactive';
        	$data['success'] = 'success';

        }else if($status == "INACTIVE"){
        	$off->mode = 'active';
        	$off->save();
        	$data['msg'] = "has been active";
        	$data['success'] = 'success';
        }
        $ret = [];
        $ret = $data;
        
        echo json_encode($ret);
    }

    public function delete_office(){
        $this->load->model('offices');
        $off = new Offices;
        echo json_encode("success");
        $off->load($this->input->post("id"));
        $off->delete();
    }

}
        