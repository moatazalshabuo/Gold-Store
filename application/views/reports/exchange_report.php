<style type="text/css">
  #error p {
    font-size: 12px;
  }
</style>

<div class="px-3">
  <form id="form" action="" method="post">
    <div class="row my-2">


      <div class="col-md-10 text-right">
        <div class="grid-item p-3">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>نوع الايصال </label>
                <select name="type_ex" id="type_ex" class="sele form-control">
                  <option value="">اختر نوع الايصال</option>
                  <option value="1">صرف عميل</option>
                  <option value="2">مصروفات</option>
                  <option value="3">رواتب</option>
                  <option value="4">اجارات</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="">
                <label for="number">التاريخ</label>
                من :
                <input type="datetime-local" class="form-control" name="form">
              </div>
            </div>
            <div class="col-md-3">
              الى :
              <input type="datetime-local" class="form-control" name="to">
            </div>
            <div class="col-md-1 mt-3">
              <div class="">
                <input type="submit" class="btn btn-min" id="send" value="بحث">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="grid-b" id="error">

        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-md-2">
      <div class="grid-item">
        <button type="button" class="my-btn-red mb-2 delete-exchange"><i class="fa-solid fa-delete-left mr-2"></i>الغاء ايصال</button><br>
        <!-- <button type="button" class="my-btn mb-2 save_bill" <?php // echo ($empty || $databill['status'] == 0 )?"disabled":''; 
                                                                  ?>><i class="fa-regular fa-floppy-disk mr-2"></i>حفظالفاتورة </button><br> -->
        <button type="button" class="my-btn mb-2" id="open"><i class="fa-regular fa-file mr-2"></i>ايصال جديده</button><br>
        <button type="button" class="my-btn mb-2 print" id="<?php // echo $databill['sales_id']; 
                                                            ?>" <?php //echo ($empty)?"disabled":''; 
                                                                ?>><i class="fa-solid fa-print mr-2"></i>طباعة ايصال</button><br>
        <!-- <button type="button" class="my-btn mb-2 edit_bill" <?php // echo ($empty)?"disabled":''; 
                                                                  ?>><i class="fa-solid fa-pen-to-square mr-2"></i>تعديل فاتورة</button><br> -->
        <!-- <button class="my-btn-red mb-2" <?php //echo ($empty)?"disabled":''; 
                                              ?>><i class="fa-solid fa-trash mr-2"></i>حذف فاتورة</button><br> -->
      </div>
    </div>
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="grid-item">
                <div class="card" style="height:390px;overflow-y: scroll;">
                  <table class="table table-hover text-right bill">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">البيان </th>
                        <th>العميل </th>
                        <th scope="col">القيمة </th>
                        <th scope="col">المستخدم</th>
                        <th scope="col">تاريخ الاضافة</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($data)) {
                        foreach ($data as $val) {
                      ?>
                          <tr>
                            <td><input type="radio" name="chek" id="chek" data-type="<?php echo $val['type']; ?>" value="<?php echo $val['used_id']; ?>"></td>
                            <td><?php echo $val['descripe']; ?></td>
                            <td><?php echo $val['name']; ?></td>
                            <td><?php echo $val['totel_value']; ?></td>
                            <td><?php echo $val['username']; ?></td>
                            <td><?php echo $val['cr_at']; ?></td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                </div>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>