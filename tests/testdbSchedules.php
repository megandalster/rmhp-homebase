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
 * Created on March 3, 2008
 * @author allen
 */
include_once(dirname(__FILE__).'/../database/dbSchedules.php');
class testdbSchedules extends UnitTestCase {
  function testdbSchedulesModule() {
/*
	schedule_person("Rec", "One", "Mon", "9-12", "jane2077291234");
	$this->assertTrue (is_scheduled("Rec", "One", "Mon", "9-12", "jane2077291234"));
	schedule_person("Rec", "Two", "Mon", "9-12", "jane2077291234");
	$this->assertTrue (is_scheduled("Rec", "Two", "Mon", "9-12", "jane2077291234"));
    schedule_person("Rec", "One", "Thu", "15-18", "jane2077291234");
	$this->assertTrue (is_scheduled("Rec", "One", "Thu", "15-18", "jane2077291234"));
*/	
    echo("testdbSchedules complete");
  }
}
?>
