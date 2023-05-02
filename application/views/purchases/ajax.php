<script type="text/javascript">
	
	$(function() {
		function get_clint(){
		$.ajax({
			url:"<?php echo base_url() ?>ClintController/get_clint",
			type:"get",
			data:"custm=<?php echo isset($databill['client'])?$databill['client']:'' ?>",
			success:function(e){
				$("#custm1").html(e)
			}
		})
	}
	// $(".type_input").change(function(){
	// 	console.log($(".type_input:checked").val())
	// })
	get_clint()
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
	$("#varieties").change(function(){
		$.ajax({
				url:"<?php echo base_url(); ?>Varieties/get_q/"+$(this).val(),
				type:"get",
				success:function(res){
					$("#qwant-has").val(res)
				}
			})
	})
	$('#qwant').keyup(function(){
			$("#qwant-left").attr("value",parseInt($("#qwant-has").val())+parseInt($('#qwant').val()))
			$("#price").val(0)
		})
	$("#price").keyup(function(){
			$('#totel').attr("value",($(this).val()*$('#qwant').val()).toFixed(1))
		})
	function get_item() {
		$.ajax({
				url:"<?php echo base_url(); ?>PurchasesCon/get_items/<?php echo $databill["id_bill"]; ?>",
				type:"get",
				success:function(res){
					$('.bill tbody').html(res)
				}
			})
	}
	$(".type_input").change(function(){
		// console.log($(this).val())
		if($(this).val() == 1){
			$(".gram").hide();
			$(".bild").show();
		}else{
			$(".bild").hide();
			$(".gram").show();
		}
	})
	get_item()
	function saveitem(){
		console.log($("#form").serialize());
			$.ajax({
				url:"<?php echo base_url(); ?>PurchasesCon/insertitem",
				type:"post",
				data:$('#form').serialize()+"&id_bill=<?php echo $databill["id_bill"]; ?>",
				success:function(res){
					console.log(res)
					if(res == 1){
						alertify.success("تم التسجيل بنجا ح");
						$('#form').trigger("reset");
						$("#error").html("");
						get_item()
					}else{
						$('#error').html(res)
					}
				},error:function(e){
					console.log(e)
				}
			})
		}
		$("#send").click(function(){
			saveitem()
		})

		$(".delete-p").click(function(){
		// console.log($('.control:checked'))
		arra = []
		for(i = 0;i< $('.control:checked').length;i++)
			arra[i]=$('.control:checked')[i].value
		
	if($('.control:checked').length > 0){
		// console.log(arra.toString())
		$.ajax({
			url:"<?php echo base_url(); ?>PurchasesCon/delete_item",
			type:'post',
			data:"ids="+arra.toString()+"&id_bill="+<?php echo $databill['id_bill']; ?>,
			success:function(res){
				if(res == 1){
					alertify.success("تم الحذف  بنجا ح");
						// $('#form').trigger("reset");
						$("#error").html("");
						get_item()
						
				}else{
					$('#error').html(res)
				}
			},error:function(e){
				console.log(e)
			}

		})
	}
	})

$('.np').click(function () {
		var id = $(this).attr('id')
		// console.log()
		if(id != undefined){
			location.replace("<?php echo base_url(); ?>PurchasesCon/purchasesbill/"+id)
		}
	})
// var coust = 
// // $(' option[value=1]').attr('selected', 'selected')
// $("#custm1").val(1).change();
$(".edit_bill").click(function(){
		location.replace('<?php echo base_url(); ?>PurchasesCon/editBill/<?php echo $databill['id_bill']; ?>')
		
	})
$(".save_bill").click(function(){
		// console.log($("#custm").val())
		location.replace('<?php echo base_url(); ?>PurchasesCon/closeBill/<?php echo $databill['id_bill']; ?>/'+$(".type_input:checked").val()+'/'+$("#custm1").val())
		
	})
$(".new_bill").click(function(){
		// console.log($("#custm").val())
		location.replace('<?php echo base_url() ?>PurchasesCon/new_bill')
		
	})

})
	


</script>