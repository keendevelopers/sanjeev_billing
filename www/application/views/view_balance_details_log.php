<?php


$bill          = $this->db->where(array('bill_id' => $parm,'ledger_type' => 'buy'))->get('ledger')->result_array();
// echo $this->db->last_query();die();

// To Get Last Entry of this bill id
$last_entery  = end($bill);

// echo '<pre>';
    // print_r($last_entery);
    // echo '</pre>';die();
 ?>
 
<div class="col-xs-12 col-md-12 col-lg-12 pull-left">

				 <form id="pay_remain_balance" method="post" action="<?php echo base_url("product/add_remain_balance"); ?>">
                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Total Bill Record</div>

                        <div class="panel-body">

                            <div class="row">

                             <div class="col-md-5"><h4><b>Bill ID:</b></h4></div><div class="col-md-7"><h5><input type="text"  class="form-control required" name="bill_id" id="bill_id"  value="<?php echo $last_entery['bill_id']; ?>" readonly /></h5></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Total Amount:</b></h4></div><div class="col-md-7"><h4><input type="text"  class="form-control required" name="total_amount" id="total_amount"  value="<?php echo $last_entery['total_amount']; ?>" readonly /></h4></div></div>

						       </div>
                              </div>
						</div>
                    </div>
				</form>	 
				
			
				<div class="panel panel-default height">

							<div class="panel-heading text-center">No Record Found</div>
				</div>
			

</div>



