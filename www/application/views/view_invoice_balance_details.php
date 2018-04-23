<?php


$bill          = $this->db->where(array('bill_id' => $parm,'ledger_type' => 'sell'))->get('ledger')->result_array();
// echo '<pre>';
    // print_r($bill);
    // echo '</pre>';die();
 // echo $this->db->last_query();die();

// To Get Last Entry of this bill id
$last_entery  = end($bill);

// echo '<pre>';
    // print_r($last_entery);
    // echo '</pre>';die();
 ?>

<div class="col-xs-12 col-md-12 col-lg-12 pull-left">
			<?php if (isset($last_entery['bill_id']) && !empty($last_entery['bill_id'])) { ?>
				<form id="pay_remain_balance" method="post" action="<?php echo base_url("product/add_remain_balance"); ?>">
                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Remain Balance Details</div>

                        <div class="panel-body">

                            <div class="row">

                             <div class="col-md-5"><h4><b>Bill ID:</b></h4></div><div class="col-md-7"><h5><input type="text"  class="form-control required" name="bill_id" id="bill_id"  value="<?php echo $last_entery['bill_id']; ?>" readonly /></h5></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Total Amount:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="total_amount" id="total_amount"  value="<?php echo $last_entery['total_amount']; ?>" readonly /></h4></div></div>

						   <div class="row"><div class="col-md-5"><h4><b>Last Paid:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="amount_paid" id="amount_paid"  value="<?php echo $last_entery['amount_paid']; ?>" readonly /></h4></div></div>


						   <input type="hidden" id="ledger_type" class="form-control" name="ledger_type"  value="sell" >
						   <div class="row"><div class="col-md-5"><h4><b>Balance Left:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="balance" id="balance"  value="<?php echo $last_entery['balance']; ?>" readonly /></h4></div></div>

						   <div class="row"><div class="col-md-5"><h4><b>New Pay*:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="new_pay" id="new_pay" placeholder="New Pay" value="" onkeyup="Left_balance()" /></div></h4></div>

						   
						   <div class="row"><div class="col-md-5"><h4><b>Balance Left:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control" name="balance_left" id="balance_left" placeholder="Balance Left" value="" readonly /></div></h4></div>

						   <div class="row"><div class="col-md-5">
								<h4><b>Payment Type:</b></h4>
						   </div>
						   <div class="col-md-7">
								<h4><div class="form-check">
										<input class="form-check-input" type="radio" name="payment_type" onclick="hideChequeField()" value="cash" checked >
										<label class="form-check-label" for="radio100">Cash</label>
									</div>

									<div class="form-check">
										<input class="form-check-input" type="radio" id="Cheque" class="form-control" name="payment_type" onclick="showChequeField()" value="cheque">
										<label class="form-check-label" for="radio101">Cheque</label>
									</div>
							   </h4>
							</div>
							
							<div class="row" style="display:none" id="cheque_number"><div class="col-md-5"><h4><b>Cheque Number*:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="cheque_number" id="cheque_number_val" placeholder="Cheque Number" value=""  /></div></h4></div>

						</div>

						   <div class="row"><div class="col-md-5"></div><div class="col-md-7"><h4><button type="submit" class="btn btn-default ladda-button" data-style="expand-left"><span class="ladda-label">Update</span></div></h4></div></div>
         
                    </div>
				</form>
			<?php } else { ?>
			
			<div class="panel panel-default height">

                        <div class="panel-heading text-center">No Record Found</div>
			</div>
			<?php } ?>
            </div>
				
<script>

	function Left_balance(){
		var new_pay = $('#new_pay').val();
		var balance = $('#balance').val();
		
		var left_balance = parseInt(balance)-parseInt(new_pay);
		$('#balance_left').val(left_balance.toFixed(2));
	}


</script>