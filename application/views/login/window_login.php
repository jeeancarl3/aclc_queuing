<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 15:09:00
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-26 16:37:06
 */
?>
<!DOCTYPE html>
<html>
<head><title>SMCC LOG-IN</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <script src="<?= base_url() ?>assets/bootstrap/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8" ></script>
    <script src="<?= base_url()?>assets/bootstrap/js/jqueryForm.min.js" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript">
        $(function(){
            $('#loginForm').ajaxForm(function(r) {
              $('#errorMsg').html(r);
            });
        })
    </script>
</head>
<body>
<div class = "page-header">
    <h3>ACLC COLLEGE OF BUTUAN - QUEUING SYSTEM</h3>
</div>
<!-------------------------------------------LOGIN FORM ------------------------------------->
  <div class="logIn container">
    <?php echo form_open('login/try_window_login',array('id'=>'loginForm' , 'role' => 'form')); ?>
        <h1 class="logIn">LOG-IN<img src="<?= base_url() ?>assets/images/aclc_logo.fw.png" alt ="plane" align ="center" style="margin-left: 45%;"></h1>
        
        <div class="logIn form-group">
            <input type="text" placeholder="USERNAME" name="username">
        </div>
        
        <div class="logIn form-group">
            <input type="password" placeholder="PASSWORD" name="password">
        </div>
        <center>
            <button type="submit" class="logIn btn btn-default">Login</button>
            <span id="errorMsg" style="color:red";></span>
        </center>
    </form>
  </div>  
<div class="footer">
  <p>Engtech Global Solutions Incorporated<br>
    <small>http://engtechglobalsolutions.com/</small></p>
</div>
</body>
</html>