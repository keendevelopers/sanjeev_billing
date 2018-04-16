<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/calender/css/calendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/calender/css/custom_2.css" />             <!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
<!-- Start content -->
<div class="content">
<div class="container">

<?php 

$PROFILE =$this->admin_model->admin_profile();

?>
<!-- Page-Title -->
<div class="row">
<div class="col-sm-12">
<h4 class="page-title">Dashboard</h4>
<p class="text-muted page-title-alt">Welcome To <?php echo $PROFILE['FIRMNAME'].' ('.SOFTWARE_NAME.')'; ?></p>
</div>
</div>
<?php $this->load->model(array('admin_model')); ?>


<div class="col-lg-6 col-md-6">


<div class="row">

<div class="col-md-6 col-lg-6 top-mr-op">
<div class="widget-bg-color-icon card-box text-center card-op">
<div class="bg-icon  center-block icon-op">
<i class="fa fa-file-text-o" aria-hidden="true"></i>
</div>

<div class="text-center text-op">
<h3 class="text-white"><b class="counter"><?php echo $this->admin_model->total_invoices();?></b></h3>
<p class="text-white">Total Invoices </p>
</div>
<div class="clearfix"></div>
</div>
</div>
<!-- 
<div class="col-md-6 col-lg-6 top-mr-op">
<div class="widget-bg-color-icon card-box text-center card-pink">
<div class="bg-icon  center-block icon-pink">
<i class="fa fa-file-text-o" aria-hidden="true"></i>
</div>

<div class="text-center text-op">
<h3 class="text-white"><b class="counter"><?php //echo $this->admin_model->current_month_invoices();?></b></h3>
<p class="text-white">This Month Invoices</p>
</div>
<div class="clearfix"></div>
</div>
</div> -->


<!-- <div class="col-md-6 col-lg-6 top-mr-op">
<div class="widget-bg-color-icon card-box text-center card-or">
<div class="bg-icon  center-block icon-or">
<i class="fa fa-file-text-o" aria-hidden="true"></i>
</div>

<div class="text-center text-op">
<h3 class="text-white"><b class="counter"><?php //echo $this->admin_model->today_invoices();?></b></h3>
<p class="text-white">Today Invoices</p>
</div>
<div class="clearfix"></div>
</div>
</div> -->

<div class="col-md-6 col-lg-6 top-mr-op">
<div class="widget-bg-color-icon card-box text-center card-gr">
<div class="bg-icon  center-block icon-gr">
<i class="fa fa-file-text-o" aria-hidden="true"></i>
</div>

<div class="text-center text-op">
<h3 class="text-white"><b class="counter"><?php echo $this->admin_model->cancelled_invoices();?></b></h3>
<p class="text-white">Cancelled Invoices</p>
</div>
<div class="clearfix"></div>
</div>
</div>
<!-- <div class="col-md-6 col-lg-6 top-mr-op">
<div class="widget-bg-color-icon card-box text-center card-gr">
<div class="bg-icon  center-block icon-gr">
<i class="fa fa-file-text-o" aria-hidden="true"></i>
</div>

<div class="text-center text-op">
<h3 class="text-white"><b class="counter"><?php// echo $this->admin_model->moved_invoices();?></b></h3>
<p class="text-white">Moved Invoices</p>
</div>
<div class="clearfix"></div>
</div>
</div> -->









</div>
</div>

<div class="row">
<div class="col-md-6 col-lg-6">
<div class="widget-bg-color-icon card-box">
<div class="custom-calendar-wrap">
<div id="custom-inner" class="custom-inner">
<div class="custom-header clearfix">
<nav>
<span id="custom-prev" class="custom-prev"></span>
<span id="custom-next" class="custom-next"></span>
</nav>
<h2 id="custom-month" class="custom-month"></h2>
<h3 id="custom-year" class="custom-year"></h3>
</div>
<div id="calendar" class="fc-calendar-container"></div>
</div>
</div>
</div>
</div>
</div>
</div> <!-- container -->
</div>

</div> <!-- content -->

  <script>
  $('#home_active').addClass('active');
</script>