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
	<B>Step 2:</B> If you wish to view total volunteer hours or shifts
	staffed/vacancies, skip this step and go to <B>Step 3</B>. <BR>
	<BR>If you wish to see a report on a specific volunteer, select
	"Volunteer Names (and total hours)." Then under "Volunteer name(s)",
	enter the volunteer's name. <BR>
	<BR> <a href="tutorial/screenshots/reportsstep2.png" class="image"
		title="reportsstep2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep2.png" border="1px"
		align="center"> </a> <BR>
	<BR> Note that when you type in a few letters, a box should appear with
	names containing those letters. You can choose the name by clicking it.
	<BR>
	<BR> <a href="tutorial/screenshots/reportsstep2-2.png" class="image"
		title="reportsstep2-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep2-2.png"
		border="1px" align="center"> </a> <BR>
	<BR>If you wish to look at more than one volunteer, you can either
	press the "Enter" key to add more rows or click on the "add more"
	button. <BR>
	<BR> <a href="tutorial/screenshots/reportsstep2-3.png" class="image"
		title="reportsstep2-3.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep2-3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep2-3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep2-3.png"
		border="1px" align="center"> </a>
<p>
	<B>Step 3:</B> To view total volunteer hours, select "Volunteer Hours
	(by day)": <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep3.png" class="image"
		title="reportsstep3.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep3.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep3.png" border="1px"
		align="center"> </a> <BR>
	<BR>To view shifts staffed and vacancies, select "Shifts Staffed/Vacant
	(by day)": <BR>
	<BR>
	<a href="tutorial/screenshots/reportsstep3-2.png" class="image"
		title="reportsstep3-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep3-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep3-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep3-2.png"
		border="1px" align="center"> </a>
<p>
	<B>Step 4:</B> If you wish to view the entire history, skip this step
	and go to <B>Step 5</B>. <BR>
	<BR>If you wish to look at only last week's or last month's data, click
	on the corresponding option, like this: <BR>
	<BR> <a href="tutorial/screenshots/reportsstep4.png" class="image"
		title="reportsstep4.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep4.png" border="1px"
		align="center"> </a> <BR>
	<BR>If you wish to view hours during a specific date range, select the
	Date Range option and the following should appear: <BR>
	<BR> <a href="tutorial/screenshots/reportsstep4-2.png" class="image"
		title="reportsstep4-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep4-2.png"
		border="1px" align="center"> </a> <BR>
	<BR>Now if you click on the text box next to "from:" or "to:", a
	calendar should appear:<BR>
	<BR> <a href="tutorial/screenshots/reportsstep4-3.png" class="image"
		title="reportsstep4-3.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep4-3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep4-3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep4-3.png"
		border="1px" align="center"> </a> <BR> You can either enter the date
	in the format month/day/year or select a date on this calendar.
<p>
	<B>Step 5:</B> Then select the <B>Submit</B> button, like this:<BR> <BR>
	<a href="tutorial/screenshots/reportsstep5.png" class="image"
		title="reportsstep5.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep5.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep5.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep5.png" border="1px"
		align="center"> </a> <BR> Note that if you wish to view the entire
	history, you don't have to choose a date - just select <B>Submit</B>.
<p>
	<B>Step 6:</B> <BR>The report for <B>Volunteer Names</B> (and total
	hours) may look like this:<BR> <BR> <a
		href="tutorial/screenshots/reportsstep6.png" class="image"
		title="reportsstep6.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/reportsstep6.png" border="1px"
		align="center"> </a> <BR>The number under a day (eg. Mon) indicates
	the total hours worked on that day. In our example, Amy Jones did not
	work any hours from 11/03/2013 - 12/09/2013. <BR>
	<BR>The report for <B>Volunteer Hours</B> (by day) may look like this:
	<BR>
	<BR> <a href="tutorial/screenshots/reportsstep6-2.png" class="image"
		title="reportsstep6-2.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep6-2.png"
		border="1px" align="center"> </a> <BR>
	<BR>And the report for <B>Shifts Staffed/Vacant</B> (by day) may look
	like this: <BR>
	<BR> <a href="tutorial/screenshots/reportsstep6-3.png" class="image"
		title="reportsstep6-3.png" horizontalalign="center"
		target="tutorial/screenshots/reportsstep6-3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/reportsstep6-3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/reportsstep6-3.png"
		border="1px" align="center"> </a> <BR>For example, "Thu - Early
	Afternoon - 5/2" says that on Thursdays 12-3pm from 10/01/2013 to
	11/01/2013, there were 5 completely staffed shifts and 2 vacancies
	total.
<p>
	<B>Step 7:</B> When you finish, you can generate a new report by
	refreshing the page and following the steps above or return to any
	other function by selecting it on the navigation bar.