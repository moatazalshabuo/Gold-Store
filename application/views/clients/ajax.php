<script type="text/javascript">
	$(function() {

		$("#saveclint").click(function(){
		$.ajax({
			url:"<?php echo base_url() ?>ClintController/addClint",
			type:"post",
			data:$("#form-clint").serialize(),
			success:function(e){
				if(e == 1){
					$("#addClint").modal('hide')
					alertify.success("تم التسجيل بنجا ح");
					$('#form-clint').trigger("reset");
					$(".error").html("");
					get_clint()
				}else{
					$(".error").html(e)
				}
			},error:function(e){
				console.log(e)
			}
		})
	})

		function get_client() {
			$.ajax({
				url: "<?php echo base_url(); ?>ClintController/ShowClient",
				type: "post",
				success: function(res) {
					$('#myTable tbody').html(res);
				}
			})
		}
		get_client();

		$(document).on('change', '.use', function() {
			get_data($(this).val())
		})

		function get_data(id) {
			$.ajax({
				url: "<?php echo base_url(); ?>ClintController/dataclient",
				type: "post",
				data: "id=" + id,
				success: function(res) {
					$('.list-group').html(res);
				}
			})
		}
		// $(document).on('click', '.status', function() {
		// 	var id = $(this).attr('id')
		// 	$.ajax({
		// 		url: "<?php echo base_url(); ?>AjaxUsers/active",
		// 		type: "post",
		// 		data: "id=" + id + "&status=" + $(this).data('status'),
		// 		success: function(res) {

		// 			Swal.fire({
		// 				position: 'top-end',
		// 				icon: 'success',
		// 				title: 'تم تعديل الحالة بنجاح',
		// 				showConfirmButton: false,
		// 				timer: 500
		// 			})
		// 			get_data(id)

		// 		}
		// 	})
		// })

		// $('.save').click(function() {
		// 	console.log($('#form').serialize())
		// 	$.ajax({
		// 		url: "<?php echo base_url(); ?>AjaxUsers/addUser",
		// 		type: "post",
		// 		data: $('#form').serialize(),
		// 		success: function(res) {
		// 			console.log(res)
		// 			if (res == 1) {
		// 				$('#exampleModalCenter').modal('hide')
		// 				Swal.fire({
		// 					position: 'top-end',
		// 					icon: 'success',
		// 					title: 'تم الحفظ بنجاح',
		// 					showConfirmButton: false,
		// 					timer: 500
		// 				})
		// 				$('#form').trigger("reset");
		// 				get_user();
		// 			} else {
		// 				$("#mass").html(res)
		// 			}
		// 		}
		// 	})
		// })
		$(document).on("click", ".update", function() {
			$.ajax({
				url: "<?php echo base_url(); ?>ClintController/getdataup",
				type: 'post',
				data: 'id=' + $(this).attr('id'),
				success: function(res) {
					var data = JSON.parse(res)
					console.log(res)
					$('#nameEditClient').attr('value', data['name'])
					$('#phoneEditClient').attr('value', data['phone_number'])
					$('#idEditClient').attr('value', data['client_id'])
				}
			})
		})
		$('#EditClient').click(function() {
			console.log($('#form_clint_edit').serialize())
			$.ajax({
				url: "<?php echo base_url(); ?>ClintController/updata_data",
				type: "post",
				data: $('#form_clint_edit').serialize(),
				success: function(res) {
					console.log(res)
					if (res == 1) {
						$('#update').modal('hide')
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'تم التعديل بنجاح',
							showConfirmButton: false,
							timer: 500
						})
						$('#form_clint_edit').trigger("reset");
						get_user();
					} else {
						$(".error_clintUpdate").html(res)
					}
				}
			})

		})

		function dele(id) {
			$.ajax({
				url: "<?php echo base_url() ?>ClintController/delete_client/" + id,
				type: 'get',
				success: function(res) {
					console.log(res + " " + id)
					if (res == 1) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'تم حذف البيانات بنجاح ',
							showConfirmButton: false,
							timer: 500
						})
						get_user();
					}else if(res == 2)
					{
						Swal.fire({
							position: 'top-end',
							icon: 'warning',
							title: 'لا يمكن حذف هذا العميل ستترتب عليه فقدان بعض البيانات بالنظام ',
							showConfirmButton: false,
							timer: 4000
						})
					}
				}
			})
		}
		$(document).on('click', '.dele', function() {
			var id = $(this).attr('id')
			Swal.fire({
				title: 'هل تريد حذف المستخدم ?',
			
				showCancelButton: true,
				confirmButtonColor:"red",
				confirmButtonText: 'حذف',
				denyButtonText: `Don't save`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					dele(id)
				}
			})
			
		})
	})
</script>