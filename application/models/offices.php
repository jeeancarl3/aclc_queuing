<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:35:52
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-14 08:37:04
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Offices extends MY_Model {
    const DB_TABLE ="office";
    const DB_TABLE_PK = "o_id";
    public $o_id;
    public $office_name;
    public $initial_code;
    public $color;
    public $img_path;
    public $mode;
}