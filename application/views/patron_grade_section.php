
	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Enroll : Patron Grade/Section</h1>
        
        <?php
				$_SESSION['id_number'] = $this->input->post('id_number');
				
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/enroll_patron_grade_section');	
				
				echo '<p>ID Number: '.form_input(array(
						'name' => 'id_number',
						'value' => $_SESSION['id_number'],
						'placeholder' => '00-0000',
						'class' => 'form-input'
					)).'</p>';
				
		?> 
                    <select name="grade_level_section_id" class="form-input">
                        <option value="">Select Grade Level/Section/School Year</option>
                            <?php
							
								$query1 = $this->db->query('SELECT * FROM grade_level_section order by school_year_id desc');
                                    if ($query1->num_rows() > 0) {			
                                        foreach ($query1->result_array() as $row) {
											$grade_level_section_id = $row['grade_level_section_id'];
											$grade_level_id = $row['grade_level_id'];
											$section_id = $row['section_id'];
											$school_year_id = $row['school_year_id'];
											
										$query2 = $this->db->query('SELECT * FROM grade_level 
											where grade_level_id = '.$grade_level_id.' order by grade_level_id');
											if ($query2->num_rows() > 0) {			
												foreach ($query2->result_array() as $row) {
													$grade_level_n = $row['grade_level_n'];
												}
											}
										
										$query3 = $this->db->query('SELECT * FROM section
											where section_id = '.$section_id.' order by section_id');
											if ($query3->num_rows() > 0) {			
												foreach ($query3->result_array() as $row) {
													$section_n = $row['section_n'];
												}
											}	
											
										$query4 = $this->db->query('SELECT * FROM school_year
											where school_year_id = '.$school_year_id.' order by school_year_id');
											if ($query4->num_rows() > 0) {			
												foreach ($query4->result_array() as $row) {
													$school_year_n = $row['school_year_n'];
												}
											}	
											
                            	echo "<option value='".$grade_level_section_id."'>".$grade_level_n.' - '.$section_n.' - '.$school_year_n."</option>";
                                        }
                                    }
									
                            ?>
                    </select>
               
               <button type="submit" class="form-button" style="float:right">Save</button> 
            </form>
        
        </div>
