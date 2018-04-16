<?php

  $vehicle_models = $this->db->where('is_deleted',0)->get('vehicle_info')->result_array();
  /*$vehicle_detiails = $this->db->where('sv_id',1)->get('stock_vehicles')->row_array();*/

 ?>

<div class="card-box">

<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>

<form class="form-horizontal" method="POST" id="sell_vehicle_form">

<div class="col-sm-12" style="margin-bottom: 15px">
<div class="col-sm-7">
<h4 class="m-t-0 header-title">Invoice No: <b id="inv_no"><?php echo isset($edit['inv_id'])? $edit['inv_id']:'';?></b></h4>
<p class="text-muted font-13 m-b-30">Enter Billing Details</p>
</div>
<div class="col-sm-5">
<h4 class="m-t-0 header-title">Invoice Date: </h4>
<input type="text" name="invoice_date" class="form-control flatpickr" value="<?php echo isset($edit['inv_date'])? $edit['inv_date']:'';?>" placeholder="DATE" required>
</div>
</div>



   
<input type="hidden" value="<?php echo isset($edit['inv_id'])? $edit['inv_id']:'';?>" name="invoice_id">
<input type="hidden" value="<?php echo isset($edit['ref_sv_id'])? $edit['ref_sv_id']:'';?>" name="old_ref_sv_id">
<input type="hidden" value="<?php echo isset($edit['ref_v_id'])? $edit['ref_v_id']:'';?>" name="old_ref_v_id">

<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">SELECT VEHICLE *</label>
<div class="col-sm-7">
    <select id="theSelect" onchange="get_chassis_here();" class="form-control" name="v_id" required>
    <option value="">Select Vehicle Model</option>

    <?php foreach ($vehicle_models as $key =>$value) {
       echo '<option value="'.$value['v_id'].'">'.$value["model"].'</option>';
    } ?>
    </select>                                    
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">SELECT CHASSIS NO*</label>
<div class="col-sm-7">
    <select id="chassis_select" onchange="get_user_here();" class="form-control" name="sv_id" required disabled="">
   <option value="">Select Chassis No.</option>
    </select>                                    
</div>
<div class="col-sm-3" onclick="show_details();" id="show_details_click" style="display: none"><i class="fa fa-chevron-circle-down" aria-hidden="true" style="font-size: 20px; line-height: 36px"> Show Details</i></div>
</div>

<div class="isvehicle col-md-6 col-sm-12" style="display: none;    border-right: 1px solid rgb(121, 121, 125);
    padding: 10px;
    "><!-- border-radius: 11px; -->
     <h5 style="text-align: center;
    font-size: 32px;
    font-weight: 700;" >Vehicle Model Information</h5>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Model*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_model" class="form-control" placeholder="Model Name" >
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Make*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_make" class="form-control" placeholder="Make Company"    >
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Horse Power*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_power" class="form-control" placeholder="eg. 120cc" rows="3">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Fuel*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_fuel" class="form-control" placeholder="Fuel Used">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">No of Cylinder*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_cylinder" class="form-control" placeholder="OCCUPATION">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Seating Capacity*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_seating" class="form-control" placeholder="Seating Capacity">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Unladen Weight*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_weight" class="form-control" placeholder="eg. 102Kg">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Body Type*</label>
<div class="col-sm-7">
<input type="text" readonly id="is_body" class="form-control" placeholder="Body Type">
</div>
</div>

<!-- <div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">IMAGE*</label>
<div class="col-sm-7">
<img id="is_pic" src=""/ style="    max-width: 120px; max-height: 200px;">
</div>
</div> -->
                                        <div class="clearfix"></div>
                                    </div>
<!-- <div class="clearfix"></div> -->
<div " class="col-md-6 col-sm-12 is_stockvehicle" style="display: none;
    padding: 10px;"> <!-- style="display: none; border: 1px solid rgb(121, 121, 125);
    padding: 10px;
    border-radius: 11px; -->
    <h5 style="text-align: center;
    font-size: 32px;
    font-weight: 700;" >Vehicle Details</h5>

 <div class="form-group">

