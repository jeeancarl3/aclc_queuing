<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:40:07
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-11 09:54:15
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Queue_Counter extends MY_Model {
    const DB_TABLE = "queue_counter";
    const DB_TABLE_PK = "qc_id";
    public $qc_id;
    public $queue_no;
    public $o_id;
    public $t_id;
    public $w_id;
    public $wa_id;
    public $prev_id;
    public $date;
    public $status;
    public $time_call;
}
        