<script type="text/javascript">
	
	$(function() {
		function t_q() {
		$.ajax({
				url:"<?php echo base_url(); ?>SalesCon/totals/<?php echo $databill["sales_id"]; ?>",
				type:"get",
				success:function(res){
					data = JSON.parse(res);
					$('#t').text(data['Total_value'])
					$('#q').text(data['Quantity'])
				}
			})
	}
	t_q();

	function get_item() {
		$.ajax({
				url:"<?php echo base_url(); ?>SalesCon/get_items/<?php echo $databill["sales_id"]; ?>",
				type:"get",
				success:function(res){
					$('.bill tbody').html(res)
				}
			})
	}
		$('#sele').change(function(){
			$.ajax({
				url:"<?php echo base_url(); ?>Varieties/get_q/"+$(this).val(),
				type:"get",
				success:function(res){
					$("#qwant-has").val(res)
					$('#qwant').attr('max',$("#qwant-has").val())
				}
			})
		})
		$('#qwant').keyup(function(){
			$("#qwant-left").attr("value",$("#qwant-has").val()-$('#qwant').val())
		})
		$("#price").keyup(function(){
			$('#totel').attr("value",($(this).val()*$('#qwant').val()).toFixed(1))
		})
		
		$("#descont").keyup(function(){
			$("#des").attr("value",$(this).val())
			// console.log($(this).val())
		})
		function get_v(){
			$.ajax({
				url:"<?php echo base_url(); ?>SalesCon/get_v",
				type:"post",
				success:function(res){
					$("#sele").html(res)
				}
			})
		}
		function saveitem(){
			$.ajax({
				url:"<?php echo base_url(); ?>SalesCon/insertitem",
				type:"post",
				data:$('#form').serialize()+"&sales_id=<?php echo $databill["sales_id"]; ?>",
				success:function(res){
					if(res == 1){
						alertify.success("تم التسجيل بنجا ح");
						$('#form').trigger("reset");
						$("#error").html("");
						get_item()
						t_q();
						get_v()
					}else{
						$('#error').html(res)
					}
				}
			})
		}
		$('#send').click(saveitem)

	get_item()
	
	$(".delete-p").click(function(){
		// console.log($('.control:checked'))
		arra = []
		for(i = 0;i< $('.control:checked').length;i++)
			arra[i]=$('.control:checked')[i].value
		
	if($('.control:checked').length > 0){
		console.log(arra.toString())
		$.ajax({
			url:"<?php echo base_url(); ?>SalesCon/delete_item",
			type:'post',
			data:"ids="+arra.toString(),
			success:function(res){
				if(res == 1){
					alertify.success("تم التسجيل بنجا ح");
						$('#form').trigger("reset");
						$("#error").html("");
						get_item()
						t_q();
						get_v()
				}else{
					$('#error').html(res)
				}
			}

		})
	}
	})
	<?php if($databill['status'] == 0){ ?>
		$(".control").attr("disabled","disabled")
	<?php } ?>

	$('.np').click(function () {
		var id = $(this).attr('id')
		// console.log()
		if(id != undefined){
			location.replace("<?php echo base_url(); ?>SalesCon/salesbill/"+id)
		}
	})

	$(".save_bill").click(function(){
		// console.log($("#custm").val())
		location.replace('<?php echo base_url(); ?>SalesCon/closeBill/<?php echo $databill['sales_id']; ?>/'+$("#custm").val())
		// $.ajax({
		// 	url:"<?php echo base_url(); ?>SalesCon/colse_bill/<?php echo $databill['sales_id']; ?>",
		// 	type:"POST",
		// 	data:"coustum"
		// })
	})

	$("#open").click(function(){
		location.replace('<?php echo base_url(); ?>SalesCon/new_bill/<?php echo $databill['sales_id']; ?>/'+$("#custm").val())
	})

	$(".edit_bill").click(function(){
		location.replace('<?php echo base_url(); ?>SalesCon/editBill/<?php echo $databill['sales_id']; ?>')
		// $.ajax({
		// 	url:"<?php echo base_url(); ?>SalesCon/colse_bill/<?php echo $databill['sales_id']; ?>",
		// 	type:"POST",
		// 	data:"coustum"
		// })
	})
	$('#bill_num').keyup(function(e){
	   //do stuff here
		if(e.keyCode == 13){
		location.replace("<?php echo base_url() ?>SalesCon/salesbill/"+$(this).val())			
		}
		// console.log($(this).val())
	});
	$(".print").click(function() {
		// $(".card-bill").printThis()
		location.replace("<?php echo base_url() ?>SalesCon/print/"+$(this).attr('id'))
	})
	// const btn=document.querySelector(".print");

    // function printORsave(){
    //     window.print();
    // }
    
	// btn.addEventListener("click",printORsave);
	})
</script>