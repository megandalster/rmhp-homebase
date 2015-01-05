<?php
/*
 * Copyright 2015 by ... and Allen Tucker. 
 * This program is part of RMHP-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
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
	private $start_time;    // start time for the shift (9 - 21), or "night" or "any" (for any time of day)
	private $end_time;		// end time for the shift (9 - 21)
	private $slots;         // the number of slots to be filled for this shift
	private $persons;       // array of ids, eg ["alex2071234567", "jane1112345567"]
	private $notes;         // notes to be displayed for this shift on the schedule
	private $id;	        // unique string for each entry = venue.day.week."-".start_time."-".end_time
							//    or (for night shifts) = venue.day.week."-"."night"    

	/**
	* constructor for all MasterScheduleEntries
	*/
	function __construct($venue, $day, $week_no, $start_time, $end_time, $slots, $persons, $notes){
		$this->venue = $venue;
		$this->day = $day;
		$this->week_no = $week_no;
		$this->start_time = $start_time;
		$this->end_time = $end_time;
		$this->slots = $slots;
		if ($persons !== "")
			$this->persons = explode(',',$persons);
		else
			$this->persons = array();
		$this->notes = $notes;
		if ($start_time!=0)
			$this->id = $venue.$day.$week_no."-".$start_time."-".$end_time;
		else $this->id = $venue.$day.$week_no."-night";
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
	function get_start_time(){ 
		return $this->start_time;
	}
	function get_end_time(){
		return $this->end_time;
	}
	function get_time(){
		if ($this->start_time!="night")
			return $this->start_time."-".$this->end_time;
		else return "night";
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