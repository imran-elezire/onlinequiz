 <div class="container" style="">
 <div class="col-md-12 row-clr" style="background-color:#ffffff;margin-top:-25px;">
<?php
$logged_in=$this->session->userdata('logged_in');
?>



<h3 class="ft_wt"><?php echo $title;?></h3>
  <div class="row"><br><br><br></div>
  <?php
  if($this->session->flashdata('message')){
    ?>
    <div class="alert alert-danger">
    <?php echo $this->session->flashdata('message');?>
    </div>
  <?php
  }
  ?>

  <div class="row">

  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('user/password_change/');?>">
	<div class="input-group">
    <label><?php echo $this->lang->line('new_password');?></label>
    <input type="password" class="form-control" name="new_password" placeholder="<?php echo $this->lang->line('new_password');?>">

  </div>
  <br>
  <div class="input-group">
    <label><?php echo $this->lang->line('confirm_password');?></label>
    <input type="password" class="form-control" name="confirm_password" placeholder="<?php echo $this->lang->line('confirm_password');?>">

  </div>
  <br>
  <div class="input-group">
    <button type="submit" class="btn btn-success" style="background-image: linear-gradient(to bottom, rgb(255, 0, 140),rgb(255, 0, 140),rgb(226, 15, 68));color:#ffffff;border:none;">Submit</button>
  </div>
  </form>
</div>
</div><!-- /.row -->


<div class="row"><br><br><br></div>






<div class="col-lg-12">
<br>
</div>
</div>
</div>
</div>
