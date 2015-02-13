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

/*
 * Created on Feb 24, 2008
 * @author max
 */
include_once(dirname(__FILE__).'/../database/dbShifts.php');
include_once(dirname(__FILE__).'/../database/dbDates.php');
class testdbShifts extends UnitTestCase {
  function testdbShiftsModule() {
	$s1=new Shift("02-25-08:1-5","house", 3, array(), array(), "", "");
	$this->assertTrue(insert_dbShifts($s1));
	$this->assertTrue(delete_dbShifts($s1));
	$s2=new Shift("02-25-08:9-1","house",3, array(), array(), "", "");
	$this->assertTrue(insert_dbShifts($s2));
	$s2=new Shift("02-25-08:5-9","house",2, array(), array(), "", "");
	$this->assertTrue(update_dbShifts($s2));
	$shifts[] = $s2;
	$this->assertTrue(delete_dbShifts($s2));
	echo ("testdbShifts complete");
  }
}
?>
