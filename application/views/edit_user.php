 <div class="container" style="text-align:center;">

<div class="col-md-12 row-clr" style="background-color:#ffffff;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>





  <div class="row" style="display: inline; float: none;">
     <form method="post" action="<?php echo site_url('user/update_user/'.$uid);?>">

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



				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('email_address');?></label>
					<input type="email" id="inputEmail" name="email" value="<?php echo $result['email'];?>" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
			</div>
			<div class="form-group">
					<label for="inputPassword" class=""><?php echo $this->lang->line('password');?></label>
					<input type="password" id="inputPassword" name="password"   value=""  class="form-control" placeholder="<?php echo $this->lang->line('password');?>"   >
			 </div>
       <div class="form-group">
 					<label for="inputPassword" class=""><?php echo $this->lang->line('password');?></label>
 					<input type="password" id="inputPassword" name="confirm_password"   value=""  class="form-control" placeholder="<?php echo $this->lang->line('confirm_password');?>"   >
 			 </div>
				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('first_name');?></label>
					<input type="text"  name="first_name"  class="form-control"  value="<?php echo $result['first_name'];?>"  placeholder="<?php echo $this->lang->line('first_name');?>" required  autofocus>
			</div>
				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('last_name');?></label>
					<input type="text"   name="last_name"  class="form-control"  value="<?php echo $result['last_name'];?>"  placeholder="<?php echo $this->lang->line('last_name');?>" required   autofocus>
			</div>
      <div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('employee_id');?></label>
					<input type="text" name="employee_id"  class="form-control" value="<?php echo $result['employee_id'];?>" placeholder="<?php echo $this->lang->line('employee_id');?>" required  autofocus>
			</div>
      <div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('designation');?></label>
					<input type="text" name="designation"  class="form-control" value="<?php echo $result['designation'];?>" placeholder="<?php echo $this->lang->line('designation');?>" required  autofocus>
			</div>
      <div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('department');?></label>
          <select class="form-control" name="department" id="department"  required>
            <option value>Select Department</option>
					<?php
					foreach($department_list as $key => $val){
						?>

						<option value="<?php echo $val['did'];?>" <?php echo ($val['did']==$result['department'])?'selected':''; ?>><?php echo $val['department_name'];?> </option>
						<?php
					}
					?>
					</select>
			</div>
				<div class="form-group">
					<label for="inputEmail" class=""><?php echo $this->lang->line('contact_no');?></label>
					<input type="text" name="contact_no"  class="form-control"  value="<?php echo $result['contact_no'];?>"  placeholder="<?php echo $this->lang->line('contact_no');?>"  min="0000000000" max="9999999999" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" required  autofocus>
			</div>
      <div class="form-group">
        <label   ><?php echo $this->lang->line('select_group');?></label>
        <select class="form-control" name="gid" id="gid"  required>
        <?php
        foreach($group_list as $key => $val) {
          ?>
          <option value="<?php echo $val['gid']; ?>" <?php echo ($result['gid']==$val['gid'])?'selected':''; ?>><?php echo $val['group_name'];?> </option>
          <?php
          }
        ?>
        </select>
    </div>

    <div class="form-group">
      <label><?php echo $this->lang->line('user_manger'); ?></label>
      <select class="form-control" name="user_manger" id="user_manger"  required>
        <option >Select Manager</option>
      <?php
      foreach($user_list as $key => $value) {
        ?>
<option value="<?php echo $value['uid'];   ?>" <?php echo ($result['user_manger']==$value['uid'])?' selected':''; ?> ><?php echo $value['first_name'].' '.$value['last_name'];?></option>
        <?php
      }
      ?>
      </select>
  </div>



				<div class="form-group">
					<label   ><?php echo $this->lang->line('account_type');?></label>
					<select class="form-control" name="su">
						<option value="0" <?php if($result['su']==0){ echo 'selected';}?>  ><?php echo $this->lang->line('user');?></option>
						<option value="1" <?php if($result['su']==1){ echo 'selected';}?>  ><?php echo $this->lang->line('administrator');?></option>
					</select>
			</div>

 				<div class="form-group">
					<label   ><?php echo $this->lang->line('account_status');?></label>
					<select class="form-control" name="user_status">
						<option value="Active" <?php if($result['user_status']=='Active'){ echo 'selected';}?>  ><?php echo $this->lang->line('active');?></option>
						<option value="Inactive" <?php if($result['user_status']=='Inactive'){ echo 'selected';}?>  ><?php echo $this->lang->line('inactive');?></option>
					</select>
			</div>


	<button class="btn loginbtn" type="submit"><?php echo $this->lang->line('submit');?></button>

		</div>
</div>




</div>
      </form>
</div>









</div>
</div>
