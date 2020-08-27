<?php

/**
 * @Author: Gian
 * @Date:   2019-01-09 09:47:24
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-21 13:40:44
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Queuing extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
    	$data['pre_load'] = $this->pre_load();
        $data['load_o'] = $this->select_office();
        $this->load->view('queue/header');
        $this->load->view('queue/body',$data);
        $this->load->view('queue/footer');
    }

    public function pre_load(){
        $this->load->model('windows');
        $w = new Windows;
        $w->toJoin = ["offices" => "windows"];
        $w = $w->search(["w_id" => $this->session->userdata('dp_w_id')]);
        $w = reset($w);
        return $w;
    }
    public function call_a_queue(){
    	$this->load->model('queue_counter');
        $queue_counter = new Queue_Counter;
        $queue_counter->toJoin = [
                                    "transactions" => "queue_counter",
                                    "offices" => "transactions",
                                    "window_accounts" => "offices",
                                    "windows" => "queue_counter",
                                 ];
        $queue_counter->sqlQueries = ["order_type" => "ASC",'order_field' => 'queue_no',"toGroup" => false];
        $queue_counter = $queue_counter->search(["status"=>'waiting',"date" => date("Y-m-d"), "window.w_id" => $this->session->userdata('dp_w_id')]);
        echo json_encode($queue_counter);
    }

    public function load_window(){

    	$this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->db->distinct();
        $wa->db->select("*,trans_name,trans_code,initial_code
							FROM
								`window_account`
							JOIN `office` ON `office`.`o_id` = `window_account`.`o_id`
							JOIN `window` ON `window`.`o_id` = `office`.`o_id`
							JOIN `transactions` ON `transactions`.`o_id` = `office`.`o_id`
							WHERE
								`office`.`mode` = 'active'
							AND `window`.`w_mode` = 'active'
							AND `transactions`.`t_mode` = 'active'
							AND `window_account`.`wa_id` = '".$this->session->userdata('DP_USER_ID')."'
                            GROUP BY
                                transactions.t_id
							ORDER BY
								`window`.`window_name`");

        $query = $wa->db->get();
        $windows = $query->result();
        $this->load->model('transactions');
        $t = new Transactions;
        $data = [];
        foreach ($windows as $key => $value) {
        	$t->db->select("*, count(queue_counter.t_id) as sum
							FROM
								transactions
							INNER JOIN queue_counter ON queue_counter.t_id = transactions.t_id
							INNER JOIN office ON transactions.o_id = office.o_id AND queue_counter.o_id = office.o_id
							WHERE queue_counter.date = '".date("Y-m-d")."'
							GROUP BY transactions.trans_code");
        	$t_query = $t->db->get();
        	$t_result = $t_query->result();
        	foreach ($t_result as $key1 => $value1) {
                if($value->trans_code == $value1->trans_code){
                    $data["data"][] = [
                                        "trans_code" => $value->trans_code,
                                        "initial_code"=>$value->initial_code,
                                        "trans_name" => $value->trans_name,
                                        "total_queue"=> $value1->sum,
                                        "wa_id" => $value->wa_id,
                                        "w_id"=>$value->w_id,
                                        "t_id"=> $value1->t_id,
                                        "o_id"=>$value1->o_id,
                                        "qc_id" => $value1->qc_id
                                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function totalQ(){
        $this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->db->distinct();
        $wa->db->select("*,trans_name,trans_code,initial_code
                            FROM
                                `window_account`
                            JOIN `office` ON `office`.`o_id` = `window_account`.`o_id`
                            JOIN `window` ON `window`.`o_id` = `office`.`o_id`
                            JOIN `transactions` ON `transactions`.`o_id` = `office`.`o_id`
                            WHERE
                                `office`.`mode` = 'active'
                            AND `window`.`w_mode` = 'active'
                            AND `transactions`.`t_mode` = 'active'
                            AND `window_account`.`wa_id` = '".$this->session->userdata('DP_USER_ID')."'
                            GROUP BY
                                transactions.t_id
                            ORDER BY
                                `window`.`window_name`");

        $query = $wa->db->get();
        $windows = $query->result();
        $this->load->model('transactions');
        $t = new Transactions;
        $data = [];
        foreach ($windows as $key => $value) {
            $t->db->select("*, CAST(count(queue_counter.t_id) as unsigned) AS sum
                            FROM
                                transactions
                            INNER JOIN queue_counter ON queue_counter.t_id = transactions.t_id
                            INNER JOIN office ON transactions.o_id = office.o_id AND queue_counter.o_id = office.o_id
                            WHERE queue_counter.date = '".date("Y-m-d")."' AND queue_counter.t_id = '".$this->input->post('t_id')."' AND queue_counter.status = 'waiting'
                            GROUP BY transactions.trans_code");
            $t_query = $t->db->get();
            $t_result = $t_query->result();
            foreach ($t_result as $key1 => $value1) {
                if($value->trans_code == $value1->trans_code){
                    if($value1->sum >= 1){
                        echo json_encode($value1->sum);
                    }
                     else{
                        echo json_encode("100");
                        
                    }
                    
                }
            }
        }
    }
    public function totalSkip(){
        $this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->db->distinct();
        $wa->db->select("*,trans_name,trans_code,initial_code
                            FROM
                                `window_account`
                            JOIN `office` ON `office`.`o_id` = `window_account`.`o_id`
                            JOIN `window` ON `window`.`o_id` = `office`.`o_id`
                            JOIN `transactions` ON `transactions`.`o_id` = `office`.`o_id`
                            WHERE
                                `office`.`mode` = 'active'
                            AND `window`.`w_mode` = 'active'
                            AND `transactions`.`t_mode` = 'active'
                            AND `window_account`.`wa_id` = '".$this->session->userdata('DP_USER_ID')."'
                            GROUP BY
                                transactions.t_id
                            ORDER BY
                                `window`.`window_name`");

        $query = $wa->db->get();
        $windows = $query->result();
        $this->load->model('transactions');
        $t = new Transactions;
        $data = [];
        foreach ($windows as $key => $value) {
            $t->db->select("*, count(queue_counter.t_id) as sum
                            FROM
                                transactions
                            INNER JOIN queue_counter ON queue_counter.t_id = transactions.t_id
                            INNER JOIN office ON transactions.o_id = office.o_id AND queue_counter.o_id = office.o_id
                            WHERE queue_counter.date = '".date("Y-m-d")."' AND queue_counter.t_id = '".$this->input->post('t_id')."' AND queue_counter.status = 'skip'
                            GROUP BY transactions.trans_code");
            $t_query = $t->db->get();
            $t_result = $t_query->result();
            foreach ($t_result as $key1 => $value1) {
                if($value->trans_code == $value1->trans_code){
                    echo json_encode($value1->sum);
                }
            }
        }
    }

    public function retainNumber(){
        $this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->db->distinct();
        $wa->db->select("*,trans_name,trans_code,initial_code
                            FROM
                                `window_account`
                            JOIN `office` ON `office`.`o_id` = `window_account`.`o_id`
                            JOIN `window` ON `window`.`o_id` = `office`.`o_id`
                            JOIN `transactions` ON `transactions`.`o_id` = `office`.`o_id`
                            WHERE
                                `office`.`mode` = 'active'
                            AND `window`.`w_mode` = 'active'
                            AND `transactions`.`t_mode` = 'active'
                            AND `window_account`.`wa_id` = '".$this->session->userdata('DP_USER_ID')."'
                            GROUP BY
                                transactions.t_id
                            ORDER BY
                                `window`.`window_name`");

        $query = $wa->db->get();
        $windows = $query->result();
        $this->load->model('queue_counter');
        $t = new Queue_Counter;
        $data = [];
        foreach ($windows as $key => $value) {
            $t->db->select("*, Max(queue_counter.queue_no) as sum
                            FROM
                            queue_counter
                            WHERE
                            queue_counter.date = '".date("Y-m-d")."' AND
                            queue_counter.t_id = '".$this->input->post('t_id')."' AND
                            queue_counter.`status` = 'done'");
            $t_query = $t->db->get();
            $t_result = $t_query->result();
            foreach ($t_result as $key1 => $value1) {
                if($value->t_id == $value1->t_id){
                    echo json_encode($value1->sum);
                }
            }
        }
    }


    public function skip(){
    	$this->load->model('window_accounts');
        $wa = new Window_Accounts;
        $wa->db->distinct();
        $wa->db->select("trans_name,trans_code,initial_code
							FROM
								`window_account`
							JOIN `office` ON `office`.`o_id` = `window_account`.`o_id`
							JOIN `window` ON `window`.`o_id` = `office`.`o_id`
							JOIN `transactions` ON `transactions`.`o_id` = `office`.`o_id`
							WHERE
								`office`.`mode` = 'active'
							AND `window`.`w_mode` = 'active'
							AND `transactions`.`t_mode` = 'active'
							AND `window_account`.`wa_id` = '".$this->session->userdata('DP_USER_ID')."'
							ORDER BY
								`window`.`window_name`");

        $query = $wa->db->get();
        $windows = $query->result();
        $this->load->model('transactions');
        $t = new Transactions;
        $data = [];
        foreach ($windows as $key => $value) {
        	$t->db->select("*, count(queue_counter.status) as skip
							FROM
								transactions
							INNER JOIN queue_counter ON queue_counter.t_id = transactions.t_id
							INNER JOIN office ON transactions.o_id = office.o_id AND queue_counter.o_id = office.o_id
							WHERE
							queue_counter.date = CURDATE() AND
							queue_counter.`status` = 'skip'
							GROUP BY
								transactions.trans_code");
        	$t_query = $t->db->get();
        	$t_result = $t_query->result();
        	foreach ($t_result as $key1 => $value1) {
        		if($value->trans_code == $value1->trans_code){
        			$data["data"][] = ["skip"=> $value1->skip, "skip_code" => $value->trans_code];
        		}
        	}
        }
        echo json_encode($data);
    }

    public function count_queue(){
        $this->load->model('transactions');
        $t = new Transactions;
        $t->db->select("*, count(queue_counter.t_id) as sum
                            FROM
                                transactions
                            INNER JOIN queue_counter ON queue_counter.t_id = transactions.t_id
                            INNER JOIN office ON transactions.o_id = office.o_id AND queue_counter.o_id = office.o_id
                            WHERE queue_counter.date = '".date("Y-m-d")."'
                            GROUP BY transactions.trans_code");
        $t_query = $t->db->get();
        $t_result = $t_query->result();
        foreach ($t_result as $key1 => $value1) {
            return $value1->sum;
        }
    }
    public function done_next(){
    	$this->load->model('queue_counter');
    	$qc = new Queue_Counter;
    	$qc->sqlQueries = ["order_type" => "ASC",'order_field' => 'queue_no',"toGroup" => false];
    	$qc = $qc->search(["date"=>date("Y-m-d"),"status"=>'waiting',"o_id" => $this->input->post('o_id'),'t_id'=>$this->input->post('t_id')]);
        if($qc){
            $next = reset($qc);
            echo json_encode($next);
    		$qc1 = new Queue_Counter;
	    	$qc1->load($next->qc_id);
	    	$qc1->w_id = $this->session->userdata('dp_w_id');
	    	$qc1->wa_id = $this->input->post('wa_id');
	    	$qc1->status = "done";
            $qc1->time_call = date("H:i:s");
	    	$qc1->save();
    	}else{
            echo json_encode(["t_id" => $this->input->post("t_id"),"output" => "0",'return' => false]);
        }
    }

    public function skip_to_next(){
        $this->load->model('queue_counter');
        $qc = new Queue_Counter;
        $qc = $qc->search(["qc_id" => $this->input->post('qc_id')]);
        $next = reset($qc);
        echo json_encode($next);
        if($next){
            $qc1 = new Queue_Counter;
            $qc1->load($next->qc_id);
            $qc1->w_id = $this->session->userdata('dp_w_id');
            $qc1->wa_id = $this->input->post('wa_id');
            $qc1->status = "skip";
            $qc1->save();
        }

    }


    public function skip_next(){
        $this->load->model('queue_counter');
        $qc = new Queue_Counter;
        $qc->sqlQueries = ["order_type" => "ASC",'order_field' => 'queue_no',"toGroup" => false];
        $qc = $qc->search(["qc_id" => $this->input->post('qc_id'),"date"=>date("Y-m-d"),"status"=>'skip',"o_id" => $this->input->post('o_id'),'t_id'=>$this->input->post('t_id')]);
        $next = reset($qc);
        echo json_encode($next);
        if($next){
            $qc1 = new Queue_Counter;
            $qc1->load($next->qc_id);
            $qc1->w_id = $this->session->userdata('dp_w_id');
            $qc1->wa_id = $this->input->post('wa_id');
            $qc1->status = "done";
            $qc1->time_call = date("H:i:s");
            $qc1->save();
        }
    }

    public function load_skip(){
        $this->load->model('queue_counter');
        $qc = new Queue_Counter;
        $qc->toJoin = ["previlage" => "queue_counter","offices" => "queue_counter","transactions" => "queue_counter"];
        $qc->sqlQueries = ["order_type" => "DESC",'order_field' => 'queue_no',"toGroup" => false];
        $qc = $qc->search(['queue_counter.date' => date('Y-m-d'),'queue_counter.o_id' => $this->session->userdata('dp_office_id'), 'queue_counter.status' => 'skip']);
        $data = [];
        foreach ($qc as $key => $value) {
            // echo $value->queue_no."<br />";
            $data["data"][] = [
                                "<center><b>".strtoupper($value->initial_code."".$value->trans_code."-000".$value->queue_no)."</b></center>",
                                "<center><b>".strtoupper($value->trans_name)."</b></center>",
                                "<center>
                                	<b>
                                		<a href='#' class='btn-call-skip' style='text-decoration:none;' onClick=skip_next($value->qc_id,$value->wa_id,$value->w_id,$value->t_id,$value->o_id,'".strtoupper($value->initial_code."".$value->trans_code)."') >
                                			NEXT
                                		</a>
                                	</b>
                                </center>"
                              ];
        }
        if(empty($data)){
            $data["data"][] = ["","<center>no queue</center>",""];
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }
    

    public function load_previlage(){
        $this->load->model('queue_counter');
        $qc = new Queue_Counter;
        $qc->toJoin = ["previlage" => "queue_counter","offices" => "queue_counter","transactions" => "queue_counter"];
        $qc->sqlQueries = ["order_type" => "ASC",'order_field' => 'queue_no',"toGroup" => false];
        $qc = $qc->search(['queue_counter.prev_id' => '1', 'queue_counter.date' => date('Y-m-d'),'queue_counter.o_id' => $this->session->userdata('dp_office_id'),'queue_counter.status'=>'waiting']);
        // $qc = $qc->get();
        $data = [];
        foreach ($qc as $key => $value) {
            $data["data"][] = [
                                "<center><b>".strtoupper($value->initial_code."".$value->trans_code."-000".$value->queue_no)."</b></center>",
                                "<center><b>".strtoupper($value->trans_name)."</b></center>",
                                "<center>
                                	<b>
                                		<a href='#' class='btn-call-scpwd' style='text-decoration:none;' onClick=pwd_next($value->qc_id,$value->t_id,$value->o_id,'".strtoupper($value->initial_code."".$value->trans_code)."')>
                                			NEXT
                                		</a>
                                	</b>
                                </center>"
                              ];
        }
        if(empty($data)){
            $data["data"][] = ["","<center>no queue</center>",""];
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
        
    }

    public function pwd_next(){
    	$this->load->model('queue_counter');
    	$qc = new Queue_Counter;
    	$qc->toJoin = ["previlage" => "queue_counter","offices" => "queue_counter","transactions" => "queue_counter"];
    	$qc->sqlQueries = ["order_type" => "ASC",'order_field' => 'queue_no',"toGroup" => false];
    	$qc = $qc->search(["previlage.prev_id" => '1',"date"=>date("Y-m-d"),"status"=>'waiting',"queue_counter.o_id" => $this->input->post('o_id'),'queue_counter.t_id'=>$this->input->post('t_id'),"qc_id" => $this->input->post('qc_id')]);
    	$next = reset($qc);
    	echo json_encode($next);
    	if($next){
    		$qc1 = new Queue_Counter;
	    	$qc1->load($next->qc_id);
	    	$qc1->w_id = $this->session->userdata('dp_w_id');
	    	$qc1->wa_id = $this->input->post('wa_id');
	    	$qc1->status = "done";
            $qc1->time_call = date("H:i:s");
	    	$qc1->save();
    	}
    }
    public function load_serve(){
        $this->load->model('queue_counter');
        $qc = new Queue_Counter;
        $qc->toJoin = ["previlage" => "queue_counter","offices" => "queue_counter","transactions" => "queue_counter"];
        $qc->sqlQueries = ["order_type" => "desc",'order_field' => 'queue_no',"toGroup" => false];
        $qc = $qc->search(['queue_counter.date' => date('Y-m-d'),'queue_counter.o_id' => $this->session->userdata('dp_office_id'),'queue_counter.status'=>'done']);
        // $qc = $qc->get();
        $data = [];
        foreach ($qc as $key => $value) {
            $data["data"][] = [
                                "<center><b>".strtoupper($value->initial_code."".$value->trans_code."-000".$value->queue_no)."</b></center>",
                                "<b>".strtoupper($value->trans_name)."</b>",
                                
                              ];
        }
        if(empty($data)){
            $data["data"][] = ["","<center>no queue</center>",""];
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }
    }
    public function logout_w(){
        $this->load->model('window_account_login');
        $wa = new Window_Account_Login;
        $wa->logout();
    }

    public function transfer_transaction(){
        
    }
    public function select_office(){
        $this->load->model('offices');
        $o = new offices;
        $o = $o->search(["mode" => "active"]);
        return $o;
    }
    public function select_transaction(){
        $this->load->model('transactions');
        $t = new Transactions;
        $t = $t->search(["o_id" => $this->input->post("o_id"),"t_mode" => "active"]);
        echo json_encode($t);
    }

}
        