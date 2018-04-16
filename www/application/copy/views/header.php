<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<!-- <link rel="shortcut icon" href="assets/images/favicon_1.ico"> -->
<title>Nagpal Products</title>
<!--Morris Chart CSS -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/alert/themes/alertify.default.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/alert/themes/alertify.core.css" />
<link href="<?php echo base_url();?>assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
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
<a href="<?php echo base_url();?>" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Nagpal Products</span></a>
</div>
</div>
<!-- Button mobile view to collapse sidebar menu -->

<div class="navbar navbar-default" role="navigation">

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
<?php 

$adminId =$this->session->userdata('admin_id');
$result =$this->admin_model->admin_profile();
foreach($result as $PROFILE)
?><li class="dropdown">
<a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url();?>assets/images/users/<?php echo $PROFILE['admin_pic'];?>" alt="user-img" class="img-circle"> </a>

<ul class="dropdown-menu">

<!-- <li><a href="<?php echo base_url();?>Welcome/editProfile"><i class="ti-user m-r-5"></i> Profile</a></li>
 --><li><a href="<?php echo base_url();?>Welcome/logout"><i class="ti-power-off m-r-5"></i> Logout</a></li>

</ul>

</li>


</ul>

</div>

<!--/.nav-collapse -->

</div>

</div>

</div>

<!-- Top Bar End -->
