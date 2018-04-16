<?php

  $product_details = $this->db->where('P_Id',$parm)->get('product_info')->row();
  $hsn_codes = $this->db->get('hsn_codes')->result_array();
 ?>


<div id="adjustment_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Stock Adjustments</h4>
      </div>
      <div class="modal-body">

<div class="col-xs-12 col-md-12 col-lg-12 pull-left">

                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Product Stock Adjustments</div>

                        <div class="panel-body">

                           <form class="form-horizontal" method="POST" id="product_stock_form">
<input type="hidden" name="ProductId" class="required" id="ProductId" value="">
<div class="form-group">
<label>In Packs</label>
 <div class="input-group input-group-lg">
            <input id="AdjustmentPack" type="text" value="" name="AdjustmentPack" class="required form-control input-lg">
        </div>
<label id="AdjustmentPack-error" class="error" for="AdjustmentPack" ></label>
</div>

<div class="form-group">
<label>In Loose</label>
 <div class="input-group input-group-lg">
            <input id="demo4_2" type="text" value="" name="AdjustmentLoose" class="required form-control input-lg">
</div>
<label id="AdjustmentLoose-error" class="error" for="AdjustmentLoose" ></label>
</div>


<div class="form-group">

<div class="col-sm-offset-4 col-sm-8">
<button type="submit" value="Add Vehicle Info" class="btn btn-primary waves-effect waves-light ladda-button" data-style="expand-left"><span class="ladda-label">Update Details</span>

</button>

</div>

</div>


</form>

</div>




  </div>
 </div>

 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>


window.onload = function(){
  var base_url = '<?php echo base_url(); ?>';


$("#product_stock_form").validate({
      submitHandler: function (form) {
  var l = Ladda.create( document.querySelector( '.ladda-button' ) );
        l.start();
    var formData = new FormData($('#product_stock_form')[0]);

$.ajax({
type:'POST',
dataType:'json',
url: base_url+"product/adjust_stock", 
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
    $('#product_stock_form')[0].reset();
    $.toaster({ priority : data.result, title : data.title, message : data.message});
    $('#adjustment_model').modal('hide');
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

})
}


        </script>