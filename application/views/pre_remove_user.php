 <div class="container">


 <h3><?php echo $title;?></h3>


  <div class="row">

<div class="col-md-12">
<br>
			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>
		<div id="message"></div>

		 <form method="post" action="<?php echo site_url('user/remove_user/'.$uid);?>">

<div class="form-group">
 Select Manager in which yo want to move reportees. 
</div>
<div class="form-group">

 <select name="muid">
 <?php
 foreach($user_list as $gk => $val){
 if($uid != $val['uid']){
 ?>
 <option value="<?php echo $val['uid'];?>"><?php echo $val['first_name']." ".$val['last_name'];?></option>
 <?php
 }
 }
 ?>
 </select>


</div>



<button class="btn btn-danger" type="submit"><?php echo $this->lang->line('submit');?></button>
<a href="<?php echo site_url('user');?>" class="btn btn-default"  ><?php echo $this->lang->line('cancel');?></a>

</td>
</tr>
</table>
</form>
</div>

</div>



</div>
