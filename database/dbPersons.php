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

/**
 * @version March 1, 2012
 * @author Oliver Radwan and Allen Tucker
 */
include_once('dbinfo.php');
include_once('domain/Person.php');

function create_dbPersons() {
    connect();
    mysql_query("DROP TABLE IF EXISTS dbPersons");
    $result = mysql_query("CREATE TABLE dbPersons(id TEXT NOT NULL, first_name TEXT NOT NULL, last_name TEXT, gender TEXT, " .
            "    address TEXT, city TEXT, state VARCHAR(2), zip TEXT, phone1 VARCHAR(12) NOT NULL, phone2 VARCHAR(12), " .
            "    work_phone VARCHAR(12), email TEXT, " .
            "    type TEXT, screening_type TEXT, screening_status TEXT, status TEXT, refs TEXT, maywecontact TEXT," .
            "    motivation TEXT, specialties TEXT, " .
            "    availability TEXT, schedule TEXT, hours TEXT, " .
            "    birthday TEXT, start_date TEXT, end_date TEXT, reason_left TEXT, notes TEXT, password TEXT)"); 
    if (!$result)
        echo mysql_error() . "Error creating dbPersons table<br>";
}

/*
 * add a person to dbPersons table: if already there, return false
 */

function add_person($person) {
    if (!$person instanceof Person)
        die("Error: add_person type mismatch");
    connect();
    $query = "SELECT * FROM dbPersons WHERE id = '" . $person->get_id() . "'";
    $result = mysql_query($query);
    //if there's no entry for this id, add it
    if ($result == null || mysql_num_rows($result) == 0) {
        mysql_query('INSERT INTO dbPersons VALUES("' .
                $person->get_id() . '","' .
                $person->get_first_name() . '","' .
                $person->get_last_name() . '","' .
                $person->get_gender() . '","' .
                $person->get_address() . '","' .
                $person->get_city() . '","' .
                $person->get_state() . '","' .
                $person->get_zip() . '","' .
                $person->get_phone1() . '","' .
                $person->get_phone2() . '","' .
                $person->get_work_phone() . '","' . 
                $person->get_email() . '","' .
                implode(',', $person->get_type()) . '","' .
                $person->get_screening_type() . '","' .
                implode(',', $person->get_screening_status()) . '","' .
                $person->get_status() . '","' .
                implode(',', $person->get_references()) . '","' .
                $person->get_maywecontact() . '","' . 
                $person->get_motivation() . '","' . 
                $person->get_specialties() . '","' . 
                implode(',', $person->get_availability()) . '","' .
                implode(',', $person->get_schedule()) . '","' .
                implode(',', $person->get_hours()) . '","' .
                $person->get_birthday() . '","' .
                $person->get_start_date() . '","' .
                $person->get_end_date() . '","' . 
                $person->get_reason_left() . '","' .
                $person->get_notes() . '","' .
                $person->get_password() .
                '");');							
        mysql_close();
        return true;
    }
    mysql_close();
    return false;
}

/*
 * remove a person from dbPersons table.  If already there, return false
 */

function remove_person($id) {
    connect();
    $query = 'SELECT * FROM dbPersons WHERE id = "' . $id . '"';
    $result = mysql_query($query);
    if ($result == null || mysql_num_rows($result) == 0) {
        mysql_close();
        return false;
    }
    $query = 'DELETE FROM dbPersons WHERE id = "' . $id . '"';
    $result = mysql_query($query);
    mysql_close();
    return true;
}

/*
 * @return a Person from dbPersons table matching a particular id.
 * if not in table, return false
 */

function retrieve_person($id) {
    connect();
    $query = "SELECT * FROM dbPersons WHERE id = '" . $id . "'";
    $result = mysql_query($query);
    if (mysql_num_rows($result) !== 1) {
        mysql_close();
        return false;
    }
    $result_row = mysql_fetch_assoc($result);
    // var_dump($result_row);
    $thePerson = make_a_person($result_row);
//    mysql_close();
    return $thePerson;
}
// Name is first concat with last name. Example 'James Jones'
// return array of Persons.
function retrieve_persons_by_name ($name) {
	$persons = array();
	if (!isset($name) || $name == "" || $name == null) return $persons;
	connect();
	$name = explode(" ", $name);
	$first_name = $name[0];
	$last_name = $name[1];
    $query = "SELECT * FROM dbPersons WHERE first_name = '" . $first_name . "' AND last_name = '". $last_name ."'";
    $result = mysql_query($query);
    while ($result_row = mysql_fetch_assoc($result)) {
        $the_person = make_a_person($result_row);
        $persons[] = $the_person;
    }
    return $persons;	
}

function change_password($id, $newPass) {
    connect();
    $query = 'UPDATE dbPersons SET password = "' . $newPass . '" WHERE id = "' . $id . '"';
    $result = mysql_query($query);
    mysql_close();
    return $result;
}

function update_hours($id, $new_hours) {
    connect();
    $query = 'UPDATE dbPersons SET hours = "' . implode(",",$new_hours) . '" WHERE id = "' . $id . '"';
    $result = mysql_query($query);
    mysql_close();
    return $result;
}

/*
 * @return all rows from dbPersons table ordered by last name
 * if none there, return false
 */

function getall_dbPersons() {
    connect();
    $query = "SELECT * FROM dbPersons ORDER BY last_name,first_name";
    $result = mysql_query($query);
    if ($result == null || mysql_num_rows($result) == 0) {
        mysql_close();
        return false;
    }
    $result = mysql_query($query);
    $thePersons = array();
    while ($result_row = mysql_fetch_assoc($result)) {
        $thePerson = make_a_person($result_row);
        $thePersons[] = $thePerson;
    }

    return $thePersons;
}

