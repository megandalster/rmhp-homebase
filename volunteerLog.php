<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
session_start();
session_cache_expire(30);
include_once('database/dbPersons.php');
include_once('domain/Person.php');
$person = retrieve_person($_GET['id']);
?>
<html>
<head>
<link rel="stylesheet" href="lib/jquery-ui.css" />
<link rel="stylesheet" href="lib/jquery.timepicker.css" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
<script src="lib/jquery.timepicker.js"></script>
<script>
$(function() {
	$( "#date" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true});
	$( "#start_time" ).timepicker();
	$( "#end_time" ).timepicker();
});
</script>
</head>
<body>
<div id="container">
    <?PHP include('header.php'); ?>
    <div id="content">
	<form method="post">
	<?php 
		echo '<p> <b>Volunteer Log Sheet </b> for '.$person->get_first_name()." ".$person->get_last_name();
		echo "<br> Today is ".date('l F j, Y')."</p>";  
	    ?>
		<p><table><tr><td>Date</td><td>Start time</td><td>End time</td><td>Hours worked</td><td>Venue</td><td>Total to date</td></tr>
	        <tr>
	    	    <td><input type="text" name="date" id="date"></td>
				<td><input type="text" name="start_time" id="start_time" size=10></td>
				<td><input type="text" name="end_time" id="end_time" size=10></td>
				<td><input type="text" name="hours_worked" id="hours_worked" size=10></td>
				<td><select name="venue">
		<?php 
		$venues = array('house' => 'House', 'fam' => 'Family Room', 'mealprep' => 'Meal Prep', 'activities' => 'Activities', 'other' => 'Other');
		foreach ($venues as $v_name => $v_display) {
			echo "<option value='" . $v_name . "' ";
            echo ">" . $v_display . "</option>";
		}
		echo '</select></td>
				<td align="right">0</td>
		     </tr>
	    </table>';	
	    echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to save these changes.<br /><br />');
        
	    ?>
    </form>
    </div>
    <?PHP include('footer.inc'); ?>
  </div>
</body>
</html>


