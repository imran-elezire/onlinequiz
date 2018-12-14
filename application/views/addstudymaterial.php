
 <div class="container" style="text-align:center;">

<div class="col-md-12 row-clr" style="background-color:#ffffff;height:100%;margin-top:-25px;">
 <h3 class="ft_wt"><?php echo $title;?></h3>





 <div class="row">
    <form method="post" action="<?php echo site_url('studymaterial/insert_studymaterial/');?>" enctype="multipart/form-data">

<div class="col-md-8 col-md-offset-2">
<br>

 <div class="login-panel panel panel-default sha_div" style="overflow-x:auto;">
		<div class="panel-body">





     <?php
   if($this->session->flashdata('message')){
     echo $this->session->flashdata('message');
   }
   ?>


         <div class="form-group">
         <label for="inputEmail" class="sr-only"><?php echo $this->lang->line('title');?></label>
         <input type="text" name="title"  class="form-control" placeholder="<?php echo $this->lang->line('title');?>"  required autofocus>
     </div>
       <div class="form-group">
         <label for="inputEmail"  ><?php echo $this->lang->line('description');?></label>
         <textarea   name="description"  class="tinymce_textarea" ></textarea>
     </div>
     <div class="form-group">
       <label for="inputEmail">Select Type</label>
       <input type="radio" name="link_type" class="type_material" data-id="file" value="file" checked> File
       <input type="radio" name="link_type" class="type_material" data-id="link" value="link"> Youtube/Other Link

   </div>
   <div class="form-group  material_type link_upload"  style="display:none;">
        <label for="inputEmail">Link</label>
        <input type="text" name="link" class="form-control">
    </div>
    <div class="form-group  material_type file_upload">
         <label for="inputEmail"  ><?php echo $this->lang->line('fileupload');?></label>
         <input type="file" name="file_upload"  class="form-control" >
     </div>

				<div class="form-group">
					<label for="inputEmail"  ><?php echo $this->lang->line('category');?></label>
					<select name="category"  class="form-control" required>
            <option>-- Select One --</option>
            <?php foreach($category_list as $key=>$val) {?>
            <option value='<?php echo $val['cid'] ?>'><?php echo $val['category_name'] ?></option>
            <?php } ?>
          </select>
			</div>
				<div class="form-group">
					<label for="inputEmail"  ><?php echo $this->lang->line('select_group');?></label> <br>
          <select name="gids[]"  class="form-control" multiple required>
          <?php foreach($group_list as $key=>$val) {?>
            <option value="<?php echo $val['gid'] ?>" <?php if($key==0){ echo 'selected'; } ?>><?php echo $val['group_name'] ?></option>
					<!-- <input type="checkbox" name="gids[]"  value="<?php echo $val['gid'] ?>" <?php if($key==0){ echo 'checked'; } ?> > <?php echo $val['group_name'] ?>&nbsp;&nbsp;&nbsp; -->
        <?php } ?>
      </select>
			</div>






	<button class="btn loginbtn" type="submit"><?php echo $this->lang->line('submit');?></button>

 <br><br><br>

		</div>

</div>




</div>
     </form>
</div>





</div>
</div>

<script>
$(document).ready(function(){
 $(".type_material").click(function() {

   var cl= $(this).attr("data-id");
   $(".material_type").css("display","none");
   $("."+cl+"_upload").css("display","block");
 });
});
</script>
