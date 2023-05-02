<div class="container mt-3">
	<div class="m-2 text-right"><button class="btn btn-primary p-2" data-toggle="modal" data-target="#exampleModalCenter">اضافة موظف</button></div>
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
			    <th style="width:40%;">اسم المستخدم</th>
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
				<img width="120" height="120" src="<?php echo base_url() ?>assets/images/ff.jpg">
			</div>
			<ul class="list-group text-right" style="margin:auto;">
			  
			</ul>
		</div>
	</div>
</div>

</div>
</div>

<!-- model insert user  -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">تسجيل موظف</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-right">
      	<div class="text-danger" id='mass'></div>
        <form id="form">
        	<div class="form-group">
        		<label>الاسم الاول</label>
        		<input type="text" name="frist_name" class="form-control" placeholder="الاسم الاول">
        	</div>
        	<div class="form-group">
        		<label>الاسم الاخير</label>
        		<input type="text" name="last_name" class="form-control" placeholder="الاسم الاخير">
        	</div>
        	<div class="form-group">
        		<label>الاسم الاخير</label>
        		<input type="text" name="username" class="form-control" placeholder="اسم المستخدم ">
        	</div>
        	<div class="form-group">
        		<label>صلاحية المستخدم</label>
        		<select class="form-control" name="type_user">
        			<option value="0">المسؤول</option>
        			<option value="1">ادارة </option>
        			<option value="2">موظف مبيعات </option>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>كلمة المرور</label>
        		<input type="password" name="password" class="form-control" placeholder="********">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="button" class="btn btn-primary save">حفظ البيانات</button>
      </div>
    </div>
  </div>
</div>

<!--  end model insert user -->
<!-- model update user  -->

<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">تسجيل موظف</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-right">
      	<div class="text-danger" id='mass1'></div>
        <form id="form-up">
        	<div class="form-group">
        		<label>الاسم الاول</label>
        		<input type="text" name="frist_name" value="" id="frist_name" class="form-control" placeholder="الاسم الاول">
        	</div>
        	<div class="form-group">
        		<label>الاسم الاخير</label>
        		<input type="text" name="last_name" value="" id="last_name" class="form-control" placeholder="الاسم الاخير">
        	</div>
        	<div class="form-group">
        		<label>الاسم الاخير</label>
        		<input type="text" name="username" value="" id="user" class="form-control" placeholder="اسم المستخدم ">
        	</div>
        	<div class="form-group">
        		<label>صلاحية المستخدم</label>
        		<select class="form-control" id="type_user" name="type_user">
        			<option value="0">المسؤول</option>
        			<option value="1">ادارة </option>
        			<option value="2">موظف مبيعات </option>
        		</select>
        	</div>
        	<input type="hidden" name="id" id='id'>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="button" class="btn btn-primary edit">حفظ البيانات</button>
      </div>
    </div>
  </div>
</div>

<!--  end model update user -->