<?php
/*
 * Copyright 2015 by Adrienne Beebe, Connor Hargus, Phuong Le, 
 * Xun Wang, and Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */

/*
 * 	personForm.inc
 *  shows a form for a person to be added or edited in the database
 * 	@author Oliver Radwan, Xun Wang and Allen Tucker
 * 	@version 9/1/2008, revised 4/1/2012, revised 3/11/2015
 */

if ($_SESSION['access_level'] == 0) {
    echo('<p><strong>New Volunteer Application Form</strong><br />');
    echo('Please provide us with some basic information about yourself and your interests.' .
    '<br>When you are finished, hit <b>Submit</b> at the bottom of this page.');
} else if ($_SESSION['access_level'] == 1)
    if ($_SESSION['_id'] != $person->get_id()) {
        echo("<p id=\"error\">You do not have sufficient permissions to edit this user.</p>");
        include('footer.inc');
        echo('</div></div></body></html>');
        die();
    } else {
        echo('<p><strong>Volunteer Edit Form</strong><br />');
        echo('Here you can edit your own information in the database.' .
        '<br>When you are finished, hit <b>Submit</b> at the bottom of this page.');
    } else if ($_SESSION['access_level'] == 2)
    if ($id == 'new') {
        echo('<p><strong>New Volunteer Form</strong><br />');
        echo('Here you can add a new volunteer into the database. </p>');
    } else {
        echo('<p><strong>Volunteer Edit Form</strong><br />');
        echo('Here you can edit, delete, or change the password for a volunteer in the database.</p><p>');
    } else {
    echo("<p id=\"error\">You do not have sufficient permissions to add a new person to the database.</p>");
    include('footer.inc');
    echo('</div></div></body></html>');
    die();
}
?>
<form method="POST">
    <input type="hidden" name="old_id" value=<?PHP echo("\"" . $id . "\""); ?>>
    <input type="hidden" name="old_pass" value=<?PHP echo("\"" . $person->get_password() . "\""); ?>>
    <input type="hidden" name="_form_submit" value="1">
    <p>(<span style="font-size:x-small;color:FF0000">*</span> denotes required fields)
    <p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="first_name" tabindex="1" value="<?PHP echo($person->get_first_name()) ?>">
        Last Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="last_name" tabindex="2" value="<?PHP echo($person->get_last_name()) ?>">
    <fieldset>
        <legend>Contact information:</legend>
        <p>Address<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="address" tabindex="3" size=40 value="<?PHP echo($person->get_address()) ?>">
        City<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="city" tabindex="4" value="<?PHP echo($person->get_city()) ?>">
        <p>State, Zip<span style="font-size:x-small;color:FF0000">*</span>:
            <select name="state" tabindex="5">
<?PHP
$states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA",
    "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM",
    "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA",
    "WV", "WI", "WY");
foreach ($states as $st) {
    echo "<option value='" . $st . "' ";
    if ($person->get_state() == $st)
        echo("SELECTED");
    else if ($id == "new" && $st == "RI")
        echo("SELECTED");
    echo ">" . $st . "</option>";
}
?>
            </select>,
            <input type="text" name="zip" size="5" tabindex="6" value="<?PHP echo($person->get_zip()) ?>">
            
        <p>Primary Phone<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="phone1" MAXLENGTH=12 tabindex="7" value="<?PHP echo(phone_edit($person->get_phone1())) ?>">
            &nbsp;&nbsp;Secondary Phone:<input type="text" name="phone2" MAXLENGTH=12 tabindex="8" value="<?PHP echo(phone_edit($person->get_phone2())) ?>">
        	&nbsp;&nbsp;Work Phone:<input type="text" name="work_phone" MAXLENGTH=12 tabindex="8" value="<?PHP echo(phone_edit($person->get_work_phone())) ?>">
        <p>Email:<input type="text" name="email" tabindex="9" value="<?PHP echo($person->get_email()) ?>">
