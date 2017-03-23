<?php
class Adminarea_model extends CI_Model { 

	public function __construct() {
		parent::__construct();	
	}
	
	public function admin_details()
	{
		$query = $this->db->get_where('libstaff', array('libstaff.username' => $_SESSION['username']));
		return $query->result();
	}
	
	public function enroll_patron_submit($id_number, $fn, $ln, $mn, $filename) {	
					
					$data = array(
							 'id_number' => $id_number,
							 'fn' => $fn,
							 'ln' => $ln,
							 'mn' => $mn,
							 'filename' => $filename
						  );
						  $this->db->insert('patron', $data);
						  return $this->db->insert_id();			
   }
   
   public function picture_update($patron_id, $filename) {	
   
   		$this->db->where('patron_id', $patron_id)
					->update('patron', array(
							'filename' => $filename	
					));		
   }
	
	public function enroll_grade_section_submit() 
	{		
		$query = $this->db->query('SELECT * FROM grade_level_section 
					WHERE grade_level_id='.$this->input->post('grade_level_id').' 
						and section_id='.$this->input->post('section_id').' 
						and school_year_id='.$this->input->post('school_year_id').' ');
						// or grade_level_id='.$this->input->post('grade_level_id').'  
						// and school_year_id='.$this->input->post('school_year_id').' ');
		
			foreach ($query->result_array() as $row) {
				$grade_level_section_id = $row['grade_level_section_id'];
			}	
			
				if ($query->num_rows() > 0) {
					$this->db->where('grade_level_section_id', $grade_level_section_id)
					->update('grade_level_section', array(
							'grade_level_id' => $this->input->post('grade_level_id'),
							'section_id' => $this->input->post('section_id'),
							'school_year_id' => $this->input->post('school_year_id')	
					));
				}
				else { 
    						$new_insert_data = array(
							'grade_level_id' => $this->input->post('grade_level_id'),
							'section_id' => $this->input->post('section_id'),
							'school_year_id' => $this->input->post('school_year_id')
										);
						$insert = $this->db->insert('grade_level_section', $new_insert_data);
						return $insert;	
					}
		
	} //end of function enroll_grade_section_submit
	
	public function enroll_section_submit() 
	{	
		$new_insert_data = array(
			'section_n' => $this->input->post('section_n')
			);
			$insert = $this->db->insert('section', $new_insert_data);
			return $insert;	
	} //end of function enroll_section_submit
	
	public function enroll_school_year_submit() 
	{	
		$new_insert_data = array(
			'school_year_n' => $this->input->post('school_year_n')
			);
			$insert = $this->db->insert('school_year', $new_insert_data);
			return $insert;	
	} //end of function enroll_section_submit
	
	public function enroll_sysuser_submit() 
	{		
    						$new_insert_data = array(
							'fullname' => $this->input->post('fullname'),
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password'))
										);
						$insert = $this->db->insert('libstaff', $new_insert_data);
						return $insert;		
	} //end of function enroll_sysuser_submit
	
	public function enroll_patron_grade_section_submit() 
	{		
		$query = $this->db->query('SELECT * FROM patron_grade_level WHERE id_number = "'.$this->input->post('id_number').'" 
							and grade_level_section_id = '.$this->input->post('grade_level_section_id').' ');
		
			foreach ($query->result_array() as $row) {
				$patron_grade_level_id = $row['patron_grade_level_id'];
			}	
			
						$query1 = $this->db->query('SELECT * FROM grade_level_section 
									WHERE grade_level_section_id = '.$this->input->post('grade_level_section_id').' ');
		
							foreach ($query1->result_array() as $row) {
								$school_year_id = $row['school_year_id'];
							}	
							
						$query2 = $this->db->query('SELECT * FROM patron 
									WHERE id_number = "'.$this->input->post('id_number').'" ');
		
							foreach ($query2->result_array() as $row) {
								$patron_id = $row['patron_id'];
							}	
			
				if ( ($query->num_rows() > 0) or ($query2->num_rows() == 0) ) {
					
					} else if ($query->num_rows() == 0) {
    						$new_patron_insert_data = array(
								'id_number' => $this->input->post('id_number'),
								'grade_level_section_id' => $this->input->post('grade_level_section_id'),
								'school_year_id' => $school_year_id
							);
						$insert = $this->db->insert('patron_grade_level', $new_patron_insert_data);
						return $insert;	
					}
		
	} //end of function enroll_patron_grade_section_submit
	
	public function patron_image()
	{
		$patron_id = $_GET['id'];
		$query = $this->db->get_where('patron', array('patron.patron_id' => $patron_id));
		return $query->result();
	}
	
	public function patron_image_update($filename, $patron_id)
   {
	   $patron_id = $_GET['id'];		
		$data = array(
			 'filename' => $filename 
		  );

		$this->db->where('patron_id', $patron_id);
		$this->db->update('patron', $data); 
		return $this->db->affected_rows();	
   }
   
   public function patron_delete_submit() 
	{	
		$patron_grade_level_id = $_GET['id'];			
		$this->db->where('patron_grade_level_id', $patron_grade_level_id)
			->delete('patron_grade_level', array(
			'patron_grade_level_id' => $patron_grade_level_id
		));			
	}
	
	public function delete_sys_user_submit() 
	{	
		$libstaff_id = $_GET['id'];			
		$this->db->where('libstaff_id', $libstaff_id)
			->delete('libstaff', array(
			'libstaff_id' => $libstaff_id
		));			
	}

	
	
	
	
}