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
<h4 class="page-title">Search Invoice</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>Welcome">Dashboard</a></li>
<li><a href="<?php echo base_url();?>Welcome/searchrecord" class="active">Search Invoice</a></li>
<!-- <li><a href="" class="active">Search Record</a></li> -->
</ol>
</div>
</div>
<div>
<div class="row hideform">
<div class="col-lg-12">
<div class="card-box">
<h4 class="m-t-0 header-title"><b>Search Invoice</b></h4>
<p class="text-muted font-13 m-b-30">
Enter Search Details
</p>
<form action="<?php echo base_url();?>Welcome/get_results" class="form-horizontal" method="POST">
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Invoice No*</label>
<div class="col-sm-7">
<input type="text" name="lineno" class="form-control" id="inputEmail3" placeholder="Invoice No" value="" required="">
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Choose Date</label>
<div class="col-sm-7">
<input type="text" name="serailno" class="form-control" id="inputEmail3" placeholder="Choose Date" value="">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit" id="btn_submit" class="btn btn-primary waves-effect waves-light submitprocess">Search</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>