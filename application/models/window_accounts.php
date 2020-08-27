<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:31:13
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 13:50:26
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Window_Accounts extends MY_Model {
    const DB_TABLE ="window_account";
    const DB_TABLE_PK = "wa_id";
    public $o_id;
    public $wa_id;
    public $fullname;
    public $username;
    public $password;
    public $user_type;
}
