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
      	// add two people to the database
		$m = new Person("Gabrielle","Booth", "female","14 Way St", "Harpswell", "ME", 04079,
		1112345679, 2071112345,7778889999,"ted@bowdoin.edu","volunteer","","","active", 
		"Steve_2077291234","yes","a motivation","a specialty", 
		"1st:Mon:9-1:house,3rd:Sun:5-9:fam","","01-05-15:0930-1300:house:3.5","02-19-89", "03-14-08","02-02-14","other","Some notes","SomePassword");
		$this->assertTrue(add_person($m));
		
		$m2 = new Person("Fred","Wilson", "male","14 Boyer Ave", "Walla Walla", "WA", 99362,
		5093456789, 5091112345,5098889999,"alfred@whitman.edu","volunteer","","","active", 
		"Alison_5097291234","yes","a motivation2","First Aid & AED", 
		"2nd:Wed:9-1:house,4th:Sun:5-9:house","","02-27-15:1730-2100:house:3.5","09-25-91","04-14-07", "03-30-15","other","Some notes","SomePassword");
		$this->assertTrue(add_person($m2));

		// retrieve the person and test the fields
		$p = retrieve_person("Gabrielle1112345679");
		$this->assertTrue($p!==false);
		$this->assertTrue($p->get_status() == "active");
		$this->assertTrue($p->get_email() == "ted@bowdoin.edu");
		$this->assertEqual($p->get_type(), array("volunteer"));
		$this->assertEqual($p->get_hours(), array("01-05-15:0930-1300:house:3.5"));
		$this->assertTrue($p->get_birthday() == "02-19-89");
		
		$p2 = retrieve_person("Fred5093456789");
		$this->assertTrue($p2!==false);
		$this->assertTrue($p2->get_status() == "active");
		$this->assertTrue($p2->get_email() == "alfred@whitman.edu");
		$this->assertEqual($p2->get_type(), array("volunteer"));
		$this->assertEqual($p2->get_hours(), array("02-27-15:1730-2100:house:3.5"));
		$this->assertTrue($p2->get_birthday() == "09-25-91");
		
		// remove the person
		$this->assertTrue(remove_person("Gabrielle1112345679"));
		$this->assertTrue(remove_person("Fred5093456789"));
		
		
		echo("testdbPersons complete");

      }
}


?>
