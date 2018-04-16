
    <link href="<?php echo base_url();?>assets/css/css.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/invoicegenerator.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <div class="b-div">
        <div class="body-div">

            <div class="main-div1">
							

              <div class="col-md-12 lft-main-div">
							<form id="invoiceGenerator" class="inv-generator">
                    <div>
                    
                        <ul style="width:100%;margin-top:50px;">
                            <li class="adr-lft">
                               <span><b>Bill To:</b></span>
                                <br>
                                <input id="billingAddress1"  class="adr" tabindex="6" placeholder="Customer Name (M/s)" onfocus="InvoiceGenerator.strikeInfo('clientAddInfo', true); InvoiceGenerator.showHideErr('billingAddress1', false);" onblur="InvoiceGenerator.strikeInfo('clientAddInfo', false)" name="customer_name" data-json-node="customer_name" data-is-array="false" type="text" required="" value="<?php echo isset($editrecord['cust_name'])? $editrecord['cust_name']:''; ?>">
															<small id="billingAddress1_err" class="text-danger hide">Please fill in your client’s name or their company name</small>
                                <br>
                                <input id="billingAddress2" class="adr" tabindex="7" placeholder="VRN no" onfocus="InvoiceGenerator.strikeInfo('clientAddInfo', true)" onblur="InvoiceGenerator.strikeInfo('clientAddInfo', false)" name="vrn_no" data-json-node="customer_billing_address_1" data-is-array="false" type="text" value="<?php echo isset($editrecord['vrn'])? $editrecord['vrn']:''; ?>">
                                
                                <br>
                            </li>
                            <li class="adr-rgt">
                                <table class="bill"  style="table-layout: fixed" width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td class="lft-txt" width="40%">
