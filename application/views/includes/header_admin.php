<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
    	<title>SMC-BED Entrance System</title>
        
        <link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" media="all" />
        
        <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" />
		<script src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
		<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
		<script>
			$(function() {
				$( "#datefrom" ).datepicker();
			});
			$(function() {
				$( "#dateto" ).datepicker();
			});
		</script>
        
	</head>
<body>

<div id="wrapper">
    
    <div id='cssmenu'>
		<ul>
			<li class='has-sub'><a href='#'><span>Enroll</span></a>
				<ul>
					<li><a href='main'><span>New Patron</span></a></li>
                    <li><a href='patron_grade_section'><span>Patron Grade/Section</span></a></li>
					<li><a href='grade_section'><span>Grade/Section</span></a></li>
                    <li><a href='section'><span>Section</span></a></li>
                    <li><a href='school_year'><span>School Year</span></a></li>
					<li class='last'><a href='sysuser'><span>System User</span></a></li>
				</ul>
           </li>
           <li class='has-sub'><a href='#'><span>Reports</span></a>
				<ul>
					<li><a href='reports_patron'><span>Patron</span></a></li>
					<li><a href='reports_grades_section'><span>Grade/Section</span></a></li>
					<li><a href='reports_purpose'><span>Purpose</span></a></li>
					<li class='last'><a href='reports_all'><span>All</span></a></li>
				</ul>
           </li>
           <li class='has-sub'><a href='#'><span>Search</span></a>
              <ul>
                 <li><a href='search_patron'><span>Patron</span></a></li>
                 <li><a href='search_section'><span>Section</span></a></li>
                 <li><a href='search_school_year'><span>School Year</span></a></li>
                 <li class='last'><a href='search_sys_user'><span>System User</span></a></li>
              </ul>
           </li>
           <li class='last'><a href="../home/logout"><span>Logout</span></a></li>
        </ul>
	</div>
  
	<div id="content">
    