<?php
class Home_model extends CI_Model { 

	public function __construct() {
		parent::__construct();	
	}
	
	public function validate($id) 
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('libstaff');
		
		if($query->num_rows != 0) {
			$id = 1;
			return $id;
		}
	}
	
	public function enroll_patron_log_submit() 
	{	
		$today = date('Y-m-d');
		$date_wo_hyphen1 = strip_tags($today);
		$date_wo_hyphen = str_replace('-', '', $date_wo_hyphen1);

		$visit_purpose = serialize($this->input->post('visit_purpose_id'));

		
		$query = $this->db->query('SELECT * FROM patron_grade_level WHERE id_number = "'.$this->input->post('id_number').'" and school_year_id = '.$this->input->post('school_year_id').' ');
		
			foreach ($query->result_array() as $row) {
				$patron_grade_level_id = $row['patron_grade_level_id'];
			}
		
		if ($query->num_rows() > 0) {
				$new_insert_data = array(
				'id_number' => stripslashes($this->input->post('id_number')),
				'patron_grade_level_id' => $patron_grade_level_id,
				'date_in' => $today,
				'date_wo_hyphen1' => $date_wo_hyphen,
				'school_year_id' => $this->input->post('school_year_id'),
				'purpose' => $visit_purpose,
				'otherpurpose' => $this->input->post('visit_purpose_id_others')
				);
			$insert = $this->db->insert('visit', $new_insert_data);

			// $query1 = $this->db->query('SELECT * FROM visit WHERE id_number = "'.$this->input->post('id_number').'" and school_year_id = '.$this->input->post('school_year_id').' order by visit_id desc limit 1');
		
			// foreach ($query1->result_array() as $row) {
			// 	$visit_id = $row['visit_id'];
			// }

			// $visit_purpose = serialize($this->input->post('visit_purpose_id'));
			// $data = array(
			// 	'visit_id' => $visit_id,
			//     'purpose' => $visit_purpose,
			//     'otherpurpose' => $this->input->post('visit_purpose_id_others')
			//      );
			// $this->db->insert('visit_purpose_list',$data);

			return $insert;	
		}



		// $query1 = $this->db->query('SELECT * FROM visit WHERE visit.id_number = "'.$this->input->post('id_number').'"
		// 					and school_year_id = '.$this->input->post('school_year_id').' order by visit_id desc limit 1 ');
		// foreach ($query1->result_array() as $row) {
		// 		$visit_id = $row['visit_id'];
		// 	}
		// if ($query1->num_rows() > 0) {
		// 		$new_insert_data = array(
		// 		'purpose' => $visit_id,
		// 		'date_in' => $today,
		// 		'date_wo_hyphen1' => $date_wo_hyphen,
		// 		'school_year_id' => $this->input->post('school_year_id'),
		// 		'purpose' => $this->input->post('visit_purpose_id_others')
		// 		);
		// 	$insert = $this->db->insert('visit', $new_insert_data);
		// 	return $insert;	
		// }
		
	} //end of function enroll_patron_log_submit		
}
?>