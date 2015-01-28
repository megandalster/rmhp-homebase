<?php
/*
 * Copyright 2013 by ... and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            Edit Master Schedule Shift
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
    </head>
    <body>
        <div id="container">
            <?PHP include('header.php'); ?>
            <div id="content">
                <?php
                if ($_SESSION['access_level'] < 2) {
                    die("<p>Only managers can edit the master schedule.</p>");
                }
                $group = $_GET['group'];
                // $frequency=$_GET['frequency'];
                $venue = $_GET['venue'];
                $day = $_GET['day'];
                $shiftname = $_GET['shift'];
                $shift = array($group, $day, $shiftname);
                $shift = get_day_names($shift, $day);
                include_once('database/dbMasterSchedule.php');
                include_once('domain/MasterScheduleEntry.php');
                include_once('database/dbLog.php');
                //if($group=="" || $day=="" || $shiftname=="") {
                if ($group == "" || $day == "" || $shift == "") {
                    echo "<p>Invalid schedule parameters.  Please click on the \"Master Schedule\" link above to edit a master schedule shift.</p>";
                } // see if there is no master shift for this time slot and try to set times starting there
                else if (retrieve_dbMasterSchedule($venue . $day . $group . "-" . $shiftname) == false) {
                    $result = process_set_times($_POST, $group, $day, $shiftname, $venue);
                    if ($result) {
                        $returnpoint = "viewSchedule.php?venue=" . $venue;
                        echo "<table align=\"center\"><tr><td align=\"center\" width=\"442\">
								<br><a href=\"" . $returnpoint . "\">
								Back to Master Schedule</a></td></tr></table>";
                    }
                    // if not, there's an opportunity to add a shift 
                    else {
                        //$groupdisplay = $venue . " Group ".$group;
                        echo ("<table align=\"center\" width=\"450\"><tr><td align=\"center\" colspan=\"2\"><b>
								Adding a New Master Schedule shift for " . $group .
                        substr($shift[1], 3) . " " . $shift[3] . "s " . "
								</b></td></tr>"
                        . "<tr><td>
									<form method=\"POST\" style=\"margin-bottom:0;\">
									<select name=\"new_start\">
									<option value=\"0\">Please select a new starting time</option>"
                        . get_all_times() .
                        "</select><br>
									<br><br>
									<select name=\"new_end\">
									<option value=\"0\">and ending time for this shift.</option>"
                        . get_all_times() .
                        "</select><br><br>
									<input type=\"hidden\" name=\"_submit_change_times\" value=\"1\">
									<input type=\"submit\" value=\"Add New Shift\" name=\"submit\">
									</form><br></td></tr></table>");
                    }
                } else { // if one is there, see what we can do to update it
                    if (!process_fill_vacancy($_POST, $shift, $group, $venue) && // try to fill a vacancy
                            !process_add_volunteer($_POST, $shift, $venue) &&
                            !process_remove_shift($_POST, $shift, $group, $day, $shiftname, $venue)) { // try to remove the shift
                        if (process_unfill_shift($_POST, $shift, $venue)) {  // try to remove a person
                        } else if (process_add_slot($_POST, $shift, $venue)) { // try to add a new slot
                        } else if (process_ignore_slot($_POST, $shift, $venue)) {  //try to remove a slot
                        }
                        // we've tried to clear the shift, add a slot, or remove a slot;
                        // so now display the shift again.
                        $persons = get_persons($venue, $shift[0], $shift[1], $shift[2]);
                        // $groupdisplay = $venue . " Group ".$group;
                        echo ("<table align=\"center\" width=\"450\"><tr><td align=\"center\" colspan=\"2\"><b>
								Master schedule shift for " . $group .
                        substr($shift[1], 3) . " " . $shift[3] . "s, " . do_name($shift[2]) . "
								</b>
								<form method=\"POST\" style=\"margin-bottom:0;\">
									<input type=\"hidden\" name=\"_submit_remove_shift\" value=\"1\"><br>
									<input type=\"submit\" value=\"Remove Entire Shift\"
									name=\"submit\">
									</form><br>
								</td></tr>"
                        . "<tr><td valign=\"top\"><br>&nbsp;" . do_slot_num($shift, $venue) . "</td><td>
									<form method=\"POST\" style=\"margin-bottom:0;\">
									<input type=\"hidden\" name=\"_submit_add_slot\" value=\"1\"><br>
									<input type=\"submit\" value=\"Add Slot\"
									name=\"submit\" style=\"width: 250px\">
									</form><br></td></tr>");
                        echo (display_filled_slots($persons)
                        . display_vacant_slots(get_total_vacancies($venue, $shift[0], $shift[1], $shift[2]))
                        . "</table>");
                        $returnpoint = "viewSchedule.php?venue=" . $venue;
                        echo "<table align=\"center\"><tr><td align=\"center\" width=\"442\">
									       <br><a href=\"" . $returnpoint . "\">
										   Back to Master Schedule</a></td></tr></table>";
                    }
                }
                ?>
                <br>
             </div>
          <?PHP include('footer.inc'); ?>
        </div>
    </body>
</html>

                <?php

                function get_all_times() {
                    $s = "";
                    for ($hour = 9; $hour < 22; $hour++) {
                        $clock = $hour < 12 ? $hour . "am" : $hour - 12 . "pm";
                        if ($clock == "0pm")
                            $clock = "12pm";
                        $s = $s . "<option value=\"" . $hour . "\">" . $clock . "</option>";
                    }
                    $s = $s . "<option value=\"" . "night" . "\">" . "night" . "</option>";
                    return $s;
                }

                function process_set_times($post, $group, $day, $time, $venue) {
                    if (!array_key_exists('_submit_change_times', $post))
                        return false;
                    if ($post['new_start'] == "0")
                        $error = "Can't add new shift: you must select a start time.<br><br>";
                    else if ($post['new_start'] != "night" && $post['new_end'] == "0")
                        $error = "Can't add new shift: you must select an end time.<br><br>";
                    else {
                        $entry = new MasterScheduleEntry($venue, $day, $group, $post['new_start']."-". $post['new_end'], 0, "", "");
                        if (!insert_nonoverlapping($entry))
                            $error = "Can't insert a new shift into an overlapping time slot.<br><br>";
                    }
                    if ($error) {
                        echo $error;
                        return true;
                    } else {
                        //$groupdisplay = $venue . " Group ".$group." Time ".$time;
                        echo "Added a new shift for " . $group . " " . $day . "<br><br>";
                        add_log_entry('<a href=\"personEdit.php?id=' . $_SESSION['_id'] . '\">' . $_SESSION['f_name'] . ' ' .
                                $_SESSION['l_name'] . '</a> added a new master schedule shift: <a href=\"editMasterSchedule.php?group=' .
                                $group . "&day=" . $day . "&shift=" . $shiftname . "&venue=" . $venue . '\">' . $group . " " . $day . $shiftname . '</a>.');
                        return true;
                    }
                }

                function process_remove_shift($post, $shift, $week_no, $day, $time, $frequency) {
                    if (!array_key_exists('_submit_remove_shift', $post))
                        return false;
                    $id = $frequency . $day . $week_no . "-" . $time;
                    if (delete_dbMasterSchedule($id)) {
                        echo "<br>Deleted master schedule shift for " . $groupdisplay . "<br><br>";
                        $returnpoint = "viewSchedule.php?frequency=" . $frequency;
                        echo "<table align=\"center\"><tr><td align=\"center\" width=\"442\">
				<br><a href=\"" . $returnpoint . "\">
				Back to Master Schedule</a></td></tr></table>";
                        add_log_entry('<a href=\"personEdit.php?id=' . $_SESSION['_id'] . '\">' . $_SESSION['f_name'] . ' ' .
                                $_SESSION['l_name'] . '</a> deleted a new master schedule shift: <a href=\"editMasterSchedule.php?group=' .
                                $week_no . "&day=" . $day . "&shift=" . $shiftname . "&frequency=" . $frequency . '\">' . $frequency . " week_no " . $week_no . " " . $day . " " . $shiftname . '</a>.');
                        return true;
                    }
                    return false;
                }

                function do_name($id) {
                    if ($id == "night")
                        return "night";
                    else {
                        $start = substr($id, 0, strpos($id, "-"));
                        $end = substr($id, strpos($id, "-") + 1);
                        if ($start < 12)
                            if ($end < 12)
                                return $start . "am to " . $end . "am";
                            else if ($end==12)
                            	return $start . "am to " . $end . "pm";
                            else
                                return $start . "am to " . ($end - 12) . "pm";
                        else if ($start==12)
                        	return $start . "pm to " . ($end - 12) . "pm";
                        else
                            return ($start - 12) . "pm to " . ($end - 12) . "pm";
                    }
                }

                function do_slot_num($shift, $venue) {
                    $slots = get_total_slots($venue, $shift[0], $shift[1], $shift[2]);
                    if ($slots == 1)
                        return "1 slot for this shift:";
                    return $slots . " slots for this shift:";
                }

                function display_filled_slots($persons) {
                    $s = "";
                    if (!$persons[0])
                        array_shift($persons);
                    for ($i = 0; $i < count($persons); ++$i) {
                        $p = $persons[$i];
                        if (is_array($persons[$i]))
                            $p = $persons[$i]['first_name'] . " " . $persons[$i]['last_name'];
                        $s = $s . "<tr><td width=\"150\" valign=\"top\"><br>&nbsp;" . $p . "</td><td>
				<form method=\"POST\" style=\"margin-bottom:0;\">
				<input type=\"hidden\" name=\"_submit_filled_slot_" . $i . "\" value=\"1\"><br>
				<input type=\"submit\" value=\"Remove Person / Create Vacancy\" name=\"submit\" style=\"width: 250px\">
			</form><br></td></tr>";
                    }
                    return $s;
                }

                function display_vacant_slots($vacancies) {
                    $s = "";
                    for ($i = 0; $i < $vacancies; ++$i) {
                        $s = $s . "<tr><td width=\"150\" valign=\"top\"><br>&nbsp;<b>vacant</b></td><td>
				<form method=\"POST\" style=\"margin-bottom:0;\">
				<input type=\"hidden\" name=\"_submit_fill_vacancy\" value=\"1\"><br>
				<input type=\"submit\" value=\"Assign Volunteer\" name=\"submit\" style=\"width: 250px\"></form>
				<form method=\"POST\" style=\"margin-bottom:0;\">
				<input type=\"hidden\" name=\"_submit_ignore_vacancy\" value=\"1\">
				<input type=\"submit\" value=\"Remove Vacant Slot\" name=\"submit\" style=\"width: 250px\"></form>
				<br></td></tr>";
                    }
                    return $s;
                }

                function process_fill_vacancy($post, $shift, $group, $venue) {
                    if (!array_key_exists('_submit_fill_vacancy', $post))
                        return false;
                    $groupdisplay = $venue . " Group " . $group;
                    echo "<table align=\"center\"><tr><td align=\"center\" width=\"450\"><b>
		Filling a vacancy for " . $groupdisplay . substr($shift[1], 3) . "<br>" . $shift[3] . ", " . do_name($shift[2]) . "
		</b></td></tr>
		<tr><td><form method=\"POST\" style=\"margin-bottom:0;\">
			<select name=\"scheduled_vol\">
			<option value=\"0\" style=\"width: 371px;\">Select a volunteer With " . $shift[3] . ", " . do_name($shift[2]) . " availability</option>"
                    . get_available_volunteer_options($shift[2], $shift[4], get_persons($venue, $shift[0], $shift[1], $shift[2]), $venue) .
                    "</select><br><br>
			<select name=\"all_vol\">
			<option value=\"0\" style=\"width: 371px;\">Select from all volunteers in this group</option>"
                    . get_all_volunteer_options(get_persons($venue, $shift[0], $shift[1], $shift[2]), $venue) .
                    "</select><br><br>
			<input type=\"hidden\" name=\"_submit_add_volunteer\" value=\"1\">
			<input type=\"submit\" value=\"Add Volunteer\" name=\"submit\" style=\"width: 400px\">
			</form></td></tr>";
                    echo "</table>";
                    echo "<table align=\"center\"><tr><td align=\"center\" width=\"450\">
		<a href=\"editMasterSchedule.php?group=" . $shift[0] . "&day=" . $shift[1] . "&shift=" . $shift[2] . "&venue=" . $venue . "\">Back to Shift</a><br></td></tr></table>";
                    return true;

                    // check that person is not already working that shift
                    // check that person is available
                }

                function do_fill_vacancy_form($shift, $venue) {
                    
                }

                function process_unfill_shift($post, $shift, $venue) {
                    $persons = get_persons($venue, $shift[0], $shift[1], $shift[2]);
                    if (!$persons[0])
                        array_shift($persons);
                    for ($i = 0; $i < count($persons); ++$i) {
                        if (array_key_exists('_submit_filled_slot_' . $i, $post)) {
                            if (is_array($persons[$i]))
                                unschedule_person($venue, $shift[0], $shift[1], $shift[2], $persons[$i]['id']);
                            else
                                unschedule_person($venue, $shift[0], $shift[1], $shift[2], $persons[$i]);
                            return true;
                        }
                    }
                    return false;
                }

                function process_add_slot($post, $shift, $venue) {
                    if (array_key_exists('_submit_add_slot', $post)) {
                        edit_schedule_vacancy($venue, $shift[0], $shift[1], $shift[2], 1);
                        return true;
                    }
                    return false;
                }

                function process_ignore_slot($post, $shift, $venue) {
                    if (array_key_exists('_submit_ignore_vacancy', $post)) {
                        edit_schedule_vacancy($venue, $shift[0], $shift[1], $shift[2], -1);
                        return true;
                    }
                    return false;
                }

                function get_available_volunteer_options($time, $day, $persons, $week_no) {
                    if (!$persons[0])
                        array_shift($persons);
                    connect();
                    $start_time = substr($time, 0, strpos($time, "-"));
                    if ($start_time > 0) {
                        if ($start_time < 12) // 9-11 = morning start time
                            $chrtime = "morning";
                        else if ($start_time < 14) // 12-1 = early afternoon start time
                            $chrtime = "earlypm";
                        else if ($start_time < 18)  // 2-5 = late afternoon start time
                            $chrtime = "latepm";
                        else
                            $chrtime = "evening"; // 6-9 = evening
                    }
                    else
                        $chrtime = "night";

                    $query = "SELECT * FROM dbPersons WHERE status = 'active' " .
                            "AND availability LIKE '%" . $day . ":" . $chrtime . "%' ORDER BY last_name,first_name";
                    $result = mysql_query($query);
                    mysql_close();
                    $s = "";
                    for ($i = 0; $i < mysql_num_rows($result); ++$i) {
                        $row = mysql_fetch_row($result);
                        $value = $row[0];
                        $label = $row[2] . ", " . $row[1];
                        $match = false;
                        for ($j = 0; $j < count($persons); ++$j) {
                            if ($value == $persons[$j]['id']) {
                                $match = true;
                            }
                        }
                        if (!$match) {
                            $s = $s . "<option value=\"" . $value . "\">" . $label . "</option>";
                            $match = false;
                        }
                    }
                    return $s;
                }

                function get_all_volunteer_options($persons, $week_no) {
                    if (!$persons[0])
                        array_shift($persons);
                    connect();
                    $query = "SELECT * FROM dbPersons WHERE status = 'active' ORDER BY last_name,first_name";
                    $result = mysql_query($query);
                    mysql_close();
                    $s = "";
                    for ($i = 0; $i < mysql_num_rows($result); ++$i) {
                        $row = mysql_fetch_row($result);
                        $value = $row[0];
                        $label = $row[2] . ", " . $row[1];
                        $match = false;
                        for ($j = 0; $j < count($persons); ++$j) {
                            if ($value == $persons[$j]['id']) {
                                $match = true;
                            }
                        }
                        if (!$match) {
                            $s = $s . "<option value=\"" . $value . "\">" . $label . "</option>";
                            $match = false;
                        }
                    }
                    return $s;
                }

                function process_add_volunteer($post, $shift, $venue) {
                    if (!array_key_exists('_submit_add_volunteer', $post))
                        return false;
                    if ($post['all_vol'] == "0" && $post['scheduled_vol'] == "0")
                        $error = "<table align=\"center\"><tr><td width=\"400\">
				You must select a volunteer.</td></tr></table><br>";
                    else if ($post['all_vol'] == "0")
                        $vol = $post['scheduled_vol'];
                    else
                        $vol = $post['all_vol'];
                    if ($error) {
                        echo $error;
                        do_fill_vacancy_form($shift, $venue);
                        return true;
                    } else {
                        schedule_person($venue, $shift[0], $shift[1], $shift[2], $vol);
                        return false;
                    }
                }

                function get_day_names(&$shift, $day) {
                    if ($day == "Mon") {
                        $shift[] = "Monday";
                        $shift[] = "Mon";
                    }
                    if ($day == "Tue") {
                        $shift[] = "Tuesday";
                        $shift[] = "Tue";
                    }
                    if ($day == "Wed") {
                        $shift[] = 'Wednesday';
                        $shift[] = "Wed";
                    }
                    if ($day == "Thu") {
                        $shift[] = "Thursday";
                        $shift[] = "Thu";
                    }
                    if ($day == "Fri") {
                        $shift[] = "Friday";
                        $shift[] = "Fri";
                    }
                    if ($day == "Sat") {
                        $shift[] = "Saturday";
                        $shift[] = "Sat";
                    } else {
                        $shift[] = "Sunday";
                        $shift[] = "Sun";
                    }
                    return $shift;
                }
                ?>
