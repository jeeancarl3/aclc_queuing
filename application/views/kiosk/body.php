<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 07:28:59
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-26 16:41:10
 */
?>
<div class="container" style="margin-top:15%;">
    <div class="row">
        <div class="col-md-24">
            <?php foreach($office as $key => $value): ?>    
                <div class="col-md-7" style="margin-left:10px; margin-top:10px;">
                    <div class="row">
                        <a href="<?= site_url('kiosk/select_transaction').'/'.$value->o_id;?>">
                            <div class="col-md-24">                        
                                <div class="row" style="background-color:<?= $value->color ?>">
                                    <div class="col-md-8" style="margin:0px;">
                                        <img src="<?= base_url($value->img_path)?>" alt="" style="margin-left:-15px !important;">
                                    </div>
                                    <div class="col-md-16" style="padding-top:10%; color:#FFFFFF;">
                                        <center><h3><?= strtoupper($value->office_name) ?></h3></center>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</center>

 <!-- style="background-color:#00b2b2;" -->
<!-- #00b2b2 -->