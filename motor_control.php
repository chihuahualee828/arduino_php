<?php
function openSerial($command) {
    $openSerialOK = false;
    try {
        exec("mode com3: BAUD=9600 PARITY=n DATA=8 STOP=1 to=off dtr=off rts=off");
        $fp =fopen("com3", "w");
        //$fp = fopen('/dev/ttyUSB0','r+'); //use this for Linux
        $openSerialOK = true;
    } catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

    if($openSerialOK) {
		echo $command;
        fwrite($fp, $command); //write string to serial
        fclose($fp);
    }  
}



if(isset($_POST['motor_turn'])) {
	if($_POST['motor_turn']=="on"){
		openSerial("n");
		echo $_POST['motor_turn'];
	}else{
		openSerial("f");
		echo $_POST['motor_turn'];
	}
    
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <input type="submit" name="submit1" value="1 on"><br>
   <input type="submit" name="submit1" value="1 off"><br>
</form>