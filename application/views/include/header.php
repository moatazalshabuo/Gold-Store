<?php 
if($this->session->userdata('username')){
      
    }else {
      redirect("UserController/login");
    }
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>محل الذهب</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/print.css">
  <!-- responsive style -->
  <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/my_grid.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <link href="<?php echo base_url(); ?>assets/css/bootstrap-select.min -->


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fontawesome-free-6.3.0-web/css/all.min.css">
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- 
    RTL version
-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>

<!-- 
end alertfy
 -->
</head>
<style type="text/css">
  .bill th,.bill td{
    font-size: 15px;
  }
  /*.bill{
    overflow: hidden;
  }*/
  *{
    text-align: right !important;
  }
  .swal2-styled.swal2-confirm{
    background-color: #fba41c !important;
  }
  #myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
direction: rtl;
}

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 18px; /* Increase font-size */
 direction: rtl; 
}

#myTable th, #myTable td {
  text-align: right; /* Left-align text */
  padding: 12px; /* Add padding */
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}
.btn-min{
  background-color: #fb930a;
  color: #fff;
}
.bg-min{
  background-color: #fbbe42;
  color: #fff;
}
.overlay{
  position: absolute;
  top:0px;
  left: 0px;
  width: 100%;
  height: 100%;
  background-color: #eee;
  z-index: 9999;
/*  display: none;*/
}
.over-bill{
  position: absolute;
  top:0px;
  left: 0px;
  width: 100%;
  height: 100%;
  background-color: #eee;
  z-index: 9999;
/*  display: none;*/
}
.select2{
  width: 100% !important;
}
.dropdown a{
color:#000 !important;
}
</style>
<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="<?php echo base_url(); ?>Home/index">
            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="">
            <span>
              Gold
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav">
                <li class="nav-item active dropdown">
                  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="index.html">المخزون<span class="sr-only">(current)</span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">               
                    <a class="dropdown-item" href="<?php echo base_url() ?>Varieties/item">اذارة الاصناف</a>
                    <a class="dropdown-item" href="<?php echo base_url() ?>Reports/move_vari">حركة الاصناف</a>
                    <a class="dropdown-item" href="<?php echo base_url() ?>Varieties/barren">فاتورة جرد الاصناف</a>
                    <hr>
                    <a class="dropdown-item" href="<?php echo base_url() ?>CashController/CashDeposit">ايداع نقدي</a>                                      
                </li>
                <li class="nav-item active dropdown">
                  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="index.html">الفواتير<span class="sr-only">(current)</span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url() ?>SalesCon/salesbill">فاتورة مبيعات</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>PurchasesCon/purchasesbill">فاتورة مشتريات</a>
                 
                </li>
                <li class="nav-item active dropdown">
                  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="index.html">العملاء و الموظفين <span class="sr-only">(current)</span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">العملاء</a>
                    <a class="dropdown-item" href="<?php echo base_url() ?>UserController/usersManage">الموظفين</a>
                  
                </li>
                <li class="nav-item active dropdown">
                  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="index.html">الايصالات<span class="sr-only">(current)</span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" type="button" data-toggle="modal" data-target=".bd-example1-modal-lg">ايصال صرف عميل</a>
                    <a class="dropdown-item" href="#" type="button" data-toggle="modal" data-target=".bd-example2">ايصال صرف مصروفات اخرى</a>
                    <a class="dropdown-item" href="#" type="button" data-toggle="modal" data-target=".bd-example2-modal-lg">ايصال قبض</a>
                  
                </li>
                <li class="nav-item active dropdown">
                  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="index.html">الاستفسارات<span class="sr-only">(current)</span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>Reports/exchange">ايصالات الصرف</a>
                    <!-- <a class="dropdown-item" href="<?php echo base_url(); ?>Reports/exchange">فواتبر المشتريات</a> -->
                    <!-- <a class="dropdown-item" href="<?php echo base_url(); ?>Reports/exchange">فواتير المبيعات</a> -->
                   
                    <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                  </div>
                </li>
                <li class="nav-item active dropdown">
                  <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="index.html">المحاسبة<span class="sr-only">(current)</span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>Reports/Treasury_account">كشف حساب الخزينة</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>Reports/client">كشف حساب عميل</a>
                  
                </li>
                <li class="nav-item active " >
                  <a class="nav-link " style="color:#000 !important" href="<?php echo base_url(); ?>UserController/logout">تسجيل الخروج</a>
                  
                </li>
              </ul>

            </div>
            <div class="quote_btn-container">
              <a href="#">
                <img src="images/cart.png" alt="">
                <div class="cart_number">
                  
                </div>
              </a>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->