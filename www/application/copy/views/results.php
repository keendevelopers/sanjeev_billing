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
.rating-sm 
{
font-size: 1.5em !important;
margin-top: 15px !important;    
}
.widescreen #employee-grid_filter {
display: none !important;
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
<div class="card-box table-responsive">	
<table id="employee-grid" class="table table-striped table-bordered">
<thead>
<tr>
<!-- <th>#</th> -->
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
<!-- <td><?php echo $i++;?></td> -->
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>
</td>
</tr>

</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- END wrapper -->
</div>
</div>

<script>
$(document).ready(function() {
var dataTable = $('#employee-grid').DataTable( {
"processing": true,
"serverSide": true,
"ajax":{
url :"<?php echo base_url();?>Welcome/ajax_list1", // json datasource
type: "post",
data: {lineno: "<?php echo $results['line_no']; ?>",serailno: "<?php echo $results['sr_no']; ?>",manufacturer: "<?php echo $results['manufact']; ?>",model: "<?php echo $results['model']; ?>"  },  // method  , by default get
error: function(){  // error handling
$(".employee-grid-error").html("");
$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
$("#employee-grid_processing").css("display","none");

}
}
} );
} );
</script>


