<?php
/*
 * Copyright 2015 by Adrienne Beebe, Yonah Biers-Ariel, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/**
 * Functions to create, update, and retrieve information from the
 * dbShifts table in the database.  This table is used with the Shift
 * class.  Shifts are generated using the master schedule (through the
 * addWeek.php form), and retrieved by the calendar form and editShift.
 * @version Feb 12, 2015
 * @author Xun Wang
 */
include_once('domain/Shift.php');
include_once('dbPersons.php');
include_once('dbDates.php');
include_once('dbSCL.php');
include_once('dbinfo.php');

/**
 * Drops the dbShifts table if it exists, and creates a new one
 * Table fields:
 * 0 id: "mm-dd-yy:hours:venue" is a unique key for this shift
 * 1 start_time: Integer: e.g. 10 (meaning 10:00am)
 * 2 end_time: Integer: e.g. 13 (meaning 1:00pm)
 * 3 venue = "house" or "fam"
 * 4 vacancies: # of vacancies for this shift
 * 5 persons: list of people ids, followed by their name, ie "max1234567890+Max+Palmer"
 * 6 removed_persons: for sub call lists -- persons removed from this shift
 * 7 sub_call_list: yes/no if shift has SCL
 * 8 notes: shift notes
 */
function create_dbShifts() {
    connect();
    mysql_query("DROP TABLE IF EXISTS dbShifts");
    $result = mysql_query("CREATE TABLE dbShifts (id CHAR(20) NOT NULL, " .
            "start_time INT, end_time INT, venue TEXT, vacancies INT, " .
            "persons TEXT, removed_persons TEXT, sub_call_list TEXT, notes TEXT, PRIMARY KEY (id))");
    if (!$result) {
        echo mysql_error();
        return false;
    }
    mysql_close();
    return true;
}



/**
 * Inserts a shift into the db
 * @param $s the shift to insert
 */
function insert_dbShifts($s) {
    if (!$s instanceof Shift) {
        die("Invalid argument for insert_dbShifts function call" . $s);
    }
    connect();
    $query = 'SELECT * FROM dbShifts WHERE id ="' . $s->get_id() . '"';
    $result = mysql_query($query);
    if (mysql_num_rows($result) != 0) {
        delete_dbShifts($s);
        connect();
    }
    $query = "INSERT INTO dbShifts VALUES (\"" . $s->get_id() . "\",\"" .
            $s->get_start_time() . "\",\"" . $s->get_end_time() . "\",\"" . $s->get_venue() . "\"," .
            $s->num_vacancies() . ",\"" .
            implode("*", $s->get_persons()) . "\",\"" .implode("*", $s->get_removed_persons()) . "\",\"" .
            $s->get_sub_call_list() . "\",\"" . $s->get_notes() . "\")";
    $result = mysql_query($query);
    if (!$result) {
        echo "unable to insert into dbShifts " . $s->get_id() . mysql_error();
        mysql_close();
        return false;
    }
    mysql_close();
    return true;
}

/**
 * Deletes a shift from the db
 * @param $s the shift to delete
 */
function delete_dbShifts($s) {
    if (!$s instanceof Shift)
        die("Invalid argument for delete_dbShifts function call");
    connect();
    $query = "DELETE FROM dbShifts WHERE id=\"" . $s->get_id() . "\"";
    $result = mysql_query($query);
    if (!$result) {
        echo "unable to delete from dbShifts " . $s->get_id() . mysql_error();
        mysql_close();
        return false;
    }
    mysql_close();
    return true;
}

/**
 * Updates a shift in the db by deleting it (if it exists) and then replacing it
 * @param $s the shift to update
 */
function update_dbShifts($s) {
	error_log("updating shift in database");
    if (!$s instanceof Shift)
        die("Invalid argument for dbShifts->replace_shift function call");
    delete_dbShifts($s);
    insert_dbShifts($s);
    return true;
}

/**
 * Selects a shift from the database
 * @param $id a shift id
 * @return Shift or null
 */
