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

/*
 * 	reports.inc.php
 *   shows a form to search for a data object
 * 	@author Jerrick Hoang
 * 	@version 11/5/2013
 */
?>
<link
	rel="stylesheet" href="lib/jquery-ui.css" />
<script
	src="lib/jquery-ui.js"></script>
<script
	src="reports.js"></script>
	
<link rel="stylesheet" href="reports.css" type="text/css" />
<div id = "content">
<div id = "report-table">
	<p id="search-fields-container">
	<form id = "search-fields" method="post">
		<input type="hidden" name="_form_submit" value="report" />
		<p class = "search-description" id="today"> <b>House Volunteer Hours, Shifts, and Vacancies</b><br> Report date: <?php echo Date("F d, Y");?></p>
	<table>	<tr>
		<td class = "search-description" valign="top"> Select Report Type: 
		<p>	<select multiple name="report-types[]" id = "report-type">
	  		<option value="volunteer-names">Individual Hours</option>
	  		<option value="volunteer-hours">Total Hours</option>
	  		<option value="shifts-staffed-vacant">Shifts/Vacancies</option>
			</select>
		</p>
		</td>
		<td class = "search-description" > Select Individuals  (optional):
		<p id="volunteer-name-inputs"
			class="ui-widget"> <input type="text" name="volunteer-names[]" class="volunteer-name" id="1"></p>
		<button id="add-more">add more</button><br><br>
		</td>
		<td class = "search-description" valign="top"> Select Date Range: 
			<input type="radio" name="date" value="date-range"> 
			<p id="fromto"> from : <input name = "from" type="text" id="from">
								to : <input name = "to" type="text" id="to"></p>
		</td>
	</tr></table>
	And hit <input type="submit" value="submit" id ="report-submit" class ="btn">
	</form>
	<p id="outputs">

	</p>
</div>
</div>
