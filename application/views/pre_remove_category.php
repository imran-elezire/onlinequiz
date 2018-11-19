 <div class="container" style="text-align:center;">

   <div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">  
 <h3 class="ft_wt"><?php echo $title;?></h3>


  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		<div id="message"></div>
		
<form method="post" action="<?php echo site_url('qbank/remove_category/'.$cid);?>">

<div class="form-group">
<p style="color:rgb(255,0,140);"><?php echo $this->lang->line('remove_category_message');?></p> 
</div>
<div class="form-group">
 
 <select name="mcid">
 <?php 
 foreach($category_list as $gk => $val){
 if($cid != $val['cid']){ 
 ?>
 <option value="<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option>
 <?php 
 }
 }
 ?>
 </select>
 
 
</div>
  

 
<button class="btn loginbtn-hollow" style="background-color:#ffffff;" type="submit"><?php echo $this->lang->line('submit');?></button>
<a href="<?php echo site_url('qbank/category_list');?>" class="btn loginbtn-hollow"  ><?php echo $this->lang->line('cancel');?></a>
 
</td>
</tr>
</table>
</form>
</div>

</div>



</div>
<div>
