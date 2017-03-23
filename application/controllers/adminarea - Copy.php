<?php
class Adminarea extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	public function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$username = $this->session->userdata('username');
		$_SESSION['username'] = $username;
		
		if(!isset($is_logged_in) || $is_logged_in != true )
		{
			echo 'You don\'t have permission to access this page. <a href="../">Login</a>';
			die();
		}
	}
	
	public function main() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'main';
		$this->load->view('includes/template_admin', $data);
	}
	
	
	public function enroll_patron()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'ID Number', 
											'trim|required|min_length[7]|max_length[7]|is_unique[patron.id_number]');
		$this->form_validation->set_rules('fn', 'First Name', 'trim|required');
		$this->form_validation->set_rules('ln', 'Last Name', 'trim|required');
		
			if($this->form_validation->run() == FALSE) {
				$this->main();
			}
			
			else {
				  $this->load->model('adminarea_model');
				  $file_element_name = 'picture';
	  
				  $config['upload_path'] = './files/';
				  $config['allowed_types'] = 'gif|jpg|png|bmp';
				  $config['max_size']  = 1024 * 8;
				  $config['encrypt_name'] = TRUE;
			 
				  $this->load->library('upload', $config);
	 
				  if (!$this->upload->do_upload($file_element_name))
				  {
					 $data = $this->upload->data();
					 $file_id = $this->adminarea_model->enroll_patron_submit($_POST['id_number'], $_POST['fn'], $_POST['ln'], $_POST['mn'], $data['file_name']);
					 if($file_id)
					 {
						 echo '<script>alert("New Patron has been successfully enrolled. Thank you!")</script>';
						 $this->main();
					 }
					 else
					 {
						unlink($data['full_path']);
						echo '<script>alert("Something went wrong when saving the file, please try again.")</script>';
					 }
				  }
				  else
				  {
					 $data = $this->upload->data();
					 $file_id = $this->adminarea_model->enroll_patron_submit($_POST['id_number'], $_POST['fn'], $_POST['ln'], $_POST['mn'], $data['file_name']);
					 if($file_id)
					 {
						 echo '<script>alert("New Patron has been successfully enrolled. Thank you!")</script>';
						 $this->main();
					 }
					 else
					 {
						unlink($data['full_path']);
						echo '<script>alert("Something went wrong when saving the file, please try again.")</script>';
					 }
				  }
		  @unlink($_FILES[$file_element_name]);
	   		}
	}
	
	
	/*public function enroll_patron()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'ID Number', 'trim|required|min_length[7]|max_length[7]');
		$this->form_validation->set_rules('fn', 'First Name', 'trim|required');
		$this->form_validation->set_rules('ln', 'Last Name', 'trim|required');
			
		if ($this->form_validation->run() == FALSE) {
			$this->main();
		} 
		else {
			
			$this->load->model('adminarea_model');
			
				if($query = $this->adminarea_model->enroll_patron_submit()) {	
				echo '<script>alert("New Patron has been successfully enrolled. Thank you!")</script>';
					$this->main();
				}
				else {
					echo '<script>alert("Patron Information has been successfully updated. Thank you!")</script>';
					$this->main();
				}
		}
   
	} // end of function enroll_patron
	*/
	
	public function grade_section() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'grade_section';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function enroll_grade_section()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('grade_level_id', 'Grade Level', 'trim|required');
		$this->form_validation->set_rules('section_id', 'Section', 'trim|required');
		$this->form_validation->set_rules('school_year_id', 'School Year', 'trim|required');
			
		if ($this->form_validation->run() == FALSE) {
			$this->grade_section();
		} 
		else {
			
			$this->load->model('adminarea_model');
			
				if($query = $this->adminarea_model->enroll_grade_section_submit()) {	
				echo '<script>alert("New Grade/Section has been added. Thank you!")</script>';
					$this->grade_section();
				}
				else {
					echo '<script>alert("Duplicate entry!")</script>';
					$this->grade_section();
				}
		}
   
	} // end of function enroll_grade_section
	
	public function section() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'section';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function enroll_section()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('section_n', 'Section', 'trim|required');
			
		if ($this->form_validation->run() == FALSE) {
			$this->section();
		} 
		else {
			
			$this->load->model('adminarea_model');
			
				if($query = $this->adminarea_model->enroll_section_submit()) {	
				echo '<script>alert("New Section has been added. Thank you!")</script>';
					$this->section();
				}
				else {
					echo '<script>alert("Duplicate entry!")</script>';
					$this->section();
				}
		}
   
	} // end of function enroll_section
	
	public function school_year() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'school_year';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function enroll_school_year()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('school_year_n', 'School Year', 'trim|required|min_length[9]|max_length[9]');
			
		if ($this->form_validation->run() == FALSE) {
			$this->school_year();
		} 
		else {
			
			$this->load->model('adminarea_model');
			
				if($query = $this->adminarea_model->enroll_school_year_submit()) {	
				echo '<script>alert("New School Year has been added. Thank you!")</script>';
					$this->school_year();
				}
				else {
					echo '<script>alert("Duplicate entry!")</script>';
					$this->school_year();
				}
		}
   
	} // end of function enroll_school_year
	
	public function sysuser() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'sysuser';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function enroll_sysuser()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|is_unique[libstaff.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');
			
		if ($this->form_validation->run() == FALSE) {
			$this->sysuser();
		} 
		else {
			
			$this->load->model('adminarea_model');
			
				if($query = $this->adminarea_model->enroll_sysuser_submit()) {	
				echo '<script>alert("New System User has been added. Thank you!")</script>';
					$this->sysuser();
				}
				else {
					echo '<script>alert("Duplicate entry!")</script>';
					$this->sysuser();
				}
		}
   
	} // end of function enroll_sysuser
	
	public function patron_grade_section() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'patron_grade_section';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function enroll_patron_grade_section()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_number', 'ID Number', 'trim|required|min_length[7]|max_length[7]');
		$this->form_validation->set_rules('grade_level_section_id', 'Grade Level/Section/School Year', 'trim|required');
			
		if ($this->form_validation->run() == FALSE) {
			$this->patron_grade_section();
		} 
		else {
			
			$this->load->model('adminarea_model');
			
				if($query = $this->adminarea_model->enroll_patron_grade_section_submit()) {	
				echo '<script>alert("New Patron Grade Level/Section/School Year has been added. Thank you!")</script>';
					$this->patron_grade_section();
				}
				else {
					echo '<script>alert("Duplicate entry!")</script>';
					$this->patron_grade_section();
				}
		}
   
	} // end of function enroll_patron_grade_section
	
	
	
	
	public function reports_patron() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'reports_patron';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function reports_grades_section() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'reports_grades_section';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function reports_all() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'reports_all';
		$this->load->view('includes/template_admin', $data);
	}
	
	public function search_patron() 
	{
		$this->load->model('adminarea_model');
		$data['query'] = $this->adminarea_model->admin_details();
		
		$data['content'] = 'search_patron';
		$this->load->view('includes/template_admin', $data);
	}
	
	
	
	
	
	
}