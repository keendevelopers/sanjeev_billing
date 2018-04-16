<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">

<?php 

$adminId =$this->session->userdata('admin_id');
$PROFILE =$this->admin_model->admin_profile();

?>

<!-- <link rel="shortcut icon" href="assets/images/favicon_1.ico"> -->
<title><?php echo $PROFILE['FIRMNAME']; ?></title>
<!--Morris Chart CSS -->
<link rel="icon" href="<?php echo base_url();?>assets/img/logo.png" type="image/gif">

<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />


<link href="<?php echo base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/alert/themes/alertify.default.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/alert/themes/alertify.core.css" />
<link href="<?php echo base_url();?>assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/ladda/dist/ladda-themeless.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrapvalidator-master/dist/css/bootstrapValidator.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.formvalidation/0.6.1/css/formValidation.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/flatpickr.min.css">
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"> -->
<style>
.alertify-button-ok
{
background: #5fbeaa !important;
}
.alertify-button-ok:hover
{
background: #5CB811 !important;
}
.alertify-button-cancel
{
background: #f05050 !important;
}
.alertify-button-cancel:hover
{
background: #b90606 !important;
}
</style>
</head>
<body class="fixed-left">
<!-- Begin page -->
<div id="wrapper">
<!-- Top Bar Start -->
<div class="topbar">
<!-- LOGO -->
<div class="topbar-left">

<div class="text-center">
<!-- <a href="<?php //echo base_url();?>" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Indian Motors</span></a> -->
<a href="<?php echo base_url();?>" class="logo"><img src="<?php echo base_url(); ?>assets/img/logo.png" style="width:40px;"><span style="font-size: 10px;"><?php echo $PROFILE['FIRMNAME']; ?></span></a>
</div>
</div>
<!-- Button mobile view to collapse sidebar menu -->

<div class="navbar navbar-default" role="navigation" id="d_navbr">

<div class="container">

<div class="">
<div class="pull-left mob_bar">
<button class="button-menu-mobile open-left ">
<i class="ion-navicon"></i>
</button>
<span class="clearfix"></span>
</div>

<!-- <form role="search" class="navbar-left app-search pull-left hidden-xs">

<input type="text" placeholder="Search..." class="form-control">

<a href=""><i class="fa fa-search"></i></a>

</form> -->

<ul class="nav navbar-nav navbar-right pull-right">

<!-- <li class="hidden-xs">

<a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>

</li> -->

<!-- <li class="hidden-xs">

<a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>

</li> -->
<li class="dropdown">
<a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url();?>assets/images/users/<?php echo $PROFILE['admin_pic'];?>" alt="user-img" class="img-circle"> </a>

<!--<ul class="dropdown-menu">

<li><a href="<?php echo base_url();?>Welcome/logout"><i class="ti-power-off m-r-5"></i> Logout</a></li>

</ul>-->

</li>


</ul>

</div>

<!--/.nav-collapse -->

</div>

</div>

</div>

<!-- Top Bar End -->
