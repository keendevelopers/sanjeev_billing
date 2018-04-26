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
				 <form id="pay_remain_balance" method="post" action="<?php echo base_url("product/add_remain_balance"); ?>">
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
							  <table class="table" id="edit_form" style"display:none:" >
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
                              </table> 
                              </div>
                              </div>
						</div>
                    </div>
				</form>	 
				<?php } else { ?>
			
				<div class="panel panel-default height">

							<div class="panel-heading text-center">No Record Found</div>
				</div>
				<?php } ?>
				

</div>


<script>




function hide_all_data(obj){
	event.preventDefault();
	 
	$('#actual_all_data').hide();
	$('#edit_form').show();
	
	var paid_date = $(obj).attr('paid_date');
	var balance = $(obj).attr('balance');
	var amount_paid = $(obj).attr('amount_paid');
	
	
	$('#paid_date').val(paid_date);
	$('#balance_edit').val(balance);
	$('#amount_paid_edit').val(amount_paid);
	
}
</script>