<p><b>Invoice# :</b></p>

                                             <!--    <input value="Invoice#" disabled id="invNumberLabel" class="bld text-left w100" tabindex="12" onfocus="InvoiceGenerator.strikeInfo('invNumberInfo', true)" onblur="InvoiceGenerator.strikeInfo('invNumberInfo', false)" name="invoice_number_label" data-json-node="invoice_number_label" data-is-array="false" type="text" > -->
                                            </td>
                                            <td>
                                                <input class="w100"  id="invNumber" tabindex="13" placeholder="INV-12" onfocus="InvoiceGenerator.strikeInfo('invNumberInfo', true)" onblur="InvoiceGenerator.strikeInfo('invNumberInfo', false)" name="invoice_number" data-json-node="invoice_number" data-is-array="false" type="text" <?php echo isset($record)? '':'readonly=""';?> required="" value="<?php echo isset($editrecord['inv_id'])? $editrecord['inv_id']:''; ?>">
                                            </td>
                                        </tr>
                                        <tr>



                                            <td class="lft-txt">
                                             <p><b>Invoice Date:</b></p>
                                            </td>
                                            <td>


                                                        <div class="form-group">
                                                  
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="invoice_date" placeholder="DD/MM/YYYY" id="datepicker-autoclose" value="<?php echo isset($editrecord['inv_date'])? date('d-m-Y',strtotime($editrecord['inv_date'])):date('d-m-Y'); ?>" required>
                                                        <!--         <a class="input-group-addon bg-custom b-0 text-white" ><i class="icon-calender"></i></a> -->
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>


                                      <!--<input class="w100" id="invoiceDate" tabindex="15" placeholder="Feb 24, 2017" onfocus="InvoiceGenerator.strikeInfo('invNumberInfo', true)" onblur="InvoiceGenerator.strikeInfo('invNumberInfo', false)" name="invoice_date" data-json-node="invoice_date" data-is-array="false" type="text" required="" value="<?php echo isset($editrecord['inv_date'])? $editrecord['inv_date']:''; ?>">-->
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </li>
                        </ul>
                    </div>
                    <div class="lineItemDIV">
                        <table class="column" style="table-layout: fixed" width="100%" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr class="hd">
                                    <td width="40%">
                                        <input style="text-align:left;" id="itemDescLabel" value="Item Description" class="bld w100" tabindex="19" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="name" data-json-node="name" data-is-array="false" data-parent-json="line_items_header" type="text" readonly>
                                    </td>
                                    <td width="17%">
                                        <input value="Qty" id="itemQtyLabel" class="bld w100" tabindex="19" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="quantity" data-json-node="quantity" data-is-array="false" data-parent-json="line_items_header" type="text" readonly>
                                    </td>
                                     <td width="8%">
                                        <input value="Type" id="itemtypLabel" class="bld w100" tabindex="19" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemtype" data-json-node="item_type" data-is-array="false" data-parent-json="line_items_header" type="text" readonly>
                                    </td>
                                    <td width="17%">
                                        <input value="Rate" id="itemRateLabel" class="bld w100 text-left" tabindex="19" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="rate" data-json-node="rate" data-is-array="false" data-parent-json="line_items_header" type="text" readonly>
                                    </td>
                                    <td width="18%">
                                        <input value="Amount" id="itemAmtLabel" class="bld w100 text-right" style="text-align:right;" tabindex="19" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="amount" data-json-node="amount" data-is-array="false" data-parent-json="line_items_header" type="text" readonly>
                                    </td>
                                    <td style="border-bottom:none;background:none;border-top:none" class="dele-icon" width="2%">&nbsp;</td>
                                </tr>
                            </thead>

                            <tbody class="lineItems">
                                <tr class="row-item trClone hide" id="lineItem.0" onclick="InvoiceGenerator.strikeInfo('itemInfo', true)" onmouseover="javascript:CreateInvoiceUtil.showCloseIcon(this,true)" onmouseout="javascript:CreateInvoiceUtil.showCloseIcon(this,false)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)">
                                    <td>
                                        <textarea type="text" class="w100" tabindex="20" id="itemDesc.0" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onkeypress="javascript:CreateInvoiceUtil.checkAndAddNewLineItem(this, event)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" placeholder="Enter item name/description" name="itemDesc.0" data-json-node="name" data-is-array="true" data-array-parent="line_items"></textarea>
                                    </td>
                                    <td>
                                        <input class="w100 text-right qty_here" value="1" tabindex="20" id="itemQty.0" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.0" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="number" min="1">
                                    </td>

                                    <td>
                                        <input class="w100 text-right" value="" tabindex="20" id="itemTyp.0" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemTyp.0" data-json-node="item_type" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>

                                   <!--   <td>
                                    <i style="cursor:pointer" class="fa fa-minus-circle minus" aria-hidden="true" id="minus1"></i>
                                        <input style="width: 75%;text-align: center;" class="w100 text-right qty_here" value="1" tabindex="20" id="itemQty.0" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.0" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="text" min="1">
                                         <i style="cursor:pointer" class="fa fa-plus-circle add2" aria-hidden="true" id="add1"></i>
                                    </td> -->
                                    <td>
                                        <input class="w100 text-right" value="0.00" tabindex="20" id="itemRate.0" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemRate.0" data-json-node="rate" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>
                                    <td>
                                        <input readonly class="cursor-disabled w100 text-right" id="itemTotal.0" title="Amount is calculated automatically." name="itemTotal.0" data-json-node="amount" data-is-array="true" data-array-parent="line_items" value="0.00">
                                    </td>

                             <!--        <td style="border-bottom:none;background:none;border-top:none" class="dele-icon">
                                        <div style="padding-top:4px"><a class="closeicon hide" style="cursor:pointer" title="Delete Row" id="itemClose.0" onclick="javascript:CreateInvoiceUtil.removeLineItem(this)"><span class="del pull-left"></span></a>
                                        </div>
                                    </td> -->
                                </tr>

                                <?php $count = 1;?>
 <input type="hidden" value="<?php echo isset($editrecord['inv_id'])? $editrecord['inv_id']:''; ?>" name="invoice_id" >
                                <?php if(isset($items)){ foreach ($items as $key => $value) { ?>
                                  <tr class ="row-item " id="lineItem.<?php echo $count; ?>" onclick="InvoiceGenerator.strikeInfo('itemInfo', true)" onmouseover="javascript:CreateInvoiceUtil.showCloseIcon(this,true)" onmouseout="javascript:CreateInvoiceUtil.showCloseIcon(this,false)">
                                    <td>
                                        <textarea type="text" class="w100" tabindex="21" id="itemDesc.<?php echo $count; ?>" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" placeholder="Enter item name/description" onkeypress="javascript:CreateInvoiceUtil.checkAndAddNewLineItem(this, event)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemDesc.<?php echo $count; ?>" data-json-node="name" data-is-array="true" data-array-parent="line_items" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 42px;"><?php echo $value['p_name']; ?></textarea>
                                    </td>
                                    <td>
                                        <input class="w100 text-right qty_here" taxLabel="0" tabindex="21" id="itemQty.<?php echo $count; ?>" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.<?php echo $count; ?>" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="number" min="1" value="<?php echo $value['p_qnt']; ?>">
                                    </td>

                                    <td>
                                        <input class="w100 text-right" value="<?php echo $value['p_type']; ?>" tabindex="21" id="itemTyp.<?php echo $count; ?>" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemTyp.<?php echo $count; ?>" data-json-node="item_type" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>


                                      <!-- <td>
                                    <i style="cursor:pointer" class="fa fa-minus-circle minus" aria-hidden="true" id="minus1"></i>
                                        <input style="width: 75%;text-align: center;" class="w100 text-right qty_here" taxLabel="0" tabindex="21" id="itemQty.<?php echo $count; ?>" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.<?php echo $count; ?>" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="number" min="1" value="<?php echo $value['p_qnt']; ?>">
                                    <i style="cursor:pointer" class="fa fa-plus-circle add2" aria-hidden="true" id="add1"></i>
                                    </td> -->


                                    <td>
                                        <input class="w100 text-right" value="<?php echo $value['p_rate']; ?>" tabindex="21" id="itemRate.<?php echo $count; ?>" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemRate.<?php echo $count; ?>" data-json-node="rate" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>
                                    <td>
                                        <input readonly class="cursor-disabled w100 text-right" id="itemTotal.<?php echo $count; ?>" title="Amount is calculated automatically." name="itemTotal.<?php echo $count; ?>" data-json-node="amount" data-is-array="true" data-array-parent="line_items" value="<?php echo $value['p_amount']; ?>">
                                    </td>

                                  <!--   <td style="border-bottom:none;background:none;border-top:none" class="dele-icon">
                                        <div style="padding-top:4px"><a class="closeicon hide" title="Delete Row" id="itemClose.<?php echo $count; ?>" style="cursor:pointer;" onclick="javascript:CreateInvoiceUtil.removeLineItem(this)"><span class="del pull-left">&nbsp;</span></a> </div>
                                    </td> -->
                                </tr>
                               <?php $count++; } }else{?>
                                <tr class ="row-item " id="lineItem.1" onclick="InvoiceGenerator.strikeInfo('itemInfo', true)" onmouseover="javascript:CreateInvoiceUtil.showCloseIcon(this,true)" onmouseout="javascript:CreateInvoiceUtil.showCloseIcon(this,false)">
                                    <td>
                                        <textarea type="text" class="w100" tabindex="21" id="itemDesc.1" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" placeholder="Enter item name/description" onkeypress="javascript:CreateInvoiceUtil.checkAndAddNewLineItem(this, event)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemDesc.1" data-json-node="name" data-is-array="true" data-array-parent="line_items" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 42px;" required></textarea>
                                    </td>
                                 <!--    <td>
     
                                 <i style="cursor:pointer" class="fa fa-minus-circle minus" aria-hidden="true" id="minus1"></i>

                                        <input style="width: 75%;text-align: center;" class="w100 qty_here text-right" taxLabel="0" tabindex="21" id="itemQty.1" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.1" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="text" min="1" value="0">
          
                               <i style="cursor:pointer" class="fa fa-plus-circle add2" aria-hidden="true" id="add1"></i>

                                    </td> -->
                                   
                                      <td>
                                        <input  class="w100 qty_here text-right" taxLabel="0" tabindex="21" id="itemQty.1" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.1" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="number" min="1" value="0">
                                    </td>

                                    <td>
                                        <input class="w100 text-right" value="" tabindex="21" id="itemTyp.1" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemTyp.1" data-json-node="item_type" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>

                                    <td>
                                        <input class="w100 text-right" placeholder="0.0" tabindex="21" id="itemRate.1" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this);InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemRate.1" data-json-node="rate" data-is-array="true" data-array-parent="line_items" type="text" required >
                                    </td>
                                    <td>
                                        <input readonly class="cursor-disabled w100 text-right" id="itemTotal.1" title="Amount is calculated automatically." name="itemTotal.1" data-json-node="amount" data-is-array="true" data-array-parent="line_items" value="0.00" required>
                                    </td>

                                <!--     <td style="border-bottom:none;background:none;border-top:none" class="dele-icon">
                                        <div style="padding-top:4px"><a class="closeicon hide" title="Delete Row" id="itemClose.1" style="cursor:pointer;" onclick="javascript:CreateInvoiceUtil.removeLineItem(this)"><span class="del pull-left">&nbsp;</span></a> </div>
                                    </td> -->
                                </tr>
                                <?php } ?>
                              <!--   <tr class="row-item  " id="lineItem.2" onclick="InvoiceGenerator.strikeInfo('itemInfo', true)" onmouseover="javascript:CreateInvoiceUtil.showCloseIcon(this,true)" onmouseout="javascript:CreateInvoiceUtil.showCloseIcon(this,false)">
                                    <td>
                                        <textarea type="text" class="w100" id="itemDesc.2" tabindex="22" placeholder="Enter item name/description" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onkeypress="javascript:CreateInvoiceUtil.checkAndAddNewLineItem(this, event)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemDesc.2" data-json-node="name" data-is-array="true" data-array-parent="line_items" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 42px;"></textarea>
                                    </td>
                                    <td>
                                        <input value="1" class="w100 text-right" id="itemQty.2" tabindex="22" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this); InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.2" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>
                                    <td>
                                        <input class="w100 text-right" value="0.00" id="itemRate.2" tabindex="22" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this); InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemRate.2" data-json-node="rate" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>
                                    <td>
                                        <input readonly class="cursor-disabled w100 text-right" id="itemTotal.2" title="Amount is calculated automatically." name="itemTotal.2" data-json-node="amount" data-is-array="true" data-array-parent="line_items" value="0.00">
                                    </td>

                                    <td style="border-bottom:none;background:none;border-top:none" class="dele-icon">
                                        <div style="padding-top:4px"><a class="closeicon hide" id="itemClose.2" title="Delete Row" style="cursor:pointer;text-decoration:underline;color:#DE7110" onclick="javascript:CreateInvoiceUtil.removeLineItem(this)"><span class="del pull-left">&nbsp;</span></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="row-item  " onclick="InvoiceGenerator.strikeInfo('itemInfo', true)" id="lineItem.3" onmouseover="javascript:CreateInvoiceUtil.showCloseIcon(this,true)" onmouseout="javascript:CreateInvoiceUtil.showCloseIcon(this,false)">

                                    <td>
                                        <textarea type="text" class="w100 lastLineItem" tabindex="23" placeholder="Enter item name/description" onkeypress="javascript:CreateInvoiceUtil.checkAndAddNewLineItem(this, event)" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="InvoiceGenerator.strikeInfo('itemInfo', false)" id="itemDesc.3" name="itemDesc.3" data-json-node="name" data-is-array="true" data-array-parent="line_items" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 42px;"></textarea>
                                    </td>
                                    <td>
                                        <input class="w100 text-right" value="1" id="itemQty.3" tabindex="23" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this); InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemQty.3" data-json-node="quantity" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>
                                    <td>
                                        <input class="w100 text-right" value="0.00" id="itemRate.3" tabindex="23" onfocus="InvoiceGenerator.strikeInfo('itemInfo', true)" onblur="javascript:CreateInvoiceUtil.calculateItemTotal(this); InvoiceGenerator.strikeInfo('itemInfo', false)" name="itemRate.3" data-json-node="rate" data-is-array="true" data-array-parent="line_items" type="text">
                                    </td>
                                    <td>
                                        <input readonly class="cursor-disabled w100 text-right" id="itemTotal.3" title="Amount is calculated automatically." name="itemTotal.3" data-json-node="amount" data-is-array="true" data-array-parent="line_items" value="0.00">
                                    </td>

                                    <td style="border-bottom:none;background:none;border-top:none" class="dele-icon">
                                        <div style="padding-top:4px"><a class="closeicon hide" id="itemClose.3" title="Delete Row" style="cursor:pointer;text-decoration:underline;color:#DE7110;" onclick="javascript:CreateInvoiceUtil.removeLineItem(this)"><span class="del pull-left">&nbsp;</span></a>
                                        </div>
                                    </td>
                                </tr> -->


                            </tbody>
                            <tbody>
                                <tr>
                                    <td>

                                        <div>
                                            <a style="cursor:pointer;margin-left:0px;margin-top: -16px;" title="Add Row" onclick="javascript:CreateInvoiceUtil.addInvoiceLineItem()"><span class=" btn btn-info">Add More Item</span></a>
                                        </div>
                                    </td>
                                    <td colspan="5" style="border-right:none;">
                                        <table style="margin-left:10px;border-bottom:solid 1px #c7c7c7;" width="100%" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr class="sav-amo text-right">
                                                    <td class="bdr-non" width="40%">
                                                           <p><b>Sub Total:</b></p>
                                                     
                                                    </td>
                                                    <td class="bdr-non" >
                                                        <span class="amount bld cursor-disabled" id="subTotal" title="Sub total is calculated automatically." data-json-node="sub_total" data-is-array="false"><?php echo isset($editrecord['sub_total'])? $editrecord['sub_total']:''; ?></span>
                                                    </td>
                                                </tr>
                                                <tr class="text-right " s>
                                                    <td width="40%">
                                                      <select tabindex="242" id="taxLabel" style="width:100% !important;" class="form-control" onblur="javascript:CreateInvoiceUtil.calculateInvTaxAndTotal(this)" onchange="javascript:CreateInvoiceUtil.calculateInvTaxAndTotal(this)" name="tax_name" data-json-node="tax_name" data-is-array="false" >
                                                     <option value="">Select Tax Type</option>
                                                        <option value="Sale VAT (6.05%)">Sale VAT (6.05%)</option>
                                                        <option value="Sale Against (Nill)">VAT H Form</option>
                                                        <option value="Sale CST (2%)">Sale CST (2%)</option>
                                                        <option value="Sale CST (6.05%)">Sale CST (6.05%)</option>
                                                        <option value="Sale Against CST H(0)">CST H Form</option>
                                                      </select>
                                                        <!-- <input value="Tax (20%)" tabindex="242" id="taxLabel" onblur="javascript:CreateInvoiceUtil.calculateInvTaxAndTotal(this)" name="tax_name" data-json-node="tax_name" data-is-array="false" type="text"> -->
                                                      
                                                    </td>
                                                    <td>
                                                        <span class="amount bld cursor-disabled" id="taxAmt" title="Tax amount is calculated automatically." data-json-node="tax" data-is-array="false"></span>
                                                    </td>
                                                </tr>
                                                <tr class="tot">

                                                    <td width="40%">

                                                              <p><b>TOTAL :</b></p>
                                                     <!--    <input value="TOTAL" id="totalLabel" tabindex="243" name="total_label" data-json-node="total_label" data-is-array="false" type="text"> -->
                                                    </td>
                                                    <td>
                                                       
                                                        <span>Rs.</span>
                                                        
                                                        <span class="amount bld cursor-disabled" id="total" title="Amount is calculated automatically." name="total" data-json-node="total" data-is-array="false"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>

                            </tbody>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <div class=" col-md-offset-6 col-md-6 col-xs-12 col-sm-12 text-center set-btn-dv">
							   <button class="btn-main btn wi-d" data-title="save_inv" type="submit"><?php echo isset($editrecord)? 'Update Invoice':'Save Invoice'; ?></button>			
                                <button class="btn-main btn wi-d"  data-title="save_print" type="submit"><?php echo isset($editrecord)? 'Update & Print':'Save & Print'; ?></button>  
