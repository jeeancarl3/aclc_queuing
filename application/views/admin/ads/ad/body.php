<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:54:22
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-08 10:37:11
 */
$this->load->view('admin/ads/ad/jscript');
?>
<div class="container">
			    <div class="row">
			      	<div class="col-md-4 pr-0"></div>
			    	<div class="col-md-20">
			    		<div class="admission-leftpane bg-white">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> &nbsp; Filter</div>
							<div class="col-md-24 bg-white pt-10" style="border:1px solid #CCC; padding-bottom:5px;">
								<?php echo form_open_multipart('admin/ads/ad/save_ads',array('id'=>'form-text-aa' , 'class' => '', 'data-toggle' => "validator", 'method' => "post")) ?>
									<input type="text" name="ads_id" hidden id="ads_id">
									<div class="row">
										<div class="col-md-24">
											<div class="row">
												<p style="padding-left:10px;font-style: italic;">This report only generates the summary of the total clients serve in a particular date being set and by office.</p>
												<div class="col-md-6">
													<div class="form-group" >
														<label for="initialCode" class="label-font-arial">Type</label>
														<select class="form-control inp-nbr" name="img_or_vid" id="img-or-vid">
															<option value="photo">Photo</option>
															<option value="video">Video</option>
														</select>
			    									</div>
												</div>
												<div class="col-md-18">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">File Name</label>
													    <input type="text" class="form-control inp-nbr" id="file_name" name="file_name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-10">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Upload</label>
											            <div class="input-group">
											                <label class="input-group-btn">
											                    <span class="btn btn-primary">
											                        Browse&hellip; <input type="file" name="file" id="upload-btn" style="display: none;">
											                    </span>
											                </label>
											                <input type="text" class="form-control" id="text-file" readonly>
											        	</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial"  >Duration</label>
													    <input type="text" class="form-control inp-nbr" name="duration" id="duration">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<button type="submit"  id="btn-save" class="btn btn-primary ptb-10 pull-right" style="margin-top:25px;">Save</button>
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
				    				<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> Overview</div>
			          				<table id="tbl-table" class="table table-striped table-bordered" style="width:100%;border:1px solid #CCCCCC !important;font-size:11px;">
			          					<thead>
			          						<td style="text-align:center;">File Type</td>
			          						<td style="text-align:center;">File Name</td>
			          						<td style="text-align:center;">Duration</td>
			          						<td style="text-align:center;">Status</td>
			          						<td style="text-align:center;">Action</td>
			          					</thead>
								    </table>
				          		</div>
			    			</div>
			          	</div>
			        </div>
			    </div>
			</div>