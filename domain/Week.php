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

include_once('RMHdate.php');
/*
 * Week is an array of dates
 * Weeks start on Mondays
 * For any date given to either constructor function,
 * the script will find the Monday of that week, and generate dates from there
 * @author Maxwell Palmer
 * @version 4/30/08, modified 9/12/08
 */

class Week {

    private $id;    // the first day of the week, mm-dd-yy, e.g., "02-06-12"
    private $dates;    // array of 7 RMHdates, beginning Monday
    private $name;     // the name of the week (ie March 7, 2008 - March 14, 2008)
    private $weekday_group; // which weekday group
    private $weekend_group; // which weekend group
    private $status; // status of the week, "unpublished", "published" or "archived"
    private $end_of_week_timestamp; // the mktime timestamp of the end of the week

    /**
     * Creates a new calendar week.
     */

    function __construct($dates, $venue, $weekday_group, $weekend_group, $status) {
        $this->dates = $dates;
        $this->weekday_group = $weekday_group;
        $this->weekend_group = $weekend_group;
        $this->status = $status;
        $this->id = $this->dates[0]->get_id();
        $this->name = $this->dates[0]->get_name() . " to " . $this->dates[6]->get_name();
        $this->end_of_week_timestamp = $this->dates[6]->get_end_time();
    }

    function get_name() {
        return $this->name;
    }

    function get_id() {
        return $this->id;
    }

    function get_dates() {
        return $this->dates;
    }

    function get_status() {
        return $this->status;
    }

    function get_end() {
        return $this->end_of_week_timestamp;
    }

    function get_weekday_group() {
        return $this->weekday_group;
    }

    function get_weekend_group() {
        return $this->weekend_group;
    }

    function set_status($s) {
        if ($s == "unpublished" || $s == "published" || $s == "archived") {
            $this->status = $s;
        }
        else
            return false;
    }

}

?>
