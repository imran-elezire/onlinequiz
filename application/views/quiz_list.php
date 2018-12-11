
 <div class="container" style="text-align:center;">
<?php
$logged_in=$this->session->userdata('logged_in');


			?>
<div class="col-md-12 row-clr" style="background-color:#ffffff;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>
    <?php


	if($logged_in['su']=='1'){
		?>
		<div class="row">

  <div class="col-lg-6 col-lg-offset-3">
    <form method="post" action="<?php echo site_url('quiz/index/0/'.$list_view);?>">
	<div class="input-group sha_div">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default " style="background-image: linear-gradient(to bottom, rgb(255, 0, 140),rgb(255, 0, 140),rgb(226, 15, 68));color:#ffffff;" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>


    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
  <!-- <div class="col-lg-6" style="float:right;">

  <p class="ft_wt" style="float:right;color:rgb(255, 0, 140);">
  <?php
  if($list_view=='grid'){
	  ?>
	  <a  style="color:rgb(255, 0, 140);" href="<?php echo site_url('quiz/index/'.$limit.'/table');?>"><?php echo $this->lang->line('table_view');?></a>
	  <?php
  }else{
	  ?>
	   <a style="color:rgb(255, 0, 140);" href="<?php echo site_url('quiz/index/'.$limit.'/grid');?>"><?php echo $this->lang->line('grid_view');?></a>

	  <?php

  }
  ?>
  </p>

  </div> -->
</div><!-- /.row -->

<?php
	}
?>

  <div class="row">

<div class="col-md-12">

<br>
<!-- <div class="login-panel panel panel-default sha_div" style="overflow-x:auto;">
		<div class="panel-body"> -->
			<?php


		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>
		<?php
  if($list_view=='table'){
	  ?>
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('quiz_name');?>aa</th>
<th><?php echo $this->lang->line('noq');?></th>
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
 <td><?php echo $val['quid'];?></td>
 <td><?php echo substr(strip_tags($val['quiz_name']),0,50);?></td>
<td><?php echo $val['noq'];?></td>
 <td>
   <?php
   if($logged_in['su']!=1){
     ?>
<a href="<?php echo site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>
<?php } ?>
<?php
if($logged_in['su']=='1'){
	?>

<a href="<?php echo site_url('quiz/edit_quiz/'.$val['quid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php
}
?>
</td>
</tr>

<?php
}
?>
</table>

  <?php
  }else{
	  ?>
	  <?php
if(count($result)==0){
	?>
<?php echo $this->lang->line('no_record_found');?>
	<?php
}
$cc=0;
$colorcode=array(
'info',
'info',
'info',
'info',
);
foreach($result as $key => $val){
?>

	                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-<?php echo $colorcode[$cc];?> panel-pricing sha_div">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3><?php echo substr(strip_tags($val['quiz_name']),0,50);?></h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $this->lang->line('duration');?> <?php echo $val['duration'];?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $this->lang->line('noq');?>:  <?php echo $val['noq'];?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <b>Start Date</b>: <?php echo date("d-m-Y h:i:s",$val['start_date']);?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <b>End Date</b>: <?php echo date("d-m-Y h:i:s",$val['end_date']);?></li>

                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $this->lang->line('maximum_attempts');?>: <?php echo $val['maximum_attempts'];?></li>
                            <!-- <li class="list-group-item"><i class="fa fa-check"></i> Attempted: <?php echo $val['maximum_attempts_by_user'];?></li> -->

                            </ul>
                        <div class="panel-footer">

                          <?php
                          if($logged_in['su']!=1){
                            ?>
<a href="<?php echo ($val['end_date']<=time() || $val['maximum_attempts_by_user']>=$val['maximum_attempts'])?"#":site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-<?php echo ($val['end_date']<=time() || $val['maximum_attempts_by_user']>=$val['maximum_attempts'])?"danger":"success"; ?>" style="background-image: linear-gradient(to bottom, rgb(255, 0, 140),rgb(255, 0, 140),rgb(226, 15, 68));color:#ffffff;border:none;" ><?php echo ($val['end_date']<=time())?"Expired":$this->lang->line('attempt');?> </a>
<?php } ?>
<?php
if($logged_in['su']=='1'){
	?>

<a href="<?php echo site_url('quiz/edit_quiz/'.$val['quid']);?>"><i style="color:rgb(255,0,140)" class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
<a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid'];?>');"><i style="color:rgb(255,0,140)" class="fa fa-times fa-2x" aria-hidden="true"></i></a>
<?php
}
?>


                        </div>
                    </div>
                </div>
                <!-- /item -->


	  <?php
	  if($cc >= 4){
	  $cc=0;
	  }else{
	  $cc+=1;
	  }

}

  }
  ?>

</div>

</div>
<!-- </div>

</div> -->
<br><br>

<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a style="margin-top:-50px;" href="<?php echo site_url('quiz/index/'.$back.'/'.$list_view);?>"  class="btn loginbtn-hollow"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a style="margin-top:-50px;" href="<?php echo site_url('quiz/index/'.$next.'/'.$list_view);?>"  class="btn loginbtn-hollow"><?php echo $this->lang->line('next');?></a>




<div class="col-lg-12" style="height:13%">

</div>
<div class="col-lg-12">

</div>
</div>
</div>
