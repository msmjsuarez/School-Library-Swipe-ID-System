
<div style="width:900px;">

    	<div class="login" style="width:400px; float:left;">
        <h1>Patron Login</h1>
        
        	<?php
			
				if(isset($_POST['submit']) && $this->input->post('id_number')<>'' && $this->input->post('school_year_id')<>'' && $this->input->post('visit_purpose_id')<>'') {
					$id_number = $this->input->post('id_number');
					$school_year_id = $this->input->post('school_year_id');
					$visit_purpose_id = $this->input->post('visit_purpose_id');
					
					$query1 = $this->db->query('SELECT * FROM school_year where school_year_id = '.$school_year_id.' ');
										if ($query1->num_rows() > 0) {			
											foreach ($query1->result_array() as $row) {
												$school_year_n = $row['school_year_n'];
											}
										}

					
					// $query2 = $this->db->query('SELECT * FROM visit_purpose where visit_purpose_id = '.$visit_purpose_id.' ');
					// 					if ($query2->num_rows() > 0) {			
					// 						foreach ($query2->result_array() as $row) {
					// 							$purpose = $row['purpose'];
					// 						}
					// 					}

				}
				else {
					$id_number = '';
					$school_year_id = ''; 
					$school_year_n = 'Select School Year';
					$visit_purpose_id = '';
					$purpose = 'Select Purpose';
				}


				// Get School Year When Submit
				if(isset($_POST['submit']) && $this->input->post('school_year_id')<>'') {
					$school_year_id = $this->input->post('school_year_id');
					$query1 = $this->db->query('SELECT * FROM school_year where school_year_id = '.$school_year_id.' ');
										if ($query1->num_rows() > 0) {			
											foreach ($query1->result_array() as $row) {
												$school_year_n = $row['school_year_n'];
											}
										}
					$_SESSION['school_year_n'] = $school_year_n;
				}
				else {
					$_SESSION['school_year_n'] = 'Select School Year';
				}
				

                echo validation_errors('<p style="color:red;" class="error">');
                echo form_open('home/enroll_patron_log',  'class="form"');		
			?>	

            		<p>School Year: </p>
					<select name="school_year_id" class="form-input">
                        <option value="<?php echo $school_year_id; ?>"><?php echo $_SESSION['school_year_n']; ?></option>
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

				<p>Purpose: </p>
                            <?php
                                $query3 = $this->db->query('SELECT * FROM visit_purpose order by visit_purpose_id asc');
                                    if ($query3->num_rows() > 0) {			
                                        foreach ($query3->result_array() as $row) {
            echo "<input id=visit_purpose_id$row[visit_purpose_id] onchange='otherspurpose(this);' type=checkbox name=visit_purpose_id[] value=$row[visit_purpose_id]>".$row['purpose'].'<br>';
                                        }
                                    }
                            ?>
                    <?php						
					echo '<p class="displaynone" id="visit_purpose_id_box">'.form_input(array(
						'name' => 'visit_purpose_id_others',
						'value' => '',
						'placeholder' => 'Enter your purpose here',
						'class' => 'form-input',
						'id' => 'visit_purpose_id'
					)).'</p>';	
				?>

                
                <button type="submit" class="form-button" style="float:right" name="submit">Login</button>
                </form>
                <p>&nbsp;</p>
                <span class="small"><a href="<?php echo base_url();?>" class="colorchange">Staff Login</a></span>                    
            </div>
            
            
            <?php 
			
			if(isset($_POST['submit']) && $this->input->post('id_number')<>'' 
				&& $this->input->post('school_year_id')<>'' && $this->input->post('visit_purpose_id')<>'' ) {
						
				$query3 = $this->db->query('SELECT * FROM patron where id_number = "'.$this->input->post('id_number').'" ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$id_number = $row['id_number'];
												$fn = $row['fn'];
												$ln = $row['ln'];
												$mn = $row['mn'];
												$filename = $row['filename'];
											}
										}
				$query9 = $this->db->query('SELECT * FROM visit where id_number = "'.$this->input->post('id_number').'" and school_year_id = "'.$this->input->post('school_year_id').'" order by visit_id desc limit 1');
					if ($query9->num_rows() > 0) {			
						foreach ($query9->result_array() as $row) {
							$purpose_n = $row['purpose'];
							$otherpurpose = $row['otherpurpose'];						}
					}	
					  $purpose_na = unserialize($purpose_n);
					  $purpose_naa = [];
					  $length = sizeof($purpose_na);
							for ($x = 0; $x < $length; $x++) {
							    $purpose_naa[] = $purpose_na[$x];
							} 
				     										
				$query4 = $this->db->query('SELECT * FROM patron_grade_level where id_number = "'.$this->input->post('id_number').'" and school_year_id = '.$this->input->post('school_year_id').' ');
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
			
			if (($query3->num_rows() > 0) and ($query4->num_rows() > 0) and ($query9->num_rows() > 0)) {
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

						echo '<p class="form-input" style="height: auto !important;">Purpose: <br>';
						foreach ($purpose_naa as $key => $value) {
							 	 $query10 = $this->db->query('SELECT * FROM visit_purpose where visit_purpose_id = '.$value.' ');
								if ($query10->num_rows() > 0) {			
									foreach ($query10->result_array() as $row) {
										$purpose_naaa = $row['purpose'];
									}
									echo $purpose_naaa.'<br>';
								}
							}
						echo '</p>';
						
						// echo '<p>Purpose: '.form_input(array(
						// 	'name' => 'purpose',
						// 	'value' =>$purpose_naaa,
						// 	'placeholder' => 'Purpose',
						// 	'class' => 'form-input',
						// 	'disabled' => 'disabled'
						// )).'</p>';
						echo '<p>Other Purpose: '.form_input(array(
							'name' => 'otherpurpose',
							'value' => $otherpurpose,
							'placeholder' => 'Purpose',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
					
					} // end of if
					
					
			} //end if isset submit
				
				?>
                     
            </div>
            
            
            
		</div>
            
	<div style="clear:both; margin-top: 50px;">&nbsp;</div>
