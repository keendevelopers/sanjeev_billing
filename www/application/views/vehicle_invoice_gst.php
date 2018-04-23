
<style type="text/css">
  .kd-align-left{
    text-align: left!important;
  }
  .has-feedback .form-control {
     padding-right: 0px!important; 
}
</style>
<div class="card-box">


<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>




<form id="invoice_add_form" method="post" class="form-horizontal">

<input type="hidden" name="inv_id" id="inv_id" value="<?php echo @$inv['inv_id']; ?>">
<input type="hidden" name="invoice_no" id="invoice_no" value="<?php echo @$inv['invoice_no']; ?>">
<div class="col-sm-12" style="margin-bottom: 15px">
<div class="col-sm-7">
<h4 class="m-t-0 header-title">Invoice No: <b id="inv_no"><?php echo isset($inv['invoice_no'])? $inv['invoice_no']:'';?></b></h4>
<p class="text-muted font-13 m-b-30">Enter Billing Details</p>
</div>
<div class="col-sm-5">
<h4 class="m-t-0 header-title">Invoice Date: </h4>
<div class="col-sm-12">
<input type="text" name="inv_date" class="form-control flatpickr" value="<?php echo isset($inv['inv_date'])? $inv['inv_date']:'';?>" placeholder="DATE" required>
</div>
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Name*</label>
<div class="col-sm-10">
<input type="text" id="cust_name" class="form-control" name="cust_name" placeholder="Name of customer" value="<?php echo @$inv['cust_name']; ?>">
</div>
</div>

<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Address*</label>
<div class="col-sm-10">
<input type="text" id="address" class="form-control" name="address" placeholder="Address" value="<?php echo @$inv['address']; ?>">
</div>
</div>

<!-- <div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Vehicle*</label>
<div class="col-sm-10">
<input type="text" id="vehicle_details" class="form-control" name="vehicle_details" placeholder="Vehicle Details" value="<?php echo @$inv['vehicle_details']; ?>">
</div>
</div> -->

<div class="form-group">
<!-- <label for="inputEmail3" class="col-sm-2 control-label">Prescribed By*</label>
<div class="col-sm-4">
<input type="text" id="vehicle_details" class="form-control" name="vehicle_details" placeholder="Doctor Name" value="<?php echo isset($inv['vehicle_details'])? $inv['vehicle_details']:'Dr.Gurjeet Singh'; ?>" >
</div> -->

<label for="inputEmail3" class="col-sm-2 control-label">Biller GSTIN</label>
<div class="col-sm-4">
<input type="text" id="Biller_GST" class="form-control" name="Biller_GST" placeholder="Biller GSTIN/Unique Id" value="<?php echo @$inv['Biller_GST']; ?>">
</div>

<label for="inputEmail3" class="col-sm-2 control-label">Mobile*</label>
<div class="col-sm-4">
<input type="text" id="mobile" class="form-control " name="mobile" placeholder="Mobile" value="<?php echo @$inv['mobile']; ?>">
</div>

</div>



<div class="form-group">


<label for="inputEmail3" class="col-sm-2 control-label">State Code*</label>
<div class="col-sm-4">
<input type="text" id="StateCode" class="form-control " name="StateCode" onblur="get_gst_option(this);" placeholder="State Code" value="<?php echo isset($inv['StateCode'])? @$inv['StateCode']:'3'; ?>" >
</div>

</div>

