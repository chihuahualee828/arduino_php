<?php 
	
	//匯入連接MYSQL的檔案，使用剛剛建立的$mysqli物件
	require_once('db_connect.php');
	
	$first_row = $mysqli->query("select date from dht11 LIMIT 1");
	$last_row = $mysqli->query("select date from dht11 ORDER BY date DESC LIMIT 1");
	$first_timestamp=mysqli_fetch_row($first_row)[0];
	$last_timestamp=mysqli_fetch_row($last_row)[0];
	
?>	

	<tr>
		<td>From :</td>
		<td><input type="text" name="from" value="<?php echo $first_timestamp;?>"/></td>					
	</tr>
	<tr>
		<td>To :</td>
		<td><input type="text" name="to" value="<?php echo $last_timestamp;?>"/></td>
	</tr>
