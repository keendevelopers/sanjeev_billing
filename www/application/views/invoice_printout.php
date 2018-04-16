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



    @media (min-width:1200px){

    .container {
    width: 750px !important;
    margin-left:auto;
    margin-right:auto;
    }  
    }



        @media print{
    * {-webkit-print-color-adjust:exact;}
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
      width:46%;
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
 /* border-radius:4px;*/ 
      border:1px solid #000; 
      padding:5px 10px; 
  transition: background 0.2s;
     background: transparent;
  margin-right:6px;

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
  border:1px solid #da251d;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td
{
  border:1px solid #da251d !important;
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


.main-div{padding: 10px; border: 1px solid #000;}
.fon-t-sz{    margin-left: 10px;}
.fon-t-sz b{    font-size: 13px;}
.mr-top-m{    margin-top: 10px;}
.font-rth-mr{margin-right: 10px;}
.font-rth-mr b{    font-size: 13px;}
.client-info ul{    padding-left: 10px !important;}
.content-left .div-li{    border-top-left-radius: 10px;     border-bottom-left-radius: 10px;}

.content-right .right-lp{border-top-right-radius: 10px;     border-bottom-right-radius: 10px;}
 .content-one,.content-two,.content-three{    box-shadow: 3px 5px grey;}
.div-li{box-shadow: 0px 5px grey;}
.right-lp{box-shadow: 0px 5px grey;}
.content-right::before{box-shadow: 0px 5px grey;}
.content-left::after{box-shadow: 3px 5px grey;}
.logo-div{    padding-bottom: 20px;
    width: 86%;
    height: 119px;
    margin-top: 10px;}

    .small-logo img{     width: 19%;
    height: 44px !important;
    margin-top: 20px;
    margin-left: 39px;}

    .vericaltext{       width: 1px !important;
    word-wrap: break-word;
    margin: 0px;
    position: absolute;
    background: #000;
       padding: 3px 15px 4px 7px;
    color: #fff;
    font-size: 12px;
    line-height: 14px;
    font-weight: 600;}

    .tin-no{width: 81%;
    height: 37px}

    .into-ph{    width: 81%;
    height: 121px;}

    .address-png{    width: 93%;
    text-align: center;
    margin: auto;
    padding-bottom: 20px;}

    .client-info{text-align: center;}
    .terms-ph{    width: 85%;
    
    height: 80px;}

    .auth-png{    width: 17%;
    height: 20px;  margin-top: -10px;}
       .auth2-png{      width: 99%;
    height: 17px;
    margin-top: -10px;}

    .table > tbody > tr > td{

padding: 5px !important;
  
}

    .main-div{-webkit-print-color-adjust: exact !important;}

    table {
    /* background-color: rgba(193, 32, 32, 0); */
    background: rgba(255, 0, 0, 0) !important;
}


/*        .tbl-img{background-image: url("<?php echo base_url(); ?>assets/images/watermark.png") !important;    
     background-size: 22% !important;
    background-repeat: no-repeat !important;
    background-position: 129px 60% !important;
 -webkit-print-color-adjust: exact !important; 

  }

     .dv-tb{background-image: url("<?php echo base_url(); ?>assets/images/copyonly.png") !important;     
        background-size: 28% !important;
    background-repeat: no-repeat !important;
    background-position: 90px 88% !important;
   -webkit-print-color-adjust: exact !important;

    } */ 

      body {-webkit-print-color-adjust: exact;}

     
.img-pos-m{
display: block;
    width: 24% !important;
    position: absolute !important;
top: 75% !important;
    left: 14% !important;
   

}

.img-pos{display: block;}
.img-pos{  width: 16% !important;
    position: absolute !important;
    top: 25% !important;
    left: 22% !important;
    opacity: 0.2;}

@media print {
 
.img-pos{display: block;}
.img-pos{  width: 16% !important;
    position: absolute !important;
    top: 25% !important;
    left: 22% !important;
    opacity: 0.2;}

.img-pos-m{
display: block;
    width: 24% !important;
    position: absolute !important;
    top: 75% !important;
    left: 14% !important;

}

      tbody {background: transparent;}
 }

@media print{
body .main-div {page-break-after:always}



}




</style>
  </head>
  <body>
  <!--    <page size="A4"> -->
  <?php $copy = array('Original Copy','Customer Copy','Extra Copy');
  for($i=0; $i<3; $i++){ ?> 
     <div class="container main-div">
      <div class="row pad-top-botm clearfix" style="padding-top:9px !important;">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="text-left fon-t-sz">


            <img class="tin-no" src="<?php echo base_url(); ?>assets/images/tin.png" style="" />

          <div class="small-logo">
            <img src="<?php echo base_url(); ?>assets/images/ng-logo.png" style="" />
          </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:0px;">
          <div class="text-center mr-top-m">
          <strong class="font-style" style="color:#da251d !important; padding-bottom:8px; font-size: 14px; -webkit-print-color-adjust: #da251d;">  &#x0A74 ਸਤਿਗੁਰ ਪ੍ਰਸਾਦਿ</strong>
          <br />
          <b style="border-bottom:1px solid #000; font-size: 14px; -webkit-print-color-adjust: exact;">VAT INVOICE</b>
          <br />
          <strong style="color:#da251d !important; padding-top:8px; font-size: 14px; -webkit-print-color-adjust: exact;"><?php echo $copy[$i]; ?></strong>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <div class="text-right font-rth-mr">
   
          
             <img class="into-ph" src="<?php echo base_url(); ?>assets/images/info.png" style="" />
          </div>
        </div>
      </div>

       <div  class="row contact-info clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
    

            <img src="<?php echo base_url(); ?>assets/images/mg-logo.png" class="logo-div" style="padding-bottom:20px;" />
          <br>          
        </div>
      </div>
       <div class="row pad-top-botm client-info clearfix">
    <img class="address-png" src="<?php echo base_url(); ?>assets/images/address.png" style="" />
      </div>
      <div class="row clearfix" style="padding-bottom: 6px;">
        <div class="col-xs-12">
          <div class="col-xs-6 text-left" style="    font-size: 14px;"><b>Invoice No. <?php echo isset($editrecord['inv_id'])? $editrecord['inv_id']:''; ?></b></div>
          <div class="col-xs-6 text-right" style="    font-size: 14px;">Date<input type="text" value=" <?php echo isset($editrecord['inv_date'])? $editrecord['inv_date']:''; ?>" class="signature" /></div>
        </div>
        <div class="col-xs-12">
          <div class="col-xs-12" style="    font-size: 14px;">M/s.<input type="text" class="signature" value=" <?php echo isset($editrecord['cust_name'])? $editrecord['cust_name']:''; ?>" style="width:95%;" /></div>
          <div class="col-xs-12"><input type="text" class="signature col-xs-6" />
          <div class="col-xs-6" style="padding-right:0 !important;">VRN No.<input type="text" class="signature" style="width:85%" value=" <?php echo isset($editrecord['vrn_no'])? $editrecord['vrn']:''; ?>" /></div></div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 dd">
          <div class="">

<img class="img-pos" src="<?php echo base_url(); ?>assets/images/watermark.png">
          </div>



              <div class="">

<img class="img-pos-m" src="<?php echo base_url(); ?>assets/images/copyonly.png">
          </div>
          <div class="table-responsive dv-tb" style="padding: 10px;">
             <div class="">

<img class="img-pos" src="<?php echo base_url(); ?>assets/images/watermark.png">
          </div>
            <table class="table table-bordered tbl-img" style="
    min-height: 250px" >
              <thead>
                <tr bordercolor="#B44935">
                  <th style="text-align: center;      color: #da251d !important; font-family: arial;      width: 53px;">S. No.</th>
                  <th style="text-align: center;     color: #da251d !important; font-family: arial; ">Full Description of Goods</th>
                  <th style="text-align: center;     color: #da251d !important; font-family: arial; ">Qty.</th>
                  <th style="text-align: center;     color: #da251d !important;  font-family: arial; width: 90px;">Rate</th>
                  <th style="text-align: center;     color: #da251d !important; font-family: arial; ">Amount</th>
                </tr>
              </thead>
              <tbody style="">
              <?php if(isset($items)){ foreach ($items as $key => $value) { ?>

                <tr bordercolor="#B44935" >
                  <td style="border-bottom-color:transparent !important; font-family: arial;"><?php echo $key+1; ?></td>
                  <td style="border-bottom-color:transparent !important; font-family: arial;"><?php echo $value['p_name']; ?></td>
                  <td style="border-bottom-color:transparent !important; font-family: arial;"><?php echo $value['p_qnt']; ?> (<?php echo $value['p_type']; ?>)</td>
                  <td style="border-bottom-color:transparent !important; font-family: arial;"><?php echo $value['p_rate']; ?></td>
                  <td style="border-bottom-color:transparent !important; font-family: arial;"><?php echo $value['p_amount']; ?></td>
                </tr>

                
        <?php  } }?>
                <tr style="border-top-color:#fff !important; text-align: center;">
                  <td style="border-bottom-color:transparent !important;"></td>
                  <td style="border-bottom-color:transparent !important;"></td>
                  <td style="border-bottom-color:transparent !important;"></td>
                  <td  style="color: #da251d !important; font-weight:600; font-family: arial;">Total</td>
                  <td style="font-family: arial;"><?php echo isset($editrecord['sub_total'])? $editrecord['sub_total']:''; ?></td>
                </tr>
                <tr style="text-align: center;">
                  <td style="border-bottom-color:transparent !important;"></td>
                   <td style="border-bottom-color:transparent !important;"></td>
                    <td style="border-bottom-color:transparent !important;"></td>
                  <td style="color: #da251d !important; font-weight:600; font-family: arial;"><?php echo isset($editrecord['tax_type'])? $editrecord['tax_type']:''; ?></td>
                  <td style="font-family: arial;"><?php echo isset($editrecord['tax'])? $editrecord['tax']:''; ?></td>
                </tr>
                <tr style="text-align: center;">
                  <td style="border-bottom-color:transparent !important;"></td>
                   <td style="border-bottom-color:transparent !important;"></td>
                    <td style="border-bottom-color:transparent !important;"></td>
                  <td style="color: #da251d !important; font-weight:600; font-family: arial;">Cartage</td>
                  <td></td>
                </tr>
                <tr style="text-align: center;">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="color: #da251d !important; font-weight:600; font-family: arial;">Total<br>Amount</td>
                  <td style="font-family: arial;"><?php echo isset($editrecord['total'])? $editrecord['total']:''; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
        <div class="col-md-12 col-lg-12 col-sm-12" style="padding:0px;">
        <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="">
      <img class="terms-ph" src="<?php echo base_url(); ?>assets/images/terms.png" style="" />
      </div>
          </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-right">


              <img class="auth2-png" src="<?php echo base_url(); ?>assets/images/auth1.png" style="" />
              <!-- <span style="color:#da251d; text-transform: uppercase; padding-top:10px;"><i><b style="font-size: 15px;">For Nagpal Products</b></i></span> -->
        </div>
      </div>
  
        <div class="col-lg-12 col-md-12 col-sm-12 text-right">

              <img class="auth-png" src="<?php echo base_url(); ?>assets/images/auth2.png" style="" />
             <!--  <span style="color:#000; text-transform: uppercase; padding-top:10px;"><b>Auth. Signature.</b></span> -->
        </div>
   
      
    </div>
    <?php } ?> 
    <!-- </page>  -->
<script>
  //window.print();
</script>
  </body>
</html>