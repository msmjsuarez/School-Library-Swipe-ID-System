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
				$visit_purpose_id = ''; 
				$purpose = 'Select Purpose'; 
				
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
				echo form_open('adminarea/reports_purpose');
				
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
                    <select name="visit_purpose_id" class="form-input">
                        <option value="<?php echo $visit_purpose_id; ?>"><?php echo $purpose; ?></option>
                            <?php
                                $query2 = $this->db->query('SELECT * FROM visit_purpose');
                                    if ($query2->num_rows() > 0) {			
                                        foreach ($query2->result_array() as $row) {
                                            echo "<option value=$row[visit_purpose_id]>". $row['purpose']."</option>";
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
					if ( ($this->input->post('school_year_id') == '') and ($this->input->post('datefrom') == '') and ($this->input->post('visit_purpose_id') == '')
					or ($this->input->post('school_year_id') == '')
					or ($this->input->post('visit_purpose_id') == '')
					or ($this->input->post('datefrom') == '') ) {
						
						$msg = '<p class="error">Please check empty field/s.</p>';
					}
					else {
					
					$datefrom1 = strip_tags($this->input->post('datefrom'));
					$datefrom = str_replace('-', '', $datefrom1);
					
					$dateto1 = strip_tags($this->input->post('dateto'));
					$dateto = str_replace('-', '', $dateto1);
					
						if ( ($this->input->post('dateto') == '') ) {
								$query2 = $this->db->query('SELECT * FROM visit
								where visit.school_year_id = '.$this->input->post('school_year_id').' 
								and date_wo_hyphen1 = '.$datefrom.' ');
								if ($query2->num_rows() > 0) {	
									$counter = 0;
									foreach ($query2->result_array() as $row) {
										$purpose = $row['purpose'];
										//echo $purpose ;
										$purpose_na = unserialize($purpose);
										$purpose_naa = [];
									  	$length = sizeof($purpose_na);
											for ($x = 0; $x < $length; $x++) {
											    $purpose_naa[] = $purpose_na[$x];
											}
											foreach ($purpose_naa as $key => $value) {
												//echo $value.'<br>';
												if ($value == $this->input->post('visit_purpose_id')) {
													$counter = $counter + 1;
													//echo $this->input->post('visit_purpose_id'). ' ---> '.$value.'<br>';
												}
											}
									}
										echo '<p class="error">'.$counter.' total records found for 
															'.$this->input->post('datefrom').'</p>';
								} else {
										echo '<p class="error">No results found.</p>';
										}
						} else {
							$query2 = $this->db->query('SELECT * FROM visit
								WHERE visit.school_year_id = '.$this->input->post('school_year_id').'
								and date_wo_hyphen1 <= '.$dateto.' 
								and date_wo_hyphen1 >= '.$datefrom.' ');
									if ($query2->num_rows() > 0) {	
									$counter = 0;
									foreach ($query2->result_array() as $row) {
										$purpose = $row['purpose'];
										//echo $purpose ;
										$purpose_na = unserialize($purpose);
										$purpose_naa = [];
									  	$length = sizeof($purpose_na);
											for ($x = 0; $x < $length; $x++) {
											    $purpose_naa[] = $purpose_na[$x];
											}
											foreach ($purpose_naa as $key => $value) {
												//echo $value.'<br>';
												if ($value == $this->input->post('visit_purpose_id')) {
													$counter = $counter + 1;
													//echo $this->input->post('visit_purpose_id'). ' ---> '.$value.'<br>';
												}
											}
									}
										echo '<p class="error">'.$counter.' total records found from 
														'.$this->input->post('datefrom').' to 
														'.$this->input->post('dateto').'</p>';
								} else {
										echo '<p class="error">No results found.</p>';
									}
						} // end second else
					
					} // end first else
					
			} // end if isset submit
		
		
		?>
        
         </div>
        
        <div style="clear:both;"></div>
        
        
        
        
