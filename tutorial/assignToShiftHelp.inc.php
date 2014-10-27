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
	<strong>How to Fill a Vacancy</strong>
<p>
	To fill a vacancy, you must have already selected <strong>(edit this
		week)</strong> at the top of the calendar.
<p>
	<B>Step 1:</B> Now click on a calendar shift that has a vacancy, like
	this:<BR> <BR> <a
		href="tutorial/screenshots/assignToShiftHelp_vacant_shift.png"
		class="image" title="assignToShiftHelp_vacant_shift.png"
		horizontalalign="center"
		target="tutorial/screenshots/assignToShiftHelp_vacant_shift.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/assignToShiftHelp_vacant_shift.png"
		rel="popover"
		data-img="tutorial/screenshots/assignToShiftHelp_vacant_shift.png"
		width="10%" border="1px" align="center"> </a> <br> <br> (Each upcoming
	calendar shift will turn gray whenever the mouse passes over it. Shifts
	for prior days on the calendar cannot be edited in this way.)
<p>
	<B>Step 2:</B> This will give you a shift form that looks like this:<BR>
	<BR> <a href="tutorial/screenshots/assignToShiftHelp_shift_view.png"
		class="image" title="assignToShiftHelp_shift_view.png"
		horizontalalign="center"
		target="tutorial/screenshots/assignToShiftHelp_shift_view.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/assignToShiftHelp_shift_view.png"
		rel="popover"
		data-img="tutorial/screenshots/assignToShiftHelp_shift_view.png"
		width="10%" border="1px" align="center"> </a>
<p>
	<B>Step 3:</B> Click on the <B>Assign Volunteer</B> button in the right
	hand column of a <B>vacant</B> row, like this:<BR> <BR> <a
		href="tutorial/screenshots/assignToShiftHelp_assign_volunteer.png"
		class="image" title="assignToShiftHelp_assign_volunteer.png"
		horizontalalign="center"
		target="tutorial/screenshots/assignToShiftHelp_assign_volunteer.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/assignToShiftHelp_assign_volunteer.png"
		rel="popover"
		data-img="tutorial/screenshots/assignToShiftHelp_assign_volunteer.png"
		width="10%" border="1px" align="center"> </a> <BR> <br>&nbsp&nbsp&nbsp
	NOTE: If there is no <B>vacant</B> row, then that shift has no
	vacancies to be filled.<BR> <BR>
<p>
	<B>Step 4:</B> You can now view the list of volunteers who are
	available for that shift, like this:<BR> <BR> <a
		href="tutorial/screenshots/assignToShiftHelp_volunteer_selection.png"
		class="image" title="assignToShiftHelp_volunteer_selection.png"
		target="tutorial/screenshots/assignToShiftHelp_volunteer_selection.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/assignToShiftHelp_volunteer_selection.png"
		rel="popover"
		data-img="tutorial/screenshots/assignToShiftHelp_volunteer_selection.png"
		width="10%" border="1px" align="middle"> </a> <br> <br>
	(Alternatively, you can view the entire list of volunteers, whether or
	not they are available for that shift.)
<p>
	<B>Step 5:</B> Select the volunteer you want to assign to this shift,
	and then click <B>Add Volunteer</B>, like this:<BR> <BR> <a
		href="tutorial/screenshots/assignToShiftHelp_volunteer_chosen.png"
		class="image" title="assignToShiftHelp_volunteer_chosen.png"
		target="tutorial/screenshots/assignToShiftHelp_volunteer_chosen.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/assignToShiftHelp_volunteer_chosen.png"
		rel="popover"
		data-img="tutorial/screenshots/assignToShiftHelp_volunteer_chosen.png"
		width="10%" border="1px" align="middle"> </a>
<p>
	<B>Step 6:</B> You can return to the shift form by selecting <strong>back
		to shift</strong>. You can return to any other function by selecting
	it on the navigation bar.