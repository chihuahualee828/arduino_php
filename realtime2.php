 <?php 
	
	//匯入連接MYSQL的檔案，使用剛剛建立的$mysqli物件
	require_once('db_connect.php');
	
	$last_row = $mysqli->query("select * from dht11 ORDER BY date DESC LIMIT 1");
	
	$show=mysqli_fetch_row($last_row); 
?>	

	<?php echo $show[1];?>
