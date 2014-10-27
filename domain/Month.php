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


/**
 * Month class for RMH homebase.
 * @author Judy Yang
 * @version February 13, 2012
 */
class Month {

    private $id; // the first day of the month, mm-01-yy
    private $dates; // array of 31 (or less) RMHdates, beginning on mm-01-yy
    private $group; // "One" or "Two"
    private $status; // "unpublished", "published" or "archived"
    private $end_of_month_timestamp; // the mktime timestamp of the last day

    /**
     * constructor for all months
     */

    function __construct($i, $g, $s) {

        $this->id = $i;
        $month = substr($this->id, 0, 2); // get the month
        $year = substr($this->id, 6, 2); // get the year
        if ($year <= 13) {
            // assume it's the 21st century
            $year_long = "20" . $year;
        } else {
            // assume it's the 20th century
            $year_long = "19" . $year;
        }

        $num_days = date("t", mktime(0, 0, 0, $month, 1, $year_long)); // get number days in $month


        $this->dates = array();
        for ($i = 1; $i <= 9; $i++) {
            $this->dates[] = $month . "-0" . $i . "-" . $year;
        }
        for ($i = 10; $i <= $num_days; $i++) {
            $this->dates[] = $month . "-" . $i . "-" . $year;
        }

        $this->group = $g;
        $this->status = $s;


        $this->end_of_month_timestamp = mktime(0, 0, 0, $month, $num_days, $year_long); // get last day in $month
    }

    function get_id() {
        return $this->id;
    }

    function get_dates() {
        return $this->dates;
    }

    function get_group() {
        return $this->group;
    }

    function get_status() {
        return $this->status;
    }

    function get_end_of_month_timestamp() {
        return $this->end_of_month_timestamp;
    }

    function set_end_of_month_timestamp($ts) {
        $this->end_of_month_timestamp = $ts;
    }

    function set_group($g) {
        $this->group = $g;
    }

    function set_status($s) {
        $this->status = $s;
    }

}

?>