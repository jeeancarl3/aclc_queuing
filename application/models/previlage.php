<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:33:06
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-10 09:32:28
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Previlage extends MY_Model {
    const DB_TABLE = "previlage";
    const DB_TABLE_PK = "prev_id";
    public $previlage;
    public $prev_id;
}
        