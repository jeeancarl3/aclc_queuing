<?php

/**
 * @Author: Gian
 * @Date:   2019-01-10 09:28:47
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-14 15:54:03
 */
class Monitor extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['adss'] = $this->display();
        $data['offices'] = $this->load_offices();
        $this->load->view('monitor/header');
        $this->load->view('monitor/body',$data);
        $this->load->view('monitor/footer');
    }

    public function display(){
    	$this->load->model('ads');
    	$ads = new Ads;
        $ads = $ads->search(['mode' => 'active']);
    	return $ads;
    }

    public function load_queue(){
        $this->load->model('queue_counter');
        $queue_counter = new Queue_Counter;
        
        $queue_counter->db->distinct();
        $queue_counter->db->select("*
                                    FROM
                                        `queue_counter`
                                    JOIN `transactions` ON `transactions`.`t_id` = `queue_counter`.`t_id`
                                    JOIN `office` ON `office`.`o_id` = `transactions`.`o_id`
                                    JOIN `window_account` ON `window_account`.`o_id` = `office`.`o_id`
                                    JOIN `window` ON `window`.`w_id` = `queue_counter`.`w_id`
                                    WHERE
                                        `status` = 'done'
                                    AND `date` = '".date("Y-m-d")."'
                                    ORDER BY
                                        `time_call`");
        $queue_counter = $queue_counter->db->get();
        $queue_res = $queue_counter->result();
        $data = [];
        foreach ($queue_res as $key => $value) {
            $data["data"][] = ["o_id" => $value->o_id,
                               "window_name" => $value->window_name,
                               "initial_code" => $value->initial_code,
                               "trans_code" => $value->trans_code,
                               "queue_no" => $value->queue_no,
                               "o_name" => $value->office_name
                              ];
        }
        echo json_encode($data);
    }



    public function queue(){
        $this->load->model('queue_counter');
        $queue_counter = new Queue_Counter;
        
        $queue_counter->db->distinct();
        $queue_counter->db->select("*
                                    FROM
                                        `queue_counter`
                                    JOIN `transactions` ON `transactions`.`t_id` = `queue_counter`.`t_id`
                                    JOIN `office` ON `office`.`o_id` = `transactions`.`o_id`
                                    JOIN `window_account` ON `window_account`.`o_id` = `office`.`o_id`
                                    JOIN `window` ON `window`.`w_id` = `queue_counter`.`w_id`
                                    WHERE
                                        `status` = 'done'
                                    AND `date` = '".date("Y-m-d")."'
                                    ORDER BY
                                        `time_call`");
        $queue_counter = $queue_counter->db->get();
        $queue_res = $queue_counter->result();
        $data = [];
        foreach ($queue_res as $key => $value) {
            $data["data"][] = ["o_id" => $value->o_id,
                               "window_name" => $value->window_name,
                               "initial_code" => $value->initial_code,
                               "trans_code" => $value->trans_code,
                               "queue_no" => $value->queue_no,
                               "o_name" => $value->office_name
                              ];
        }
        echo json_encode($data);
    }
    
    public function load_offices(){
        $this->load->model('offices');
        $o = new Offices;
        return $o->get();
    }
}