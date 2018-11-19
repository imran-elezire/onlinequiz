 <div class="container con_cen">


 <div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">  
 <h3 class="ft_wt"><?php echo $title;?></h3>
   


  <div class="row align-self-center" style="display: inline; float: none;">
     <form method="post" action="<?php echo site_url('qbank/pre_new_question/');?>">

	
<div class="col-md-8 col-md-offset-2">
<br> 
 <div class="login-panel panel panel-default sha_div">
		<div class="panel-body"> 
	
	
	
			<?php 

		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>



				<div class="form-group">
					<label   ><?php echo $this->lang->line('select_question_type');?></label>
					<select class="form-control" name="question_type" onChange="hidenop(this.value);">
						<option value="1"><?php echo $this->lang->line('multiple_choice_single_answer');?></option>
						<option value="2"><?php echo $this->lang->line('multiple_choice_multiple_answer');?></option>
						<option value="3"><?php echo $this->lang->line('match_the_column');?></option>
						<!-- <option value="4"><?php echo $this->lang->line('short_answer');?></option>
						<option value="5"><?php echo $this->lang->line('long_answer');?></option> -->

					</select>
			</div>

			<div class="form-group" id="nop" >
					<label for="inputEmail"  ><?php echo $this->lang->line('nop');?></label>
					<input type="text"   name="nop"  class="form-control" value="4"   >
			</div>



 
	<button class="btn btn-primary btn-block loginbtn" type="submit"><?php echo $this->lang->line('next');?></button>
 

		</div>
</div>




</div>
      </form>
</div>





</div>
	</div>
