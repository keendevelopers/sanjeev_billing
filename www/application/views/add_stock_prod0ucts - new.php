<!-- Start right Content here -->
<!-- ============================================================== -->
<style type="text/css">
  .kd-align-left{
    text-align: left!important;
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
<h4 class="page-title"><?php echo isset($bill['BillId'])? 'Update':'Add'; ?> Buyed Products</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>Welcome">Dashboard</a></li>
<li><a href="<?php echo base_url();?>product/manage_stock" >Manage Stock</a></li>
<li><a href="#" class="active"><?php echo isset($bill['BillId'])? 'Update':'Add'; ?> New Stock</a></li>
</ol>
</div>
</div>
<div class="row">



<div class="col-lg-12">



<div class="card-box">

<h4 class="m-t-0 header-title"><b><?php echo isset($bill['BillId'])? 'Update':'Add New'; ?> Stock</b></h4>

<p class="text-muted font-13 m-b-30">

Enter Stock Details

</p>

<?php $msgsuccess   =$this->session->flashdata('message');
$errormessage =$this->session->flashdata('error');
?>




<form id="product_add_form" method="post" class="form-horizontal">

<input type="hidden" name="BillId" id="BillId" value="<?php echo @$bill['BillId']; ?>">
<div class="form-group">
<div class="col-sm-6">
<label for="inputEmail3" class="col-sm-4 control-label">Bill No*</label>
<div class="col-sm-8">
<input type="text" id="BillNo" name="BillNo" class="form-control" placeholder="Bill Number"  value="<?php echo @$bill['BillNo']; ?>"  >
</div>
</div>

<div class=" col-sm-6 ">
<label for="inputEmail3" class="col-sm-4 control-label">Purchased Date*</label>
<div class="col-sm-8">
<input type="text" id="PurchasedOn" class="form-control flatpickr" name="PurchasedOn" placeholder="Purchased Date"  value="<?php echo isset($bill['PurchasedOn'])? date('d-m-Y', strtotime($bill['PurchasedOn'])): ''; ?>"  >
</div>
</div>
</div>


<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Billing By*</label>
<div class="col-sm-10">
<input type="text" id="BillBy" class="form-control" name="BillBy" placeholder="Name of distributor" value="<?php echo @$bill['BillBy']; ?>">
</div>
</div>

<hr/>
    
    <div class="form-group">
        <label class="col-xs-3 control-label kd-align-left">Product</label>
        <label class="col-xs-2 control-label kd-align-left">Price</label>
        <label class="col-xs-2 control-label kd-align-left">Quantity</label>
        <label class="col-xs-2 control-label kd-align-left">Discount(%)</label>
        <label class="col-xs-2 control-label kd-align-left">Total</label>
        <label class="col-xs-1 control-label kd-align-left"></label>
          </div>
        <?php if(isset($bill['BillId']) && $bill['BillId'] != ''){ ?>
        <input type="hidden" name="item_count" id="item_count" value="<?php echo count($bill_products)-1; ?>">
         <input type="hidden" name="item_count_1" id="item_count_1" value="<?php echo count($bill_products)-1; ?>">
       <?php foreach ($bill_products as $k => $val) { ?>
        <div class="form-group">
        

        <div class="col-xs-3">
        <select class="form-control selectpicker" name="book_<?php echo $k; ?>_P_Id" data-live-search="true" onchange="get_per_pack(this)" data-id="<?php echo $k; ?>">
        <option value="">Select Product</option>
        <?php foreach ($products as $key => $value) { 
            $select = '';
            if($val['P_Id'] == $value['P_Id']){
                $select = 'selected';
            }
            ?>
           <option value="<?php echo $value['P_Id']; ?>" data-pack="<?php echo $value['PerPack']; ?>" <?php echo $select; ?>><?php echo $value['ProductTitle'].' ('.$value['ProductCode'].')'; ?></option>
        <?php } ?>
        </select>
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Price" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_BP_Price" placeholder="Price" value="<?php echo $val['BP_Price']; ?>"/>
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Qunatity" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_BP_Qunatity" placeholder="Qnt" value="<?php echo $val['BP_Qunatity']; ?>"/>

            <input type="hidden" class="form-control BP_Qunatity_Total" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_BP_Qunatity_Total" placeholder="Qnt" value="<?php echo $val['BP_Qunatity_Total']; ?>"/>

            <input type="hidden" class="form-control BP_Per_Pack" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_BP_Per_Pack" placeholder="Qnt" value="<?php echo $val['BP_Per_Pack']; ?>"/>

        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Discount" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_BP_Discount" placeholder="Discount(%)" value="<?php echo $val['BP_Discount']; ?>"/>
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Total" onkeyup="manage_total(this)" data-id="<?php echo $k; ?>" name="book_<?php echo $k; ?>_BP_Total" placeholder="Total" value="<?php echo $val['BP_Total']; ?>"/>
        </div>
        <?php if($k == 0){ ?>
        <div class="col-xs-1">
            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
        </div>
        <?php } else{ ?>
        <div class="col-xs-1">
            <button type="button" class="btn btn-danger removeButton"><i class="fa fa-minus"></i></button>
        </div>
        <?php } ?>
        </div>

        <?php } } else { ?>
        <input type="hidden" name="item_count" id="item_count" value="0">
        <input type="hidden" name="item_count_1" id="item_count_1" value="0">
        <div class="form-group">
        <!-- <label class="col-xs-1 control-label">Items</label> -->
        <div class="col-xs-3">
        <select class="form-control selectpicker" name="book_0_P_Id" data-live-search="true" onchange="get_per_pack(this)"  data-id="0">
        <option value="">Select Product</option>
        <?php foreach ($products as $key => $value) { ?>
           <option value="<?php echo $value['P_Id']; ?>" data-pack="<?php echo $value['PerPack']; ?>"><?php echo $value['ProductTitle'].' ('.$value['ProductCode'].')'; ?></option>
        <?php } ?>
        </select>
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Price" onkeyup="manage_total(this)" data-id="0" name="book_0_BP_Price" placeholder="Price" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Qunatity" onkeyup="manage_total(this)" data-id="0" name="book_0_BP_Qunatity" placeholder="Qnt" />

            <input type="hidden" class="form-control BP_Qunatity_Total" onkeyup="manage_total(this)" data-id="0" name="book_0_BP_Qunatity_Total" placeholder="Qnt"/>

            <input type="hidden" class="form-control BP_Per_Pack" onkeyup="manage_total(this)" data-id="0" name="book_0_BP_Per_Pack" placeholder="Qnt" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Discount" onkeyup="manage_total(this)" data-id="0" name="book_0_BP_Discount" placeholder="Discount(%)" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Total" onkeyup="manage_total(this)" data-id="0" name="book_0_BP_Total" placeholder="Total" />
        </div>

        <div class="col-xs-1">
            <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
        </div>
        </div>
        <?php } ?>
    

    <!-- The template for adding new field -->
    <div class="form-group hide" id="bookTemplate">

        <div class="col-xs-3">
        <select class="form-control" name="P_Id" data-live-search="true" onchange="get_per_pack(this)" data-id="0">
        <option value="">Select Product</option>
        <?php foreach ($products as $key => $value) { ?>
           <option value="<?php echo $value['P_Id']; ?>" data-pack="<?php echo $value['PerPack']; ?>"><?php echo $value['ProductTitle'].' ('.$value['ProductCode'].')'; ?></option>
        <?php } ?>
        </select>
        
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Price" onkeyup="manage_total(this)" data-id="" name="BP_Price" placeholder="Price" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Qunatity" onkeyup="manage_total(this)" name="BP_Qunatity" placeholder="Qnt" />

            <input type="hidden" class="form-control BP_Qunatity_Total" onkeyup="manage_total(this)" name="BP_Qunatity_Total" placeholder="Qnt"/>

            <input type="hidden" class="form-control BP_Per_Pack" onkeyup="manage_total(this)" name="BP_Per_Pack" placeholder="Qnt" />

        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Discount" onkeyup="manage_total(this)" name="BP_Discount" placeholder="Discount(%)" />
        </div>

        <div class="col-xs-2">
            <input type="text" class="form-control BP_Total" onkeyup="manage_total(this)" name="BP_Total" placeholder="Total" />
        </div>

        <div class="col-xs-1">
            <button type="button" class="btn btn-danger removeButton"><i class="fa fa-minus"></i></button>
        </div>
    </div>
<hr/>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Sub Total*</label>
        <div class="col-sm-5">
        <input type="text" id="SubTotal" class="form-control" name="SubTotal" placeholder="Sub Total" readonly="" value="<?php echo @$bill['SubTotal']; ?>">
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Central CGST*</label>
        <div class="col-sm-5">
        <input type="text" id="Tax_1_Amount" class="form-control" name="Tax_1_Amount" placeholder="Tax Amount"  value="<?php echo @$bill['Tax_1_Amount']; ?>" onkeyup="manage_total(this)">
       <!--  <select class="form-control select2" onchange="manage_total(this)" name="Tax_1" id="Tax_1" data-live-search="true">
        <option value="0">Select Tax</option>
        <option value="CGST-14" selected>CGST 14%</option>
        <option value="IGST-28" <?php //echo @$bill['Tax_1'] == 'IGST-28'? 'selected':''; ?>>Integrated GST (IGST 28%)</option>
        </select> -->
        </div>
        </div>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">State GST*</label>
        <div class="col-sm-5">
        <input type="text" id="Tax_2_Amount" class="form-control" name="Tax_2_Amount" placeholder="Tax Amount"  value="<?php echo @$bill['Tax_2_Amount']; ?>" onkeyup="manage_total(this)">
        <!-- <select class="form-control select2" onchange="manage_total(this)" name="Tax_2" id="Tax_2" data-live-search="true">
        <option value="0">Select Tax Option</option>
        <option value="SGST-14" <?php //echo @$bill['Tax_2'] == 'SGST-14'? 'selected':''; ?>>State GST (SGST 14%)</option>
        <option value="IGST-14" <?php //echo @$bill['Tax_2'] == 'IGST-14'? 'selected':''; ?>>Integrated GST (IGST 14%)</option>
        </select> -->
        </div>
        </div>

        <input type="hidden" name="Tax_1" id="Tax_1" value="Central CGST"/>
        <input type="hidden" name="Tax_2" id="Tax_2" value="State CGST"/>

        <div class="form-group">
        <label for="inputEmail3" class="col-sm-7 control-label">Net Amount(After Round Off)*</label>
        <div class="col-sm-5">
        <input type="text" id="Total" class="form-control" name="Total" placeholder="Net Total" readonly="" value="<?php echo @$bill['Total']; ?>">
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
			 <input type="hidden" id="ledger_type" class="form-control" name="ledger_type"  value="buy" >
           
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
            <button type="submit" class="btn btn-default ladda-button" data-style="expand-left"><span class="ladda-label"><?php echo isset($bill['BillId'])? 'Update':'Submit'; ?></span></button>
        </div>
    </div>
</form>


</div>

</div>

</div>

</div>


<script>
function manage_total(o){
var tempid = $(o).data('id');
var price =  $('input[name="book_'+tempid+'_BP_Price"]').val();
var quantity =  $('input[name="book_'+tempid+'_BP_Qunatity"]').val();
var discount =  $('input[name="book_'+tempid+'_BP_Discount"]').val();
var perpack =  $('input[name="book_'+tempid+'_BP_Per_Pack"]').val();

$('input[name="book_'+tempid+'_BP_Qunatity_Total"]').val(perpack*quantity);

var total = 0;

price = price == ''? 0:price;
quantity = quantity == ''? 0:quantity;
discount = discount == ''? 0:discount;
total = (price*quantity)-(((price*quantity)*discount)/100);
$('input[name="book_'+tempid+'_BP_Total"]').val(total);
var sub_total = 0;
/*console.log($('.BP_Total').length);*/
$('.BP_Total').each(function(){

var bptotal = $(this).val() == ''? 0:$(this).val();
bptotal = parseFloat(bptotal);
sub_total = sub_total + bptotal;
})
$('#SubTotal').val(sub_total.toFixed(2));

var tax_1 = parseFloat($('#Tax_1_Amount').val() == '' ? 0:$('#Tax_1_Amount').val());
var tax_2 = parseFloat($('#Tax_2_Amount').val()== '' ? 0:$('#Tax_2_Amount').val());
/*tax_1 = parseFloat(tax_1.replace ( /[^\d.]/g, '' ), 10);
tax_2 = parseFloat(tax_2.replace ( /[^\d.]/g, '' ), 10);
tax_1 = (tax_1*sub_total)/100;
tax_2 = (tax_2*sub_total)/100;*/

var grand_total = tax_1+tax_2+sub_total;

$('#Total').val(grand_total.toFixed(2));

changeBalanceLeft();
}

function get_per_pack(obj){
  var id = $(obj).data('id');

var pack = $(obj).find(":selected").data('pack');
/* var gst = $(obj).find(":selected").data('gst');*/
$('input[name="book_'+id+'_BP_Per_Pack"]').val(pack);
/*$('input[name="book_'+id+'_IP_Tax_1"]').val(gst/2);
$('input[name="book_'+id+'_IP_Tax_2"]').val(gst/2);*/

manage_total(obj);

}
/*for calculate balance amount left ----- PAWAN*/
function Left_balance(obj){
	var Total = $('#Total').val();
	var Amount_paid = $('#Amount_paid').val();
	
	var left_balance = parseInt(Total)-parseInt(Amount_paid);
	$('#Amount_left').val(left_balance.toFixed(2));
}

function changeBalanceLeft(){
	
    var Total = $('#Total').val();
	if(Total){
	}else{
		Total = "0";
	}
	
	var Amount_paid = $('#Amount_paid').val();
	if(Amount_paid){
	}else{
		Amount_paid = "0";
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
//end
window.onload = function() {
var base_url = '<?php echo base_url(); ?>';
$('.selectpicker').selectpicker();



    var billnoValidators = {
            row: '.col-sm-8',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The bill no is required'
                }
            }
        },

        dateValidators = {
            row: '.col-sm-8',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The purchase date is required'
                }
            }
        },
         billbyValidators = {
            row: '.col-sm-10',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'The billing by is required'
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
        quantityValidators = {
            row: '.col-xs-2',
            validators: {
                notEmpty: {
                    message: 'The quantity is required'
                },
                numeric: {
                    message: 'The quantity must be a numeric number'
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
            row: '.col-xs-2',
            validators: {
               /* notEmpty: {
                    message: 'The discount is required'
                },*/
                numeric: {
                    message: 'The discount must be a numeric number'
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
        Tax_1_Validators = {
            row: '.col-sm-5',
            validators: {
                notEmpty: {
                    message: 'The tax amount is required'
                },
                numeric: {
                    message: 'The tax amount must be a numeric number'
                }
            }
        },
        Tax_2_Validators = {
            row: '.col-sm-5',
            validators: {
                notEmpty: {
                    message: 'The tax amount is required'
                },
                numeric: {
                    message: 'The tax amount must be a numeric number'
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

    $('#product_add_form')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'BillNo': billnoValidators,
                'PurchasedOn': dateValidators,
                'BillBy': billbyValidators,
                'book_0_P_Id': productValidators,
                'book_0_BP_Price': priceValidators,
                'book_0_BP_Qunatity': quantityValidators,
                'book_0_BP_Qunatity_Total': quantitytotalValidators,
                'book_0_BP_Per_Pack': perpackValidators,
                'book_0_BP_Discount': discountValidators,
                'book_0_BP_Total': totalValidators,
                'SubTotal': subtotalValidators,
                'Tax_2_Amount': Tax_2_Validators,
                'Tax_1_Amount': Tax_1_Validators,
                'Total': grandtotalValidators,
                

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
                .find('[name="BP_Price"]').attr({'name': 'book_' + bookIndex + '_BP_Price', 'data-id':bookIndex}).end()
                /*.find('[name="BP_Price"]').attr('data-id',  bookIndex ).end()*/
                .find('[name="BP_Qunatity"]').attr({'name': 'book_' + bookIndex + '_BP_Qunatity', 'data-id':bookIndex}).end()

                .find('[name="BP_Qunatity_Total"]').attr({'name': 'book_' + bookIndex + '_BP_Qunatity_Total', 'data-id':bookIndex}).end()

                .find('[name="BP_Per_Pack"]').attr({'name': 'book_' + bookIndex + '_BP_Per_Pack', 'data-id':bookIndex}).end()


                .find('[name="BP_Discount"]').attr({'name': 'book_' + bookIndex + '_BP_Discount', 'data-id':bookIndex}).end()
                .find('[name="BP_Total"]').attr({'name': 'book_' + bookIndex + '_BP_Total', 'data-id':bookIndex}).end();
                $('select[name="book_' + bookIndex + '_P_Id"]').selectpicker('refresh');
            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            $('#product_add_form')
                .formValidation('addField', 'book_' + bookIndex + '_P_Id', productValidators)
                .formValidation('addField', 'book_' + bookIndex + '_BP_Price', priceValidators)
                .formValidation('addField', 'book_' + bookIndex + '_BP_Qunatity', quantityValidators)
                .formValidation('addField', 'book_' + bookIndex + '_BP_Qunatity_Total', quantitytotalValidators)
                .formValidation('addField', 'book_' + bookIndex + '_BP_Per_Pack', perpackValidators)
                .formValidation('addField', 'book_' + bookIndex + '_BP_Discount', discountValidators)
                .formValidation('addField', 'book_' + bookIndex + '_BP_Total', totalValidators);
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');
              

            // Remove fields
            $('#product_add_form')
                .formValidation('removeField', $row.find('[name="book_' + index + '_P_Id"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_BP_Price"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_BP_Qunatity"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_BP_Qunatity_Total"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_BP_Per_Pack"]'))
                .formValidation('removeField', $row.find('[name="book[' + index + '].BP_Discount"]'))
                .formValidation('removeField', $row.find('[name="book_' + index + '_BP_Total"]'));

            // Remove element containing the fields
            $row.remove();
            manage_total();
        })
        .on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target);
                var l = Ladda.create( document.querySelector( '.ladda-button' ) );
                l.start();
        $.post('<?php echo base_url("product/add_stock_products"); ?>', $(this).serialize(),function(data){
            l.stop();
            $form.formValidation('disableSubmitButtons', false);
            if(data.result == 'unauth') {
              window.location.replace(base_url+"Welcome");
            }else if(data.result == 'success'){
                $('#product_add_form')[0].reset();
                $.toaster({ priority : data.result, title : data.title, message : data.message});
                setInterval(function(){window.location.replace(base_url+"product/manage_stock");},2000);
            }else{
                $.toaster({ priority : data.result, title : data.title, message : data.message});
            }
        },'json')
            })

       

};
</script>