</div>
              </form>
</div>
           <!--      <div class="col-md-4 rgt-main-div">
                

                  <div class="actions-block">
                    <h3>All done? Yay!</h3>
										<div class="select-action-txt">Now, choose how you want to receive your invoice.</div>
                    <button class="btn-main btn" style="margin-bottom: 20px; width: 90%" onclick="InvoiceGenerator.saveInvoice(document.invoiceGenerator, this);trackEvent('invoice - generator', 'Save', 'save_invgenerator');setHostUrl()">Save Invoice</button>
										<button class="btn btn-plain" style="margin-bottom: 20px;" onclick="InvoiceGenerator.saveInvoice(document.invoiceGenerator, this);trackEvent('invoice - generator', 'Send', 'send_invgenerator');setHostUrl(true)">Send Invoice</button>

                                                            <button class="btn btn-plain" style="margin-bottom: 20px;" onClick="window.print()">Print Invoice</button>
                    <span onclick="InvoiceGenerator.getInvoicePDF(document.invoiceGenerator, true);trackEvent('invoice - generator', 'Print', 'print_invgenerator');" class="link-print">Print Invoice</span>
										<span style="color: #83C0F5">|</span>
                    <span onclick="InvoiceGenerator.getInvoicePDF(document.invoiceGenerator);trackEvent('invoice - generator', 'PDF', 'PDF_invgenerator');" class="link-print">Get PDF</span>
                  </div>
                 
                </div> -->

            </div>

