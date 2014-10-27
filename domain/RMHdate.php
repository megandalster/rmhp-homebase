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


include_once("Shift.php");
include_once("database/dbMasterSchedule.php");
/* A class to manage an RMHDate
 * @version May 1, 2008
 * @author Taylor and Maxwell Palmer
 */

class RMHdate {

    private $id;    // "mm-dd-yy" form of this date: used as a key
    private $month;       // Textual month of the year  (e.g., Jan)
    private $day;         // Textual day of the week (Mon - Sun)
    private $dom;    // Numerical day of month
    private $month_num;   // Numberical month
    private $day_of_week; // Numerical day of the week (1-7, Mon = 1)
    private $day_of_year; // Numerical day of the year (1-366)
    private $year;        // Numerical year (e.g., 2008)
    private $shifts;      // array of Shifts
    private $mgr_notes;   // notes on night/weekend manager

    /*
     * Construct an RMHdate and initialize its vacant shifts
     * Test that arguments $mm, $dd, $yy are valid, using the
     * function checkdate
     */

    function __construct($id, $shifts, $mgr_notes) {
        $mm = substr($id, 0, 2);
        $dd = substr($id, 3, 2);
        $yy = substr($id, 6, 2);
        if (!checkdate($mm, $dd, $yy)) {
            $this->id = null;
            echo "Error: invalid date for RMHdate constructor " . $mm . $dd . $yy;
            return;
        }
        $my_date = mktime(0, 0, 0, $mm, $dd, $yy);
        $this->id = date("m-d-y", $my_date);
        $this->month = date("M", $my_date);
        $this->day = date("D", $my_date);
        $this->year = date("Y", $my_date);
        $this->day_of_week = date("N", $my_date);
        $this->day_of_year = date("z", $my_date) + 1;
        $this->dom = date("d", $my_date);
        $this->month_num = date("m", $my_date);
        if (sizeof($shifts) !== 0)
            $this->shifts = $shifts;
        else
            $this->generate_shifts($this->day_of_week);
        $this->mgr_notes = $mgr_notes;
    }

    /*
     * Generate all shifts for all venues and groups on a given date, 
     * using the master schedule as a template
     */

    function generate_shifts($day) {
    	$venues = array("weekly");
        $days = array(1 => "Mon", 2 => "Tue", 3 => "Wed", 4 => "Thu", 5 => "Fri", 6 => "Sat", 7 => "Sun");
        $weekdaygroups = array("odd", "even");
        $weekendgroups = array("1st", "2nd", "3rd", "4th", "5th");
        $this->shifts = array();
        /* $master[$i] is an array of 
         * (venue, my_group, day, time, start, end, slots, persons, notes)
         */
        foreach ($venues as $venue) {
            if ($days[$day] == "Sat" || $days[$day] == "Sun")
                $groups = $weekendgroups;
            else
                $groups = $weekdaygroups;
        	foreach ($groups as $group) {
        	  $master = get_master_shifts($venue, $group, $days[$day]);
        	  for ($i = 0; $i < sizeof($master); $i++) {
                $t = $master[$i]->get_time();
                $this->shifts[$t] = new Shift(
                    $this->id . "-" . $t, $venue, $master[$i]->get_slots(), null, null, "", "");
              }
        	}
        }
    }

    /*
     * @return "mm-dd-yy"
     */

    function get_id() {
        return $this->id;
    }

    function get_dom() {
        return $this->dom;
    }

    /*
     * @return the textual day of the week
     */

    function get_day() {
        return $this->day;
    }

    /*
     * @return the numerical day of the week
     */

    function get_day_of_week() {
        return $this->day_of_week;
    }

    /*
     * @return the numerical day of the year (starting at 1)
     */

    function get_day_of_year() {
        return $this->day_of_year;
    }

    /*
     * @return the year
     */

    function get_year() {
        return $this->year;
    }

    /*
     * @return the shifts
     */

    function get_shifts() {
        return $this->shifts;
    }

    /*
     * @return the number of shifts for this day
     */

    function get_num_shifts() {
        return count($this->shifts);
    }

    /*
     * @return a shift
     * @param the shift's key
     */

    function get_shift($key) {
        return $this->shifts[$key];
    }

    /**
     * if there's a shift starting at $shift_start for the given venue, return its id.
     * Otherwise, return false
     */
    function get_shift_id($shift_start, $venue) {
    	if ($shift_start==21) {
        	$candidate = $this->get_id() . "-overnight";
        	foreach ($this->shifts as $shift) 
                if ($shift->get_id() == $candidate)
                    return $shift->get_id();
    	}
        else for ($i = $shift_start + 1; $i < 22; $i++) {
        	$candidate = $this->get_id() . "-" . $shift_start . "-" . $i;
            foreach ($this->shifts as $shift) 
                if ($shift->get_id() == $candidate)
                    return $shift->get_id();
        }
        return false;
    }

    /*
     * replace a shift by a new shift in a date's associative array of shifts
     * @param the shift, the new shift
     */

    function replace_shift($shift, $newshift) {
        $newshifts = array();
        foreach ($this->shifts as $key => $value)
            if ($this->get_shift($key)->get_id() === $shift->get_id())
                $newshifts[$newshift->get_id()] = $newshift;
            else
                $newshifts[$key] = $value;
        $this->shifts = $newshifts;
        return $this;
    }

    /**
     * @return a string name of the date
     */
    function get_name() {
        return date("F j, Y", mktime(0, 0, 0, $this->month_num, $this->dom, $this->year));
    }

    function get_end_time() {
        return mktime(23, 59, 59, $this->month_num, $this->dom, $this->year);
    }

    function get_mgr_notes() {
        return $this->mgr_notes;
    }

    function set_mgr_notes($s) {
        $this->mgr_notes = $s;
    }

}
?>