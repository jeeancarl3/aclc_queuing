<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 07:25:17
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-26 16:41:47
 */
?>
<div class="finance container" style="margin-top:15%;">
    <div class="row">
        <div class="col-md-24">
            <?php foreach($trans as $key => $value):?>
                <div class="col-sm-7" style="margin-bottom:8px;border-radius: none;margin-left:5px;">
                    <div class="kContainer row" style="border:none;border-radius: none;">
                        <a a href="#" class="prevShow" t_id="<?= $value->t_id ?>">
                            <!-- <div class="kMargin col-sm-4">
                                <img class="finance-img" src="<?= base_url($value->img_path)?>" alt="">
                            </div>
                            <div class="col-sm-20" style="background-color:#00B2B2;">                        
                                <p class="finance"><?= strtoupper($value->trans_name) ?></p>
                            </div> -->

                            <div class="col-md-24">                        
                                <div class="row" style="background-color:<?= $value->color ?>">
                                    <div class="col-md-8" style="margin:0px;">
                                        <img src="<?= base_url($value->img_paths)?>" alt="" style="margin-left:-15px !important;">
                                    </div>
                                    <div class="col-md-16" style="padding-top:10%; color:#FFFFFF;font-size:18px;">
                                        <center><?= strtoupper($value->trans_name) ?></center>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
	</div>
    <div class="row">
        <center>
            <a href="<?= base_url('index.php/kiosk') ?>" style="text-decoration: none;border-radius: none">
                <div class="transButton" style="border:none;border-radius: none;">
                    <img src="<?= base_url()?>assets/images/arrow.png" alt="" class="sImage" style="display: block; background-color: #00698c;width: 35%; height: 100%;float: left;">
                    <div style="font-size: 20px;text-align: center; color: #183aeb;margin-top:10%;border-radius: none !important;">
                        <p style="padding-top:6%;">BACK</p>
                    </div>
                </div>
            </a>
        </center>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      	<div class="modal-content">
        	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h5 class="modal-title">Select Privelege Status</h5>
        	</div>
	        <div class="modal-body">
                <center>
    	          	<div class="modal-btn" style="padding: 40px">
    		          	<a href="#"  target="_blank" style="padding: 50px; background-color:#36a2cc;" class="btn btn-primary btn-regular">REGULAR</a>
    		          	<a href="#" target="_blank" class="btn btn-primary btn-pwd" style="background-color: orange; padding: 30px ">SENIOR CITIZEN<br>PREGNANT<br>PWD</a>
    				</div>
                </center>
	        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(document).on('click','.prevShow',function(e){

            $('#myModal').modal('show')
            var t_id = $(this).attr('t_id')
            $('.btn-regular').attr("t_id",t_id)
            $(".btn-pwd").attr('href','<?= base_url()?>index.php/kiosk/print_queue_regular/'+t_id+'/'+1)
            $(".btn-regular").attr('href','<?= base_url()?>index.php/kiosk/print_queue_regular/'+t_id+'/'+2)
            e.preventDefault();
        })

        $(document).on('click','.btn-regular',function(e){
            $('#myModal').modal('hide')
            window.location  = "<?php echo base_url('index.php/kiosk')?>";
        })
        $(document).on('click','.btn-pwd',function(e){
            $('#myModal').modal('hide')
            window.location  = "<?php echo base_url('index.php/kiosk')?>";
        })
    })
</script>