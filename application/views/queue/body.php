<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 17:05:46
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-11 15:00:07
 */
$this->load->view('queue/jscripts');
?>
<div class="container-fluid">

    <div class="row">
    	<div class="col-md-24" style="text-align:center;padding-top:10px;">
    		<h2><span style="color:#FFBF00"><?= strtoupper($pre_load->window_name) ?></span> <span style="color:#008C8C"><?= strtoupper($pre_load->office_name) ?> TRANSACTION</span></h2>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-16 queue-view"></div>
    	<div class="col-md-8">
    		<div class="row">
    			<div class="admission-leftpane bg-white" style="border:1px solid #CCC;margin-top:5px;">
	          		<div class="head-blue ptb-5 bg-grey" style="color:#FFF;">SENIOR CITIZEN / PREGNANT / PWD</div>
	      			<table style="width:100%;" class="table scpwd">
      					<thead class="hidden">
      						<td>&nbsp;</td>
      						<td>&nbsp;</td>
      						<td>&nbsp;</td>
      					</thead>
				        <tbody>
				        </tbody>
				    </table>
	        	</div>
    		</div>
    		<div class="row">
    			<div class="admission-leftpane bg-white" style="border:1px solid #CCC;margin-top:5px;">
	          		<div class="head-blue ptb-5 bg-grey" style="color:#FFF;">SKIP NUMBER</div>
	      			<table style="width:100%;" class='table table-skip'>
      					<thead class="hidden">
      						<td></td>
      						<td></td>
      						<td></td>
      					</thead>
				        <tbody>
				        </tbody>
				    </table>
	        	</div>
    		</div>
    		<div class="row">
    			<div class="admission-leftpane bg-white" style="border:1px solid #CCC;margin-top:5px;">
	          		<div class="head-blue ptb-5 bg-grey" style="color:#FFF;">SERVED NUMBER</div>
	      			<table style="width:100%;" class='table table-bordered table-serve'>
      					<thead class="hidden">
      						<td>&nbsp;</td>
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