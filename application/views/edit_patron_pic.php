	<?php
	
		foreach($query as $row){
			$_SESSION['libstaff_id'] = $row->libstaff_id;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['username'] = $row->username;
		}
		echo '<span class="small">Welcome '.$_SESSION['fullname'].'</span>';
		
		foreach($query1 as $row){
			$_SESSION['patron_id'] = $row->patron_id;
			$_SESSION['filename'] = $row->filename;
		}
	?>
  
    	<div class="form2">
        <h1>Edit : Patron Picture</h1>
            <div class="login" style="width: 480px; float:right;">
        
        <?php
				echo validation_errors('<p class="error">');
				echo form_open_multipart('adminarea/edit_patron_pic1?id='.$_SESSION['patron_id'].'');
				
						if ($_SESSION['filename'] == '') {
							$_SESSION['filename'] = 'default.jpg';
							echo '<p align="center"><img src="../../files/'.$_SESSION['filename'].'" width="160" /></p>';
						}
						else {
							echo '<p align="center"><img src="../../files/'.$_SESSION['filename'].'" width="160" /></p>';
						}
						
						echo '<p>Change Picture: (gif, jpg, png, bmp)'.form_upload(array(
						'name' => 'picture',
						'value' => '',
						'id' => 'picture',
						'placeholder' => 'Upload Picture',
						'class' => 'form-input'
					)).'</p>';
					
						echo form_hidden('patron_id', $_SESSION['patron_id']);
					
						?>
                        
					<button type="submit" class="form-button" style="float:right" id="submit" name="submit">Update</button> 
					</form>
                    
                    
			</div> <!-- end of class login -->
  
<div style="clear:both;"></div>