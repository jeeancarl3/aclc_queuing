<?php

/**
 * @Author: Gian
 * @Date:   2018-12-15 15:06:58
 * @Last Modified by:   Gian
 * @Last Modified time: 2018-12-15 15:21:38
 */
?>
<script>
	
	$(function(){
		var tbl = $('#admin-table').DataTable({
	        "ordering": false,
	        "info":     false,
	        "filter":false,
	        "pageLength": 10,
	        
	        "language": {
					        "emptyTable":     "No data table rocords."
					    },
	    	"ajax": {
	    				'url':'<?= base_url()?>index.php/admin/accounts/administrator/autoload_admin',
	    				// 'dataSrc':''
	    			},
		});
		var options = {
	   		beforeSubmit: function(){
	   			$('#btn-aa').attr("disabled","disabled")
	   			$('#btn-aa').html("Saving..")
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
		            $("#btn-aa").removeAttr("disabled");
					$("#btn-aa").html("Save");
					tbl.ajax.reload();
	   			}
	   		},
	   		dataType:"JSON"
	   }
	   $('#form-text-aa').ajaxForm(options);

	   	$(document).on('click','.edit-aa',function(e){
	   		// alert($(this).attr('attr'))
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/accounts/administrator/get_info',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			// console.log(data.office_name)
	   			$.each(data, function(index, val) {
	   				$('#aa_id').val(val.aa_id)
	   				$('#fullname').val(val.fullname)
	   				$('#password').val(val.password)
	   				$('#username').val(val.username)
	   				
	   			});
	   		})
	   		
	   		e.preventDefault();
	   	})
	   	$(document).on('click','.delete-aa',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/accounts/administrator/delete_aa',
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