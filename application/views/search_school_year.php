	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>

    	<div class="form2">
        <h1>Search : School Year</h1>
        
        <?php
				$_SESSION['school_year_id'] = $this->input->post('school_year_id');
				$msg = '';
				
				if(isset($_POST['submit'])) {
					if($this->input->post('school_year_id')<>'') {
					$school_year_id = $this->input->post('school_year_id');
					
					$query1 = $this->db->query('SELECT * FROM school_year where school_year_id = '.$school_year_id.' ');
										if ($query1->num_rows() > 0) {			
											foreach ($query1->result_array() as $row) {
												$school_year_n = $row['school_year_n'];
											}
										}
					} 
				
					if ($this->input->post('school_year_id') == '' ) {
						$school_year_id = ''; 
						$school_year_n = 'Select School Year'; 
						$msg = '<p class="error">Please check empty field/s.</p>';
					}	
					
				} else {
						$school_year_id = ''; 
						$school_year_n = 'Select School Year'; 
					} // end main if
				
				echo $msg;
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/search_school_year');
				
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
                    
            		<button type="submit" class="form-button" style="float:right" name="submit">Search</button> 
       			</form>
        
        <br /><br /><br /><br />
        
        <?php
		if(isset($_POST['submit'])) {
					if ($this->input->post('school_year_id') == '' ) {
					}
					else {			
							$query = $this->db->query('SELECT * FROM school_year
								where school_year_id = "'.$this->input->post('school_year_id').'" ');
								if ($query->num_rows() > 0) {	
									
									echo '<table>';
									echo '<tr>';
									echo '<th>School Year</th>';
									echo '<th>Edit</th>';
									echo '</tr>';
									
									foreach ($query->result_array() as $row) {
										$school_year_id = $row['school_year_id'];
										$school_year_n = $row['school_year_n'];
										
										echo '<tr>';
										echo '<td>'.$school_year_n.'</td>';
										echo '<td align="center"><a href="edit_school_year?id='.$school_year_id.'" target="_blank"><img src="'.base_url().'images/edit.png" width="20" /></a></td>';
										echo '</tr>';
									} // end query
									echo '</table>';
									
								} else {
									echo '<p class="error">No results found.</p>';
								}
						} 
					
			} // end if isset submit
		?>
        
         </div> <!-- end of form2 -->
        <div style="clear:both;"></div>