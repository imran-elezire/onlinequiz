 <div class="container" style="text-align:center;">

 <div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">
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

		 <a href="<?php echo site_url('user/add_new_group');?>" class="btn loginbtn-hollow">Add New</a>
		 <br><br>

<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('group_name');?></th>

<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php
if(count($group_list)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}

foreach($group_list as $key => $val){
?>
<tr>
 <td> <?php echo $val['group_name'];?></td>
<td>
<a href="<?php echo site_url('user/edit_group/'.$val['gid']);?>"><i style="color:rgb(255,0,140)" class="fa fa-pencil" aria-hidden="true"></i></a>
<a href="<?php echo site_url('user/pre_remove_group/'.$val['gid']);?>"><i style="color:rgb(255,0,140)" class="fa fa-times" aria-hidden="true"></i></a>

</td>
</tr>

<?php
}
?>

</table>


</div>

</div>
</div>

</div>



</div>
</div>
