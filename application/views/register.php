<div class="row"  style="border-bottom:1px solid #dddddd;">
<div class="container"  >
<div class="col-md-1">
</div>
<div class="col-md-10">
<a href="<?php echo base_url();?>"><img src="<?php echo base_url('images/logo.png');?>"></a>
<?php echo $this->lang->line('login_tagline');?>
</div>
<div class="col-md-1">
</div>

</div>

</div>

 <div class="container">


 <h3><?php echo $title;?></h3>



  <div class="row">
     <form method="post" action="<?php echo site_url('login/insert_user/');?>">

<div class="col-md-8">
<br>
 <div class="login-panel panel panel-default">
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
					<input type="text"  name="first_name"  class="form-control" placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
			</div>

				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label>
					<input type="text"   name="last_name"  class="form-control" placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
			</div>
      <div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('employee_id');?></label>
					<input type="text" name="employee_id"  class="form-control" placeholder="<?php echo $this->lang->line('employee_id');?>"   autofocus>
			</div>
			<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label>
					<input type="text" name="contact_no"  class="form-control" placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
			</div>

      <div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('designation');?></label>
					<input type="text" name="designation"  class="form-control" placeholder="<?php echo $this->lang->line('designation');?>"   autofocus>
			</div>
      <div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('designation');?></label>
					<input type="text" name="department"  class="form-control" placeholder="<?php echo $this->lang->line('department');?>"   autofocus>
			</div>
				<div class="form-group">
					<label   ><?php echo $this->lang->line('select_group');?></label>
					<select class="form-control" name="gid" id="gid"  >
					<?php
					foreach($group_list as $key => $val){
						?>

<option value="<?php echo $val['gid'];?>" <?php if($val['gid']==$gid){ echo 'selected'; } ?> ><?php echo $val['group_name'];?></option>
						<?php
					}
					?>
					</select>
			</div>


      <div class="form-group">
        <label   ><?php echo $this->lang->line('user_manger');?></label>
        <select class="form-control" name="user_manger" id="user_manger"  >
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





	<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
 &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo site_url('login');?>"><?php echo $this->lang->line('login');?></a>
		</div>
</div>




</div>
      </form>
</div>





</div>
<script>

</script>
