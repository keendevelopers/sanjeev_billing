<?php
$bill          = $this->db->where(array('is_deleted' => '0', 'inv_id' => $parm))->get('invoice')->row_array();
$bill_products = $this->db->select('ip.*,pi.ProductTitle,pi.ProductCode,pi.Price,pi.PackingType,pi.QuantityType')
                  ->join('product_info as pi','pi.P_Id = ip.P_Id','left')
                  ->where(array('inv_id' => $parm))
                  ->get('invoice_products as ip')
                  ->result_array();
  $product_details = $this->db->where('P_Id',$parm)->get('invoice_products')->row();

 ?>

<div class="col-xs-12 col-md-12 col-lg-12 pull-left">

                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Invoice Details</div>

                        <div class="panel-body">

                            <div class="row">

                             <div class="col-md-5"><h4><b>Invoice No:</b></h4></div><div class="col-md-7"><h5><?php echo $bill['inv_id']; ?></h5></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Custoer Name:</b></h4></div><div class="col-md-7"><h4><?php echo $bill['cust_name']; ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Invoice Date:</b></h4></div><div class="col-md-7"><h4><?php echo date('d M, Y',strtotime($bill['inv_date'])); ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Address:</b></h4></div><div class="col-md-7"><h4><?php echo $bill['address']; ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Mobile:</b></h4></div><div class="col-md-7"><h4><?php echo $bill['mobile']; ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>State Code:</b></h4></div><div class="col-md-7"><h4><?php echo $bill['StateCode']; ?></h4></div></div>

                           <?php if($bill['Biller_GST'] != ''){ ?>
                             <div class="row"><div class="col-md-5"><h4><b>GSTIN:</b></h4></div><div class="col-md-7"><h4><?php echo $bill['Biller_GST']; ?></h4></div></div>
                                  <?php  } ?>
                           
                           <!-- Table Starts From here -->
                           <hr>
                           <div class="row ">
                           <div class="col-md-12">
                           <table class="table">
                                <thead>
                                  <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Per Pack</th>
                                    <th>Q>Pack</th>
                                    <th>Q.Loose</th>
                                    <th>Disount</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($bill_products as $key => $pro) { ?>
                                  <tr>
                                    <td scope="row"><?php echo $pro['ProductTitle'].' ('.$pro['ProductCode'].')'; ?></td>
                                    <td><?php echo $pro['IP_Price']; ?></td>

                                    <?php 
                                       $quantity = ''; 
                                       if($pro['PackingType'] == 'Custom'){
                                        $quantity_perpack = '-';
                                        $quantity = ($pro['IP_Qunatity']+0).' '.$pro['QuantityType'];
                                       }else{
                                        $quantity_perpack = $pro['IP_Per_Pack'].' '.$pro['QuantityType'];
                                        $quantity = ($pro['IP_Qunatity']+0).' '.$pro['PackingType'];
                                       } ?>

                                      <td><?php echo $quantity_perpack; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $pro['IP_Qunatity_Loose'].' Loose'; ?></td>

                                    <?php if($pro['IP_Discount'] == '0.00'){
                                      $Disount = 'NILL';
                                    }else{
                                      $Disount = ($pro['IP_Discount']-0).'%';
                                      } ?>
                                    <td><?php echo $Disount; ?></td>
                                    <td><?php echo $pro['IP_Total']; ?></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                              </div>
                              </div>
                              <hr>


                          <div class="col-md-5"><h4><b>Sub Total:</b></h4></div><div class="col-md-7"><h4><i class="fa fa-inr"></i> <?php echo @$bill['sub_total']; ?></h4></div>

                           <?php if($bill['OfferType'] == 'MRP'){ ?>
                           <div class="col-md-5"><h4><b>Offer Title:</b></h4></div><div class="col-md-7"><h4><?php echo @$bill['OfferTitle']; ?></h4></div>

                           <div class="col-md-5"><h4><b>Offer Amount:</b></h4></div><div class="col-md-7"><h4><?php echo '- <i class="fa fa-inr"></i> '. $bill['OfferAmount']; ?></h4></div>
                           <?php } ?>

                           <div class="col-md-5"><h4><b>CGST/IGST:</b></h4></div><div class="col-md-7"><h4><?php echo @$bill['Tax_1'].'% (<i class="fa fa-inr"></i>'. $bill['Tax_1_Amount'].')'; ?></h4></div>

                           <?php if($bill['Tax_2'] != ''){ ?>
                           <div class="col-md-5"><h4><b>SGST/IGST:</b></h4></div><div class="col-md-7"><h4><?php echo @$bill['Tax_2'].'% (<i class="fa fa-inr"></i>'. $bill['Tax_2_Amount'].')'; ?></h4></div>
                           <?php } ?>

                           <?php if($bill['OfferType'] == 'NetAmount'){ ?>
                           <div class="col-md-5"><h4><b>Offer Title:</b></h4></div><div class="col-md-7"><h4><?php echo @$bill['OfferTitle']; ?></h4></div>

                           <div class="col-md-5"><h4><b>Offer Amount:</b></h4></div><div class="col-md-7"><h4><?php echo '- <i class="fa fa-inr"></i> '. $bill['OfferAmount']; ?></h4></div>
                           <?php } ?>

                           <div class="col-md-5"><h4><b>Grand Total:</b></h4></div><div class="col-md-7"><h4><i class="fa fa-inr"></i> <?php echo @$bill['total']; ?></h4></div>


                         
                    </div>

                </div>