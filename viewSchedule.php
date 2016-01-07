<?php
/*
 * Copyright 2013 by ... and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/*
 * Created on January 3, 2015
 * @author Allen Tucker
 */

session_start();
session_cache_expire(30);
include_once("database/dbMasterSchedule.php");
include_once("domain/MasterScheduleEntry.php");

?>
<!--  page generated by the BowdoinRMH software package -->
<html>
    <head>
        <title>Master Schedule</title>
        <!--  Choose a style sheet -->
        <link rel="stylesheet" href="styles.css" type="text/css"/>
        <link rel="stylesheet" href="calendar.css" type="text/css"/>
        <!-- 	<link rel="stylesheet" href="calendar_newGUI.css" type="text/css"/> -->
    </head>
    <!--  Body portion starts here -->
    <body>
        <div id="container">
            <?php include_once("header.php"); ?>
            <div id="content">
                <?php
                if ($_SESSION['access_level'] < 2) {
                    die("<p>Only managers can view the master schedule.</p>");
                }
                $venue = $_GET['venue'];
                show_week_no ();
                show_master_schedule($venue);
                echo "<br>";
                ?>
            </div>
            <?PHP include('footer.inc'); ?>
        </div>
    </body>
</html>



<?php
/*
 * displays the master schedule for a given group (odd or even week of the year or week of month)
 * and series of days (Mon-Sun)
 */

function show_master_schedule($venue) {
	$groups = array("1st", "2nd", "3rd", "4th", "5th");
	$altgroups = array("odd", "even");
    $shifts = array("9-1","1-5","5-9","night");
	$venues = array("house"=>"House","fam"=>"Family Room");
    $days = array("Mon" => "Monday", "Tue" => "Tuesday", "Wed" => "Wednesday",
                    "Thu" => "Thursday", "Fri" => "Friday", "Sat" => "Saturday", "Sun" => "Sunday");
    echo ('<br><table id="calendar" align="center" ><tr class="weekname"><td colspan="' . (sizeof($days) + 2) . '" ' .
        'bgcolor="ffdddd" align="center" >' .$venues[$venue]." Master Schedule -- use for scheduling 'every week' or 'every other week'");
    echo ('</td></tr><tr><td bgcolor="#ffdddd">  </td>');
    foreach ($days as $day => $dayname)
        echo ('<td class="dow" align="center"> ' . $dayname . ' </td>');
    echo('<td bgcolor="#ffdddd"></td></tr>');
    $columns = sizeof($days);
    foreach ($altgroups as $group){
      $showgroup = $group;
      foreach ($shifts as $hour) {
        echo ("<tr><td class=\"masterhour\">   " . $showgroup . " " . $hour . "</td>");
        foreach ($days as $day => $dayname) {
        	$master_shift = retrieve_dbMasterSchedule($group .":". $day .":". $hour .":". $venue);
            if ($master_shift) {
            	echo do_shift($master_shift,1);
            } else {
                $master_shift = new MasterScheduleEntry($venue, $day, $group, $hour, 0, "", "");
                echo do_shift($master_shift, 0);
            }
        }
        echo ("<td class=\"masterhour\">" . $showgroup . " " . $hour . "</td></tr>");
        $showgroup = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      }
    }
    echo "</table>";
    
    echo ('<br><table id="calendar" align="center" ><tr class="weekname"><td colspan="' . (sizeof($days) + 2) . '" ' .
    'bgcolor="ffdddd" align="center" >' .$venues[$venue]." Master Schedule -- use only for scheduling selected weeks of the month");
    echo ('</td></tr><tr><td bgcolor="#ffdddd">  </td>');
    foreach ($days as $day => $dayname)
        echo ('<td class="dow" align="center"> ' . $dayname . ' </td>');
    echo('<td bgcolor="#ffdddd"></td></tr>');
    $columns = sizeof($days);
    foreach ($groups as $group){
      $showgroup = $group;
      foreach ($shifts as $hour) {
      	echo ("<tr><td class=\"masterhour\">   " . $showgroup . " " . $hour . "</td>");
        foreach ($days as $day => $dayname) {
        	$master_shift = retrieve_dbMasterSchedule($group .":". $day .":". $hour .":". $venue);
        	if ($master_shift) {
            	echo do_shift($master_shift,1);
            } else {
                $master_shift = new MasterScheduleEntry($venue, $day, $group, $hour, 0, "", "");
                echo do_shift($master_shift, 0);
            }
        }
        echo ("<td class=\"masterhour\">" . $showgroup . " " . $hour . "</td></tr>");
        $showgroup = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      }
    }
    echo "</table>";
}

