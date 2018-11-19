<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studymaterial extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
     $this->load->model("result_model");
		 $this->load->model("user_model");
		 $this->load->model("studymaterial_model");
	   $this->lang->load('basic', $this->config->item('language'));
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('login');

		}
		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['base_url'] != base_url()){
				$this->session->unset_userdata('logged_in');
			redirect('login');
		}

		if($logged_in['token']!="")
		{
			$user_id=$this->user_model->check_token($logged_in['token']);
			if($user_id!=$logged_in['uid'])
			{
				$this->session->unset_userdata('logged_in');
				redirect('login');
			}
		}
		else {
			$this->session->unset_userdata('logged_in');
			redirect('login');
		}

	 }

	public function index($limit='0',$status='0')
	{
		$data['title']=$this->lang->line('studymaterial');

		$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']=='1'){
				$gid=0;
			}
			else {
				$gid=$logged_in['gid'];
			}

      $data['limit']=$limit;
  		$data['status']=$status;

  		// fetching result list
  		//$data['result']=$this->result_model->result_list($limit,$status);
  		// fetching quiz list#

  		$data['material_list']=$this->studymaterial_model->get_material_by_gid($gid);
  		// group list
  		 $this->load->model("user_model");
  		$data['group_list']=$this->user_model->group_list();


		$this->load->view('header',$data);
		$this->load->view('studymaterial',$data);
		$this->load->view('footer',$data);
	}


  public function add()
  {
    $data['title']=$this->lang->line('studymaterial');
		// redirect if not loggedin
		if(!$this->session->userdata('logged_in')){
			redirect('login');

		}
		$logged_in=$this->session->userdata('logged_in');

		if($logged_in['base_url'] != base_url()){
		$this->session->unset_userdata('logged_in');
		redirect('login');
		}

		$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
			}

			$data['group_list']=$this->user_model->group_list();
			$data['category_list']=$this->studymaterial_model->get_category();

    $this->load->view('header',$data);
		$this->load->view('addstudymaterial',$data);
		$this->load->view('footer',$data);
  }


	public function insert_studymaterial()
{
			// redirect if not loggedin
	if(!$this->session->userdata('logged_in')){
		redirect('login');

	}
	$logged_in=$this->session->userdata('logged_in');
	if($logged_in['base_url'] != base_url()){
	$this->session->unset_userdata('logged_in');
	redirect('login');
	}


		$logged_in=$this->session->userdata('logged_in');
		if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'required');
		//$this->form_validation->set_rules('fileupload', 'fileupload', 'required');
		$this->form_validation->set_rules('category', 'category', 'required');

				 if ($this->form_validation->run() == FALSE)
							{
									 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
				redirect('studymaterial/add/');
							}
							else
							{
				$quid=$this->studymaterial_model->insert_studymaterial();

$btn=($quid['response']==true)?'success':'danger';

	$this->session->set_flashdata('message', "<div class='alert alert-".$btn."'>".$quid['message']."</div>");
redirect('studymaterial');




							}

}

		public function delete($id,$code)
		{
			if(!$this->session->userdata('logged_in')){
				redirect('login');

			}
			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['base_url'] != base_url()){
			$this->session->unset_userdata('logged_in');
			redirect('login');
			}


				$logged_in=$this->session->userdata('logged_in');
				if($logged_in['su']!='1'){
					exit($this->lang->line('permission_denied'));
				}

				if($id=="" || $code=="" || md5($id)!=$code)
				{
					exit($this->lang->line('permission_denied'));
				}

				if($this->studymaterial_model->delete_studymaterial($id))
				{
					redirect('studymaterial');
				}
		}






}
