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
                           <input type="hidden" id="bill_id" value="<?php echo $parm ?>">
						    <!-- Table Starts From here -->
                           <div class="row card-box">
                           <div class="col-md-12">
<!--  -->
<table id="datatable" class="table table-striped display table-bordered">
<thead>
<tr>
  <th>Paid Date</th>
  <th>Amount Paid</th>
  <th>Amount Left</th>
  <th>Action</th> 
</tr>

</thead>
<tbody>
</tbody>
</table>

<!--  -->

<!-- 
                           <table class="table">
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
									                      <td><button class="btn btn-danger btn-mini" onclick=del_stock_product_balnce("'<?php echo $pro['bill_id'];?>'")><i class="fa fa-trash-o"></i></button>
			                              </td>
                                    
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table> -->
                              </div>
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


var table;

$(document).ready(function() {
    $('#tax_name').select2({ width: '100%' });
 jQuery('#date-range').datepicker({
                    toggleActive: true,
                     format: 'yyyy-mm-dd'
                });

    $('#year_sel, #theSelect').select2({ width: '100%' });
    //datatables
    var bill_id = $('#').val();
    table = $('#datatable').DataTable({ 
       
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        "ajax": {
            "url": "<?php echo site_url('product/product_list_detail_ajax')?>",
            "type": "POST",
            "data": function(d){d.bill_id=bill_id},
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });

});

	function Left_balance(){
		var new_pay = $('#new_pay').val();
		var balance = $('#balance').val();
		
		var left_balance = parseInt(balance)-parseInt(new_pay);
		$('#balance_left').val(left_balance.toFixed(2));
	}


</script>