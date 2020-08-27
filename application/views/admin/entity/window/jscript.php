<?php

/**
 * @Author: Gian
 * @Date:   2018-12-15 12:25:34
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-09 10:22:51
 */
?>
<script >
	
	$(function(){
		var tbl = $('#window-table').DataTable({
	        "ordering": false,
	        "info":     false,
	        "filter":false,
	        "pageLength": 10,
	        
	        "language": {
					        "emptyTable":     "No data table rocords."
					    },
	    	"ajax": {
	    				'url':'<?= base_url()?>index.php/admin/entity/window/autoload_window',
	    				// 'dataSrc':''
	    			},
		});
		var options = {
	   		beforeSubmit: function(){
	   			$('#btn-window').attr("disabled","disabled")
	   			$('#btn-window').html("Saving..")
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
		            $("#btn-window").removeAttr("disabled");
					$("#btn-window").html("Save");
					tbl.ajax.reload();
	   			}
	   		},
	   		dataType:"JSON"
	   }
	   $('#form-text-window').ajaxForm(options);

	   	$(document).on('click','.edit-win',function(e){
	   		// alert($(this).attr('attr'))
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/window/get_info',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			// console.log(data.office_name)
	   			$.each(data, function(index, val) {
	   				$('#o_id').val(val.o_id)
	   				$('#window_name').val(val.window_name)
	   				$('#w_id').val(val.w_id)
	   				
	   			});
	   		})
	   		
	   		e.preventDefault();
	   	})
	   	$(document).on('click','.delete-win',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/window/delete_win',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			// console.log(data)
	   			if(data == "success"){
		   			setTimeout(function() {
			                toastr.options = {
			                    closeButton: true,
			                    progressBar: true,
			                    showMethod: 'slideDown',
			                    timeOut: 4000
			                };
			                toastr.success("successfuly delete office.");
			        });
			        tbl.ajax.reload()
		   		}
		   		
	   		})
	   		
	   		e.preventDefault();
	   	})
	   	$(document).on('click','.act-button',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/window/activate_deactivate',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr'), status:$(this).html()},
	   		})
	   		.done(function(data) {
	   			// console.log(data)
	   			if(data.success == "success"){
	   				setTimeout(function() {
		                toastr.options = {
		                    closeButton: true,
		                    progressBar: true,
		                    showMethod: 'slideDown',
		                    timeOut: 4000
		                };
		                toastr.success(data.msg);
		            });
		            tbl.ajax.reload()
	   			}
	   		})
	   		
	   		e.preventDefault();
	   	})
	})
	
</script>