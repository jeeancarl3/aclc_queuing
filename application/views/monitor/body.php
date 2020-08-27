
<body>
<div class = "page-header">
	<h3 style="letter-spacing: 5px;font-size:30px;padding:0px !important;">AMA COMPUTER LEARNING CENTER COLLEGE OF BUTUAN</h3>
</div>

<div class="monitor container-fluid" style=" overflow: hidden;">
	<div class="col-sm-14" style="padding-right: 20px;">
		<div class="row">
			<div class="monitor col-sm-24">
				<div class="row">
					<div class="col-sm-24 slide-view" style="background-color: #184580; width: 100%; min-height: 500px; max-height: auto; float: left;">
						<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade	" data-ride="carousel">
						  	<div class="carousel-inner">
						    	<div class="carousel-inner" role="listbox">
						    		<?php $count = 0;?>
						    		<?php foreach($adss as $key => $value):?>
										<?php if($count == 0): ?>
											<?php if($value->file_type == "photo"):?>
												<div class="item active" data-interval="<?= $value->duration?>">
											      	<img src="<?= base_url('assets/images/adss/'.$value->path)?>" style="margin-top: 40px; margin-bottom: 40px; max-width: 100%; height: 500px;width:100%;" >
											    </div>
											<?php else: ?>
												<div class="item active" data-interval="<?= $value->duration?>">
													<video controls style="margin-top: 40px; margin-bottom: 40px; max-width: 100%; height: 500px;width:100%;">
											         	<source src = "<?= base_url('assets/images/adss/'.$value->path)?>"   type = "video/mp4">
											         	This browser doesn't support video tag.
											      	</video>
												</div>
											<?php endif;?>
											
										    <?php $count++; ?>
										<?php else: ?>
											<?php if($value->file_type == "photo"):?>
												<div class="item" data-interval="<?= $value->duration ?>">
											      	<img src="<?= base_url('assets/images/adss/'.$value->path)?>" style="margin-top: 40px; margin-bottom: 40px; max-width: 100%; height: 500px;width:100%;" >
											    </div>
											<?php else: ?>
												<div class="item" data-interval="<?= $value->duration?>">
													<video style="margin-top: 40px; margin-bottom: 40px; max-width: 100%; height: 500px;width:100%;">
											         	<source src = "<?= base_url('assets/images/adss/'.$value->path)?>" type = "video/mp4">
											         	This browser doesn't support video tag.
											      	</video>
												</div>
											<?php endif;?>
										<?php endif ?>
						    		<?php endforeach;?>
								</div>
						  	</div>
						  	<!-- Controls -->
							<a class="left carousel-control hidden" href="#carousel-example-generic" role="button" data-slide="prev">
							    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							    <span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control hidden" href="#carousel-example-generic" role="button" data-slide="next">
							    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							    <span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>

	<div class="col-sm-10">
		<div class="row">
			<div class="windows-view">
				<?php foreach($offices as $key => $value): ?>
					<div class="monitor col-sm-24" style="margin-bottom: 10px;">
						<div class="row">
							<div class="col-md-10">
								<div class="row">
									<div class="monitor-header col-md-24">
										<?php echo strtoupper($value->office_name) ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-24" style="background-color: #fcbe11;text-align:center">
										<p>PROCEED TO:</p>
									</div>
									<div class="colMonitor col-md-24 " style="background-color: #fcbe11;text-align:center;height:80px;margin-top:-10px;">
										<b class="window_num" id="monitor-window-<?php echo $value->o_id ?>" ></b>
									</div>
								</div>
							</div>
							<div class="col-md-14">
								<!-- <div class="row">
									<div class="col-md-20" style="background-color: #184580;text-align:center">
										<p style="color: white;padding-top:10px;">NOW SERVING #:</p>
									</div>
								</div> -->
								<div class="row" style="max-height: 100%;background-color: #184580;">
									<center><p style="color: white;padding-top:10px;">NOW SERVING #:</p></center>
									<div class="col-md-24 " style="color:#FFF;text-align:center;height:102px;font-family: Franklin Gothic Heavy;font-size:60px !important;" id="monitor-no-<?php echo $value->o_id ?>">
									</div>
								</div>
							</div>
						</div>

						<!-- <div class="row">
							<div class="monitor-header col-sm-24">
								<h1><b> <?php echo strtoupper($value->office_name) ?></b></h1>
							</div>
						</div>
						<div class="row">
						<div class="col-md-12" style="background-color: #fcbe11;text-align:center">
							<p>PROCEED TO: <br></p>
						</div>
						<div class="col-md-12" style="background-color: #184580;text-align:center">
								<p style="color: white;">NOW SERVING #:</p>
							</div>
						</div>
						<div class="row">
							<div class="colMonitor col-md-12 " style="background-color: #fcbe11;text-align:center;height:80px;">
								<b class="window_num" id="monitor-window-<?php echo $value->o_id ?>" ></b>
							</div>
							<div class="colMonitor col-md-12 " style="background-color: #184580;text-align:center;height:80px;">
								<b style="color: white;" id="monitor-no-<?php echo $value->o_id ?>">0000</b>
							</div>
						</div> -->
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<!-- <a href="#" id="call_number">aaa</a> -->
	<!-- Modal -->
    <center><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  		<div class="modal-dialog" role="document" style="margin-right:42%;">
		    <div class="modal-content modal-lg">
		      	<div class="modal-body" style="background-color:#0c3061;color:#FFF;">
		        	<center>
		        		<p id="window_name" style="font-family:Franklin Gothic Heavy;font-size:80px"></p>
		        		<p id="window_number" style="font-family:Franklin Gothic Heavy;font-size:100px;"></p>
		        	</center>
		      	</div>
		    </div>
  		</div>
	</div></center>
</div>
	
	<?php $this->load->view('monitor/jscript');?>