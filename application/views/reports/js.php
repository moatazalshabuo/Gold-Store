<script>
    $(function() {


        function dele(argument) {
            // body...
            $.ajax({
                url: "<?php echo base_url() ?>ExchangeReceipt/delete_ex/" + argument,
                type: "get",
                success: function(res) {
                    if (res == 1) {
                        
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'delete done',
                            showConfirmButton: false,
                            timer: 500
                        })
                        location.reload()

                    }
                }
            })
        }

        function dele1(argument) {
            // body...
            $.ajax({
                url: "<?php echo base_url() ?>ExchangeReceipt/delete_clint_ex/" + argument,
                type: "get",
                success: function(res) {
                    if (res == 1) {
                        
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'delete done',
                            showConfirmButton: false,
                            timer: 500
                        })
                        location.reload()

                    }
                }
            })
        }

        $(".delete-exchange").click(function() {
            id = $("#chek:checked")
            if (id.val() != undefined) {
                Swal.fire({
                    title: 'هل تريد حذف الايصال ?',

                    showCancelButton: true,
                    confirmButtonColor: "red",
                    confirmButtonText: 'حذف',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        if (id.data("type") == 1) {
                            dele1(id.val())
                        } else {
                            dele1(id.val())
                        }
                    }
                })

            }
        })

    })
</script>