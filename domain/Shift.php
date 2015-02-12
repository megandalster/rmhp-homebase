<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * class Shift characterizes a time interval in a day new Shift
 * for scheduling volunteers
 * @version May 1, 2008, modified 9/15/08, 2/14/10, 2/5/15
 * @author Allen Tucker and Xun Wang
 */

include_once(dirname(__FILE__).'/../database/dbShifts.php');
include_once(dirname(__FILE__).'/../database/dbPersons.php');

class Shift {

    private $mm_dd_yy;      // String: "mm-dd-yy".
    private $hours;          // String: '9-1', '1-5', '5-9' or 'night'
    private $start_time;    // Integer: e.g. 10 (meaning 10:00am)     NOTE: NOT SURE WE NEED THESE TWO
    private $end_time;      // Integer: e.g. 13 (meaning 1:00pm)	  DEPENDS ON WHETHER USER CAN MOVE A SHIFT OR NOT
    private $venue;         // "house", "fam", or "mealprep"
    private $vacancies;     // number of vacancies in this shift
    private $persons;       // array of person ids filling slots, followed by their name, ie "malcom1234567890+Malcom+Jones"
    private $removed_persons; // array of persons who have previously been removed from this shift.
    private $sub_call_list; // SCL if sub call list exists, otherwise null
    private $day;           // string name of day "Monday"...
    private $id;            // "mm-dd-yy:hours:venue is a unique key for this shift
    private $notes;         // notes written by the manager

    /*
     * construct an empty shift with a certain number of vacancies
     */

    function __construct($id, $venue, $vacancies, $persons, $removed_persons, $sub_call_list, $notes) {
    	$this->mm_dd_yy = substr($id, 0, 8);
        $this->hours = substr($id, 9);
        $i = strpos($this->hours, "-");
        $f = strpos($this->hours, ":");
        if ($i>0) {
        	$this->start_time = substr($this->hours, 0, $i);   
        	//XW: Code added here:	( on 02/05/15)
        	$this->end_time = (substr($this->hours, $i + 1, ($f-$i-1)) + 12);
        	//XW: Assume the only start_time is 9
        	if ($this->start_time != "9") {
        		$this->start_time += 12;
        	}
        }
        else {  // assuming an overnight shift
        	$this->start_time = 0;
        	$this->end_time = 1;
        }
        $this->venue = $venue;
        $this->vacancies = $vacancies;
        $this->persons = $persons;
        $this->removed_persons = $removed_persons;
        $this->sub_call_list = $sub_call_list;
        $this->day = date("D", mktime(0, 0, 0, substr($this->mm_dd_yy, 0, 2), substr($this->mm_dd_yy, 3, 2), "20" . substr($this->mm_dd_yy, 6, 2)));
        $this->id = $id;
        $this->notes = $notes;	
    }

    /**
     * This function (re)sets the start and end times for a shift
     * and corrects its $id accordingly
     * Precondition:  0 <= $st && $st < $et && $et < 24
     *          && the shift is not "chef" or "night"
     * Postcondition: $this->start_time == $st && $this->end_time == $et
     *          && $this->id == $this->mm_dd_yy .  "-"
     *          . $this->start_time . "-" . $this->end_time . $this->venue
     *          && $this->hours == substr($this->id, 9)
     */
    function set_start_end_time($st, $et) {
        if (0 <= $st && $st < $et && $et < 24 &&
                strpos(substr($this->id, 9), "-") !== false) {
            $this->start_time = $st;
            $this->end_time = $et;
            if ($st>12)
            	$st -= 12;
            if ($et>12)
            	$et -=12;
            $this->id = $this->mm_dd_yy . ":" . $st
                    . "-" . $et;
            $this->hours = substr($this->id, 9);
            return $this;
        }
        else
            return false;
    }

    /*
     * @return the number of vacancies in this shift.
     */

    function num_vacancies() {
        return $this->vacancies;
    }

    function ignore_vacancy() {
        if ($this->vacancies > 0)
            --$this->vacancies;
    }

    function add_vacancy() {
        ++$this->vacancies;
    }

    function num_slots() {
        if (!$this->persons[0])
            array_shift($this->persons);
        return $this->vacancies + count($this->persons);
    }

    function has_sub_call_list() {
        if ($this->sub_call_list == "yes")
            return true;
        return false;
    }

    function open_sub_call_list() {
        $this->sub_call_list = "yes";
    }

    function close_sub_call_list() {
        $this->sub_call_list = "no";
    }

