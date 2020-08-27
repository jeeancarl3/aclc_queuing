<?php

/**
 * @Author: Gian
 * @Date:   2019-01-15 15:02:14
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-26 15:58:11
 */
?>
<script>
	var skip_table
	var scpwd
	var serveNum
	var storQueueNo
	var getQueueNo
	
	var bleep = new Audio();
	bleep.src = "<?= base_url()?>assets/images/notif.mp3";

	function playBtnSound(){
		bleep.play();
	}

	$(function(){
		load_window1();
		skip_table = $('.table-skip').DataTable({
			"searching":false,
			"paging":false,
			// "bLengthChange": false,
			"info":false,
			"pageLength":5,
			"ajax": '<?= base_url()?>index.php/queue/queuing/load_skip',
			language: {
		        "emptyTable":     "My Custom Message On Empty Table"
		    }
			
		});
		scpwd = $('.scpwd').DataTable({
			"searching":false,
			"paging":false,
			// "bLengthChange": false,
			"info":false,
			"pageLength":5,
			"ajax": '<?= base_url()?>index.php/queue/queuing/load_previlage',
			language: {
		        "emptyTable":     "My Custom Message On Empty Table"
		    }
			
		});
		serveNum = $('.table-serve').DataTable({
			"searching":false,
			"paging":false,
			// "bLengthChange": false,
			"info":false,
			"pageLength":5,
			"ajax": '<?= base_url()?>index.php/queue/queuing/load_serve',
			
			
		});
		$(document).on('click','.btn-call',function(e){
			playBtnSound()
			e.preventDefault()
		})

		$(document).on('change','.office-id',function(e){
			$('.trans-id').find('option').remove().end()
			$.ajax({
				url: '<?= base_url()?>index.php/queue/queuing/select_transaction',
				type: 'POST',
				dataType:"JSON",
				data: {o_id: $(this).val()},
			})
			.done(function(data) {
				$.each(data, function(index, val) {
					$('.trans-id').append("<option value='"+val.trans_id+"'>"+val.trans_name+"</option>")
				});
			})
			e.preventDefault();
		})
		//transfer
		var options = {
	   		beforeSubmit: function(){
	   			$('#btn-office').attr("disabled","disabled")
	   			$('#btn-office').html("Saving..")
	   		},
	   		resetForm:true,

	   		success:function(data){
	   			if(data == "success"){
	   				setTimeout(function() {
		                toastr.options = {
		                    closeButton: true,
		                    progressBar: true,
		                    showMethod: 'slideDown',
		                    timeOut: 4000
		                };
		                toastr.success("successfully added.");
		            });
		            $("#btn-office").removeAttr("disabled");
					$("#btn-office").html("Save");
					$('#blah').attr('src', '<?= base_url()?>assets/images/default-img.png');
					tbl.ajax.reload();
	   			}
	   		},
	   		dataType:"JSON"
	   }
	   $('#form-text-office').ajaxForm(options);
		

		
	})
	function load_window1(){

		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/load_window',
			type: 'POST',
			dataType: 'JSON',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$.each(val, function(index1, val1) {
					skip(val1.trans_code);
					retain_number(val1.t_id,val1.initial_code,val1.trans_code)
					totalQ(val1.t_id)
					totalSkip(val1.t_id)
					$('.queue-view').append(
											'<div class="col-md-24">\
												<div class="row" style="margin-top:5px;border:1px solid #CCC;">\
													<div class="col-md-4" style="background-color:#ffd24d;padding:5px 10px;height:135px">\
										    			<span style="color:#00468c !important;font-weight: bold;">Total on Queue</span>\
										    			<center>\
										    				<div style="font-size:5em;color:#00468c !important;" class="total-queue'+val1.t_id+'">\
										    					'+0+'</div>\
										    			</center>\
										    			<div style="font-size:9px;margin-top:-8px;font-weight:bold;margin-left:-5px;">\
										    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>SKIP :<span class="skip-no-'+val1.t_id+'">0</span></b>\
										    			</div>\
										    		</div>\
													<div class="col-md-12" style="background-color:#ffffff;margin:0;height:135px">\
										    			<div class="col-md-16" style="padding-top:10px;text-align: left;">\
										    				<span style="color:#00468c !important;font-weight: bold;">Now Serving #</span>\
										    				<div style="color:#00468c !important;font-weight: bold;font-size:3em;" class="trans_code'+val1.t_id+'">\
										    					'+val1.initial_code+val1.trans_code+"-"+"0"+'\
										    				</div>\
										    				<div style="padding-bottom: 16px;">\
										    					<button class="btn btn-danger btn-call" style="background-color:#ff2626 !important;" >CALL</button>\
										    					<button class="btn btn-warning btn-t btn-transfer'+val1.t_id+'" attr="'+val1.qc_id+'" style="background-color:#ff8000 !important;" data-toggle="modal" data-target=".trans-transaction">TRANSFER</button>\
										    				</div>\
										    			</div>\
										    			<div class="col-md-8" style="padding-top:50px;font-weight:bold;">\
										    				<p>'+val1.trans_name.toUpperCase()+'</p>\
										    			</div>\
										    		</div>\
										    		<div class="col-md-4" style="background-color:#003040;height:135px;">\
											    			<a href="#" style="text-decoration: none;" class="done-next-btn-a'+val1.t_id+'" onClick="doneNext('+val1.wa_id+','+val1.w_id+','+val1.t_id+','+val1.o_id+',\''+val1.initial_code+""+val1.trans_code+'\')">\
											    				<center>\
												    				<div style="font-size:30px;padding-top:60px;line-height: 0px;color:#FFF;">\
													    				DONE\
													    			</div>\
													    			<p style="padding-top:10px !important;color:#FFF;">Next</p>\
											    				</center>\
											    			</a>\
											    		</div>\
											    		<div class="col-md-4" style="background-color:#008c8c;height:135px">\
											    			<a href="#" style="text-decoration: none;" class="skip-btn-a'+val1.t_id+'" >\
											    				<center>\
												    				<div style="font-size:30px;padding-top:60px;line-height: 0px;color:#FFF;">\
													    				SKIP\
													    			</div>\
											    				</center>\
											    			</a>\
											    		</div>\
												<div>\
											</div>'
						                    );
				});
			});
			
		})
	}
	function doneNext(wa_id,w_id,t_id,o_id,trans_code){
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()
		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/done_next',
			type: 'POST',
			dataType: 'JSON',
			data:{wa_id:wa_id,w_id:w_id,o_id:o_id,t_id:t_id}
		})
		.done(function(data) {
			if(data.return === false){
				if(data.t_id == t_id && data.return === false ){
					// console.log(data.output)
					$('.total-queue'+t_id).html(data.output)
				}
			}else{
				if(data.t_id == t_id){
					// storQueueNo = trans_code+"-"+("000"+data.queue_no).slice(-4);
					storQueueNo = trans_code+"-"+data.queue_no;
					window.localStorage.setItem("queueNo", storQueueNo);
					getQueueNo = localStorage.getItem("queueNo");
					$('.trans_code'+t_id).html(getQueueNo)
					$('.skip-btn-a'+t_id).attr('onclick',"skip_to_next("+data.qc_id+","+wa_id+","+w_id+","+o_id+","+t_id+",\""+trans_code+"\")")
					totalQ(t_id)
					totalSkip(t_id)
				}
			}
			scpwd.ajax.reload()
			skip_table.ajax.reload()
			serveNum.ajax.reload()
		})
		

	}
	function skip_to_next(qc_id,wa_id,w_id,o_id,t_id,trans_code){
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()
		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/skip_to_next',
			type: 'POST',
			dataType: 'JSON',
			data: {qc_id: qc_id,wa_id:wa_id,w_id:w_id},
		})
		.done(function(data) {
			if(data.t_id == t_id){
				$('.done-next-btn-a'+data.t_id).attr('onClick',"doneNext("+wa_id+","+w_id+","+t_id+","+o_id+",\""+trans_code+"\")")
				doneNext(wa_id,w_id,t_id,o_id,trans_code)
				totalQ(data.t_id)
				totalSkip(data.t_id)
			}
		})
		
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()

	}
	function totalQ(t){
		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/totalQ',
			type: 'POST',
			dataType: 'JSON',
			data: {t_id: t},
		})
		.done(function(datas) {
			$('.total-queue'+t).html((datas))
			// totalQ(t)
		})
	}
	function totalSkip(t){
		$.ajax({
					url: '<?= base_url()?>index.php/queue/queuing/totalSkip',
					type: 'POST',
					dataType: 'JSON',
					data: {t_id: t},
				})
				.done(function(datas) {
					$('.skip-no-'+t).html((datas))
					
				})
	}
	function retain_number(t,ic,tc){
		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/retainNumber',
			type: 'POST',
			dataType: 'JSON',
			data: {t_id: t},
		})
		.done(function(datas) {
			$('.trans_code'+t).html(ic+tc+"-"+datas)
		})
		
	}

	function skip_next(qc_id,wa_id,w_id,t_id,o_id,trans_code){
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()
		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/skip_next',
			type: 'POST',
			dataType: 'JSON',
			data:{wa_id:wa_id,w_id:w_id,o_id:o_id,t_id:t_id,qc_id:qc_id}
		})
		.done(function(data) {
			if(data.t_id == t_id){
				$('.trans_code'+t_id).html(trans_code+"-"+data.queue_no)
				$('.done-next-btn-a'+data.t_id).attr('onClick',"doneNext("+wa_id+","+w_id+","+t_id+","+o_id+",\""+trans_code+"\")")
				$('.skip-btn-a'+t_id).attr('onclick',"skip_to_next("+data.qc_id+","+wa_id+","+w_id+","+o_id+","+t_id+",\""+trans_code+"\")")
				totalQ(t_id)
				totalSkip(t_id)
			}
		})
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()
	}

	function pwd_next(qc_id,t_id,o_id,trans_code){
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()
		$.ajax({
			url: '<?= base_url()?>index.php/queue/queuing/pwd_next',
			type: 'POST',
			dataType: 'JSON',
			data:{o_id:o_id,t_id:t_id,qc_id:qc_id}
		})
		.done(function(data) {
			if(data.t_id == t_id){
				// $('.trans_code'+t_id).html(trans_code+"-"+("000"+data.queue_no).slice(-4))
				$('.trans_code'+t_id).html(trans_code+"-"+data.queue_no)
				$('.done-next-btn-a'+data.t_id).attr('onClick',"doneNext("+wa_id+","+w_id+","+t_id+","+o_id+",\""+trans_code+"\")")
				$('.skip-btn-a'+t_id).attr('onclick',"skip_to_next("+data.qc_id+","+wa_id+","+w_id+","+o_id+","+t_id+",\""+trans_code+"\")")
				totalQ(t_id)
			}
		})
		
	}



	function skip(code){
		scpwd.ajax.reload()
		skip_table.ajax.reload()
		serveNum.ajax.reload()
			$.ajax({
				url: '<?= base_url()?>index.php/queue/queuing/skip',
				type: 'POST',
				dataType: 'JSON',
			})
			.done(function(data) {
				$.each(data, function(index, val) {
					$.each(val, function(index1, val1) {
						if(val1.skip_code == code){
							$('#skip-no-'+code).html(val1.skip)
						}
					});
				});
			})
	}


</script>