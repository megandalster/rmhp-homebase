<html>
<head>
<link rel="stylesheet" href="lib/jquery-ui.css" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<script src="lib/jquery-1.9.1.js"></script>
<script src="lib/jquery-ui.js"></script>
<script>
$(function() {
	$( "#from" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true});
	$( "#to" ).datepicker({dateFormat: 'mm-dd-y',changeMonth:true,changeYear:true});
	$( "#target" ).scroll();
});
</script>
</head>
<body>
<div>
	<p>
	<form method="post">
		<p> <b>Example Datepicker Elements</b>
		<br> Today's date: <?php echo Date("F d, Y");?></p>
	<table>	<tr>
		<td valign="top"> Select Date Range: 
			<p> from : <input name = "from" type="text" id="from" value="10">
							to : <input name = "to" type="text" id="to"></p>
		</td>
	</tr></table>
	</form>
</div>
<div id="target" style="overflow: scroll; width: 600px; height: 200px;">
<p> <b>Example Scrollbar Element -- see http://api.jquery.com/scroll/ for details</b>
<p>
<?php for ($i=0;$i<100;$i++) {
         echo "<br>"; 
         for ($j=0;$j<100;$j++)
             echo $i*$j."&nbsp;&nbsp;";
}  
?>
</p>
</div>
</body>
</html>


