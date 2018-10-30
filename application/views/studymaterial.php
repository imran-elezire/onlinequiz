 <div class="container">
<?php
$logged_in=$this->session->userdata('logged_in');
?>



<?php
if($logged_in['su']=='1'){
	?>
   <div class="row">

  <div class="col-lg-12">

  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<?php
}
?>


<h3><?php echo $title;?></h3>

  <div class="row">

  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('studymaterial/index/');?>">
	<div class="input-group">
    <!-- <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
      </span> -->


    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->



  <div class="row">

<div class="col-md-12">
<br>
			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>
		<?php
		if($logged_in['su']=='1'){
			?>
      <button class="btn btn-info btn-sm" onclick="window.location='<?php echo site_url('studymaterial/add'); ?>';">Add New</button><br><br>
		<?php
		}
		?>
<table class="table table-bordered">
<tr>
 <th width='5%'><?php echo $this->lang->line('studymaterial_id');?></th>
<th><?php echo $this->lang->line('studymaterial_title');?></th>
 <th><?php echo $this->lang->line('studymaterial_desc');?></th>
 <th><?php echo $this->lang->line('studymaterial_cat');?>

<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php
if(count($material_list)==0){
	?>
<tr>
 <td colspan="6"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}

foreach($material_list as $key => $val){
?>
<tr>
 <td><?php echo $val['material_id'];?></td>
<td><?php echo $val['title'];?> </td>
 <td><?php echo $val['description'];?></td>
 <td><?php echo $val['category_name']; ?></td>

<td>
<a href="<?php echo $val['file'];?>" class="btn btn-success" target="_blank"><?php echo $this->lang->line('view');?> </a>
<?php
if($logged_in['su']=='1'){
	?>
	<a href="javascript:remove_material('<?php echo $val['material_id'];?>','<?php echo md5($val['material_id']);?>');" ><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php
}
?>
</td>
</tr>

<?php
}
?>
</table>
</div>

</div>


<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<!-- <a href="<?php echo site_url('result/index/'.$back.'/'.$status);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a> -->
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<!-- <a href="<?php echo site_url('result/index/'.$next.'/'.$status);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a> -->





</div>

<script>
function remove_material(id,code)
{
  var check = confirm('Are you want to delete it ?');
  if(check)
  {
    window.location = base_url+'index.php/studymaterial/delete/'+id+'/'+code;
  }
}
</script>
