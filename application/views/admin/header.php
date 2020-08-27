<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 14:49:07
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-19 15:31:24
 */
?>
<!DOCTYPE html>
<html>
<head>
	<title>ACLC College of Butuan - Queuing System V1.0</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bootstrap/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/DataTables/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/custom_file_input/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/custom_file_input/css/demo.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/plugins/custom_file_input/css/component.css">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
	<script src="<?= base_url()?>assets/bootstrap/js/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/plugins/DataTables/datatables.min.js"></script>
	<script src="<?= base_url()?>assets/bootstrap/js/jqueryForm.min.js" type="text/javascript" charset="utf-8" ></script>
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8" ></script>
	<script type="text/javascript" src="<?= base_url()?>assets/plugins/toastr/toastr.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>assets/plugins/custom_file_input/js/custom-file-input.js"></script>

</head>
	<body>
		<nav class="navbar box-edge no-margin" style="background-color:#00698C;border-radius:0;">
	      <div class="container-fluid">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	            <span class="fa fa-bars c-white f-30"></span>                
	          </button>
	          <a class="navbar-brand" href="index.html" style="color:#FFF;">
	            ACLC College of Butuan - Queuing System V1.0
	          </a>

	        </div>
	        <div class="collapse navbar-collapse" id="myNavbar">
	          <ul class="nav navbar-nav navbar-right pr-20">
	            <li>
	              <a href="#" class="c-white f-12 top-head" style="color:#FFF;">
	                <div style="font-size:19px;padding-top:13px;" class="Timer"></div>
	              </a>
	          	</li>
	            <li>
	              <a href="<?= base_url()?>index.php/admin/entity/office/logout" style="padding-top:5px;font-size:24px;color:#FFF;">
	                <span>Logout</span>
	              </a>
	            </li>
	          </ul>       
	        </div>
	      </div>
	  	</nav>
	  	<nav class="main-nav hidden-xs mb-10">
		    <div class="container-fluid">
		      <ul class="center-text inline-block">
		        <li class="<?= $this->uri->segment(2) == 'entity' ? 'active':'' ?>"><a href="<?= base_url()?>index.php/admin/entity/office" ><i class="fa fa-sitemap"></i> Entity</a></li>
		        <li class="<?= $this->uri->segment(2) == 'accounts' ? 'active':'' ?>""><a href="<?= base_url()?>index.php/admin/accounts/window_account" ><i class="fa fa-user"></i> Accounts</a></li>
		        <li class="<?= $this->uri->segment(2) == 'reports' ? 'active':'' ?>"><a href="<?= base_url()?>index.php/admin/reports/summary" ><i class="fa fa-file-contract"></i> Reports</a></li>
		        <li class="<?= $this->uri->segment(2) == 'ads' ? 'active':'' ?>"><a href="<?= base_url()?>index.php/admin/ads/ad" ><i class="fa fa-desktop"></i> ADS</a></li>
		        
		      </ul>
		    </div>
	  	</nav>
	  	<div class="container-fluid bg" style="margin-bottom:100px;">