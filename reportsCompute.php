<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
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
	$row_labels = array("9-1","1-5","5-9","night","Total");
	$col_labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","Total");
}

function report_shifts_staffed_vacant_by_day($from, $to, $venue) {
	echo ("<br><b>Shifts/Vacancies Report</b>");
	// 1.  define a function get_shifts_staffed() in dbShifts to get all shifts staffed for the given date range and venue.	
	// 2.  call that function -- it should return an array of day:shift pairs containing a count of the 
	//     number of shifts with/without vacancies in each entry.  For example, "3/1" means 3 shifts without a vacancy and 1 with a vacancy
	// 3.  display a table of the results, with row and column headings and totals shown below
	$row_labels = array("9-1","1-5","5-9","night","Total");
	$col_labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun","Total");
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

?>