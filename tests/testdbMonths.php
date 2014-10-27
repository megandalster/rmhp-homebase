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
 * Created February 22, 2012
 * @Author Judy
 */


include_once(dirname(__FILE__).'/../domain/Month.php');
include_once(dirname(__FILE__).'/../database/dbMonths.php');

class testdbMonths extends UnitTestCase {
      function testdbMonthsModule() {

      	
      	//creates an empty dbMonths table
		//$this->assertTrue(create_dbMonths());
      	      	
      	// create a month to add to the table
      	$m1 = new Month("06-01-10", "One", "unpublished");
      	
      	
      	// test the insert function
      	$this->assertTrue(insert_dbMonths($m1));
      	
      	// test the retrieve function
      	$this->assertEqual(retrieve_dbMonths($m1->get_id())->get_id(), "06-01-10");
      	$this->assertEqual(retrieve_dbMonths($m1->get_id())->get_status(), "unpublished");
      	$this->assertEqual(retrieve_dbMonths($m1->get_id())->get_group(), "One");
      	$this->assertEqual(retrieve_dbMonths($m1->get_id())->get_end_of_month_timestamp(), mktime(0, 0, 0, 6, 30, 2010));
      	
      	
      	// test the update function
      	$m1->set_status("published");
      	$this->assertTrue(update_dbMonths($m1));
      	$this->assertEqual(retrieve_dbMonths($m1->get_id())->get_status(), "published");
      	
      	// tests the delete function
      	$this->assertTrue(delete_dbMonths($m1->get_id()));
      	echo("\ntestdbMonths complete\n");
      }
}

?>