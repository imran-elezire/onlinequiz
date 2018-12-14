<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   $this->load->database();
	   $this->load->helper('url');
	   $this->load->model("user_model");
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

	public function index($limit='0')
	{
		$logged_in=$this->session->userdata('logged_in');

			if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
			}


		$data['limit']=$limit;
		$data['title']=$this->lang->line('userlist');
		// fetching user list
		$data['result']=$this->user_model->user_list($limit);
		$this->load->view('header',$data);
		$this->load->view('user_list',$data);
		$this->load->view('footer',$data);
	}

	public function new_user()
	{

			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
			}


		 $data['title']=$this->lang->line('add_new').' '.$this->lang->line('user');
		// fetching group list
		$data['group_list']=$this->user_model->group_list(1);
		$data['department_list']=$this->user_model->department_list(1);
		$data['user_list']=$this->user_model->get_user_by_usertype('0');
		 $this->load->view('header',$data);
		$this->load->view('new_user',$data);
		$this->load->view('footer',$data);
	}

		public function insert_user()
	{


			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[savsoft_users.email]');
		$this->form_validation->set_rules('contact_no', 'Contact', 'required|is_unique[savsoft_users.contact_no]');
        $this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');

				$this->form_validation->set_rules('employee_id', 'Employee Id', 'required');
				$this->form_validation->set_rules('designation', 'Designation', 'required');
				$this->form_validation->set_rules('department', 'Department', 'required');

          if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('user/new_user/');
                }
                else
                {
					if($this->user_model->insert_user()){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

					}
					redirect('user/new_user/');
                }

	}

		public function remove_user($uid,$status=''){

			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}


			if($this->user_model->remove_user($uid,$status)){

				if($status==0)
										$this->session->set_flashdata('message', "<div class='alert alert-success'>Disable Successfully</div>");
				else {
					$this->session->set_flashdata('message', "<div class='alert alert-success'>Enable Successfully</div>");
				}


					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

					}
					redirect('user');


		}

	public function edit_user($uid)
	{
			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
			 $uid=$logged_in['uid'];
			}

			$data['uid']=$uid;
		 $data['title']=$this->lang->line('edit').' '.$this->lang->line('user');
		// fetching user
		$data['result']=$this->user_model->get_user($uid);
		$data['user_list']=$this->user_model->get_user_by_usertype('0');
				$data['department_list']=$this->user_model->department_list(1);
		$this->load->model("payment_model");
		$data['payment_history']=$this->payment_model->get_payment_history($uid);
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		 $this->load->view('header',$data);
			if($logged_in['su']=='1'){
		$this->load->view('edit_user',$data);
			}else{
		$this->load->view('myaccount',$data);

			}
		$this->load->view('footer',$data);
	}

		public function update_user($uid)
	{


			$logged_in=$this->session->userdata('logged_in');

			if($logged_in['su']!='1'){
			 $uid=$logged_in['uid'];
			}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');

						$this->form_validation->set_rules('first_name', 'First Name', 'required');
						$this->form_validation->set_rules('last_name', 'Last Name', 'required');
						$this->form_validation->set_rules('contact_no', 'Contact', 'required');
						$this->form_validation->set_rules('employee_id', 'Employee Id', 'required');
						$this->form_validation->set_rules('designation', 'Designation', 'required');
						$this->form_validation->set_rules('department', 'Department', 'required');
           if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('user/edit_user/'.$uid);
                }
                else
                {
					if($this->user_model->update_user($uid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");

					}
					redirect('user/edit_user/'.$uid);
                }

	}


	public function group_list(){

		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$data['title']=$this->lang->line('group_list');
		$this->load->view('header',$data);
		$this->load->view('group_list',$data);
		$this->load->view('footer',$data);




	}

	public function add_new_group(){
	                $logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
			}



		if($this->input->post('group_name')){
		if($this->user_model->insert_group()){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");

					}
					redirect('user/group_list');
		}
		// fetching group list
		$data['title']=$this->lang->line('add_group');
		$this->load->view('header',$data);
		$this->load->view('add_group',$data);
		$this->load->view('footer',$data);




	}



	public function edit_group($gid){
	                $logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
			exit($this->lang->line('permission_denied'));
			}

		if($this->input->post('group_name')){
		if($this->user_model->update_group($gid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");

					}
					redirect('user/group_list');
		}
		// fetching group list
		$data['group']=$this->user_model->get_group($gid);
		$data['gid']=$gid;
		$data['title']=$this->lang->line('edit_group');
		$this->load->view('header',$data);
		$this->load->view('edit_group',$data);
		$this->load->view('footer',$data);




	}

        public function upgid($gid){
        $logged_in=$this->session->userdata('logged_in');
			$uid=$logged_in['uid'];
			$group=$this->user_model->get_group($gid);
		if($group['price'] != '0'){
		redirect('payment_gateway_2/subscribe/'.$gid.'/'.$logged_in['uid']);
		 }else{
		$subscription_expired=time()+(365*20*24*60*60);
		}
			$userdata=array(
			'gid'=>$gid,
			'subscription_expired'=>$subscription_expired
			);

			$this->db->where('uid',$uid);
			$this->db->update('savsoft_users',$userdata);
			 $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('group_updated_successfully')." </div>");
			redirect('user/edit_user/'.$logged_in['uid']);


        }
		public function switch_group()
	{

		$logged_in=$this->session->userdata('logged_in');
		if(!$this->config->item('allow_switch_group')){
		redirect('user/edit_user/'.$logged_in['uid']);
		}
			$data['title']=$this->lang->line('select_package');
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$this->load->view('header',$data);
		$this->load->view('change_group',$data);
		$this->load->view('footer',$data);
	}

	public function pre_remove_group($gid){
		$data['gid']=$gid;
		// fetching group list
		$data['group_list']=$this->user_model->group_list();
		$data['title']=$this->lang->line('remove_group');
		$this->load->view('header',$data);
		$this->load->view('pre_remove_group',$data);
		$this->load->view('footer',$data);


	}

	public function pre_remove_user($uid){
		$data['uid']=$uid;
		// fetching group list
		$data['user_list']=$this->user_model->get_user_by_usertype('0');
		$data['title']='Remove User';
		$this->load->view('header',$data);
		$this->load->view('pre_remove_user',$data);
		$this->load->view('footer',$data);


	}

		public function insert_group()
	{


			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}

				if($this->user_model->insert_group()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

				}
				redirect('user/group_list/');

	}

			public function update_group($gid)
	{


			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}

				if($this->user_model->update_group($gid)){
                echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
				}else{
				 echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";

				}


	}


	function get_expiry($gid){

		echo $this->user_model->get_expiry($gid);

	}




			public function remove_group($gid,$status){
                        $mgid=$this->input->post('mgid');
                        $this->db->query(" update savsoft_users set gid='$mgid' where gid='$gid' ");

			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}

			if($this->user_model->remove_group($gid,$status)){
							if($status==0)
													$this->session->set_flashdata('message', "<div class='alert alert-success'>Disable Successfully</div>");
							else {
								$this->session->set_flashdata('message', "<div class='alert alert-success'>Enable Successfully</div>");
							}
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

					}
					redirect('user/group_list');


		}


		public function reportees()
		{
			$logged_in=$this->session->userdata('logged_in');
				$data['title']='Reportee List';
			$data['reportees']=$this->user_model->reportees_list($logged_in['uid']);
			$this->load->view('header',$data);
			$this->load->view('reprtees_list',$data);
			$this->load->view('footer',$data);
		}

	function logout(){

		$this->session->unset_userdata('logged_in');
			if($this->session->userdata('logged_in_raw')){
				$this->session->unset_userdata('logged_in_raw');
			}
 redirect('login');

	}

	public function change_password()
	{
		$logged_in=$this->session->userdata('logged_in');
		$data['title']='Change Password';

		$this->load->view('header',$data);
		$this->load->view('change_password',$data);
		$this->load->view('footer',$data);
	}

	public function password_change()
	{
		$new_password=$this->input->post('new_password');
		$confirm_password=$this->input->post('confirm_password');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
		if ($this->form_validation->run() == FALSE)
				 {
							$this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
	 redirect('user/change_password/');
				 }
				 else
				 {
					 if($new_password!=$confirm_password)
					 {
						 $this->session->set_flashdata('message', "<div class='alert alert-danger'>Password do not match </div>");
	redirect('user/change_password/');
					 }
					 else
					 $quid=$this->user_model->update_password($new_password);

					 if($this->session->userdata('logged_in')['su']=='1'){
		 			 redirect('dashboard');

		 			}else{
		 				$burl=$this->config->item('base_url').'index.php/quiz';
		 			 header("location:$burl");
		 			}

				 }

	}


	// department functions start
	public function department_list(){

		// fetching group list
		$data['department_list']=$this->user_model->department_list();
		$data['title']=$this->lang->line('department_list');
		$this->load->view('header',$data);
		$this->load->view('department_list',$data);
		$this->load->view('footer',$data);

	}


		public function insert_department()
	{


			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}

				if($this->user_model->insert_department()){
								$this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");

				}
				redirect('user/department_list/');

	}

			public function update_department($did)
	{


			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}

				if($this->user_model->update_department($did)){
								echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
				}else{
				 echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";

				}


	}




			public function remove_department($did,$status){

			$logged_in=$this->session->userdata('logged_in');
			if($logged_in['su']!='1'){
				exit($this->lang->line('permission_denied'));
			}

			$mcid=$this->input->post('mcid');



			if($this->user_model->remove_department($did,$status)){
						if($status==0)
												$this->session->set_flashdata('message', "<div class='alert alert-success'>Disable Successfully</div>");
						else {
							$this->session->set_flashdata('message', "<div class='alert alert-success'>Enable Successfully</div>");
						}
					}else{
								$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");

					}
					redirect('user/department_list');


		}



		public function update_user_changes($uid)
	{


			$logged_in=$this->session->userdata('logged_in');

			if($logged_in['su']!='1'){
			 $uid=$logged_in['uid'];
			}
		$this->load->library('form_validation');

						$this->form_validation->set_rules('contact_no', 'Contact', 'required|is_unique[savsoft_users.contact_no]');

           if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('user/edit_user/'.$uid);
                }
                else
                {
					if($this->user_model->submit_user_changes($uid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");

					}
					redirect('user/edit_user/'.$uid);
                }

	}

	public function verify_user_changes($uid,$change_id,$status,$key)
	{
		if(md5($uid.$change_id.'Ash')!=$key)
		{
			$this->session->unset_userdata('logged_in');
			redirect('login');
		}

		if($this->session->userdata('logged_in')['uid']=='')
		{

			$this->session->unset_userdata('logged_in');
			redirect('login');
		}

		if($this->user_model->verify_user_changes($uid,$change_id,$status))
		{
			$this->session->set_flashdata('message', "<div class='alert alert-success'>Verified Successfully </div>");
		}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");

		}
		redirect('user/reportees');

	}
}
