<!DOCTYPE html><html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<title>Nagpal Products</title>
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
<div class="panel-heading">
<h3 class="text-center"> Sign In to <strong class="text-custom"></strong> </h3>
<!-- <div class="noble_logo">
<img class="img-responsive logo-mar-top-sty" src="<?php echo base_url();?>assets/images/Logo20.png">
</div>
 -->
</div>


<div class="panel-body">
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
<a href="http://vismaadlabs.com/" target="_blank">
<img src="<?php echo base_url();?>assets/images/vismaadlogo.png">
</a>
<p class="account-copyright">

<span style="font-weight: 800">Designed &amp; Developed By </span><span style="font-weight: 800">VismaadLabs</span></p></div>
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
