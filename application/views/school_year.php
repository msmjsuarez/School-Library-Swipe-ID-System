	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Enroll : School Year</h1>
        
			<?php
				$_SESSION['school_year_n'] = $this->input->post('school_year_n');
				
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/enroll_school_year');	
					
					echo '<p>School Year: '.form_input(array(
						'name' => 'school_year_n',
						'value' => $_SESSION['school_year_n'],
						'placeholder' => '0000-0000',
						'class' => 'form-input'
					)).'</p>';
					
				?>
               
               <button type="submit" class="form-button" style="float:right">Save</button> 
            </form>
        
        </div>