function do_shift($master_shift, $master_shift_length) {
    /* $master_shift is a MasterScheduleEntry object
     */
    if ($master_shift_length == 0) { // no shift at all
        $s = "<td bgcolor=\"lightgray\" rowspan='" . $master_shift_length . "'>" .
                "<a id=\"shiftlink\" href=\"editMasterSchedule.php?group=" .
                $master_shift->get_week_no() . "&day=" . $master_shift->get_day() . "&shift=" .
                $master_shift->get_hours() . "&venue=" . $master_shift->get_venue() . "\">" .
                "<br>" .
                "</td>";
    } else if ($master_shift->get_slots() == 0) {  // shift with no slots
    	$s = "<td rowspan='" . $master_shift_length . "'>" .
                "<a id=\"shiftlink\" href=\"editMasterSchedule.php?group=" .
                $master_shift->get_week_no() . "&day=" . $master_shift->get_day() . "&shift=" .
                $master_shift->get_hours() . "&venue=" . $master_shift->get_venue() . "\">" .
                "<br>" .
                "</td>";
    } else {									// shift with slots (and people)
        $s = "<td rowspan='" . $master_shift_length . "'>" .
                "<a id=\"shiftlink\" href=\"editMasterSchedule.php?group=" .
                $master_shift->get_week_no() . "&day=" . $master_shift->get_day() . "&shift=" .
                $master_shift->get_hours() . "&venue=" . $master_shift->get_venue() . "\">" .
                get_people_for_shift($master_shift, $master_shift_length) .
                "</td>";
    }
    return $s;
}

function get_people_for_shift($master_shift, $master_shift_length) {
    /* $master_shift is a MasterScheduleEntry object
     * an associative array of (venue, my_group, day, time, 
     * start, end, slots, persons, notes) */
    $people = get_persons($master_shift->get_id());
    $slots = get_total_slots($master_shift->get_id());
    if (!$people[0])
        array_shift($people);
    $p = "<br>";
    for ($i = 0; $i < count($people); ++$i) {
        if (is_array($people[$i]))
            $p = $p . "&nbsp;" . $people[$i]['first_name'] . " " . $people[$i]['last_name'] . "<br>";
        else
            $p = $p . "&nbsp;" . $people[$i] . "<br>";
    }
    if ($slots - count($people) > 0)
        $p = $p . "&nbsp;<b>Vacancies (" . ($slots - count($people)) . ")</b><br>";
    else if (count($people) == 0)
        $p = $p . "&nbsp;<br>";
    return substr($p, 0, strlen($p) - 4);
}

function show_week_no () {
                	$woms = array(1=>"1st",2=>"2nd",3=>"3rd",4=>"4th",5=>"5th");
	                $today = mktime();
	                $dom = date("d");
	                $wom = floor(($dom-1)/7) + 1;
	               	$weekno = date("W");
	               	if (date("Y")%2==0)
	               		$weekno--;
	               	if ($weekno%2==0)
	               	    $oddeven = "even";
	               	else 
	               		$oddeven = "odd";
	               	echo "<p>Today is " . date('l F j, Y') . ". ";
	                echo "   This is week ". $weekno . " (".$oddeven.") of the year, and the ";            
	                echo $woms[$wom] . " ". date ("l", $today) . " of the month<p>";
}
?>