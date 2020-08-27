<?php

/**
 * @Author: Gian
 * @Date:   2019-02-07 04:42:33
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-19 15:30:59
 */
?>

<!DOCTYPE html>
<html>
<head>
	<title> print </title>
	<script type="text/javascript" src="<?= base_url() ?>assets/bootstrap/js/jquery-3.3.1.min.js"></script>
	<style type="text/css">
		@media print{
			 @page {
		      size: A4; /* DIN A4 standard, Europe */
		      margin:0;
		     
		    }
			.print-page{ 
				width:79.24mm;
				height: 79.24mm;
				border:1px solid black;
			}
			center{
				margin-top:60px;
			}
			h2{
				font-size:13px;
			}
			h3{
				font-size:12px;
			}
			#footer {
			    clear: both;
			    position: relative;
			    height: 40px;
			    margin-top: 40px;
			}
		}
	</style>
	<script type="text/javascript">
		$(function(){
			window.focus()
			window.print()
			window.close()
			var beforePrint = function() {
            	console.log('Functionality to run before printing.');
	        };

	        var afterPrint = function() {
	            console.log('Functionality to run after printing');
	        };

	        if (window.matchMedia) {
	            var mediaQueryList = window.matchMedia('print');
	            mediaQueryList.addListener(function(mql) {
	                if (mql.matches) {
	                    beforePrint();
	                } else {
	                    afterPrint();
	                }
	            });
	        }
	        window.onbeforeprint = beforePrint;
    		window.onafterprint = afterPrint;
		})
	</script>
</head>
<body>
	<div class="print-page">
		<center>
			<h2>ACLC COLLEGE OF BUTUAN</h2>
			<h3><?= date("F d, Y") ?> </h3>
			<h1><?= $max ?></h1>
			<h3><?= date("h:i a") ?> </h3> <br />
			<div id="footer">
				Engtech Global Solutions Inc. <?= date("Y") ?>
			</div>
		</center>
		
	</div>
</body>
</html>