	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>

    	<div class="form2">
        <h1>Search : Section</h1>
        
        <?php
				$_SESSION['section_id'] = $this->input->post('section_id');
				$msg = '';
				
				if(isset($_POST['submit'])) {
					if($this->input->post('section_id')<>'') {
					$section_id = $this->input->post('section_id');
					
					$query1 = $this->db->query('SELECT * FROM section where section_id = '.$section_id.' ');
										if ($query1->num_rows() > 0) {			
											foreach ($query1->result_array() as $row) {
												$section_n = $row['section_n'];
											}
										}
					} 
				
					if ($this->input->post('section_id') == '' ) {
						$section_id = ''; 
						$section_n = 'Select Section'; 
						$msg = '<p class="error">Please check empty field/s.</p>';
					}	
					
				} else {
						$section_id = ''; 
						$section_n = 'Select Section'; 
					} // end main if
				
				echo $msg;
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/search_section');
				
		?>
					<select name="section_id" class="form-input">
                        <option value="<?php echo $section_id; ?>"><?php echo $section_n; ?></option>
                            <?php
                                $query2 = $this->db->query('SELECT * FROM section order by section_n');
                                    if ($query2->num_rows() > 0) {			
                                        foreach ($query2->result_array() as $row) {
                                            echo "<option value=$row[section_id]>". $row['section_n']."</option>";
                                        }
                                    }
                            ?>
                    </select>
                    
            		<button type="submit" class="form-button" style="float:right" name="submit">Search</button> 
       			</form>
        
        <br /><br /><br /><br />
        
        <?php
		if(isset($_POST['submit'])) {
					if ($this->input->post('section_id') == '' ) {
					}
					else {			
							$query = $this->db->query('SELECT * FROM section
								where section_id = "'.$this->input->post('section_id').'" ');
								if ($query->num_rows() > 0) {	
									
									echo '<table>';
									echo '<tr>';
									echo '<th>Section</th>';
									echo '<th>Edit</th>';
									echo '</tr>';
									
									foreach ($query->result_array() as $row) {
										$section_id = $row['section_id'];
										$section_n = $row['section_n'];
										
										echo '<tr>';
										echo '<td>'.$section_n.'</td>';
										echo '<td align="center"><a href="edit_section?id='.$section_id.'" target="_blank"><img src="'.base_url().'images/edit.png" width="20" /></a></td>';
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