
<div class="content-page">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<!-- Start content -->
<style type="text/css">
.dataTables_paginate.paging_simple_numbers ,.dataTables_filter
{
float: right;
}
</style>
<style type="text/css">
.dataTables_paginate.paging_simple_numbers ,.dataTables_filter
{
float: right;
}

.form-group {
margin-bottom: 15px;
clear: both !important;
overflow: auto !important;
}
.rating-sm {
font-size: 1.5em !important;
margin-top: 15px !important;    
}
.kd-margin-bottom{
	margin-bottom: 5px;
}
.clear-rating ,.rating-container .caption{
	display: none !important;
}
.padd-tp
{
 padding-top: 16px !important;
}
.filter-div{
	padding: 15px 0 0px;
	border:1px solid #f4f8fb;
	margin: 10px 0 10px;
	display: none;
}
</style>

<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<div class="content">
<div class="container">
<!-- Page-Title -->
<div class="row">
<div class="col-sm-12">
<h4 class="page-title">Manage Invoices</h4>
<ol class="breadcrumb">
<li>
<a href="<?php echo base_url();?>Welcome">Dashboard</a>
</li>
<li>
<a href="<?php echo base_url();?>invoice/manageinvoice">Manage Invoices</a>
</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card-box table-responsive">
<a href="<?php echo base_url();?>invoice/recordadd" title="Add Record" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;"><i class="fa fa-file-text-o" aria-hidden="true"></i> Create Invoice</a>

<a class="btn btn-icon waves-effect btn-primary waves-light" onclick="$('#show_filters').slideToggle();" style="margin-bottom: 20px;">Show Filters <i class="fa fa-chevron-down" aria-hidden="true"></i></a>

<div id="show_filters" class="filter-div">

<form id="invoice_filter">

<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">Invoice No*</label>
<div class="col-sm-7">
<input type="text" name="inv_id" class="form-control" id="inputEmail3" placeholder="Invoice No" value="" >
</div>
</div>

<!-- <div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">Tax Type*</label>
<div class="col-sm-7">
 <select class="" name="tax_name[]" id="tax_name" multiple="multiple">
        <option value="0">Select Tax</option>
        <option value="CGST-14">CGST 14%</option>
        <option value="SGST-14">State GST (SGST 14%)</option>
        <option value="IGST-14">Integrated GST (IGST 14%)</option>
        <option value="IGST-28">Integrated GST (IGST 28%)</option>
</select>
</div>
</div> -->

<div class="form-group">
	<label class="control-label col-sm-3">Date Range*</label>
	<div class="col-sm-7">
		<div class="input-daterange input-group" id="date-range">
			<input type="text" class="form-control" name="start_date" placeholder="From" />
			<span class="input-group-addon bg-custom b-0 text-white">to</span>
			<input type="text" class="form-control" name="end_date" placeholder="To" />
		</div>
	</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">With Invoice Total*</label>
<div class="col-sm-2">
<input type="checkbox" name="withtotal" class="form-control" >
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit" id="btn_submit" class="btn btn-info waves-effect waves-light submitprocess"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

<button type="button" onclick="clearfilter()" class="btn btn-danger waves-effect waves-light submitprocess"><i class="fa fa-scissors" aria-hidden="true"></i> Clear Filters</button>

</div>
</div>
</form>

</div>

<table id="table" class="table table-bordered table-striped" style="margin-top: 20px;">
						<thead>
							<tr> 
							<th>Sr No.</th>	
								<th>Date</th>
								<th>Invoice No</th>
								<th>Customer</th>
								<th>Billing</th>
								<th style="width:20%">Action</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
						</table>
						<div>
<?php //if(!$bills_total == ''){ ?>
<div id="billtotal" style="display: none">
<h4>Total Of all Searched Bills: <b>Rs. </b><span id="total_bill_amount"></span>/-</h4>
</div>

</div>

</div>
</div>
</div>


</div>
<!-- END wrapper -->
</div>
</div>
</div>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>


<script>
	$(document).ready(function() {
    jQuery('#date-range').datepicker({
                    toggleActive: true,
                     format: 'yyyy-mm-dd'
                });

    $('#tax_name, #theSelect').select2({ width: '100%' });
    
var table;
table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatable_lists/invoice_list')?>",
            "type": "POST",
            "data": function(d){d.inv_id=$('input[name="inv_id"]').val(),d.start_date=$('input[name="start_date"]').val(),d.end_date=$('input[name="end_date"]').val(),d.withtotal = $('input[name="withtotal"]').prop('checked'),d.v_id = $('#theSelect').val()}, //,d.tax_name=$('#tax_name').val()
         /*   "dataSrc" : function (json) {
          $('#total_bill_amount').text(data.bills_total);
        }*/
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
      
    });
} );

function cancle_status(id){
var r = confirm("Are you sure to cancel this Invoice?");
if (r == true) {
	var l = Ladda.create( document.querySelector( '#cancel_inv_'+id ) );
                l.start();
    $.post('<?php echo base_url(); ?>invoice/cancle_invoice',{inv_id:id},function(data){
    	l.stop();
    	$('#table').DataTable().ajax.reload();
		/*$('#cancel_inv_'+id+'').addClass('btn-info').text('Canceled').prop('disabled',true);*/
	},'json')
}else{
	return false;
}
	
}

function clearfilter(){
$('#invoice_filter')[0].reset();
$('#tax_name').val(null).trigger("change"); 
$('#theSelect').val(null).trigger("change"); 
$('#btn_submit').click();
}

$('#invoice_filter').submit(function(e){
e.preventDefault();
if($('input[name="withtotal"]').prop('checked') == true){
	$.post('<?php echo base_url('Datatable_lists/get_total_bills_amount'); ?>',$(this).serialize(),function(d){
		$('#billtotal').show();
		$('#total_bill_amount').text(d);
	},'json');
}else{
	$('#billtotal').hide();
}
$('#table').DataTable().ajax.reload();
})
</script>

