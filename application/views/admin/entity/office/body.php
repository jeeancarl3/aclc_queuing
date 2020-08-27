<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 14:44:06
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 10:36:30
 */
$this->load->view('admin/entity/office/jscript');
?>
<div class="container">
			    <div class="row">
			      	<div class="col-md-4 pr-0">
			        	<div class="admission-leftpane bg-white" style="border:1px solid #CCC;">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;">Entity</div>
			      			<ul>
			        			<li class="active ptb-5"><a href="<?= base_url()?>index.php/admin/entity/office">Office</a><i class="fa fa-play"></i></li>
					            <li ><a href="<?= base_url()?>index.php/admin/entity/transaction">Transaction</a><i class="fa fa-play"></i></li>
					            <li><a href="<?= base_url()?>index.php/admin/entity/window">Window</a></li>
			      			</ul>
			        	</div>
			    	</div>
			    	<div class="col-md-20">
			    		<div class="admission-leftpane bg-white">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> &nbsp;</div>
							<div class="col-md-24 bg-white pt-10" style="border:1px solid #CCC; padding-bottom:5px;">
								<?php echo form_open_multipart('admin/entity/office/save_office',array('id'=>'form-text-office' , 'class' => '', 'data-toggle' => "validator", 'method' => "post")) ?>
								<input type="text" name="o_id" id="o_id" hidden>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group" >
												<input type='file' name="file" class="custom-file-input" />
	    										<div id='img_contain' class="col-md-24" style="border:1px solid #CCC !important;">
	    											<img id="blah" align='middle' src="<?= base_url()?>assets/images/default-img.png" alt="your image" title=''/>
	    										</div>
	    									</div>
										</div>
										<div class="col-md-19">
											<div class="row">
												<div class="col-md-24">
													<div class="form-group">
													    <label for="officeName" class="label-font-arial">Office Name</label>
													    <input type="text" class="form-control inp-nbr" id="officeName" name="office_name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Initial Code</label>
													    <input type="text" class="form-control inp-nbr" id="initialCode" name="initial_code">
													</div>
												</div>
												<div class="col-md-10">
													<div class="form-group">
													    <label for="colorCode" class="label-font-arial">Select Color Code</label>
													    <input type="text" class="form-control inp-nbr" id="colorCode" name="color"> 
													</div>
												</div>
												<div class="col-md-9">
													<div class="form-group">
														<button type="submit" class="btn btn-primary pull-right ptb-10 btn-office" style="margin-top:25px;">Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
			        	</div>
			    	</div>
			    </div>

			    <div class="row">
			    	<div class="col-md-4 pr-0"></div>

			    	<div class="col-md-20 pt-10">
			    		<div class="admission-leftpane bg-white">
			    			<div class="row">
			    				<div class="col-md-24">
				    				<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> Department List</div>
			          				<table id="office-table" class="table table-striped" style="width:100%;border:1px solid #CCCCCC !important;">
			          					<thead style="height:0px !important;">
			          						<td style="width:80%;height: 0px !important;padding:0px;"></td>
			          						<td></td>
			          						<td></td>
			          					</thead>
								        <tbody>
								        </tbody>
								    </table>
				          		</div>
			    			</div>
			          	</div>
			        </div>
			    </div>
			</div>
	  	</div>