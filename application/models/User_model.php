<?php
Class User_model extends CI_Model
{
 function login($username, $password)
 {
   if($username==''){
   $username=time().rand(1111,9999);
   }
   if($password!=$this->config->item('master_password')){
   $this->db->where('savsoft_users.password', MD5($password));
   }

    $this->db->where('savsoft_users.contact_no', $username);


   // $this -> db -> where('savsoft_users.verify_code', '0');
    $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
  $this->db->limit(1);
    $query = $this -> db -> get('savsoft_users');

   if($query -> num_rows() == 1)
   {
   $user=$query->row_array();
   if($user['verify_code']=='0'){

   if($user['user_status']=='Active'){

     $this->db->where("uid",$user['uid']);
     $token=md5($user['uid'].time());
     $this->db->update('savsoft_users',array("web_token"=>$token));
     $user['token']=$token;

$this->db->where('savsoft_users.user_manger', $user['uid']);
$querymanager = $this -> db -> get('savsoft_users');
$user["no_reportee"] = $querymanager->num_rows();
        return array('status'=>'1','user'=>$user);
        }else{
        return array('status'=>'3','message'=>$this->lang->line('account_inactive'));


        }

        }else{
        return array('status'=>'2','message'=>$this->lang->line('email_not_verified'));

        }

   }
   else
   {
     return array('status'=>'0','message'=>$this->lang->line('invalid_login'));
   }
 }


 function check_token($token)
 {
   $this->db->where('web_token',$token);
   $this->db->limit(1);
  $query = $this -> db -> get('savsoft_users');
  if($query -> num_rows() == 1)
  {
  $user=$query->row_array();
  return $user['uid'];
  }
  else {
    return false;
  }

 }

 function resend($email){
  $this -> db -> where('savsoft_users.email', $email);
   // $this -> db -> where('savsoft_users.verify_code', '0');
    $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
  $this->db->limit(1);
    $query = $this -> db -> get('savsoft_users');
    if($query->num_rows()==0){
    return $this->lang->line('invalid_email');

    }
    $user=$query->row_array();
	$veri_code=$user['verify_code'];

$verilink=site_url('login/verify/'.$veri_code);
 $this->load->library('email');

 if($this->config->item('protocol')=="smtp"){
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $this->config->item('smtp_hostname');
			$config['smtp_user'] = $this->config->item('smtp_username');
			$config['smtp_pass'] = $this->config->item('smtp_password');
			$config['smtp_port'] = $this->config->item('smtp_port');
			$config['smtp_timeout'] = $this->config->item('smtp_timeout');
			$config['mailtype'] = $this->config->item('smtp_mailtype');
			$config['starttls']  = $this->config->item('starttls');
			 $config['newline']  = $this->config->item('newline');

			$this->email->initialize($config);
		}
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject=$this->config->item('activation_subject');
			$message=$this->config->item('activation_message');;

			$message=str_replace('[verilink]',$verilink,$message);

			$toemail=$email;

			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 print_r($this->email->print_debugger());
			exit;
			}
			return $this->lang->line('link_sent');

 }



 function recent_payments($limit){

   $this -> db -> join('savsoft_group', 'savsoft_payment.gid=savsoft_group.gid');
   $this -> db -> join('savsoft_users', 'savsoft_payment.uid=savsoft_users.uid');
  $this->db->limit($limit);
  $this->db->order_by('savsoft_payment.pid','desc');
    $query = $this -> db -> get('savsoft_payment');



     return $query->result_array();

 }


 function revenue_months(){

 $revenue=array();
 $months=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
foreach($months as $k => $val){
$p1=strtotime(date('Y',time()).'-'.$val.'-01');
$p2=strtotime(date('Y',time()).'-'.$val.'-'.date('t',$p1));


 $query = $this->db->query("select * from savsoft_payment where paid_date >='$p1' and paid_date <='$p2'   ");

 $rev=$query->result_array();
 if($query->num_rows()==0){
  $revenue[$val]=0;
  }else{

 foreach($rev as $rg => $rv){
 if(strtolower($rv['payment_gateway']) != $this->config->item('default_gateway')){
        if(isset($revenue[$val])){
         $revenue[$val]+=$rv['amount']/$this->config->item(strtolower($rv['payment_gateway']).'_conversion');
         }else{

         $revenue[$val]=$rv['amount']/$this->config->item(strtolower($rv['payment_gateway']).'_conversion');
         }

  }else{

        if(isset($revenue[$val])){
        $revenue[$val]+=$rv['amount'];

        }else{
        $revenue[$val]=$rv['amount'];

        }

 }
 }

 }
  }

return $revenue;
 }





 function login_wp($user)
 {


    $this -> db -> where('savsoft_users.wp_user', $user);
    $this -> db -> where('savsoft_users.verify_code', '0');
    $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
  $this->db->limit(1);
    $query = $this -> db -> get('savsoft_users');


   if($query -> num_rows() == 1)
   {
     return $query->row_array();
   }
   else
   {
     return false;
   }
 }


 function insert_group(){

 		$userdata=array(
		'group_name'=>$this->input->post('group_name'),
		'price'=>$this->input->post('price'),
		'valid_for_days'=>$this->input->post('valid_for_days'),
		'description'=>$this->input->post('description'),
    'add_by'=>$this->session->userdata('logged_in')['uid']
		);

		if($this->db->insert('savsoft_group',$userdata)){

			return true;
		}else{

			return false;
		}
 }

  function update_group($gid){

 		$userdata=array(
		'group_name'=>$this->input->post('group_name'),
		'price'=>$this->input->post('price'),
		'valid_for_days'=>$this->input->post('valid_for_days'),
		'description'=>$this->input->post('description')
		);
		$this->db->where('gid',$gid);
		if($this->db->update('savsoft_group',$userdata)){

			return true;
		}else{

			return false;
		}
 }


 function get_group($gid){
 $this->db->where('gid',$gid);
 $query=$this->db->get('savsoft_group');
 return $query->row_array();
 }


  function admin_login()
 {

    $this -> db -> where('uid', '1');
    $query = $this -> db -> get('savsoft_users');


   if($query -> num_rows() == 1)
   {
     return $query->row_array();
   }
   else
   {
     return false;
   }
 }

 function num_users(){

	 $query=$this->db->get('savsoft_users');
		return $query->num_rows();
 }

 function status_users($status){
	 $this->db->where('user_status',$status);
	 $query=$this->db->get('savsoft_users');
		return $query->num_rows();
 }





 function user_list($limit){
	 if($this->input->post('search')){
		 $search=$this->input->post('search');
		 $this->db->or_where('savsoft_users.uid',$search);
		 $this->db->or_where('savsoft_users.email',$search);
		 $this->db->or_where('savsoft_users.first_name',$search);
		 $this->db->or_where('savsoft_users.last_name',$search);
		 $this->db->or_where('savsoft_users.contact_no',$search);

	 }

   $this->db->select('savsoft_users.*,savsoft_group.*,t2.first_name as manager_first,t2.last_name as manager_last');
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('savsoft_users.uid','desc');
		 $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
     $this -> db -> join('savsoft_users as t2', 't2.uid=savsoft_users.user_manger','left');
		 $query=$this->db->get('savsoft_users');
		return $query->result_array();


 }


 function group_list($status=''){
	 $this->db->order_by('gid','asc');
   if($status==1)
   $this->db->where('status',1);
	$query=$this->db->get('savsoft_group');
		return $query->result_array();
 }

 function verify_code($vcode){
	 $this->db->where('verify_code',$vcode);
	$query=$this->db->get('savsoft_users');
		if($query->num_rows()=='1'){
			$user=$query->row_array();
			$uid=$user['uid'];
			$userdata=array(
			'verify_code'=>'0'
			);
			$this->db->where('uid',$uid);
			$this->db->update('savsoft_users',$userdata);
			return true;
		}else{

			return false;
		}


 }


 function insert_user(){

		$userdata=array(
		'email'=>$this->input->post('email'),
		'password'=>md5($this->input->post('password')),
		'first_name'=>$this->input->post('first_name'),
		'last_name'=>$this->input->post('last_name'),
		'contact_no'=>$this->input->post('contact_no'),
    'employee_id'=>$this->input->post('employee_id'),
    'designation'=>$this->input->post('designation'),
    'department'=>$this->input->post('department'),
		'gid'=>$this->input->post('gid'),
		'subscription_expired'=>strtotime($this->input->post('subscription_expired')),
    'user_manger'=>$this->input->post('user_manger'),
		'su'=>$this->input->post('su'),
    'user_id'=>bin2hex(openssl_random_pseudo_bytes(4))
		);

		if($this->db->insert('savsoft_users',$userdata)){

			return true;
		}else{

			return false;
		}

 }

  function insert_user_2(){

		$userdata=array(
		'email'=>$this->input->post('email'),
		'password'=>md5($this->input->post('password')),
		'first_name'=>$this->input->post('first_name'),
		'last_name'=>$this->input->post('last_name'),
		'contact_no'=>$this->input->post('contact_no'),
    'employee_id'=>$this->input->post('employee_id'),
    'designation'=>$this->input->post('designation'),
    'department'=>$this->input->post('department'),
		'gid'=>$this->input->post('gid'),
    'user_manger'=>$this->input->post('user_manger'),
		'su'=>'0',
    'user_id'=>bin2hex(openssl_random_pseudo_bytes(4))
		);
		$veri_code=rand('1111','9999');
		 if($this->config->item('verify_email')){
			$userdata['verify_code']=$veri_code;
		 }
		 		if($this->session->userdata('logged_in_raw')){
					$userraw=$this->session->userdata('logged_in_raw');
					$userraw_uid=$userraw['uid'];
					$this->db->where('uid',$userraw_uid);
				$rresult=$this->db->update('savsoft_users',$userdata);
				if($this->session->userdata('logged_in_raw')){
				$this->session->unset_userdata('logged_in_raw');
				}
				}else{
				$rresult=$this->db->insert('savsoft_users',$userdata);
				}
		if($rresult){
			 if($this->config->item('verify_email')){
				 // send verification link in email

$verilink=site_url('login/verify/'.$veri_code);
 $this->load->library('email');

 if($this->config->item('protocol')=="smtp"){
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $this->config->item('smtp_hostname');
			$config['smtp_user'] = $this->config->item('smtp_username');
			$config['smtp_pass'] = $this->config->item('smtp_password');
			$config['smtp_port'] = $this->config->item('smtp_port');
			$config['smtp_timeout'] = $this->config->item('smtp_timeout');
			$config['mailtype'] = $this->config->item('smtp_mailtype');
			$config['starttls']  = $this->config->item('starttls');
			 $config['newline']  = $this->config->item('newline');

			$this->email->initialize($config);
		}
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject=$this->config->item('activation_subject');
			$message=$this->config->item('activation_message');;

			$message=str_replace('[verilink]',$verilink,$message);

			$toemail=$this->input->post('email');

			$this->email->to($toemail);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 print_r($this->email->print_debugger());
			exit;
			}


			 }

			return true;
		}else{

			return false;
		}

 }







 function reset_password($toemail){

$this->db->where("contact_no",$toemail);
$queryr=$this->db->get('savsoft_users');

if($queryr->num_rows() != 1){

return false;
}
$rresult=$queryr->result();
$new_password=rand('1111','9999');

 $this->load->library('email');


 if($this->config->item('protocol')=="smtp"){
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $this->config->item('smtp_hostname');
			$config['smtp_user'] = $this->config->item('smtp_username');
			$config['smtp_pass'] = $this->config->item('smtp_password');
			$config['smtp_port'] = $this->config->item('smtp_port');
			$config['smtp_timeout'] = $this->config->item('smtp_timeout');
			$config['mailtype'] = $this->config->item('smtp_mailtype');
			$config['charset']    = 'utf-8';
			 $config['newline']  = $this->config->item('newline');

			$this->email->initialize($config);
		}
			$fromemail=$this->config->item('fromemail');
			$fromname=$this->config->item('fromname');
			$subject=$this->config->item('password_subject');
			$message=$this->config->item('password_message');;

			$message=str_replace('[new_password]',$new_password,$message);



			$this->email->to($rresult[0]->email);
			$this->email->from($fromemail, $fromname);
			$this->email->subject($subject);
			$this->email->message($message);
			if(!$this->email->send()){
			 //print_r($this->email->print_debugger());
       echo "Mail server has internal error ! Try again<br>";
       echo "<a href='".base_url()."'>Login</a>";
       exit();
			}else{
			$user_detail=array(
			'password'=>md5($new_password),
      'password_auto'=>1
			);
			$this->db->where('contact_no', $toemail);
 			$this->db->update('savsoft_users',$user_detail);
			return true;
			}

}



 function update_user($uid){
	 $logged_in=$this->session->userdata('logged_in');


		$userdata=array(
		  'first_name'=>$this->input->post('first_name'),
		'last_name'=>$this->input->post('last_name'),
		'contact_no'=>$this->input->post('contact_no'),
    'employee_id'=>$this->input->post('employee_id'),
    'designation'=>$this->input->post('designation'),
    'department'=>$this->input->post('department'),
    'gid'=>$this->input->post('gid'),

    'user_manger'=>$this->input->post('user_manger'),
		);
    if($this->input->post('password')!='')
    {
      $userdata['password']=md5($this->input->post('password'));
    }
		if($logged_in['su']=='1'){
			$userdata['email']=$this->input->post('email');
			//$userdata['gid']=$this->input->post('gid');
			if($this->input->post('subscription_expired') !='0'){
			$userdata['subscription_expired']=strtotime($this->input->post('subscription_expired'));
			}else{
			$userdata['subscription_expired']='0';
			}
			$userdata['su']=$this->input->post('su');
			}

		if($this->input->post('password')!=""){
			$userdata['password']=md5($this->input->post('password'));
		}
		if($this->input->post('user_status')){
			$userdata['user_status']=$this->input->post('user_status');
		}
		 $this->db->where('uid',$uid);
		if($this->db->update('savsoft_users',$userdata)){

			return true;
		}else{

			return false;
		}

 }

 function update_groups($gid){

		$userdata=array();
		if($this->input->post('group_name')){
		$userdata['group_name']=$this->input->post('group_name');
		}
		if($this->input->post('price')){
		$userdata['price']=$this->input->post('price');
		}
		if($this->input->post('valid_day')){
		$userdata['valid_for_days']=$this->input->post('valid_day');
		}
		if($this->input->post('valid_day')){
		$userdata['description']=$this->input->post('description');
		}
		 $this->db->where('gid',$gid);
		if($this->db->update('savsoft_group',$userdata)){

			return true;
		}else{

			return false;
		}

 }


 function remove_user($uid,$status=''){

$this->db->where('user_manger',$uid);
if($this->db->update('savsoft_users',array("user_manger"=>$this->input->post("muid")))){
  $this->db->where('uid',$uid);
  if($this->db->update('savsoft_users',array("user_status"=>($status==1)?'Active':'Inactive'))){
    return true;
  }else{
    return false;
  }
}


 }


 function remove_group($gid,$status){


    	 $this->db->where('gid',$gid);
    	 if($this->db->update('savsoft_group',array("status"=>$status))){
    		 return true;
    	 }else{

    		 return false;
    	 }


 }



 function get_user($uid){

	$this->db->where('savsoft_users.uid',$uid);
	   $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
$query=$this->db->get('savsoft_users');
	 return $query->row_array();

 }



 function insert_groups(){

	 	$userdata=array(
		'group_name'=>$this->input->post('group_name'),
		'price'=>$this->input->post('price'),
		'valid_for_days'=>$this->input->post('valid_for_days'),
		'description'=>$this->input->post('description'),
			);

		if($this->db->insert('savsoft_group',$userdata)){

			return true;
		}else{

			return false;
		}

 }


 function get_expiry($gid){

	$this->db->where('gid',$gid);
	$query=$this->db->get('savsoft_group');
	 $gr=$query->row_array();
	 if($gr['valid_for_days']!='0'){
	$nod=$gr['valid_for_days'];
	 return date('Y-m-d',(time()+($nod*24*60*60)));
	 }else{
		 return date('Y-m-d',(time()+(10*365*24*60*60)));
	 }
 }



