<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:29:36
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 14:33:51
 */
$this->load->view('admin/accounts/window_account/jscript');
?>
<div class="container">
			    <div class="row">
			      	<div class="col-md-4 pr-0">
			        	<div class="admission-leftpane bg-white" style="border:1px solid #CCC;">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;">Accounts</div>
			      			<ul>
			        			<li class="ptb-5 active"><a href="<?= base_url()?>index.php/admin/accounts/window_account">Window Account</a><i class="fa fa-play"></i></li>
					            <li><a href="<?= base_url()?>index.php/admin/accounts/administrator">Administrator</a><i class="fa fa-play"></i></li>
			      			</ul>
			        	</div>
			    	</div>
			    	<div class="col-md-20">
			    		<div class="admission-leftpane bg-white">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> &nbsp;</div>
							<div class="col-md-24 bg-white pt-10" style="border:1px solid #CCC; padding-bottom:5px;">
								<?php echo form_open_multipart('admin/accounts/window_account/save_window_account',array('id'=>'form-text-wa' , 'class' => '', 'data-toggle' => "validator", 'method' => "post")) ?>
									<input type="text" name="wa_id" id="wa_id" hidden>
									<div class="row">
										<div class="col-md-6">
											<div class="row" style="padding-left:10px;">
												<div class="form-group" >
													<label for="initialCode" class="label-font-arial">Select Office</label>
													<select class="form-control inp-nbr" id="o_id" name="o_id">
													    	<?php foreach($offices as $key => $value): ?>
													    			<option value='<?= $value->o_id?>' ><?= $value->office_name ?></option>
													    	<?php endforeach;?>
													    </select>
		    									</div>
											</div>
											<div class="row" style="padding-left:10px;">
												<div class="form-group" >
													<label for="initialCode" class="label-font-arial">Username</label>
													<input type="text" class="form-control inp-nbr" id="username" name="username">
		    									</div>
											</div>
										</div>
										<div class="col-md-18">
											<div class="row">
												<div class="col-md-24">
													<div class="form-group">
													    <label for="selectOffice" class="label-font-arial">Full Name</label>
													    <input type="text" class="form-control inp-nbr" id="fullname" name="fullname">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-10">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Password</label>
													    <input type="password" class="form-control inp-nbr" id="password" name="password">
													</div>
												</div>
												<div class="col-md-14">
													<div class="form-group">
														<button type="submit" id="btn-wa" class="btn btn-primary pull-right ptb-10" style="margin-top:25px;">Save</button>
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
			          				<table id="wa-table" class="table table-striped table-bordered" style="width:100%;border:1px solid #CCCCCC !important;">
			          					<thead>
			          						<td>Office</td>
			          						<td>Fullname</td>
			          						<td>Username</td>
			          						<td>Password</td>
			          						<td>&nbsp;</td>
			          					</thead>
								        <tbody></tbody>
								    </table>
				          		</div>
			    			</div>
			          	</div>
			        </div>
			    </div>
			</div>