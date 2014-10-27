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
class testdbPersons extends UnitTestCase {
      function testdbPersonsModule() {
      	//add a manager

//      	setup_dbPersons();
$m = new Person("Gabrielle","Booth", "female","14 Way St", "Harpswell", "ME", "04079","",
1112345678, 2071112345,"ted@bowdoin.edu","email", "Mother", 2077758989, "manager","","","active", "programmer", 
"Steve_2077291234","yes","","", "Mon:morning,Tue:morning","","","02-19-89", "03-14-08","","");
$this->assertTrue(add_person($m));
//get a person
$p = retrieve_person("Gabrielle1112345678");
$this->assertTrue($p!==false);
$this->assertTrue($p->get_status() == "active");
$this->assertTrue($p->get_occupation() == "programmer");
$this->assertEqual($p->get_refs(), array("Steve_2077291234"));
$this->assertTrue(remove_person("Gabrielle1112345678"));

echo("testdbPersons complete");

      }
}


?>
