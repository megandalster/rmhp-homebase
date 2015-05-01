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
	<strong>How to Generate CSVs (Excel Spreadsheets) from Volunteer Database</strong>
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
	<B>Step 2:</B> If you wish to download the .csv file for Volunteer Birthdays Report, 
	select "Volunteer Birthdays", pick a venue, check the box on the right, and click on <b>Submit</b>
	button, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/dataexport2.png" class="image"
		title="dataexport2.png" horizontalalign="center"
		target="tutorial/screenshots/dataexport2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/dataexport2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/dataexport2.png" border="1px"
		align="center"> </a> <BR>
	<BR> Note that if you wish to view the entire volunteer birthdays report in system, you don't 
	have to choose a venue - just check the box and click on <B>Submit</B> button. <BR>
	<BR> Your browser will automatically download the .csv file (the file name is "export.csv") 
	to your local folder. If you open the file, it will look like this in Excel: <BR>
	<BR>
	<a href="tutorial/screenshots/dataexport2-2.png" class="image"
		title="dataexport2-2.png" horizontalalign="center"
		target="tutorial/screenshots/dataexport2-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/dataexport2-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/dataexport2-2.png" border="1px"
		align="center"> </a> <BR>
<p>
	<B>Step 3:</B> If you wish to download .csv file for Volunteer History Report or Volunteer 
	Contact Information report, select "Volunteer History" or "Volunteer Contact Info", check the box on the right,
	and then just click on <B>Submit</B> button, like this: <BR>
	<BR>
	<a href="tutorial/screenshots/dataexport3.png" class="image"
		title="dataexport3.png" horizontalalign="center"
		target="tutorial/screenshots/dataexport3.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/dataexport3.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/dataexport3.png" border="1px"
		align="center"> </a> <BR>
	<BR> Your browser will automatically download the .csv file (the file name is "export.csv") to your local folder. If you open the file,
	it will look like this in Excel: <BR>
	<BR>
	<a href="tutorial/screenshots/dataexport3-2.png" class="image"
		title="dataexport3-2.png" horizontalalign="center"
		target="tutorial/screenshots/dataexport3-2.png"> &nbsp&nbsp&nbsp&nbsp<img
		src="tutorial/screenshots/dataexport3-2.png" width="10%" rel="popover"
		data-img="tutorial/screenshots/dataexport3-2.png" border="1px"
		align="center"> </a> <BR>




