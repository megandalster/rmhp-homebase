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
session_start();
session_cache_expire(30);
?>
<html>
<head>
<title>RMH Homebase</title>
</head>
<body>
	<p>
		<strong>Homebase Help Pages</strong>
	</p>
	<ol>
		<li><a href="?helpPage=quickStartGuide.php">Quick Start Guide</a>
		</li>
		<br>

		<li><a href="?helpPage=login.php">Signing in and out of the System</a>
		</li>
		<br>
		<ul>
			<li><a href="?helpPage=index.php">About your Personal Home Page</a></li>
		</ul>
		<br>
		<li><strong>Working with the Volunteer Database</strong> (Managers
			Only)</li>
		<br>
		<ul>
			<li><a href="?helpPage=searchPeople.php">Searching for People (and
					Phone Numbers)</a></li>
			<li><a href="?helpPage=edit.php">Editing People</a></li>
			<li><a href="?helpPage=rmh.php">Adding People </a></li>
		</ul>
		<br>
		<li><a href="?helpPage=addWeek.php">Working with the Calendar</a></li>
		<br>
		<ul>
			<li><a href="?helpPage=generateWeek.php">Generating and publishing
					new calendar weeks (Managers Only)</a></li>
			<li><strong>Editing a Shift on the Calendar</strong></li>
			<p>
			
			
			<ul>
				<li><a href="?helpPage=cancelShift.php">Canceling a Shift
						(Volunteers Only)</a></li>
				<li><a href="help.php?helpPage=addSlotToShift.php">Adding/removing a
						slot (Managers Only)</a></li>
				<li><a href="help.php?helpPage=addPersonToShift.php">Adding/removing
						a person from a shift</a></li>
				<li><a href="help.php?helpPage=subCallList.php">Using a Sub Call
						List (Managers Only)</a></li>
			</ul>
			<p>
			
			
			<li><a href="?helpPage=addNotes.php">Adding notes</a></li>
			<li><a href="?helpPage=navigateThroughWeeks.php">Navigate to
					Different Weeks</a></li>

		</ul>
		<br>
		<li><a href="?helpPage=masterSchedule.php">Working with the Master
				Schedule</a> (Managers Only)</li>
		<br>
		<li><a href="?helpPage=reports.php">Generating Reports</a> (Managers
			Only)</li>
		<br>
		<li><a href="?helpPage=dataExport.php">Generating CSVs (Excel
				Spreadsheets) from Volunteer Database</a> (Managers Only)</li>

	</ol>
	<p>
		If these help pages don't answer your questions, please contact the <a
			href="mailto:housemgr@rmhportland.org">House Manager</a> or call the
		front desk (207-780-6282).
	</p>
</body>
</html>

