<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/**
 * Person class for RMHP-Hmebase.
 * @author Oliver Radwan, Judy Yang and Allen Tucker
 * @version May 1, 2008, modified January 21, 2015
 */
include_once(dirname(__FILE__).'/../database/dbZipCodes.php');
include_once(dirname(__FILE__).'/../database/dbShifts.php');
include_once(dirname(__FILE__).'/../database/dbPersons.php');
include_once('Shift.php');
include_once('Person.php');

class Person {
    private $id;    // id (unique key) = first_name . phone1
    private $first_name; // first name as a string
    private $last_name;  // last name as a string
    private $gender; // gender - string
    private $address;   // address - string
    private $city;    // city - string
    private $state;   // state - string
    private $zip;    // zip code - integer
    private $county; // county of residence
    private $phone1;   // main phone
    private $phone2;   // alternate phone
    private $email;   // email address as a string
    private $contact_preference; // prefer being contacted by phone or email
    private $emergency_contact; // contact in case of emergencies
    private $emergency_phone; // phone number of emergency caontact
    private $type;       // array of "volunteer", "sub", "mealprep", "activities", "other", "manager"
    private $screening_type; // if status is "applicant", type of screening used for this applicant
    private $screening_status; // array of dates showing completion of 
    // screening steps for this applicant 
    private $status;     // a person may be an "applicant", "active", "LOA", or "former"
    private $occupation; // current occupation
    private $references;   // array of name:phone of up to 2 references 
    private $maywecontact; // "yes" or "no" for permission to contact references
    private $motivation;   // App: why interested in RMH?
    private $specialties;  // App: special interests and hobbies related to RMH
    private $availability; // array of week_no:day:hours:venue quads; e.g., odd:Mon:9-1:house
    private $schedule;     // array of scheduled shift ids; e.g., 01-05-15:9-1:house
    private $birthday;     // format: 03-12-64
    private $start_date;   // format: 03-12-99
    private $notes;        // notes that only the manager can see and edit
    private $password;     // password for calendar and database access: default = $id

    /**
     * constructor for all persons
     */

    function __construct($f, $l, $g, $a, $c, $s, $z, $co, $p1, $p2, $e, $cp, $ec, $ep, $t, 
    		$screening_type, $screening_status, $st, $oc, $re, $mwc, $mot, $spe, 
    		$av, $sch, $bd, $sd, $notes, $pass) {
        $this->id = $f . $p1;
        $this->first_name = $f;
        $this->last_name = $l;
        $this->gender = $g;
        $this->address = $a;
        $this->city = $c;
        $this->state = $s;
        $this->zip = $z;
        $this->county = $this->compute_county();
        $this->phone1 = $p1;
        $this->phone2 = $p2;
        $this->email = $e;
        $this->contact_preference = $cp;
        $this->emergency_contact = $ec;
        $this->emergency_phone = $ep;
        if ($t !== "")
            $this->type = explode(',', $t);
        else
            $this->type = array();
        $this->screening_type = $screening_type;
        if ($screening_status !== "")
            $this->screening_status = explode(',', $screening_status);
        else
            $this->screening_status = array();
        $this->status = $st;
        $this->occupation = $oc;
        if ($re != null) {
            $this->references = explode(',', $re);
            $this->maywecontact = "yes";
        }
        else
            $this->references = array();
        $this->motivation = $mot;
        $this->specialties = $spe;
        if ($av == "")
            $this->availability = array();
        else
            $this->availability = explode(',', $av);
        if ($sch !== "")
            $this->schedule = explode(',', $sch);
        else
            $this->schedule = array();
        

        $this->birthday = $bd;
        $this->start_date = $sd;
        $this->notes = $notes;
        if ($pass == "")
            $this->password = md5($this->id);
        else
            $this->password = $pass;  // default password == md5($id)
    }

    function get_id() {
        return $this->id;
    }

    function get_first_name() {
        return $this->first_name;
    }

    function get_last_name() {
        return $this->last_name;
    }

    function get_gender() {
        return $this->gender;
    }

    function get_address() {
        return $this->address;
    }

    function get_city() {
        return $this->city;
    }

    function get_state() {
        return $this->state;
    }

    function get_zip() {
        return $this->zip;
    }

    function get_county() {
        return $this->county;
    }

    function get_phone1() {
        return $this->phone1;
    }

    function get_phone2() {
        return $this->phone2;
    }

    function get_email() {
        return $this->email;
    }

    function get_contact_preference() {
        return $this->contact_preference;
    }

    function get_emergency_contact() {
        return $this->emergency_contact;
    }

    function get_emergency_phone() {
        return $this->emergency_phone;
    }

    /**
     * @return type of person, an array of: "volunteer", "guestchef", "sub", etc.
     */
    function get_type() {
        return $this->type;
    }

    function get_screening_type() {
        return $this->screening_type;
    }

    function get_screening_status() {
        return $this->screening_status;
    }

    function get_status() {
        return $this->status;
    }

    function get_occupation() {
        return $this->occupation;
    }

    function get_references() {
        return $this->references;
    }

    function get_maywecontact() {
        return $this->maywecontact;
    }

    function get_motivation() {
        return $this->motivation;
    }

