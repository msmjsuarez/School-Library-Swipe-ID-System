	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Enroll : Section</h1>
        
			<?php
				$_SESSION['section_n'] = $this->input->post('section_n');
				
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/enroll_section');	
					
					echo '<p>Section: '.form_input(array(
						'name' => 'section_n',
						'value' => $_SESSION['section_n'],
						'placeholder' => 'Section Name',
						'class' => 'form-input'
					)).'</p>';
					
				?>
               
               <button type="submit" class="form-button" style="float:right">Save</button> 
            </form>
        
        </div>
