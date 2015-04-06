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
	    $person = retrieve_person($_GET['id']);
		$venues = array('house' => 'House', 'fam' => 'Family Room', 'mealprep' => 'Meal Prep', 'activities' => 'Activities', 'other' => 'Other');
		if ($_POST['Submit']) {
			$hours = gather_hours($_POST['dates'], $_POST['start_times'], $_POST['end_times'], $_POST['venues'], $_POST['hours_worked']);
			update_hours($person->get_id(), $hours);
	    	echo "Volunteer Log Updated; please remember to log out if finished.<p>";
	    }
	    else {
	    	$hours = $person->get_hours();
			echo '<p> <b>Volunteer Log Sheet </b> for '.$person->get_first_name()." ".$person->get_last_name();
			echo "<br> Today is ".date('l F j, Y')."</p>"; 
			echo '<p><table name="log_entries"><tr><td>Date</td><td>Start time</td><td>End time</td><td>Hours worked</td><td>Venue</td><td>Total to date</td></tr>';
		    $person = retrieve_person($_GET['id']);
		    $hours = $person->get_hours();
			$total = 0;
			foreach ($hours as $log_entry) {
			   $log_details = explode(":",$log_entry);	
			   echo '<tr>
		    	    <td><input type="text" name="date[]" class="date" value='.$log_details[0].'></td>
					<td><input type="text" name="start_time[]" class="start_time" value='.substr($log_details[1],0,4).' size=10></td>
					<td><input type="text" name="end_time[]" class="end_time" value='.substr($log_details[1],4,4).' size=10></td>
					<td><input type="text" name="hours_worked[]" class="hours_worked" value='.$log_details[3].' size=10></td>
					<td><select name="venue[]" class="venue">';
			   		foreach ($venues as $v_name => $v_display) {
						echo "<option value='" . $v_name . "' ";
						if ($log_details[2]==$v_name) echo "SELECTED ";
	            		echo ">" . $v_display . "</option>";
					}
					$total += $log_details[3];
					echo '</select></td>
			   		<td align="right">'.$total.'</td>';
			   echo "</tr>";
			}
			// now throw a blank row so that volunteer can make a new entry
		    echo '<tr>
		    	    <td><input type="text" name="date[]" id="date[]"></td>
					<td><input type="text" name="start_time[]" id="start_time[]" size=10></td>
					<td><input type="text" name="end_time[]" id="end_time[]" size=10></td>
					<td><input type="text" name="hours_worked[]" id="hours_worked[]" size=10></td>
					<td><select name="venue">';
					foreach ($venues as $v_name => $v_display) {
						echo "<option value='" . $v_name . "' ";
	            		echo ">" . $v_display . "</option>";
					}
					echo '</select></td>
					<td align="right"></td>
			     </tr>
		    </table>';	
		    echo('Hit <input type="submit" value="Submit" name="Submit"> to save these changes.<br /><br />');
	    }
	    
	    function gather_hours($dates, $start_times, $end_times, $venues, $hours_worked) {
			$hours = "";
			echo "posted values = "; 
			var_dump($dates, $start_times, $end_times, $venues, $hours_worked);
			for ($i=0;$i<count($dates);$i++) 
	    		if ($dates[$i]!="" && $start_times[$i]!="" && $end_times[$i]!="" && $venues[$i]!="" && $hours_worked[$i]!="") {
	    			$hours .= ",".$dates[$i].";".$start_times[$i]."-".$end_times[$i].":".$uvenues[$i].":".$hours_worked[$i];
	    		}
			return substr($hours,1);
		}
	    
	    ?>
    </form>
    </div>
    <?PHP include('footer.inc'); ?>
  </div>
</body>
</html>


