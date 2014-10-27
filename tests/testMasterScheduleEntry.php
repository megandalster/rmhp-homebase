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
* Test suite for MasterScheduleEntry
* Created on Feb 15, 2012
* @author Johnny Coster
*/

//first I include the php file I'm testing
include_once(dirname(__FILE__).'/../domain/MasterScheduleEntry.php');

class testMasterScheduleEntry extends UnitTestCase {
	
	function testMasterScheduleEntryModule() {
		
		$new_MasterScheduleEntry = new MasterScheduleEntry("monthly","Wed", "1st", 14, 17, 2,
		"joe2071234567,sue2079876543", "This is a super fun shift.");
		
		//first assertion - check that a getter is working from the superconstructor's initialized data
		$this->assertTrue($new_MasterScheduleEntry->get_day()=="Wed");
		
		$this->assertTrue($new_MasterScheduleEntry->get_time()=="14-17");
		$this->assertTrue($new_MasterScheduleEntry->get_week_no(), "1st");
		$this->assertTrue($new_MasterScheduleEntry->get_slots()==2);
		$this->assertTrue($new_MasterScheduleEntry->get_persons()==array("joe2071234567","sue2079876543"));
		$this->assertTrue($new_MasterScheduleEntry->get_notes()=="This is a super fun shift.");
		$this->assertTrue($new_MasterScheduleEntry->get_id()=="monthlyWed1st-14-17");
		
		echo("testMasterScheduleEntry complete");
	}
}

?>
