<div class="row"  style="display: inline; float: none;">
<div class="col-lg-8 col-lg-offset-2" style="margin-top:5px;">


 <div class="container login-panel panel panel-default panel-body sha_div" style="text-align: center;">
 <a href="<?php echo base_url();?>"><img src="<?php echo base_url('images/logo.png');?>"></a><br>
 <h4 class="logintag"><?php echo $this->lang->line('login_tagline');?></h4><br>
    <a style="font-weight:bold;font-size:18px;color:rgb(255, 0 , 140);" href="<?php echo site_url('login');?>">Already Registered? Login</a>


 <h3><?php echo $title;?></h3>

  <div class="row" >
  
  
  
  
  

    <?php
    $cc=0;
$colorcode=array(
'info',
'info',
'info',
'info'
);
    foreach($group_list as $k => $val){

   ?>
	                <!-- item -->
                    
                <div class="col-md-6 text-center">
                    <div class="panel panel-<?php echo $colorcode[$cc];?> panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3><?php echo $val['group_name'];?></h3>
                        </div>
                        <div class="panel-body text-center">

                          <?php
                          echo $val['description'];?>
                          <hr>
                          <!-- Price:
<?php
if($val['price']==0){
echo "0";
}else{
echo $this->config->item('base_currency_prefix').' '.$val['price'].' '.$this->config->item('base_currency_sufix');
}
?> -->

                        </div>

                        <div class="panel-footer">


<a href="<?php echo site_url('login/registration/'.$val['gid']);?>" class="btn btn-lg btn-primary btn-block loginbtn"  ><?php echo $this->lang->line('register');?> </a>


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
    ?>

</div>








</div>
</div>
</div>


<script>

</script>
