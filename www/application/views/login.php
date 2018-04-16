<!DOCTYPE html><html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<title><?php echo FIRMNAME; ?></title>
<link rel="icon" href="<?php echo base_url();?>assets/img/logo.png" type="image/gif">
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>
<div class="wrapper-page">

<div class=" card-box">
<div class="panel-heading" style="padding:10px 20px 0;">
<h3 class="text-center"> Sign In to <strong class="text-custom"></strong> </h3><br>
<div class="noble_logo">
<div class="col-md-12 text-center">
<img style="height: 75px;width: 75px" class="img-responsive logo-mar-top-sty" src="<?php echo base_url();?>assets/img/logo.png"><h2><?php echo FIRMNAME; ?></h2>
<p><?php echo SOFTWARE_NAME; ?></p>
</div>
</div>

</div>


<div class="panel-body" style="padding: 0 15px;">
<form class="form-horizontal m-t-20" id="admin-login" action="<?php echo base_url();?>Welcome/" method="POST">

<div class="form-group ">
<div class="col-xs-12">
<input class="form-control" name="email" type="email" required="" placeholder="Email">
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<input class="form-control" name="password" type="password" required="" placeholder="Password">
</div>
</div>
<div class="form-group text-center m-t-40">
<div class="col-xs-12">
<button name="submit" class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">LogIn</button>
</div>
</div>
<?php if(isset($msgsuccess) != ''){?>
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($msgsuccess) && $msgsuccess !='' ? $msgsuccess : ''; ?></div>
<?php }?>
</form>
</div>

<!--  -->
<div class="text-center">

<p class="account-copyright">

<span style="font-weight: 800">Designed &amp; Developed By </span><span style="font-weight: 800"><a style="color: #797979 !important;" href="http://www.keendevelopers.com/">Keen developers</a></span></p></div>
<!--  -->
</div>
</div>
<script>
var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/detect.js"></script>
<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url();?>assets/js/waves.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
<script type="text/javascript">
/*$.validator.setDefaults({
submitHandler: function() {
alert("submitted!");
}
});*/
$(document).ready(function() {
$("#admin-login").validate({
rules: {
email: {
required: true,
email:true
},
password: {
required: true,
},
},
messages: {	
email: {
required: "Enter Admin Email",
email: "Enter valid Email"
},
password: {
required: "Enter Admin Password",
},
}}	
);
});
</script>	
</body>
</html>
