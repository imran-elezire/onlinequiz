 <div class="container" style="text-align:center;">

<div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>



  <div class="row" style="display: inline; float: none;">
     <form method="post" action="<?php echo site_url('user/update_user_changes/'.$uid);?>">

<div class="col-md-8 col-md-offset-2">
<br>
 <div class="login-panel panel panel-default sha_div">
		<div class="panel-body">



			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>

				<div class="form-group">
				<?php echo $this->lang->line('group_name');?>: <?php echo $result['group_name'];?>


				</div>

<!--
				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('email_address');?></label>
					<input type="email" id="inputEmail" name="email" value="<?php echo $result['email'];?>" readonly=readonly class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
			</div>
			<div class="form-group">
					<label for="inputPassword" class=""><?php echo $this->lang->line('password');?></label>
					<input type="password" id="inputPassword" name="password"   value=""  class="form-control" placeholder="<?php echo $this->lang->line('password');?>"   >
			 </div>
				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('first_name');?></label>
					<input type="text"  name="first_name"  class="form-control"  value="<?php echo $result['first_name'];?>"  placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
			</div>
				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('last_name');?></label>
					<input type="text"   name="last_name"  class="form-control"  value="<?php echo $result['last_name'];?>"  placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
			</div>
      <div class="form-group">
          <label for="inputEmail" class=""><?php echo $this->lang->line('employee_id');?></label>
          <input type="text" name="employee_id"  class="form-control" value="<?php echo $result['employee_id'];?>" placeholder="<?php echo $this->lang->line('employee_id');?>"   autofocus>
      </div>
      <div class="form-group">
          <label for="inputEmail" class=""><?php echo $this->lang->line('designation');?></label>
          <input type="text" name="designation"  class="form-control" value="<?php echo $result['designation'];?>" placeholder="<?php echo $this->lang->line('designation');?>"   autofocus>
      </div>
      <div class="form-group">
          <label for="inputEmail" class=""><?php echo $this->lang->line('department');?></label>
          <input type="text" name="department"  class="form-control" value="<?php echo $result['department'];?>" placeholder="<?php echo $this->lang->line('department');?>"   autofocus>
      </div> -->
      <p>Submit your new contact no, if your verified it. It will change.</p>
        <div class="form-group">
          <label for="inputEmail" class=""><?php echo $this->lang->line('contact_no');?></label>
          <input type="text" name="contact_no"  class="form-control"  value="<?php echo $result['contact_no'];?>"  placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
      </div>


	<button class="btn btn-default loginbtn" type="submit"><?php echo $this->lang->line('submit');?></button>

		</div>
</div>




</div>
      </form>
</div>








</div>
</div>
