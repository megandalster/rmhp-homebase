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
 * Test suite for Person
 * Created on Feb 27, 2008
 * @author Taylor Talmage
 */

  //first I include the php file I'm testing
 include_once(dirname(__FILE__).'/../domain/Person.php');
 class testPerson extends UnitTestCase {
      function testPersonModule() {

 $myPerson = new Person("Taylor","Talmage","male","928 SU","Brunswick","ME",04011, "",
      2074415902,2072654046,"ttalmage@bowdoin.edu", "email", "Mother", 2077758989, "volunteer",
      "","","active", "programmer", "Steve_2071234567,John_1234567890","yes","I like helping out","cooking",
      "Mon:morning,Tue:morning,Wed:earlypm", "", "", "02-19-89", "03-14-08",
      "this is a note","Taylor2074415902");

 //first assertion - check that a getter is working from the superconstructor's initialized data
 $this->assertTrue($myPerson->get_first_name()=="Taylor");

 $this->assertTrue($myPerson->get_type()==array("volunteer"));
 $this->assertTrue($myPerson->get_status()=="active");
 $this->assertTrue($myPerson->get_occupation()=="programmer");
 $this->assertTrue($myPerson->get_references()==array("Steve_2071234567","John_1234567890"));
 $this->assertEqual($myPerson->get_availability(),array("Mon:morning","Tue:morning","Wed:earlypm"));
 $this->assertTrue($myPerson->get_last_name() !== "notMyLastName");
 $this->assertTrue($myPerson->get_contact_preference()=="email");
 $this->assertTrue($myPerson->get_emergency_contact()=="Mother");
 $this->assertTrue($myPerson->get_emergency_phone()==2077758989);
 $this->assertTrue($myPerson->get_gender()=="male");
 echo("testPerson complete");
      }
 }

?>
