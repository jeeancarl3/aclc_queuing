<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 15:41:37
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-13 15:45:23
 */
?>
<div class="container">
			    <div class="row">
			      	<div class="col-md-4 pr-0">
			        	<div class="admission-leftpane bg-white" style="border:1px solid #CCC;">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;">Report Type</div>
			      			<ul>
			        			<li class="ptb-5"><a href="<?= base_url()?>index.php/admin/reports/summary">Summary</a><i class="fa fa-play"></i></li>
					            <li class="active"><a href="<?= base_url()?>index.php/admin/reports/detail">Detail</a><i class="fa fa-play"></i></li>
			      			</ul>
			        	</div>
			    	</div>
			    	<div class="col-md-20">
			    		<div class="admission-leftpane bg-white">
			          		<div class="head-blue ptb-5 bg-black" style="color:#FFF;"> &nbsp; Filter</div>
							<div class="col-md-24 bg-white pt-10" style="border:1px solid #CCC; padding-bottom:5px;">
								<form action="#">
									<div class="row">
										<div class="col-md-24">
											<div class="row">
												<p style="padding-left:10px;font-style: italic;">This report only generates the summary of the total clients serve in a particular date being set and by office.</p>
												<div class="col-md-8">
													<div class="form-group" >
														<label for="initialCode" class="label-font-arial">Date From</label>
														<input type="date" class="form-control inp-nbr" id="initialCode">
			    									</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
													    <label for="initialCode" class="label-font-arial">Date To</label>
													    <input type="date" class="form-control inp-nbr" id="initialCode">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<button type="submit" class="btn btn-primary ptb-10" style="margin-top:25px;">Save</button>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="initialCode" class="label-font-arial">&nbsp;</label>
														<a href="#" class="pull-right"><i class="fa fa-file-excel" style="color:#06982c;font-size:35px;padding-top:25px;"> </i>Download in Excel Format</a>
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
			          				<table id="example" class="table table-striped" style="width:100%;border:1px solid #CCCCCC !important;">
			          					<thead class="hidden">
			          						<td></td>
			          						<td></td>
			          						<td></td>
			          					</thead>
								        <tbody>
								            <tr>
								                <td style="width: 80%;">Cashier</td>
								                <td style="border-left:1px solid #CCC;text-align: center;"><a href="#">ACTIVATE</a></td>
								                <td style="border-left:1px solid #CCC;text-align:center;"><a href=""><i class="fa fa-trash" style="color:#222;"></i></a> <a href="" style="color:#84f3cf;"><i class="fa fa-pencil-alt"></i></a></td>
								            </tr>
								        </tbody>
								    </table>
				          		</div>
			    			</div>
			          	</div>
			        </div>
			    </div>
			</div>