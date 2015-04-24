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
	<strong>How to Add or Remove a Slot from a Shift</strong>
<p>
	To begin, you must have already selected <strong>(edit this week)</strong>
	on the top left of the calendar:
<p>
	<B>Step 1:</B> Click on a calendar shift, like this:<BR> <BR> <a
		href="tutorial/screenshots/addSlotToShiftHelp_choose_shift.png"
		class="image" title="addSlotToShiftHelp_choose_shift.png"
		horizontalalign="center"
		target="tutorial/screenshots/addSlotToShiftHelp_choose_shift.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addSlotToShiftHelp_choose_shift.png"
		rel="popover"
		data-img="tutorial/screenshots/addSlotToShiftHelp_choose_shift.png"
		width="10%" border="1px" align="center"> </a> <br> <br> (Each upcoming
	calendar shift will turn gray whenever the mouse passes over it.)
<p>
	<B>Step 2:</B> This will give you a shift form that looks like this:<BR>
	<BR> <a href="tutorial/screenshots/addSlotToShiftHelp_shift_view.png"
		class="image" title="addSlotToShiftHelp_shift_view.png"
		horizontalalign="center"
		target="tutorial/screenshots/addSlotToShiftHelp_shift_view.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addSlotToShiftHelp_shift_view.png"
		rel="popover"
		data-img="tutorial/screenshots/addSlotToShiftHelp_shift_view.png"
		width="10%" border="1px" align="center"> </a>
<p>
	<B>Step 3:</B> Click on the <B>Add slot</B> button in the top row of
	the table, like this:<BR> <BR> <a
		href="tutorial/screenshots/addSlotToShiftHelp_add_slot.png"
		class="image" title="addSlotToShiftHelp_add_slot.png"
		horizontalalign="center"
		target="tutorial/screenshots/addSlotToShiftHelp_add_slot.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addSlotToShiftHelp_add_slot.png" width="10%"
		rel="popover"
		data-img="tutorial/screenshots/addSlotToShiftHelp_add_slot.png"
		border="1px" align="center"> </a>
<p>
	<B>Step 4:</B> A new vacant slot is added to the shift and appears as a
	new row. You can then assign a volunteer to this new slot.<BR> <BR> <a
		href="tutorial/screenshots/addSlotToShiftHelp_new_volunteer.png"
		class="image" title="addSlotToShiftHelp_new_volunteer.png"
		horizontalalign="center"
		target="tutorial/screenshots/addSlotToShiftHelp_new_volunteer.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addSlotToShiftHelp_new_volunteer.png"
		rel="popover"
		data-img="tutorial/screenshots/addSlotToShiftHelp_new_volunteer.png"
		width="10%" border="1px" align="center"> </a>
<p>
	<B>Step 5:</B> To remove a vacant slot from a shift, click on the <b>Remove
		Vacancy</b> button to the right of that slot, like this.<BR> <BR> <a
		href="tutorial/screenshots/addSlotToShiftHelp_remove_vacancy.png"
		class="image" title="addSlotToShiftHelp_remove_vacancy.png"
		horizontalalign="center"
		target="tutorial/screenshots/addSlotToShiftHelp_remove_vacancy.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/addSlotToShiftHelp_remove_vacancy.png"
		rel="popover"
		data-img="tutorial/screenshots/addSlotToShiftHelp_remove_vacancy.png"
		width="10%" border="1px" align="center"> </a> <br>Note: you cannot
	remove a slot that is not vacant without first removing the person from
	the slot.
<p>
	<B>Step 6:</B> You can return to any other function by selecting it on
	the navigation bar.