<?php
/*
 * Copyright 2015 by Adrienne Beebe, Yonah Biers-Ariel, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */

include_once(dirname(__FILE__).'/../domain/Week.php');
class testWeek extends UnitTestCase {
      function testWeekModule() {
      	 $days = array();
      	 for($i=6;$i<13;$i++) {
      	 	$days[] = new RMHDate(date('m-d-y',mktime(0,0,0,2,$i,2012)),array(),"");
      	 }
         $aweek = new Week($days,"house","archived");
         $this->assertEqual($aweek->get_name(), "February 6, 2012 to February 12, 2012");
		 $this->assertEqual($aweek->get_id(), "02-06-12");
		 $this->assertTrue(sizeof($aweek->get_dates()) == 7);
		 $this->assertEqual($aweek->get_venue(), "house");
		 $this->assertEqual($aweek->get_status(), "archived");
		 $this->assertEqual($aweek->get_end(), mktime(23,59,59,2,12,2012));

 		 echo ("testWeek complete");
  	  }
}

?>
