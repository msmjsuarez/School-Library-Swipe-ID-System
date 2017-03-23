	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Reports : School Year</h1>
        
        <?php
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
					if ( ($this->input->post('school_year_id') == '') and ($this->input->post('datefrom') == '') 
								or ($this->input->post('school_year_id') == '')
								or ($this->input->post('datefrom') == '') ) {
									
									$msg = '<p class="error">Please check empty field/s.</p>';
								}
				} // end main if
				
				echo $msg;
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/reports_all');
				
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
					echo '<p>Date From: '.form_input(array(
						'name' => 'datefrom',
						'value' => $_SESSION['datefrom'],
						'placeholder' => 'yyyy-mm-dd',
						'class' => 'form-input',
						'id' => 'datefrom'
					)).'</p>';
					
					echo '<p>Date To: '.form_input(array(
						'name' => 'dateto',
						'value' => $_SESSION['dateto'],
						'placeholder' => 'yyyy-mm-dd',
						'class' => 'form-input',
						'id' => 'dateto'
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
					if ( ($this->input->post('school_year_id') == '') and ($this->input->post('datefrom') == '')
					or ($this->input->post('school_year_id') == '')
					or ($this->input->post('datefrom') == '') ) {
						
						$msg = '<p class="error">Please check empty field/s.</p>';
					}
					else {
					
					$datefrom1 = strip_tags($this->input->post('datefrom'));
					$datefrom = str_replace('-', '', $datefrom1);
					
					$dateto1 = strip_tags($this->input->post('dateto'));
					$dateto = str_replace('-', '', $dateto1);
					
						if ( ($this->input->post('dateto') == '') ) {
							$query = $this->db->query('SELECT * FROM visit
								where visit.school_year_id = '.$this->input->post('school_year_id').'
								and date_wo_hyphen1 = '.$datefrom.' ');
								if ($query->num_rows() > 0) {	
									$counter = 0;
									foreach ($query->result_array() as $row) {
										$visit_id = $row['visit_id'];
										$patron_grade_level_id = $row['patron_grade_level_id'];
										$date_in = $row['date_in'];
										$school_year_id = $row['school_year_id'];
										$counter = $counter + 1;
									} // end query
									
										echo '<p class="error">'.$counter.' total records found for 
															'.$this->input->post('datefrom').'</p>';
								} else {
									echo '<p class="error">No results found.</p>';
								}
						} else {
							$query = $this->db->query('SELECT * FROM visit
								WHERE visit.school_year_id = '.$this->input->post('school_year_id').'
								and date_wo_hyphen1 <= '.$dateto.' 
								and date_wo_hyphen1 >= '.$datefrom.' ');
									if ($query->num_rows() > 0) {	
									$counter = 0;
									foreach ($query->result_array() as $row) {
										$visit_id = $row['visit_id'];
										$patron_grade_level_id = $row['patron_grade_level_id'];
										$date_in = $row['date_in'];
										$school_year_id = $row['school_year_id'];
										$counter = $counter + 1;
									} // end query
										echo '<p class="error">'.$counter.' total records found from 
														'.$this->input->post('datefrom').' to 
														'.$this->input->post('dateto').'</p>';
									}
									else {
										echo '<p class="error">No results found.</p>';
									}
						} // end second else
					
					} // end first else
					
			} // end if isset submit
		
		
		?>
        
         </div>
        
        <div style="clear:both;"></div>
        
        
        
        
