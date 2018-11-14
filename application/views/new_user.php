 <div class="container" style="text-align:center;">


 <h3 class="ft_wt"><?php echo $title;?></h3>



  <div class="row align-self-center" style="display: inline; float: none;">
     <form method="post" action="<?php echo site_url('user/insert_user/');?>">

<div class="col-md-6 col-md-offset-3">
<br>
 <div class="login-panel panel panel-default sha_div">
		<div class="panel-body">



			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>


				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label>
					<input type="email" id="inputEmail" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
			</div>
			<div class="form-group">
					<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
					<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="<?php echo $this->lang->line('password');?>" required >
			 </div>
				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('first_name');?></label>
					<input type="text"  name="first_name"  class="form-control" placeholder="<?php echo $this->lang->line('first_name');?>" required   autofocus>
			</div>
				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label>
					<input type="text"   name="last_name"  class="form-control" placeholder="<?php echo $this->lang->line('last_name');?>" required  autofocus>
			</div>
				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label>
					<input type="number" name="contact_no"  class="form-control" placeholder="<?php echo $this->lang->line('contact_no');?>" required  autofocus>
			</div>
      <div class="form-group">
          <label for="inputEmail" class="sr-only"><?php echo $this->lang->line('employee_id');?></label>
          <input type="text" name="employee_id"  class="form-control" placeholder="<?php echo $this->lang->line('employee_id');?>" required  autofocus>
      </div>
      <div class="form-group">
          <label for="inputEmail" class="sr-only"><?php echo $this->lang->line('designation');?></label>
          <input type="text" name="designation"  class="form-control" placeholder="<?php echo $this->lang->line('designation');?>" required  autofocus>
      </div>
      <div class="form-group">
          <label for="inputEmail" class="sr-only"><?php echo $this->lang->line('designation');?></label>
          <input type="text" name="department"  class="form-control" placeholder="<?php echo $this->lang->line('department');?>" required  autofocus>
      </div>
				<div class="form-group">
					<label   ><?php echo $this->lang->line('select_group');?></label>
					<select class="form-control" name="gid" id="gid"  required>
            <option value>Select Group</option>
					<?php
					foreach($group_list as $key => $val){
						?>

						<option value="<?php echo $val['gid'];?>"><?php echo $val['group_name'];?> </option>
						<?php
					}
					?>
					</select>
			</div>

      <div class="form-group">
        <label   ><?php echo $this->lang->line('user_manger');?></label>
        <select class="form-control" name="user_manger" id="user_manger"  required>
          <option value="0">Select Manager</option>
        <?php
        foreach($user_list as $key => $value){
          ?>

<option value="<?php echo $value['uid'];?>" ><?php echo $value['first_name'].' '.$value['last_name'];?></option>
          <?php
        }
        ?>
        </select>
    </div>
			<!-- <div class="form-group">
					<label for="inputEmail"  ><?php echo $this->lang->line('subscription_expired');?></label>
					<input type="text" name="subscription_expired"  id="subscription_expired" class="form-control" placeholder="<?php echo $this->lang->line('subscription_expired');?>"    autofocus>
			</div> -->

				<div class="form-group">
					<label   ><?php echo $this->lang->line('account_type');?></label>
					<select class="form-control" name="su">
						<option value="0"><?php echo $this->lang->line('user');?></option>
						<option value="1"><?php echo $this->lang->line('administrator');?></option>
					</select>
			</div>


	<button class="btn btn-lg btn-primary btn-block loginbtn" type="submit"><?php echo $this->lang->line('submit');?></button>

		</div>
</div>




</div>
      </form>
</div>





</div>
<script>
getexpiry();
</script>