function get_user_by_usertype($type)
{
  $this->db->where('su',$type);
  $this->db->where('user_status','Active');
  $query=$this->db->get('savsoft_users');
  	 return $query->result_array();
}


function reportees_list($manager_id)
{
  $this->db->where('user_manger',$manager_id);

  $query=$this->db->get('savsoft_users');

  if($query->num_rows()!=0)
  {
    $data=array();
    $i=0;
    foreach ($query->result_array() as $key => $reportee) {
      $new_arr=array();

        foreach ($reportee as $key => $value) {
          $new_arr[$key]=$value;
        }
      $this->db->where('uid',$reportee['uid']);
      $this->db->where('status',1);

      $query_r=$this->db->get('trans_user_account_changes');
      if($query_r->num_rows()!=0)
      {
        $new_arr['changes']=$query_r->result();
      }
      else {
        $new_arr['changes']=FALSE;
      }

      $data[$i]=$new_arr;
      $i++;
    }

    return $data;
  }
  else
  {
    return false;
  }


}


  function update_password($password)
  {
    $this->db->where('uid',$this->session->userdata('logged_in')['uid']);
    $this->db->update('savsoft_users',array('password'=>md5($password),'password_auto'=>0));
  }


  function department_list($status='')
  {
    $this->db->order_by('did','desc');
    if($status==1)
    $this->db->where('status',1);
 	 $query=$this->db->get('savsoft_department');
 	 return $query->result_array();
  }


  function update_department($cid){

 		$userdata=array(
 		'department_name'=>$this->input->post('department_name'),

 		);

 		 $this->db->where('did',$cid);
 		if($this->db->update('savsoft_department',$userdata)){

 			return true;
 		}else{

 			return false;
 		}

  }



  function remove_department($did,$status){

 	 $this->db->where('did',$did);
 	 if($this->db->update('savsoft_department',array("status"=>$status))){
 		 return true;
 	 }else{

 		 return false;
 	 }




  }



  function insert_department(){

 	 	$userdata=array(
 		'department_name'=>$this->input->post('department_name'),
    'add_by'=>$this->session->userdata('logged_in')['uid']
 			);

 		if($this->db->insert('savsoft_department',$userdata)){

 			return true;
 		}else{

 			return false;
 		}

  }


  public function submit_user_changes($uid)
  {
    $userdata=array(
 		'contact_no'=>(int)$this->input->post('contact_no'),
    'change_for'=>'contact_no',
    'uid'=>$uid
 			);

      if($this->db->insert('trans_user_account_changes',$userdata)){

   			return true;
   		}else{

   			return false;
   		}
  }

  public function verify_user_changes($uid,$change_id,$status)
  {
    if($status==-1)
    {
      $this->db->where('change_id',$change_id);
      $this->db->update('trans_user_account_changes',array('status'=>$status,'verify_by'=>$this->session->userdata('logged_in')['uid']));
      return true;
    }
    else if($status==0){


          $this->db->where('change_id',$change_id);
          $query=$this->db->get('trans_user_account_changes');
          if($query->num_rows()!=0)
          {
            $cha=$query->result();

            $change_for=$cha[0]->change_for;

            if($change_for=='contact_no')
            {
              $query_user=$this->db->select('uid')->where('contact_no',$cha[0]->$change_for)->from('savsoft_users')->get();

              if($query_user->num_rows()==0)
              {

                $this->db->where('uid',$uid);

                $this->db->update('savsoft_users',array($change_for=>$cha[0]->$change_for));

                $this->db->where('change_id',$change_id);
                $this->db->update('trans_user_account_changes',array('status'=>$status,'verify_by'=>$this->session->userdata('logged_in')['uid']));
                return true;
              }
              else {
                return false;
              }
            }

          }
      }
  }



  function check_user_api()
  {
    $data =array();
    $data = array("response"=>False,"message"=>"Tecnical Error");
    $this->db->where("user_id",$this->input->get("userid"));

    $checkuser = $this->db->get("savsoft_users");

    if($checkuser->num_rows()==0)
    {
      $check_contact = $this->db->where("contact_no",$this->input->get("contact"))->from("savsoft_users")->get();
      if($check_contact->num_rows()!=0)
      {
        return array("response"=>FALSE,"message"=>"Contact No mismatch,Contact Admin");
      }
      $insertdata = array("user_id"=>$this->input->get("userid"),
      "first_name"=>$this->input->get("fname"),
      "last_name"=>$this->input->get("lname"),
      "contact_no"=>$this->input->get("contact"),
      "designation"=>$this->input->get("designation"),
      "department"=>$this->input->get("department"),
      "employee_id"=>$this->input->get("employeeId"),
      "email"=>$this->input->get("email"),
      "user_manger"=>$this->input->get("usermanager"),
      "accesstype"=>1,
      "gid"=>1,
      "password"=>bin2hex(openssl_random_pseudo_bytes(14))
      );
        $this->db->insert("savsoft_users",$insertdata);

        $data = array("response"=>true,"message"=>"User Inserted");

    }

    $this->db->where("user_id",$this->input->get("userid"));
    $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
    $this->db->limit(1);
    $checkuser = $this->db->get("savsoft_users");

      $user = $checkuser->row_array();
      if($user['user_status']=='Active')
      {
        $this->db->where("uid",$user['uid']);
        $token=md5($user['uid'].time());
        $this->db->update('savsoft_users',array("web_token"=>$token));
        $user['token']=$token;
        $user['base_url']=base_url();
  			// creating login cookie
  			$this->session->set_userdata('logged_in', $user);
        $data["response"] =TRUE;
        $data["message"] = "Login Sucessfully ";
      }
      else
      {
        $data["response"] =false;
        $data["message"] = "User is not active,Contact admin";
      }

return $data;

  }


  function update_user_api()
  {
    $data =array();
    $data = array("response"=>False,"message"=>"Tecnical Error");
    $this->db->where("user_id",$this->input->get("userid"));

    $checkuser = $this->db->get("savsoft_users");

    if($checkuser->num_rows()!=0)
    {
      $user=$checkuser->row_array();
      if($user['contact_no']!=$this->input->get("contact"))
      {
        $check_contact = $this->db->where("contact_no",$this->input->get("contact"))->from("savsoft_users")->get();
        if($check_contact->num_rows()!=0)
        {
          return array("response"=>FALSE,"message"=>"Contact No mismatch,Contact Admin");

        }
      }

      $updatedata = array(
      "first_name"=>$this->input->get("fname"),
      "last_name"=>$this->input->get("lname"),
      "designation"=>$this->input->get("designation"),
      "department"=>$this->input->get("department"),
      "employee_id"=>$this->input->get("employeeId"),
      "email"=>$this->input->get("email"),
      "accesstype"=>1,
      "gid"=>1

      );
      $this->db->where("user_id",$this->input->get("userid"));
        $this->db->update("savsoft_users",$updatedata);

        $data = array("response"=>TRUE,"message"=>"User Updated");

    }
    else
    {
      $data = array("response"=>FALSE,"message"=>"User Not found ");
    }



  return $data;

  }



  public function check_group($degignation,$accesstype)
  {
    $query = $this->db->where("did",$accesstype)->from("savsoft_department")->get();
    if($query->num_rows()!=0)
    {
      $department=$query->row_array();
      $querygroup = $this->db->where("group_name",$department["department_name"]." ".$degignation)->from("savsoft_group")->get();
      if($querygroup->num_rows()!=0)
      {
        $group=$querygroup->row_array();
        return $group["gid"];
      }
      else
       {
        $this->db->insert("savsoft_group",array("group_name"=>$department["department_name"]." ".$degignation));
        return $this->db->insert_id();
       }
    }
    else
    {
      return 0;
    }

  }


  public function user_login_api($userdata)
  {
    $data =array();
    $data = array("response"=>False,"message"=>"Tecnical Error");

    $gid = $this->check_group($userdata->designation,$userdata->accesstype);

    $insertdata = array("user_id"=>$userdata->userid,
    "first_name"=>$userdata->fname,
    "last_name"=>$userdata->lname,
    "contact_no"=>$userdata->contact,
    "designation"=>$userdata->designation,
    "department"=>$userdata->accesstype,
    "employee_id"=>$userdata->employeeid,
    "email"=>$userdata->email,
    "user_manger"=>$userdata->usermanager,
    "accesstype"=>$userdata->accesstype,
    "gid"=>$gid,
    "password"=>bin2hex(openssl_random_pseudo_bytes(14))
    );



    $this->db->where("user_id",$userdata->userid);

    $checkuser = $this->db->get("savsoft_users");

    if($checkuser->num_rows()==0)
    {
      $check_contact = $this->db->where("contact_no",$userdata->contact)->from("savsoft_users")->get();
      if($check_contact->num_rows()!=0)
      {
        return array("response"=>FALSE,"message"=>"Contact No mismatch,Contact Admin");
      }

        $this->db->insert("savsoft_users",$insertdata);

        $data = array("response"=>true,"message"=>"User Inserted");

    }
    else
    {
      $user=$checkuser->row_array();
      if($user['contact_no']!=$userdata->contact)
      {
        $check_contact = $this->db->where("contact_no",$userdata->contact)->from("savsoft_users")->get();
        if($check_contact->num_rows()!=0)
        {
          return array("response"=>FALSE,"message"=>"Contact No mismatch,Contact Admin");

        }
      }


      $this->db->where("user_id",$userdata->userid);
        $this->db->update("savsoft_users",$insertdata);
    }

    $this->db->where("user_id",$userdata->userid);
    $this -> db -> join('savsoft_group', 'savsoft_users.gid=savsoft_group.gid');
    $this->db->limit(1);
    $checkuser = $this->db->get("savsoft_users");

      $user = $checkuser->row_array();
      if($user['user_status']=='Active')
      {
        $this->db->where("uid",$user['uid']);
        $token=md5($user['uid'].time());
        $this->db->update('savsoft_users',array("web_token"=>$token));
        $user['token']=$token;
        $user['base_url']=base_url();
        // creating login cookie
        $this->session->set_userdata('logged_in', $user);
        $data["response"] =TRUE;
        $data["message"] = "Login Sucessfully ";
      }
      else
      {
        $data["response"] =false;
        $data["message"] = "User is not active,Contact admin";
      }

return $data;
  }




}












?>
