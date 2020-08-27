<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 07:25:12
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-14 07:30:09
 */
?>
<div class="edp container">
        <div class="row">
            <div class="col-sm-8">
            	<div class="kContainer row">
            		<a data-toggle="modal" data-target="#myModal2">
            		<div class="kMargin col-sm-4">
                        <img class="edp-img" src="<?= base_url()?>assets/images/id.png" alt="">
		            </div>
		            <div class="col-sm-20">                        
	                    <p class="edp">PRINT ID</p>
	                </div></a>
                </div>
            </div>

            <div class="col-sm-8">
            	<div class="kContainer row">
            		<a data-toggle="modal" data-target="#myModal2"><div class="kMargin col-sm-4">
	                    <img class="edp-img" src="<?= base_url()?>assets/images/checklist.png" alt="">
	                </div>
		            <div class="col-sm-20">                          
	                    <p class="edp">PRINT STUDY LOAD</p>
	                </div></a>
                </div>
            </div> 
            <div class="col-sm-8">
            	<div class="kContainer row">
            		<a data-toggle="modal" data-target="#myModal2"><div class="kMargin col-sm-4">
		                <img class="edp-img" src="<?= base_url()?>assets/images/inquire.png" alt="">
		            </div>
		            <div class="col-sm-20">                           
	                    <p class="edp">PERSONNEL INQUIRIES</p>
	                </div>
	            	</a>
                </div>
            </div>   
            <div class="col-sm-8">
            	<div class="kContainer row">
            		<a data-toggle="modal" data-target="#myModal2"><div class="kMargin col-sm-4">
		                <img class="edp-img" src="<?= base_url()?>assets/images/chat.png" alt="">
		            </div>
		            <div class="col-sm-20">                           
	                    <p class="edp">OTHER INQUIRY</p>
	                </div>
	            	</a>
                </div>
            </div>
		</div>
    </div>
    <div class="modal fade" id="myModal2" role="dialog">
	    <div class="modal-dialog">
	      	<div class="modal-content">
	        	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h5 class="modal-title">Select Privelege Status</h5>
	        	</div>
		        <div class="modal-body">
		          	<div class="modal-btn" style="padding: 40px">
			          	<a href="" style="padding: 50px; background-color:#36a2cc;" class="btn btn-primary">REGULAR</a>
			          	<a href="" class="btn btn-primary" style="background-color: orange; padding: 30px ">SENIOR CITIZEN<br>PREGNANT<br>PWD</a>
					</div>
		        </div>
	      </div>
	    </div>
	</div>