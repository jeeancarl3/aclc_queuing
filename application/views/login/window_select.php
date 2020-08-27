<?php

/**
 * @Author: Gian
 * @Date:   2019-01-24 15:28:37
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-19 15:30:39
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
    <!-- <script type="text/javascript">
        $(function(){
            $('#selectWin').ajaxForm(function(r) {
              location.reload()
            });
        })
    </script> -->
</head>
<body>
    <div class = "page-header">
        <h3>ACLC COLLEGE OG BUTUAN - QUEUING SYSTEM</h3>
    </div>
    <!-------------------------------------------WINDOW FORM ------------------------------------->
    <div class="window container">
        <?php echo form_open('login/select_window',array('id'=>'selectWin' , 'role' => 'form')); ?>
            <h1 class="window">WINDOW SECTION<img src="<?= base_url() ?>assets/images/aclc_logo.fw.png" alt ="plane" style="margin-left: 5%;"></h1>
            
            <div class="window form-group">
                <div class="form-group">
                    <label>You are  from:</label>
                    <p>
                    	<?php echo $office->office_name ?>
                    	<input type="text" name="o_id" value="<?php echo $office->o_id ?>" hidden>
                    </p>
                </div>
                <div class="window form-group">
                    <label class="window"><b>Window</b></label><br>
                    <select class="window" name="w_id">
                        <?php foreach($window as $key => $value): ?>
                      	    <option value="<?= $value->w_id ?>"><?= $value->window_name ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            <center>    
            	<button type="submit" class="window btn btn-default">DONE</button>
            </center>
        </form>
    </div>

    <div class="footer">
      <p>Engtech Global Solutions Incorporated<br>
        <small>http://engtechglobalsolutions.com/</small></p>
    </div>
</body>
</html>