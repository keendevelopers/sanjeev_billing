<?php

  $product_details = $this->db->where('P_Id',$parm)->get('product_info')->row();

 ?>

 <style type="text/css">
    .mark-red h4{color: red;}
    tr:hover{color: black;}
  </style>

<div class="col-xs-12 col-md-12 col-lg-12 pull-left">

                    <div class="panel panel-default height">

                        <div class="panel-heading text-center">Product Details</div>

                        <div class="panel-body">

                            <div class="row">

                             <div class="col-md-5"><h4><b>Product Title:</b></h4></div><div class="col-md-7"><h5><?php echo $product_details->ProductTitle; ?></h5></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Product Brand:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->ProductMake; ?></h4></div></div>

                           <?php if(!empty($product_details->ProductCode)){ ?>
                           <div class="row"><div class="col-md-5"><h4><b>Product Code:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->ProductCode; ?></h4></div></div>
                           <?php } ?>

                           <div class="row"><div class="col-md-5"><h4><b>HSN Code:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->HSNCode; ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Quantity Type:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->QuantityType; ?></h4></div></div>

                           <div class="row"><div class="col-md-5"><h4><b>Per Pack:</b></h4></div><div class="col-md-7"><h4><?php if(!empty($product_details->PerPack)){ echo $product_details->PerPack.' '.$product_details->QuantityType; } ; ?></h4></div></div>
                           
                           <?php if(!empty($product_details->Description)){ ?>
                           <div class="row"><div class="col-md-5"><h4><b>Description:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->Description; ?></h4></div></div>
                           <?php } ?>
                           <div class="row"><div class="col-md-5"><h4><b>Price:</b></h4></div><div class="col-md-7"><h4><?php echo '<i class="fa fa-inr"> </i> '.$product_details->Price; ?></h4></div></div>
                           <?php
  $quantity = intval(($product_details->AvailQuantity + 0)/$product_details->PerPack) . ' ' . $product_details->PackingType;
                if(($product_details->AvailQuantity + 0) % $product_details->PerPack > 0){
    $quantity = $quantity.' '.intval(($product_details->AvailQuantity + 0)%$product_details->PerPack). ' ' . 'Loose'; 



    }
$class = '';
    if(intval(($product_details->AvailQuantity + 0)/$product_details->PerPack) <= $product_details->LeastQuantity){
                    $class = "mark-red";
                }

    ?>
                           <div class="row <?php echo $class;  ?>"><div class="col-md-5"><h4><b>Available Quantity:</b></h4></div><div class="col-md-7"><h4><?php echo $quantity;  ?></h4></div></div>

                            <div class="row"><div class="col-md-5"><h4><b>Least Quantity:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->LeastQuantity;  ?></h4></div></div>

                            <div class="row"><div class="col-md-5"><h4><b>Rack No:</b></h4></div><div class="col-md-7"><h4><?php echo $product_details->RackNo;  ?></h4></div></div>

                         
                    </div>

                </div>