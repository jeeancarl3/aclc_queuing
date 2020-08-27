<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:37:24
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 12:27:53
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Windows extends MY_Model {
    const DB_TABLE = "window";
    const DB_TABLE_PK = "w_id";
    public $w_id;
    public $o_id;
    public $window_name;
    public $w_mode;

}
        