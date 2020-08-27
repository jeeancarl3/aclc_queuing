<?php

/**
 * @Author: Gian
 * @Date:   2018-12-13 17:06:28
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-26 14:03:30
 */
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ACLC College of Butuan - Queuing System V1.0</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/DataTables/datatables.min.css">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
	<script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/plugins/DataTables/datatables.min.js"></script>
	<script src="<?= base_url()?>assets/bootstrap/js/jqueryForm.min.js" type="text/javascript"></script>
	
</head>
<body>
	<nav class="navbar box-edge no-margin" style="backgroud-color:#00698C;border-radius:0;">
	  	<div class="container-fluid">
			<div class="col-md-24">
				<div class="col-md-4" style="text-align: left;color:#FFF;padding:0">
					EngTech Global Solutions Inc. http://www.engtechglobalsolutions.com
				</div>
				<div class="col-md-16" style="padding-top:14px;color:#FFF;">
					<center>
						<h5>ACLC College of Butuan - Queuing System V1.0</h5>
					</center>
				</div>
				<div class="col-md-4" style="color:#FFF;text-align: right;padding-top:8px;">
					<h3><a href="<?= base_url('index.php/queue/queuing/logout_w')?>">Logout</a></h3>
				</div>
			</div>
	  	</div>
	</nav>
	<div class="container-fluid bg" style="margin-bottom:100px;">
		<center>