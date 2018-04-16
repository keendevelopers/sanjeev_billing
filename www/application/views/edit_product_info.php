<?php

  $product_details = $this->db->where('P_Id',$parm)->get('product_info')->row();
  $hsn_codes = $this->db->where('UserId',$_SESSION['admin_id'])->get('hsn_codes')->result_array();
 ?>

<div class="col-xs-12 col-md-12 col-lg-12 pull-left">

                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Edit Product Info</div>

                        <div class="panel-body">

                           <form class="form-horizontal" method="POST" id="product_edit_form">

<div class="form-group">

 

</div>

<div class="form-group">

<label for="inputEmail3" class="col-sm-4 control-label">Product Title*</label>

<div class="col-sm-7">

<input type="hidden" name="P_Id" value="<?php echo $product_details->P_Id; ?>">

<input type="text" name="ProductTitle" value="<?php echo $product_details->ProductTitle; ?>" class="form-control required" placeholder="Product Title" >

</div>

</div>

<style>
.kd_select{
       width: 60%;
    margin-left: 40%;
}
</style>


<div class="form-group">

<label for="inputEmail3" class="col-sm-4 control-label">Product Brand*</label>

<div class="col-sm-7">

<input type="text" name="ProductMake" id="ProductMake" class="form-control required" placeholder="Product Brand" value="<?php echo $product_details->ProductMake; ?>" >

</div>

</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Code*</label>
<div class="col-sm-7">
<input type="text" name="ProductCode" id="ProductCode" class="form-control " placeholder="Product Code" value="<?php echo $product_details->ProductCode; ?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">HSN Code*</label>
<div class="col-sm-7">
<select class="form-control  required" name="HSNCode" data-live-search="true" > <!-- selectpicker -->
        <option value="">Select Product</option>
        <?php foreach ($hsn_codes as $key => $value) { ?>
        <?php $select = (@$product_details->HSNCode == $value['HSN_No'])? 'selected':''; ?>
           <option value="<?php echo $value['HSN_No']; ?>" data-id="<?php echo $value['GST_Per']; ?>" <?php echo $select; ?>><?php echo $value['HSN_No']; ?></option>
        <?php } ?>
        </select>
<!-- <input type="text" name="HSNCode" id="HSNCode" class="form-control required" placeholder="HSN Code" value="<?php //echo $product_details->HSNCode; ?>"> -->
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Quantity Type*</label>
<div class="col-sm-7">
    <select id="QuantityType" class="form-control required" name="QuantityType" >
    <option value="" >Select Quantity Type</option>
    <?php foreach ($this->config->item('quantity_type_array') as $key => $value) { 
      $selected = '';
      if($value == $product_details->QuantityType) $selected = 'selected';

      ?>
    <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
    <?php } ?>
    
    </select>             
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Package Type*</label>
<div class="col-sm-7">
    <select id="PackingType" class="form-control required" name="PackingType" >
     <?php foreach ($this->config->item('package_type_array') as $key => $value) { 
      $selected = '';
      if($value == $product_details->PackingType) $selected = 'selected';

      ?>
    <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
    <?php } ?>
    </select>             
</div>
</div>


<div class="form-group" id="PerPack_div">
<label for="inputEmail3" class="col-sm-4 control-label">Per Pack*</label>
<div class="col-sm-6">
<input type="number" name="PerPack" id="PerPack" class="form-control required" min="1" placeholder="Quantity Per Pack" value="<?php echo $product_details->PerPack; ?>">
</div>
<div class="col-sm-1">
<label id="Quantity_type" style="line-height: 33px;"></label>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Description*</label>
<div class="col-sm-7">
<textarea type="text" name="Description" id="Description" class="form-control" placeholder="Product Description" ><?php echo $product_details->Description; ?></textarea>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Price*</label>
<div class="col-sm-7">
<input type="text" name="Price" id="Price" class="form-control required number" placeholder="Product Price" value="<?php echo $product_details->Price; ?>">
</div>
</div>

<hr>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Least Quantity*</label>
<div class="col-sm-7">
<input type="text" name="LeastQuantity" id="LeastQuantity" class="form-control required number" placeholder="Least Quantity" value="<?php echo $product_details->LeastQuantity; ?>" >
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Rack No*</label>
<div class="col-sm-7">
<input type="text" name="RackNo" id="RackNo" class="form-control required " placeholder="Rack No" value="<?php echo $product_details->RackNo; ?>" >
</div>
</div>

<div class="form-group">

<div class="col-sm-offset-4 col-sm-8">
<button type="submit" value="Add Vehicle Info" class="btn btn-primary waves-effect waves-light ladda-button" data-style="expand-left"><span class="ladda-label">Update Details</span>
</button>

</div>

</div>



</div>

<?php if(isset($msgsuccess) != ''){?>

 <div class="alert alert-success alert-dismissable col-md-6 col-md-offset-3">

  <button type="submit" class="close" style="right:0px !important; color:#000 !important" data-dismiss="alert" aria-hidden="true">×</button>

 <strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($msgsuccess) && $msgsuccess !='' ? $msgsuccess : ''; ?></div>

 <div class="clearfix"></div>

<?php }?>

</form>

  </div>
 </div>
 </div>

<script>

 $("#QuantityType").change(function(){     
    var value = $("#QuantityType option:selected").val();
    $('#Quantity_type').text(value);
});

  var base_url = '<?php echo base_url(); ?>';

$("#product_edit_form").validate({
      submitHandler: function (form) {
  var l = Ladda.create( document.querySelector( '.ladda-button' ) );
        l.start();
    var formData = new FormData($('#product_edit_form')[0]);

$.ajax({
type:'POST',
dataType:'json',
url: base_url+"product/edit_product_info_ajax", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
  l.stop();
if(data.result == 'unauth') {

/*  window.location.replace(base_url+"Welcome");*/

}else if(data.result == 'success'){
   table.ajax.reload();
    $('#myModal').modal('hide');
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

$('#PackingType').change(function(){
  if($('#PackingType').val() == 'Custom'){
    $('#PerPack_div').hide();
    $('#PerPack').removeClass('required');
    $('#PerPack').val('');
  }else{
    $('#PerPack_div').show();
    $('#PerPack').addClass('required');
  }
})

}
});

                </script>