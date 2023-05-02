<style type="text/css">
  #error p{
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
        <label for="">:العميل</label>
        <select class="js-example-basic-single form-control p-1" id="sele" name="client">
          <option value="">البحث</option>
        <?php foreach($client as $value): ?>
          <option value="<?php echo $value['client_id']; ?>"><?php echo $value['name'] . $value['phone_number']; ?></option>
        <?php endforeach; ?>
        </select>
      </div>
      </div>
        <div class="col-md-3">
             <div class="">
                <label for="number">التاريخ</label>
                من :
                <input type="datetime-local" class="form-control" name="form">
                
                <!-- <input type="number" class="form-control" value="" step="0.1" name="qwant" id="qwant" <?php //echo ($empty || $databill['status'] == 0)?"disabled":''; ?>> -->
            </div>
        </div>
        <div class="col-md-3">
        
                الى :
                <input type="datetime-local" class="form-control" name="to">
                
                <!-- <input type="number" class="form-control" value="" step="0.1" name="qwant" id="qwant" <?php //echo ($empty || $databill['status'] == 0)?"disabled":''; ?>> -->
            
        </div>
        <div class="col-md-1 mt-3">
          <div class="">
              <input type="submit" class="btn btn-min"  id="send" value="بحث">
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
              <button type="button" class="my-btn-red mb-2 delete-p" <?php // echo ($empty || $databill['status'] == 0)?"disabled":''; ?> style=""><i class="fa-solid fa-delete-left mr-2"></i>الغاء ايصال</button><br>
              <!-- <button type="button" class="my-btn mb-2 save_bill" <?php // echo ($empty || $databill['status'] == 0 )?"disabled":''; ?>><i class="fa-regular fa-floppy-disk mr-2"></i>حفظالفاتورة </button><br> -->
              <button type="button" class="my-btn mb-2" id="open"><i class="fa-regular fa-file mr-2"></i>فاتورة جديده</button><br>
              <button type="button" class="my-btn mb-2 print" id="<?php // echo $databill['sales_id']; ?>" <?php //echo ($empty)?"disabled":''; ?>><i class="fa-solid fa-print mr-2"></i>طباعة فاتورة</button><br>
              <!-- <button type="button" class="my-btn mb-2 edit_bill" <?php // echo ($empty)?"disabled":''; ?>><i class="fa-solid fa-pen-to-square mr-2"></i>تعديل فاتورة</button><br> -->
              <!-- <button class="my-btn-red mb-2" <?php //echo ($empty)?"disabled":''; ?>><i class="fa-solid fa-trash mr-2"></i>حذف فاتورة</button><br> -->
              </div>
            </div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="grid-item">
                        <div class="card" style="height:390px;overflow-y: scroll;">
                        <table class="table table-hover text-right bill"  >
                          <thead>
                            <tr>
                              
                              <th scope="col">رقم الايصال</th>
                              <th scope="col">القيمة </th>
                              <th scope="col">الكمية </th>
                              <th scope="col">المستخدم</th>
                              <th scope="col">تاريخ الاضافة</th>
                            </tr>
                          </thead>
                          <!-- <div class="over-bill"></div> -->
                          <tbody >
                            <?php 
                            if(!empty($data)){
                                foreach($data as $val){
                                    ?>
                                    <tr>
                                        <td><?php echo $val['used_id']; ?></td>
                                        <td><?php echo $val['totel_value']; ?></td>
                                        <td><?php echo $val['Quantity']; ?></td>
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
</div>
</div>