<hr/>
      
        <div class="form-group">
        <label class="col-xs-3 control-label kd-align-left">Product</label>
        <label class="col-xs-1 control-label kd-align-left">Price</label>
        <label class="col-xs-1 control-label kd-align-left">CGST</label>
        <label class="col-xs-1 control-label kd-align-left gst_option">SGST</label>
        <label class="col-xs-1 control-label kd-align-left">Q.Pack</label>
        <label class="col-xs-1 control-label kd-align-left">Q.Loose</label>
        <label class="col-xs-2 control-label kd-align-left">Discount(%)</label>
        <label class="col-xs-2 control-label kd-align-left">Total</label>
        <label class="col-xs-1 control-label kd-align-left"></label>
          </div>
        <?php if(isset($inv['inv_id']) && $inv['inv_id'] != ''){ ?>
        <input type="hidden" name="item_count" id="item_count" value="<?php echo count($inv_products)-1; ?>">
        <input type="hidden" name="item_count_1" id="item_count_1" value="<?php echo count($inv_products)-1; ?>">
       <?php foreach ($inv_products as $k => $val) { ?>
        <div class="form-group">
        <?php if($k == 0){ ?>
        <!-- <label class="col-xs-1 control-label">Items</label> -->
        <?php } else{ ?>
        <!-- <label class="col-xs-1 control-label"></label> -->
        <?php } ?>

        <div class="col-xs-3">
        <select class="form-control selectpicker" name="book_<?php echo $k; ?>_P_Id" data-live-search="true" onchange="get_price(this);" >
        <option value="">Select Product</option>
        <?php foreach ($products as $key => $value) { 
            $select = '';
            if($val['P_Id'] == $value['P_Id']){
                $select = 'selected';
            }
            ?>
           <option value="<?php echo $value['P_Id']; ?>" <?php echo $select; ?> data-id="<?php echo $value['Price']; ?>" data-pack="<?php echo $value['PerPack']; ?>" data-gst="<?php echo $value['GST_Per']; ?>"><?php echo $value['ProductTitle'].' ('.$value['ProductMake'].')'; ?></option>
        <?php } ?>
        </select>
        <i class="fa fa-question-circle-o" onclick="get_info('<?php echo base_url() . 'product/modal/view_product_info/' ; ?>',this)" style="cursor: pointer"></i>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Price" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Price" placeholder="Price" value="<?php echo $val['IP_Price']; ?>"/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Tax_1" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Tax_1" placeholder="%" value="<?php echo $val['IP_Tax_1']; ?>" readonly/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Tax_2" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Tax_2" placeholder="%" value="<?php echo $val['IP_Tax_2']; ?>" readonly/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Qunatity" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Qunatity" placeholder="Pack" value="<?php echo $val['IP_Qunatity']; ?>"/>

            <input type="hidden" class="form-control IP_Qunatity_Total" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Qunatity_Total" value="<?php echo $val['IP_Qunatity_Total']; ?>"/>

            <input type="hidden" class="form-control IP_Per_Pack" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Per_Pack" value="<?php echo $val['IP_Per_Pack']; ?>"/>

        </div>
        <div class="col-xs-1">
            <input type="text" class="form-control IP_Qunatity_Loose" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Qunatity_Loose" placeholder="Loose" value="<?php echo $val['IP_Qunatity_Loose']; ?>"/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Discount" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Discount" placeholder="Discount(%)" value="<?php echo $val['IP_Discount']; ?>"/>
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control IP_Total" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_IP_Total" placeholder="Total" value="<?php echo $val['IP_Total']; ?>"/>
        </div>
        <?php if($k == 0){ ?>
        <div class="col-xs-1">
            <button type="button" class="btn btn-default addButton" onclick="manage_total(this)"><i class="fa fa-plus"></i></button>
        </div>
        <?php } else{ ?>
        <div class="col-xs-1">
            <button type="button" class="btn btn-danger removeButton" onclick="manage_total(this)"><i class="fa fa-minus"></i></button>
        </div>
        <?php } ?>
        </div>

        <?php } } else { ?>

        <!-- For adding invoice items -->
        <input type="hidden" name="item_count" id="item_count" value="0">
        <input type="hidden" name="item_count_1" id="item_count_1" value="0">
        <div class="form-group">
        <!-- <label class="col-xs-1 control-label">Items</label> -->
        <div class="col-xs-3">
        <select class="form-control selectpicker" name="book_0_P_Id" onchange="get_price(this);" data-id="0" data-live-search="true">
        <option value="">Select Product</option>
        <?php foreach ($products as $key => $value) { ?>
           <option value="<?php echo $value['P_Id']; ?>" data-pack="<?php echo $value['PerPack']; ?>" data-id="<?php echo $value['Price']; ?>" data-gst="<?php echo $value['GST_Per']; ?>"><?php echo $value['ProductTitle'].' ('.$value['ProductMake'].')'; ?></option>
        <?php } ?>
        </select>
        <i class="fa fa-question-circle-o" onclick="get_info('<?php echo base_url() . 'product/modal/view_product_info/' ; ?>',this)" style="cursor: pointer"></i>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Price" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Price" placeholder="Price" />
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Tax_1" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Tax_1" placeholder="%" readonly/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Tax_2" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Tax_2" placeholder="%" readonly/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Qunatity" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Qunatity" placeholder="Pack" />

             <input type="hidden" class="form-control IP_Qunatity_Total" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Qunatity_Total" />

            <input type="hidden" class="form-control IP_Per_Pack" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Per_Pack"  />
            
        </div>

         <div class="col-xs-1">
            <input type="text" class="form-control IP_Qunatity_Loose" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Qunatity_Loose" placeholder="Loose" />
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Discount" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Discount" placeholder="Dis%" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control IP_Total" onkeyup="manage_total(this)" data-id="0" name="book_0_IP_Total" placeholder="Total" />
        </div>

        <div class="col-xs-1">
            <button type="button" class="btn btn-default addButton" onclick="manage_total(this)"><i class="fa fa-plus"></i></button>
        </div>
        </div>


        <?php } ?>
    

    <!-- The template for adding new field -->
    <div class="form-group hide" id="bookTemplate">

        <div class="col-xs-3 "> <!-- col-xs-offset-1 -->
        <select class="form-control" name="P_Id" data-live-search="true" onchange="get_price(this);" data-id="0" data-pack="<?php echo $value['PerPack']; ?>" >
        <option value="">Select Product</option>
        <?php foreach ($products as $key => $value) { ?>
           <option value="<?php echo $value['P_Id']; ?>" data-id="<?php echo $value['Price']; ?>" data-pack="<?php echo $value['PerPack']; ?>" data-gst="<?php echo $value['GST_Per']; ?>"><?php echo $value['ProductTitle'].' ('.$value['ProductMake'].')'; ?></option>
        <?php } ?>
        </select>
        <i class="fa fa-question-circle-o" onclick="get_info('<?php echo base_url() . 'product/modal/view_product_info/' ; ?>',this)" style="cursor: pointer"></i>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Price" onkeyup="manage_total(this)" data-id="" name="IP_Price" placeholder="Price" />
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Tax_1" onkeyup="manage_total(this)" data-id="0" name="IP_Tax_1" placeholder="%" readonly/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Tax_2" onkeyup="manage_total(this)" data-id="0" name="IP_Tax_2" placeholder="%" readonly/>
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Qunatity" onkeyup="manage_total(this)" name="IP_Qunatity" placeholder="Pack" />

            <input type="hidden" class="form-control IP_Qunatity_Total" onkeyup="manage_total(this)" name="IP_Qunatity_Total"/>

            <input type="hidden" class="form-control IP_Per_Pack" onkeyup="manage_total(this)" name="IP_Per_Pack" />

        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Qunatity_Loose" onkeyup="manage_total(this)"  name="IP_Qunatity_Loose" placeholder="Loose" />
        </div>

        <div class="col-xs-1">
            <input type="text" class="form-control IP_Discount" onkeyup="manage_total(this)" name="IP_Discount" placeholder="Dis%" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control IP_Total" onkeyup="manage_total(this)" name="IP_Total" placeholder="Total" />
        </div>

        <div class="col-xs-1">
            <button type="button" class="btn btn-danger removeButton" onclick="manage_total(this)"><i class="fa fa-minus"></i></button>
        </div>
    </div>
