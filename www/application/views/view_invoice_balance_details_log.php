<?php


// $bill          = $this->db->where(array('bill_id' => $parm,'ledger_type' => 'buy'))->get('ledger')->result_array();
$bill          = $this->db->where(array('bill_id' => $parm,'ledger_type' => 'sell'))->get('ledger')->result_array();
// echo $this->db->last_query();die();

// To Get Last Entry of this bill id
$last_entery  = end($bill);

// echo '<pre>';
    // print_r($last_entery);
    // echo '</pre>';die();
 ?>
 
<div class="col-xs-12 col-md-12 col-lg-12 pull-left">
				<?php if (isset($last_entery['bill_id']) && !empty($last_entery['bill_id'])) { ?>
				<!--  <form id="pay_remain_balance" method="post" action="<?php //echo base_url("product/add_remain_balance"); ?>"> -->
                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Total Bill Record</div>

                        <div class="panel-body">

                            <div class="row">

                             <div class="col-md-5"><h4><b>Bill ID:</b></h4></div><div class="col-md-7"><h5><input type="text"  class="form-control required" name="bill_id" id="bill_id"  value="<?php echo $last_entery['bill_id']; ?>" readonly /></h5></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Total Amount:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="total_amount" id="total_amount"  value="<?php echo $last_entery['total_amount']; ?>" readonly /></h4></div></div>

						       <div class="row card-box">
                           
                            <table class="table" id="actual_all_data" style"display:block:">
                                <thead>
                                  <tr>
                                    <th>Paid Date</th>
                                    <th>Amount Paid</th>
                                    <th>Amount Left</th>
                                    <th>Action</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
									<?php foreach ($bill as $key => $pro) { ?>
									
									  <tr>
										<td scope="row"><?php echo $pro['created_on']; ?></td>
										<td><?php echo $pro['amount_paid']; ?></td>
										<td><?php echo $pro['balance']; ?></td>
										<td><button class="btn btn-info btn-mini" style="font-size:12px;" amount_paid="<?php echo $pro['amount_paid'] ?>" balance="<?php echo $pro['balance'] ?>" paid_date="<?php echo $last_entery['created_on'] ?>" onclick="hide_all_data(this)"><i class="fa fa-pencil-square-o"></i></button>
										  <button class="btn btn-danger btn-mini" style="font-size:12px;" onclick=del_stock_product_balnce("'<?php echo $pro['bill_id'];?>'")><i class="fa fa-trash-o"></i></button>
										</td>
										
									  </tr>
									<?php } ?>
                                </tbody>
                              </table> 
							 
                                <div class="col-md-12">
									<div id="edit_form" style="display:none;">
											<form id="" method="post" >
												<div class="row">
													<div class="col-md-5"><h4><b>Last Paid Date:</b></h4></div><div class="col-md-7"><h5><input type="text"  class="form-control required" name="paid_date" id="paid_date"  value="" readonly /></h5></div></div>
													
													<div class="row"><div class="col-md-5"><h4><b>Balance:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="balance_edit" id="balance_edit"  value="" readonly /></h4></div></div>
													<div class="row"><div class="col-md-5"><h4><b>Last Paid:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="amount_paid_edit" id="amount_paid_edit"  value=""  /></h4></div></div>
												
												 <div class="row"><div class="col-md-5"></div><div class="col-md-7"><h4><button type="submit" class="btn btn-default ladda-button" data-style="expand-left"><span class="ladda-label">Update</span></div></h4></div></div>
												</div>												
											</form>
										</div>
									</div>
                             
                              </div>
                              </div>
						</div>
                    </div>
			<!-- 	</form>	  -->
				<?php } else { ?>
			
				<div class="panel panel-default height">

							<div class="panel-heading text-center">No Record Found</div>
				</div>
				<?php } ?>
				

</div>


<script>


<script>

$(".flatpickr").flatpickr({dateFormat: "d-m-Y",});


function hide_all_data(obj){
	event.preventDefault();
	 
	$('#actual_all_data').hide();
	$('#edit_form').show();
	
	var paid_date = $(obj).attr('paid_date');
	var ledger_id = $(obj).attr('ledger_id');
	/*$('#paid_date').setDate(paid_date);*/
	var balance = parseInt($('#total_balance').val());
	var amount_paid = parseInt($(obj).attr('amount_paid'));
	
	
	$('#paid_date').val(paid_date);
	/*$('#balance_edit').val(balance);*/
	$('#amount_paid_edit').val(amount_paid);
	$('#ledger_id').val(ledger_id);
	$('#amount_paid_edit').attr('max',amount_paid+balance);
	
}

  var base_url = '<?php echo base_url(); ?>';
$("#update_paid_amounnt_form").validate({
      submitHandler: function (form) {
  var l = Ladda.create( document.querySelector( '.ladda-button' ) );
        l.start();
    var formData = new FormData($('#update_paid_amounnt_form')[0]);

$.ajax({
type:'POST',
dataType:'json',
url: base_url+"product/update_paid_amount_entry", 
data: formData,
contentType: false,
processData: false,
success:function(data){  
  l.stop();
if(data.result == 'unauth') {

/*  window.location.replace(base_url+"Welcome");*/

}else if(data.result == 'success'){
  /* table.ajax.reload();
    $('#myModal').modal('hide');
    $('#product_add_form')[0].reset();*/
    $('#actual_all_data').show();
	$('#edit_form').hide();
	$('#myModal').modal('hide');
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

                </script>