<?php
function openSerial($command) {
    $openSerialOK = false;
    try {
        //exec("mode com3: BAUD=9600 PARITY=n DATA=8 STOP=1 to=off dtr=off rts=off");
        $fp =fopen("interval.txt", "w");
        //$fp = fopen('/dev/ttyUSB0','r+'); //use this for Linux
        $openSerialOK = true;
    } catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

    if($openSerialOK) {
		//echo $command;
        fwrite($fp, $command); //write string to serial
        fclose($fp);
    }  
} 




if(isset($_POST['interval'])) {
	$interval = $_POST['interval'];
	if($interval[0]=="level_interval"){
		openSerial("water_level_interval ".$interval[1]);
		
	}else if($interval[0]=="temp_interval"){
		openSerial("temp_interval ".$interval[1]);
	}else if($interval[0]=="turb_interval"){
		openSerial("turb_interval ".$interval[1]);
	}
}else{
	echo "failed";
}

$output=shell_exec("python Python Projects/test.py "  .$interval[0]);

echo $output;
	
	
?>

