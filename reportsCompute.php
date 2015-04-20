<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
include_once('database/dbPersons.php');
include_once('domain/Person.php');
include_once('database/dbShifts.php');
include_once('domain/Shift.php');

if (isset($_POST['_form_submit']) && $_POST['_form_submit'] == 'report') {
	show_report();
}

function show_report() {

	$from = $_POST["from"];
	$to   = $_POST["to"];
	$venue   = $_POST["venue"];

	if (isset($_POST['report-types'])) {
		if (in_array('volunteer-hours', $_POST['report-types'])) {
			report_volunteer_hours_by_day($from, $to, $venue);
		}
	    else if (in_array('shifts-staffed-vacant', $_POST['report-types'])) {
			report_shifts_staffed_vacant_by_day($from, $to, $venue);
		}
	    else if (in_array('birthdays', $_POST['report-types'])) {
			report_volunteer_birthdays($from, $to, $venue);
		}
	    else if (in_array('history', $_POST['report-types'])) {
			report_volunteer_history();
		}
		else echo "please select a report type";
	}

}

function report_volunteer_hours_by_day($from, $to, $venue) { 
	if($venue == "house"){
		$the_venue = "the House";
	}elseif($venue == "fam"){
		$the_venue = "the Family Room";
	}else{
		$the_venue = "both the House and the Family Room";
	}
	if($from == ""){$from ="00-00-00";}
	if($to == ""){$to = date("m-d-y");}
		
	echo ("<br><b>Total Volunteer Hours Report from " .$from. " to ".$to." in ".$the_venue.".</b>");
	// 1.  define a function get_volunteer_hours() in dbShifts to get all shifts staffed for the given date range and venue.	
	// 2.  call that function -- it should return an array of day:shift pairs containing total number of hours in each entry
	// 3.  Sum the resulting hours for each day and time (count 4 hours per daytime shift per volunteer, 8 hours for overnight)
	// 4.  display a table of the results, computing and showing row and column totals totals as shown below
	
	$report = get_volunteer_hours($from, $to, $venue);
	$row_labels = array("9-1","1-5","5-9","night","Total");
	$col_labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","Total");
	display_totals_table($col_labels, $row_labels, $report);	
}

function report_shifts_staffed_vacant_by_day($from, $to, $venue) {
	if($venue == "house"){
		$the_venue = "the House";
	}elseif($venue == "fam"){
		$the_venue = "the Family Room";
	}else{
		$the_venue = "both the House and the Family Room";
	}
	if($from == ""){$from ="00-00-00";}
	if($to == ""){$to = date("m-d-y");}
		
	echo ("<br><b>Shifts/Vacancies Report from " .$from. " to ".$to." in ".$the_venue.".</b>");

	// 1.  define a function get_shifts_staffed() in dbShifts to get all shifts staffed for the given date range and venue.	
	// 2.  call that function -- it should return an array of day:shift pairs containing a count of the 
	//     number of shifts with/without vacancies in each entry.  For example, "3/1" means 3 shifts without a vacancy and 1 with a vacancy
	// 3.  display a table of the results, with row and column headings and totals shown below
	$report = get_shifts_staffed($from, $to, $venue);
	$row_labels = array("9-1","1-5","5-9","night","Total");
	$col_labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","Total");
	display_vacancies_table($col_labels, $row_labels, $report);
}

function report_volunteer_birthdays($from,$to,$venue) {
	echo ("<br><b>Volunteer Birthdays Report</b>");
	// 1.  define a function get_birthdays() in dbPersons to get all volunteer birthdays in the given date range and venue.	
	// 2.  call that function -- it should return an array of last_name:first_name:birth_date triples, sorted alphabetically
	// 3.  display a table of the results, showing each volunteer's last name, first name, birth date, and current age
	$report = get_birthdays($venue);
	//display_birthdays($col_labels,$report);
	display_birthdays($report);
}

function report_volunteer_history() {
	echo ("<br><b>Volunteer History Report</b>");
	// 1.  define a function get_logged_hours() in dbPersons to get all volunteer hours logged for the given dates and venue.	
	// 2.  call that function -- it should return an array of last_name:first_name:date:hours quads, sorted alphabetically
	// 3.  display a table of the results, adding a separate "total hours" line for each volunteer
$report = get_logged_hours();
display_logged_hours($report);
}
	

