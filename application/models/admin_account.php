<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 08:29:17
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-24 13:50:11
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Account extends MY_Model {
    const DB_TABLE = "admin_account";
    const DB_TABLE_PK = "aa_id";
    public $aa_id;
    public $fullname;
    public $username;
    public $password;
    public $user_type;
}