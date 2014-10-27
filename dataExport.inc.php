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
 * 	dataExport.inc.php
 *   asks which attributes to export to CSV
 * 	@author Johnny Coster
 * 	@version 4/2/2012
 */
?>

<head>
<style type="text/css">
td {
	padding-bottom: 8px;
	padding-left: 40px;
}

#export-attr {
	width: 700px;
	margin-left: auto;
	margin-right: auto;
}

#download-form {
	width: 700px;
	margin-left: auto;
	margin-right: auto;
	visibility: hidden;
}

#download-button {
	margin-left: auto;
	margin-right: auto;
}
#check_all {
	font-size: 10px; 
	margin-left: 120px
}

#uncheck_all {
	font-size: 10px; 
	margin-left: -20px
}

</style>

<script>
	
	$(function () {
    	$('#export_data').on('click', function (e) {
    		$.ajax({
            	type: 'post',
            	url: 'dataSearch.php',
            	data: $('#export-attr').serialize(),
            	success: function () {
            		$('#download-button').trigger('click');
            	}
        	});
    		e.preventDefault();
    	});
   	});
</script>
</head>

<body>
<form id="export-attr" name="export_data" method="post"><input type="hidden" name="_form_submit" value="3" />
	<p style="margin-left: 20px"><b>Select the attributes to be exported for these people, and then hit 'Export Data': </b></p>
	<table>
		<td valign="top">
		<table>
			<td><input type="checkbox" id="e_check1" name="export_attr[]" value="first_name"/> First Name
			</td>
			<tr>
				<td><input type="checkbox" id="e_check2" name="export_attr[]" value="last_name"/> Last Name
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check3" name="export_attr[]" value="gender"/> Gender</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check4" name="export_attr[]" value="type"/> Type</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check5" name="export_attr[]" value="status"/> Status</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check6" name="export_attr[]" value="start_date"/> Start
				Date</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check7" name="export_attr[]" value="history"/> Past shifts worked</td>
			</tr>
			
		</table>
		</td>
		<td valign="top">
		<table>
			<td><input type="checkbox" id="e_check11" name="export_attr[]" value="address"/> Street
			Address</td>
			<tr>
				<td><input type="checkbox" id="e_check12" name="export_attr[]" value="city"/> City</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check13" name="export_attr[]" value="county"/> County
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check14" name="export_attr[]" value="state"/> State</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check15" name="export_attr[]" value="zip"/> Zip</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check16" name="export_attr[]" value="phone1"/> Phone 1
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check17" name="export_attr[]" value="phone2"/> Phone 2
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check18" name="export_attr[]" value="email"/> Email</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="e_check19" name="export_attr[]" value="notes"/> Notes</td>
			</tr>
		</table>
		</td>
	</table>
	<table>
		<td><input type="button" id="check_all" name="check_all" value="Check All"
			onclick="<?php for ($i = 1; $i < 20; $i++) {
	        if ($i < 8 || $i > 10) { ?>document.getElementById('e_check<?php echo($i); ?>').checked=true;<?php }
	    } ?>" /><br />
		</td>
		<td><input style="" type="reset" id="uncheck_all" name="uncheck_all" value="Uncheck All" /><br />
		</td>
	</table>
	
	<input style="font-size: 15px; margin-left: 180px" type="submit" id="export_data" name="export_data" value="Export Data" />
</form>

<form id="download-form" action="exportDownload.php">
	<button id="download-button">Download Exported File</button>
</form>


</body>
