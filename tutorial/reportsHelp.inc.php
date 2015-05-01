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
?>
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
<script
	src="lib/bootstrap/js/bootstrap.js"></script>

<script>
	$(function () {
		$('img[rel=popover]').popover({
			  html: true,
			  trigger: 'hover',
			  placement: 'right',
			  content: function(){return '<img border="3" src="'+$(this).data('img') + '" width="60%"/>';}
			});
	});
</script>

<p>
	<strong>How to Generate Reports</strong>
<p>
	<B>Step 1:</B> On the navigation bar at the top of the page, find <B>reports</B>
	, like this:<BR> <BR> <a href="tutorial/screenshots/reportsstep1.png"
		class="image" title="reportsstep1.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep1.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep1.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep1.png" border="1px"
		align="center"> </a> <BR>
	<BR>Click on it and you should see the following page: <BR>
	<BR> <a href="tutorial/screenshots/reportsstep1-2.png" class="image"
		title="reportsstep1-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep1-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep1-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep1-2.png"
		border="1px" align="center"> </a>
<p>
	<B>Step 2:</B> If you wish to view total volunteer hours, select "Total Hours", and you can 
	pick up a specific date range or venue, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep2.png" class="image"
		title="reportsstep2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep2.png" border="1px"
		align="center"> </a> <BR>
	<BR> Note that if you wish to view the entire volunteer hours in system, you don't 
	have to choose a date or venue - just click on <B>Submit</B> button. <BR>
	<BR> You will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep2-2.png" class="image"
		title="reportsstep2-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep2-2.png" border="1px"
		align="center"> </a> <BR>
<p>
	<B>Step 3:</B> If you wish to view total shifts or vacancies, select "Shifts/Vacancies", and you can 
	pick up a specific date range or venue, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep3.png" class="image"
		title="reportsstep3.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep3.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep3.png" border="1px"
		align="center"> </a> <BR>
	<BR> Note that if you wish to view the entire shifts or vacancies in system, you don't 
	have to choose a date or venue - just click on <B>Submit</B> button. <BR>
	<BR> You will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep3-2.png" class="image"
		title="reportsstep3-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep3-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep3-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep3-2.png" border="1px"
		align="center"> </a> <BR>
		
<p>
	<B>Step 4:</B> If you wish to view the volunteer birthday report, select "Volunteer Birthdays", and pick
	a venue, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep4.png" class="image"
		title="reportsstep4.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep4.png" border="1px"
		align="center"> </a> <BR>
	<BR> Note that if you wish to view the entire volunteer birthdays' report in system, you don't 
	have to choose a venue - just click on <B>Submit</B> button. <BR>

	<BR> You will see a report like this (ordered by month): <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep4-2.png" class="image"
		title="reportsstep4-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep4-2.png" border="1px"
		align="center"> </a> <BR>
<p>
	<B>Step 5:</B> If you wish to view the volunteer history report, select "Volunteer History", 
	and then just click on <B>Submit</B> button, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep5.png" class="image"
		title="reportsstep5.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep5.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep5.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep5.png" border="1px"
		align="center"> </a> <BR>
	<BR> You will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep5-2.png" class="image"
		title="reportsstep5-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep5-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep5-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep5-2.png" border="1px"
		align="center"> </a> <BR>
<p>
	<B>Step 6:</B> If you wish to view the contact information of volunteers in the database, 
	select "Volunteer Contact Info", and then just click on <B>Submit</B> button, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep6.png" class="image"
		title="reportsstep6.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep6.png" border="1px"
		align="center"> </a> <BR>
	<BR> You will see a report like this: <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep6-2.png" class="image"
		title="reportsstep6-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep6-2.png" border="1px"
		align="center"> </a> <BR>
<p>
	<B>Step 7:</B> For the three starred options, you can also download the .csv files 
	for these reports by checking the box on the right. 
	If you would like to know more about how to <b>generate CSVs (Excel Spreadsheets)</b> from Volunteer Database, 
	please click <a href="?helpPage=rmhp-homebase/dataExport.inc.php">here. 