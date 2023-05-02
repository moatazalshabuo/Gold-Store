<script type="text/javascript">
    $(function() {
        $(".varie").change(function() {
            if ($(this).is(":checked"))
                $(this).parent("td").parent().css("background", "grey")
            else
                $(this).parent("td").parent().css("background", "#fff")
        })

        function dele(id) {

            location.replace("<?php echo base_url() ?>Varieties/delete_barren?id=" + id);
        }
        $(document).on('click', '.dele', function() {
            j = 0 
            id = ""
            for(i = 0;i<$(".varie").length;i++){
                if($(".varie:eq("+i+")").is(":checked")){
                    if(j != 0)
                    id += ","
                    id += $(".varie:eq("+i+")").val()
                    j++
                }
            }
            
            Swal.fire({
				title: 'هل تريد حذف  ?',
			
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