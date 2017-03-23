	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Enroll : Grade/Section</h1>
        
        <?php
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/enroll_grade_section');	
				
		?> 
                    <select name="grade_level_id" class="form-input">
                        <option value="">Select Grade Level or Position</option>
                            <?php
                                $query1 = $this->db->query('SELECT * FROM grade_level order by grade_level_id');
                                    if ($query1->num_rows() > 0) {			
                                        foreach ($query1->result_array() as $row) {
                                            echo "<option value=$row[grade_level_id]>". $row['grade_level_n']."</option>";
                                        }
                                    }
                            ?>
                    </select>
                    
                    <select name="section_id" class="form-input">
                        <option value="">Select Section or Assignment</option>
                            <?php
                                $query2 = $this->db->query('SELECT * FROM section order by section_n');
                                    if ($query2->num_rows() > 0) {			
                                        foreach ($query2->result_array() as $row) {
                                            echo "<option value=$row[section_id]>". $row['section_n']."</option>";
                                        }
                                    }
                            ?>
                    </select>
                    
                    <select name="school_year_id" class="form-input">
                        <option value="">Select School Year</option>
                            <?php
                                $query2 = $this->db->query('SELECT * FROM school_year order by school_year_n');
                                    if ($query2->num_rows() > 0) {			
                                        foreach ($query2->result_array() as $row) {
                                            echo "<option value=$row[school_year_id]>". $row['school_year_n']."</option>";
                                        }
                                    }
                            ?>
                    </select>
               
               <button type="submit" class="form-button" style="float:right">Save</button> 
            </form>
        
        </div>