    function get_specialties() {
        return $this->specialties;
    }

    function get_availability() {   // array of week_no:day:hours:venue
        return $this->availability;
    }
    
	function get_availdays() {		// array of week_no:day (extracted from availability)		
		$availdays = array();
        foreach ($this->availability as $a) {
        	$ex = explode(":",$a);
        	$ad = $ex[0].":".$ex[1];
        	if (!in_array($ad,$availdays))
        		$availdays[] = $ad;
        }
        return $availdays;
    }
    function get_availhours() {     // array of hours (extracted from availability)
    	$availhours = array();
    	foreach ($this->availability as $a) {
        	$ex = explode(":",$a);
        	$ad = $ex[2];
        	if (!in_array($ad,$availhours))
        		$availhours[] = $ad;
        }
        return $availhours;
    }
    function get_availvenues() {     // array of venues (extracted from availability)
    	$availvenue = array();
    	foreach ($this->availability as $a) {
        	$ex = explode(":",$a);
        	$ad = $ex[3];
        	if (!in_array($ad,$availvenue))
        		$availvenue[] = $ad;
        }
    	return $availvenue;
    }
    function set_availability($days,$hours,$venue) { // reconstruct availability array from parts
     	$this->availability = array();
    	foreach($days as $day)
    		foreach ($hours as $hour)
    			foreach ($venues as $venue)
    				$this->availability[] = $day.":".$hours.":".$venue;
    }

    function get_schedule() {
        return $this->schedule;
    }

    function get_birthday() {
        return $this->birthday;
    }

    function get_start_date() {
        return $this->start_date;
    }

    function get_notes() {
        return $this->notes;
    }

    function get_password() {
        return $this->password;
    }
    function set_county ($county){
        $this->county = $county;
    }
    
    function compute_county () {
        if ($this->state=="ME") {
            $countydata = false;
            if ($this->get_zip()!="")
	            $countydata = retrieve_dbZipCodes($this->get_zip(),"");    
	        else if (!$countydata) 
	            $countydata = retrieve_dbZipCodes("",$this->get_city());
	        if ($countydata) {
	            if ($this->zip == "")
	            	$this->zip = $countydata[0];
	            return $countydata[3];
	        }
        }
        return "";
    }
    
    // return a dictionary reporting total number hours worked by days of the week with
    // a given date range. $from and $to are strings of the form 'm/d/y', if one of the strings
    // is the empty string, then the range is unbounded in that direction.
    // the dictionary is of the form {'Mon' => , 'Tue' => }.
function report_hours ($histories, $from, $to) {
    	$min_date = "01/01/2000";
    	$max_date = "12/31/2020";
    	if ($from == '') $from = $min_date;
    	if ($to == '') $to = $max_date;
    	error_log("from date = " . $from);
    	error_log("to date = ". $to);
    	$from_date = date_create_from_mm_dd_yyyy($from); 
    	$to_date   = date_create_from_mm_dd_yyyy($to);
    	$report = array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 
    					'Fri' => 0, 'Sat' => 0, 'Sun' => 0);
    	if (array_key_exists($this->get_id(), $histories)) {
    	  $hid = explode(',',$histories[$this->id]);
    	  foreach ($hid as $shift_id) {
    		$s = select_dbShifts($shift_id);
    		$shift_date = date_create_from_mm_dd_yyyy($s->get_mm_dd_yy());
    		if ($shift_date >= $from_date && $shift_date <= $to_date) {
    			$report[$s->get_day()] += $s->duration();
    		}
    	  }
    	}
    	return $report;
    }
}

function report_hours_by_day($histories, $from, $to) {
	$min_date = "01/01/2000";
	$max_date = "12/31/2020";
	if ($from == '') $from = $min_date;
	if ($to == '') $to = $max_date;
	error_log("from date = " . $from);
	error_log("to date = ". $to);
	$from_date = date_create_from_mm_dd_yyyy($from);
	$to_date   = date_create_from_mm_dd_yyyy($to);
	$reports = array(
		'morning' => array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0,
    				'Fri' => 0, 'Sat' => 0, 'Sun' => 0), 
		'earlypm' => array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0,
    				'Fri' => 0, 'Sat' => 0, 'Sun' => 0),
		'latepm' => array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0,
    				'Fri' => 0, 'Sat' => 0, 'Sun' => 0),
		'evening' => array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0,
    				'Fri' => 0, 'Sat' => 0, 'Sun' => 0),
		'overnight' => array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0,
    				'Fri' => 0, 'Sat' => 0, 'Sun' => 0),
		'total' => array('Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0,
    				'Fri' => 0, 'Sat' => 0, 'Sun' => 0)
	);
	
	foreach($histories as $person_id => $person_shifts) {
	    $ps = explode(',',$person_shifts);
		foreach ($ps as $shift_id) {
			$s = select_dbShifts($shift_id);
			$shift_date = date_create_from_mm_dd_yyyy($s->get_mm_dd_yy());
			if ($shift_date >= $from_date && $shift_date <= $to_date) {
				$reports[$s->get_time_of_day()][$s->get_day()] += $s->duration();
				$reports['total'][$s->get_day()] += $s->duration();
    		}
		}
	}
	return $reports;
}


?>