<label for="inputEmail3" class="col-sm-4 control-label">Chassis NO*</label>
<div class="col-sm-7">
<input type="text" id="chassis" class="form-control" placeholder="Enter Chassis NO"  value="" readonly>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">ENGINE NO*</label>
<div class="col-sm-7">
<input type="text" id="engine_no" class="form-control" value="" placeholder="Enter ENGINE NO" readonly>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Key NO*</label>
<div class="col-sm-7">
<input type="text" id="key_no" class="form-control" placeholder="Enter Key NO" value="" readonly>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Battery NO*</label>
<div class="col-sm-7">
<input type="text" id="battery_no" name="battery_no" class="form-control" placeholder="Enter Battery NO" value="" required="">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Service Book NO*</label>
<div class="col-sm-7">
<input type="text" id="sb_no" name="sb_no" class="form-control" placeholder="Enter Service Book NO" value="" required>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Year Of Manufacturer*</label>
<div class="col-sm-7">
<input type="text" id="manufacturer" class="form-control" placeholder="Enter Year Of Manufacturer" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' readonly>
</div>
</div>


<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">COLOUR*</label>
<div class="col-sm-7">
<input class="form-control" id="color" placeholder="COLOUR" value="" readonly>
</div>
</div>

<!-- <div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">DATE*</label>
<div class="col-sm-7">
<input type="text" name="date" class="form-control flatpickr" value="<?php echo $vehicle_detiails['date'];?>" placeholder="DATE" required>
</div>
</div> -->

<!-- <div class="form-group">
<div class="col-sm-offset-4 col-sm-8">
<button type="submit" name="submit"  class="btn btn-primary waves-effect waves-light">
Update Vehicle
</button>
<a href="<?php //echo base_url();?>Vehicle/vehicle_list" class="btn btn-default waves-effect waves-light m-l-5">
Back
</a>
</div>
</div> -->

</div>
<div class="clearfix"></div>

<div class="iscustomer col-md-6 col-sm-12" style="margin-top:10px; border-right: 1px solid rgb(121, 121, 125);
    padding: 10px;
    ">
     <h5 style="text-align: center;
    font-size: 32px;
    font-weight: 700;" >Customer Details</h5>


<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">CUSTOMER NAME*</label>
<div class="col-sm-7">
<input type="text" value="<?php echo isset($edit['cust_name'])? $edit['cust_name']:'';?>" id="is_name" name="hirer" class="form-control" placeholder="NAME OF CUSTOMER" required="" >
</div>
</div>

<div class="form-group">
<div class="col-sm-4">
    <select for="inputEmail3" class="col-sm-12 form-control kd_select" name="type" required id="care_type">
        <option value="S/o">S/o</option>
        <option value="W/o">W/o</option>
        <option value="D/o">D/o</option>
    </select>
    </div>
<div class="col-sm-7">
<input type="text" name="f_name" class="form-control" id="inputEmail3" placeholder="S/o. W/o. D/o Name" required value="<?php echo isset($edit['f_name'])? $edit['f_name']:'';?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">ADDRESS*</label>
<div class="col-sm-7">
<textarea type="text" id="is_address" name="hirer_address" class="form-control" placeholder="ADDRESS" rows="3" required=""><?php echo isset($edit['address'])? $edit['address']:'';?></textarea>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">State Code*</label>
<div class="col-sm-7">
<input type="text" id="StateCode" name="StateCode" class="form-control" placeholder="State Code" value="<?php echo isset($edit['StateCode'])? $edit['StateCode']:'3';?>" >
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">MOBILE*</label>
<div class="col-sm-7">
<input type="text" id="is_mobile" name="mobile" class="form-control" placeholder="MOBILE" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo isset($edit['mobile'])? $edit['mobile']:'';?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">H.P.A With*</label>
<div class="col-sm-7">
<input type="text" id="is_hpa" name="hpa" class="form-control" placeholder="H.P.A" value="<?php echo isset($edit['hpa'])? $edit['hpa']:'';?>">
</div>
</div>

    </div>

