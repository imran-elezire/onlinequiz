 <div class="container">

   
 
  



<div class="row" style="display: inline; float: none;">


<form class="form-signin" method="post" action="<?php echo site_url('dashboard/config');?>" >
<h4 class="ft_wt"><?php echo $this->lang->line('config');?></h4>
<br>

			<h5 class="ft_wt" style="color: rgb(255, 0, 140);"><?php echo $this->lang->line('config_warning');?></h5>
			
<br>
<div class="form-group" style="overflow-x:auto;">	
<textarea class="login-panel panel panel-default sha_div" name="config_val" style="width:800px;height:500px;"><?php echo $result;?></textarea>
 

 			</div>
 			<div class="form-group">
			
					<button class="btn btn-primary loginbtn sha_div" type="submit"><?php echo $this->lang->line('submit');?></button>
			</div>
 <input type="checkbox" name="force_write"> <span style="font-size:11px; color: rgb(255, 0, 140);" class="ft_wt"> Tick if server required 777 permission to write file </span>

			</form>
</div>
 



</div>

<br><br>