function getall_volunteer_names() {
	connect();
	$query = "SELECT first_name, last_name FROM dbPersons ORDER BY last_name,first_name";
    $result = mysql_query($query);
    if ($result == null || mysql_num_rows($result) == 0) {
        mysql_close();
        return false;
    }
    $result = mysql_query($query);
    $names = array();
    while ($result_row = mysql_fetch_assoc($result)) {
        $names[] = $result_row['first_name'].' '.$result_row['last_name'];
    }
    mysql_close();
    return $names;   	
}

function make_a_person($result_row) {
    $thePerson = new Person(
                    $result_row['first_name'],
                    $result_row['last_name'],
                    $result_row['gender'],
                    $result_row['address'],
                    $result_row['city'],
                    $result_row['state'],
                    $result_row['zip'],
                    $result_row['phone1'],
                    $result_row['phone2'],
                    $result_row['work_phone'],
                    $result_row['email'],
                    $result_row['type'],
                    $result_row['screening_type'],
                    $result_row['screening_status'],
                    $result_row['status'],
                    $result_row['refs'],  
                    $result_row['maywecontact'],
                    $result_row['motivation'],
                    $result_row['specialties'],
                    $result_row['availability'],
                    $result_row['schedule'],
                    $result_row['hours'],
                    $result_row['birthday'],
                    $result_row['start_date'],
                    $result_row['end_date'],
                    $result_row['reason_left'],
                    $result_row['notes'],
                    $result_row['password']);   
    return $thePerson;
}

function getall_names($status, $type) {
    connect();
    $result = mysql_query("SELECT id,first_name,last_name,type FROM dbPersons " .
            "WHERE status = '" . $status . "' AND TYPE LIKE '%" . $type . "%' ORDER BY last_name,first_name");
    mysql_close();
    return $result;
}

/*
 * @return all active people of type $t or subs from dbPersons table ordered by last name
 */

function getall_type($t) {
    connect();
    $query = "SELECT * FROM dbPersons WHERE (type LIKE '%" . $t . "%' OR type LIKE '%sub%') AND status = 'active'  ORDER BY last_name,first_name";
    $result = mysql_query($query);
    if ($result == null || mysql_num_rows($result) == 0) {
        mysql_close();
        return false;
    }
    mysql_close;
    return $result;
}

/*
 *   get all active volunteers and subs of $type who are available for the given $frequency,$week,$day,and $shift
 */

function getall_available($type, $day, $shift) {
    connect();
    $query = "SELECT * FROM dbPersons WHERE (type LIKE '%" . $type . "%' OR type LIKE '%sub%')" .
            " AND availability LIKE '%" . $day .":". $shift .
            "%' AND status = 'active' ORDER BY last_name,first_name";
    $result = mysql_query($query);
    mysql_close();
    return $result;
}


// retrieve only those persons that match the criteria given in the arguments
function getonlythose_dbPersons($type, $status, $name, $day, $shift, $venue) {
   Connect();
   $query = "SELECT * FROM dbPersons WHERE type LIKE '%" . $type . "%'" .
           " AND status LIKE '%" . $status . "%'" .
           " AND (first_name LIKE '%" . $name . "%' OR last_name LIKE'%" . $name . "%')" .
           " AND availability LIKE '%" . $day . "%'" . 
           " AND availability LIKE '%" . $shift . "%'" . 
           " AND availability LIKE '%" . $venue . "%'" . 
           " ORDER BY last_name,first_name";
   $result = mysql_query($query);
   $thePersons = array();
   while ($result_row = mysql_fetch_assoc($result)) {
       $thePerson = make_a_person($result_row);
       $thePersons[] = $thePerson;
   }
   mysql_close();
   return $thePersons;
}

function phone_edit($phone) {
    if ($phone!="")
		return substr($phone, 0, 3) . "-" . substr($phone, 3, 3) . "-" . substr($phone, 6);
	else return "";
}

function get_people_for_export($attr, $first_name, $last_name, $gender, $type, $status, $start_date, $city, $zip, $phone, $email) {
	$first_name = "'".$first_name."'";
	$last_name = "'".$last_name."'";
	$gender = "'".$gender."'";
	$status = "'".$status."'";
	$start_date = "'".$start_date."'";
	$city = "'".$city."'";
	$zip = "'".$zip."'";
	$phone = "'".$phone."'";
	$email = "'".$email."'";
	$select_all_query = "'.'";
	if ($gender == $select_all_query) $gender = $gender." or gender=''";	
	if ($start_date == $select_all_query) $start_date = $start_date." or start_date=''";
	if ($email == $select_all_query) $email = $email." or email=''";
    
	$type_query = "";
    if (!isset($type) || count($type) == 0) $type_query = "'.'";
    else {
    	$type_query = implode("|", $type);
    	$type_query = "'.*($type_query).*'";
    }
    
    error_log("query for start date is ". $start_date);
    error_log("query for gender is ". $gender);
    error_log("query for type is ". $type_query);
    
   	connect();
    $query = "SELECT ". $attr ." FROM dbPersons WHERE 
    			first_name REGEXP ". $first_name . 
    			" and last_name REGEXP ". $last_name . 
    			" and (gender REGEXP ". $gender . ")" .
    			" and (type REGEXP ". $type_query .")". 
    			" and status REGEXP ". $status . 
    			" and (start_date REGEXP ". $start_date . ")" .
    			" and city REGEXP ". $city .
    			" and zip REGEXP ". $zip .
    			" and (phone1 REGEXP ". $phone ." or phone2 REGEXP ". $phone . " )" .
    			" and (email REGEXP ". $email .") ORDER BY last_name, first_name";
	error_log("Querying database for exporting");
	error_log("query = " .$query);
    $result = mysql_query($query);
    return $result;

}


?>
