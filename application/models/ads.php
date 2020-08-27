<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:38:31
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-14 08:39:48
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends MY_Model {
    
    const DB_TABLE = "ads";
    const DB_TABLE_PK = "ads_id";
    public $ads_id;
    public $file_type;
    public $file_name;
    public $path;
    public $duration;
    public $mode;
}
        