<?php
	$show="";
	
	require_once('db_connect.php');
	
	$userName=$_POST['userName'];
	$password=$_POST['password'];
	
	$pass = $mysqli->query("select password from account where account = '".$userName ."'");
	
	$show=mysqli_fetch_row($pass); 
	
	if($password!=null && $password == $show[0]){
		echo "Login Success!";
	}
	
	// db_connect.php 是用來連接MYSQL
	/**
	$mysqlhost = "localhost"; //本機
	$mysqluser = "root"; //最高權限的使用者
	$mysqlpassword = "1234"; //預設無密碼
	$mysqldb = "arduino_test";    //Database的名字
	
	$mysqli= new mysqli($mysqlhost,$mysqluser,$mysqlpassword,$mysqldb); //建立物件，連接MYSQL
	$mysqli->query("set names 'utf8';");	//設utf8編碼，避免亂碼
	$conn=mysqli_connect($mysqlhost,$mysqluser,$mysqlpassword,$mysqldb);
	**/
	
?>
