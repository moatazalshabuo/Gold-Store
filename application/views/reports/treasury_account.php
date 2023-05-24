<style type="text/css">
    #error p {
        font-size: 12px;
    }
</style>

<div class="px-3">
    <form id="form" action="" method="post">
        <div class="row my-2">


            <div class="col-md-6 text-right">
                <div class="grid-item p-3">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="">
                                <label for="number">التاريخ</label>
                                من :
                                <input type="datetime-local" class="form-control" name="from">
                            </div>
                        </div>
                        <div class="col-md-3">
                            الى :
                            <input type="datetime-local" class="form-control" name="to">
                        </div>
                        <div class="col-md-1">
                            <label>الكل</label>
                            <input type="checkbox" name="all" value="1">
                        </div>
                        <div class="col-md-1 mt-3">
                            <div class="">
                                <input type="submit" class="btn btn-min" id="send" value="بحث">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-rigth">
                <div class="grid-item">
                    <div class="row">
                        <div class="col-md-6">
                            <p>من تاريخ</p>
                            <p><?php echo $from ?></p>
                        </div>
                        <div class="col-md-6">
                            <p>الى تاريخ</p>
                            <p><?php echo $to ?></p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>
    <h5>الخزينة</h5>
    <div class="row">

        <div class="col-md-4">

            <div class="grid-item">
                <label>الصادرات </label>
                <div class="row">
                    <div class="col-md-6">
                        <label>صرف العملاء</label>
                        <input type="text" class="form-control" disabled value="<?php if ($export['totel_export1']) : echo ($export['totel_export1']);
                                                                                else : echo 0;
                                                                                endif; ?>">
                    </div>
                    <div class="col-md-6">
                        <label>المشتريات (كسر)</label>
                        <input type="text" class="form-control" disabled value="<?php echo ($export['totel_export2']) ?>">
                    </div>
                    <div class="col-md-12">
                        <label>اجمالي الصادرات </label>
                        <input type="text" class="form-control" disabled value="<?php echo ($export['totel']) ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="grid-item">
                <label>الوادرات </label>
                <div class="row">
                    <div class="col-md-6">
                        <label> المبيعات</label>
                        <input type="text" class="form-control" disabled value="<?php if (isset($import['totel_sales'])) : echo number_format($import['totel_sales'], 2);
                                                                                endif; ?>">
                    </div>
                    <div class="col-md-6">
                        <label> الايداعات </label>
                        <input type="text" class="form-control" disabled value="<?php if (isset($import['totel_deposit'])) : echo number_format($import['totel_deposit'], 2);
                                                                                endif; ?>">
                    </div>
                    <div class="col-md-12">
                        <label>اجمالي الوادرات </label>
                        <input type="text" class="form-control" disabled value="<?php if (isset($import['totel'])) : echo number_format($import['totel'], 2);
                                                                                endif; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="grid-item">
                <label>النقدي في الخزينة</label>
                <input type="text" class="form-control" disabled value="<?php echo number_format($import['totel'] - $export["totel"], 2) ?>">
            </div>
			<div class="grid-item">
                <label>النقدي اجمالي</label>
                <input type="text" class="form-control" disabled value="<?php echo number_format($cash, 2) ?>">
            </div>
        </div>
    </div>
    <h5>الكسر</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="grid-item">
                <label>صادرات المبيعات</label>
                <div class="row">
                    <?php
                    foreach ($old_ex[0] as $val) {
                    ?>
                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <label>صادرات ايصالات الصرف</label>
                <div class="row">
                    <?php
                    foreach ($old_ex[1] as $val) {
                        // $sum = $sum + $val['Quantity'];
                    ?>
                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="grid-item">
                <label> واردات المشتريات</label>
                <div class="row">
                    <?php
                    foreach ($old_im[0] as $val) {
                        // $sum = $sum + $val['Quantity'];
                    ?>
                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <label> واردات اخرى</label>
                <div class="row">
                    <?php
                    foreach ($old_im[1] as $val) {
                        // $sum = $sum + $val['Quantity'];
                    ?>
                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <h5>الجديد</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="grid-item">
                <label>الصادرات</label>
                <div class="row">

                    <?php
                    foreach ($new_ex as $val) {
                        // $sum = $sum + $val['Quantity'];
                    ?>

                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="grid-item">
                <label>الوادرات</label>
                <div class="row">

                    <?php
                    foreach ($new_im[0] as $val) {
                        // $sum = $sum + $val['Quantity'];
                    ?>

                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <label>واردات اخرى</label>
                <div class="row">

                    <?php
                    foreach ($new_im[1] as $val) {
                        // $sum = $sum + $val['Quantity'];
                    ?>

                        <div class="col-md-3">
                            <label> عيار <?php echo $val['caliber']; ?></label>
                            <input type="text" class="form-control" disabled value="<?php if (isset($val['Quantity'])) : echo number_format($val['Quantity'], 2);
                                                                                    endif; ?>">
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
