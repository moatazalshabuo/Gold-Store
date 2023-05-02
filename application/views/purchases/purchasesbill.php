<?php
$empty = FALSE;
if (empty($databill)) {
  $empty = TRUE;
}

// echo $prev . " " . $next;
// print_r($next);
?>
<style type="text/css">
  #error p {
    font-size: 12px;
  }

  .gram {
    display: none;
  }
</style>
<?php if ($empty) :
  // $this->load->view('include/header.php');
?>
  <div class="overlay text-center">
    <div class="card" style="margin:auto;margin-top: 100px;max-width: 450px;">
      <div class="card-body">
        <p>يس لديك اي فاتورة </p>
        <p>هل تريد فتح فاتورة جديدة ل</p>
        <a href="<?php echo base_url() ?>PurchasesCon/new_bill" class="btn btn-min">فاتورة جديد </a>
      </div>
    </div>
  </div>
<?php else :
?>
  <div class="px-3">
    <form id="form">
      <div class="row my-2">
        <div class="col-md-3">
          <div class="grid-item">
            <div class="text-center p-1">
              <button type="button" class="btn btn-primary np" <?php echo ($empty || (empty($prev))) ? "disabled" : "id=$prev"; ?>><i class="fa fa-arrow-right"></i></button>

              <input style="width:60px;" type="number" id="bill_num" value="<?php echo $databill['id_bill']; ?>">

              <button type="button" class="btn btn-primary np" <?php echo ($empty || empty($next)) ? "disabled" : "id=$next"; ?>><i class="fa fa-arrow-left"></i></button>
            </div>
            <div class="text-center p-2">
              <label for="name"> :العميل</label>
              <select class="form-control p-1" id="custm1" name="custm" <?php echo ($empty || $databill['status'] == 0) ? "disabled" : ''; ?>>
                <option disabled>عملاء </option>

              </select>

              <button class="btn btn-info" type="button" data-toggle="modal" data-target="#addClint"><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>
        </div>

        <div class="col-md-7 text-right">
          <div class="grid-item p-3">
            <div class="form-group">
              <label>نوع الفاتورة </label>
              <input type="radio" <?php echo ($databill['type_price'] == 1) ? "checked" : "" ?> name="type_input" class="type_input" value="1">مصنعية :
              <input type="radio" <?php echo ($databill['type_price'] == 2) ? "checked" : "" ?> name="type_input" class="type_input" value="2">نقدي :
            </div>
            <div class="form-group">
              <label for="">:بيان الصنف</label>
              <select class="js-example-basic-single form-control p-1" <?php echo ($empty || $databill['status'] == 0) ? "disabled" : ''; ?> id="varieties" name="varieties">
                <option value="">البحث</option>
                <?php foreach ($varieties as $value) : ?>
                  <option value="<?php echo $value['varieties_id']; ?>"><?php echo $value['varieties_name']; ?></option>
                <?php endforeach; ?>
              </select>

            </div>
            <div class="row">
              <div class="col">
                <div class="">
                  <label for="number">الكمية</label>
                  <input type="number" class="form-control" value="" step="0.1" name="qwant" id="qwant" <?php echo ($empty || $databill['status'] == 0) ? "disabled" : ''; ?>>
                </div>
              </div>
              <div class="col">
                <div class="">
                  <label for="number" class="bild">سعر مصنعية الجرام</label><label class="gram">سعر الجرام</label>
                  <input type="number" class="form-control" value="" step="0.1" name="price" id="price" <?php echo ($empty || $databill['status'] == 0) ? "disabled" : ''; ?>>
                </div>
              </div>
              <div class="col">
                <div class="">
                  <label for="number" class="bild">اجمالي المصنعية</label><label class="gram">الاجمالي</label>
                  <input type="number" class="form-control" name="totel" step="0.25" id="totel" disabled>

                </div>
              </div>
              <div class="col">
                <div class="">
                  <input type="button" class="btn btn-min" id="send" value="حفظ">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="grid-b" id="error">
            <?php if ($this->session->flashdata("message")) {
              echo $this->session->flashdata("message");
              $this->session->flashdata("message", "");
            } ?>
          </div>
        </div>
      </div>
    </form>
    <div class="row">

      <div class="col-md-2">
        <div class="grid-item">
          <button type="button" class="my-btn-red mb-2 delete-p" <?php echo ($empty || $databill['status'] == 0) ? "disabled" : ''; ?> style=""><i class="fa-solid fa-delete-left mr-2"></i>الغاء صنف</button><br>
          <button type="button" class="my-btn mb-2 save_bill" <?php echo ($empty || $databill['status'] == 0) ? "disabled" : ''; ?>><i class="fa-regular fa-floppy-disk mr-2"></i>حفظالفاتورة </button><br>
          <button type="button" class="my-btn mb-2 new_bill" id="open"><i class="fa-regular fa-file mr-2"></i>فاتورة جديده</button><br>
          <button type="button" class="my-btn mb-2 print" id="<?php echo $databill['id_bill']; ?>" <?php echo ($empty) ? "disabled" : ''; ?>><i class="fa-solid fa-print mr-2"></i>طباعة فاتورة</button><br>
          <button type="button" class="my-btn mb-2 edit_bill" <?php echo ($empty) ? "disabled" : ''; ?>><i class="fa-solid fa-pen-to-square mr-2"></i>تعديل فاتورة</button><br>
          <!-- <button class="my-btn-red mb-2" <?php //echo ($empty)?"disabled":''; 
                                                ?>><i class="fa-solid fa-trash mr-2"></i>حذف فاتورة</button><br> -->
        </div>
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-3">
                <div class="grid-item">

                  <div class="">
                    <label for="number">الكمية المتوفرة</label>
                    <input type="number" class="form-control" name="qwant-has" id="qwant-has" disabled>
                  </div>
                  <div class="">
                    <label for="number">الكمية المتبقية</label>
                    <input type="number" class="form-control" name="qwant-left" id="qwant-left" disabled>
                  </div>
                  <div class="">
                    <label>اجمالي الفاتوةر</label>
                    <span class="information" id="q">جرام:<?php echo $databill['Quantity']; ?></span>
                  </div>
                  <!--حقل البحث-->
                </div>
              </div>
              <div class="col-md-9">

                <div class="grid-item">
                  <div class="card" style="height:350px;overflow-y: scroll;">
                    <table class="table table-hover text-right bill">
                      <thead>
                        <tr>
                          <th></th>
                          <th scope="col">اسم الصنف</th>

                          <th scope="col">العيار</th>
                          <th scope="col">الكمية </th>
                          <th scope="col">سعر الجرام</th>
                          <th scope="col">احمالي </th>
                          <th scope="col">تاريخ الاضافة</th>
                        </tr>
                      </thead>
                      <!-- <div class="over-bill"></div> -->

                      <tbody>

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


<?php endif; ?>