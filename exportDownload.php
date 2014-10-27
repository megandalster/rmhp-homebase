<?php
//content type
header('Content-type: text/csv');
//open/save dialog box
header('Content-Disposition: attachment; filename="dataexport.csv"');
//read from server and write to buffer
readfile('dataexport.csv');
?>