function select_dbShifts($id) {
    connect();
    $s = null;
    $query = "SELECT * FROM dbShifts WHERE id =\"" . $id . "\"";
    $result = mysql_query($query);
    mysql_close();
    if (!$result) {
        echo 'Could not run query2: ' . mysql_error();
    } else {
        $result_row = mysql_fetch_row($result);
        if ($result_row != null) {
        	$persons = array();
        	$removed_persons = array();
        	if ($result_row[5] != "")
            	$persons = explode("*", $result_row[5]);
            if ($result_row[6] != "")
            	$removed_persons = explode("*", $result_row[6]);
        	$s = new Shift($result_row[0], $result_row[3], $result_row[4], $persons, $removed_persons, null, $result_row[8]);
        }
    }
    return $s;
}

/**
 * Selects all shifts from the database for a given date and venue
 * @param $id is a shift id
 * @return a result set or false (if there are no shifts for that date and venue)
 */
function selectDateVenue_dbShifts($date, $venue) {
    connect();
    $query = "SELECT * FROM dbShifts WHERE id LIKE '%" . $date . "%' AND venue LIKE '%" . $venue . "%'";
    $result = mysql_query($query);
    mysql_close();
    return $result;
}

/**
 * Returns an array of $ids for all shifts scheduled for the person having $person_id
 */
function selectScheduled_dbShifts($person_id) {
    connect();
    $shift_ids = mysql_query("SELECT id FROM dbShifts WHERE persons LIKE '%" . $person_id . "%' ORDER BY id");
    $shifts = array();
    if ($shift_ids) {
        while ($thisRow = mysql_fetch_array($shift_ids, MYSQL_ASSOC)) {
            $shifts[] = $thisRow['id'];
        }
    }
    mysql_close();
    return $shifts;
}

/**
 * Returns the month, day, year, start, end, or venue of a shift from its id
 */
function get_shift_month($id) {
    return substr($id, 0, 2);
}

function get_shift_day($id) {
    return substr($id, 3, 2);
}

function get_shift_year($id) {
    return substr($id, 6, 2);
}

function get_shift_start($id) {
	if (substr($id,9)=="overnight") 
		return 0;
	else if (substr($id, 11, 1) == "-")
        return substr($id, 9, 2);
    else
        return substr($id, 9, 1);
}

function get_shift_end($id) {
	if (substr($id,9)=="overnight")
		return 1;
    else if (substr($id, 11, 1) == "-")
        return substr($id, 12, 2);
    else
        return substr($id, 11, 2);
}

//Add class get_shift_venue, using the "strrchr" function to return the part after the last ":"
function get_shift_venue($id) {
	return substr(strrchr($id,":"),1);
}



/*
 * Creates the $shift_name of a shift, e.g. "Sunday, February 14, 2010 2pm to 5pm"
 *         from its $id, e.g. "02-14-10-14-17"
 */

function get_shift_name_from_id($id) {
    $shift_name = date("l F j, Y", mktime(0, 0, 0, get_shift_month($id), get_shift_day($id), get_shift_year($id)));
    $shift_name = $shift_name . " ";
    $st = get_shift_start($id);
    $et = get_shift_end($id);
    if ($st==0)
    	$shift_name = $shift_name . "overnight";
    else {   
    	$st = $st < 12 ? $st . "am" : $st - 12 . "pm";
    	if ($st == "0pm")
   		    $st = "12pm";
    	$et = $et < 12 ? $et . "am" : $et - 12 . "pm";
    	if ($et == "0pm")
        	$et = "12pm";
    	$shift_name = $shift_name . $st . " to " . $et;
    }
    return $shift_name;
}

/**
 * Tries to move a shift to a new start and end time.  New times must
 * not overlap with any other shift on the same date and venue
 * @return false if shift doesn't exist or there's an overlap
 * Otherwise, change the shift in the database and @return true
 */
