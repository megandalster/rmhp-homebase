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
 * Modified March 2012
 * @Author Taylor and Allen
 */
include_once(dirname(__FILE__).'/../database/dbPersons.php');
include_once(dirname(__FILE__).'/../domain/Person.php');

class testdbPersons extends UnitTestCase {
      function testdbPersonsModule() {
      	// add a person to the database
		$m = new Person("Gabrielle","Booth", "female","14 Way St", "Harpswell", "ME", 04079,
		1112345679, 2071112345,7778889999,"ted@bowdoin.edu","volunteer","","","active", 
		"Steve_2077291234","yes","a motivation","a specialty", 
		"1st:Mon:9-1:house,3rd:Sun:5-9:fam","","","02-19-89", "03-14-08","02-02-14","other","Some notes","SomePassword");
		$this->assertTrue(add_person($m));
		
		// retrieve the person and test the fields
		$p = retrieve_person("Gabrielle1112345679");
		$this->assertTrue($p!==false);
		$this->assertTrue($p->get_status() == "active");
		$this->assertTrue($p->get_email() == "ted@bowdoin.edu");
		$this->assertEqual($p->get_type(), array("volunteer"));
		
		// remove the person
		$this->assertTrue(remove_person("Gabrielle1112345679"));
		
		echo("testdbPersons complete");

      }
}


?>
