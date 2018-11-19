 <div class="container" style="text-align:center;">
 <?php 
 $logged_in=$this->session->userdata('logged_in');
		
		?>  
 
 <div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;"> 
 <h3 class="ft_wt"><?php echo $title;?></h3>
    <div class="row">
 
  <div class="col-lg-6 col-lg-offset-3">
    <form method="post" action="<?php echo site_url('notification/index/');?>">
	<div class="input-group ">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" style="background-image: linear-gradient(to bottom, rgb(255, 0, 140),rgb(255, 0, 140),rgb(226, 15, 68));color:#ffffff;" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>
	 
	  
    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


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
		
 <a href="<?php echo site_url('notification/add_new');?>" class="btn loginbtn-hollow"><?php echo $this->lang->line('add_new');?></a><br><br>
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('title');?></th>
<th><?php echo $this->lang->line('message');?> </th>
<?php
if($logged_in['su']=='1'){
?>
<th><?php echo $this->lang->line('click_action');?></th>
<th><?php echo $this->lang->line('notification_to');?> </th> 
<?php 
}
?>
<th><?php echo $this->lang->line('date');?> </th> 
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="6"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['nid'];?></td>
 <td><a style="color:rgb(255,0,140);" href="<?php echo $val['click_action'];?>" target="fcmclick"><?php echo $val['title'];?></a></td>
  <td><?php echo $val['message'];?></td>
  <?php
if($logged_in['su']=='1'){
?>
 <td><?php echo $val['click_action'];?></td>
 <td><?php 
 if($val['uid']==0){
 ?>
 <?php echo $this->lang->line('all_users');?>
 <?php
  }else{ 
 ?><a style="color:rgb(255,0,140);" href="<?php echo site_url('user/edit_user/'.$val['uid']);?>"><?php echo $val['first_name'].' '.$val['last_name'];?></a>
 <?php 
 }
 ?>
 
 </td>
 <?php 
 }
 ?>
<td><?php echo $val['notification_date'];?></td>
 
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

<a href="<?php echo site_url('notification/index/'.$back);?>"  class="btn loginbtn-hollow"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('notification/index/'.$next);?>"  class="btn loginbtn-hollow"><?php echo $this->lang->line('next');?></a>





</div>
</div>
