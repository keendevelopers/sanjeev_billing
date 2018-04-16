<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- <script src="<?php// echo base_url();?>assets/Admin/js/jquery.min.js"></script> -->
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
                    <h4 class="page-title">Manage HSN Codes</h4>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>Welcome">Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>Welcome/managehsn">Manage HSN Codes</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="tbl">
                        <div class="card-box table-responsive">
                            <a data-toggle="modal" id="add_offer_btn" data-target="#offer_model" title="Add HSN Information" class="btn btn-icon waves-effect btn-default waves-light" style="margin-bottom: 20px;"><i class="fa fa-plus"></i> Add HSN Code</a>
                            <table id="datatable1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th >Sr.</th>
                                        <th style="width:20%">HSN Code</th>
                                        <th style="width:20%">GST%</th>
                                        <th style="width:20%">CGST%</th>
                                        <th style="width:20%">SGST%</th>
                                        <th style="width:10%">IGST%</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($offers as $key => $value) { ?>
                                	<tr>
                                        <td ><?php echo $key+1; ?></td>
                                        <td style="width:20%"><?php echo $value['HSN_No']; ?></td>
                                        <td style="width:20%"> <?php echo $value['GST_Per']+0; ?>%</td>
                                        <td style="width:20%"><?php echo ($value['GST_Per']+0)/2; ?>%</td>
                                        <td style="width:10%"><?php echo ($value['GST_Per']+0)/2; ?>%</td>
                                        <td style="width:10%"><?php echo ($value['GST_Per']+0)/2; ?>%</td>
                                        <td>
                                        <button class="btn btn-primary btn-mini" onclick="edit_offer(this,<?php echo $value['HSN_Id']; ?>)"><i class="fa fa-pencil"></i> Edit</button>

                                         <button class="btn <?php echo $value['IsDeleted'] == 0? 'btn-danger':'btn-success'; ?> btn-mini" onclick="offer_status(this,<?php echo $value['HSN_Id']; ?>)"> <?php echo $value['IsDeleted'] == 0? 'De-Active':'Active'; ?></button>
                                        
                                        </td>
                                    </tr>
                               <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
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

<!-- Modal -->
<div id="offer_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add/Edit HSN Code</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal"  id="offer_add_form">
<input type="hidden" name="HSN_Id" id="HSN_Id" value="">
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">HSN Code*</label>
<div class="col-sm-7">
<input type="text" name="HSN_No" id="HSN_No" class="form-control required" placeholder="HSN Code">
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">GST(%)*</label>
<div class="col-sm-7">
<input type="number" name="GST_Per" id="GST_Per" class="form-control required" placeholder="GST Percentage" >
</div>
</div>
<!-- 
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Offer Amount*</label>
<div class="col-sm-7">
<input type="number" name="OfferAmount" id="OfferAmount" min="0" class="form-control required" placeholder="Offer Amount">
</div>
</div>
 -->
<!-- <div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Less From*</label>
<div class="col-sm-7">
<label>
<input type="radio" style="width:2em" name="LessFrom" class="form-control required" placeholder="Less From" value="MRP" > From MRP</label>

<label style="margin-left:15px">
<input type="radio" style="width:2em" name="LessFrom" class="form-control required" placeholder="Less From" value="Total Bill" > From Total Bill Amount</label>
<label id="LessFrom-error" class="error" for="LessFrom"></label>
</div>

</div>
 -->
<div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" value="Add Offer" id="offer_submit" class="btn btn-primary waves-effect waves-light">
Add HSN
</button>
</div>
</div>

</form>
      </div>
 
    </div>

  </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript">
var table;

function del_offer(selector,id){
  var r = confirm("Are you sure you want to change status for this HSN Code?");
    if (r == true) {
         $.post('<?php echo base_url().'welcome/del_hsn';?>',{id:id},function(data){
 $.toaster({ priority : data.result, title : data.title, message : data.message});
 if(data.result == 'success'){
selector.closest('tr').remove();
 }
})
 } 
}

function offer_status(selector,id){
  var r = confirm("Are you sure you want to change this HSN Code status?");
    if (r == true) {
         $.post('<?php echo base_url().'welcome/del_hsn';?>',{id:id},function(data){
 $.toaster({ priority : data.result, title : data.title, message : data.message});
 if(data.result == 'success'){
    setTimeout(function(){
location.reload();
    },1000)
 }
})
 } 
}

function edit_offer(selector,id){

$.post('<?php echo base_url().'welcome/edit_hsn';?>',{id:id},function(data){
 $.toaster({ priority : data.result, title : data.title, message : data.message});
 if(data){
    $('#offer_add_form')[0].reset();
    $('#HSN_Id').val(data.HSN_Id);
    $('#HSN_No').val(data.HSN_No);
    $('#GST_Per').val(data.GST_Per);
    /*$('#OfferAmount').val(data.OfferAmount);
    $('#offer_submit').text('Update Offer');
    $('input[value="'+data.LessFrom+'"]').prop("checked",true)*/
  /* $("input[name=LessFrom][value=" + data.LessFrom + "]").attr('checked', 'checked');*/
    $('#offer_model').modal('show');
 }
})
}

$('#add_offer_btn').click(function(){
    $('#offer_add_form')[0].reset();
    $('#offer_submit').text('Add Offer');
})

var table2 = "";
window.onload = function(){
$('#datatable1').dataTable();




$("#offer_add_form").validate({
      submitHandler: function (form) {
 /* var l = Ladda.create( document.querySelector( '.ladda-button' ) );
        l.start();*/
    var formData = new FormData($('#offer_add_form')[0]);
$.ajax({
type:'POST',
dataType:'json',
url: base_url+"welcome/managehsn", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
   /* l.stop();*/
if(data.result == 'unauth') {
    window.location.replace(base_url+"Welcome");
}else if(data.result == 'success'){
    $('#product_add_form')[0].reset();
    $.toaster({ priority : data.result, title : data.title, message : data.message});
    /*  setInterval(function(){window.location.replace(base_url+"user");},3000);*/
}
else{
    $.toaster({ priority : data.result, title : data.title, message : data.message});
}
},
error: function(){
     l.stop();
$.toaster({ priority : 'danger', title : 'Error', message : 'Not Done!'});
    return true;
}
});

}

});


}
</script>