<!-- 
                  <div class="col-md-12 rgt-main-div">
                

                  <div class="actions-block">
                    <h3>All done? Yay!</h3>
                                        <div class="select-action-txt">Now, choose how you want to receive your invoice.</div>
                    <button class="btn-main btn btn-lft" style="margin-bottom: 20px; width: 20%;" onclick="InvoiceGenerator.saveInvoice(document.invoiceGenerator, this);trackEvent('invoice - generator', 'Save', 'save_invgenerator');setHostUrl()">Save Invoice</button>
                                        <button class="btn btn-plain btn-lft" style="margin-bottom: 20px; width: 20%;" onclick="InvoiceGenerator.saveInvoice(document.invoiceGenerator, this);trackEvent('invoice - generator', 'Send', 'send_invgenerator');setHostUrl(true)">Send Invoice</button>

                                                            <button class="btn btn-plain btn-lft" style="width: 20%; margin-bottom: 20px;" onClick="window.print()">Print Invoice</button>
                    <span onclick="InvoiceGenerator.getInvoicePDF(document.invoiceGenerator, true);trackEvent('invoice - generator', 'Print', 'print_invgenerator');" class="link-print">Print Invoice</span>
                                        <span style="color: #83C0F5">|</span>
                    <span onclick="InvoiceGenerator.getInvoicePDF(document.invoiceGenerator);trackEvent('invoice - generator', 'PDF', 'PDF_invgenerator');" class="link-print">Get PDF</span>
                  </div>
                 
                </div> -->
