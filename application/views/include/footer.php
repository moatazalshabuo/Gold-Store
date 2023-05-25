</div>
<!-- modals 1 -->
<div class="modal fade bd-example1-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-4">
			<div class="row ">
				<div class="col-md-9 mx-0 text-right">
					<form id="form-echange">
						<label>اسم العميل</label>
						<div class="w-100">
							<select type="text" name="name_clint" id="name_clint" class="sele form-control">
							</select>
						</div>
						<div class="row p-2">
							<div class="grid-item mx-0 col-md-5">
								<div class="form-group">
									<label>قيمة سداد المصنعية</label>
									<input class="form-control" type="number" name="value" value="0" id="value_input">
								</div>
								<div class="form-group">
									<label>الاسداد بي </label>
									<select type="text" name="type_gram" id="type_gram" class="sele form-control">
									</select>
								</div>
								<div class="form-group">
									<label>سداد الجرامات</label>
									<input type="number" class="form-control" name="gram_val" id="gram_val">
								</div>
								<span class="text-success" id="gram_span"></span>
							</div>
							<div class="grid-item mx-1 col-md-6">
								<div class="form-group">
									<label>قيمة المصنعية </label>
									<input type="number" class="form-control" id="clint_val" disabled>
								</div>
								<div class="form-group">
									<label>الكمية المستحقة محولة بعيار 18</label>
									<input type="number" class="form-control" id="clint_qwant" disabled>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="grid-item mx-0 col-md-3">
					<button class="my-btn mb-2" id="save">حفظ</button><br>
					<button class="my-btn mb-2" id="new">جديد</button><br>
					<button class="my-btn mb-2 print_c">طباعة ايصال</button><br>
					<button class="my-btn-red mb-2 delete_c">الغاء ايصال </button>
				</div>
			</div>
			<div class="alert" id="alert_model"></div>
			<button type="button" class="my-btn mt-3" id="close" data-dismiss="modal">اغلاق</button>
		</div>
	</div>
</div>
<div class="modal fade bd-example2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-4">
			<div class="row ">
				<div class="col-md-9 mx-0 text-right">
					<form id="form_ex">
						<label>نوع الايصال </label>
						<div class="w-100">
							<select type="text" name="type_ex" id="type_ex" class="sele form-control">
								<option value="2">مصروفات</option>
								<option value="3">رواتب</option>
								<option value="4">اجارات</option>
							</select>
						</div>
						<div class="row p-2">
							<div class="grid-item mx-0 col-md-12">
								<div class="form-group">
									<label>بيان الايصال</label>
									<input class="form-control" type="text" name="descrip" placeholder="بيان الايصال">
								</div>
								<div class="form-group">
									<label>القيمة </label>
									<input type="number" name="value" class="form-control">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="grid-item mx-0 col-md-3">
					<button class="my-btn mb-2" id="save_ex">حفظ</button><br>
					<button class="my-btn mb-2" id="new1">جديد</button><br>
					<button class="my-btn mb-2 print_ex" id="">طباعة ايصال</button><br>
					<button class="my-btn-red mb-2 delete_ex" id="">الغاء ايصال </button>
				</div>
			</div>
			<div class="alert" id="alert_model_ex"></div>
			<button type="button" class="my-btn mt-3" id="close1" data-dismiss="modal">اغلاق</button>
		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade " id="addClint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-min">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-right">
				<div class="text-danger error"></div>
				<form id="form-clint">
					<div class="form-group">
						<label>الاسم </label>
						<input type="text" required class="form-control" name="name">
					</div>
					<div class="form-group">
						<label>رقم الهاتف</label>
						<input type="number" required class="form-control" name="phone">
					</div>
				</form>
			</div>
			<div class="modal-footer bg-min">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button type="button" class="btn btn-primary" id="saveclint">حفظ</button>
			</div>
		</div>
	</div>
</div>
<!-- modal -->
<!--بداية الفاتورة المطبوعة-->


