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
	$( "#start_time" ).timepicker({'minTime': '9:00am', 'maxTime': '9:00pm'});
	$( "#end_time" ).timepicker({'minTime': '9:00am', 'maxTime': '9:00pm'});
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
			$hours = gather_hours($_POST['from'], $_POST['start_time'], $_POST['end_time'], $_POST['venue'], $_POST['hours_worked']);
			update_hours($person->get_id(), $hours);
	    	echo "Volunteer Log Updated; please remember to log out if finished.<p>";
	    }
	//    else {
	        $person = retrieve_person($_GET['id']);
	    	$hours = $person->get_hours();
			echo '<p> <b>Volunteer Log Sheet </b> for '.$person->get_first_name()." ".$person->get_last_name();
			echo "<br> Today is ".date('l F j, Y')."</p>"; 
			echo '<p><table name="log_entries"><tr><td width="180px">Date</td><td width="102px">Start time</td><td width="102px">End time</td><td width="102px">Hours worked</td>
			      <td width="140px">Venue</td><td>Total</td></tr>';
		    echo '</table></p>';
		    $person = retrieve_person($_GET['id']);
		    $hours = $person->get_hours();
			$total = 0;
			foreach ($hours as $log_entry) {
			   $log_details = explode(":",$log_entry);	
			   echo '<p class=ui-widget id=log-rows>
		    	    <input type="text" name="from[]" class="date" value='.$log_details[0].'>
					<input type="text" name="start_time[]" class="start_time" size=10 value='.substr($log_details[1],0,4).'>
					<input type="text" name="end_time[]" class="end_time" size=10 value='.substr($log_details[1],5,4).'>
					<input type="text" name="hours_worked[]" class="hours_worked" size=10 align=right value='.$log_details[3].'>
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
		    	    <input type="text" id="from" name="from[]" class="date" tabindex=1 >
					<input type="text" id="start_time" name="start_time[]" class="start_time" tabindex=2 size=10>
					<input type="text" id="end_time" name="end_time[]" class="end_time" tabindex=3 size=10>
					<input type="text" id="hours_worked" name="hours_worked[]" class="hours_worked" tabindex=4 size=10>
					<select name="venue[]" class="venue" tabindex=5>';
					foreach ($venues as $v_name => $v_display) {
						echo "<option value='" . $v_name . "' ";
	            		if ("house"==$v_name) echo "SELECTED ";
	            		echo ">" . $v_display . "</option>";
					}
					echo '</select>';
			echo "</p>";
	
		    echo('<p>Hit <input type="submit" value="Submit" name="Submit" tabindex=5> to save these changes.<br /><br />');
	 //   }
	    // rebuilds the hours array from the form, taking in edits to previous entries and a new entry 
	    function gather_hours($dates, $start_times, $end_times, $venues, $hours_worked) {
			for ($i=0;$i<count($dates);$i++) {
				$start_times[$i] = fix_time($start_times[$i]);
	    		$end_times[$i] = fix_time($end_times[$i]);
	    		if (valid_entry($dates[$i],$start_times[$i],$end_times[$i],$venues[$i],$hours_worked[$i])) 
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
		// convert time to 4-digit value -- "9:00am" to "0900" 
		function fix_time($time) { 	
			$parts = explode(":",$time);
			if (count($parts) < 2)
			    return $time;			// no need to convert
			if (strpos($parts[1],"am")>0) {
				if (strlen($parts[0])==1)
					$parts[0] = "0".$parts[0];
			}
			else if ($parts[0]<12)
			    $parts[0] = intval($parts[0]) + 12;
			return $parts[0].substr($parts[1],0,2);
		}
	    ?>
    </form>
    </div>
    <?PHP include('footer.inc'); ?>
</div>
</body>
</html>


