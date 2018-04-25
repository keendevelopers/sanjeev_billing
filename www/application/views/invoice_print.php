<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
  <title>Invoice</title>

  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  <style>
  .graph-7{background: url(../img/graphs/graph-7.jpg) no-repeat;}
.graph-image img{display: none;}

@media print{
  .graph-image img{display:inline !important;}
}
body{
    font-family: "Times New Roman", Times, serif;
}
  </style>

</head>

<body class="print-body">

<section>

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="panel">
            <div class="panel-body invoice">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                    <?php if($details['Tax_1'] == 'vat-12'){ ?>
                    <p>TIN No. 03121148079</p>
                    <?php } else { ?>
                    <p style="font-size: x-small;">GSTIN. <?php echo GSTIN;?></p>
                    <span style="font-size: x-small;"><?php echo DL_1;?></span><br/>
                    <span style="font-size: x-small;"><?php echo DL_2;?></span>
                    <?php } ?>   
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                    <?php if($details['Tax_1'] == 'vat-12'){ ?>
                    <h4 class="invoice-title" style="margin-bottom: 5px;font-size: small;">Retail invoice</h4>
                    <?php } else { ?>
                    <h4 class="invoice-title" style="margin-bottom: 5px;font-size: small;">Tax invoice</h4>
                    <?php } ?>
                        <p><span style="font-size: 20px"><b><?php echo FIRMNAME;?></b></span><br/>
                            <?php echo FIRMAUTHORISED;?><br/>
                            <b><?php echo FIRMADDRESS_1;?><br> <?php echo FIRMADDRESS_2;?></b><br/>
                            Phone: <?php echo FIRMCONTACT_1;?> <?php //echo FIRMCONTACT_2;?></p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                    <img class="inv-logo" src="<?php echo base_url();?>assets/img/logo.png" alt="" style="width: 85px;"/>
                    </div>

                </div>
                <div class="invoice-address">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="inv-col col-md-6 col-sm-6 col-xs-6" style="font-weight: 600;font-size: small;"><span>Invoice#</span> <?php echo $details['invoice_no']; ?></div>
                            <div class="inv-col col-md-6 col-sm-6 col-xs-6 text-right"><span>Invoice Date :</span> <?php echo date('d M, Y',strtotime($details['inv_date'])); ?></div>
                        </div>
                        <div class="col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 kd-margin">
                            <!-- <h3 class="corporate-id"><span>To: </span><?php// echo $details['cust_name']?></h3> -->
                            <p><span>To: </span><?php echo $details['cust_name']; ?><span class="pull-right" >State Code: <?php echo $details['StateCode']; ?></span></p>
                            <p><span>Address: </span><?php echo $details['address']; ?></p>
                            <p><span>Prescribed By: </span><?php echo $details['vehicle_details']; ?></p> 
                            <p><span>Contact: </span><?php echo $details['mobile']; ?></p>
                            <p><span>GSTIN: </span><?php echo $details['Biller_GST']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <style type="text/css">
                table td{
                    font-size: 10px;
                }
            </style>
            <table class="table table-bordered table-invoice" style="border: 1px solid black!important;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th class="text-center" style="width: 80px">HSN</th>
                    <!-- <th class="text-center" >CGST</th>
                    <th class="text-center" >SGST</th> -->
                    <th class="text-center" style="width: 70px">Price</th>
                    <th class="text-center" style="width: 70px">Pack</th>
                    <th class="text-center" style="width: 50px">Qnt</th>
                    <th class="text-center" >Dis.</th>
                    <th class="text-center" style="width: 100px">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $key => $value) { ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td class=""><!-- kd-margin -->
                        <p><?php echo $value['ProductTitle'].' ('.$value['ProductCode'].')'; ?></p>
                    </td>
                    
                    <td class="text-center"><?php echo $value['HSNCode']; ?></td>
                    <!-- <td class="text-center"><?php echo $value['IP_Tax_1']; ?>%</td>
                    <td class="text-center"><?php echo $value['IP_Tax_2']; ?>%</td> -->
                    <td class="text-center">&#8377; <?php echo $value['IP_Price']; ?></td>
                    
                   <?php 
                   $quantity = ''; 
                   if($value['PackingType'] == 'Custom'){
                    $quantity_perpack = '-';
                    $quantity = ($value['IP_Qunatity']+0).' '.$value['QuantityType'];
                   }else{
                    $quantity_perpack = $value['PerPack'].' '.$value['QuantityType'];
                    $quantity = ($value['IP_Qunatity']+0).' '.$value['PackingType'];
                   } ?>

                   <?php if($value['IP_Discount'] == '0.00'){
                                      $Disount = 'NILL';
                                    }else{
                                      $Disount = ($value['IP_Discount']-0).'%';
                                      } ?>

                   <td class="text-center"><?php echo $quantity_perpack; ?></td>
                    <td class="text-center"><?php echo $quantity; ?></td>

                    <td class="text-center"> <?php echo $Disount; ?></td>
                    <td class="text-center">&#8377; <?php echo $value['IP_Total']; ?></strong></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" class="payment-method1 text-left">
                        <p>Amount In Words (&#8377;): <?php echo $number; ?></p>
                    </td>
                    <td class="text-right kd-margin" colspan="3">
                        
                        <?php if(@$details['OfferType'] == 'MRP'){ ?>
                            <p><?php echo $details['OfferTitle']; ?></p>
                        <?php } ?>

                        <p>Sub Total</p>
                        
                       <!--  <?php if($details['Tax_1'] == 'vat-12'){ ?>
                        <p>Tax (<?php echo ucfirst($details['Tax_1']); ?>%)</p>
                        <?php } else { ?>
                        <p><?php echo ucfirst($details['Tax_1']); ?>%</p>
                        <?php } ?>
                        <?php if($details['Tax_2'] !== ''): ?>
                        <p><?php echo ucfirst($details['Tax_2']); ?>%</p>
                        <?php endif;?> -->

                        <?php if($details['OfferType'] == 'TotalBill'){ ?>
                            <p><?php echo $details['OfferTitle']; ?></p>
                        <?php } ?>
                        <!-- <?php if(@$details['labour'] != '0.00'){ ?>
                            <p>Labour Charges</p>
                        <?php } ?> -->
                        <p><strong>GRAND TOTAL</strong></p>
                    </td>
                    <td class="text-center kd-margin">

                        

                        <?php if(@$details['OfferType'] == 'MRP'){ ?>
                            <p>- &#8377;<?php echo $details['OfferAmount']; ?></p>
                        <?php } ?>

                        <p>&#8377; <?php echo $details['sub_total']; ?></p>

                        <p>&#8377; <?php echo $details['Tax_1_Amount']; ?></p>

                        <?php if($details['Tax_2'] !== ''): ?>

                        <p>&#8377; <?php echo $details['Tax_2_Amount']; ?></p>

                         <?php endif;?>
                         
                         <?php if($details['OfferType'] == 'TotalBill'){ ?>
                            <p>- &#8377;<?php echo $details['OfferAmount']; ?></p>
                        <?php } ?>

                        <?php if(@$details['labour'] != '0.00'){ ?>
                            <p>&#8377;<?php echo $details['labour']; ?></p>
                        <?php } ?>
                        
                        <p><strong>&#8377; <?php echo $details['total']; ?></strong></p>
                    </td>
                </tr>

                  <tr>
                    <td colspan="10" class="payment-method text-left">
                        
                        <p>1. Goods once sold cannot be taken back or exchanged.</p><!-- <p class="text-right">For Indian Motors</p> -->
                        <p>2. All warranties subject to company terms only.</p>
                        <p>3. All disputes subject local jurisdiction only.</p><br/><br/><br/><br/><br/>
                      
                   


                        <div class="col-md-4 col-sm-4 col-xs-4 text-left" >
                        <h4 style="font-family: 'Times New Roman', Times, serif;">Customer's Signature</h4>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4 text-center" >
                        <h4  style="font-family: 'Times New Roman', Times, serif;">E. & O.E</h4>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4 text-right" >
                        <h4  style="font-family: 'Times New Roman', Times, serif;">Authorised Signatory</h4>
                        </div>
                    </td>
                    <!-- <td class="text-right kd-margin" colspan="2">
                        <p>Sub Total</p>
                        <p>Tax (<?php// echo ucfirst($details['Tax_1']); ?>%)</p>
                        <p><strong>GRAND TOTAL</strong></p>
                    </td>
                    <td class="text-center kd-margin">
                        <p>&#8377; <?php //echo $details['sub_total']; ?></p>
                        <p>&#8377; <?php// echo $details['Tax_1_Amount']; ?></p>
                        <p><strong>&#8377; <?php //echo $details['total']; ?></strong></p>
                    </td> -->
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!--body wrapper end

</section>

<!-- Placed js at the end of the document so the pages load faster -->


</div>


<script type="text/javascript">
    window.print();
</script>

</body>
</html>
