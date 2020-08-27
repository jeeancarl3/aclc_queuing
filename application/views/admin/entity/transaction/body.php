<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:07:23
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 11:43:22
 */
$this->load->view('admin/entity/transaction/jscript');
?>
<div class="container">
			    <div class="row">
			      	<div class="col-md-4 pr-0">
			        	<div class="admission-leftpane bg-white" style="border:1px solid #CCC;">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;">Entity</div>
			      			<ul>
			        			<li class="ptb-5"><a href="<?= base_url()?>index.php/admin/entity/office">Office</a><i class="fa fa-play"></i></li>
					            <li class="active"><a href="<?= base_url()?>index.php/admin/entity/transaction">Transaction</a><i class="fa fa-play"></i></li>
					            <li><a href="<?= base_url()?>index.php/admin/entity/window">Window</a></li>
			      			</ul>
			        	</div>
			    	</div>
			    	<div class="col-md-20">
			    		<div class="admission-leftpane bg-white">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> &nbsp;</div>
							<div class="col-md-24 bg-white pt-10" style="border:1px solid #CCC; padding-bottom:5px;">
								<?php echo form_open_multipart('admin/entity/transaction/save_transaction',array('id'=>'form-text-office' , 'class' => '', 'data-toggle' => "validator", 'method' => "post")) ?>
									<input type="text" name="t_id" id="t_id" hidden>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group" >
												<input type='file' class="custom-file-input" name="file"/>
	    										<div id='img_contain' class="col-md-24" style="border:1px solid #CCC !important;">
	    											<img id="blah" align='middle' src="<?= base_url()?>assets/images/default-img.png" alt="your image" title=''/>
	    										</div>
	    									</div>
										</div>
										<div class="col-md-19">
											<div class="row">
												<div class="col-md-24">
													<div class="form-group">
													    <label for="selectOffice" class="label-font-arial">Select Office</label>
													    <select class="form-control inp-nbr" name="o_id" id="o_id">
													    	<?php foreach($offices as $key => $value): ?>
													    			<option value='<?= $value->o_id?>' ><?= $value->office_name ?></option>
													    	<?php endforeach;?>
													    </select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-9">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Transaction Name</label>
													    <input type="text" class="form-control inp-nbr" name="trans_name" id="trans_name">
													</div>
												</div>
												<div class="col-md-10">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Transaction Code</label>
													    <input type="text" class="form-control inp-nbr" name="trans_code" id="trans_code"> 
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<button type="submit" class="btn btn-primary pull-right ptb-10" style="margin-top:25px;">Save</button>
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
			          				<table id="trans-table" class="table table-striped table-bordered" style="width:100%;border:1px solid #CCCCCC !important;">
			          					<thead>
			          						<td><center><b>Office</b></center></td>
			          						<td><center><b>Transaction</b></center></td>
			          						<td><center><b>Mode</b></center></td>
			          						<td>&nbsp;</td>
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