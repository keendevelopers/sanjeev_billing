<?php
$bill          = $this->db->where(array('IsDeleted' => '0', 'BillId' => $parm))->get('buyed_product_bill')->row_array();
$bill_products = $this->db->select('bp.*,pi.ProductTitle,pi.ProductCode,pi.Price,pi.PackingType,pi.PerPack,pi.QuantityType')
                  ->join('product_info as pi','pi.P_Id = bp.P_Id','left')
                  ->where(array('BillId' => $parm))
                  ->get('buyed_product as bp')
                  ->result_array();
  $product_details = $this->db->where('P_Id',$parm)->get('product_info')->row();

 ?>

<div class="col-xs-12 col-md-12 col-lg-12 pull-left">

                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Purchase Details</div>

                        <div class="panel-body">

                            <div class="row">

                             <div class="col-md-5"><h4><b>Bill No:</b></h4></div><div class="col-md-7"><h5><?php echo $bill['BillNo']; ?></h5></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Billing By:</b></h4></div><div class="col-md-7"><h4><?php echo $bill['BillBy']; ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Purchased On:</b></h4></div><div class="col-md-7"><h4><?php echo date('d M, Y',strtotime($bill['PurchasedOn'])); ?></h4></div></div>

                           
                           <!-- Table Starts From here -->
                           <div class="row card-box">
                           <div class="col-md-12">
                           <table class="table">
                                <thead>
                                  <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Per Pack</th>
                                    <th>Qnt</th>
                                    <th>Disount</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($bill_products as $key => $pro) { ?>
                                
                                  <tr>

                                  <?php 
                                       $quantity = ''; 
                                       if($pro['PackingType'] == 'Custom'){
                                        $quantity_perpack = '-';
                                        $quantity = ($pro['BP_Qunatity']+0).' '.$pro['QuantityType'];
                                       }else{
                                        $quantity_perpack = $pro['PerPack'].' '.$pro['QuantityType'];
                                        $quantity = ($pro['BP_Qunatity']+0).' '.$pro['PackingType'];
                              } ?>

                                    <td scope="row"><?php echo $pro['ProductTitle'].' ('.$pro['ProductCode'].')'; ?></td>
                                    <td><?php echo $pro['BP_Price']; ?></td>
                                    <td><?php echo $quantity_perpack; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <?php if($pro['BP_Discount'] == '0.00'){
                                      $Disount = 'NILL';
                                    }else{
                                      $Disount = ($pro['BP_Discount']-0).'%';
                                      } ?>
                                    <td><?php echo $Disount; ?></td>
                                    <td><?php echo $pro['BP_Total']; ?></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                              </div>
                              </div>




                           <div class="col-md-5"><h4><b>Sub Total:</b></h4></div><div class="col-md-7"><h4><i class="fa fa-inr"></i> <?php echo @$bill['SubTotal']; ?></h4></div>

                           

                           <div class="col-md-5"><h4><b><?php echo @$bill['Tax_1']; ?>:</b></h4></div><div class="col-md-7"><h4><i class="fa fa-inr"></i><?php echo @$bill['Tax_1_Amount']; ?></h4></div>

                           <?php if($bill['Tax_2'] != ''){ ?>
                           <div class="col-md-5"><h4><b><?php echo @$bill['Tax_2']; ?>:</b></h4></div><div class="col-md-7"><h4><i class="fa fa-inr"></i><?php echo @$bill['Tax_2_Amount']; ?></h4></div>
                           <?php } ?>

                           <div class="col-md-5"><h4><b>Grand Total:</b></h4></div><div class="col-md-7"><h4><i class="fa fa-inr"></i> <?php echo @$bill['Total']; ?></h4></div>


                         
                    </div>

                </div>