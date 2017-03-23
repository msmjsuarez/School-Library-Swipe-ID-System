	<?php
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
	?>
  
    	<div class="form2">
        <h1>Enroll : System User</h1>
        
        <?php
				$_SESSION['fullname1'] = $this->input->post('fullname');
				$_SESSION['username'] = $this->input->post('username');
				$_SESSION['password'] = $this->input->post('password');
				$_SESSION['cpassword'] = $this->input->post('cpassword');
				
                echo validation_errors('<p class="error">');
				echo form_open('adminarea/enroll_sysuser');	
				
					echo '<p>Full Name: '.form_input(array(
						'name' => 'fullname',
						'value' => $_SESSION['fullname1'],
						'placeholder' => 'Full Name',
						'class' => 'form-input'
					)).'</p>';
					
					echo '<p>User Name: '.form_input(array(
						'name' => 'username',
						'value' => $_SESSION['username'],
						'placeholder' => 'User Name',
						'class' => 'form-input'
					)).'</p>';
			
					echo '<p>Password: '.form_password(array(
						'name' => 'password',
						'value' => $_SESSION['password'],
						'placeholder' => 'Password',
						'class' => 'form-input'
					)).'</p>';
					
					echo '<p>Confirm Password: '.form_password(array(
						'name' => 'cpassword',
						'value' => $_SESSION['cpassword'],
						'placeholder' => 'Confirm Password',
						'class' => 'form-input'
					)).'</p>';
					
				?>
               
               <button type="submit" class="form-button" style="float:right">Register</button> 
            </form>

        </div>
