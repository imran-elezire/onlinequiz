 <div class="container">

   
 <h3 class="ft_wt"><?php echo $title;?></h3>
   
 

  <div class="row">
   	
<div class="col-md-8">
<br> 
  
 
 <div class="alert alert-danger sha_div"><?php echo $this->lang->line('pending_quiz_message');?></div>
 <br><br>
 <h4 class="ft_wt" style="color:rgb(255,0,140);"><?php echo str_replace('[link]',site_url($openquizurl),$this->lang->line('manual_redirect'));?></h4>
 
 
</div>
       
</div>

 
 



</div>

<script>
setTimeout(function(){
window.location="<?php echo site_url($openquizurl);?>";
},7000);

</script>