<div class="iscustomer col-md-6 col-sm-12" style="margin-top:10px; 
    padding: 10px;">
     <h5 style="text-align: center;
    font-size: 32px;
    font-weight: 700;" >Billing Details</h5>


<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Amount (<i class="fa fa-inr" aria-hidden="true"></i>)*</label>
<div class="col-sm-7">
<input type="text" id="amount" name="amount" class="form-control" placeholder="Enter Amount" required="" onkeyup="get_total_amount();" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo isset($edit['sub_total'])? $edit['sub_total']:'';?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Offer(<i class="fa fa-inr" aria-hidden="true"></i>)</label>
<div class="col-sm-7">
<select for="inputEmail3" class="col-sm-12 form-control kd_select" id="OfferType" name="OfferType" onchange="get_total_amount();" >
 <option value="">Select Offer</option>
 <option value="MRP" <?php echo @$edit['OfferType']=='MRP'? 'Selected':'';?>>On Amount</option>
 <option value="TotalBill" <?php echo @$edit['OfferType']=='TotalBill'? 'Selected':'';?>>On Total Amount</option>
</select>
</div>
</div>

<div style="display: none" id="offer_div">
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Offer Title*</label>
<div class="col-sm-7">
<input type="text" id="OfferTitle" name="OfferTitle" class="form-control" placeholder="Offer Title" value="<?php echo isset($edit['OfferTitle'])? $edit['OfferTitle']:'';?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Offer Amount (<i class="fa fa-inr" aria-hidden="true"></i>)*</label>
<div class="col-sm-7">
<input type="text" id="OfferAmount" name="OfferAmount" class="form-control" placeholder="Enter offer Amount" onkeyup="get_total_amount();" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo isset($edit['OfferAmount'])? $edit['OfferAmount']:'';?>">
</div>
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Tax (%)*</label>
<div class="col-sm-7">
<select for="inputEmail3" class="col-sm-12 form-control kd_select" id="tax" name="tax" onchange="get_total_amount();" required>
        <option value="0">Select Tax</option>
        <option value="CGST-14" selected>CGST 14%</option>
        <option value="IGST-28">Integrated GST (IGST 28%)</option>
        <!-- <option value="vat-12">VAT 12%</option> -->
       <!--  <option value="W/o">W/o</option>
        <option value="D/o">D/o</option> -->
    </select>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Tax Amount (<i class="fa fa-inr" aria-hidden="true"></i>)*</label>
<div class="col-sm-7">
<input type="text" id="tax_amount" name="tax_amount" class="form-control" placeholder="Tax Amount" readonly="" value="<?php echo isset($edit['tax'])? $edit['tax']:'';?>">
</div>
</div>

<div class="form-group">
<label for="surcharge_per" class="col-sm-4 control-label">SGST/IGST (%)*</label>
<div class="col-sm-7">
<select for="surcharge_per" class="col-sm-12 form-control kd_select" id="surcharge_per" name="surcharge_per" onchange="get_total_amount();" required>
        <option value="0">Select Tax Option</option>
        <option value="SGST-14">State GST (SGST 14%)</option>
        <option value="IGST-14">Integrated GST (IGST 14%)</option>

       
       <!--  <option value="W/o">W/o</option>
        <option value="D/o">D/o</option> -->
    </select>
</div>
</div>

