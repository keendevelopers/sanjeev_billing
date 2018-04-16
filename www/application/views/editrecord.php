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
<li><a href="<?php echo base_url();?>invoice/manageinvoice" class="active">Manage Records</a></li>
<li><a href="<?php echo base_url().'invoice/editrecord/'.$this->uri->segment(3);?>" class="active">Edit Records</a></li>
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
<?php 

include('vehicle_invoice_gst.php'); 

?>


</div>

</div>

</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
  $("#theSelect").val('<?php echo isset($edit['ref_v_id'])? $edit['ref_v_id']:'';?>').trigger('change');
  $("#care_type").val('<?php echo isset($edit['care_type'])? $edit['care_type']:'';?>').trigger('change');
  $("#tax").val('<?php echo isset($edit['tax_type'])? $edit['tax_type']:'';?>').trigger('change');
  $("#surcharge_per").val('<?php echo isset($edit['surcharge_per'])? $edit['surcharge_per']:'';?>').trigger('change');
})

$('#invoiceGenerator').submit(function(e){
	e.preventDefault();
	var val = $("button[type='submit'][clicked=true]").attr('data-title');
	var serialize = $('#invoiceGenerator').serialize()+'&sub_total='+ $('#subTotal').text() +'&tax='+ $('#taxAmt').text() +'&total='+ $('#total').text()+'&records='+ $('.lineItems tr').length;
	$.post('<?php echo base_url(); ?>Welcome/add_invoice',serialize,function(data){
		if(data == 'success'){
		alertify.success("Invoice Successfully Updated");
			if(val == 'save_print'){
				window.open('<?php echo base_url(); ?>Welcome/print_invoice/'+$('input[name="invoice_id"]').val()+'','_blank');
			}
	}else{
		alertify.error("Unable to Update Invoice");
	}
	})
})

$('#sell_vehicle_form').submit(function(e){
	e.preventDefault();
			var url="";
           var val = $("button[type='submit'][clicked=true]").attr('data-title');
	var serialize = $('#sell_vehicle_form').serialize();
	$.post('<?php echo base_url(); ?>Vehicle/sell_vehicle_update_ajex',serialize,function(data){
		if(data.result == 'success'){
			$('#sell_vehicle_form')[0].reset();
			alertify.success("Invoice Successfully Updated");
			setTimeout(function(){ window.location.replace("<?php echo base_url(); ?>Welcome/managerecords");}, 2000);
			
			if(val == 'save_print'){
				
				window.open('<?php echo base_url(); ?>Welcome/print_invoice/'+data.inv_id+'','_blank');
			}
	}else if(data.result == 'validation'){
		$.each(data.message, function(i,val){
			alertify.error('<i class="fa fa-exclamation-circle" style="font-size:20px">  </i>'+val);
		})
		
	}else{
		alertify.error("Unable to Update Invoice");
	}
	},'json')
})

</script>

