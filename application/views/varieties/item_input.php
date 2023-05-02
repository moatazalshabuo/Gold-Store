  <div class="container ">
  <!-- end header section -->
    <div class="row m-1">
        <div class="grid-item col-md-12">
          <form method="post" action="">
            <div class="row text-right">
              <div class="form-group col-md-6">
                <label for="">:بيان الصنف</label>
                <input type="text" id="myInput" onkeyup="myFunction()"name="varieties_name" class="form-control">
              </div>
              <div class="form-group col-md-3">
                <label for="number">:نوع الصنف</label>
                <select name="type" require="true" id="cerat" class="form-control">
                  <option value="1">جديد</option>
                  <option value="2">كسر</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>:العيار</label>
                <select name="caliber" require="true" id="cerat" class="form-control">
                  <option value="18">18</option>
                  <option value="21">21</option>
                  <option value="24">24</option>
                </select>
              </div>
            </div>
            <input type="submit" class="btn my-btn" value="حفظ">
          </form>
          <!--<input type="number"> <label for="">:سعر البيع</label> <input type="number"><label for="number">:وزن الصنف</label>-->

        </div>
    </div>
<div class="row">
    <div class="grid-item mx-0 mt-2  col-md-2 ">
        <button class="my-btn-red mb-2 dele" type="button"><i class="fa-solid fa-delete-left mr-2"></i>الغاء صنف</button><br>
        <button class="my-btn mb-2 " type="button"><i class="fa-solid fa-pen-to-square mr-2"></i>تعديل</button><br>
    </div>
    <!-- <div class="col-md-1"></div> -->
<div class="col-md-10 mt-2 mx-0">
    <div class="grid-item">
       <div class="card" style=" overflow-y: scroll;max-height:350px;">
        <table class="table text-right">
        <thead>
          <tr class="header ">
            <th></th>
          <th>اسم الصنف</th>
          <th>العيار</th>
          <th>النوع</th>
          <th >الكمية</th>
        </tr>
        </thead>
          <tbody id="myTable">
          <?php 
          foreach($show_item as $row){
            //var_dump($row);
          
          ?>
          <tr>
            <td><input type='radio' class='varie' id='check' value="<?php echo $row['varieties_id']?>"></td>
            <td><?php echo  $row['varieties_name']; ?></td>
            <td><?php echo  $row['caliber']; ?></td>
            <td><?php echo  ($row['type_varie'] == 1)?"جديد":"كسر";; ?></td>
            <td><?php echo  $row['Quantity']; ?></td>
            
          </tr>

         <?php }?>
          </tbody>
        </table>
      </div>
      </div>  
    </div>
  </div>
</div>

    <script type="text/javascript">
      function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
      <?php  
      if(!empty($success)){
        echo "alertify.success('".$success."');";
      }elseif(!empty($error)){
        echo "alertify.error('".$error."')";
      }
      ?>

   
    </script>