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

  <title>Lodge</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container text-white">
         
            <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="">
            <span>
              Lodge
            </span>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              
              
              </div>
            </div>
            
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="design-box">
      <img src="<?php echo base_url(); ?>assets/images/design-2.png" alt="">
    </div>
  
    <div class="container mt-5">
      <div class="card p-2" style="margin: auto;max-width: 450px;">
        <h2 class="card-title">تسجيل الدخول</h2>

        <div class="card-body">
        <p class="text-danger"><?php if($error){
          echo $error;
        } ?></p>
          <form action="" method="post">
            <div class="form-group">
              <label>اسم المستخدم</label>
              <input type="text" class="form-control" name="username" placeholder="اسم المستخدم" />
            </div>
            <div class="form-group">
              <label>كلمة المرورر</label>
              <input type="password" class="form-control" name="password" placeholder="كلمة المرور" />
            </div>
            <div class="d-flex ">
              <button>
                دخول
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>

</html>