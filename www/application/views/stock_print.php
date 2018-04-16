<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
  <style type="text/css">
    .mark-red{background: red; color: white;}
    tr:hover{color: black;}
  </style>
</head>
<body>

<div class="container">
  <h2>Available Stock List <?php echo '('.date('d M, Y').')';?></h2>
  <p><?php echo FIRMNAME.' ('.SOFTWARE_NAME.')';?></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Sr.</th>
        <th>Product Name</th>
        <th>Product Code</th>
        <th>Brand</th>
        <th>In Pack</th>
        <th>Availble</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    <?php $grandtotal = 0.00; foreach($stock as $key => $val){ 
if ($val['PackingType'] == 'Custom') {
                $quantity_perpack = '-';
                $quantity         = ($val['AvailQuantity'] + 0) . ' ' . $val['QuantityType'];
            } else {
                $quantity_perpack = $val['PerPack'] . ' ' . $val['QuantityType'];
               /* $quantity         = ($val['AvailQuantity'] + 0)/$val['PerPack'] . ' ' . $val['PackingType'];*/

                  $quantity         = intval(($val['AvailQuantity'] + 0)/$val['PerPack']) . ' ' . $val['PackingType'];
                if(($val['AvailQuantity'] + 0)%$val['PerPack'] > 0){
                 $quantity .= '</br>'.intval(($val['AvailQuantity'] + 0)%$val['PerPack']). ' ' . 'Loose';

                }
                 $quantity1 = intval(($val['AvailQuantity'] + 0)/$val['PerPack']);
            }
$grandtotal = $grandtotal+($val['Price']*$val['AvailQuantity']);
$class= "";
if($quantity1 <= $val['LeastQuantity']){
$class = 'mark-red';
}

    ?>
      <tr class="<?php echo $class; ?>">
        <td><?php echo $key+1; ?></td>
        <td><?php echo $val['ProductTitle']; ?></td>
        <td><?php echo $val['ProductCode']; ?></td>
        <td><?php echo $val['ProductMake']; ?></td>
        <td><?php echo $quantity_perpack; ?></td>
        <td><?php echo $quantity; ?></td>
        <td><?php echo '<i class="fa fa-inr"></i>'.$val['Price']; ?></td>
        <td><?php echo '<i class="fa fa-inr"></i>'.$val['Price']*$val['AvailQuantity']; ?></td>
      </tr>
      <?php } ?>
  
    </tbody>
  </table>

  <b class="pull-right">Grand Total: <?php echo '<i class="fa fa-inr"></i> '.$grandtotal.'/-';?></b>
</div>

</body>
</html>
