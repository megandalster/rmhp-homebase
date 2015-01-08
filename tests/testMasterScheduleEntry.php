<?php
/*
 * Copyright 2015 by ... and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/**
* Test suite for MasterScheduleEntry
* Created on January 7, 2015
* @author Allen Tucker
*/

//first I include the php file I'm testing
include_once(dirname(__FILE__).'/../domain/MasterScheduleEntry.php');

class testMasterScheduleEntry extends UnitTestCase {
	
	function testMasterScheduleEntryModule() {
		
		$new_MasterScheduleEntry = new MasterScheduleEntry("house","Wed", "1st", 13, 17, 2,
		"joe2071234567,sue2079876543", "This is a super fun shift.");
		
		//first assertion - check that a getter is working from the superconstructor's initialized data
		$this->assertTrue($new_MasterScheduleEntry->get_day()=="Wed");
		
		$this->assertTrue($new_MasterScheduleEntry->get_time()=="13-17");
		$this->assertTrue($new_MasterScheduleEntry->get_week_no(), "1st");
		$this->assertTrue($new_MasterScheduleEntry->get_slots()==2);
		$this->assertTrue($new_MasterScheduleEntry->get_persons()==array("joe2071234567","sue2079876543"));
		$this->assertTrue($new_MasterScheduleEntry->get_notes()=="This is a super fun shift.");
		$this->assertTrue($new_MasterScheduleEntry->get_id()=="houseWed1st-13-17");
		
		echo("testMasterScheduleEntry complete");
	}
}

?>
