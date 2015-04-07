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
<title>
	<?PHP echo('Volunteer Hours Log');?>
</title>
<link rel="stylesheet" href="lib/jquery-ui.css" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<link rel="stylesheet" href="lib/jquery.timepicker.css" />
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
<script src="lib/jquery.timepicker.js"></script>
<script>
$(function() {
	$( "#from" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true});
	$( "#start-time" ).timepicker();
	$( "#end-time" ).timepicker();
});
</script>
</head>
<body>
<div id="container">
    <?PHP include('header.php'); ?>
    <div id="content">
    <form method="POST">
	<?php 
	    $person = retrieve_person($_GET['id']);
		$venues = array('house' => 'House', 'fam' => 'Family Room', 'mealprep' => 'Meal Prep', 'activities' => 'Activities', 'other' => 'Other');
		if ($_POST['Submit']) {
			$hours = gather_hours($_POST['date'], $_POST['start-time'], $_POST['end-time'], $_POST['venue'], $_POST['hours-worked']);
			update_hours($person->get_id(), $hours);
	    	echo "Volunteer Log Updated; please remember to log out if finished.<p>";
	    }
	    else {
	        $person = retrieve_person($_GET['id']);
	    	$hours = $person->get_hours();
			echo '<p> <b>Volunteer Log Sheet </b> for '.$person->get_first_name()." ".$person->get_last_name();
			echo "<br> Today is ".date('l F j, Y')."</p>"; 
			echo '<p><table name="log_entries"><tr><td width="170px">Date</td><td width="100px">Start time</td><td width="100px">End time</td><td width="100px">Hours worked</td>
			      <td width="100px">Venue</td><td>Total</td></tr>';
		    echo '</table></p>';
		    $person = retrieve_person($_GET['id']);
		    $hours = $person->get_hours();
			$total = 0;
			foreach ($hours as $log_entry) {
			   $log_details = explode(":",$log_entry);	
			   echo '<p class=ui-widget id=log-rows>
		    	    <input type="text" name="date[]" class="date" value='.$log_details[0].'>
					<input type="text" name="start-time[]" class="start-time"  value='.substr($log_details[1],0,4).' size=10>
					<input type="text" name="end-time[]" class="end-time" value='.substr($log_details[1],5,4).' size=10>
					<input type="text" name="hours-worked[]" class="hours-worked" value='.$log_details[3].' size=10 align=right>
					<select name="venue[]" class="venue">';
			   		foreach ($venues as $v_name => $v_display) {
						echo "<option value='" . $v_name . "' ";
						if ($log_details[2]==$v_name) echo "SELECTED ";
	            		echo ">" . $v_display . "</option>";
					}
					$total += $log_details[3];
					echo '</select>';
			   		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$total;
			   echo "</p>";
			}
			// now throw a blank row so that volunteer can make a new entry
		    echo '<p class=ui-widget id=log-rows>
		    	    <input type="text" name="date[]" class="date" tabindex=1 >
					<input type="text" name="start-time[]" class="start-time" tabindex=2 size=10>
					<input type="text" name="end-time[]" class="end-time" tabindex=3 size=10>
					<input type="text" name="hours-worked[]" class="hours-worked" tabindex=4 size=10>
					<select name="venue[]" class="venue" tabindex=5>';
					foreach ($venues as $v_name => $v_display) {
						echo "<option value='" . $v_name . "' ";
	            		if ("house"==$v_name) echo "SELECTED ";
	            		echo ">" . $v_display . "</option>";
					}
					echo '</select>';
			echo "</p>";
	
		    echo('<p>Hit <input type="submit" value="Submit" name="Submit" tabindex=5> to save these changes.<br /><br />');
	    }
	    // rebuilds the hours array from the form, taking in edits to previous entries and a new entry 
	    function gather_hours($dates, $start_times, $end_times, $venues, $hours_worked) {
			$hours = "";
			for ($i=0;$i<count($dates);$i++) 
	    		if (valid_entry($dates[$i],$start_times[$i],$end_times[$i],$venues[$i],$hours_worked[$i])) {
	    			$hours .= ",".$dates[$i].":".$start_times[$i]."-".$end_times[$i].":".$venues[$i].":".$hours_worked[$i];
	    		}
			return substr($hours,1);
		}
		// minimal validation function -- assumes 30-minute intervals
		function valid_entry($date,$start,$end,$venue,&$hours) {
			if ($date=="") return false;
			if ($start=="" || $end=="") return false;
			if ($venue=="") return false;
			if ($hours=='') {
				$hours = (int)(($end-$start)/100);
				if (($end-$start)%100!=0) $hours += 0.5;
			}
			if ($hours > 0) return true;
			return false;
		}
	    
	    ?>
    </form>
    </div>
    <?PHP include('footer.inc'); ?>
</div>
</body>
</html>


