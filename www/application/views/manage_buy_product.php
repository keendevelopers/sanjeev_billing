<?php

 // $vehicle_models = $this->db->where('is_deleted',0)->get('vehicle_info')->result_array();

 ?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="content-page">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<!-- Start content -->
<style type="text/css">
.dataTables_paginate.paging_simple_numbers ,.dataTables_filter{
float: right;
}
.flatpickr-calendar {
    z-index: 1120 !important;

}
.filter-div{
    padding: 15px 0 0px;
    border:1px solid #f4f8fb;
    margin: 10px 0 10px;
    display: none;
}
.form-group {
margin-bottom: 15px;
clear: both !important;
overflow: auto !important;
}
</style>
<div class="content">
<div class="container">
<!-- Page-Title -->
<div class="row">
<?php
/*if(isset($_REQUEST['del_id']))
{
$id = base64_decode($_REQUEST['del_id']);
$sql = mysqli_query($connection,"SELECT * FROM events WHERE id='".$id."'");
if(mysqli_num_rows($sql)>0)
{
$sql2 = mysqli_query($connection,"DELETE FROM events WHERE id='".$id."'");
echo '<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Event Deleted Successfully
</div>';
}
}*/
?>
</div>
<div class="row">
<div class="col-sm-12">
<h4 class="page-title">Stock Products</h4>
<ol class="breadcrumb">
<li>
<a href="<?php echo base_url();?>Admin/Welcome">Dashboard</a>
</li>
<li>
<a href="<?php echo base_url();?>product/manage_stock">Manage Stock Products</a>
</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div id="tbl">
<div class="card-box table-responsive">
 <a href="<?php echo base_url();?>product/add_products" title="Add Stock" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Add Stock Products</a> 
<a class="btn btn-icon waves-effect btn-primary waves-light" onclick="$('#show_filters').slideToggle();" style="margin-bottom: 20px;"><i class="fa fa-chevron-down" aria-hidden="true"></i> Show Filters </a>
<div class="pull-right">
<label>Quantity Type: </label>
<input type="checkbox" checked data-toggle="toggle" data-on="All" data-off="Least" data-onstyle="success" data-offstyle="danger" title="Select Quantity" id="quantity_type">
</div>
<div id="show_filters" class="filter-div">

<form id="invoice_filter">

<div class="form-group">
<label for="inputEmail3" class="col-sm-3 control-label">Bill No*</label>
<div class="col-sm-7">
<input type="text" class="form-control" name="BillNo" id="BillNo" placeholder="Bill No" />
<!--  <select class="" name="tax_name[]" id="tax_name" multiple="multiple">
        <option value="0">Select Tax</option>
        <option value="CGST-14">CGST 14%</option>
        <option value="SGST-14">State GST (SGST 14%)</option>
        <option value="IGST-14">Integrated GST (IGST 14%)</option>
        <option value="IGST-28">Integrated GST (IGST 28%)</option>
</select> -->
</div>
</div>

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
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit" id="btn_submit" class="btn btn-info waves-effect waves-light submitprocess"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

<button type="button" onclick="clearfilter()" class="btn btn-danger waves-effect waves-light submitprocess"><i class="fa fa-scissors" aria-hidden="true"></i> Clear Filters</button>

</div>
</div>
</form>
<div class="clear-fix"></div>
</div>

<!-- <a type="button" onclick="show_coming_finance()" title="Add University" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;">Coming Installments</a>

<a type="button" onclick="pending_coming_finance()" title="Add University" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;">Pending Installments</a> -->


<table id="datatable" class="table table-striped display table-bordered">
<thead>
<tr>
<th>Sr No</th>
<th>Bill No</th>
<th>Billing By</th>  
<th>Sub Total</th>
<th>Tax</th>
<th>Total</th>
<th>Purchased Date</th>
 <th>Action</th> 
</tr>

</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<div id="tb2" style="display:none">
 <!--  <?php //include('view_coming_finance.php'); ?>   -->
</div>
<div id="tb3" style="display:none">
<!--   <?php// include('view_pending_finance.php'); ?>   -->
</div>
</div>
</div>
</div>
<!-- END wrapper -->

</div>
</div>
</div>


<script type="text/javascript">

var table;

$(document).ready(function() {
    $('#tax_name').select2({ width: '100%' });
 jQuery('#date-range').datepicker({
                    toggleActive: true,
                     format: 'yyyy-mm-dd'
                });

    $('#year_sel, #theSelect').select2({ width: '100%' });
    //datatables
    table = $('#datatable').DataTable({ 
       
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        "ajax": {
            "url": "<?php echo site_url('product/product_list_ajax')?>",
            "type": "POST",
            "data": function(d){d.start_date=$('input[name="start_date"]').val(),d.end_date=$('input[name="end_date"]').val(),d.bill_no = $('#BillNo').val(),d.quantity_type=$('#quantity_type:checked').val()},
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });

});
var table2 = "";
function show_coming_finance(){
$("#tbl").hide(1000);
$("#tb3").hide(1000);
$("#tb2").show(1000);
table2 = $('#example').DataTable({
"processing": true, //Feature control the processing indicator.
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.
// Load data for the table's content from an Ajax source
"ajax": {
"url": "<?php echo base_url().'Admin/Finance/coming_finance_list';?>/",
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
}

var table3 = "";
function pending_coming_finance(){
$("#tbl").hide(1000);
$("#tb2").hide(1000);
$("#tb3").show(1000);
table3 = $('#example2').DataTable({
   
"processing": true, //Feature control the processing indicator.
"serverSide": true, //Feature control DataTables' server-side processing mode.

"order": [], //Initial no order.
// Load data for the table's content from an Ajax source
"ajax": {
"url": "<?php echo base_url().'Admin/Finance/pending_finance_list';?>/",
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
}

 function del_stock_product(selector,id){
  var r = confirm("Are you sure to deleted this bill products?");
    if (r == true) {
         $.post('<?php echo base_url().'product/del_stock_product';?>',{id:id},function(data){
 $.toaster({ priority : data.result, title : data.title, message : data.message});
 if(data.result == 'success'){
    $('#datatable').DataTable().ajax.reload();
 }
})
    } else {
       
    }
  }

for(i = 2015;i<=2025;i++){
$('#year_sel').append('<option value="'+i+'">'+i+'</option>');
}


</script>

 <script type="text/javascript" >
var base_url = '<?php echo base_url(); ?>';

function clearfilter(){
$('#invoice_filter')[0].reset();
$('#tax_name').val(null).trigger("change"); 
$('#year_sel').val(null).trigger("change"); 
$('#btn_submit').click();
}

$('#invoice_filter').submit(function(e){
e.preventDefault();
$('#datatable').DataTable().ajax.reload();
})


$('#vehicletype').change(function(){
   $('#datatable').DataTable().ajax.reload(); 
})
$('#quantity_type').change(function(){
    $('#datatable').DataTable().ajax.reload();
})
</script>
<script>

    </script>