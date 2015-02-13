<?php
/*
 * Copyright 2015 by Adrienne Beebe, Yonah Biers-Ariel, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * @author Max Palmer, Yonah Biers-Ariel
 * @version June 2008, modified February 5, 2015 
 */
include_once(dirname(__FILE__).'/../domain/RMHdate.php');
class testRMHdate extends UnitTestCase {
      function testRMHdateModule() {
        $my_shifts[] = new Shift("02-28-10:9-1:house", "house", 1, array(), array(), null ,"");
 		$my_date = new RMHdate("02-28-10","house",$my_shifts,"");
		$my_shifts = $my_date->get_shifts();
        foreach ($my_shifts as $value)
	        $this->assertTrue($value instanceof Shift);
 		$this->assertTrue($my_date->get_id() == "02-28-10:house");
 		$this->assertTrue($my_date->get_day() == "Sun");
 		$this->assertTrue($my_date->get_day_of_week() == 7);
 		$this->assertTrue($my_date->get_day_of_year() == 59);
 		$this->assertTrue($my_date->get_year() == 2010);
 		$this->assertTrue($my_date->get_week_of_month()==4);
 		$this->assertTrue($my_date->get_week_of_year()=="even");

 		echo("testRMHdate complete");
      }
}
?>