<div class="card-bill">
	<div class="grid-full-contaner p-2">
		<div class="grid-item grid-row-span-10">
			<h1 class="text-center">اسم المحل</h1>
		</div>
	</div>
	<div class="grid-contaner p-2">
		<div class="grid-item text-center text-dow">

			<h6 class="pt-4">رقم الهاتف</h6>

		</div>

		<div class="grid-item text-center">

			<h5 class="pt-4">تاريخ الفاتورة</h5>

		</div>
	</div>

	<div>
		<div class="grid-full-contaner pr-2 pl-2 pb-2">
			<div class="grid-item">


				<div class="grid-item">
					<div class="card">
						<table class="table table-hover text-right bill">
							<thead>
								<tr>
									<th></th>
									<th scope="col">اسم الصنف</th>
									<th scope="col">العيار</th>
									<th scope="col">الكمية </th>
									<th scope="col">سعر الجرام </th>
									<th scope="col">الاجمالي</th>
									<th scope="col">تاريخ الاضافة</th>
								</tr>
							</thead>
							<!-- <div class="over-bill"></div> -->
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>

	</div>
	<div class="grid-contaner pr-2 pl-2 pb-2">
		<div class="grid-item grid-row-span-5 text-center">
			<h6 class="">خالص مع الشكر</h6>
		</div>

		<div class="grid-item grid-row-span-5 text-center">
			<h6 class="">اجمالي الفاتورة</h6>
			<h6 class="pt-3">اسم البائع</h6>
		</div>
	</div>
</div>
</div>

<!--نهاية الفاتورة المطبوعة-->





<!--بداية الايصال -->


<div class="card-recip printArea" id='printMe'>
	<div class="grid-full-contaner p-2">
		<div class="grid-item grid-row-span-10">
			<h1 class="text-center">اسم المحل</h1>
		</div>
	</div>
	<div class="grid-contaner p-2">
		<div class="grid-item text-center text-dow">

			<h6 class="pt-4">رقم الهاتف</h6>

		</div>

		<div class="grid-item text-center">

			<h5 class="pt-4">تاريخ الايصال</h5>

		</div>
	</div>

	<div>
		<div class="grid-full-contaner pr-2 pl-2 pb-2">
			<div class="grid-item">
				<div class="grid-item">
					<div class="card">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid-contaner pr-2 pl-2 pb-2">
		<div class="grid-item grid-row-span-5 text-center">
			<h6 class="">وظيفة الايصال</h6>
		</div>
		<div class="grid-item grid-row-span-5 text-center">
			<h6 class="">اجمالي الايصال</h6>
			<h6 class="pt-3">اسم الموظف</h6>
		</div>
	</div>
</div>
</div>

<!--نهاية الايصال -->
<script type="text/javascript">
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<!-- <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script> -->

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/printThis-master/printThis.js"></script> -->