<div class="form-group" style="display: none" id="surcharge_amt_div">
<label for="inputEmail3" class="col-sm-4 control-label"><span id="addition_tax_title"></span> (<i class="fa fa-inr" aria-hidden="true"></i>)*</label>
<div class="col-sm-7">
<input type="text" id="surcharge_amt" name="surcharge_amt"  class="form-control" placeholder="Tax Amount" readonly="" value="<?php echo isset($edit['surcharge_amt'])? $edit['surcharge_amt']:'';?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Total Amount (<i class="fa fa-inr" aria-hidden="true"></i>)*</label>
<div class="col-sm-7">
<input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="Total Amount" readonly="" value="<?php echo isset($edit['total'])? $edit['total']:'';?>">
</div>
</div>


</div> 

    <div class="form-group">
<div class="col-sm-offset-4 col-sm-8" style="margin-top: 15px;">
<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" data-title="save_inv">
<i class="fa fa-floppy-o" aria-hidden="true"></i> <?php echo isset($edit['inv_id'])? 'Update':'Save';?> Invoive
</button>

<button type="submit" name="submit" class="btn btn-info waves-effect waves-light" data-title="save_print"><i class="fa fa-print" aria-hidden="true"></i> 
<?php echo isset($edit['inv_id'])? 'Update':'Save';?> & Print Invoive
</button>
<a href="<?php echo base_url(); ?>Welcome/managerecords" class="btn btn-default waves-effect waves-light m-l-5"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> 
Back
</a>
</div>

</div>  
</form>
<div class="clearfix"></div>

<?php if(isset($msgsuccess) != ''){?>
 <div class="alert alert-success alert-dismissable col-md-6 col-md-offset-3">
  <button type="submit" class="close" style="right:0px !important; color:#000 !important" data-dismiss="alert" aria-hidden="true">×</button>
 <strong><i class="fa fa-check-square-o"></i></strong> <?php echo isset($msgsuccess) && $msgsuccess !='' ? $msgsuccess : ''; ?></div>
 <div class="clearfix"></div>
<?php }?>



</div>


<script type="text/javascript">

function get_total_amount(){
  var amount = $('#amount').val() == ''? 0:$('#amount').val();
var offer_amount = 0;
var offer_from = '';
if($('#OfferType').val() != ''){
  $('#offer_div').slideDown();
  offer_amount = $('#OfferAmount').val();
  offer_from = $('#OfferType option:selected').val();
  $('#OfferAmount').attr('required','required');
  $('#OfferTitle').attr('required','required');
}else{
  $('#offer_div').slideUp();
  document.getElementById("OfferAmount").required = false;
  document.getElementById("OfferTitle").required = false;
 
}

if(offer_from != '' && offer_from == 'MRP'){
amount = amount - offer_amount;
}
  var tax = $('#tax').val();
  str1 = parseFloat(tax.replace ( /[^\d.]/g, '' ), 10);

var surcharge_per = $('#surcharge_per').val();
sur_per = parseFloat(surcharge_per.replace ( /[^\d.]/g, '' ), 10);

if(surcharge_per == '0'){
$('#surcharge_amt_div').slideUp();
}else{
$('#surcharge_amt_div').slideDown();
$('#addition_tax_title').text(surcharge_per.substring(0, 4)+' Amount');
}

  var tax_amount = (amount*str1)/100;
  $('#tax_amount').val((tax_amount).toFixed(2));

  var sur_amount = (amount*sur_per)/100;
  $('#surcharge_amt').val((sur_amount).toFixed(2));

  var total_last = parseFloat(amount)+tax_amount+sur_amount;
if(offer_from != '' && offer_from == 'TotalBill'){
total_last = total_last - offer_amount;
}

  $('#total_amount').val(total_last.toFixed(2));
}

/*$('#sell_vehicle_form').submit(function(e){
    e.preventDefault();
    alert();
    });*/
   /* $('#sell_vehicle_form button[type="submit"]').text('Uploading....').prop('disabled',true);
    var formData = new FormData($('#sell_vehicle_form')[0]);*/
