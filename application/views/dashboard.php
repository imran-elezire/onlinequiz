 <style>
.txtVertical
{
	 position: fixed;

    right: 0px;
    bottom: 0px;
}

.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<div class="container">



<div id="update_notice"></div>


<div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">
<div class="row" style="display: inline; float: none;margin-top:10px;">

<div class="col-md-4" style="margin-top:20px;font-size:16px">
                    <div class="panel panel-info sha_div">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                <i class="fa fa-user-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" style="font-size:24px;font-weight:bold;"><?php echo $num_users;?></div>
                                    <div><?php echo $this->lang->line('no_registered_user');?> </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('user');?>">
                            <div class="panel-footer">
                                <span class="pull-left" style="color: rgb(255,0,140);"><?php echo $this->lang->line('users');?> <?php echo $this->lang->line('list');?></span>
                                <span><a href="<?php echo site_url('user/new_user'); ?>" style="color: rgb(255,0,140);"><i class="fa fa-plus fa-2x" style="padding-left:40px;"></i></a></span>
                                <span class="pull-right"><a href="<?php echo site_url('user');?>" style="color: rgb(255,0,140);"><i class="fa fa-arrow-circle-right fa-2x"></i></a></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
</div>


<div class="col-md-4" style="margin-top:20px;font-size:16px">
                    <div class="panel panel-info sha_div">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" style="font-size:24px;font-weight:bold;"><?php echo $num_quiz;?></div>
                                    <div><?php echo $this->lang->line('no_registered_quiz');?> </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('quiz');?>">
                            <div class="panel-footer">
                                <span class="pull-left" style="color: rgb(255,0,140);"><?php echo $this->lang->line('quiz');?> <?php echo $this->lang->line('list');?></span>
                                <span><a href="<?php echo site_url('quiz/add_new'); ?>" style="color: rgb(255,0,140);"><i class="fa fa-plus fa-2x" style="padding-left:40px;"></i></a></span>
                                <span class="pull-right"><a href="<?php echo site_url('quiz');?>" style="color: rgb(255,0,140);"><i class="fa fa-arrow-circle-right fa-2x"></i></a></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
</div>

<div class="col-md-4" style="margin-top:20px;font-size:16px">
                    <div class="panel panel-info sha_div">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" style="font-size:24px;font-weight:bold;"><?php echo $num_qbank;?></div>
                                    <div><?php echo $this->lang->line('no_questions_qbank');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('qbank');?>">
                            <div class="panel-footer">
                            <span class="pull-left" style="color: rgb(255,0,140);"><?php echo $this->lang->line('question');?> <?php echo $this->lang->line('list');?></span>
                            <span><a href="<?php echo site_url('qbank/pre_new_question');?>" style="color: rgb(255,0,140);"><i class="fa fa-plus fa-2x" style="padding-left:40px;"></i></a></span>
                                <span class="pull-right"><a href="<?php echo site_url('qbank');?>" style="color: rgb(255,0,140);"><i class="fa fa-arrow-circle-right fa-2x"></i></a></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
 </div>





</div>

<div class="row"></div>






<div class="row" style="display: inline; float: none;">
      <div class="col-lg-8 col-lg-offset-2">


<div class="row">

 <div class="col-lg-6 " >
 <div class="panel panel" >
                        <div class="panel-heading"  style="background-color:rgb(3, 151, 35);text-align:center;">

    <div class="font-size-34"> <strong style="color:#ffffff;"><?php echo $active_users;?></strong>
    <br>
    <small class="font-weight-light text-muted" style="font-size:18px;color:#eeeeee;"><?php echo $this->lang->line('active');?> <?php echo $this->lang->line('users');?></small>

</div>


                        </div>
 </div>
</div>
 <div class="col-lg-6">
 <div class="panel panel" >
                        <div class="panel-heading"  style="background-color:rgb(216, 33, 49);text-align:center;">

    <div class="font-size-34" > <strong style="color:#ffffff;"><?php echo $inactive_users;?></strong>
    <br>
    <small class="font-weight-light text-muted" style="font-size:18px;color:#eeeeee;"><?php echo $this->lang->line('inactive');?> <?php echo $this->lang->line('users');?></small>

</div>


                        </div>
                        </div>
</div>


</div>


        <!-- recent users -->

        <div class="panel">
          <div class="panel-heading">
            <div class="panel-title" style="font-weight:bold;font-size:20px;"><?php echo $this->lang->line('recently_registered');?></div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped valign-middle">
              <thead>
                <tr><th><?php echo $this->lang->line('email');?></th>
                <th class="text-xs-right"><?php echo $this->lang->line('first_name');?> <?php echo $this->lang->line('last_name');?></th>
                <th class="text-xs-right"><?php echo $this->lang->line('group_name');?></th>
                <th class="text-xs-right"><?php echo $this->lang->line('contact_no');?></th>
                <th class="text-xs-right">Manager</th>
                <th></th>
              </tr></thead>
              <tbody style="color:rgb(128, 128, 128);font-weight:500;">
              <?php
if(count($result)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}
foreach($result as $key => $val){
?><tr>
<td>
<a style="color:rgb(255,0,140)" href="<?php echo site_url('user/edit_user/'.$val['uid']);?>"><?php echo $val['email'];?> <?php echo $val['wp_user'];?></a></td>
<td  class="text-xs-right"><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
 <td  class="text-xs-right"><?php echo $val['group_name'];?></td>
<td  class="text-xs-right"><?php echo $val['contact_no'];?></td>

<td class="text-xs-right"><?php if($val['manager_first']==""){echo "NA";}else {echo $val['manager_first']." ".$val['manager_last'];}?></td>


              </tr>

             <?php
             }
             ?>

            </tbody></table>
          </div>
        </div>

        <!-- recent users -->

      </div>
      <div class="col-lg-5">


    </div>















</div>
            </div>

<div class="row text-center">

</div>
