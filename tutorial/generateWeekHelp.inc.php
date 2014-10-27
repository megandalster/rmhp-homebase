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
	<strong>How to Generate and Publish Future Weeks on the Calendar
		(Managers Only)</strong>
</p>
<p>
	To begin this activity, select <B>(manage weeks)</B> at the top of any
	calendar page, like this:<BR> <BR> <a
		href="tutorial/screenshots/generateWeekHelp_manage_weeks.png"
		class="image" title="generateWeekHelp_manage_weeks.png"
		target="tutorial/screenshots/generateWeekHelp_manage_weeks.png"> <img
		src="tutorial/screenshots/generateWeekHelp_manage_weeks.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_manage_weeks.png"
		width="10%" border="1px"> </a>
</p>
<p>
	You should then see this page: <a
		href="tutorial/screenshots/generateWeekHelp_week_manager_view.png"
		class="image" title="generateWeekHelp_week_manager_view.png"
		target="tutorial/screenshots/generateWeekHelp_week_manager_view.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/generateWeekHelp_week_manager_view.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_week_manager_view.png"
		width="10%" border="1px" align="center"> </a>
<p>
	Each calendar week in this list has the status <i>archived</i>, <i>published</i>,
	or <i>unpublished</i>.
<ul>
	An
	<i>archived</i> week is any week that is fully in the past (as of the
	current date) -- its calendar cannot be changed.
	<br>A
	<i>published</i> week is is an active calendar week, visible and
	changeable by either managers or volunteers as schedule changes occur.
	<br>An
	<i>unpublished</i> week is a calendar week that is not visible to
	volunteers, and can only be changed or published by a manager.
</ul>
<p>
	The <strong> View Archive/Hide Archive</strong> button in the lower
	right corner of this table allows you to either see or not see the
	archived weeks from the table. (Most of the time you will not need to
	see the archived calendar weeks, so this button will simplify your view
	by showing only current and future scheduled weeks.)
<p>From here, you can do any of the following:
<ul>
	<li>Add a new week to the calendar from the master schedule</li>
	<li>Publish an unpublished week</li>
	<li>Unpublish a published week</li>
	<li>Remove the newest unpublished calendar week from the database</li>
	<li>Remove the oldest archived calendar week from the database

</ul>
<p>
	When you add a new week to the calendar, this will populate each day
	and shift with volunteers from the master schedule. Before generating a
	new calendar week it is important to be sure the master schedule is up
	to date. So this tutorial and the tutorial <strong>How to Manage the
		Master Schedule</strong> go hand-in-hand.
<p>
	<B>Step 0:</B> (<i>You will do this step only once.</i>) When the
	system is first installed and you select <B>(manage weeks)</B> on the
	at the top of the calendar, you will see the following form:
<p>
	<a href="tutorial/screenshots/generateWeekHelp_initialize_calendar.png"
		class="image" title="generateWeekHelp_initialize_calendar.png"
		horizontalalign="center"
		target="tutorial/screenshots/generateWeekHelp_week_initialize_calendar.png">
		&nbsp&nbsp&nbsp&nbsp <img
		src="tutorial/screenshots/generateWeekHelp_initialize_calendar.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_initialize_calendar.png"
		width="10%" border="1px" align="middle"> </a>
<p>
	This form asks you to select the Month, Day, Year, Weekday Group, and
	Weekend Group that will be used to populate the <i>very first</i> week
	on your calendar.
<p>
	For example, the above selections show that you chose the week with
	November 25, 2013, with the odd Weekday group, and 1st Weekend group to
	be the first scheduled calendar week. When you hit <b>submit</b>, the
	first week of your calendar will be populated and the following 1-row
	table will appear:
<p>
	<a href="tutorial/screenshots/generateWeekHelp_newly_added.png"
		class="image" title="generateWeekHelp_newly_added.png"
		target="tutorial/screenshots/generateWeekHelp_week_newly_added.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/generateWeekHelp_newly_added.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_newly_added.png"
		width="10%" border="1px" align="middle"> </a>
<p>
	<B>Step 1:</B> At any time in the future, you can use the <strong>Add
		new week</strong> button to generate and populate the next successive
	week on the calendar with volunteers from the Master Schedule.
