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
			report_volunteer_history($from, $to, $venue);
		}
		else echo "please select a report type";
	}

}

function report_volunteer_hours_by_day($from, $to, $venue) { 
	echo ("<br><b>Total Volunteer Hours Report</b>");
	// 1.  define a function get_volunteer_hours() in dbShifts to get all shifts staffed for the given date range and venue.	
	// 2.  call that function -- it should return an array of day:shift pairs containing total number of hours in each entry
	// 3.  Sum the resulting hours for each day and time (count 4 hours per daytime shift per volunteer, 8 hours for overnight)
	// 4.  display a table of the results, computing and showing row and column totals totals as shown below
	
	$report = get_volunteer_hours($from, $to, $venue);
//	echo ".....";
//	echo $report[4]; echo ".....";
//	echo $report[5]; echo ".....";
//	echo $report[6]; echo ".....";
//	echo $report[7]; echo "  ";
	
//	$entry = "Mon:9-1:house:8";
//	$entry = explode(":",$entry);
//	$num = (int)$entry[3];
//	echo $num;
//	echo gettype($report[4]);
	$row_labels = array("9-1","1-5","5-9","night","Total");
	$col_labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","Total");
	display_table($col_labels, $row_labels, $report);
	
}

function report_shifts_staffed_vacant_by_day($from, $to, $venue) {
	echo ("<br><b>Shifts/Vacancies Report</b>");
	// 1.  define a function get_shifts_staffed() in dbShifts to get all shifts staffed for the given date range and venue.	
	// 2.  call that function -- it should return an array of day:shift pairs containing a count of the 
	//     number of shifts with/without vacancies in each entry.  For example, "3/1" means 3 shifts without a vacancy and 1 with a vacancy
	// 3.  display a table of the results, with row and column headings and totals shown below
	$report = get_shifts_staffed($from, $to, $venue);
	$row_labels = array("9-1","1-5","5-9","night","Total");
	$col_labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","Total");
	display_vacancies_table($col_labels, $row_labels, $report);
}

function report_volunteer_birthdays($from, $to, $venue) {
	echo ("<br><b>Volunteer Birthdays Report</b>");
	// 1.  define a function get_birthdays() in dbPersons to get all volunteer birthdays in the given date range and venue.	
	// 2.  call that function -- it should return an array of last_name:first_name:birth_date triples, sorted alphabetically
	// 3.  display a table of the results, showing each volunteer's last name, first name, birth date, and current age
}

function report_volunteer_history($from, $to, $venue) {
	echo ("<br><b>Volunteer History Report</b>");
	// 1.  define a function get_logged_hours() in dbPersons to get all volunteer hours logged for the given dates and venue.	
	// 2.  call that function -- it should return an array of last_name:first_name:date:hours quads, sorted alphabetically
	// 3.  display a table of the results, adding a separate "total hours" line for each volunteer
}



function display_table($col_lab, $row_lab, $report){
	$res = "
		<table id = 'report'> 
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
						$elements = explode(":",$entry); //turn each entry into an arry, hrs is final item in array
						if ($col_name==$elements[0]){
							$num = (int)$elements[3];
							$count = $count + $num;
							$row_total = $row_total + $count;
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
						$elements = explode(":",$entry); //turn each entry into an arry, hrs is final item in array
						if ($col_name==$elements[0] && $row_name==$elements[1]){
							$num = (int)$elements[3];
							$count = $count + $num;
							$row_total = $row_total + $count;
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
		<table id = 'report'> 
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

?>