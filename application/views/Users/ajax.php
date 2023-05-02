<script type="text/javascript">
	$(function() {
		function get_user() {
			$.ajax({
				url: "<?php echo base_url(); ?>AjaxUsers/ShowUsers",
				type: "post",
				success: function(res) {
					$('#myTable tbody').html(res);
				}
			})
		}
		get_user();

		$(document).on('change', '.use', function() {
			get_data($(this).val())
		})

		function get_data(id) {
			$.ajax({
				url: "<?php echo base_url(); ?>AjaxUsers/datauser",
				type: "post",
				data: "id=" + id,
				success: function(res) {
					$('.list-group').html(res);
				}
			})
		}
		$(document).on('click', '.status', function() {
			var id = $(this).attr('id')
			$.ajax({
				url: "<?php echo base_url(); ?>AjaxUsers/active",
				type: "post",
				data: "id=" + id + "&status=" + $(this).data('status'),
				success: function(res) {

					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'تم تعديل الحالة بنجاح',
						showConfirmButton: false,
						timer: 500
					})
					get_data(id)

				}
			})
		})

		$('.save').click(function() {
			console.log($('#form').serialize())
			$.ajax({
				url: "<?php echo base_url(); ?>AjaxUsers/addUser",
				type: "post",
				data: $('#form').serialize(),
				success: function(res) {
					console.log(res)
					if (res == 1) {
						$('#exampleModalCenter').modal('hide')
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'تم الحفظ بنجاح',
							showConfirmButton: false,
							timer: 500
						})
						$('#form').trigger("reset");
						get_user();
					} else {
						$("#mass").html(res)
					}
				}
			})
		})
		$(document).on("click", ".update", function() {
			$.ajax({
				url: "<?php echo base_url(); ?>AjaxUsers/getData_up",
				type: 'post',
				data: 'id=' + $(this).attr('id'),
				success: function(res) {
					var data = JSON.parse(res)
					$('#frist_name').attr('value', data['first_name'])
					$('#last_name').attr('value', data['last_name'])
					$('#user').attr('value', data['username'])
					$('#type_user').attr('value', data['type_user'])
					$('#id').attr('value', data['user_id'])

				}
			})
		})
		$('.edit').click(function() {

			$.ajax({
				url: "<?php echo base_url(); ?>AjaxUsers/updata_data",
				type: "post",
				data: $('#form-up').serialize(),
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
						$('#form-up').trigger("reset");
						get_user();
					} else {
						$("#mass1").html(res)
					}
				}
			})

		})

		function dele(id) {
			$.ajax({
				url: "<?php echo base_url() ?>AjaxUsers/delete_user/" + id,
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
					}else if(res == 2){
						Swal.fire({
							position: 'top-end',
							icon: 'warning',
							title: 'لايمكن حذف مستخدم قام ببعض العمليات في النظام',
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