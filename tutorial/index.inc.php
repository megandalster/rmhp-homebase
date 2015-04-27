<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
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
	<p>
	    <a href="?helpPage=rmhp-homebase/helpPageTemplate.php">Help Page Template</a>
	</p>
	<ol>
		<li><a href="?helpPage=rmhp-homebase/login.php">Signing in and out of the System</a>
		</li>
		<br>
		<ul>
			<li><a href="?helpPage=rmhp-homebase/index.php">About your Personal Home Page</a></li>
			<li><a href="?helpPage=rmhp-homebase/volunteerLog.php">Logging Your Hours (Volunteers Only)</a></li>
		
		</ul>
		<br>
		<li><strong>Working with the Volunteer Database</strong> (Managers
			Only)</li>
		<br>
		<ul>
			<li><a href="?helpPage=rmhp-homebase/personSearch.php">Searching for People (and
					Phone Numbers)</a></li>
			<li><a href="?helpPage=rmhp-homebase/personEdit.php">Editing People</a></li>
			<li><a href="?helpPage=rmhp-homebase/personAdd.php">Adding People </a></li>
		</ul>
		<br>
		<li><a href="?helpPage=rmhp-homebase/calendar.php">Working with the Calendar</a></li>
		<br>
		<ul>
			<li><a href="?helpPage=rmhp-homebase/addWeek.php">Generating and publishing
					new calendar weeks (Managers Only)
					</a></li>
			<li><strong>Editing a Shift on the Calendar</strong></li>
			<p>
			
			
			<ul>
				<li><a href="?helpPage=rmhp-homebase/cancelShift.php">Canceling a Shift
						</a></li>
				<li><a href="help.php?helpPage=rmhp-homebase/addSlotToShift.php">Adding/removing a
						slot (Managers Only)</a></li>
				<li><a href="help.php?helpPage=rmhp-homebase/addPersonToShift.php">Adding/removing
						a person from a shift</a></li>
				<li><a href="help.php?helpPage=rmhp-homebase/subCallList.php">Using a Sub Call
						List (Managers Only)</a></li>
			</ul>
			<p>
			
			
			<li><a href="?helpPage=rmhp-homebase/addNotes.php">Adding notes</a></li>
			<li><a href="?helpPage=rmhp-homebase/navigateThroughWeeks.php">Navigate to
					Different Weeks</a></li>

		</ul>
		<br>
		<li><a href="?helpPage=rmhp-homebase/viewSchedule.php">Working with the Master
				Schedule</a> (Managers Only)</li>
		<br>
		<li><a href="?helpPage=rmhp-homebase/reports.php">Generating Reports</a> (Managers
			Only)</li>
		<br>
		<li><a href="?helpPage=rmhp-homebase/dataExport.inc.php">Generating CSVs (Excel
				Spreadsheets) from Volunteer Database</a> (Managers Only)</li>

	</ol>
	<p>
		If these help pages don't answer your questions, please contact the <a
			href="mailto:jpowers@rmhprovidence.org">Volunteer Coordinator</a> or call the
		front desk (401-274-4447).
	</p>
</body>
</html>