    /*
     * getters and setters
     */
    function get_mm_dd_yy() {
    	return $this->mm_dd_yy;
    }

    function get_hours() {
        return $this->hours;
    }

    function get_start_time() {
        return $this->start_time;
    }

    function get_end_time() {
        return $this->end_time;
    }
    function get_time_of_day() {
        if ($this->start_time == 0)
            return "overnight";
        else if ($this->start_time <= 10)
            return "morning";
        else if ($this->start_time <= 13)
            return "earlypm";
        else if ($this->start_time <= 16)
            return "latepm";
        else 
            return "evening";
    }
    function get_date() {
        return $this->mm_dd_yy;
    }

    function get_venue() {
        return $this->venue;
    }

    function get_persons() {
        return $this->persons;
    }
    
    function get_removed_persons() {
    	return $this->removed_persons;
    }

    function get_sub_call_list() {
        return $this->sub_call_list;
    }

    function get_id() {
        return $this->id;
    }

    function get_day() {
        return $this->day;
    }

    function get_notes() {
        return $this->notes;
    }

	function get_vacancies() {
    	return $this->vacancies;
    }
    
    
    function set_notes($notes) {
        $this->notes = $notes;
    }
    
    function assign_persons($p) {
    	foreach ($this->persons as $person) {
    		if (!in_array($person, $p)) {
    			error_log("adding ".$person." to removed persons");
    			$this->removed_persons[] = $person;
    		}
    	}
        $this->persons = $p;
    }
    
    function duration () {
    	if ($this->end_time == 1 && $this->start_time == 0) {
    		// overnight shift
    		return 12;
    	} else return $this->end_time - $this->start_time;
    }
    
}

function report_shifts_staffed_vacant($from, $to) {
	$min_date = "01/01/2000";
	$max_date = "12/31/2020";
	if ($from == '') $from = $min_date;
	if ($to == '') $to = $max_date;
	error_log("from date = " . $from);
	error_log("to date = ". $to);
	$from_date = date_create_from_mm_dd_yyyy($from);
	$to_date   = date_create_from_mm_dd_yyyy($to);
	$reports = array(
		'morning' => array('Mon' => array(0, 0), 'Tue' => array(0, 0), 'Wed' => array(0, 0), 'Thu' => array(0, 0),
    				'Fri' => array(0, 0), 'Sat' => array(0, 0), 'Sun' => array(0, 0)), 
		'earlypm' => array('Mon' => array(0, 0), 'Tue' => array(0, 0), 'Wed' => array(0, 0), 'Thu' => array(0, 0),
    				'Fri' => array(0, 0), 'Sat' => array(0, 0), 'Sun' => array(0, 0)),
		'latepm' => array('Mon' => array(0, 0), 'Tue' => array(0, 0), 'Wed' => array(0, 0), 'Thu' => array(0, 0),
    				'Fri' => array(0, 0), 'Sat' => array(0, 0), 'Sun' => array(0, 0)),
		'evening' => array('Mon' => array(0, 0), 'Tue' => array(0, 0), 'Wed' => array(0, 0), 'Thu' => array(0, 0),
    				'Fri' => array(0, 0), 'Sat' => array(0, 0), 'Sun' => array(0, 0)),
		'overnight' => array('Mon' => array(0, 0), 'Tue' => array(0, 0), 'Wed' => array(0, 0), 'Thu' => array(0, 0),
    				'Fri' => array(0, 0), 'Sat' => array(0, 0), 'Sun' => array(0, 0)),
		'total' => array('Mon' => array(0, 0), 'Tue' => array(0, 0), 'Wed' => array(0, 0), 'Thu' => array(0, 0),
    				'Fri' => array(0, 0), 'Sat' => array(0, 0), 'Sun' => array(0, 0)),
	);
	$all_shifts = get_all_shifts();
	foreach ($all_shifts as $s) {
		$shift_date = date_create_from_mm_dd_yyyy($s->get_mm_dd_yy());
		if ($shift_date >= $from_date && $shift_date <= $to_date && 
		    (strlen($s->get_persons())>0 || $s->get_vacancies()>0)) {
		    $reports[$s->get_time_of_day()][$s->get_day()][0] += 1;
			$reports[$s->get_time_of_day()][$s->get_day()][1] += $s->get_vacancies();
			$reports['total'][$s->get_day()][0] += 1;
			$reports['total'][$s->get_day()][1] += $s->get_vacancies();
		}
	}
	return $reports;
}



?>
