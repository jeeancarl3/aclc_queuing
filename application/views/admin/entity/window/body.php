<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:09:04
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 13:40:38
 */
$this->load->view('admin/entity/window/jscript');
?>
<div class="container">
			    <div class="row">
			      	<div class="col-md-4 pr-0">
			        	<div class="admission-leftpane bg-white" style="border:1px solid #CCC;">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;">Entity</div>
			      			<ul>
			        			<li class="ptb-5"><a href="<?= base_url()?>index.php/admin/entity/office">Office</a><i class="fa fa-play"></i></li>
					            <li class="active"><a href="<?= base_url()?>index.php/admin/entity/transaction">Transaction</a><i class="fa fa-play"></i></li>
					            <li class="active"><a href="<?= base_url()?>index.php/admin/entity/window">Window</a><i class="fa fa-play"></i></li>
			      			</ul>
			        	</div>
			    	</div>
			    	<div class="col-md-20">
			    		<div class="admission-leftpane bg-white">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> &nbsp;</div>
							<div class="col-md-24 bg-white pt-10" style="border:1px solid #CCC; padding-bottom:5px;">
								<?php echo form_open_multipart('admin/entity/window/save_window',array('id'=>'form-text-window' , 'class' => '', 'data-toggle' => "validator", 'method' => "post")) ?>
									<div class="row">
										<input type="text" name="w_id" id="w_id" hidden>
										<div class="col-md-24">
											<div class="row">
												<div class="col-md-24">
													<div class="form-group">
													    <label for="selectOffice" class="label-font-arial">Select Office</label>
													    <select class="form-control inp-nbr" id="o_id" name="o_id" >
													    	<?php foreach($offices as $key => $value): ?>
													    			<option value='<?= $value->o_id?>' ><?= $value->office_name ?></option>
													    	<?php endforeach;?>
													    </select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-19">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Window Name</label>
													    <input type="text" class="form-control inp-nbr" id="window_name" name="window_name">
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<button id="btn-window" type="submit" class="btn btn-primary pull-right ptb-10" style="margin-top:25px;">Save</button>
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
			          				<table id="window-table" class="table table-striped table-bordered" style="width:100%;border:1px solid #CCCCCC !important;">
			          					<thead>
			          						<td style="text-align:center;font-weight: bold;width:40%;">Office</td>
			          						<td style="text-align:center;font-weight: bold;">Window Name</td>
			          						<td style="text-align:center;font-weight: bold;">Mode</td>
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