/*$.ajax({
type:'POST',
dataType:'json',
url: base_url+"Vehicle/sell_vehicle_lajex", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
    $('#sell_vehicle_form button[type="submit"]').text('Submit').prop('disabled',false);
if(data.result == 'unauth') {
}else if(data.result == 'success'){
     $('#vehicle_edit_form')[0].reset();
     $("#theSelect").val('');
     $(".is_stockvehicle").slideUp('slow');
     $('#myModal').modal('hide');
     $('#datatable').DataTable().ajax.reload();
    $.toaster({ priority : data.result, title : data.title, message : data.message});
}
else{
    $.toaster({ priority : data.result, title : data.title, message : data.message});
}
},
error: function(){
$.toaster({ priority : 'danger', title : 'Error', message : 'Not Done!'});
    return true;
}
});*/


function get_chassis_here()
{
   var value = $("#theSelect option:selected").val();
   var edit_chassis = '';
    $.post('<?php echo base_url("Vehicle/get_chassis_no"); ?>'+'/'+value,function(d){
      $('#chassis_select').empty().append('<option value="">Select Chassis No</option>');

      <?php if(isset($edit['ref_v_id'])){ ?>

       if('<?php echo isset($edit['ref_v_id'])? $edit['ref_v_id']:'';?>' == value ){
        edit_chassis = 'yes';
        $('#chassis_select').append('<option value="<?php echo $edit['ref_sv_id']; ?>"><?php echo $edit['chs_no']; ?></option>');
       }

       $("#chassis_select").val('<?php echo isset($edit['ref_sv_id'])? $edit['ref_sv_id']:'';?>').trigger('change');

       <?php } ?>
    if(d == '' && edit_chassis == ''){
      $('#show_details_click').hide();
      $('#chassis_select').prop('disabled',true);
      $(".is_stockvehicle,.isvehicle").slideUp('slow');
    }else{
      $('#chassis_select').prop('disabled',false);
    }
     $.each(d,function(i,val){
      $('#chassis_select').append('<option value="'+val.sv_id+'">'+val.chassis_no+'</option>');
     })
      
    })
  
}

function get_user_here()
{
    var value = $("#chassis_select option:selected").val();
    var theDiv = $(".is_stockvehicle,.isvehicle");
    if(value == ''){
         theDiv.slideUp('slow');
         $('#show_details_click').hide();
    }else{
    $.post('<?php echo base_url("Vehicle/get_vehicle_fulldetails"); ?>'+'/'+value,function(d){
            $('#chassis').val(d.chassis_no);
            $('#engine_no').val(d.engine_no);
            $('#key_no').val(d.key_no);
            $('#battery_no').val(d.battery_no);
            $('#sb_no').val(d.sb_no);
            $('#manufacturer').val(d.manufacture);
             $('#color').val(d.color);


            $('#is_model').val(d.model);
             $('#is_make').val(d.make);
              $('#is_fuel').val(d.fuel);
               $('#is_power').val(d.horse_power);
                $('#is_cylinder').val(d.cylinder);
                 $('#is_seating').val(d.seating_cap);
                $('#is_weight').val(d.weight);
                 $('#is_body').val(d.body_type);
                /* $('#is_pic').attr('src','<?php// echo base_url("assets/img/user_profile")."/"; ?>'+d.pic);*/
          $('#show_details_click').show();
    /*theDiv.siblings('[class*=is]').slideUp(function() { $(this).addClass("hidden"); });    */ 
    })
    }
}

function show_details(){
  var theDiv = $(".is_stockvehicle,.isvehicle");
 theDiv.slideToggle('slow');
}

var base_url = '<?php echo base_url(); ?>';

   $("#sell_vehicle_form button[type=submit]").click(function() {
    $("#sell_vehicle_form button[type=submit]", $(this).parents("form")).removeAttr("clicked");
    $(this).attr("clicked", "true");
});


</script>