<hr/>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Sub Total*</label>
        <div class="col-sm-5">
        <input type="text" id="SubTotal" class="form-control" name="sub_total" placeholder="Sub Total" readonly="" value="<?php echo @$inv['sub_total']; ?>">
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Discount/Offer(<i class="fa fa-inr" aria-hidden="true"></i>)</label>
        <div class="col-sm-5">
        <select for="inputEmail3" class="col-sm-12 form-control kd_select" id="OfferType" name="OfferType" onchange="manage_total(this);" >
         <option value="">Select Offer</option>
         <option value="MRP" <?php echo @$inv['OfferType']=='MRP'? 'Selected':'';?>>On Amount</option>
         <option value="NetAmount" <?php echo @$inv['OfferType']=='NetAmount'? 'Selected':'';?>>On Net Amount</option>
        </select>
        </div>
        </div>

        <div style="display: none" id="offer_div">
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Discount/Offer Title*</label>
        <div class="col-sm-5">
        <input type="text" id="OfferTitle" name="OfferTitle" class="form-control" placeholder="Offer Title" value="<?php echo isset($inv['OfferTitle'])? $inv['OfferTitle']:'';?>">
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Discount/Offer Amount* (<i class="fa fa-inr" aria-hidden="true"></i>)*</label>
        <div class="col-sm-5">
        <input type="text" id="OfferAmount" name="OfferAmount" class="form-control" placeholder="Enter offer Amount" onkeyup="manage_total(this);" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo isset($inv['OfferAmount'])? $inv['OfferAmount']:'';?>">
        </div>
        </div>
        </div>


        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">CGST*</label>
        <div class="col-sm-5">
        <input type="text" id="Tax_1_Amount" class="form-control" name="Tax_1_Amount" placeholder="Tax Amount" readonly="" value="<?php echo @$inv['Tax_1_Amount']; ?>">
        <!-- <select class="form-control selectpicker" onchange="manage_total(this)" name="Tax_1" id="Tax_1" data-live-search="true">
        <option value="0">Select Tax</option>
        <option value="CGST-14" selected>CGST 14%</option>
        <option value="IGST-28" <?php //echo @$bill['Tax_1'] == 'IGST-28'? 'selected':''; ?>>Integrated GST (IGST 28%)</option>
        </select> -->
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label gst_option">SGST/IGST*</label>
        <div class="col-sm-5">
        <input type="text" id="Tax_2_Amount" class="form-control" name="Tax_2_Amount" placeholder="Tax Amount" readonly="" value="<?php echo @$inv['Tax_2_Amount']; ?>">
        <!-- <select class="form-control selectpicker" onchange="manage_total(this)" name="Tax_2" id="Tax_2" data-live-search="true">
        <option value="0">Select Tax Option</option>
        <option value="SGST-14" <?php// echo @$inv['Tax_2'] == 'SGST-14'? 'selected':''; ?>>State GST (SGST 14%)</option>
        <option value="IGST-14" <?php//echo @$inv['Tax_2'] == 'IGST-14'? 'selected':''; ?>>Integrated GST (IGST 14%)</option>
        </select> -->
        </div>
        </div>

        <input type="hidden" name="Tax_1" id="Tax_1" value="Central GST"/>
        <input type="hidden" name="Tax_2" id="Tax_2" value="State GST"/>

