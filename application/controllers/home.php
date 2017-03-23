<?php
class Home extends CI_Controller {
	
	
	public function index() 
	{
		$data['content'] = 'index';
		$this->load->view('includes/template', $data);
	}
	
	
	public function patron_log() 
	{
		$data['content'] = 'patron_log';
		$this->load->view('includes/template', $data);
	}
	
	
	public function validate_credentials() 
	{
		$this->load->model('home_model');	
		$query = $this->home_model->validate('id');
			
			if($query == 1) {
				$data = array(
					'username' => $this->input->post('username'),
					'is_logged_in' => true
				);
				
				$this->session->set_userdata($data);
				redirect('adminarea/main');
			}
			else {
				$this->index();
			}
	}
	
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
	
	
	public function enroll_patron_log()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('school_year_id', 'School Year', 'trim|required');
		$this->form_validation->set_rules('id_number', 'ID Number', 'trim|required');
		 $this->form_validation->set_rules('visit_purpose_id[]', 'Purpose', 'trim|required');
			
		if ($this->form_validation->run() == FALSE) {
			$this->patron_log();
		} 
		else {
			
			$this->load->model('home_model');
			
				if($query = $this->home_model->enroll_patron_log_submit()) {	
				echo '<script>alert("Thank you!")</script>';
					$this->patron_log();
				}
				else {
					echo '<script>alert("Something is wrong! Ask the library staff for guidance. Thank you!")</script>';
					$this->patron_log();
				}
		}
		
	} // end of function enroll_patron_log
	
	
	
	
	
	
}