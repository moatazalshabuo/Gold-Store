<script type="text/javascript">

	$(function(){
		function dele(id){

			location.replace("<?php echo base_url() ?>Varieties/delete_var/"+id);
		 }
		 $(document).on('click','.dele',function(){
		 	var id = $(".varie:checked").val()
			 Swal.fire({
				title: 'هل تريد حذف الصنف ?',
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