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

		 <form method="post" action="<?php echo site_url('user/remove_group/'.$gid);?>">

<div class="form-group">
 <p style="color:rgb(255,0,140);"><?php echo $this->lang->line('remove_group_message');?></p>
</div>
<div class="form-group">

 <select name="mgid">
 <?php
 foreach($group_list as $gk => $val){
 if($gid != $val['gid']){
 ?>
 <option value="<?php echo $val['gid'];?>"><?php echo $val['group_name'];?></option>
 <?php
 }
 }
 ?>
 </select>


</div>



<button class="btn loginbtn-hollow" style="background-color:#ffffff;" type="submit"><?php echo $this->lang->line('submit');?></button>
<a href="<?php echo site_url('user/group_list');?>" class="btn loginbtn-hollow"  ><?php echo $this->lang->line('cancel');?></a>

</td>
</tr>
</table>
</form>
</div>

</div>



</div>
</div>
