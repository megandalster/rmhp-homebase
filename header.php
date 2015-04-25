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
<!-- Begin Header -->
<style type="text/css">
    h1 {padding-left: 0px; padding-right:165px;}
</style>
<div id="header">
<!--<br><br><img src="images/rmhHeader.gif" align="center"><br>
<h1><br><br>Homebase <br></h1>-->

</div>

<div align="center" id="navigationLinks">

    <?PHP
    //Log-in security
    //If they aren't logged in, display our log-in form.
    if (!isset($_SESSION['logged_in'])) {
        include('login_form.php');
        die();
    } else if ($_SESSION['logged_in']) {

        /*         * Set our permission array.
         * anything a guest can do, a volunteer and manager can also do
         * anything a volunteer can do, a manager can do.
         *
         * If a page is not specified in the permission array, anyone logged into the system
         * can view it. If someone logged into the system attempts to access a page above their
         * permission level, they will be sent back to the home page.
         */
        //pages guests are allowed to view
        $permission_array['index.php'] = 0;
        $permission_array['about.php'] = 0;
        $permission_array['apply.php'] = 0;
        //pages volunteers can view
        $permission_array['help.php'] = 1;
        $permission_array['view.php'] = 1;
        $permission_array['personSearch.php'] = 1;
        $permission_array['personEdit.php'] = 1;
        $permission_array['calendar.php'] = 1;
        //pages only managers can view
        $permission_array['personEdit.php'] = 2;
        $permission_array['viewSchedule.php'] = 2;
        $permission_array['addWeek.php'] = 2;
        $permission_array['rmh.php'] = 2;
        $permission_array['log.php'] = 2;
        $permission_array['dataSearch.php'] = 2;
        $permission_array['reports.php'] = 2;

        //Check if they're at a valid page for their access level.
        $current_page = substr($_SERVER['PHP_SELF'], 1);

      /*  echo "current page = ".$current_page;
        if ($permission_array[$current_page] > $_SESSION['access_level']) {
            //in this case, the user doesn't have permission to view this page.
            //we redirect them to the index page.
            echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
            //note: if javascript is disabled for a user's browser, it would still show the page.
            //so we die().
            die();
        }
*/
        //This line gives us the path to the html pages in question, useful if the server isn't installed @ root.
        $path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']), strpos(strrev($_SERVER['SCRIPT_NAME']), '/')));

        //they're logged in and session variables are set.
        if ($_SESSION['access_level'] >= 0) {
            echo('<a href="' . $path . 'index.php"><b>home</b></a> | ');
            echo('<a href="' . $path . 'about.php"><b>about</b></a>');
        }
        if ($_SESSION['access_level'] >= 1)
        	if ($_GET['id'] == 'new' && $current_page == 'rmhp-homebase/personEdit.php')
        		echo(' | <a href="' . $path . 'help.php?helpPage=' . 'rmhp-homebase/personAdd.php' . '" target="_BLANK"><b>help</b></a>');
            else
            	echo(' | <a href="' . $path . 'help.php?helpPage=' . $current_page . '" target="_BLANK"><b>help</b></a>');
        if ($_SESSION['access_level'] == 0)
            echo(' | <a href="' . $path . 'personEdit.php?id=' . 'new' . '"><b>apply</b></a>');
        if ($_SESSION['access_level'] >= 1) {
            echo(' | <strong>calendars:</strong> <a href="' . $path . 'calendar.php?venue=house">house, </a>');
            echo('<a href="' . $path . 'calendar.php?venue=fam">family room, </a>');
            echo('<a href="' . $path . 'calendar.php?venue=mealprep">meal prep, </a>');
            echo('<a href="' . $path . 'calendar.php?venue=activities">activity, </a>');
            echo('<a href="' . $path . 'calendar.php?venue=group">group </a>');
        }
        if ($_SESSION['access_level'] == 1.5) {
            echo('<br>');
            echo('<strong>volunteers :</strong> <a href="' . $path . 'personSearch.php">search</a>');
        }
        if ($_SESSION['access_level'] >= 2) {
            echo('<br><strong>master schedules : </strong><a href="' . $path . 'viewSchedule.php?venue=house">house, </a>'.
            		'<a href="' . $path . 'viewSchedule.php?venue=fam">family room </a> | ');
            echo('<strong>volunteers : </strong> <a href="' . $path . 'personSearch.php">search</a>, 
			        <a href="personEdit.php?id=' . 'new' . '">add, </a> <a href="viewScreenings.php?type=new">screenings</a>');
            echo(' | <strong><a href="' . $path . 'reports.php">reports</a> </strong>');
        //    echo(' | <strong>data :</strong> <a href="' . $path . 'dataSearch.php">search and export</a> ');
        }
        echo(' | <a href="' . $path . 'logout.php"><b>logout</b></a>');
    }
    ?>
</div>
<!-- End Header -->