function move_shift($s, $new_start, $new_end) {
// first, see if it exists
    $old_s = select_dbShifts($s->get_id());
    if ($old_s == null)
        return false;
// now see if it can be moved by looking at all other shifts for the same date and venue
    $new_s = $s->set_start_end_time($new_start, $new_end);
    $current_shifts = selectDateVenue_dbShifts($s->get_date(), $s->get_venue());
    connect();
    for ($i = 0; $i < mysql_num_rows($current_shifts); ++$i) {
        $same_day_shift = mysql_fetch_row($current_shifts);
        if ($old_s->get_id() == $same_day_shift[0])  // skip its own entry
            continue;
        if (timeslots_overlap($same_day_shift[1], $same_day_shift[2], $new_s->get_start_time(), $new_s->get_end_time())) {
            $s = $old_s;
            mysql_close();
            return false;
        }
    }
    mysql_close();
// we're good to go
    replace_dbDates($old_s, $new_s);
    delete_dbShifts($old_s);
    return true;
}

/**
 * @result == true if $s1's timeslot overlaps $s2's timeslot, and false otherwise.
 */
function timeslots_overlap($s1_start, $s1_end, $s2_start, $s2_end) {
	if ($s1_start == "overnight")
		if ($s2_start == "overnight")
			return true;
		else return false;
	else if ($s2_start == "overnight")
		return false;
    if ($s1_end > $s2_start) {
        if ($s1_start >= $s2_end)
            return false;
        else
            return true;
    }
    else
        return false;
}

function make_a_shift($result_row) {
    $the_shift = new Shift(
    				$result_row['id'],
                    $result_row['venue'],
                    $result_row['vacancies'],
                    $result_row['persons'],
                    $result_row['removed_persons'],
                    $result_row['sub_call_list'],
                    $result_row['notes']
                 );

    return $the_shift;
}

function get_all_shifts() {
    connect();
    $query = "SELECT * FROM dbShifts";
    $result = mysql_query($query);
    if ($result == null || mysql_num_rows($result) == 0) {
        mysql_close();
        return false;
    }
    $result = mysql_query($query);
    $shifts = array();
    while ($result_row = mysql_fetch_assoc($result)) {
        $shift = make_a_shift($result_row);
        $shifts[] = $shift;
    }

    return $shifts;
}
// this function is for exporting volunteer data
function get_all_people_in_past_shifts() {
    $today = date('m-d-y');
    $people_in_shifts = array();
    $all_shifts = get_all_shifts();
    foreach ($all_shifts as $a_shift){
        if (substr($a_shift->get_id(),6,2)>=substr($today,6,2) && substr($a_shift->get_id(),0,5)>=substr($today,0,5))
            continue; // skip present and future shifts
        // okay, this is a past shift, so add person-shift pairs 
       $persons = explode('*',$a_shift->get_persons());
  //     if (!$persons[0])  // skip vacant shifts
  //        array_shift($persons);
       foreach ($persons as $a_person)
         if (strpos($a_person,"+")>0)
           $people_in_shifts[] = substr($a_person,0,strpos($a_person,"+")).",". $a_shift->get_id() ;
    }
    sort($people_in_shifts);
    return $people_in_shifts;
}
// this function is for reporting volunteer data
function get_all_peoples_histories() {
    $today = date('m-d-y');
    $histories = array();
    $all_shifts = get_all_shifts();
    foreach ($all_shifts as $a_shift){
       $persons = explode('*',$a_shift->get_persons());
       if (!$persons[0])  // skip vacant shifts
          array_shift($persons);
       if (count($persons)>0) {
         foreach ($persons as $a_person) {
           if (strpos($a_person,"+")>0) {
             $person_id = substr($a_person,0,strpos($a_person,"+"));
             if (array_key_exists($person_id, $histories))
                 $histories[$person_id] .= ",". $a_shift->get_id();
             else 
                 $histories[$person_id] = $a_shift->get_id();
           }
         }
       }
    }
    ksort($histories);
    return $histories;
}

function date_create_from_mm_dd_yyyy ($mm_dd_yyyy) {
    if (strpos($mm_dd_yyyy,"/")>0)
        return mktime(0,0,0,substr($mm_dd_yyyy,0,2),substr($mm_dd_yyyy,3,2),substr($mm_dd_yyyy,6,4));
    else
        return mktime(0,0,0,substr($mm_dd_yyyy,0,2),substr($mm_dd_yyyy,3,2),"20".substr($mm_dd_yyyy,6,2));
}

?>
