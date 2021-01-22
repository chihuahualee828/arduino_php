<?php 
	
	//匯入連接MYSQL的檔案，使用剛剛建立的$mysqli物件
	require_once('db_connect.php');
	
	$last_row = $mysqli->query("select * from dht11_test ORDER BY date DESC LIMIT 1");
	
	$show=mysqli_fetch_row($last_row);
		
?>
	<?php echo $show[0];?>
	
	<tr >
		<td style="padding: 10px 10px 5px 5px;"><?php echo $show[1];?></td>
		<td></td>
		<td style="padding: 10px 200px 5px 120px;"><?php echo $show[2];?></td>
		<td></td>
		<td style="padding: 10px -5px 5px 140px;"><?php echo $show[3];?></td>
	</tr>
