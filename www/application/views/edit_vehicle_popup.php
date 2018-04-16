<?php

  $vehicle_models = $this->db->where('is_deleted',0)->get('vehicle_info')->result_array();
  $vehicle_detiails = $this->db->where('sv_id',$parm)->get('stock_vehicles')->row_array();

 ?>

<div class="card-box">

<h4 class="m-t-0 header-title"><b>Edit Vehicle Details</b></h4>

<p class="text-muted font-13 m-b-30">

Enter Vehicle Details

</p>

<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>

<form class="form-horizontal" method="POST" id="vehicle_edit_form">
   
<input type="hidden" value="" name="vehicle_id" >
<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">SELECT Model*</label>
<div class="col-sm-7">
<!-- <?php //echo '<pre>';print_r($vehicle_detiails); ?>  -->
    <select id="theSelect2" onchange="get_user_here(this);" class="form-control" name="vehicle" required>
    <?php foreach ($vehicle_models as $key => $value) {
       /* $sel = $vehicle_detiails['ref_v_id'] == $value['v_id']? "selected":"";*/
       echo '<option value="'.$value['v_id'].'" >'.$value["model"].'</option>';
    } ?>
    </select>                                    
</div>
</div>

<div class="iscustomer" style="display: none;    border: 1px solid rgb(121, 121, 125);
    padding: 10px;
    border-radius: 11px;">
     <h5 style="text-align: center;
    font-size: 32px;
    font-weight: 700;">Vehicle Model Information</h5>
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

<div style="border: 1px solid rgb(121, 121, 125);
    padding: 10px;
    border-radius: 11px;">
    <h5 style="text-align: center;
    font-size: 32px;
    font-weight: 700;">Vehicle Details</h5>

<div class="form-group">

<input type="hidden" value="<?php echo $parm;?>" name="sv_id"> 
<input type="hidden" value="<?php echo $vehicle_detiails['ref_v_id'];?>" name="ref_v_id"> 

<label for="inputEmail3" class="col-sm-4 control-label">Chassis NO*</label>
<div class="col-sm-7">
<input type="text" class="form-control" placeholder="Enter Chassis NO"  value="<?php echo $vehicle_detiails['chassis_no'];?>" name="chassis" required>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">ENGINE NO*</label>
<div class="col-sm-7">
<input type="text" class="form-control" value="<?php echo $vehicle_detiails['engine_no'];?>" placeholder="Enter ENGINE NO" name="engine_no" required>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Key NO*</label>
<div class="col-sm-7">
<input type="text" class="form-control" placeholder="Enter Key NO" value="<?php echo $vehicle_detiails['key_no'];?>" name="key_no">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Battery NO*</label>
<div class="col-sm-7">
<input type="text" class="form-control" placeholder="Enter Battery NO" value="<?php echo $vehicle_detiails['battery_no'];?>" name="battery_no">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Service Book NO*</label>
<div class="col-sm-7">
<input type="text" class="form-control" placeholder="Enter Service Book NO" value="<?php echo $vehicle_detiails['sb_no'];?>" name="sb_no">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">Year Of Manufacturer*</label>
<div class="col-sm-7">
<input type="text" class="form-control" placeholder="Enter Year Of Manufacturer" value="<?php echo $vehicle_detiails['manufacture'];?>" name="manufacturer" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
</div>
</div>


<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">COLOUR*</label>
<div class="col-sm-7">
<input class="form-control" id="inputEmail3" placeholder="COLOUR" value="<?php echo $vehicle_detiails['color'];?>" name="color">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-4 control-label">DATE*</label>
<div class="col-sm-7">
<input type="text" name="date" class="form-control flatpickr" value="<?php echo $vehicle_detiails['date'];?>" placeholder="DATE" required>
</div>
</div>

<div class="form-group">

<div class="col-sm-offset-4 col-sm-8">

<button type="submit" name="submit"  class="btn btn-primary waves-effect waves-light">

<i class="fa fa-pencil-square-o"></i> Update Vehicle

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


<script type="text/javascript">

flatpickr(".flatpickr");
/*$(document).ready(function(){*/
    setTimeout(function() {console.log(<?php echo $vehicle_detiails['ref_v_id'];?>); 
        var aa = '<?php echo $vehicle_detiails['ref_v_id'];?>';
        
        $('#theSelect2').val('<?php echo $vehicle_detiails['ref_v_id'];?>').trigger('change');}, 1000);
 

/*})*/
function get_user_here(obj)
{
    var value = $(obj).val();
    var theDiv = $(".iscustomer");
    if(value == ''){
         theDiv.slideUp('slow');
    }else{
    $.post('<?php echo base_url("Vehicle/get_vehicle_info"); ?>'+'/'+value,function(d){
     
            $('#is_model').val(d.model);
             $('#is_make').val(d.make);
              $('#is_fuel').val(d.fuel);
               $('#is_power').val(d.horse_power);
                $('#is_cylinder').val(d.cylinder);
                 $('#is_seating').val(d.seating_cap);
                $('#is_weight').val(d.weight);
                 $('#is_body').val(d.body_type);
                /* $('#is_pic').attr('src','<?php// echo base_url("assets/img/user_profile")."/"; ?>'+d.pic);*/
          theDiv.slideDown('slow');
    theDiv.siblings('[class*=is]').slideUp(function() { $(this).addClass("hidden"); });     
    })
    }
}

var base_url = '<?php echo base_url(); ?>';

 $('#vehicle_edit_form').submit(function(e){
    e.preventDefault();
    $('#vehicle_edit_form button[type="submit"]').text('Uploading....').prop('disabled',true);
    var formData = new FormData($('#vehicle_edit_form')[0]);
$.ajax({
type:'POST',
dataType:'json',
url: base_url+"Vehicle/vehicle_edit_ajax", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
    $('#vehicle_edit_form button[type="submit"]').text('Submit').prop('disabled',false);
if(data.result == 'unauth') {
/*  window.location.replace(base_url+"Welcome");*/
}else if(data.result == 'success'){
     $('#vehicle_edit_form')[0].reset();
     $("#theSelect2").val('');
     $(".iscustomer").slideUp('slow');
     $('#myModal').modal('hide');
     $('#datatable').DataTable().ajax.reload();
    $.toaster({ priority : data.result, title : data.title, message : data.message});
    /*  setInterval(function(){window.location.replace(base_url+"user");},3000);*/
}
else{
    $.toaster({ priority : data.result, title : data.title, message : data.message});
}
},
error: function(){
$.toaster({ priority : 'danger', title : 'Error', message : 'Not Done!'});
    return true;
}
});
});


</script>