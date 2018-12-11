 <div class="container" style="text-align:center;">

 <div class="col-md-12 row-clr" style="background-color:#ffffff;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>


  <div class="row">

<div class="col-md-12">
<br>
<div class="login-panel panel panel-default sha_div" style="overflow-x:auto;">
		<div class="panel-body">
			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>
		<div id="message"></div>

		 <form method="post" action="<?php echo site_url('user/insert_department/');?>">

<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('department_name');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php
if(count($department_list)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}

foreach($department_list as $key => $val){
?>
<tr>
 <td><input type="text"   class="form-control"  value="<?php echo $val['department_name'];?>" onBlur="updatedepartment(this.value,'<?php echo $val['did'];?>');" ></td>
<td>

<a href="<?php echo site_url('user/remove_department/'.$val['did'].'/'.(($val['status']==0)?1:0));?>" class="btn btn-xs <?php echo ($val['status']==0)?"btn-success":"btn-danger" ?>"><?php echo ($val['status']==0)?"Enable":"Disable" ?></a>

</td>
</tr>

<?php
}
?>
<tr>
 <td>

 <input type="text"   class="form-control"   name="department_name" value="" placeholder="<?php echo $this->lang->line('department_name');?>"  required ></td>
<td>
<button class="btn loginbtn-hollow" style="background-color:#ffffff;" type="submit"><?php echo $this->lang->line('add_new');?></button>

</td>
</tr>
</table>
</form>
</div>

</div>
</div>

</div>



</div>
</div>
