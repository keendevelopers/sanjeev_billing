

<!-- Start right Content here -->

<!-- ============================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="content-page">

<!-- Start content -->

<div class="content">

<div class="container">



<!-- Page-Title -->

<div class="row">

<div class="col-sm-12">

<h4 class="page-title">Profile</h4>

<ol class="breadcrumb">

<li><a href="<?php echo base_url();?>Welcome/">Dashboard</a></li>

<li><a href="<?php echo base_url();?>Welcome/editProfile" class="active">Profile</a></li>



</ol>

</div>

</div>



<div class="row">

<div class="col-lg-12">
<div class="card-box">
<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>
<section class="content edit-user-profile">
<div class="row">
<div class="col-md-3 col-sm-4">
<div class="edit-button-groups panel panel-default wdt-btn">
<?php $this->load->view('edit-details-buttons');?>
</div>
</div>
<div class="col-md-8 col-sm-10">
<form class="form-horizontal" id="edit_personal_details" method="post" action="<?php echo base_url();?>Welcome/changephoto" data-toggle="validator" role="form" enctype='multipart/form-data'>

<input type="hidden" name="book_hidden_image" value="<?php echo $PROFILE['admin_pic'];?>"> 
<div class="panel panel-default" style="border: 1px solid #ddd;">
<div class="panel-body">
<h3><span class="fa fa-pencil"></span> Edit Profile</h3>
</div>
<div class="panel-body form-group-separated">
<div class="form-group">
<label class="col-md-4 col-xs-5 col-sm-6 control-label">Profile Image </label>
<div class="col-md-8 col-xs-7">
<div id="image_preview1">
<div class="file-preview">
<div class="">
<div class="file-preview-thumbnails">

<div data-fileindex="0" id="preview-1443091034925-0" class="file-preview-frame" style="margin-bottom: 10px;">
<?php  if($PROFILE['admin_pic'] != ''){?>
<img style="height: 100px"  alt="preview.jpg" title="preview.jpg" class="file-preview-image" src="<?php echo base_url();?>assets/images/users/<?php echo $PROFILE['admin_pic'];?>">
<?php }else{ ?>
<img  alt="preview.jpg" title="preview.jpg" class="file-preview-image" src="<?php echo base_url();?>images/notimg.png'">
<?php } ?>
</div>
</div>
<div class="clearfix"></div><div class="file-preview-status text-center text-success"></div>
<div class="kv-fileinput-error file-error-message" style="display: none;"></div>
</div>
</div>
</div>

<input id="file-0a" class="filestyle" name="book_image" type="file" data-buttonname="btn-white" >
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light submitprocess">Update</button>
<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
Cancel
</button>
</div>
</div>
</div>
</div>

<?php if(isset($msgsuccess) != ''){?>
 <div class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 <strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($msgsuccess) && $msgsuccess !='' ? $msgsuccess : ''; ?></div>
<?php }?>
<?php if(isset($errormessage) != ''){?>
 <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 <strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($errormessage) && $errormessage !='' ? $errormessage : ''; ?></div>
<?php }?>


</form>
</div>
</div>
</section>
</div>
</div>
</div>
</div>
<script src="<?php echo base_url();?>assets/Admin/js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$("#file-0a").change(function(){
var i = $('#file-0a').val();
// alert(i);
if(i != ''){
$('#image_preview1').hide();
}else{
$('#image_preview1').show();
}
});

});
</script>



