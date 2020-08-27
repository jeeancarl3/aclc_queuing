<?php

/**
 * @Author: Gian
 * @Date:   2018-12-15 14:05:05
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 14:58:07
 */
?>
<script>
	
	$(function(){
		var tbl = $('#wa-table').DataTable({
	        "ordering": false,
	        "info":     false,
	        "filter":false,
	        "pageLength": 10,
	        
	        "language": {
					        "emptyTable":     "No data table rocords."
					    },
	    	"ajax": {
	    				'url':'<?= base_url()?>index.php/admin/accounts/window_account/autoload_window',
	    				// 'dataSrc':''
	    			},
		});
		var options = {
	   		beforeSubmit: function(){
	   			$('#btn-wa').attr("disabled","disabled")
	   			$('#btn-wa').html("Saving..")
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
		            $("#btn-wa").removeAttr("disabled");
					$("#btn-wa").html("Save");
					tbl.ajax.reload();
	   			}
	   		},
	   		dataType:"JSON"
	   }
	   $('#form-text-wa').ajaxForm(options);

	   	$(document).on('click','.edit-wa',function(e){
	   		// alert($(this).attr('attr'))
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/accounts/window_account/get_info',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			$.each(data, function(index, val) {
	   				$('#o_id').val(val.o_id)
	   				$('#wa_id').val(val.wa_id)
	   				$('#fullname').val(val.fullname)
	   				$('#password').val(val.password)
	   				$('#username').val(val.username)
	   				
	   			});
	   		})
	   		
	   		e.preventDefault();
	   	})
	   	$(document).on('click','.delete-wa',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/accounts/window_account/delete_wa',
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
	})
	
</script>