
	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form1">
        <h1>Enroll : Patron</h1>
        
        <?php
				$_SESSION['id_number'] = $this->input->post('id_number');
				$_SESSION['fn'] = $this->input->post('fn');
				$_SESSION['ln'] = $this->input->post('ln');
				$_SESSION['mn'] = $this->input->post('mn');
				
                echo validation_errors('<p class="error">');
				echo form_open_multipart('adminarea/enroll_patron');	
					
					echo '<p>ID Number: '.form_input(array(
						'name' => 'id_number',
						'value' => $_SESSION['id_number'],
						'placeholder' => '00-0000',
						'class' => 'form-input'
					)).'</p>';
			
					echo '<p>First Name: '.form_input(array(
						'name' => 'fn',
						'value' => $_SESSION['fn'],
						'placeholder' => 'First Name',
						'class' => 'form-input'
					)).'</p>';
					
					echo '<p>Last Name: '.form_input(array(
						'name' => 'ln',
						'value' => $_SESSION['ln'],
						'placeholder' => 'Last Name',
						'class' => 'form-input'
					)).'</p>';
					
					echo '<p>Middle Name: '.form_input(array(
						'name' => 'mn',
						'value' => $_SESSION['mn'],
						'placeholder' => 'Middle Name',
						'class' => 'form-input'
					)).'</p>';	
					
					echo '<p>Picture: (gif, jpg, png, bmp)'.form_upload(array(
						'name' => 'picture',
						'value' => '',
						'id' => 'picture',
						'placeholder' => 'Upload Picture',
						'class' => 'form-input'
					)).'</p>';
					
				?>
               
               <button type="submit" class="form-button" style="float:right" id="submit">Save</button> 
            </form>

        </div>
