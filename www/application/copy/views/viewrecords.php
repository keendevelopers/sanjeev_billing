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
</style>
<style type="text/css">

.clear-rating ,.rating-container .caption{display: none !important;}
.padd-tp{    padding-top: 16px !important;}
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
<a href="<?php echo base_url();?>Welcome/managerecords">Manage Invoices</a>
</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card-box table-responsive">
<a href="<?php echo base_url();?>Welcome/recordadd" title="Add Record" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;">Create Invoice</a>
<!-- <table id="employee-grid" class="table table-striped table-bordered">
<thead>
<tr>

<th>LINE NO</th>
<th>SERIAL NO</th>    
<th>MANUFACTURER</th>
<th>MODEL</th>
<th>CALIBRE</th>
<th>SIGNED OUT</th>
<th>BUYER FROM / COMMENT</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<tr>

<td></td>
<td></td>
<td></td>

</tr>

</tbody>
</table> -->
<table id="table" class="table table-bordered table-striped" style="margin-top: 20px;">
						<thead>
							<tr> 
							<th>Sr no.</th>	
								<th>Invoice No</th>
								<th>Customer</th>
								<th>VRN no</th>
								<th>Total Amount</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
						</table>
</div>
</div>
</div>
</div>
<!-- END wrapper -->
</div>
</div>
</div>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
 --><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>


<script>
	$(document).ready(function() {
var table;
table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Datatable_lists/invoice_list')?>",
            "type": "POST"
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
	alertify.confirm("Are you sure to cancel this Invoice?", function () {

    $.post('<?php echo base_url(); ?>Welcome/cancle_invoice',{inv_id:id},function(data){
		$('#cancel_inv_'+id+'').removeClass('btn-danger');
		$('#cancel_inv_'+id+'').addClass('btn-primary').text('Canceled').prop('disabled',true);
	})
}, function() {
    // user clicked "cancel"
});
	
}

</script>

