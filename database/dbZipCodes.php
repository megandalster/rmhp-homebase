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
 * Functions to create, retrieve, update, and delete information from the
 * dbZipCodes table in the database.    
 * @version October 25, 2011
 * @author Allen
 */

include_once(dirname(__FILE__).'/dbinfo.php');

/**
 * Create the dbZipCodes table with the following fields:
 * zip: 5-character numeric string for a Maine zip code
 * district: postal district represented by the zip code
 * city: city or town where the zip code resides
 * county: Maine county where this city resices
 */
function create_dbZipCodes() {
    connect();
    mysql_query("DROP TABLE IF EXISTS dbZipCodes");
    $result=mysql_query("CREATE TABLE dbZipCodes (zip text NOT NULL, district VARCHAR(30),
								city TEXT, county TEXT)");
    if(!$result) {
		echo mysql_error() . ">>>Error creating dbZipCodes table. <br>";
	    return false;
    }
    $filename = "mainezipcodes.csv";
	if (!$handle = fopen($filename, "r")) {
	    echo ("Error opening zip codes csv file");
	    return false;
	}
	$aline = array();
	while ($aline = fgetcsv($handle)) {
	    $district = ucwords(ltrim($aline[1]));
	    $city = ucwords(ltrim($aline[2]));
	    $county = ucwords(ltrim($aline[3]));
	    insert_dbZipCode($aline[0],$district,$city,$county);
	}
    fclose($handle);
	mysql_close();	
    
    return true;
}

/**
 * Inserts a new entry into the dbZipCodes table
 * @param $loaner = the loaner to insert
 */
function insert_dbZipCode ($zip,$district,$city,$county) {
    
    connect();
    $query = "SELECT * FROM dbZipCodes WHERE zip ='".$zip."'";
    $result = mysql_query ($query);
    if (mysql_num_rows($result)!=0) {
        delete_dbZipCodes ($zip);
        connect();
    }
    $query="INSERT INTO dbZipCodes VALUES ('".
				$zip."','".
				$district."','".
				$city."','".
				$county."')";
	$result=mysql_query($query);
    if (!$result) {
		echo (mysql_error()."unable to insert into dbZipCodes: ".$zip."\n");
		mysql_close();
        return false;
    }
    mysql_close();
    return true;
 }

/**
 * Retrieves an entry from the dbZipCodes table
 * result is a 4-entry associative array [zip, district, city, county]
 */
function retrieve_dbZipCodes ($zip, $district) {
	connect();
	if ($district=="")
        $query = "SELECT * FROM dbZipCodes WHERE zip = \"".$zip."\"";
    else 
        $query = "SELECT * FROM dbZipCodes WHERE district =\"".$district."\"";
    $result = mysql_query ($query);
    if (mysql_num_rows($result)==0) {
	    mysql_close();
		return false;
	}
	$result_row = mysql_fetch_assoc($result);
	mysql_close();
	return array($result_row['zip'], $result_row['district'], $result_row['city'], $result_row['county']);
}

/**
 * Updates a loaner in the dbLoaners table by deleting it and re-inserting it
 * @param $loaner the week to update
 */
function update_dbZipCodes ($zip, $district, $city, $county) {
	
	if (delete_dbZipCodes($zip))
	   return insert_dbZipCodes($zip, $district, $city, $county);
	else {
	   echo (mysql_error()."unable to update dbZipCodes table: ".$zip);
	   return false;
	}
}

/**
 * Deletes an entry from the dbZipCodes table
 */
function delete_dbZipCodes($zip) {
	connect();
    $query="DELETE FROM dbZipCodes WHERE id=\"".$zip."\"";
	$result=mysql_query($query);
	mysql_close();
	if (!$result) {
//		echo (mysql_error()."unable to delete from dbZipCodes: ".$id);
		return false;
	}
    return true;
}

?>
