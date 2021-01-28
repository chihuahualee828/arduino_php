<?php 
	
	//匯入連接MYSQL的檔案，使用剛剛建立的$mysqli物件
	require_once('db_connect.php');
	
	$name=$_POST['msg'];
	$order=$_POST['order'];
	
	$res = $mysqli->query("select * from dht11 ORDER BY $name $order");
	while($rs = mysqli_fetch_row($res)) { 
		
?>

	
	<tr >
		<td style="padding: 10px 10px 5px 5px;"><?php echo $rs[1];?></td>
		<td></td>
		<td style="padding: 10px 200px 5px 120px;"><?php echo $rs[2];?></td>
		<td></td>
		<td style="padding: 10px -5px 5px 140px;"><?php echo $rs[3];?></td>
	</tr>
<?php
	
	}
?>	