<p>
	<a href="tutorial/screenshots/generateWeekHelp_add_new_week.png"
		class="image" title="generateWeekHelp_add_new_week.png"
		target="tutorial/screenshots/generateWeekHelp_add_new_week.png">
		&nbsp&nbsp&nbsp&nbsp <img
		src="tutorial/screenshots/generateWeekHelp_add_new_week.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_add_new_week.png"
		width="10%" border="1px" align="bottom"> </a>
<p>
	<B>Step 2:</B> So here is the result of adding the next calendar week
	following the week of September 29.
<p>
	<a href="tutorial/screenshots/generateWeekHelp_week_manager_view.png"
		class="image" title="generateWeekHelp_week_manager_view.png"
		horizontalalign="center"
		target="tutorial/screenshots/generateWeekHelp_week_manager_view.png">
		&nbsp&nbsp&nbsp&nbsp <img
		src="tutorial/screenshots/generateWeekHelp_week_manager_view.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_week_manager_view.png"
		width="10%" border="1px" align="middle"> </a>
<p>
	&nbsp&nbsp&nbsp Notice that this new week is populated with a different
	Weekday/Weekend/Family Room group from the Master Schedule. Since there
	are two weekday groups on the master schedule, each shift's volunteers
	in Group One (or Group Two) are scheduled every other week. <br>Notice
	also that you may choose which group is scheduled before adding a new
	week. Before you click the button, simply choose the weekday group,
	weekend group and family room group that will populate this new week.
<p>
	&nbsp&nbsp&nbsp Each week in this table is marked as <i>archived</i>, <i>published</i>,
	or <i>unpublished</i>:
<ul>
	An
	<i>archived</i> week is any week that is fully in the past (as of the
	current date) -- its calendar cannot be changed.
	<br>A
	<i>published</i> week is is an active calendar week, visible and
	changeable by either managers or volunteers as schedule changes occur.
	<br>An
	<i>unpublished</i> week is a future calendar week that is not yet
	visible to volunteers, and can only be changed by a manager.
</ul>
<p>
	&nbsp&nbsp&nbsp To view archived weeks click the <strong>View Archive</strong>
	button here: <a
		href="tutorial/screenshots/generateWeekHelp_view_archive.png"
		class="image" title="generateWeekHelp_view_archive.png"
		horizontalalign="center"
		target="tutorial/screenshots/generateWeekHelp_view_archive.png">
		&nbsp&nbsp&nbsp&nbsp <img
		src="tutorial/screenshots/generateWeekHelp_view_archive.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_view_archive.png"
		width="10%" border="1px" align="middle"> </a>
<p>
	&nbsp&nbsp&nbsp The <strong> View Archive/Hide Archive</strong> button
	allows you to either see or remove the archived weeks from the table. <br>
	<br> <a href="tutorial/screenshots/generateWeekHelp_archived_view.png"
		class="image" title="generateWeekHelp_archived_view.png"
		horizontalalign="center"
		target="tutorial/screenshots/generateWeekHelp_archived_view.png">
		&nbsp&nbsp&nbsp&nbsp <img
		src="tutorial/screenshots/generateWeekHelp_archived_view.png"
		rel="popover"
		data-img="tutorial/screenshots/generateWeekHelp_archived_view.png"
		width="10%" border="1px" align="middle"> </a>
<p>
	<B>Step 3:</B> You can now choose to <b>view</b>, <b>edit</b>, <b>publish</b>,
	or <b>remove</b> this week from the calendar using the buttons on the
	right.<br> <br>&nbsp&nbsp&nbsp The <b>view</b> button takes you to the
	calendar where you can view all the shift assignments for that week. <br>&nbsp&nbsp&nbsp
	The <b>edit</b> button takes you to the calendar where you can edit
	individual shifts for that week. <br>&nbsp&nbsp&nbsp The <b>publish/unpublish</b>
	button controls whether the week is visible and editable by any
	volunteer who is working at the front desk. <br>&nbsp&nbsp&nbsp The <b>remove</b>
	button removes the most recent unpublished week from the calendar.
	(This is rarely used, but will be handy when you want to regenerate and
	repopulate a new week using different groups from the Master Schedule.)

