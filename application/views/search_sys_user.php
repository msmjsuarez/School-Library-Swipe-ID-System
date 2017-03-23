	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>

    	<div class="form2">
        <h1>Search : System User</h1>
        
        <?php
				$_SESSION['libstaff_id'] = $this->input->post('libstaff_id');
				$msg = '';
				
				if(isset($_POST['submit'])) {
					if($this->input->post('libstaff_id')<>'') {
					$libstaff_id = $this->input->post('libstaff_id');
					
					$query1 = $this->db->query('SELECT * FROM libstaff where libstaff_id = '.$libstaff_id.' ');
										if ($query1->num_rows() > 0) {			
											foreach ($query1->result_array() as $row) {
												$fullname = $row['fullname'];
											}
										}
					} 
				
					if ($this->input->post('libstaff_id') == '' ) {
						$libstaff_id = ''; 
						$fullname = 'Select System User'; 
						$msg = '<p class="error">Please check empty field/s.</p>';
					}	
					
				} else {
						$libstaff_id = ''; 
						$fullname = 'Select System User'; 
					} // end main if
				
				echo $msg;
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/search_sys_user');
				
		?>
					<select name="libstaff_id" class="form-input">
                        <option value="<?php echo $libstaff_id; ?>"><?php echo $fullname; ?></option>
                            <?php
                                $query2 = $this->db->query('SELECT * FROM libstaff order by fullname');
                                    if ($query2->num_rows() > 0) {			
                                        foreach ($query2->result_array() as $row) {
                                            echo "<option value=$row[libstaff_id]>". $row['fullname']."</option>";
                                        }
                                    }
                            ?>
                    </select>
                    
            		<button type="submit" class="form-button" style="float:right" name="submit">Search</button> 
       			</form>
        
        <br /><br /><br /><br />
        
        <?php
		if(isset($_POST['submit'])) {
					if ($this->input->post('libstaff_id') == '' ) {
					}
					else {			
							$query = $this->db->query('SELECT * FROM libstaff
								where libstaff_id = "'.$this->input->post('libstaff_id').'" ');
								if ($query->num_rows() > 0) {	
									
									echo '<table>';
									echo '<tr>';
									echo '<th>Full Name</th>';
									echo '<th>Delete</th>';
									echo '</tr>';
									
									foreach ($query->result_array() as $row) {
										$libstaff_id = $row['libstaff_id'];
										$fullname = $row['fullname'];
										
										
										echo '<tr>';
										echo '<td>'.$fullname.'</td>';
										echo '<td align="center">';
										echo anchor("adminarea/delete_sys_user?id=".$row['libstaff_id'], '<img src="'.base_url().'images/delete.png" width="20" />',array('onclick' => "return confirm('Do you want delete this System User?')"));
										echo '</td>';
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