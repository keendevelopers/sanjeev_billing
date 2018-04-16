<?php 
$uri = $this->uri->segment('2');

?>

<div class="panel-body" style="    border: 1px solid #ccc;">
  <a style="margin-bottom: 10px;" class="btn  <?php if(isset($uri) && $uri=="editprofile") { ?>btn-primary <?php }else{?> btn-default <?php }; ?>" href="<?php echo base_url();?>Welcome/editprofile"><i class="fa fa-user"></i> Edit Personal Details</a>
  <a style="margin-bottom: 10px;" class="btn  <?php if(isset($uri) && $uri=="changePassword") { ?>btn-primary <?php }else{?> btn-danger <?php }; ?>" href="<?php echo base_url();?>Welcome/changePassword"><i class="fa fa-lock"></i> Change Password</a>
    <a class="btn  <?php if(isset($uri) && $uri=="changephoto") { ?>btn-primary <?php }else{?> btn-danger <?php }; ?>" href="<?php echo base_url();?>Welcome/changephoto"><i class="fa fa-user"></i> Change Photo</a>
</div>