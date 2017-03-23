	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Reports : Patron</h1>
        
        <?php
				$_SESSION['id_number'] = $this->input->post('id_number');
				$_SESSION['datefrom'] = $this->input->post('datefrom');
				$_SESSION['dateto'] = $this->input->post('dateto');
				$msg = '';
				$school_year_id = ''; 
				$school_year_n = 'Select School Year'; 
				
				if(isset($_POST['submit'])) {
				
					if ($this->input->post('school_year_id') <> '' ) {
							$school_year_id = $this->input->post('school_year_id');
							
							$query1 = $this->db->query('SELECT * FROM school_year where school_year_id = '.$school_year_id.' ');
												if ($query1->num_rows() > 0) {			
													foreach ($query1->result_array() as $row) {
														$school_year_n = $row['school_year_n'];
													}
												}
						}
					if ( ($this->input->post('school_year_id') == '') and ($this->input->post('id_number') == '')
								and ($this->input->post('datefrom') == '') 
								or ($this->input->post('school_year_id') == '') and ($this->input->post('id_number') == '')
								or ($this->input->post('id_number') == '') and ($this->input->post('datefrom') == '')
								or ($this->input->post('school_year_id') == '') and ($this->input->post('datefrom') == '')
								or ($this->input->post('school_year_id') == '')
								or ($this->input->post('id_number') == '')
								or ($this->input->post('datefrom') == '') ) {
									
									$msg = '<p class="error">Please check empty field/s.</p>';
								}
				} // end main if
				
				echo $msg;
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/reports_patron');
				
		?>
        		
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
						'value' => $_SESSION['id_number'],
						'placeholder' => '00-0000',
						'class' => 'form-input'
					)).'</p>';
					
					echo '<p>Date From: '.form_input(array(
						'name' => 'datefrom',
						'value' => $_SESSION['datefrom'],
						'placeholder' => 'yyyy-mm-dd',
						'class' => 'form-input',
						'id' => 'datefrom',
						'autocomplete' => 'off'
					)).'</p>';
					
					echo '<p>Date To: '.form_input(array(
						'name' => 'dateto',
						'value' => $_SESSION['dateto'],
						'placeholder' => 'yyyy-mm-dd',
						'class' => 'form-input',
						'id' => 'dateto',
						'autocomplete' => 'off'
					)).'</p>';
                    
		?>       
            <button type="submit" class="form-button" style="float:right" name="submit">Search</button> 
        </form>
        
        <br /><br /><br /><br />
        
       
        
        
        
        
        <?php
		
		if(isset($_POST['submit'])) {
						
					if ($this->input->post('school_year_id') <> '' ) {
						$school_year_id = $this->input->post('school_year_id');
						
						$query1 = $this->db->query('SELECT * FROM school_year where school_year_id = '.$school_year_id.' ');
											if ($query1->num_rows() > 0) {			
												foreach ($query1->result_array() as $row) {
													$school_year_n = $row['school_year_n'];
												}
											}
					}
					if ( ($this->input->post('school_year_id') == '') and ($this->input->post('id_number') == '')
					and ($this->input->post('datefrom') == '') 
					or ($this->input->post('school_year_id') == '') and ($this->input->post('id_number') == '')
					or ($this->input->post('id_number') == '') and ($this->input->post('datefrom') == '')
					or ($this->input->post('school_year_id') == '') and ($this->input->post('datefrom') == '')
					or ($this->input->post('school_year_id') == '')
					or ($this->input->post('id_number') == '')
					or ($this->input->post('datefrom') == '') ) {
						
						$msg = '<p class="error">Please check empty field/s.</p>';
					}
					else {
					
					$query = $this->db->query('SELECT * FROM patron WHERE id_number = "'.$this->input->post('id_number').'" ');
						foreach ($query->result_array() as $row) {
							$id_number = $row['id_number'];
							$fn = $row['fn'];
							$ln = $row['ln'];
							$mn = $row['mn'];
						} // end query
			
						$query1 = $this->db->query('SELECT * FROM patron_grade_level 
										WHERE id_number = "'.$this->input->post('id_number').'" 
										and school_year_id = '.$this->input->post('school_year_id').' ');
							if ($query1->num_rows() > 0) {				
							foreach ($query1->result_array() as $row) {
								$patron_grade_level_id = $row['patron_grade_level_id'];
								$grade_level_section_id = $row['grade_level_section_id'];
								$school_year_id = $row['school_year_id'];
							} // end query1
							}	
							else {
								$patron_grade_level_id = '1';
							}
							
							
							if ( ($this->input->post('dateto') == '') ) {
								$query2 = $this->db->query('SELECT * FROM visit WHERE id_number = "'.$this->input->post('id_number').'" 
											and patron_grade_level_id = '.$patron_grade_level_id.' 
											and date_in = "'.$this->input->post('datefrom').'"  ');
									if ($query2->num_rows() > 0) {	
									$counter = 0;
									foreach ($query2->result_array() as $row) {
										$visit_id = $row['visit_id'];
										$id_number = $row['id_number'];
										$patron_grade_level_id = $row['patron_grade_level_id'];
										$date_in = $row['date_in'];
										$counter = $counter + 1;
										
									} // end query2
										echo '<p class="error">'.$counter.' total record/s found for 
														'.$this->input->post('datefrom').'</p>';
									}
									else {
										echo '<p class="error">No results found.</p>';
									}	
							}
							else {
								//echo '<table>';
								$query2 = $this->db->query('SELECT * FROM visit
											WHERE id_number = "'.$this->input->post('id_number').'" 
											and patron_grade_level_id = '.$patron_grade_level_id.' 
											and date_in <= "'.$this->input->post('dateto').'" 
											and date_in >= "'.$this->input->post('datefrom').'" ');
									if ($query2->num_rows() > 0) {	
									$counter = 0;
									foreach ($query2->result_array() as $row) {
										$visit_id = $row['visit_id'];
										$id_number = $row['id_number'];
										$patron_grade_level_id = $row['patron_grade_level_id'];
										$date_in = $row['date_in'];
										$counter = $counter + 1;
										
									} // end query2
										echo '<p class="error">'.$counter.' total record/s found from 
														'.$this->input->post('datefrom').' to 
														'.$this->input->post('dateto').'</p>';
									}
									else {
										echo '<p class="error">No results found.</p>';
									}
							}
					}
					
			} // end if isset submit
		
		
		?>
        
         </div>
        
        <div style="clear:both;"></div>
        
        
        
        
