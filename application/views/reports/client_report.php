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
        <label>المورد</label>
          <select class="js-example-basic-single form-control p-1" id="sele" name="client">
          <option value="">البحث</option>
        <?php 
        
        foreach($client as $value): 
          $selected = ($value['client_id'] == $myclient['client_id'])?"selected":"";
          ?>

          <option value="<?php echo $value['client_id'];?>" <?php echo $selected;?>><?php echo $value['name'] . $value['phone_number']; ?></option>
        <?php endforeach; ?>
        </select>
      </div>
      </div>
        <div class="col-md-3">
             
                <label for="number">التاريخ</label>
                من :
                <input type="datetime-local" class="form-control" name="form">
            
        </div>
        <div class="col-md-3">
            <label >الى :</label>
            <input type="datetime-local" class="form-control" name="to">
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
        <?php 
        if(isset($error)){
          echo "<p>".$error."</p>";
        }
        ?>
      </div>
    </div>
  </div>
</form>
        <div class="row">
            <div class="col-md-3">
              
               <div class="grid-item">
                <label>قيمة المصنعية</label>
                <input type="text" class="form-control" disabled value="<?php echo isset($myclient['value'])?$myclient['value']:"";?>">
                <label>كمية الذهب</label>
                <input type="text" class="form-control" disabled value="<?php echo isset($myclient['Quantity'])?$myclient['Quantity']:"";?>">
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="grid-item">
                        <div class="card" style="height:390px;overflow-y: scroll;">
                        <table class="table table-hover text-right bill"  >
                          <thead>
                            <tr>
                              
                              <th scope="col">الفاتورة </th>
                              <th scope="col">الكمية  </th>
                              <th scope="col">القيمة </th>
                              <th scope="col">المستخدم</th>
                              <th scope="col">التاريخ</th>
                            </tr>
                          </thead>
                          <!-- <div class="over-bill"></div> -->
                          <tbody >
                            <?php 
                            if(!empty($data)){
                                foreach($data as $val){
                                    ?>
                                    <tr>
                                        <td><?php echo ($val['type'] == 1)?"ايصال صرف رقم ".$val['id_bill']:"فاتورة مشتريات رقم ".$val['id_bill']; ?></td>
                                        <td><?php echo $val['Quantity']; ?></td>
                                        <td><?php echo $val['value']; ?></td>
                                        <td><?php echo $val['username']; ?></td>
                                        <td><?php echo $val['date']; ?></td>
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