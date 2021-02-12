<?php

	$userName=$_POST['userName'];
	$password=$_POST['password'];
	// db_connect.php 是用來連接MYSQL
	$mysqlhost = "localhost"; //本機
	$mysqluser = $userName; //最高權限的使用者
	$mysqlpassword = $password; //預設無密碼
	$mysqldb = "arduino_test";    //Database的名字
	
	$mysqli= new mysqli($mysqlhost,$mysqluser,$mysqlpassword,$mysqldb); //建立物件，連接MYSQL
	$mysqli->query("set names 'utf8';");	//設utf8編碼，避免亂碼
	$conn=mysqli_connect($mysqlhost,$mysqluser,$mysqlpassword,$mysqldb);
	
?>Login Success!