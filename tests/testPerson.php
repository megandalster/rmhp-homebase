<?php
/*
 * Copyright 2015 by Adrienne Beebe, Yonah Biers-Ariel, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */

/**
 * Test suite for Person
 * Created on Feb 27, 2008, modified January 30, 2015
 * @author Taylor Talmage, Allen Tucker
 */

  //first I include the php file I'm testing
 include_once(dirname(__FILE__).'/../domain/Person.php');
 class testPerson extends UnitTestCase {
      function testPersonModule() {

 $myPerson = new Person("Susan","L","female","928 SU","Providence", "RI",04011, "",
      2074415902,2072654046,"susanl@aol.com", "email", "Mother", 2077758989, "volunteer",
      "","","active", "programmer", "Steve_2071234567,John_1234567890","yes","I like helping out","cooking",
      "1st:Mon:9-1:house,3rd:Sun:5-9:fam", "", "", "02-19-89", "03-14-08",
      "this is a note","Taylor2074415902");

 //first assertion - check that a getter is working from the superconstructor's initialized data
 $this->assertTrue($myPerson->get_first_name()=="Susan");

 $this->assertTrue($myPerson->get_type()==array("volunteer"));
 $this->assertTrue($myPerson->get_status()=="active");
 $this->assertTrue($myPerson->get_city()=="Providence");
 $this->assertTrue($myPerson->get_references()==array("Steve_2071234567","John_1234567890"));
 $this->assertEqual($myPerson->get_availability(),array("1st:Mon:9-1:house","3rd:Sun:5-9:fam"));
 // var_dump ($myPerson->get_availability());
 	$days = $myPerson->get_availdays();
 	$hours = $myPerson->get_availhours();
 	$venues = $myPerson->get_availvenues();
 	$this->assertTrue(in_array("1st:Mon",$days));
 	$this->assertTrue(in_array("9-1",$hours));
 	$this->assertTrue(in_array("house",$venues));
 $this->assertTrue($myPerson->get_last_name() !== "notMyLastName");
 $this->assertTrue($myPerson->get_contact_preference()=="email");
 $this->assertTrue($myPerson->get_emergency_contact()=="Mother");
 $this->assertTrue($myPerson->get_emergency_phone()==2077758989);
 $this->assertTrue($myPerson->get_gender()=="female");
 echo("testPerson complete");
      }
 }

?>
