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
   		
		$id_number = strip_tags($this->input->post('id_number'));
		$id_num_wo_hyphen = str_replace('-', '', $id_number);
					
					$data = array(
							 'id_number' => $id_number,
							 'id_num_wo_hyphen' => $id_num_wo_hyphen,
							 'fn' => $fn,
							 'ln' => $ln,
							 'mn' => $mn,
							 'filename' => $filename
						  );
						  $this->db->insert('patron', $data);
						  return $this->db->insert_id();			
   }
	
	
	
	
	/*public function enroll_patron_submit() 
	{		
		$id_number = strip_tags($this->input->post('id_number'));
		$id_num_wo_hyphen = str_replace('-', '', $id_number);
		
		$query = $this->db->query('SELECT * FROM patron WHERE id_num_wo_hyphen='.$id_num_wo_hyphen.' ');
		
			foreach ($query->result_array() as $row) {
				$patron_id = $row['patron_id'];
			}	
			
				if ($query->num_rows() > 0) {
					$this->db->where('patron_id', $patron_id)
					->update('patron', array(
							'id_number' => $this->input->post('id_number'),
							'id_num_wo_hyphen' => $id_num_wo_hyphen,
							'fn' => $this->input->post('fn'),
							'ln' => $this->input->post('ln'),
							'mn' => $this->input->post('mn')	
					));
						
					} else if ($query->num_rows() == 0) {
    						$new_patron_insert_data = array(
							'id_number' => $this->input->post('id_number'),
							'id_num_wo_hyphen' => $id_num_wo_hyphen,
							'fn' => $this->input->post('fn'),
							'ln' => $this->input->post('ln'),
							'mn' => $this->input->post('mn')
										);
						$insert = $this->db->insert('patron', $new_patron_insert_data);
						return $insert;	
					}
		
	} //end of function enroll_patron_submit
	*/
	
	public function enroll_grade_section_submit() 
	{		
		$query = $this->db->query('SELECT * FROM grade_level_section 
					WHERE grade_level_id='.$this->input->post('grade_level_id').' 
						and section_id='.$this->input->post('section_id').' 
						and school_year_id='.$this->input->post('school_year_id').' 
						or grade_level_id='.$this->input->post('grade_level_id').'  
						and school_year_id='.$this->input->post('school_year_id').' ');
		
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
		$id_number = strip_tags($this->input->post('id_number'));
		$id_num_wo_hyphen = str_replace('-', '', $id_number);
		
		$query = $this->db->query('SELECT * FROM patron_grade_level WHERE id_num_wo_hyphen = '.$id_num_wo_hyphen.' 
							and grade_level_section_id = '.$this->input->post('grade_level_section_id').' ');
		
			foreach ($query->result_array() as $row) {
				$patron_grade_level_id = $row['patron_grade_level_id'];
			}	
			
						$query1 = $this->db->query('SELECT * FROM grade_level_section 
									WHERE grade_level_section_id = '.$this->input->post('grade_level_section_id').' ');
		
							foreach ($query1->result_array() as $row) {
								$school_year_id = $row['school_year_id'];
							}	
			
				if ($query->num_rows() > 0) {
					$this->db->where('patron_grade_level_id', $patron_grade_level_id)
					->update('patron_grade_level', array(
							'id_num_wo_hyphen' => $id_num_wo_hyphen,
							'grade_level_section_id' => $this->input->post('grade_level_section_id'),
							'school_year_id' => $school_year_id
					));
						
					} else if ($query->num_rows() == 0) {
    						$new_patron_insert_data = array(
								'id_num_wo_hyphen' => $id_num_wo_hyphen,
								'grade_level_section_id' => $this->input->post('grade_level_section_id'),
								'school_year_id' => $school_year_id
							);
						$insert = $this->db->insert('patron_grade_level', $new_patron_insert_data);
						return $insert;	
					}
		
	} //end of function enroll_patron_grade_section_submit
	
	
	
	
}