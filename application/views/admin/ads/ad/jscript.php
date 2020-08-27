<?php

/**
 * @Author: Gian
 * @Date:   2018-12-18 10:24:33
 * @Last Modified by:   Gian
 * @Last Modified time: 2019-01-08 11:37:05
 */
?>
<script type="text/javascript">
	$(function(){
		var tbl = $('#tbl-table').DataTable({
	        "ordering": false,
	        "info":     false,
	        "filter":false,
	        "pageLength": 10,
	    	"ajax": {
	    				'url':'<?= base_url()?>index.php/admin/ads/ad/autoload_table',
	    			},
	        "language": {
					        "emptyTable":     "No data availablein the table."
					    },
		});

		$(document).on('change', '#upload-btn', function() {
		    var input = $(this),
		        numFiles = input.get(0).files ? input.get(0).files.length : 1,
		        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		        $('#text-file').val(label)
		    input.trigger('fileselect', [numFiles, label]);
		});
		var options = {
	   		beforeSubmit: function(){
	   			$('#btn-save').attr("disabled","disabled")
	   			$('#btn-save').html("Saving..")
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
		            $("#btn-save").removeAttr("disabled");
					$("#btn-save").html("Save");
					tbl.ajax.reload();
	   			}
	   		},
	   		dataType:"JSON"
	   }
	   $('#form-text-aa').ajaxForm(options);

	   $(document).on('click','.edit-ads',function(e){
	   		// alert($(this).attr('attr'))
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/ads/ad/get_info',
	   			type: 'POST',
	   			dataType: 'JSON',
	   			data: {id: $(this).attr('attr')},
	   		})
	   		.done(function(data) {
	   			// console.log(data)
	   			$.each(data, function(index, val) {
	   				$('#ads_id').val(val.ads_id)
	   				$('#file_name').val(val.file_name)
	   				$('#duration').val(val.duration)
	   				$('#img-or-vid').val(val.file_type)
	   			});
	   		})
	   		
	   		e.preventDefault();
	   	})

	   $(document).on('click','.delete-ads',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/ads/ad/delete_ads',
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
			                toastr.success("successfuly delete ads.");
			        });
			        tbl.ajax.reload()
		   		}
		   		
	   		})
	   		
	   		e.preventDefault();
	   	
	   	});
	   $(document).on('click','.act-button',function(e){
	   		$.ajax({
	   			url: '<?= base_url()?>index.php/admin/ads/ad/activate_deactivate',
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