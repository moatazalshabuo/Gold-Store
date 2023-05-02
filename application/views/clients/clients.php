<div class="container mt-3">
	<div class="m-2 text-right"><button class="btn btn-primary p-2" data-toggle="modal" data-target="#addClint">اضافة عميل</button></div>
	<div class="row ">
		<!-- show user in table -->
		<div class="col-md-8">
			<div class="card" style="max-height: 500px;overflow-y: scroll;">
				<div class="card-header">
					<input type="text" id="myInput" onkeyup="myFunction()" placeholder="البحث بالاسم  ...">
				</div>
				<div class="card-body">
					<table id="myTable">
						<thead>
							<tr class="header">
								<th style="width:5%;"></th>
								<th style="width:55%;">الاسم</th>
								<th style="width:40%;">رقم الهاتف</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- show one user all data -->
		<div class="col-md-4">
			<div class="card">
				<div class="card-body text-right">
					<div class="img text-center mb-3">
						<!-- <img width="120" height="120" src="<?php echo base_url() ?>assets/images/ff.jpg"> -->
					</div>
					<ul class="list-group text-right" style="margin:auto;">

					</ul>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- model insert user  -->

<!-- modal edit -->
<div class="modal fade " id="addClint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-min">
				<h5 class="modal-title" id="exampleModalLabel">اضافة عميل</h5>
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
<!--  end model insert user -->



<!-- start model -->
<div class="modal fade " id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-min">
				<h5 class="modal-title" id="exampleModalLabel">تحديث بيانات عميل</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-right">

				<div class="text-danger error_clintUpdate"></div>
				<form id="form_clint_edit">
					<div class="form-group">
						<label>الاسم </label>
						<input type="text" required class="form-control" name="name" id="nameEditClient">
						<input type="hidden" id="idEditClient" name="id">
					</div>
					<div class="form-group">
						<label>رقم الهاتف</label>
						<input type="number" required class="form-control" name="phone" id="phoneEditClient">
					</div>
				</form>
			</div>
			<div class="modal-footer bg-min">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button type="button" class="btn btn-primary" id="EditClient">تحديث</button>
			</div>
		</div>
	</div>
</div>
<!--  end model insert user -->

<!-- model update user  -->