<div class="clearfix"></div>
            </div>

            <div>

            </div>
        </div>

    </div>




  <script async="" src="<?php echo base_url();?>assets/js/gtm.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/invoicegenerator.js">
  </script>

<script>
$(function () {
    $('.add2').on('click',function(){
        var $qty = $('.qty_here');
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)){
            $qty.val(currentVal + 1);
        }
    });
    $('.minus').on('click',function(){
       var $qty = $('.qty_here');
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
        }
    });
});
</script>
    <script type="text/javascript">

				function setHostUrl(isSend){
					var s = document.createElement("script");
        	s.type = "text/javascript";
					s.setAttribute("id", "regscript");
					$("#regscript").remove();
					var encodedURLParam = encodeURIComponent("&source_action=send");
					var targetUrl;
					targetUrl = hostUrl.replace(encodedURLParam, "");
					if(isSend){
						targetUrl = targetUrl + encodedURLParam;
					}
					s.src = targetUrl;
					document.getElementsByTagName("head")[0].appendChild(s);
				}
			 

      $(document).ready(function() {
  $(function () {
                $('#invoiceDate').datetimepicker();
            });

            for (var i = 1; i <= 3; i++) {
                autosize($("#itemDesc\\." + i));
            }
						autosize($("#terms"));
				 		autosize($("#customerNotes"));

				   /*var todayDate = $.fn.datepicker.DPGlobal.formatDate(new Date(), $.fn.datepicker.DPGlobal.parseFormat("M dd, yyyy"), "en");*/

           /* $("#invoiceDate").attr("placeholder", todayDate);*/
            /*$("#dueDate").attr("placeholder", todayDate);*/
/*
            $('#invoiceDate').datepicker({
                format: "M dd, yyyy",
                autoclose: true,
                orientation: 'auto',
                keyboardNavigation: false,
                todayHighlight: true
            });*/

         

            $.each(InvoiceGenerator.currencyList, function(key, item) {
                $('#currencySelect')
                    .append($("<option></option>")
                        .attr("value", key)
                        .attr("symbol", item.currency_symbol)
                        .text(key + " - " + item.currency_name + " (" + item.currency_symbol + ")"));
            });

            $("#currencySelect").val($("#currencyCode").val());

						$('#signupModal').on('shown.bs.modal', function () {
    					$('#email').focus();
						});

						var baseUrl =  "https://localhost:8443";
						var hostURL = document.location.host;
						if(hostURL.indexOf("localzoho.com") !== -1){
							baseUrl = "https://invoice.localzoho.com";
						} else if(hostURL.indexOf("zoho.com") !== -1){
							baseUrl = "https://invoice.zoho.com";
						}
						InvoiceGenerator.baseUrl = baseUrl + "/api/v3/invoicegenerator";
        });
			 
    </script>

  






<script type="text/javascript">


var tax = '<?php echo isset($editrecord['tax_type'])? $editrecord['tax_type']:''; ?>';
$('#taxLabel').val(tax).trigger('change');
  <!-- Google Tag Manager start -->

    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WJD92J');

  <!-- Google Tag Manager end -->

  

  function trackEvent(category, actionName, label) {

      

    dataLayer.push({
      event: 'gaEvent',
      gaCategory: category,
      gaAction: actionName,
      gaLabel: label
      });
  }

  dataLayer.push({
        event: 'gaPageview',
        gaPageUrl: location.href
  });

  var name = "ZohoInvoiceRef";
  var pageURL = "ZohoInvoicePageURL";
  createCookie(name,pageURL);

</script>

<script>

  jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                    /*setDate: "2017/02/02",*/
                });

  $("#invoiceGenerator button[type=submit]").click(function() {
    $("#invoiceGenerator button[type=submit]", $(this).parents("form")).removeAttr("clicked");
    $(this).attr("clicked", "true");
});

 </script>