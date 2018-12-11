
<div class="row" style="display: inline; float: none;">
<div class="container">





<!-- For changing the position of the login box -->
<div class="col-md-4">

</div>
<div class="col-md-4">

	<div class="login-panel panel panel-default sha_div" style="text-align: center;">
		<div class="panel-body">
		<center>
		<a href="<?php echo base_url();?>"><img src="<?php echo base_url('images/logo.png');?>"></a><br>
<h4 class="logintag"><?php echo $this->lang->line('login_tagline');?></h4>
		</center>

			<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
			<h4 class="form-signin-heading"><?php echo $this->lang->line('');?></h4>
		<?php
		if($this->session->flashdata('message')){
			?>
			<div class="alert alert-danger">
			<?php echo str_replace('{resend_url}',site_url('login/resend'),$this->session->flashdata('message'));?>
			</div>
		<?php
		}
		?>

		<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label>
		<fieldset class="page-signin-form-group form-group form-group-lg">
                  <!-- <div class="page-signin-icon text-muted"><i class="fa fa-user"></i></div> -->
                  <input class="page-signin-form-control form-control" name="mobile"  placeholder="<?php echo $this->lang->line('contact_no');?>" type="number" required autofocus>
                </fieldset>

                <label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
  		<fieldset class="page-signin-form-group form-group form-group-lg">
                  <!-- <div class="page-signin-icon text-muted"><i class="fa fa-star"></i></div> -->
                  <input class="page-signin-form-control form-control" name="password"  id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
                </fieldset>


			<div class="form-group">

					<button class="btn btn-lg btn-primary btn-block loginbtn" type="submit"><?php echo $this->lang->line('login');?></button>
			</div>

<div class="text-center">


	<a class="logintxt" style="text-align:center;font-weight:bold;text-decoration: underline;" href="<?php echo site_url('login/forgot');?>"><?php echo $this->lang->line('forgot_password');?></a>
</div>
			</form>



		</div>
	</div>

</div>


</div>

</div>
