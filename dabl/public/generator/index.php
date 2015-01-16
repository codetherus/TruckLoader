<?php require_once './init.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>DABL Generator</title>
	</head>
	<body>
<script>
function checkAll(name, connection, checked){
	var boxes = document.getElementsByTagName('input');
	var length = boxes.length;
	for(var x=0;x<length;x++){
		var checkbox = boxes[x];
		if(checkbox.type=='checkbox' && checkbox.name.toString().indexOf(connection)!==-1 && checkbox.name.toString().indexOf(name)!==-1)
			checkbox.checked = checked;
	}
}
</script>
<h1>DABL Generator</h1>
<div>
	Please choose which table to generate for.  Only the base models
	can be overwritten.
</div>

<br />

<form action="generate.php" method="POST">
	<input type="hidden" name="action" value="generate" />
	<table>
		<tbody>

<?php foreach($generators as $connection_name => $generator): ?>

			<tr><th align="left" colspan="100"><h3>Database: <?php echo $generator->getDBName() ?> (<?php echo $connection_name ?>)</h3></th></tr>
			<tr>
				<th align="left">&nbsp;</th>
				<th align="left"><input type="checkbox" checked="CHECKED" onclick="checkAll('Models', '<?php echo $connection_name ?>', this.checked)" /> Models</th>
			</tr>

	<?php foreach($generator->getTableNames() as $tableName): ?>

			<tr>
				<td align="left"><?php echo $tableName ?></td>
				<td align="left">
					<input type="checkbox" value="<?php echo $tableName ?>" name="Models[<?php echo $connection_name ?>][]" checked="CHECKED" />
				</td>
			</tr>
	<?php endforeach ?>

<?php endforeach ?>

		</tbody>
	</table>
	<input type="submit" value="Generate Files!" />
</form>
	</body>
</html>