<!-- <div class="form-group">
<label for="inputEmail3" class="col-sm-7 control-label">Labour</label>
<div class="col-xs-5">
  <input type="text" class="form-control" onkeyup="manage_total(this)"  name="labour" value="<?php //echo @$inv['labour'];?>" id="labour" placeholder="Labour" />
</div>
</div> -->
<hr/>
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Net Amount(After Round Off)*</label>
        <div class="col-sm-5">
        <input type="text" id="total" class="form-control" name="total" placeholder="Net Total" readonly="" value="<?php echo @$inv['total']; ?>">
        </div>
        </div>
		
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-7 control-label">Amount To Be Paid*</label>
            <div class="col-sm-5">
                <input type="text" id="Amount_paid" class="form-control" name="Amount_paid" onkeyup="Left_balance(this)" placeholder="Amount Paid" value="<?php echo @$bill['amount_paid']; ?>" >
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-7 control-label">Amount Left</label>
            <div class="col-sm-5">
                <input type="text" id="Amount_left" class="form-control" name="Amount_left" readonly="" placeholder="Amount Left" value="<?php echo @$bill['amount_left']; ?>" >
			 <input type="hidden" id="ledger_type" class="form-control" name="ledger_type"  value="sell" >
           
		   </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-7 control-label">Payment Type</label>
            <div class="col-sm-5">
                <!--Radio group-->
					<div class="form-check">
						<input class="form-check-input" type="radio" name="payment_type" onclick="hideChequeField()" value="cash" checked >
						<label class="form-check-label" for="radio100">Cash</label>
					</div>

					<div class="form-check">
						<input class="form-check-input" type="radio" id="Cheque" class="form-control" name="payment_type" onclick="showChequeField()" value="cheque">
						<label class="form-check-label" for="radio101">Cheque</label>
					</div>
			</div>
        </div>
		
		<div class="form-group" style="display:none;" id="cheque_number">
            <label for="inputEmail3" class="col-sm-7 control-label">Cheque Number*</label>
            <div class="col-sm-5">
                <input type="text"  class="form-control" name="cheque_number" placeholder="Cheque Number" value="<?php echo @$bill['cheque_number']; ?>" >
            </div>
        </div>

    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-1">
            <button type="submit" class="btn btn-default ladda-button" data-style="expand-left"><span class="ladda-label"><?php echo isset($inv['inv_id'])? 'Update':'Submit'; ?></span></button>
        </div>
    </div>
