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
<h4 class="page-title">Manage Records</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>Welcome">Dashboard</a></li>
<li><a href="<?php echo base_url();?>Welcome/managerecords" class="active">Manage Records</a></li>
<li><a href="<?php echo base_url();?>Welcome/editrecord/ " class="active">Edit Records</a></li>
</ol>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="card-box">
<h4 class="m-t-0 header-title"><b>Edit Record</b></h4>
<p class="text-muted font-13 m-b-30">
Enter Record Details
</p>
<?php include('Invoice.php'); ?>


</div>

</div>

</div>

</div>

<script type="text/javascript">
$('#invoiceGenerator').submit(function(e){
	e.preventDefault();
	var serialize = $('#invoiceGenerator').serialize()+'&sub_total='+ $('#subTotal').text() +'&tax='+ $('#taxAmt').text() +'&total='+ $('#total').text()+'&records='+ $('.lineItems tr').length;
	$.post('<?php echo base_url(); ?>Welcome/add_invoice',serialize,function(data){
		if(data == 'success'){
		alertify.success("Invoice Successfully Generated");
		
	}else{
		alertify.error("Unable to Generate Invoice");
	}
	})
})

setInterval(function get_invoice_no(){
$.post('<?php echo base_url(); ?>Welcome/get_inv_no',function(data){
		$('#invNumber').val(data);
	})
},3000);


</script>

