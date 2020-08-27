<?php

/**
 * @Author: Gian
 * @Date:   2018-12-14 09:24:23
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-02-07 11:16:52
 */
?>
<style type="text/css">
	table.dataTable thead th, table.dataTable thead td{
		padding:0;
	}
</style>
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
		var tbl = $('#office-table').DataTable({
	        "ordering": false,
	        "info":     false,
	        "filter":false,
	        "pageLength": 10,
	    	"ajax": {
	    				'url':'<?= base_url()?>index.php/admin/entity/office/autoload_office',
	    			},
	        "language": {
					        "emptyTable":     "No data availablein the table."
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

	   	$(document).on('click','.edit-office',function(e){
	   		// alert($(this).attr('attr'))
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/office/get_info',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			// console.log(data)
	   			$.each(data, function(index, val) {
	   				$('#o_id').val(val.o_id)
	   				$('#officeName').val(val.office_name)
	   				$('#initialCode').val(val.initial_code)
	   				$('#colorCode').val(val.color)

	   				if(val.img_path != null){

	   					$('#blah').attr('src', '<?= base_url()?>'+val.img_path);
	   				}
	   			});
	   		})
	   		
	   		e.preventDefault();
	   	})
	   	$(document).on('click','.delete-office',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/entity/office/delete_office',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			console.log(data)
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
	   			url: '<?= base_url()?>index.php/admin/entity/office/activate_deactivate',
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