function display_birthdays($report) { //Create a table to display birthdays
	$col_labels = array("Volunteer Name ","Birth Date ","Age ");
	$res = "
		<table id = 'report'> 
			<thead>
			<tr>";
	$row = "<tr>";
	
	foreach($col_labels as $col_name){
		$row .= "<td><b>".$col_name."</b></td>";
	}
	$row .="</tr>";
	$res .= $row;
	$res .= "
			</thead>
			<tbody>";
	
	$full_names = array();
	$dobs = array();
	$ages = array();
	
	foreach($report as $key){
		$entry = explode(":",$key);
		$last_name = $entry[1];
		$first_name = $entry[0];	
		//check if the person's date of birth is known 
		if (substr($key, -1) != ":" && substr($key, -2) != "XX" ){
			$birth_date = substr($key, -8);
			$dob = pretty_date($birth_date);
			$age = calculate_age($birth_date);
			$full_name = $first_name . " " . $last_name; 
			array_push($full_names, $full_name);
			array_push($dobs, $dob);
			array_push($ages, $age);
		}
	}
	//below "var_dump"s is just for testing
	//var_dump($full_names);
	//var_dump($birth_dates);
	//var_dump($ages);
	
	foreach($full_names as $index=>$row_lab){
		$row = "<tr>";
		$row .= "<td>".$full_names[$index]."</td><td>". $dobs[$index] ."</td><td align=right>".$ages[$index]."</td>";
		$row .= "</tr>";
		$res .= $row;
	}
	$res .= "</tbody></table>";
	echo $res;
}

function pretty_date($date){
	//eg. date is 03-30-78, this function can convert it into "March 30, 1978"
  	//explode the date to get month, day and year
	$dob=explode("-",$date); 
	//if the year is less than 30, we can assume the person was born after 2000; if the year is greater than 30, we can 
	//assume the person was born before 2000. 
	if ( ((int) $dob[2] ) <= 30){
		$dob[2] = "20".$dob[2];  	
	} else{
		$dob[2] = "19".$dob[2];
	}	
	$dateObj   = DateTime::createFromFormat('!m', $dob[0]);
	$dob[0] = $dateObj->format('F'); 
	return $dob[0]." ".$dob[1].", ".$dob[2];
}



function display_totals_table($col_lab, $row_lab, $report){  //Creates a table for the Total Hours report
	$res = "
		<table id = 'areport'> 
			<thead>
			<tr>
				<td></td>";
	$row = "<tr>
				<td><b>Shift</b></td>";
	foreach($col_lab as $col_name){
		$row .= "<td><b>".$col_name."</b></td>";
	}
	$row .="</tr>";
	$res .= $row;
	$res .= "
			</thead>
			<tbody>";
	foreach($row_lab as $row_name){
		$row_total = 0;
		$row = "<tr>";
		$row .= "<td><b>".$row_name."</b></td>";
		if($row_name == "Total"){
			$grand_total = 0;
			foreach($col_lab as $col_name){
				$count = 0;
				if($col_name =="Total"){
					$row .= "<td>".$grand_total."</td>";
				}else {
					foreach($report as $entry){
						$elements = explode(":",$entry); 
						if ($col_name==$elements[0]){
							$num = (int)$elements[3];
							$count = $count + $num;
							$row_total = $row_total + $num;
						}
					}
					$row .= "<td>".$count."</td>";
					$grand_total += $count;
				}
			}
		}else{
			foreach($col_lab as $col_name){
				$count = 0;
				if($col_name =="Total"){
					$row .= "<td>".$row_total."</td>";
				}else {
					foreach($report as $entry){
						$elements = explode(":",$entry); 
						if ($col_name==$elements[0] && $row_name==$elements[1]){
							$num = (int)$elements[3];
							$count += $num;
							$row_total += $num;
						}
					}
					$row .= "<td>".$count."</td>";
				}
			}
		}
		$row .= "</tr>";
		$res .= $row;
	}
	$res .= "</tbody></table>";
	echo $res;

}



