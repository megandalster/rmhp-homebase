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
			<p> from : <input name = "from" type="text" id="from">
							to : <input name = "to" type="text" id="to"></p>
		</td>
	</tr></table>
	</form>
</div>

</body>
</html>


