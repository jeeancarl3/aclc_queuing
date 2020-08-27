<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 07:33:27
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-27 09:54:46
 */
class Kiosk extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['office'] = $this->load_offices();
        $this->load->view('kiosk/header');
        $this->load->view('kiosk/body',$data);
        $this->load->view('kiosk/footer');
    }
    public function load_offices(){
        $this->load->model('offices');
        $o = new Offices;
        $o = $o->get();
        return $o;
    }
    public function select_transaction($id){
        $this->load->model('transactions');
        $t = new Transactions;
        $t->toJoin = ["offices" => "transactions"];
        $t = $t->search(["transactions.o_id" => $id]);
        $data['trans'] = $t;
        // echo "<pre>";
        // print_r($data);
        $this->load->view('kiosk/header');
        $this->load->view('kiosk/transaction/body',$data);
        $this->load->view('kiosk/footer');
    }

    public function print_queue_regular(){
        $this->load->model('queue_counter');
        $qc = new Queue_Counter;
        $qc->db->select("*, Max(queue_counter.queue_no) as max_num
                        FROM
                         queue_counter
                        WHERE
                         queue_counter.t_id = '".$this->uri->segment(3)."' AND
                         queue_counter.date = '".date("Y-m-d")."'"); //'".$id."'"

        $query = $qc->db->get();
        $max = $query->result();
        $this->load->model('transactions');
        $t = new Transactions;
        $t->toJoin = ["offices" => "transactions"];
        $t = $t->search(['t_id' => $this->uri->segment(3)]);
        $t = reset($t);
        $maxs = "";
        foreach ($max as $key => $value) {
            $iqc = new Queue_Counter;
            if($value->max_num == NULL){
                $iqc->queue_no = 1;
                $maxs = $iqc->queue_no;
            }else{
                $iqc->queue_no = $value->max_num+1;
                $maxs = $iqc->queue_no;
            }

            $iqc->t_id = $t->t_id;
            $iqc->o_id = $t->o_id;
            $iqc->prev_id  = $this->uri->segment(4);
            $iqc->date  = date("Y-m-d");
            $iqc->status = 'waiting';
            $iqc->save();
        }
        // $data["max"] = strtoupper($t->initial_code.$t->trans_code."-".sprintf('%04d', 0000 + $maxs));
        $data["max"] = strtoupper($t->initial_code.$t->trans_code."-".$maxs);
        $this->load->view('kiosk/transaction/print',$data);
    }

    public function finance(){
    	$this->load->view('kiosk/header');
        $this->load->view('kiosk/finance/body');
        $this->load->view('kiosk/footer');
    }
    public function registrar(){
    	$this->load->view('kiosk/header');
        $this->load->view('kiosk/registrar/body');
        $this->load->view('kiosk/footer');
    }
    public function edp(){
    	$this->load->view('kiosk/header');
        $this->load->view('kiosk/edp/body');
        $this->load->view('kiosk/footer');
    }
}
        