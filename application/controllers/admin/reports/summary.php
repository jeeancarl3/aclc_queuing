<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:50:21
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 15:07:00
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/reports/summary/body');
        $this->load->view('admin/footer');
    }
}
        