<script src="lib/jquery-1.9.1.js"></script>
		<script src="lib/jquery-ui.js"></script>
		<script>
			$(function(){
				$( "#birthday" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
				$( "#start_date" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
				$( "#end_date" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
				$( "#screening_status[]" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true,yearRange: "1920:+nn"});
			})
</script>
<?PHP
        echo('&nbsp;&nbsp;Gender:&nbsp;&nbsp;');
        echo('<select name="gender">');
        echo ('<option value=""');
        if ($person->get_gender() == '')
            echo (' SELECTED'); echo('></option>');
        echo ('<option value="female"');
        if ($person->get_gender() == 'female')
            echo (' SELECTED'); echo('>female</option>');
        echo ('<option value="male"');
        if ($person->get_gender() == 'male')
            echo (' SELECTED'); echo('>male</option>');
        echo('</select>');

        echo '<p>Birthday: '. '<input name="birthday" type="text" id="birthday" value="'.$person->get_birthday().'">';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;Start Date: '. '<input name="start_date" type="text" id="start_date" value="'.$person->get_start_date().'">';
        echo '<p>End Date: '. '<input name="end_date" type="text" id="end_date" value="'.$person->get_end_date().'">';

        echo "&nbsp;&nbsp;&nbsp;&nbsp;Reason For Leaving:";
        echo('<select name="reason_left">');
        echo ('<option value=""');
        if ($person->get_reason_left() == '')
            echo (' SELECTED'); echo('></option>');
        echo ('<option value="New Employment"');
        if ($person->get_reason_left() == 'New Employment')
            echo (' SELECTED'); echo('>New Employment</option>');
        echo ('<option value="Moved Away"');
        if ($person->get_reason_left() == 'Moved Away')
            echo (' SELECTED'); echo('>Moved Away</option>');
        echo ('<option value="Illness"');
        if ($person->get_reason_left() == 'Illness')
            echo (' SELECTED'); echo('>Illness</option>');
        echo ('<option value="Family Obligation"');
        if ($person->get_reason_left() == 'Family Obligation')
            echo (' SELECTED'); echo('>Family Obligation</option>');
        echo ('<option value="School"');
        if ($person->get_reason_left() == 'School')
            echo (' SELECTED'); echo('>School</option>');
        echo ('<option value="Other (see notes)"');
        if ($person->get_reason_left() == 'Other (see notes)')
            echo (' SELECTED'); echo('>Other (see notes)</option>');            
        echo('</select>');
        
        echo('<p>Notes:<br />');
        echo('<textarea name="notes" rows="2" cols="60">');
        echo($person->get_notes());
        echo('</textarea></fieldset>');

echo ('<p>Status:');
echo('<span style="font-size:x-small;color:FF0000">*</span>&nbsp;&nbsp;');
echo('<select name="status">');
if ($_SESSION['access_level'] == 0) {
	echo ('<option value="applicant"');
    echo (' SELECTED'); 
    echo('>applicant</option>');
}
else {
	echo ('<option value="applicant"');
	if ($person->get_status() == 'applicant')
    	echo (' SELECTED'); 
    echo('>applicant</option>'); echo ('<option value="active"');
	if ($person->get_status() == 'active')
	    echo (' SELECTED'); echo('>active</option>');
	echo ('<option value="LOA"');
	if ($person->get_status() == 'LOA')
	    echo (' SELECTED'); echo('>on leave</option>');
	echo ('<option value="former"');
	if ($person->get_status() == 'former')
	    echo (' SELECTED'); echo('>former</option>');
}
echo('</select>');
// $st = implode(',', $person->get_type());
$types = array('volunteer' => 'Volunteer', 'sub' => 'Sub', 'mealprep' => 'Meal Prep', 'activities' => 'Activities', 'other' => 'Other', 'manager' => 'Manager');
echo('<p>Position type(s):');
// $ts = $types;
echo('<span style="font-size:x-small;color:FF0000">*</span>');

foreach ($types as $key => $value) {
    echo ('&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="type[]" value=' . $key);
    if (in_array($key,$person->get_type()) !== false)
        echo(' CHECKED');
    echo ('>' . $value );
}
?>
    <fieldset id='availability'>
        <legend>Availability:<span style="font-size:x-small;color:FF0000">*</span> (Check at least one Venue and at least one Shift) </legend>
        <span class="bigTable">
            <table>
                <?PHP
                $shifts = array('9-1' => 'Morning (9-1)', '1-5' => 'Afternoon (1-5)', '5-9' => 'Evening (5-9)',
                    'night' => "Overnight");
                $venues = array('house'=>"House", 'fam'=>"Family Room",""=>"");
                $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
                $shifts = array('9-1','1-5','5-9','night');
                $weeks = array('Week of Year', 'odd', 'even', 'Week of Month', '1st', '2nd', '3rd', '4th', '5th');
                $person_availability = implode(',', $person->get_availability());
    		
   		 		echo "<table><tr><td valign='top'>";
   		 		  echo "<table><tr><td>Venues</td></tr>";	
   		 		    foreach ($venues as $venue=>$venuename) {
   		 		    	echo "<tr>";
   		 		    	echo "<td>".$venuename."</td>";
   		 		    	if ($venuename!="") {
   		 		    	    echo ('<td><input type="checkbox" name="availvenues[]" value=' . $venue);
    	  				    if (in_array($venue, $person->get_availvenues())) echo(' CHECKED');
    	  				    echo ('></td>');
   		 		    	}
   		 		    	else echo "<td>&nbsp;</td>";
   		 		    	echo "</tr>";
   		 		    }
   		 		  echo "</tr></table></td>";  
   		 	      
   		 		  echo "<td valign='top'><table><tr><td>&nbsp;&nbsp;Shifts</td>";
   		 			foreach ($days as $day)
   		 				echo "<td>".$day."</td>";	
   		 		    echo "</tr>";
   		 		    foreach ($weeks as $week_no) {
   		 		    	echo "<tr><td align='center'>".$week_no."</td>";
   		 		    	if ($week_no == "Week of Month" || $week_no=="Week of Year") continue;
   		 		    	foreach ($days as $day) {
   		 		    	  	echo "<td><select multiple name='availdays[]'>";
   		 		    	  	foreach ($shifts as $shift) {
	  		                    echo ('<option value=' . $week_no . ":". $day.":".$shift);
							    if (in_array($week_no.":".$day.":".$shift, $person->get_availdays())) 
							        echo(' SELECTED'); 
							    echo ('>'.$shift.'</option>'); }		
							echo "</select></td>";
   		 		    	}	
   		 		    	echo "</tr>";
   		 		    }
   		 		  echo "</tr></table></td>";
   		 		
   		 		echo "</tr></table>";
    			?>
            </table>
        </span></p>
    </fieldset>
    <p>
        <?PHP
        if ($id == 'new' || $person->get_status() == "applicant") {
            echo "<fieldset>";
            echo "<legend>Applicants only: </legend>";
			if ($_SESSION['access_level'] == 2) {
            	$screeningType = $person->get_screening_type();
                $screening = retrieve_dbApplicantScreenings($screeningType);
                $screenings = getall_ApplicantScreenings();
                echo('<p> Screening Type:&nbsp; <select name="screening_type">');
                if ($person->get_screening_type() == "")
                    echo('<option value="" SELECTED></option>');
                foreach ($screenings as $s) {
                    if ($s->get_status() == "published") {
                        $t = $s->get_type();
                        if ($screeningType == $t) {
                            echo('<option value ="' . $t . '" SELECTED>' . $t . '</option>');
                        } else {
                            echo('<option value ="' . $t . '"> ' . $t . '</option>');
                        }
                    }
                }
                echo('</select>&nbsp;');

                // submit button that allows manager to associate person with applicant screening
                //echo(' Hit <input type="submit" value="submit" name="Submit Edits"> to associate '.$person->get_first_name().' with this screening.<br><br>');

                if ($screening) {
                    $step_array = $screening->get_steps();
                    $date_array = $person->get_screening_status();
                    $step_count = count($step_array);
                
                echo("<p><table>");
                echo('<tr><td>Completion Date</td> <td>Step</td></tr>');
                for ($i = 0; $i < $step_count; $i++) {
                    $j = $i + 1;
                    echo "<tr><td>";
                    echo('<tr><td><input type="text" id="screening_status[]" name="screening_status[]" value="'.$date_array[$i]. '" size="8" /></td>');
                    echo('</td><td>' . $j . '. ' . $step_array[$i] . '</td></tr>');
                }
                echo('</table>');
                }
			}

                echo('<p>Motivation / Specialties:<br />');
                echo('<textarea name="motivation" rows="2" cols="60">');
                echo($person->get_motivation());
                if ($person->get_specialties() != "")
                    echo " / " . $person->get_specialties();
                echo('</textarea>');

                echo('<p>References:<br />');
                echo('<textarea name="references" rows="2" cols="60">');
                foreach ($person->get_references() as $reference) {
                    $i = strpos($reference, "_");
                    echo substr($reference, 0, $i) . " " . phone_edit(substr($reference, $i + 1)) . "     ";
                }
                echo('</textarea>');
            echo "</fieldset>";
        }

        echo('<input type="hidden" name="schedule" value="' . implode(',', $person->get_schedule()) . '">');
        echo('<input type="hidden" name="password" value="' . $person->get_password() . ')">');
        echo('<input type="hidden" name="_submit_check" value="1"><p>');
        if ($_SESSION['access_level'] == 0)
            echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to complete this application.<br /><br />');
        else
            echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to submit these edits.<br /><br />');
        if ($id != 'new' && $_SESSION['access_level'] >= 2) {
            echo ('<input type="checkbox" name="deleteMe" value="DELETE"> Check this box and then hit ' .
            '<input type="submit" value="Delete" name="Delete Entry"> to delete this entry. <br />' .
            '<input type="checkbox" name="reset_pass" value="RESET"> Check this box and then hit ' .
            '<input type="submit" value="Reset Password" name="Reset Password"> to reset this person\'s password.</p>');
        }
        ?>
</form>

