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
 * dbMonth class for RMH homebase.
 * @author Judy Yang
 * @version February 22, 2012
 */
include_once(dirname(__FILE__) . '/dbinfo.php');
include_once(dirname(__FILE__) . '/../domain/Month.php');

function create_dbMonths() {
    connect();
    mysql_query("DROP TABLE IF EXISTS dbMonths");
    $result = mysql_query("CREATE TABLE dbMonths (id TEXT NOT NULL, dates TEXT, `group` TEXT, status TEXT, end_of_month_timestamp INT)");

    if (!$result) {
        echo mysql_error() . "Error creating dbMonths table<br>";
        echo false;
    }
    mysql_close();
    return true;
}

/*
 * add a month to dbMonth: if already there, return false
 */

function insert_dbMonths($month) {
    if (!$month instanceof Month) {
        return false;
    }
    connect();

    $query = "SELECT * FROM dbMonths WHERE id = '" . $month->get_id() . "'";
    $result = mysql_query($query);


    //if there's no entry for this id, add it
    $query = "INSERT INTO dbMonths VALUES ('" .
            $month->get_id() . "','" .
            implode(',', $month->get_dates()) . "','" .
            $month->get_group() . "','" .
            $month->get_status() . "','" .
            $month->get_end_of_month_timestamp() .
            "');";


    $result = mysql_query($query);

    if (!$result) {
        echo (mysql_error() . " unable to insert into dbMonths: " . $month->get_id() . "\n");
        mysql_close();
        return false;
    }
    mysql_close();
    return true;
}

/*
 * @return a single row from dbMonths table matching a particular id.
 * if not in table, return false
 */

function retrieve_dbMonths($id) {
    connect();
    $query = 'SELECT * FROM dbMonths WHERE id = "' . $id . '"';
    $result = mysql_query($query);
    // can't find month with id
    if (mysql_num_rows($result) != 1) {
        mysql_close();
        return false;
    }

    $result_row = mysql_fetch_assoc($result);
    $theMonth = new Month($result_row['id'], $result_row['group'], $result_row['status']);
    $theMonth->set_end_of_month_timestamp($result_row['end_of_month_timestamp']);

    return $theMonth;
}

/*
 * @return all rows from dbMonths table ordered by last day of month
 * if none there, return false
 */

function getall_months() {
    connect();
    $query = "SELECT * FROM dbMonthsORDER BY end_of_month_timestamp";
    $result = mysql_query($query);
    $theMonths = array();

    while ($result_row = mysql_fetch_assoc($result)) {
        $theMonth = new Month($result_row['id'], $result_row['group'], $result_row['status']);
        $theMonth->set_end_of_month_timestamp($result_row['end_of_month_timestamp']);
        $theMonths[] = $theMonth;
    }

    return $theMonths;
}

/*
 * update month with matching id with the values of this month's fields
 * if month with id is not in db, return false
 */

function update_dbMonths($month) {
    if (!$month instanceof Month) {
        echo ("Invalid argument for update_dbMonths function call");
        return false;
    }

    if (delete_dbMonths($month->get_id()))
        return insert_dbMonths($month);
    else {
        echo (mysql_error() . "unable to update dbMonths table: " . $month->get_id());
        return false;
    }
}

/*
 * remove a month from dbMonths table.  If already there, return false
 */

function delete_dbMonths($id) {
    connect();
    $query = "DELETE FROM dbMonths WHERE id=\"" . $id . "\"";
    $result = mysql_query($query);
    mysql_close();
    if (!$result) {
        echo (mysql_error() . " unable to delete from dbMonths: " . $id);
        return false;
    }
    return true;
}

?>