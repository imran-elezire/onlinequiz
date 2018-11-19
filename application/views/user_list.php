 <div class="container" style="text-align:center;">

<div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>
    <div class="row">

  <div class="col-lg-6 col-lg-offset-3">
    <form method="post" action="<?php echo site_url('user/index/');?>">
	<div class="input-group sha_div">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" style="background-image: linear-gradient(to bottom, rgb(255, 0, 140),rgb(255, 0, 140),rgb(226, 15, 68));color:#ffffff;" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>


    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


  <div class="row" >

<div class="col-md-12">
<br>
<div class="login-panel panel panel-default sha_div" style="overflow-x:auto;">
		<div class="panel-body">
			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>

<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('email');?></th>
<th><?php echo $this->lang->line('first_name');?> <?php echo $this->lang->line('last_name');?></th>
<th>Manager</th>
<th><?php echo $this->lang->line('account_status');?> </th>
<th><?php echo $this->lang->line('send_notification');?> </th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php
if(count($result)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['uid'];?></td>
<td><?php echo $val['email'].' '.$val['wp_user'];?></td>
<td><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
<td><?php if($val['manager_first']==""){echo "NA";}else {echo $val['manager_first'];?> <?php echo $val['manager_last'];}?></td>
 <td><?php echo $val['user_status'];?></td>
 <td><a style="color:rgb(255,0,140)" href="<?php echo site_url('notification/add_new/'.$val['uid']);?>"><?php echo $this->lang->line('send_notification');?></a></td>
<td>

<a href="<?php echo site_url('user2/view_user/'.$val['uid']);?>"><i style="color:rgb(255,0,140)" class="fa fa-eye" title="View Profile"></i></a>

<a href="<?php echo site_url('user/edit_user/'.$val['uid']);?>"> <i style="color:rgb(255,0,140)" class="fa fa-pencil" aria-hidden="true"></i></a>
<a href="javascript:remove_entry('user/pre_remove_user/<?php echo $val['uid'];?>');"> <i style="color:rgb(255,0,140)" class="fa fa-times" aria-hidden="true"></i></a>

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


<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('user/index/'.$back);?>"  class="btn loginbtn-hollow "><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('user/index/'.$next);?>"  class="btn loginbtn-hollow "><?php echo $this->lang->line('next');?></a>





</div>
</div>
