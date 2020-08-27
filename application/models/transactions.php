<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:34:17
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-18 11:33:14
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends MY_Model {
    const DB_TABLE = "transactions";
    const DB_TABLE_PK = "t_id";
    public $t_id;
    public $o_id;
    public $trans_name;
    public $trans_code;
    public $img_paths;
    public $t_mode;
}