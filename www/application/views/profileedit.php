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

<li><a href="<?php echo base_url('Welcome'); ?>">Dashboard</a></li>

<li><a href="<?php echo base_url();?>Welcome/editprofile" class="active">Profile</a></li>



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
<div class="edit-button-groups panel panel-default">
<?php $this->load->view('edit-details-buttons');?>
</div>
</div>
<div class="col-md-6 col-sm-8">
<form class="form-horizontal" id="edit_personal_details" method="post" action="<?php echo base_url();?>Welcome/editprofile" data-toggle="validator" role="form">

<div class="panel panel-default" style="border: 1px solid #ddd;">
<div class="panel-body">
<h3><span class="fa fa-pencil"></span> Edit Personal Details</h3>
</div>
<div class="panel-body form-group-separated">
<div class="form-group">
<label class="col-md-4 col-xs-5 control-label">Username</label>
<div class="col-md-8 col-xs-7">
<input type="text" class="form-control" name= "name" id="user_name" value="<?php echo $PROFILE['admin_uname'];?>" data-error="Please Enter Valid Name">
<!-- <div class="help-block with-errors"></div> -->
<?php echo form_error('name', '<div class="error">', '</div>'); ?>
</div>
</div>
<div class="form-group">
<label class="col-md-4 col-xs-5 control-label">Admin Email</label>
<div class="col-md-8 col-xs-7">
<input type="text" name="email" id="email" class="form-control" value="<?php echo $PROFILE['admin_email'];?>" data-error="Please Enter Valid Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  >
<?php echo form_error('email', '<div class="error">', '</div>'); ?>
<!-- <div class="help-block with-errors"></div> -->
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


</form>
</div>
</div>
</section>
</div>
</div>
</div>
</div>




