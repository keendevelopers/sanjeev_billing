<script src="<?php echo base_url();?>assets/Admin/js/jquery.min.js"></script>


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

<li><a href="index.php">Dashboard</a></li>

<li><a href="<?php echo base_url();?>Welcome/edit_profile" class="active">Profile</a></li>



</ol>

</div>

</div>



<div class="row">

<div class="col-lg-12">
<div class="card-box">

<?php $msgsuccess   =$this->session->flashdata('message'); 
    $errormessage =$this->session->flashdata('message_error');
  
?>
<section class="content edit-user-profile">
<div class="row">
<div class="col-md-3 col-sm-4">
<div class="edit-button-groups panel panel-default">
<?php $this->load->view('edit-details-buttons');?>
</div>
</div>
<div class="col-md-6 col-sm-8">
<form class="form-horizontal" id="edit_personal_details" method="post" action="<?php echo base_url();?>Welcome/changePassword" data-toggle="validator" role="form">

<div class="panel panel-default" style="border: 1px solid #ddd;" >
<div class="panel-body">
<h3><span class="fa fa-pencil"></span> Change Password</h3>
</div>
<div class="panel-body form-group-separated">
<div class="form-group">
<label class="col-md-4 col-xs-5 control-label">Old Password *</label>
<div class="col-md-8 col-xs-7">
<input type="password" class="form-control" <?php echo set_value('old_password'); ?> name= "old_password" id="old_password" value="" data-error="Please Enter Old Password">
<?php echo form_error('old_password', '<div class="error">', '</div>'); ?></div>
</div>
<div class="form-group">
<label class="col-md-4 col-xs-5 control-label">New Password</label>
<div class="col-md-8 col-xs-7">
<input type="password" name="new_password" id="new_password" class="form-control" value="" data-error="Please Enter New Password"<?php echo set_value('new_password'); ?>>
<?php echo form_error('new_password', '<div class="error">', '</div>'); ?></div>

</div>


<div class="form-group">
<label class="col-md-4 col-xs-5 control-label">Confirm Password</label>
<div class="col-md-8 col-xs-7">
 <input type="password" class="form-control" id="confirm_new_pssword" name="confirm_new_pssword" <?php echo set_value('confirm_new_pssword'); ?>><?php echo form_error('confirm_new_pssword', '<div class="error">', '</div>'); ?>

</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit" id="submit" class="btn btn-primary waves-effect waves-light submitprocess">Update</button>
<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
Cancel
</button>
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
</div>
</div>

</form>
</div>
</div>
</section>
</div>
</div>
</div>
</div>



<script type="text/javascript" src="<?php echo base_url();?>assets/Admin/plugins/parsleyjs/dist/parsley.min.js"></script>