</form>


</div>



<script>

function manage_total(o){
var tempid = $(o).data('id');
var price =  $('input[name="book_'+tempid+'_IP_Price"]').val();
var quantity =  $('input[name="book_'+tempid+'_IP_Qunatity"]').val();
var quantity_loose =  $('input[name="book_'+tempid+'_IP_Qunatity_Loose"]').val();
var discount =  $('input[name="book_'+tempid+'_IP_Discount"]').val();

var perpack =  $('input[name="book_'+tempid+'_IP_Per_Pack"]').val();

quantity_loose = quantity_loose == ''? 0:quantity_loose;

$('input[name="book_'+tempid+'_IP_Qunatity_Total"]').val((perpack*quantity)+parseInt(quantity_loose));
/*var labour =  $('#labour').val();*/
var labour = 0;
var total = 0;
var offer_amount = 0;
var offer_from = '';

if($('#OfferType option:selected').val() != ''){
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


price = price == ''? 0:price;
quantity = quantity == ''? 0:quantity;
discount = discount == ''? 0:discount;
labour = labour == ''? 0:labour;
total = (price*quantity)-(((price*quantity)*discount)/100);

var loose_price = price/perpack;

total = total+(loose_price*quantity_loose);

$('input[name="book_'+tempid+'_IP_Total"]').val(total.toFixed(2));
var sub_total = 0;
/*console.log($('.IP_Total').length);*/

//Total of all items starts here
$('.IP_Total').each(function(){
var bptotal = $(this).val() == ''? 0:$(this).val();
bptotal = parseFloat(bptotal);
sub_total = sub_total + bptotal;
})
//Total of all items ends here



//Setting sub total to textfeild
$('#SubTotal').val(sub_total.toFixed(2));

if(offer_from != '' && offer_from == 'MRP'){
sub_total = sub_total - offer_amount;
}


var tax_1 = 0
var tax_2 = 0

$('.IP_Tax_1').each(function(){
var bp_tax1 = $(this).val() == ''? 0:$(this).val();
var bp_tax1_id = $(this).data('id');
var bp_total = $('input[name="book_'+bp_tax1_id+'_IP_Total"]').val();
bp_total = (bp_total*bp_tax1)/100;
bp_tax1 = parseFloat(bp_total);
tax_1 = tax_1 + bp_tax1;
})

$('.IP_Tax_2').each(function(){
var bp_tax2 = $(this).val() == ''? 0:$(this).val();
var bp_tax2_id = $(this).data('id');
var bp_total = $('input[name="book_'+bp_tax2_id+'_IP_Total"]').val();
bp_total = (bp_total*bp_tax2)/100;
bp_tax2 = parseFloat(bp_total);
tax_2 = tax_2 + bp_tax2;
})

$('#Tax_1_Amount').val(tax_1.toFixed(2));
$('#Tax_2_Amount').val(tax_2.toFixed(2));

var grand_total = tax_1+tax_2+sub_total;

if(offer_from != '' && offer_from == 'NetAmount'){
grand_total = grand_total - offer_amount;
}

//Adding labour to amount
grand_total = grand_total + parseFloat(labour);

$('#total').val(grand_total.toFixed(2));

changeBalanceLeft();
}

function get_price(obj){
  var id = $(obj).data('id');

var price = $(obj).find(":selected").data('id');
 var gst = $(obj).find(":selected").data('gst');
$('input[name="book_'+id+'_IP_Price"]').val(price);
$('input[name="book_'+id+'_IP_Tax_1"]').val(gst/2);
$('input[name="book_'+id+'_IP_Tax_2"]').val(gst/2);

var pack = $(obj).find(":selected").data('pack');
$('input[name="book_'+id+'_IP_Per_Pack"]').val(pack);

manage_total(obj);

}

/*for calculate balance amount left */
function Left_balance(obj){
	var Total = $('#total').val();
	var Amount_paid = $('#Amount_paid').val();
	
	var left_balance = parseInt(Total)-parseInt(Amount_paid);
	$('#Amount_left').val(left_balance.toFixed(2));
}

function changeBalanceLeft(){
	
    var Total = $('#total').val();
	if(Total){
	}else{
		Total = "0";
	}
	
	var Amount_paid = $('#Amount_paid').val();
	if(Amount_paid){
	}else{
		Amount_paid = "0"
	}
	var left_balance = parseInt(Total)-parseInt(Amount_paid);
	$('#Amount_left').val(left_balance.toFixed(2));
	
	
	
}
function showChequeField(){
	$('#cheque_number').show();
}
function hideChequeField(){
	$('#cheque_number').hide();
	$('#cheque_number').val("");
}



function get_gst_option(o){
if($('#StateCode').val() == '<?php echo LOCALSTATECODE; ?>'){
    $('.gst_option').text('SGST');
    $('#Tax_2').val('State GST');
}
else
{
    $('.gst_option').text('IGST');
    $('#Tax_2').val('Integrated GST');
}
}


window.onload = function() {

var base_url = '<?php echo base_url(); ?>';
$('.selectpicker').selectpicker();
get_gst_option();
$('#OfferType').trigger('change');


    var billnoValidators = {
            row: '.col-sm-8',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The bill no is required'
                }
            }
        },

        dateValidators = {
            row: '.col-sm-12',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The invoice date is required'
                }
            }
        },
         billbyValidators = {
            row: '.col-sm-10',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The customer name is required'
                }
            }
        },

        vehicleValidators = {
            row: '.col-sm-10',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The vehicle detail is required'
                }
            }
        },

        mobileValidators = {
            row: '.col-sm-4',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The mobile is required'
                },
                numeric: {
                    message: 'The mobile must be a numeric number'
                }
            }
        },
        StateCodeValidators = {
            row: '.col-sm-3',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The state code is required'
                },
                numeric: {
                    message: 'The state code must be a numeric number'
                }
            }
        },
     productValidators = {
            row: '.col-xs-3',   // The title is placed inside a <div class="col-xs-4"> element
            excluded: false,
            validators: {
                notEmpty: {
                    message: 'The product is required'
                }
            }
        },
        priceValidators = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'The price is required'
                },
                 numeric: {
                    message: 'The price must be a numeric number'
                }
                /*isbn: {
                    message: 'The ISBN is not valid'
                }*/
            }
        },
        tax1_Validators = {
            row: '.col-xs-1',
            validators: {
                notEmpty: {
                    message: 'The tax is required'
                },
                numeric: {
                    message: 'The tax must be a numeric number'
                }
            }
        },
        tax2_Validators = {
            row: '.col-xs-1',
            validators: {
                notEmpty: {
                    message: 'The tax is required'
                },
                numeric: {
                    message: 'The tax must be a numeric number'
                }
            }
        },
        quantityValidators = {
            row: '.col-xs-1',
            validators: {
                /*notEmpty: {
                    message: 'Quantity is required'
                },*/
                numeric: {
                    message: 'Only numeric allowed'
                }
            }
        },

        loosequantityValidators = {
            row: '.col-xs-1',
            validators: {
                notEmpty: {
                    message: 'Quantity is required'
                },
                numeric: {
                    message: 'Only numeric allowed'
                }
            }
        },

         quantitytotalValidators = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'The quantity total is required'
                },
                numeric: {
                    message: 'The quantity must be a numeric number'
                }
            }
        },

        perpackValidators = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'The per pack is required'
                },
                numeric: {
                    message: 'The per pack must be a numeric number'
                }
            }
        },

        discountValidators = {
            row: '.col-xs-1',
            validators: {
                /*notEmpty: {
                    message: 'The discount is required'
                },*/
                numeric: {
                    message: 'The discount must be a numeric number'
                }
            }
        },
        labourValidators = {
            row: '.col-xs-5',
            validators: {
                /*notEmpty: {
                    message: 'The discount is required'
                },*/
                numeric: {
                    message: 'The labour charges must be a numeric number'
                }
            }
        },
        totalValidators = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'The total is required'
                },
                numeric: {
                    message: 'The total must be a numeric number'
                }
            }
        },


        subtotalValidators = {
            row: '.col-sm-5',
            validators: {
                notEmpty: {
                    message: 'The sub total is required'
                },
                numeric: {
                    message: 'The sub total must be a numeric number'
                }
            }
        },

        grandtotalValidators = {
            row: '.col-sm-5',
            validators: {
                notEmpty: {
                    message: 'The net amount is required'
                },
                numeric: {
                    message: 'The net amount must be a numeric number'
                }
            }
        },
        bookIndex = 0;

    $('#invoice_add_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon ',//glyphicon-ok
                invalid: 'glyphicon ',//glyphicon-remove
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                
                'inv_date': dateValidators,
                'cust_name': billbyValidators,
                'mobile': mobileValidators,
                'StateCode': StateCodeValidators,
                'vehicle_details': vehicleValidators,
                'book_0_P_Id': productValidators,
                'book_0_IP_Price': priceValidators,
                'book_0_IP_Tax_1': tax1_Validators,
                'book_0_IP_Tax_2': tax2_Validators,
                'book_0_IP_Qunatity': quantityValidators,
                'book_0_IP_Qunatity_Loose': loosequantityValidators,
                'book_0_IP_Qunatity_Total': quantitytotalValidators,
                'book_0_IP_Per_Pack': perpackValidators,
                'book_0_IP_Discount': discountValidators,
                'book_0_IP_Total': totalValidators,
                'sub_total': subtotalValidators,
                'total': grandtotalValidators,
                'labour':labourValidators,

            }
        })

        // Add button click handler
        .on('click' ,'.addButton', function() {
            /*bookIndex++;*/

            bookIndex = parseInt($('#item_count').val())+1;
            $('#item_count').val(parseInt($('#item_count').val())+1);

            var $template = $('#bookTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-book-index', bookIndex)
                                .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="P_Id"]').attr({'name': 'book_' + bookIndex + '_P_Id', 'data-id':bookIndex}).end()
                .find('[name="IP_Price"]').attr({'name': 'book_' + bookIndex + '_IP_Price', 'data-id':bookIndex}).end()
                .find('[name="IP_Tax_1"]').attr({'name': 'book_' + bookIndex + '_IP_Tax_1', 'data-id':bookIndex}).end()
                .find('[name="IP_Tax_2"]').attr({'name': 'book_' + bookIndex + '_IP_Tax_2', 'data-id':bookIndex}).end()
                /*.find('[name="IP_Price"]').attr('data-id',  bookIndex ).end()*/
                .find('[name="IP_Qunatity"]').attr({'name': 'book_' + bookIndex + '_IP_Qunatity', 'data-id':bookIndex}).end()

                .find('[name="IP_Qunatity_Loose"]').attr({'name': 'book_' + bookIndex + '_IP_Qunatity_Loose', 'data-id':bookIndex}).end()

                .find('[name="IP_Qunatity_Total"]').attr({'name': 'book_' + bookIndex + '_IP_Qunatity_Total', 'data-id':bookIndex}).end()

                .find('[name="IP_Per_Pack"]').attr({'name': 'book_' + bookIndex + '_IP_Per_Pack', 'data-id':bookIndex}).end()

                .find('[name="IP_Discount"]').attr({'name': 'book_' + bookIndex + '_IP_Discount', 'data-id':bookIndex}).end()
                .find('[name="IP_Total"]').attr({'name': 'book_' + bookIndex + '_IP_Total', 'data-id':bookIndex}).end();
				$('select[name="book_' + bookIndex + '_P_Id"]').selectpicker('refresh');
            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            $('#invoice_add_form')
                .formValidation('addField', 'book_' + bookIndex + '_P_Id', productValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Price', priceValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Tax_1', tax1_Validators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Tax_2', tax2_Validators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Qunatity', quantityValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Qunatity_Loose', loosequantityValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Qunatity_Total', quantitytotalValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Per_Pack', perpackValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Discount', discountValidators)
                .formValidation('addField', 'book_' + bookIndex + '_IP_Total', totalValidators);

        })

        // Remove button click handler
        .on('click', '.removeButton', function() {

            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');
               /* $('#item_count').val(parseInt($('#item_count').val())-1);*/

            // Remove fields
            $('#invoice_add_form')
                .formValidation('removeField', $row.find('[name="book_' + index + '_P_Id"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Price"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Tax_1"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Tax_2"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Qunatity"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Qunatity_Loose"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Qunatity_Total"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Per_Pack"]'))
                .formValidation('removeField', $row.find('[name="book[' + index + '].IP_Discount"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_IP_Total"]'));

            // Remove element containing the fields
            $row.remove();
            manage_total();
        })
        .on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var l = Ladda.create( document.querySelector( '.ladda-button' ) );
                l.start();
        $.post('<?php echo base_url("invoice/add_invoice"); ?>', $(this).serialize(),function(data){
            l.stop();
            $form.formValidation('disableSubmitButtons', false);
            if(data.result == 'unauth') {
              window.location.replace(base_url+"Welcome");
            }else if(data.result == 'success'){
                $('#invoice_add_form')[0].reset();
                $.toaster({ priority : data.result, title : data.title, message : data.message});
                setInterval(function(){window.location.replace(base_url+"invoice/manageinvoice");},2000);
            }else{
                $.toaster({ priority : data.result, title : data.title, message : data.message});
            }
        },'json')
            })



};

  function get_info(url,obj){

    var sel_value = $(obj).parent().find('select').find(':selected').val();
    if(sel_value != ''){
 
    $.ajax({
            url: url+sel_value,
            type: 'post',
            success: function (data) {
                $('#myModal').find('.modal-body').html(data);
            }
        });
    $('#myModal').modal('show');
  }
  else{
    alert('Please select a product first.');
  }

  }     
</script>
