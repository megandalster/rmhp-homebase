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
 * 	dataSearch.inc.php
 *   shows a form to search for a data object
 * 	@author Johnny Coster
 * 	@version 4/2/2012
 */
?>

<head>
<style type="text/css">
td {
	padding-bottom: 8px;
}

#search-form {
	margin-top:30px;
	width: 700px;
	margin-left: auto;
	margin-right: auto;
}

#form-table {
	margin-left: auto;
	margin-right: auto;
}

#form-description {
	font-size:15px;
	margin-bottom: 10px;
}

#form-table .input-description {
	width: 150px;
}

#form-table .input-dropdown {
	width: 500px;
	font-size:18px;
	padding: 5px;
}

#form-table .input-field {
	width: 500px;
	padding: 5px;
}

#clear-button {
	font-size: 18px;
	float: right;
	margin-right: 20px;
}

#submit-button {
	font-size: 18px;
	margin-left: 20px;
	float:right;
}


</style>
</head>

<div id="search-form">
<div id="form-description">Find people with ... </div>
<form name="search_data" method="post"><input type="hidden" name="_form_submit" value="1" />
<table id="form-table">
	<tr>
		<td class="input-description">First Name:</td>
		<td><input class="input-field" type="text" name="first_name" /></td>
	</tr>
	<tr>
		<td class="input-description">Last Name:</td>
		<td><input class="input-field" type="text" name="last_name" /></td>
	</tr>
	<tr>
		<td class="input-description">Gender:</td>
		<td><select class="input-dropdown" name="gender">
			<option value="">any gender</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="other">Other</option>
		</select>
		</td>
	</tr>
	<tr>
		<td class="input-description">Type:</td>
		<td>
			<input type="checkbox" name="type[]" value="volunteer" checked/> Volunteer
			<input type="checkbox" name="type[]" value="manager" checked/> Manager
			<input type="checkbox" name="type[]" value="chef" checked/> Guest Chef
			<input type="checkbox" name="type[]" value="parking" checked/> Parking
			<input type="checkbox" name="type[]" value="cleaning" checked/> Cleaning
			<input type="checkbox" name="type[]" value="sub" checked/> Sub
			<input type="checkbox" name="type[]" value="other" checked/> Other
		</td>
	</tr>
	<tr>
		<td class="input-description">Status:</td>
		<td><select class="input-dropdown" name="status">
			<option value="">any status</option>
			<option value="active">Active</option>
			<option value="LOA">LOA</option>
			<option value="former">Former</option>
			<option value="other">Other...</option>
		</select></td>
	</tr>
	<tr>
		<td class="input-description">Start Date:</td>
		<td><input class="input-field" type="text" name="start_date" placeholder="(e.g. 02/03/12)" /></td>
	</tr>

	<tr>
		<td class="input-description">City: </td> 
		<td> <input class="input-field" type="text" name="city" /></td>
	</tr>
	<tr>
		<td class="input-description">Zip: </td> 
		<td><input class="input-field" type="text" name="zip"/> </td>
	</tr>
	<tr>
		<td class="input-description">Phone :</td>
		<td><input class="input-field" type="text" name="phone" placeholder="(e.g. 2071234567)" /></td>
	</tr>
	<tr>
		<td class="input-description">Email:</td>
		<td><input class="input-field" type="text" name="email" /></td>
	</tr>

	<tr>
		<td></td>
		<td>
		<input id="clear-button" type="reset" name="clear_data" value="Clear" />
		<input id="submit-button" type="submit" name="data_search" value="Search"/>
		</td>
	</tr>
</table>
</form>
</div>
