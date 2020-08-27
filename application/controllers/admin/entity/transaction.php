<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:04:50
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-18 11:33:43
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MY_Controller {


    function index() {
    	$data['offices'] = $this->load_office();
        $this->load->view('admin/header');
        $this->load->view('admin/entity/transaction/body',$data);
        $this->load->view('admin/footer');
    }
    public function load_office(){
    	$this->load->model('offices');
    	$trans = new Offices;
    	$trans = $trans->search(['mode' => 'active']);
    	return $trans;

    }
    public function save_transaction(){
    	$this->load->model('transactions');
    	$trans = new Transactions;

    	if($this->input->post('t_id') == ""){
    		$trans->o_id = $this->input->post('o_id');
    		$trans->trans_name =  $this->input->post('trans_name');
    		$trans->trans_code =  $this->input->post('trans_code');
    		$trans->t_mode = "active";
    		$trans->save();
    		if ((isset($_FILES['file']) && !($_FILES['file']['name']) == "")){
                $this->up_image($trans->t_id);
            }else{
                echo json_encode("success");
            }
    	}else if($this->input->post('t_id') != ""){
    		$trans->load($this->input->post('t_id'));
    		$trans->o_id = $this->input->post('o_id');
    		$trans->trans_name =  $this->input->post('trans_name');
    		$trans->trans_code =  $this->input->post('trans_code');
    		$trans->save();
    		if ((isset($_FILES['file']) && !($_FILES['file']['name']) == "")){
                $this->up_image($trans->t_id);
            }else{
                echo json_encode("success");
            }
    	}

    }

    public function up_image($id){
    	$this->load->model('transactions');
    	$trans = new Transactions;
        $_FILES['userfile']['name'] = $_FILES['file']['name'];
        $_FILES['userfile']['type'] = $_FILES['file']['type'];
        $_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
        $_FILES['userfile']['error'] = $_FILES['file']['error'];
        $_FILES['userfile']['size'] = $_FILES['file']['size'];

        $uploadPath = 'assets/images/entity/transaction/';
        $ext = explode("/", $_FILES['userfile']['type']);
        $trans->load($id);
        if($ext[1] == "jpeg" || $ext[1] == "JPEG"){
            $trans->img_paths = $uploadPath.$id.".jpg";
        }else{
            $trans->img_paths = $uploadPath.$id.".".$ext[1];
        }
        $trans->save();
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
    public function autoload_transaction(){
        $this->load->model('transactions');
        $trans = new Transactions;
        $trans->toJoin = [
        					'offices' => 'transactions'
        				 ];
        $trans = $trans->get();
        $data = [];
        if(!empty($trans)){
	        foreach ($trans as $key => $value) {
	            $data["data"][] = [		
	            						ucwords($value->office_name),
	                                    ucwords($value->trans_name),
	                                    "<a href='#' attr='$value->t_id' class='act-button' style='text-decoration:none;'>".strtoupper($value->t_mode)."</a>",
	                                    "<center>
	                                        <a href='#' class='delete-trans' attr='$value->t_id'>
                                                <i class='glyphicon glyphicon-trash' style='color:#222;'></i>
                                            </a> &nbsp;&nbsp;
	                                        <a href='#' class='edit-trans' attr='$value->t_id'>
                                                <i class='glyphicon glyphicon-edit' style='color:#84f3cf;'></i>
                                            </a>
	                                    </center>" 
	                              ];
	        }
        }
        // $ret[] = $data;
        echo json_encode($data);
    }

    public function get_info(){
        $this->load->model('transactions');
        $trans = new Transactions;
        $trans->toJoin = ['offices' => 'transactions'];
        $trans = $trans->search(['t_id' => $this->input->post('id')]);
        echo json_encode($trans);
    }

    public function activate_deactivate(){
    	$this->load->model('transactions');
        $trans = new Transactions;
        $status = $this->input->post('status');
        $trans->load($this->input->post('id'));
        if($status == "ACTIVE"){
        	$trans->t_mode = 'inactive';
        	$trans->save();
        	$data['msg'] = 'has been inactive';
        	$data['success'] = 'success';

        }else{
        	$trans->t_mode = 'active';
        	$trans->save();
        	$data['msg'] = "has been active";
        	$data['success'] = 'success';
        }
        $ret = [];
        $ret = $data;
        
        echo json_encode($ret);
    }

    public function delete_trans(){
        $this->load->model('transactions');
        $trans = new Transactions;
        echo json_encode("success");
        $trans->load($this->input->post("id"));
        $trans->delete();
    }
}
        