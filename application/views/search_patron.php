	<style type="text/css">
    .pop-up {position:absolute; top:0; left:-500em;}
    .pop-up:target {position:static; left:0;}
	
    .popBox {
      background:#fff3f1;
      position:absolute; left:30%; right:30%; top:5%; bottom:30%;
      z-index:10;
      border:1px solid #3a3a3a;
      -moz-border-radius:12px;
      border-radius:12px;
      -webkit-box-shadow:2px 2px 4px #3a3a3a;
      -moz-box-shadow:2px 2px 4px #3a3a3a;
      box-shadow:2px 2px 4px #3a3a3a;
      opacity:0;
      -webkit-transition: opacity 0.5s ease-in-out;
      -moz-transition: opacity 0.5s ease-in-out;
      -o-transition: opacity 0.5s ease-in-out;
      -ms-transition: opacity 0.5s ease-in-out;
      transition: opacity 0.5s ease-in-out;
	  height:500px;
    }

    :target .popBox {position:fixed; opacity:1;}

    .lightbox {display:none; text-indent:-200em; background:#000; opacity:0.4; width:100%; height:100%; position:fixed; top:0; left:0; bottom:0; right:0; z-index:5;}
    :target .lightbox {display:block;}
    .lightbox:hover {background:#000;}


    .close:link,
    .close:visited {
      position:absolute; top:-0.75em; right:-0.75em; display:block; width:1em; height:1em;
      padding:0;
      font:bold large/1 arial, sans-serif; text-align:center; text-decoration:none;
      background:#000; border:3px solid #fff; color:#fff;
      -moz-border-radius: 1em;
      -webkit-border-radius: 1em;
      border-radius: 1em;
      -moz-box-shadow: 0 0 1px 1px #3a3a3a;
      -webkit-box-shadow: 0 0 1px 1px #3a3a3a;
      box-shadow: 0 0 1px 1px #3a3a3a;
    }
    .close:before {content:"X";}
    .close:hover,
    .close:active,
    .close:focus {box-shadow:0 0 1px 1px #c00; background:#c00; color:#fff;}
    .close span {text-indent:-200em; display:block;}

    .popScroll {position:absolute; top:9%; left:3%; right:3%; bottom:9%; overflow-y:auto; *overflow-y:scroll; padding-right:0.5em}
</style>
	
	
	
	
	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Search : Patron</h1>
        
        <?php
				$_SESSION['searchpat'] = $this->input->post('searchpat');
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
				
					if ($this->input->post('searchpat') == '' and $this->input->post('school_year_id') == '' ) {
						$school_year_id = ''; 
						$school_year_n = 'Select School Year'; 
						$msg = '<p class="error">Please check empty field/s.</p>';
					}
					else if ($this->input->post('searchpat') == '') {
						$msg = '<p class="error">Please check empty field/s.</p>';
					}
					else if ($this->input->post('school_year_id') == '') {
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
				echo form_open('adminarea/search_patron');
				
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
					echo '<p>ID Number or Last Name: '.form_input(array(
						'name' => 'searchpat',
						'value' => $_SESSION['searchpat'],
						'placeholder' => 'Search here...',
						'class' => 'form-input'
					)).'</p>';
		?>       
            <button type="submit" class="form-button" style="float:right" name="submit">Search</button> 
        </form>
        
        <br /><br /><br /><br />
        
        <?php
		if(isset($_POST['submit'])) {
					if ($this->input->post('searchpat') == '' and $this->input->post('school_year_id') == '' ) {
					}
					else if ($this->input->post('searchpat') == '') {
					}
					else if ($this->input->post('school_year_id') == '') {
					}
					else {			
							$query = $this->db->query('SELECT * FROM patron, patron_grade_level 
								where patron.id_number = "'.$this->input->post('searchpat').'" 
								and patron_grade_level.school_year_id = "'.$this->input->post('school_year_id').'" 
								and patron_grade_level.id_number = patron.id_number
								or ln = "'.$this->input->post('searchpat').'"
								and patron_grade_level.school_year_id = "'.$this->input->post('school_year_id').'" 
								and patron_grade_level.id_number = patron.id_number ');
								if ($query->num_rows() > 0) {	
									
									echo '<table>';
									echo '<tr>';
									echo '<th>ID Number</th>';
									echo '<th>Last Name</th>';
									echo '<th>First Name</th>';
									echo '<th>Middle Name</th>';
									echo '<th>View</th>';
									echo '<th>Edit</th>';
									echo '<th>Delete</th>';
									echo '</tr>';
									$counter = 0;
									foreach ($query->result_array() as $row) {
										$patron_id = $row['patron_id'];
										$id_number = $row['id_number'];
										$fn = $row['fn'];
										$ln = $row['ln'];
										$mn = $row['mn'];
										$filename = $row['filename'];
										$counter = $counter + 1;
										
										echo '<tr>';
										echo '<td>'.$id_number.'</td>';
										echo '<td>'.$ln.'</td>';
										echo '<td>'.$fn.'</td>';
										echo '<td>'.$mn.'</td>';
										echo '<td align="center" id="#links">
										<a href="#pop1?id='.$patron_id.'"><img src="'.base_url().'images/view.png" width="20" /></a>
										</td>';
										?>                          
                                        
<div id="pop1?id=<?php echo $patron_id; ?>" class="pop-up">
    <div class="popBox">
      <div class="popScroll"> 

        <?php
		
				$query3 = $this->db->query('SELECT * FROM patron where patron_id = "'.$patron_id.'" ');
										if ($query3->num_rows() > 0) {			
											foreach ($query3->result_array() as $row) {
												$patron_id = $row['patron_id'];
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
												$patron_grade_level_id = $row['patron_grade_level_id'];
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
            
            <div class="login" style="width:480px; float:right;">
        
        	<?php
						if ($filename == '') {
							$filename = 'default.jpg';
							echo '<p align="center"><img src="../../files/'.$filename.'" width="160" /></p>';
						}
						else {
							echo '<p align="center"><img src="../../files/'.$filename.'" width="160" /></p>';
						}
						
						echo '<p style="padding-left: 20px;">ID Number: '.form_input(array(
							'name' => 'username',
							'value' => $id_number,
							'placeholder' => 'ID Number',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
				
						echo '<p style="padding-left: 20px;">Full Name: '.form_input(array(
							'name' => 'fn',
							'value' => $ln.', '.$fn.' '.$mn,
							'placeholder' => 'Full Name',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
						
						echo '<p style="padding-left: 20px;">Level: '.form_input(array(
							'name' => 'grade_level_n',
							'value' => $grade_level_n,
							'placeholder' => 'Level',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
						
						echo '<p style="padding-left: 20px;">Section: '.form_input(array(
							'name' => 'section_n',
							'value' => $section_n,
							'placeholder' => 'Section',
							'class' => 'form-input',
							'disabled' => 'disabled'
						)).'</p>';
					
					} // end of if
					
				?>
			</div> <!-- end of class login -->
                
        
      </div> <!-- end of popScroll -->      
      <a href="#links" class="close"><span>Back to links</span></a>
    </div>
    <a href="#links" class="lightbox">Back to links</a>
  </div>

                                        
                                        
                                        
                                        
                                        
                                        
                                        <?php
										echo '<td align="center"><a href="edit_patron?id='.$patron_id.'&&id1='.$school_year_id.'" target="_blank"><img src="'.base_url().'images/edit.png" width="20" /></a></td>';
										echo '<td align="center"><a href="patron_delete?id='.$patron_grade_level_id.'" target="_blank"><img src="'.base_url().'images/delete.png" width="20" /></a></td>';
										echo '</tr>';
										
									} // end query
									echo '</table>';
									
										echo '<p class="error">'.$counter.' total record/s found for 
															'.$this->input->post('searchpat').' </p>';
								} else {
									echo '<p class="error">No results found.</p>';
								}
						} 
					
			} // end if isset submit
		?>
        
         </div>
        
        <div style="clear:both;"></div>
        
        
        
  
  
   <div style="clear:both;"></div>