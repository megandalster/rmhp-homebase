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
	<strong>How to Manage the Master Schedule</strong>
<p>The Master Schedule is grouped into the following 7 tables: Odd
	weeks, even weeks, and the first through fifth weekends. Below we will
	show how to work with the odd weeks table. The same steps can be
	followed when working with any other table.
<p>
	<B>Step 1:</B> On the navigation bar, select <B>master schedules</B>
	and if you scroll down you will see seven tables. The first shows the
	persons scheduled for the <strong>odd weeks</strong> of the year, and
	the second shows the persons scheduled for the even weeks. Here is an <strong>odd
		weeks</strong> sample table with the persons already scheduled: <br> <br>
	<a href="tutorial/screenshots/schedulingstep1.png" class="image"
		title="schedulingstep1.png" horizontalalign="center"
		target="tutorial/screenshots/schedulingstep1.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep1.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep1.png"
		border="1px" align="middle"> </a> <br> <br> A "shift" is shown as a
	box associated with a particular day (e.g., Thursday) and time slot
	(e.g., 6-9pm). If a shift has vacancies, the number of vacancies is
	shown in <strong>boldface</strong>. For example, the Friday 12-3pm
	shift has one vacancy in the <strong>odd week</strong> schedule shown
	above.
<p>
	<B>Step 2:</B> If you want to fill a vacancy for a shift, you must
	first select it. For example, suppose you want to add a person to fill
	the Friday 12-3pm vacancy and click on that shift on the schedule. <br>
<p>
	<B>Step 3:</B> Now you will see a shift worksheet for the Friday 12-3pm
	shift. You can find out who's available for that shift by selecting the
	<strong>Assign Volunteer</strong> button, like this: <br> <br> <a
		href="tutorial/screenshots/schedulingstep3.png" class="image"
		title="schedulingstep3.png"
		target="tutorial/screenshots/schedulingstep3.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep3.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 4:</B> You can either select from the group of volunteers with
	Friday 12-3pm availability or select from all volunteers: <br> <br> <a
		href="tutorial/screenshots/schedulingstep4.png" class="image"
		title="schedulingstep4.png"
		target="tutorial/screenshots/schedulingstep4.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep4.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep4.png"
		border="1px" align="middle"> </a>
<p>
	To select a volunteer, click on the appropriate drop down menu and then
	click on his/her name. <br> <br> <a
		href="tutorial/screenshots/schedulingstep4-2.png" class="image"
		title="schedulingstep4-2.png"
		target="tutorial/screenshots/schedulingstep4-2.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep4-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep4-2.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 5:</B> You can select, say, Evelyn Jones to fill that shift and
	then select <strong>Add Volunteer</strong>, like this: <br> <br> <a
		href="tutorial/screenshots/schedulingstep5.png" class="image"
		title="schedulingstep5.png"
		target="tutorial/screenshots/schedulingstep5.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep5.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep5.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 6:</B> Upon clicking <B>Add Volunteer</B>, you have now
	successfully added Evelyn Jones to the Friday 12-3pm shift, and the
	name should appear here: <br> <br> <a
		href="tutorial/screenshots/schedulingstep6.png" class="image"
		title="schedulingstep6.png" horizontalalign="center"
		target="tutorial/screenshots/schedulingstep6.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep6.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep6.png"
		border="1px" align="middle"> </a> <br> <br> Selecting <strong>Back to
		Master Schedule</strong> will also show Evelyn Jones on the Master
	Schedule: <br> <br> <a
		href="tutorial/screenshots/schedulingstep6-2.png" class="image"
		title="schedulingstep6-2.png" horizontalalign="center"
		target="tutorial/screenshots/schedulingstep6-2.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep6-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep6-2.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 7:</B> Five other <strong>Master Schedule</strong> functions
	are available. You can add or remove an entire shift, remove a person
	from a slot, and add or remove a slot from a shift.
<ul>
	<li>To add a new shift, select an unscheduled (dark gray) slot on the
		Master Schedule and then select a new <strong>starting time</strong>
		and <strong>ending time</strong> on the worksheet that appears.
	
	<li>To remove an existing shift from the Master Schedule, select <strong>Remove
			Entire Shift</strong> on top of the worksheet shown in <B>Step 3</B>.






	
	
	<li>To remove a person from a shift, select <strong>Remove
			Person/Create Vacancy</strong> on the worksheet shown in <B>Step 3</B>.






	
	
	<li>To add a new slot to a shift, select <strong>Add Slot</strong> on
		the worksheet shown in <B>Step 3</B>.
	
	<li>To remove a vacant slot from a shift, select <strong>Remove Vacant
			Slot</strong> on the worksheet shown in <B>Step 3</B>.

</ul>
<p>
	Suppose that, instead of filling the other vacant slot in the Friday
	12-3pm shift, you decide that Evelyn Jones can handle the shift alone.
	You can remove the vacant slot by selecting <strong>Remove Vacant Slot</strong>,
	which leaves this: <br> <br> <a
		href="tutorial/screenshots/schedulingstep7.png" class="image"
		title="schedulingstep7.png" horizontalalign="center"
		target="tutorial/screenshots/schedulingstep7.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep7.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep7.png"
		border="1px" align="middle"> </a> <br>
<p>
	And on the master schedule: <br> <br> <a
		href="tutorial/screenshots/schedulingstep7-2.png" class="image"
		title="schedulingstep7-2.png" horizontalalign="center"
		target="tutorial/screenshots/schedulingstep7-2.png">&nbsp&nbsp&nbsp&nbsp
		<img src="tutorial/screenshots/schedulingstep7-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/schedulingstep7-2.png"
		border="1px" align="middle"> </a>
<p>
	<B>Step 8:</B> When you finish, you can return to any other function by
	selecting it on the navigation bar.