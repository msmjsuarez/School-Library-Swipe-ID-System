 
    <p class="error">Please use *** Google Chrome *** browser to maximize the system features.</p>
  
    	<div class="login">
        <h1>Login Form</h1>
        
        	<?php
			
				$_SESSION['username'] = $this->input->post('username');
				
                echo validation_errors('<p style="color:red;" class="error">');
                    echo form_open('home/validate_credentials',  'class="form"');	
					
					echo '<p>User Name: '.form_input(array(
						'name' => 'username',
						'value' => $_SESSION['username'],
						'placeholder' => 'User Name',
						'class' => 'form-input'
					)).'</p>';
			
					echo '<p>Password: '.form_password(array(
						'name' => 'password',
						'value' =>'',
						'placeholder' => 'Password',
						'class' => 'form-input'
					)).'</p>';	
				?>
               
               <button type="submit" class="form-button" style="float:right">Login</button>
            </form>
            
            <span class="small"><a href="<?php echo base_url();?>index.php/home/patron_log" class="colorchange"> Patron Login</a></span>
                 
        </div>
