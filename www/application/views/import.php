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
<h4 class="page-title">Import Records</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>Welcome">Dashboard</a></li>
<li><a href="<?php echo base_url();?>Welcome/importrecord" class="active">Import Records</a></li>
<!-- <li><a href="" class="active">Search Record</a></li> -->
</ol>
</div>
</div>
<div>
</p>

<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');

?>
<div class="row hideform">
<div class="col-lg-12">
<div class="card-box">
<h4 class="m-t-0 header-title"><b>Import Record</b></h4>
<p class="text-muted font-13 m-b-30">
Enter Import Details
</p>
<form action="<?php echo base_url();?>Welcome/import" method="post" name="upload_excel" enctype="multipart/form-data" class="form-horizontal">
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Import CSV*</label>
<div class="col-sm-7">
<!-- <input type="file" name="file" id="file"> -->

<input id="file-0a" class="filestyle" id="" name="file" type="file" data-buttonname="btn-white" >

</div>
</div>
<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="import" id="btn_submit" class="btn btn-primary waves-effect waves-light submitprocess">Import</button>
</div>
</div>


<?php if(isset($msgsuccess) != ''){?>
<div class="alert alert-success alert-dismissable col-md-6 col-md-offset-3">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($msgsuccess) && $msgsuccess !='' ? $msgsuccess : ''; ?></div>
<div class="clearfix"></div>
<?php }?>

<?php if(isset($errormessage) != ''){?>
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($errormessage) && $errormessage !='' ? $errormessage : ''; ?></div>
<?php }?>
</form>
</div>
</div>
</div>
</div>
