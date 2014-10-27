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
 * reports page for RMH homebase.
 * @author Jerrick Hoang
 * @version 11/5/2013
 */
session_start();
session_cache_expire(30);
?>
<html>
<head>
<title>Search for data objects</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
	
</head>
<body>
<div id="container">
<?php 
include_once('header.php'); 
include_once('reports.inc.php');
include_once('database/dbPersons.php');
include_once('domain/Person.php');
include_once('database/dbShifts.php');
include_once('domain/Shift.php');

?> 
</div>

</body>