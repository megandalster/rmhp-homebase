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
	<strong>Navigate to Different Weeks</strong>
<p>
	Click the <b>Next Week</b> or <b>Previous Week</b> to navigate to
	different weeks: <br> <br> <a
		href="tutorial/screenshots/navigateThroughWeeksHelp_navigate_weeks.png"
		class="image" title="navigateThroughWeeksHelp_navigate_weeks.png"
		horizontalalign="center"
		target="tutorial/screenshots/navigateThroughWeeksHelp_navigate_weeks.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/navigateThroughWeeksHelp_navigate_weeks.png"
		width="10%" rel="popover"
		data-img="tutorial/screenshots/navigateThroughWeeksHelp_navigate_weeks.png"
		border="1px" align="center"> </a>