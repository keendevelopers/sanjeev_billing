<!-- Start right Content here -->
<!-- ============================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  

<!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->

<style type="text/css">

.datepicker table tr td span {
    display: block;
    width: 23%;
    height: 54px;
    line-height: 54px;
    float: left;
    margin: 1%;
    cursor: pointer;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}

.toggle{
        width: 155px;
}

.bigdrop{
  width: 100%;
}

</style>

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
<form action="<?php echo base_url();?>Welcome/managerecords" class="form-horizontal" id="search_form" method="POST">

<!-- <input type="checkbox" checked data-toggle="toggle" data-on="Automate Invoice" data-off="Manual Invoice" data-onstyle="success" data-offstyle="danger" id="inv_type"> -->

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Invoice No*</label>
<div class="col-sm-7">
<input type="text" name="inv_no" class="form-control" id="inputEmail3" placeholder="Invoice No" value="" >
</div>
</div>


<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Name*</label>
<div class="col-sm-7">
<input type="text" name="cust_name" class="form-control" id="inputEmail3" placeholder="Customer Name" value="" >
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Tax Type*</label>
<div class="col-sm-7">
 <select class="" name="tax_name[]" id="tax_name" multiple="multiple">
        <option value="0">Select Tax</option>
        <option value="vat-10.5">VAT 10.5%</option>
</select>

</div>
</div>

<div class="form-group">
	<label class="control-label col-sm-4">Date Range</label>
	<div class="col-sm-7">
		<div class="input-daterange input-group" id="date-range">
			<input type="text" class="form-control" name="start" placeholder="From" />
			<span class="input-group-addon bg-custom b-0 text-white">to</span>
			<input type="text" class="form-control" name="end" placeholder="To" />
		</div>
	</div>
</div>

<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit" id="btn_submit" class="btn btn-info waves-effect waves-light submitprocess">Search</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

 
   <!--    <script type="text/javascript" src="<?php// echo base_url();?>assets/plugins/select2/select2.js"></script>  -->
<script>
$(document).ready(function(){
      $('#tax_name').select2({ width: '100%' });
        jQuery('#date-range').datepicker({
                    toggleActive: true,
                     format: 'yyyy-mm-dd'
                });
})
     
                

/*$('#inv_type').change(function(){
    var status = document.getElementById("inv_type").checked;
      if(status == true){
        $('#search_form').attr('action','<?php //echo base_url();?>Welcome/managerecords');
      }else{
      $('#search_form').attr('action','<?php //echo base_url();?>Welcome/managerecords_manual');
      }         
})*/


 </script>