<!-- Start right Content here -->
<!-- ============================================================== -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	/*.kd_select{
	    width: 100%;
    margin-left: 75%;
}*/
</style>
<div class="content-page">
<!-- Start content -->
<div class="content content-op">
<!-- <a href="" id="redirect_print" target="_blank" style="display:none;"></a> -->
<div class="">
<!-- Page-Title -->
<div class="row">

<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 25px;
    margin-top: 25px;">
<h4 class="page-title">Manage Invoice</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>welcome">Dashboard</a></li>
<li><a href="<?php echo base_url();?>invoice/manageinvoice" class="active">Manage Invoice</a></li>
<li><a href="<?php echo base_url();?>invoice/recordadd/ " class="active">Create Invoice</a></li>
</ol>
</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="card-box col-md-12 col-sm-12 col-xs-12">
<h4 class="m-t-0 header-title"><b>Create Invoice</b></h4>
<p class="text-muted font-13 m-b-30">
Enter Invoice Details
</p>

<?php include('vehicle_invoice_gst.php'); ?>


</div>


</div>

</div>
<div class="clearfix"></div>
</div>

<script type="text/javascript">
/*$('#sell_vehicle_form').submit(function(e){

	e.preventDefault();
			var url="";
           var val = $("button[type='submit'][clicked=true]").attr('data-title');

	var serialize = $('#sell_vehicle_form').serialize();
	$.post('<?php //echo base_url(); ?>Vehicle/sell_vehicle_ajex',serialize,function(data){
		if(data.result == 'success'){
			$('#sell_vehicle_form')[0].reset();
			alertify.success("Invoice Successfully Generated");
			if(val == 'save_print'){
				
				window.open('<?php// echo base_url(); ?>Welcome/print_invoice/'+data.inv_id+'','_blank');
			}
	}else if(data.result == 'validation'){
		$.each(data.message, function(i,val){
			alertify.error('<i class="fa fa-exclamation-circle" style="font-size:20px">  </i>'+val);
		})
		
	}else{
		alertify.error("Unable to Generate Invoice");
	}
	})
})
*/

setInterval(function get_invoice_no(){
$.post('<?php echo base_url(); ?>Welcome/get_inv_no',function(data){
		$('#inv_no').text(data);
		$('#invoice_no').val(data);
	})
},3000);


</script>

