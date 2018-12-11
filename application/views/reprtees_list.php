
 <div class="container" style="text-align:center;">

 <div class="col-md-12 row-clr" style="background-color:#ffffff;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>
    <div class="row">

  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('user/reportees/');?>">
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

<th><?php echo $this->lang->line('account_status');?> </th>

<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php
if(count($reportees)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}
foreach($reportees as $key => $val){
?>
<tr>
 <td><?php echo $val['uid'];?></td>
<td><?php echo $val['email'].' '.$val['wp_user'];?></td>
<td><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
 <td><?php echo $val['user_status'];?></td>
 <td>

<a href="<?php echo site_url('user2/view_reportees/'.$val['uid']);?>"><i class="fa fa-eye" style="color:rgb(255,0,140);" title="View Profile"></i></a>
<a href="<?php echo site_url('result/reportees_result_list/'.$val['uid']);?>"><button class="btn loginbtn-hollow" style="background-color:#ffffff;">Result</button></a>
<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#verify_changes<?php echo $val['uid']; ?>">Verify Changes</a>
<div id="verify_changes<?php echo $val['uid']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Verify Changes for <?php echo $val['first_name'].$val['last_name']; ?></h4>
      </div>
      <div class="modal-body">
        <?php
          if($val['changes']==False)
          {
            echo "<p>There is no changes !</p>";
          }
          else {
         ?>
          <table class="table table bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Request for</th>
                <th>Current Use</th>
                <th>New Changes</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i=1;
                foreach ($val['changes'] as $key => $value) {
                  $change_for=$value->change_for;
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $val['first_name'].$val['last_name']; ?></td>
                <td><?php echo $value->change_for; ?></td>
                <td><?php echo $val[$value->change_for]; ?></td>
                <td><?php echo $value->$change_for; ?></td>
                <td>
                  <a href="<?php echo site_url('user/verify_user_changes/'.$val['uid'].'/'.$value->change_id.'/0/'.md5($val['uid'].$value->change_id.'Ash')); ?>" class="btn btn-xs btn-success">Accept</a>
                  <a href="<?php echo site_url('user/verify_user_changes/'.$val['uid'].'/'.$value->change_id.'/-1/'.md5($val['uid'].$value->change_id.'Ash')); ?>" class="btn btn-xs btn-danger">Reject</a>
                </td>
              </tr>
              <?php
                  $i++;
                }
               ?>
            </tbody>
          </table>
         <?php
       }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</td>
</tr>

<?php
}
?>
</table>
</div>

</div>


<!-- <?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('user/index/'.$back);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('user/index/'.$next);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
 -->




</div>
</div>
