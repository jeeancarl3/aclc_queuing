<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 17:07:22
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-19 14:34:29
 */
?>
	</div>
		<div class="modal fade trans-transaction" tabindex="-1" role="dialog">
		  	<div class="modal-dialog " role="document" style="margin-top:10%;">
		  		<div class="modal-content">
					<div class="head-blue ptb-5" style="color:#FFF;background-color: #002040;width:100%;">SET THE FOLLOWING LOCATION FOR TRANSFER</div>
		  			<div class="modal-body">
		  				<div class="admission-leftpane bg-white">
							<div class="row" >
								<div class="col-md-24">
									<div class="row">
										<div class="col-md-12">
											<span style="padding:10px;">Served Number :</span>	
										</div>
										<div class="col-md-12">
											<span style="padding:5px;">Of :</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div style="margin-left:15px;font-size:5em;color:#00468c;" class="trans-number">203</div>	
										</div>
										<div class="col-md-12">
											<div style="padding:5px;color:#00468c;"><h1 class="trans-transaction">PAYMENTS</h1></div>
											<h5 style="margin-top:-20px;"><b>TRANSACTION</b></h5>
										</div>
									</div>
									<div class="row">
										<div class="col-md-24">
											Will be transfer to:
										</div>
										<div class="col-md-24">
											<form>
											<?php echo form_open_multipart('queue/queuing/transfer_transaction',array('id'=>'form-transfer' , 'class' => '', 'data-toggle' => "validator", 'method' => "post")) ?>
												<div class="form-group">
													<label for="Office">Office</label>
													<select class="form-control office-id" style="border-radius: 0;" name="o_id">
														<?php foreach($load_o as $key => $value): ?>
															<option value="<?= $value->o_id ?>"><?= $value->office_name?></option>
														<?php endforeach;?>
													</select>
												</div>
												<div class="form-group">
													<label for="Transaction">Transaction</label>
													<select class="form-control trans-id" style="border-radius: 0;" name="trans_id"></select>
												</div>
												<button type="submit" class="btn btn-default pull-right" style="border-radius: 0;background-color:#ff8000;">Transfer</button>
											</form>
										</div>
									</div>
								</div>
							</div>	
						</div>
		  			</div>
		  		</div>
			</div>
		</div>
	</body>
</html>