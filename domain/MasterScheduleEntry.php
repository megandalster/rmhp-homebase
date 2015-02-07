<?php
/*
 * Copyright 2015 by Adrienne Beebe, Yonah Biers-Ariel, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/**
 * MasterScheduleEntry class for RMHP-Homebase.
 * @author Allen Tucker
 * @version January 2, 2015
 */

class MasterScheduleEntry {
	private $venue; 		// "house" or "fam" for House or Family Room
	private $day;           // "Mon", "Tue", ... "Sun"
	private $week_no;       // week of month 1st-5th, or week of year 'odd' or 'even'
	private $hours;    		// "9-1", "1-5", "5-9", or "night"
	private $slots;         // the number of slots to be filled for this shift
	private $persons;       // array of ids, eg ["alex2071234567", "jane1112345567"]
	private $notes;         // notes to be displayed for this entry
	private $id;	        // unique string for each entry = week_no:day:hours:venue
	  
	/**
	* constructor for all MasterScheduleEntries
	*/
	function __construct($venue, $day, $week_no, $hours, $slots, $persons, $notes){
		$this->venue = $venue;
		$this->day = $day;
		$this->week_no = $week_no;
		$this->hours = $hours;
		$this->slots = $slots;
		if ($persons !== "")
			$this->persons = explode(',',$persons);
		else
			$this->persons = array();
		$this->notes = $notes;
		$this->id = $week_no.":".$day.":".$hours.":".$venue;
	}
	
	/**
	*  getter functions
	*/
	
	function get_venue(){
		return $this->venue;
	}
	function get_day(){
		return $this->day;
	}
	function get_week_no(){
		return $this->week_no;
	}
	function get_hours(){ 
		return $this->hours;
	}
	function get_slots(){
		return $this->slots;
	}
	function get_persons(){
		return $this->persons;
	}
	function get_notes(){
		return $this->notes; 
	}
	function get_id(){
		return $this->id;
	}
	
	function set_notes($notes){
		$this->notes = $notes; 
	}
	
	
}

?>