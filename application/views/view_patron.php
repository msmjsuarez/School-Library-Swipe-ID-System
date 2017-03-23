
<div style="width:900px;">

    	<div class="login" style="width:400px; float:left;">
        <h1>Patron Login</h1>
        
        	<?php
			
				if(isset($_POST['submit']) && $this->input->post('id_number')<>'' && $this->input->post('school_year_id')<>'') {
					$id_number = $this->input->post('id_number');
					$school_year_id = $this->input->post('school_year_id');
					
					$query1 = $this->db->query('SELECT * FROM school_year where school_year_id = '.$school_year_id.' ');
										if ($query1->num_rows() > 0) {			
											foreach ($query1->result_array() as $row) {
												$school_year_n = $row['school_year_n'];
											}
										}
				}
				else {
					$id_number = '';
					$school_year_id = ''; 
					$school_year_n = 'Select School Year'; 
				}
				
                echo validation_errors('<p style="color:red;" class="error">');
                echo form_open('home/enroll_patron_log',  'class="form"');
					
			?>	
            		<p>School Year: </p>
					<select name="school_year_id" class="form-input">
                        <option value="<?php echo $school_year_id; ?>"><?php echo $school_year_n; ?></option>
                            <?php
                                $query2 = $this->db->query('SELECT * FROM school_year order by school_year_n');
                                    if ($query2->num_rows() > 0) {			
                                        foreach ($query2->result_array() as $row) {
                                            echo "<option value=$row[school_year_id]>". $row['school_year_n']."</option>";
                                        }
                                    }
                            ?>
                    </select>
                    
				<?php
				
				
					echo '<p>ID Number: '.form_input(array(
						'name' => 'id_number',
						'value' => '',
						'placeholder' => 'ID Number',
						'class' => 'form-input',
						'id' => 'id_number'
					)).'</p>';	
				?>
                
                <button type="submit" class="form-button" style="float:right" name="submit">Login</button>
                </form>
                
                <span class="small"><a href="<?php echo base_url();?>">Staff Login</a></span>
                     
            </div>
            
            
            <?php 
			
			if(isset($_POST['submit']) && $this->input->post('id_number')<>'' && $this->input->post('school_year_id')<>'') {
				$id_number = strip_tags($this->input->post('id_number'));
				$id_num_wo_hyphen = str_replace('-', '', $id_number);
						
				$query3 = $this->db->query('SELECT * FROM patron where id_num_wo_hyphen = '.$id_num_wo_hyphen.' ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$id_number = $row['id_number'];
												$fn = $row['fn'];
												$ln = $row['ln'];
												$mn = $row['mn'];
												$filename = $row['filename'];
											}
										}
										
				$query4 = $this->db->query('SELECT * FROM patron_grade_level where id_num_wo_hyphen = '.$id_num_wo_hyphen.' 
											and school_year_id = '.$school_year_id.' ');
										if ($query4->num_rows() > 0) {			
											foreach ($query4->result_array() as $row) {
												$grade_level_section_id = $row['grade_level_section_id'];
											}
										}
								
								if (($query3->num_rows() > 0) and ($query4->num_rows() > 0)) {	
								$query5 = $this->db->query('SELECT * FROM grade_level_section 
													where grade_level_section_id = '.$grade_level_section_id.' ');
													if ($query5->num_rows() > 0) {			
														foreach ($query5->result_array() as $row) {
															$grade_level_id = $row['grade_level_id'];
															$section_id = $row['section_id'];
															$school_year_id = $row['school_year_id'];
															
															$query6 = $this->db->query('SELECT * FROM grade_level 
																where grade_level_id = '.$grade_level_id.' ');
																if ($query6->num_rows() > 0) {			
																	foreach ($query6->result_array() as $row) {
																		$grade_level_n = $row['grade_level_n'];
																	}
																}
																
															$query7 = $this->db->query('SELECT * FROM section 
																where section_id = '.$section_id.' ');
																if ($query7->num_rows() > 0) {			
																	foreach ($query7->result_array() as $row) {
																		$section_n = $row['section_n'];
																	}
																}
																
															$query8 = $this->db->query('SELECT * FROM school_year 
																where school_year_id = '.$school_year_id.' ');
																if ($query8->num_rows() > 0) {			
																	foreach ($query8->result_array() as $row) {
																		$school_year_n = $row['school_year_n'];
																	}
																}	
																		
															
										}
									} //end query5
								}
			
			if (($query3->num_rows() > 0) and ($query4->num_rows() > 0)) {
			?>
            
            <div class="login" style="width:400px; float:right;">
        	<h1>Your Information</h1>
        
        	<?php
						if ($filename == '') {
							$filename = 'default.jpg';
							echo '<p align="center"><img src="../../files/'.$filename.'" width="160" /></p>';
						}
						else {
							echo '<p align="center"><img src="../../files/'.$filename.'" width="160" /></p>';
						}
						
						echo '<p>ID Number: '.form_input(array(
							'name' => 'username',
							'value' => $id_number,
							'placeholder' => 'ID Number',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
				
						echo '<p>Full Name: '.form_input(array(
							'name' => 'fn',
							'value' => $ln.', '.$fn.' '.$mn,
							'placeholder' => 'Full Name',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
						
						echo '<p>Level: '.form_input(array(
							'name' => 'grade_level_n',
							'value' => $grade_level_n,
							'placeholder' => 'Level',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
						
						echo '<p>Section: '.form_input(array(
							'name' => 'section_n',
							'value' => $section_n,
							'placeholder' => 'Section',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
					
					} // end of if
					
					
			} //end if isset submit
				
				?>
                     
            </div>
            
            
            
		</div>
            
	<div style="clear:both;"></div>
