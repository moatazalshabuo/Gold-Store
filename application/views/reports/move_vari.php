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
                <label>الصنف </label>
                <select name="varieties" id="varieties" class="sele form-control">
                  <option value="">اختر الصنف</option>
                  <?php
                  foreach ($varieties as $val) {
                    $selected = ($val['varieties_id'] == $vari_id) ? "selected" : "";
                    echo "<option $selected value=" . $val['varieties_id'] . ">" . $val['varieties_name'] . "</option>";
                  }
                  ?>
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
        <button type="button" class="my-btn-red mb-2"><i class="fa-solid fa-print mx-2"></i>طباعة</button>
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
                        <th scope="col"> الصنف</th>
                        <th scope="col">نوع الحركة </th>
                        <th scope="col">الكمية </th>
                        <th>الفاتورة</th>
                        <th scope="col">تاريخ </th>
                        <th scope="col">المستخدم</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      if (!empty($data)) {
                        foreach ($data as $val) {
                      ?>
                          <tr>
                            <td><?php //echo $val['']; ?></td>
                            <td><?php if($val['type_'] == 1):echo "بيع";elseif($val['type_'] == 2):echo "شراء";elseif($val['type_'] == 3):echo "سداد عميل";endif; ?></td>
                            <td><?php echo $val['Quantity']; ?>ج</td>
                            <td><?php if($val['type_'] == 1):echo "فاتورة مبيعات رقم".$val['id_bill'];elseif($val['type_'] == 2):echo "فاتورة مشتريات رقم".$val['id_bill'];elseif($val['type_'] == 3):echo "ايصال صرف رقم".$val['id_bill'];endif; ?></td>
                            <td><?php echo $val['cr_at']; ?></td>
                            <td><?php echo $val['user']; ?></td>
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