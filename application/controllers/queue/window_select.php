<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 15:27:53
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 16:31:34
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Window_Select extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
    	$data['office'] = $this->load_offices();
    	$data['window'] = $this->load_windows();
        $this->load->view('login/window_select',$data);
    }
    public function load_offices(){
    	$this->load->model("offices");
    	$o = new Offices;
    	$o->toJoin = ["window_accounts" => "offices"];
    	$o = $o->search(['wa_id' => $this->session->userdata('DP_USER_ID')]);
    	return reset($o);
    }
    public function load_windows(){
    	$this->load->model('windows');
    	$w = new Windows;
    	$w->toJoin = ['offices' => 'windows'];
    	$w = $w->search(['office.o_id' => $this->load_offices()->o_id,
    					 'window.w_mode' => 'active']);
    	return $w;
    }
}
        