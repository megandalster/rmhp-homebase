<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
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
	<strong>HOW TO LOG YOUR HOURS </strong> </p>
	<p>
	>>> Sometimes a brief paragraph describing the task is useful here.
	</p>
<p>
	<B>Step 1:</B> >>>Usually the first step is for the user to select a particular tab on the navigation bar<BR> <BR> <a
		href="tutorial/screenshots/searchpersonstep1.png" class="image"
		title="searchpersonstep1.png"
		target="tutorial/screenshots/searchpersonstep1.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/searchpersonstep1.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/searchpersonstep1.png"
		border="1px" align="middle"> </a>
<br><br>>>> The code for showing an image is standardized.  Just fill in the path to the image in the tutorial/screenshots
folder.  To make the image take a screenshot in .png format of what you are illustrating in this step.  <br> 
</p>
<p>
	<B>Step 2:</B> >>>Each additional step is usually an HTML paragraph with <b>Step n.</b> as a prefix.
<p>
	<a
		href="tutorial/screenshots/searchpersonstep2.png" class="image"
		title="searchpersonstep2.png" horizontalalign="center"
		target="tutorial/screenshots/searchpersonstep2.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/searchpersonstep2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/searchpersonstep2.png"
		border="1px" align="middle"> </a>
</p>
<p>>>>When are choices inside of a step, show 2 or 3 of them<br>
	
	Another option is to ....<BR> <BR> <a
		href="tutorial/screenshots/searchpersonstep2-2.png" class="image"
		title="searchpersonstep2-2.png" horizontalalign="center"
		target="tutorial/screenshots/searchpersonstep2-2.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/searchpersonstep2-2.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/searchpersonstep2-2.png"
		border="1px" align="middle"> </a>
</p>
<p>
	Yet another option is to ... . <BR> <BR> <a
		href="tutorial/screenshots/searchpersonstep2-3.png" class="image"
		title="searchpersonstep2-3.png" horizontalalign="center"
		target="tutorial/screenshots/searchpersonstep2-3.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/searchpersonstep2-3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/searchpersonstep2-3.png"
		border="1px" align="middle"> </a>
</p>

<p>
	<B>Step 3:</B> >>>Be sure to cover all the possible ways for the user to complete the task.<BR> <BR> <a
		href="tutorial/screenshots/searchpersonstep3.png" class="image"
		title="searchpersonstep3.png"
		target="tutorial/screenshots/searchpersonstep3.png">
		&nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/searchpersonstep3.png" width="10%"
		rel="popover" data-img="tutorial/screenshots/searchpersonstep3.png"
		border="1px" align="middle"> </a>
</p>
<p>
	<B>Step 4:</B> >>>If this doesn't satisfy the user, point them to the Help Home 
	to view the table of contents to all the help pages. <BR> <BR>
</p>

<p>
	<B>Step 5:</B> >>> Be sure to suggest something like "When you finish, you can return to any other task by
	selecting it on the navigation bar."