<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
.kd_select{
	    width: 25%;
    margin-left: 75%;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="content-page">
<!-- Start content -->
<div class="content">
<div class="container">
<!-- Page-Title -->
<div class="row">

<div class="col-sm-12">
<h4 class="page-title">Add Product Info</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>welcome">Dashboard</a></li>
<li><a href="<?php echo base_url();?>product">Manage Products</a></li>
<li><a href="<?php echo base_url();?>product/add_product_info" class="active">Add Product</a></li>
</ol>
</div>
</div>
<div class="row">



<div class="col-lg-12">



<div class="card-box">

<h4 class="m-t-0 header-title"><b>Add Product Info</b></h4>

<p class="text-muted font-13 m-b-30">

Enter Product Details

</p>

<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>


<?php if(isset($msgsuccess) != ''){?>

 <div class="alert alert-success alert-dismissable col-md-6 col-md-offset-3">

  <button type="submit" class="close" style="right:0px !important; color:#000 !important" data-dismiss="alert" aria-hidden="true">×</button>

 <strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($msgsuccess) && $msgsuccess !='' ? $msgsuccess : ''; ?></div>

 <div class="clearfix"></div>

<?php }?>


<form class="form-horizontal" method="POST" id="product_add_form">

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Title*</label>
<div class="col-sm-7">
<input type="text" name="ProductTitle" id="ProductTitle" class="form-control required" placeholder="Product Title" >
</div>
</div>

<div class="form-group ">
<label for="inputEmail3" class="col-sm-4 control-label">Product Brand*</label>
<div class="col-sm-7">
<input name="ProductMake" class="form-control required" id="ProductMake" placeholder="eg. Samsung, Lg etc"  >
</div>
</div>

<!-- onkeypress='return event.charCode >= 48 && event.charCode <= 57' -->
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Code*</label>
<div class="col-sm-7">
<input type="text" name="ProductCode" id="ProductCode" class="form-control " placeholder="Product Code" >
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">HSN Code*</label>
<div class="col-sm-7">
<select class="form-control selectpicker required" name="HSNCode" data-live-search="true" >
        <option value="">Select Product</option>
        <?php foreach ($hsn_codes as $key => $value) { ?>
           <option value="<?php echo $value['HSN_No']; ?>" data-id="<?php echo $value['GST_Per']; ?>"><?php echo $value['HSN_No']; ?></option>
        <?php } ?>
        </select>

<!-- <input type="text" name="HSNCode" id="HSNCode" class="form-control required" placeholder="HSN Code" > -->
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Quantity Type*</label>
<div class="col-sm-7">
    <select id="QuantityType" class="form-control required" name="QuantityType" >
    <option value="">Select Quantity Type</option>
    <?php foreach ($this->config->item('quantity_type_array') as $key => $value) { ?>
    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
    <?php } ?>
    
    </select>             
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Package Type*</label>
<div class="col-sm-7">
    <select id="PackingType" class="form-control required" name="PackingType" >
    <?php foreach ($this->config->item('package_type_array') as $key => $value) { ?>
    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
    <?php } ?>
    </select>             
</div>
</div>

<div class="form-group" id="PerPack_div">
<label for="inputEmail3" class="col-sm-4 control-label">Per Pack*</label>
<div class="col-sm-6">
<input type="number" name="PerPack" id="PerPack" class="form-control required" value="1" min="1" placeholder="Quantity Per Pack" >
</div>
<div class="col-sm-1">
<label id="Quantity_type" style="line-height: 33px;"></label>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Description*</label>
<div class="col-sm-7">
<textarea type="text" name="Description" id="Description" class="form-control" placeholder="Product Description" ></textarea>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Product Price*</label>
<div class="col-sm-7">
<input type="text" name="Price" id="Price" class="form-control required number" placeholder="Product Price" >
</div>
</div>

<hr>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Reorder Quantity*</label>
<div class="col-sm-7">
<input type="text" name="LeastQuantity" id="LeastQuantity" class="form-control required number" placeholder="Least quantity on which system shows a reorder alert." >
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Rack No*</label>
<div class="col-sm-7">
<input type="text" name="RackNo" id="RackNo" class="form-control required" placeholder="Enter rack no to search product easily (eg. R1,R2.. etc)" >
</div>
</div>


<div class="form-group">

<div class="col-sm-offset-4 col-sm-8">

<button type="submit" value="Add Vehicle Info" class="btn btn-primary waves-effect waves-light ladda-button" data-style="expand-left"><span class="ladda-label">Add Product Info</span>

</button>

<a href="<?php echo base_url();?>Product" class="btn btn-default waves-effect waves-light m-l-5">

Back

</a>

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

</div>
<script src="<?php echo base_url();?>assets/plugins/toster/jquery.toaster.js"></script>
<script type="text/javascript" >
window.onload = function(){
var base_url = '<?php echo base_url(); ?>';
$("#product_add_form").validate({
      submitHandler: function (form) {
  var l = Ladda.create( document.querySelector( '.ladda-button' ) );
        l.start();
    var formData = new FormData($('#product_add_form')[0]);
$.ajax({
type:'POST',
dataType:'json',
url: base_url+"product/add_product_info_ajax", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
    l.stop();
if(data.result == 'unauth') {
	window.location.replace(base_url+"Welcome");
}else if(data.result == 'success'){
    $('#product_add_form')[0].reset();
    $.toaster({ priority : data.result, title : data.title, message : data.message});
    /*	setInterval(function(){window.location.replace(base_url+"user");},3000);*/
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

 $("#QuantityType").change(function(){          
    var value = $("#QuantityType option:selected").val();
    $('#Quantity_type').text(value);
});


$('#PackingType').change(function(){
  if($('#PackingType').val() == 'Custom'){
    $('#PerPack_div').hide();
    $('#PerPack').removeClass('required');
    $('#PerPack').val(0);
  }else{
    $('#PerPack_div').show();
    $('#PerPack').addClass('required');
  }
})
}
</script>
