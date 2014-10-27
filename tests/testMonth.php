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
 * Created on Feb 15, 2012
 * @author Judy
 */

include_once(dirname(__FILE__).'/../domain/Month.php');
class testMonth extends UnitTestCase {
	function testMonthModule(){
		
		$myMonth = new Month("02-01-12", "One", "published");
		
		
		$this->assertTrue($myMonth->get_id()=="02-01-12");
		$this->assertTrue($myMonth->get_group()=="One");
		$this->assertTrue($myMonth->get_status()=="published");
		$this->assertTrue($myMonth->get_end_of_month_timestamp()==1330491600);
		echo("testMonth complete");
	}
	
	
	
}

?>