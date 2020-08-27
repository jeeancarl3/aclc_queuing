<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:53:44
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-12 16:25:20
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ad extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/ads/ad/body');
        $this->load->view('admin/footer');
    }
    public function save_ads(){
    	$this->load->model('ads');
    	$ad = new Ads;
    	
    	if($this->input->post('ads_id') != ""){
    		$ad->load($this->input->post('ads_id'));
    		$ad->file_type = $this->input->post('img_or_vid');
    		$ad->duration = $this->input->post('duration');
    		$ad->mode = 'active';
    		$ad->file_name = $this->input->post('file_name');
    		if ((isset($_FILES['file']) && !($_FILES['file']['name']) == "")){
    			$this->upload_file($ad->ads_id);
    			echo json_encode("success");
    		}else{
    			echo json_encode("success");
    		}
    	}else if($this->input->post('ads_id') == ""){
    		$ad->file_type = $this->input->post('img_or_vid');
    		$ad->duration = $this->input->post('duration');
    		$ad->mode = 'active';
    		$ad->file_name = $this->input->post('file_name');
    		$ad->save();
    		if ((isset($_FILES['file']) && !($_FILES['file']['name']) == "")){
    			$this->upload_file($ad->ads_id);
    			echo json_encode("success");
    		}else{
    			echo json_encode("success");
    		}
    	}
    }

    public function upload_file($id){
    	$this->load->model('ads');
    	$ads = new Ads;
        $_FILES['userfile']['name'] = $_FILES['file']['name'];
        $_FILES['userfile']['type'] = $_FILES['file']['type'];
        $_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
        $_FILES['userfile']['error'] = $_FILES['file']['error'];
        $_FILES['userfile']['size'] = $_FILES['file']['size'];

        $uploadPath = 'assets/images/adss/';
        $ext = explode("/", $_FILES['userfile']['type']);
        $ads->load($id);
        // $ads->path = $id.".".$ext[1];
        if($ext[1] == "jpeg" || $ext[1] == "JPEG"){
            $ads->path = $id.".jpg";
        }else if($ext[1] == 'png' || $ext[1] == "PNG"){
            $ads->path = $id.".".$ext[1];
        }else{
        	$ads->path = $id.".".$ext[1];
        }
        $ads->save();
        $config['file_name'] = $id;
        $config['upload_path'] = $uploadPath;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'flv|mp4|jpg|png|PNG|JPG';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $this->upload->do_upload('userfile');        
        
    }
    public function autoload_table(){
        $this->load->model('ads');
        $ads = new Ads;
        $ads = $ads->get();
        $data = [];
        foreach ($ads as $key => $value) {
            $data["data"][] = [
                                    "<center>".ucwords($value->file_type)."</center>",
                                    "<center>".ucwords($value->file_name)."</center>",
                                    "<center>".$value->duration."</center>",
                                    "<center> <a href='#' attr='$value->ads_id' class='act-button' style='text-decoration:none;'>".strtoupper($value->mode)."</a></center>",
                                    "<center>
                                        <a href='#' class='delete-ads' attr='$value->ads_id'><i class='glyphicon glyphicon-trash' style='color:#222;'></i></a>
                                        <a href='#' class='edit-ads' attr='$value->ads_id'><i class='glyphicon glyphicon-edit' style='color:#84f3cf;'></i></a>
                                    </center>" 
                              ];
        }
        
        echo json_encode($data);
    }
    public function get_info(){
        $this->load->model('ads');
        $off = new Ads;
        $off = $off->search(["ads_id" => $this->input->post('id')]);
        echo json_encode($off);
    }
    public function delete_ads(){
        $this->load->model('ads');
        $off = new Ads;
        echo json_encode("success");
        $off->load($this->input->post("id"));
        $off->delete();
    }
    public function activate_deactivate(){
    	$this->load->model('ads');
        $off = new Ads;
        $status = $this->input->post('status');
        $off->load($this->input->post('id'));
        if($status == "ACTIVE"){
        	$off->mode = 'inactive';
        	$off->save();
        	$data['msg'] = 'has been inactive';
        	$data['success'] = 'success';

        }else{
        	$off->mode = 'active';
        	$off->save();
        	$msg['msg'] = "has been active";
        	$data['success'] = 'success';
        }
        $ret = [];
        $ret = $data;
        
        echo json_encode($ret);
    }
}
        