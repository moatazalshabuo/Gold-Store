<div class="container ">
    <!-- end header section -->
    <div class="row m-1">
        <div class="grid-item col-md-12">
            <form method="post" action="">
                <div class="row text-right">
                    <div class="form-group col-md-6">
                        <label for="">:بيان الصنف</label>
                        <select class="form-control" name="vari_id" id="varieties" required>
                            <option value="">اختر الصنف</option>
                            <?php
                            foreach ($varieties as $val) {
                                echo "<option value=$val[varieties_id]>$val[varieties_name]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="number">:الكمية</label>
                        <input type="number" min="0" step="any" required class="form-control" name="Quantity">
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn btn-primary mt-4" value="حفظ">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="grid-item mx-0 mt-2  col-md-2 ">
            <button class="my-btn-red mb-2 dele" type="button"><i class="fa-solid fa-delete-left mr-2"></i>الغاء صنف</button><br>
            <button class="my-btn mb-2 " type="button"><i class="fa-solid fa-pen-to-square mr-2"></i>تعديل</button><br>
        </div>
        <div class="col-md-10 mt-2 mx-0">
            <div class="grid-item">
                <div class="card" style="overflow-y: scroll;max-height:350px;">
                    <table class="table text-right">
                        <thead>
                            <tr class="header ">
                                <th></th>
                                <th>اسم الصنف</th>
                                <th>الكمية</th>
                                <th>تاريخ العملية</th>
                                <th>المستخدم</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            foreach ($insert_value as $row) {
                                //var_dump($row);

                            ?>
                                <tr>
                                    <td><input type='checkbox' class='varie' id='check' value="<?php echo $row['id']?>"></td>
                                    <td><?php echo  $row['varieties_name'];
                                        ?></td>
                                    <td><?php echo  $row['Quantity'];
                                        ?></td>
                                    <td><?php echo  $row['cr_at'];
                                        ?></td>
                                    <td><?php echo  $row["user"];
                                        ?></td>

                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php
    if (!empty($success)) {
        echo "alertify.success('" . $success . "');";
    } elseif (!empty($error)) {
        echo "alertify.error('" . $error . "')";
    }
    ?>
</script>