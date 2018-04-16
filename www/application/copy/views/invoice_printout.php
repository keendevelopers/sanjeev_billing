<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Invoice</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?php echo base_url(); ?>assets/css/custom-style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quantico" rel="stylesheet">

    <style>
    @media screen and (min-width:1200px)
    {
    .container {
    width: 750px !important;
    margin-left:auto;
    margin-right:auto;
    }  
    }
    .client-info ul
    {
      display:flex;
    }
    .content-left
    {
      width:40%;
      position:relative;
    }
    .content-right
    {
      width:45%;
      position:relative;
    }
   .content-left::after {
    content: "";
    position: absolute;
    right: 8px;
    top: 0px;
  width: 50px;
    height: 100%;
    -webkit-transform: skew(-20deg);
    -moz-transform: skew(20deg);
    -o-transform: skew(20deg);
    border: none;
    border-right: 1px solid #000;
    border-top: 1px solid #000;
}
 .content-right::before {
    content: "";
    position: absolute;
    left: 9px;
    top: 0px;
  width: 50px;
    height: 100%;
    -webkit-transform: skew(-20deg);
    -moz-transform: skew(20deg);
    -o-transform: skew(20deg);
    border: none;
    border-left: 1px solid #000;
    border-bottom: 1px solid #000;
}
.client-info li {
  display:inline-block;
  border-radius:4px; 
      border:1px solid #000; 
      padding:5px 10px; 
  transition: background 0.2s;
  background:#fff;
  margin-right:9px;

}
li.content-one,li.content-two,li.content-three
{
  transform: skew(-20deg);
}
.client-info li div b {
  display:block;
  border-radius:20px; 
  text-decoration:none;
  padding:5px 10px;
 /* transform: skew(20deg);*/ /* INVERSE SKEW */
}
.font-family
{
  font-family: 'Monoton', cursive;
}
.signature {
    border: 0;
      border-bottom: 1px dotted grey;
}
.table-bordered
{
  border:1px solid #B44935;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td
{
  border:1px solid #B44935;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
  .container {
    width:100%;
  }
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
  float: left;
  position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-sm-12 {
  width: 100%;
}
.col-sm-11 {
  width: 91.66666666666666%;
}
.col-sm-10 {
  width: 83.33333333333334%;
}
.col-sm-9 {
  width: 75%;
}
.col-sm-8 {
  width: 66.66666666666666%;
}
.col-sm-7 {
  width: 58.333333333333336%;
}
.col-sm-6 {
  width: 50%;
}
.col-sm-5 {
  width: 41.66666666666667%;
}
.col-sm-4 {
  width: 33.33333333333333%;
 }
 .col-sm-3 {
   width: 25%;
 }
 .col-sm-2 {
   width: 16.66666667%;
 }
 .col-sm-1 {
  width: 8.333333333333332%;
 }
 html, body {
    height:100%; 
    width:100%;
    background: #FFF; 
     font-family: 'Quantico', sans-serif;
    font-size:12px;
  }
}
</style>
  </head>
  <body>
  <!--    <page size="A4"> -->
  <?php $copy = array('Original Copy','Customer Copy','Extra Copy');
  for($i=0; $i<3; $i++){ ?> 
     <div class="container">
      <div class="row pad-top-botm clearfix" style="padding-top:9px !important;">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="text-left">
          <b><strong>TIN No.</strong> 03781027242</b>
          <br />
          <b><strong>ST/CST No. :</strong> 55602319 DL 24-7-87</b>
          <br/>
          <div class="text-center">
            <img src="<?php echo base_url(); ?>assets/img/logo.png" style="padding-bottom:20px;" />
          </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <div class="text-center">
          <strong class="font-style" style="color:#B44935; padding-bottom:8px;">  &#x0A74 ਸਤਿਗੁਰ ਪ੍ਰਸਾਦਿ</strong>
          <br />
          <b style="border-bottom:1px solid #000;">VAT Invoice</b>
          <br />
          <strong style="color:#B44935; padding-top:8px;"><?php echo $copy[$i]; ?></strong>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <div class="text-right">
          <div> <b><strong>Ph.</strong>: 0161-2222117</b></div>
          
          <div><b><strong>Fax :</strong> 0161-2222117</b></div>
          
          <div><b><strong>(M) :</strong> 93169-05404</b></div>
          
          <div><b><strong>(M) :</strong> 93166-32695</b></div>
          
          <div><b><strong>Email :</strong> nagpalproducts@yahoo.co.in</b></div>
          
          </div>
        </div>
      </div>

       <div  class="row contact-info clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
          <p class="font-family" style="font-size:68px; color:#B44935; text-transform: uppercase;">
            NAGPAL<sub style="font-size:30px;color:#B44935; text-transform: uppercase; bottom:-35px !important; left:10px;"><b>Products</b></sub>
          </p>
          <br>          
        </div>
      </div>
       <div class="row pad-top-botm client-info clearfix">
        <ul>
        <li class="content-left" style="    border: none;padding-top: 0px; padding-bottom: 0px; ">
          <div style="border: 1px solid #000;border-right: 0px;width: 97%;
    height: 100%;">

          <b>Mfrs. Of :
          <br />
          Anodized Metal Labels,
          <br />
          Diamond Cut Labels &amp; Stickers etc.</b>
          
          </div>
          </li>
          <li class="content-one"><p></p>
          </li>
          <li class="content-two"><p></p>
          </li>
           <li class="content-three"><p></p>
          </li>
        <li class="content-right" style="border: none;padding-top: 0px; padding-bottom: 0px; ">
        <div style="border: 1px solid #000;border-left: 0px;width: 97%;
    height: 100%; float:right;">
          <b>B-XXII-404/8, Indra Colony.
          <br />
          Small Industrial Street,(Behind Sutlej Hosiery)
          <br />
          Industrial Area-A, Ludhiana-141 003</b>
          </div>
        </li>
        </ul>
      </div>
      <div class="row clearfix" style="padding-bottom: 6px;">
        <div class="col-xs-12">
          <div class="col-xs-6 text-left"><b>Invoice No.</b></div>
          <div class="col-xs-6 text-right">Date<input type="text" value="<?php echo isset($editrecord['inv_date'])? $editrecord['inv_date']:''; ?>" class="signature" /></div>
        </div>
        <div class="col-xs-12">
          <div class="col-xs-12">M/s.<input type="text" class="signature" value="<?php echo isset($editrecord['cust_name'])? $editrecord['cust_name']:''; ?>" style="width:96%;" /></div>
          <div class="col-xs-12"><input type="text" class="signature col-xs-6" />
          <div class="col-xs-6" style="padding-right:0 !important;">VRN No.<input type="text" class="signature" style="width:85%" value="<?php echo isset($editrecord['vrn_no'])? $editrecord['vrn_no']:''; ?>" /></div></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr bordercolor="#B44935">
                  <th style="text-align: center;">S. No.</th>
                  <th style="text-align: center;">Full Description of Goods</th>
                  <th style="text-align: center;">Qty.</th>
                  <th style="text-align: center;">Rate</th>
                  <th style="text-align: center;">Amount</th>
                </tr>
              </thead>
              <tbody style="min-height: 250px">
              <?php if(isset($items)){ foreach ($items as $key => $value) { ?>
                <tr bordercolor="#B44935" >
                  <td style="border-bottom-color:#fff !important;"><?php echo $key+1; ?></td>
                  <td style="border-bottom-color:#fff !important;"><?php echo $value['p_name']; ?></td>
                  <td style="border-bottom-color:#fff !important;"><?php echo $value['p_qnt']; ?></td>
                  <td><?php echo $value['p_rate']; ?></td>
                  <td><?php echo $value['p_amount']; ?></td>
                </tr>
                <?php  } }?>
                <tr style="border-top-color:#fff !important; text-align: center;">
                  <td style="border-bottom-color:#fff !important;"></td>
                  <td style="border-bottom-color:#fff !important;"></td>
                  <td style="border-bottom-color:#fff !important;"></td>
                  <td>Total</td>
                  <td><?php echo isset($editrecord['sub_total'])? $editrecord['sub_total']:''; ?></td>
                </tr>
                <tr style="text-align: center;">
                  <td style="border-bottom-color:#fff !important;"></td>
                   <td style="border-bottom-color:#fff !important;"></td>
                    <td style="border-bottom-color:#fff !important;"></td>
                  <td><?php echo isset($editrecord['tax_type'])? $editrecord['tax_type']:''; ?></td>
                  <td><?php echo isset($editrecord['tax'])? $editrecord['tax']:''; ?></td>
                </tr>
                <tr style="text-align: center;">
                  <td style="border-bottom-color:#fff !important;"></td>
                   <td style="border-bottom-color:#fff !important;"></td>
                    <td style="border-bottom-color:#fff !important;"></td>
                  <td>Cartage</td>
                  <td></td>
                </tr>
                <tr style="text-align: center;">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total<br>Amount</td>
                  <td><?php echo isset($editrecord['total'])? $editrecord['total']:''; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
        <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <ul style="list-style:none; padding-left: 0px;">
            <li>
              Goods once sold are not returnable.
            </li>
            <li>
              Subject to ludhiana Jurisdiction only.
            </li>
            <li>
              Interest @ 24% P.A. Will be Charged if bill is not paid on due date.
            </li>
            <li>
              Taxes Extra as applicable
            </li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-right">
              <span style="color:#B44935; text-transform: uppercase; padding-top:10px;"><i><b>For Nagpal Products</b></i></span>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <ul style="list-style:none; padding-left: 0px; color:#B44935;">
            <li style="padding-left: 20px;">
              *Input Tax Credit is available to a
            </li>
            <li>
              available person against this copy only*
            </li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-right">
              <span style="color:#B44935; text-transform: uppercase; padding-top:10px;"><b>Auth. Sign.</b></span>
        </div>
        </div>
      
    </div>
    <?php } ?> 
    <!-- </page>  -->
<script>
  window.print();
</script>
  </body>
</html>