<?php 
	
	//匯入連接MYSQL的檔案，使用剛剛建立的$mysqli物件
	require_once('db_connect.php');
	
	$last_row = $mysqli->query("select * from dht11_test ORDER BY date DESC LIMIT 1");
	
	$show=mysqli_fetch_row($last_row);
?>	

	<td style="padding: 5px 10px 5px 5px;"><?php echo $show[1];?> °C</td>
	<td></td>
	<td style="padding: 5px 10px 5px 80px;"><?php echo $show[2];?></td>
	
