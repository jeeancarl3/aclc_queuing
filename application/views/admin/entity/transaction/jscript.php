<?php

/**
 * @Author: Gian
 * @Date:   2018-12-15 09:07:40
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-03-18 11:38:50
 */
?>

<script >
	function readURL(input) {
	    if (input.files && input.files[0]) {
	      	var reader = new FileReader();
	      
	      	reader.onloadend = function () { // set image data as background of div
	          	$('#blah').attr('src', this.result);
	          	$('#blah').css({width: "100%" })
	      	}
	      
	      	reader.readAsDataURL(input.files[0]);
	    }
	}
	$(function(){
		var tbl = $('#trans-table').DataTable({
	        "ordering": false,
	        "info":     false,
	        "filter":false,
	        "pageLength": 10,
	        
	        "language": {
					        "emptyTable":     "No Transactions"
					    },
	    	"ajax": {
	    				'url':'<?= base_url()?>index.php/admin/entity/transaction/autoload_transaction',
	    				// 'dataSrc':''
	    			},
		});
		var options = {
	   		beforeSubmit: function(){
	   			$('#btn-office').attr("disabled","disabled")
	   			$('#btn-office').html("Saving..")
	   		},
	   		resetForm:true,

	   		success:function(data){
	   			// console.log(data);
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

	   	$(document).on('click','.edit-trans',function(e){
	   		// alert($(this).attr('attr'))
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/transaction/get_info',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			// console.log(data.office_name)
	   			$.each(data, function(index, val) {
	   				$('#o_id').val(val.o_id)
	   				$('#trans_name').val(val.trans_name)
	   				$('#trans_code').val(val.trans_code)
	   				$('#t_id').val(val.t_id)
	   				if(val.img_paths != null){
	   					$('#blah').attr('src', '<?= base_url()?>'+val.img_paths);
	   				}
	   			});
	   		})
	   		
	   		e.preventDefault();
	   	})
	   	$(document).on('click','.delete-trans',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/transaction/delete_trans',
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
	   			url: '<?= base_url()?>index.php/admin/entity/transaction/activate_deactivate',
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
	   	$(document).on('change','.custom-file-input',function(e){
			readURL(this);
			e.preventDefault();
		})
	})
	
</script>