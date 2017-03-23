	<?php	
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
    	<div class="form2">
        <h1>Edit : Patron</h1>
            <div class="login" style="width: 480px; float:right;">
        
        	<?php
			
				if(isset($_POST['submit'])) {
					
					if(($_POST['fn'] <> '') and ($_POST['ln'] <> '')) {
						$query = $this->db->query('SELECT * FROM patron 
								WHERE id_number="'.$this->input->post('id_number').'" ');
							foreach ($query->result_array() as $row) {
								$patron_id = $row['patron_id'];
							}	
							$this->db->where('patron_id', $patron_id)
							->update('patron', array(
									'fn' => $this->input->post('fn'),
									'ln' => $this->input->post('ln'),
									'mn' => $this->input->post('mn')	
								));
					}
					else {
						echo '<p class="error">Please check empty fields!</p>';
					}
					
					if($_POST['grade_level_section_id'] <> '') {
						$query = $this->db->query('SELECT * FROM patron_grade_level 
								WHERE id_number="'.$this->input->post('id_number').'" 
								and school_year_id="'.$this->input->post('school_year_id').'"   ');
							foreach ($query->result_array() as $row) {
								$patron_grade_level_id = $row['patron_grade_level_id'];
							}	
							$this->db->where('patron_grade_level_id', $patron_grade_level_id)
							->update('patron_grade_level', array(
									'grade_level_section_id' => $this->input->post('grade_level_section_id')	
								));
					}
					
					//for display
					$query3 = $this->db->query('SELECT * FROM patron where patron_id = "'.$this->input->post('patron_id').'" ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$id_number = $row['id_number'];
												$fn = $row['fn'];
												$ln = $row['ln'];
												$mn = $row['mn'];
												$filename = $row['filename'];
											}
										}
										
					$query4 = $this->db->query('SELECT * FROM patron_grade_level where id_number = "'.$id_number.'" 
											and school_year_id = "'.$this->input->post('school_year_id').'" ');
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
										} //end if
									} //end query5
								}
				
				} // end main if 
				else {
			
				$patron_id = $_GET['id'];
				$school_year_id = $_GET['id1'];
		
				$query3 = $this->db->query('SELECT * FROM patron where patron_id = "'.$patron_id.'" ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$id_number = $row['id_number'];
												$fn = $row['fn'];
												$ln = $row['ln'];
												$mn = $row['mn'];
												$filename = $row['filename'];
											}
										}
										
				$query4 = $this->db->query('SELECT * FROM patron_grade_level where id_number = "'.$id_number.'" 
											and school_year_id = "'.$school_year_id.'" ');
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
				} //end else
				
			
			
				echo validation_errors('<p class="error">');
				echo form_open_multipart('adminarea/edit_patron?id='.$patron_id.'&&id1='.$school_year_id.'');
				
						if ($filename == '') {
							$filename = 'default.jpg';
							echo '<p align="center"><img src="../../files/'.$filename.'" width="160" /></p>';
						}
						else {
							echo '<p align="center"><img src="../../files/'.$filename.'" width="160" /></p>';
						}
						
						echo '<p align="center">Click <a href="edit_patron_pic?id='.$patron_id.'" target="_blank">here</a> to update picture.</p>';
						
						echo '<p>ID Number: <span class="error">restricted for editing</span>'.form_input(array(
							'name' => '',
							'value' => $id_number,
							'placeholder' => 'ID Number',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
						
						echo form_hidden('id_number', $id_number);
				
						echo '<p>Last Name: '.form_input(array(
							'name' => 'ln',
							'value' => $ln,
							'placeholder' => 'Last Name',
							'class' => 'form-input'
						)).'</p>';
						
						echo '<p>First Name: '.form_input(array(
							'name' => 'fn',
							'value' => $fn,
							'placeholder' => 'First Name',
							'class' => 'form-input'
						)).'</p>';
						
						echo '<p>Middle Name: '.form_input(array(
							'name' => 'mn',
							'value' => $mn,
							'placeholder' => 'Middle Name',
							'class' => 'form-input'
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
						
						echo form_hidden('patron_id', $patron_id);
						echo form_hidden('school_year_id', $school_year_id);
						
						?>
						
                        <p class="error">If you want to change <strong>Grade Level/Section</strong> for S.Y. <strong><?php echo $school_year_n; ?></strong></p>
						<select name="grade_level_section_id" class="form-input">
                        <option value=""><span class="error">Select here</span></option>
                            <?php
							
								$query1 = $this->db->query('SELECT * FROM grade_level_section where school_year_id = "'.$school_year_id.'" ');
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
                    
					<button type="submit" class="form-button" style="float:right" id="submit" name="submit">Update</button> 
					</form>
                    
                    
			</div> <!-- end of class login -->
  
<div style="clear:both;"></div>