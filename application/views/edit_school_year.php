	<?php	
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
    	<div class="form2">
        <h1>Edit : School Year</h1>
            <div class="login" style="width: 480px; float:right;">
        
        	<?php
			
				if(isset($_POST['submit'])) {
					
					if($_POST['school_year_id'] <> '' ) {
						$query = $this->db->query('SELECT * FROM school_year 
								WHERE school_year_id="'.$this->input->post('school_year_id').'" ');
							foreach ($query->result_array() as $row) {
								$school_year_id = $row['school_year_id'];
							}	
							$this->db->where('school_year_id', $school_year_id)
							->update('school_year', array(
									'school_year_n' => $this->input->post('school_year_n')
								));
								
								$school_year_n = $this->input->post('school_year_n');
								
					}
					else {
						echo '<p class="error">Please check empty fields!</p>';
					}
				
				} // end main if 
				else {
			
				$school_year_id = $_GET['id'];
		
				$query3 = $this->db->query('SELECT * FROM school_year where school_year_id = "'.$school_year_id.'" ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$school_year_id = $row['school_year_id'];
												$school_year_n = $row['school_year_n'];
											}
										}
				} //end else

			
				echo validation_errors('<p class="error">');
				echo form_open('adminarea/edit_school_year');
						
						echo form_hidden('school_year_id', $school_year_id);
				
						echo '<p>School Year: '.form_input(array(
							'name' => 'school_year_n',
							'value' => $school_year_n,	
							'placeholder' => 'School Year Name',
							'class' => 'form-input'
						)).'</p>';
						
						?>
                    
					<button type="submit" class="form-button" style="float:right" id="submit" name="submit">Update</button> 
					</form>
                    
                    
			</div> <!-- end of class login -->
  
<div style="clear:both;"></div>