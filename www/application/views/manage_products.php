<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- <script src="<?php// echo base_url();?>assets/Admin/js/jquery.min.js"></script> -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="content-page">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <!-- Start content -->
    <style type="text/css">
    .dataTables_paginate.paging_simple_numbers ,.dataTables_filter{
    float: right;
    }
    </style>
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Manage Products</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>Welcome">Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>product">Manage Products</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="tbl">
                        <div class="card-box table-responsive">
                            <a href="<?php echo base_url();?>product/add_product_info" title="Add Product Information" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Add Product</a>

                            <a href="<?php echo base_url();?>product/print_avail_stock" target="_blank" title="Available Stock Print" class="btn btn-icon waves-effect btn-primary waves-light" style="margin-bottom: 20px;"><i class="fa fa-print" ></i> Available Stock Print</a>
<div class="pull-right">
<label>Quantity Type: </label>
<input type="checkbox" checked data-toggle="toggle" data-on="All" data-off="Least" data-onstyle="success" data-offstyle="danger" title="Select Quantity" id="quantity_type">
</div>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th >Sr.</th>
                                        <th style="width:26%">Product Title</th>
                                        <th style="width:15%">Make Brand</th>
                                        <th style="width:12%">Product Price</th>
                                        <th >In Pack</th>
                                        <th style="width:12%">Avail Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php include('stock_adjustment.php'); ?>
                    <div id="tb2" style="display:none">
                        <?php include('view_stock_vehicles.php'); ?>
                         
                    </div>
                </div>
            </div>
        </div>
        <!-- END wrapper -->
    </div>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.bootstrap-touchspin.min.js"></script>

<script type="text/javascript">
/*$(document).ready(function() {
$('#datatable').dataTable();
} );*/
$("input[name='AdjustmentPack'],input[name='AdjustmentLoose']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
            });
</script>
<script type="text/javascript">
var table;

$(document).ready(function() {
//datatables
table = $('#datatable').DataTable({
"processing": true, //Feature control the processing indicator.
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.
// Load data for the table's content from an Ajax source
"ajax": {
"url": "<?php echo site_url('product/product_info_list')?>",
"type": "POST",
"data": function(d){d.quantity_type=$('#quantity_type:checked').val()},
},

"dom": 'Bfrtip',
"buttons": [
'copy', 'csv', 'excel', 'pdf', 'print'
],
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

function show_stock(obj){

var id = $(obj).data('id');
$("#tbl").hide(1000);
$("#tb2").show(1000);
table2 = $('#example').DataTable({
"processing": true, //Feature control the processing indicator.
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.
// Load data for the table's content from an Ajax source
"ajax": {
"url": "<?php echo site_url('Vehicle/vehicle_list_ajax')?>",
"type": "POST",
"data":{vv_id:id,is_sold:'0'},
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

function adjustment(obj,id){
    $('#ProductId').val(id)
$('#adjustment_model').modal('show');
}

function del_product(selector,id){
  var r = confirm("Are you sure you want to delete this product?");
    if (r == true) {
         $.post('<?php echo base_url().'product/del_product';?>',{id:id},function(data){
 $.toaster({ priority : data.result, title : data.title, message : data.message});
 if(data.result == 'success'){
selector.closest('tr').remove();
 }
})
    } 
}

function back_to_user(){
$("#tbl").show(1000);
$("#tb2").hide(1000);
$('#datatable').DataTable().ajax.reload();
table2.destroy();
}

$('#quantity_type').change(function(){
    $('#datatable').DataTable().ajax.reload();
})

</script>