function display_vacancies_table($col_lab, $row_lab, $report){
	$res = "
		<table id = 'areport'> 
			<thead>
			<tr>
				<td></td>";
	//row 1
	$row = "<tr>
				<td></td>";
	foreach($col_lab as $col_name){
		$row .= "<td><b>".$col_name."</b></td>";
	}
	$row .="</tr>";
	$res .= $row;
	$res .= "
			</thead>
			<tbody>";
	foreach($row_lab as $row_name){
		$row_total_vacs = 0;
		$row_total_slots = 0;
		$row = "<tr>";
		$row .= "<td><b>".$row_name."</b></td>";
		if($row_name == "Total"){
			$grand_total_vacs = 0;
			$grand_total_slots = 0;
			foreach($col_lab as $col_name){
				$col_total_slots = 0;
				$col_total_vacs = 0;
				if($col_name =="Total"){
					$row .= "<td>".$grand_total_slots."/".$grand_total_vacs."</td>";
				}else{
					foreach($report as $entry){
						$elements = explode(":",$entry); //turn each entry into an arry, hrs is final item in array
						if ($col_name==$elements[0]){
							$slots = $elements[4];
							$vacs = $elements[3];
							$slotsint = (int)$slots;
							$vacsint = (int)$vacs;
							$col_total_slots += $slotsint;
							$col_total_vacs += $vacsint;
						}
					}
					$row .= "<td>".$col_total_slots."/".$col_total_vacs."</td>";
					$grand_total_slots += $col_total_slots;
					$grand_total_vacs += $col_total_vacs;
				}
			}
		}else{
			foreach($col_lab as $col_name){
				$slots_count = 0;
				$vacs_count = 0;
				if($col_name =="Total"){
					$row .= "<td>".$row_total_slots."/".$row_total_vacs."</td>";
				}else {
					foreach($report as $entry){
						$elements = explode(":",$entry); //turn each entry into an arry, hrs is final item in array
						if ($col_name==$elements[0] && $row_name==$elements[1]){
							$slots = $elements[4];
							$vacs = $elements[3];
							$slots_count += $slots;
							$vacs_count += $vacs;
							$slotsint = (int)$slots;
							$vacsint = (int)$vacs;
							$row_total_slots += $slotsint;
							$row_total_vacs += $vacsint;
						}
					}
					$row .= "<td>".$slots_count."/".$vacs_count."</td>";
				}
			}
		}
		$row .= "</tr>";
		$res .= $row;
	}
	$res .= "</tbody></table>";
	echo $res;

}

function calculate_age($date){
  	//eg. date is 03-30-78
  	//explode the date to get month, day and year
	$dob=explode("-",$date); 
	
	//if the year is less than 30, we can assume the person was born after 2000; if the year is greater than 30, we can 
	//assume the person was born before 2000. 
	if ( ((int) $dob[2] ) <= 30){
		$dob[2] = "20".$dob[2];  	
	} else{
		$dob[2] = "19".$dob[2];
	}	
	$curMonth = date("m");
	$curDay = date("j");
	$curYear = date("Y");
	$age = $curYear - $dob[2]; 
	if($curMonth<$dob[0] || ($curMonth==$dob[1] && $curDay<$dob[1])){ 
		$age--; 
	}
    return $age; 
}
// 24-hour time to 12-hour time 
//eg. time is 0900, this function can convert it into "1:00 pm"
function civil_time($army_time){
		$time_in_12_hour_format = date("g:i a", strtotime($army_time)); 
	return $time_in_12_hour_format;
}

// Improve venue display by using associative array, i.e, turning fam --> "Family Room" 
function pretty_venue($v){
	$venue = array("house"=>"House", "fam"=>"Family Room"); 
	return $venue["$v"];
}



//Create a table to display volunteer history report
function display_logged_hours ($report) { 
	$col_labels = array("Name","Date","Start time","End time","Venue","Hours Count");
	$res = "
		<table id = 'report'> 
			<thead>
			<tr>";
	$row = "<tr>";
	
	foreach($col_labels as $col_name){
		$row .= "<td><b>".$col_name."</b></td>";
	}
	$row .="</tr>";
	$res .= $row;
	$res .= "
			</thead>
			<tbody>";
	
	$full_name = array();
	$first_name = array();
	$dates = array();
	$shifts_worked = array();
	$hours_count = array();

	
	foreach($report as $key){
		$entry = explode(";",$key);
		$last_name = $entry[0];
		$first_name = $entry[1];
		$dates = explode(",",$entry[2]);
		$res .= "<tr><td>".$last_name . ", ". $first_name."</td>";
		$total_hours=0;
		foreach ($dates as $date) {
			$d = explode(":",$date);
			$total_hours += $d[3];
			$times = explode(",",$d[1]);
			foreach ($times as $time) {
			$t = explode("-",$time);
			$start_time = civil_time($t[0]);
			$end_time = civil_time($t[1]);
			$res .= "<td>".pretty_date($d[0])."</td><td>".$start_time."</td><td>".$end_time."</td><td>".pretty_venue($d[2])."</td><td>".$d[3]."</td></tr><tr><td></td>";
			}
		}
		$res .= "<td></td><td></td><td></td><td><b>Total hours</b></td><td>".$total_hours."</td></tr>";
	}
	
	$res .= "</tbody></table>";
	echo $res;
}


?>