<?php
Class Studymaterial_model extends CI_Model
{

    function get_category()
    {
        $query=$this->db->get('savsoft_category');
      	 return $query->result_array();
    }

    function get_material_by_gid($gid)
    {
      if($gid!=0)
      {
        $where="FIND_IN_SET('".$gid."', gids)";
  			 $this->db->where($where);
      }
      $this->db->where('status',1);
      $this->db->join('savsoft_category', 'savsoft_category.cid = savsoft_studymaterial.cid','left');
      $query=$this->db->get('savsoft_studymaterial');
       return $query->result_array();
    }


    function insert_studymaterial(){
      $logged_in=$this->session->userdata('logged_in');

      $userdata=array(
      'title'=>$this->input->post('title'),
      'description'=>$this->input->post('description'),
      'cid'=>$this->input->post('category'),
      'description'=>$this->input->post('description'),
      'gids'=>implode(',',$this->input->post('gids')),
      'uid'=>$logged_in['uid'],
      'link_type'=>$this->input->post('link_type'),
      'link'=>$this->input->post('link'),
      );


       $this->db->insert('savsoft_studymaterial',$userdata);
      $material_id=$this->db->insert_id();
      $target_dir = APPPATH."../studymaterial/";
      $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
      $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $filename =$material_id.".".$FileType;
      $upadedata = array();
      if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_dir.$filename)) {
        $upadedata['file']=base_url('studymaterial/'.$filename);
        $upadedata['file_type']=$FileType;
      } else {
          echo "Sorry, there was an error uploading your file.";
          //$upadedata['status']=0;
      }
      $this->db->where('material_id',$material_id);
  		if($this->db->update('savsoft_studymaterial',$upadedata))
      {
        return true;
      }
      else {
        return false;
      }


    }

    function delete_studymaterial($material_id)
    {
      $upadedata = array();
      $upadedata['status']=0;
      $this->db->where('material_id',$material_id);
      if($this->db->update('savsoft_studymaterial',$upadedata))
      {
        return true;
      }
      else {
        return false;
      }
    }


}












?>