<script>
	// In your Javascript (external .js resource or <script> tag)
	function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
		const btn=document.querySelector(".print");
    function printORsave(){
        window.print();
    }
	btn.addEventListener("click",printORsave);
	$(document).ready(function() {
		$('.js-example-basic-single ,#custm1,#name_clint ,select#varieties').select2();
		// $('#custm').selectpicker();
		function reset() {
			$("#gram_span, #alert_model_ex,#alert_model").text("")
			$("#form-echange").trigger("reset")
			$("#form_ex").trigger("reset")
			$(".print_ex").attr("id", "")
			$(".delete_ex").attr("id", "")
			$("#alert_model_ex").removeClass("alert-success")
			$("#alert_model_ex").removeClass("alert-danger")
		}

		function extchange() {
			$.ajax({
				url: "<?php echo base_url() ?>ExchangeReceipt/get_ex",
				type: "get",
				success: function(res) {
					// console.log(res)
					var data = JSON.parse(res)
					// console.log(res)
					$("#name_clint").html(data['clint'])
					// console.log(data['ks'])
					$("#type_gram").html(data['ks'])
				}
			})
		}
		extchange();

		function select_clinet(id) {
			$.ajax({
				url: "<?php echo base_url(); ?>ExchangeReceipt/Get_clint_row/" + id,
				type: "get",
				success: function(e) {
					data = JSON.parse(e)
					console.log(e)
					$("#clint_val").val(data['value'])
					$("#clint_qwant").val(data["Quantity"])
				}
			})
		}

		$("#name_clint").change(function() {
			// reset();
			console.log($(this).val())
			select_clinet($(this).val())
		})

		$("#gram_val").keyup(function() {
			var type = $("#type_gram option:selected").attr("id")
			// console.log(type)
			if (type != '18' && type != undefined) {
				// console.log(parseInt($(this).val()))
				// console.log((parseInt($(this).val())*parseInt($("#type_gram").val()))/18)
				var re = ((parseFloat($(this).val()) * parseFloat(type)) / 18).toFixed(2)
				$("#gram_span").text(re + ":جراام عيار 18")
				// console.log()
				if ($("#gram_val").val() == "") {
					$("#gram_span").text("")
				}
			}
		})
		$("#save").click(function() {
			$("#gram_span").text("")
			// console.log($("#form-echange").serialize())
			$.ajax({
				url: "<?php echo base_url() ?>ExchangeReceipt/add",
				type: "post",
				data: $("#form-echange").serialize(),
				success: function(res) {
					console.log(res)
					data = JSON.parse(res)
					if (data['success'] != undefined && data['success'] != "") {
						// console.log
						select_clinet($("#name_clint").val())
						$("#alert_model").addClass("alert-success")
						$("#alert_model").html(data['success'])
						$(".print_c").attr("id", data['id'])
						$(".delete_c").attr("id", data['id'])
					} else if (data['error'] != undefined && data['error'] != "") {
						$("#alert_model").addClass("alert-danger")
						console.log(data['error'])
						$("#alert_model").html(data['error'])
					}
				}
			})
		})

		$("#save_ex").click(function() {
			$.ajax({
				url: "<?php echo base_url() ?>ExchangeReceipt/add_ex",
				type: "post",
				data: $("#form_ex").serialize(),
				success: function(res) {
					data = JSON.parse(res)
					if (data['success'] != undefined && data['success'] != "") {
						console.log(res)
						$("#alert_model_ex").addClass("alert-success")
						$("#alert_model_ex").html(data['success'])
						$(".print_ex").attr("id", data['id'])
						$(".delete_ex").attr("id", data['id'])
					} else if (data['error'] != undefined && data['error'] != "") {
						$("#alert_model_ex").addClass("alert-danger")
						$("#alert_model_ex").html(data['error'])
					}
				}
			})
		})

		$("#close,#close1,#new,#new1").click(function() {
			reset()
		})

		$(".delete_ex").click(function() {
			id = $(this).attr("id");
			if (id != "" && id != undefined) {
				Swal.fire(
					'',
					'سيتم حذف هذا الايصال',
					'warning'
				).then(() => {
					dele(id)
				})
			}
		})

		function dele(argument) {
			// body...
			$.ajax({
				url: "<?php echo base_url() ?>ExchangeReceipt/delete_ex/" + argument,
				type: "get",
				success: function(res) {
					if (res == 1) {
						reset()
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'delete done',
							showConfirmButton: false,
							timer: 500
						})

					}
				}
			})
		}
		$(".delete_c").click(function() {
			id = $(this).attr("id");
			if (id != "" && id != undefined) {
				Swal.fire(
					'',
					'سيتم حذف هذا الايصال',
					'warning'
				).then(() => {
					dele1(id)
				})
			}
		})

		function dele1(argument) {
			// body...
			$.ajax({
				url: "<?php echo base_url() ?>ExchangeReceipt/delete_clint_ex/" + argument,
				type: "get",
				success: function(res) {
					if (res == 1) {
						reset()
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'delete done',
							showConfirmButton: false,
							timer: 500
						})

					}
				}
			})
		}
		//     $("#value_input").keyup(function(e){
		//       if($("#name_clint").val() != ""){
		//         if(e.keyCode == 8){
		//         $("#clint_val").val(parseInt($("#value_input").val())+parseInt($("#clint_val").val()));
		//       }
		//         $("#clint_val").val(parseInt($("#value_input").val())-parseInt($("#clint_val").val()));
		//       }
		//       // 
		//     })
	});
</script>
</body>

</html>
