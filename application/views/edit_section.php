	<?php	
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
    	<div class="form2">
        <h1>Edit : Section</h1>
            <div class="login" style="width: 480px; float:right;">
        
        	<?php
			
				if(isset($_POST['submit'])) {
					
					if($_POST['section_id'] <> '' ) {
						$query = $this->db->query('SELECT * FROM section 
								WHERE section_id="'.$this->input->post('section_id').'" ');
							foreach ($query->result_array() as $row) {
								$section_id = $row['section_id'];
							}	
							$this->db->where('section_id', $section_id)
							->update('section', array(
									'section_n' => $this->input->post('section_n')
								));
								
								$section_n = $this->input->post('section_n');
								
					}
					else {
						echo '<p class="error">Please check empty fields!</p>';
					}
				
				} // end main if 
				else {
			
				$section_id = $_GET['id'];
		
				$query3 = $this->db->query('SELECT * FROM section where section_id = "'.$section_id.'" ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$section_id = $row['section_id'];
												$section_n = $row['section_n'];
											}
										}
				} //end else

			
				echo validation_errors('<p class="error">');
				echo form_open('adminarea/edit_section');
						
						echo form_hidden('section_id', $section_id);
				
						echo '<p>Section: '.form_input(array(
							'name' => 'section_n',
							'value' => $section_n,	
							'placeholder' => 'Section Name',
							'class' => 'form-input'
						)).'</p>';
						
						?>
                    
					<button type="submit" class="form-button" style="float:right" id="submit" name="submit">Update</button> 
					</form>
                    
                    
			</div> <!-- end of class login -->
  
<div style="clear:both;"></div>