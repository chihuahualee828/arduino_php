<?php
	
	$page = $_SERVER['PHP_SELF'];
	
	header("URL=$page");
	
	//匯入連接MYSQL的檔案，使用剛剛建立的$mysqli物件
	require_once('db_connect.php');
	
	//刪除功能
	
	
	
	
	$res = $mysqli->query("select * from dht11");	
	
	$myPost = array_values($_POST);
	/*
	foreach($myPost as $each){
		print($each."//");
	}*/
	
	
	
	
	
	if(isset($myPost[8])){
		if($myPost[0] != "" and $myPost[4] != "" ){
			$from = $myPost[0]." ".$myPost[1].":".$myPost[2].":".$myPost[3];
			$to = $myPost[4]." ".$myPost[5].":".$myPost[6].":".$myPost[7];
			
			if($myPost[8]=="output"){
				
				
				$res2 = $mysqli->query("select * FROM `dht11` WHERE `date` >= '$from' and `date` <= '$to'");
				$items = array();
				while( $rs = mysqli_fetch_row($res2) ) {
					$items[] = $rs;
				}
				
				//$res3 = $mysqli->query("DELETE FROM `dht11` WHERE `date` >= '$from' and `date` <= '$to'");
				
				//Define the filename with current date
				
				$fileName = "itemdata-".date('Y-m-d-h-i-sa').".csv";
				
				//Set header information to export data in excel format
				
				$path=getenv("HOMEDRIVE").getenv("HOMEPATH")."\Desktop";
				$fp=fopen($path."/".$fileName, 'w');
				$head=['ID','tmp','humidity','time'];
				fputcsv($fp, $head); 
				foreach ($items as $fields) { 
					fputcsv($fp, $fields); 
				} 
				fclose($fp);
			}
			if($myPost[8]=="delete"){
				
				$res3 = $mysqli->query("DELETE FROM `dht11` WHERE `date` >= '$from' and `date` <= '$to'");
			}
		}
		
		header('Location: index3.php');
	}
	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Arduino - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css?rndstr=<%=getRandomStr()     %>" rel="stylesheet">

	

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" >

        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            

                <!-- Begin Page Content -->
                <div class="container-fluid content-zoom" >

					
					
					<div id="1號機系統" class="tabcontent">
						
						<div class="text-xstext-primary" id="mainContent" style=" font-size:15px; padding: 10px 10px 25px 3px;">
							
							<div  id="realTimeTop">
								<table >
									
								</table>
							</div>
							<div id="realTime">
								<table style="color: #000000;" class="font-weight-bold">
									<tr style="color: #00008b; font-size:20px;" class="font-weight-bold" >
										
										<td >
											感測器
										</td>
										<td >
											開關
										</td>
										<td>
											設定數值
										</td>
										<td >
											即時數值
										</td>
										
									</tr>
									<tr >
										<td >
											感溫棒
										</td>
										
										<td >
											<div id="fan_switch2" style="padding: 10px 20px 10px 20px;">
												<label class="switch center" >
												  <input type="checkbox" id="fan_switch_toggle" onclick="fan_switch_function()">
												  <span class="slider round" ></span>
												</label>
											</div>
										</td>
										<td class="center" style="padding: 10px 30px 20px 30px;">
											<select id="siteSelect" name="sortby" onchange="">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
										</td>
										<td id="realtime1_2">
											
										</td>
									</tr>
									
									<tr >
										<td >
											水位
										</td>
										
										<td >
										</td>
										<td class="center" style="padding: 10px 30px 20px 30px;">
											<select id="siteSelect" name="sortby" onchange="">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
										</td>
										<td id="realtime1_3">
											
										</td>
									</tr>
									
									<tr >
										<td >
											水質
										</td>
										
										<td >
										</td>
										<td class="center" style="padding: 10px 30px 20px 30px;">
											<select id="siteSelect" name="sortby" onchange="">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
										</td>
										<td id="realtime1_4">
											
										</td>
									</tr>
									
									<tr >
										<td >
											#01馬達
										</td>
										
										<td >
											<div id="motor_switch" style="padding: 10px 20px 10px 20px;">
												<label class="switch center" >
												  <input type="checkbox" id="motor_switch_toggle" onclick="motor_switch_function()">
												  <span class="slider round" ></span>
												  
												</label>
											</div>
										</td>
										<td >
											
										</td>
										<td id="realtime1_1">
											
										</td>
									</tr>
									
									
									
									
									
									<tr >
										<td >
											\\\
										</td>
										
										<td >
										</td>
										<td >
											
										</td>
										<td id="realtime1_5">
											
										</td>
									</tr>
									
									<tr >
										<td >
											\\\
										</td>
										
										<td >
											<div id="fan_switch5" style="padding: 10px 20px 10px 20px;">
												<label class="switch center">
												  <input type="checkbox" id="fan_switch_toggle" onclick="fan_switch_function()">
												  <span class="slider round" ></span>
												</label>
											</div>
										</td>
										<td>
										</td>
										<td>
										</td>
									</tr>
									
									<tr >
										<td >
											\\\
										</td>
										
										<td >
											<div id="fan_switch6" >
												
											</div>
										</td>
										<td>
										</td>
										<td>
										</td>
									</tr>
									
									<tr >
										<td >
											\\\
										</td>
										
										<td >
											<font color="#ccc" style="font-size:15px">
											</font>
										</td>
										<td>
										</td>
										<td>
										</td>
									</tr>
									
									<tr >
										<td >
											\\\
										</td>
										<td >
										</td>
										<td>
										</td>
										<td id="realtime1_9">
											
										</td>
									</tr>
									<tr >
										<td >
											\\\
										</td>
										<td >
										</td>
										<td>
										</td>
										<td id="">
											
										</td>
									</tr>
								</table>
							</div>
						</div>
						
						
						
					
                    </div>
					
					
						
							
				</div>
							
							
							
						
					
            </div>
					
					<!-- Content Row -->
					
                    <div class="row-shrink" >
						
						<div id="collapseDHT" class="collapse" >
							<div class="col-xl-8 col-lg-7">
							<div class="card border-left-primary shadow h-10 py-2">
								<div class="card-body" >
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1" 
											style=" font-size:30px; padding: 10px 10px 25px 3px;"" >
												Set threshold : </div>
											<div class="h5 mb-0 font-weight-bold text-gray-800" >
												<div style="height:100px;">
												<table>
													<tr>
														<td style="padding: 10px 10px 5px 5px;">tmp</td>
														<td style="padding: 10px 10px 5px 5px;">
															<input type="text" name="tmp_tsh" placeholder="30" size="4" id="tmp_tsh" />
														</td>
														<td></td>
														<td style="padding: 10px 10px 5px 60px;">humidity</td>
														<td style="padding: 10px 10px 5px 5px;">
															<input type="text" name="hmd_tsh" placeholder="40" size="4" id="hmd_tsh" />
														</td>
														<td></td>
														<td style="padding: 10px 10px 5px 30px;">
															<button class="bg-light border-primary rounded" onclick="saveValue('tmp_tsh','hmd_tsh')" id="tsh_set_btn">set</button>
														</td>
													</tr>
													
												</table>	
												</div>
											</div>
											
											<div class="dropdown-divider"></div>
											
											<div>
											<table>
												<tr>
													<td>
														<div class="text-xs font-weight-bold text-primary text-uppercase mb-1" 
														style=" font-size:30px; padding: 10px 10px 25px 3px; " >	
															Past Data :	
														</div>
													</td>
													
													
													<td >
														<div style="padding: 10px 10px 25px 3px; ">
															<select id="sort" name="sortby" onchange="">
																<option>--</option>
																
															</select>
														</div>
													</td>
													<td>
														<div style="padding: 10px 10px 25px 3px; ">
															<select id="sort_order" name="sort_order" onchange="sortOrder()">
																<option>--</option>
															</select>
														</div>
													</td>
												</tr>
											</table>
											</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800" >
												<div style="height:400px;overflow:auto;">
												<table id="dht11_data_table">
													<tr>
														
														<th style="padding: 10px 10px 5px 5px;" onclick="sortDht11Table(0)">tmp</th>
														<td id="tmp_sort" class="fas fa-sort" style="padding: 10px 0px 5px 0px;"></td>
														<th style="padding: 10px 10px 5px 120px;" onclick="sortDht11Table(1)">humidity</th>
														<td id="hmd_sort" class="fas fa-sort" style="padding: 10px 0px 5px 0px;"></td>
														<th style="padding: 10px 5px 5px 120px;" onclick="sortDht11Table(2)">timestamp</th>
														<td id="date_sort" class="fas fa-sort" style="padding: 10px 0px 5px 0px;"></td>
														<td style="padding: 10px 100px 5px 700px;"></td>
													</tr>
													
													<tbody id="dht11_data_block" > 
													<tr >
														<!--
															load from realtime_past_data.php
														-->
														<td style="padding: 10px 10px 5px 5px;"></td>
														<td></td>
														<td style="padding: 10px 10px 5px 120px;"></td>
														<td></td>
														<td style="padding: 10px 10px 5px 140px;"></td>
														
													</tr>
													</tbody> 
												</table>
												</div>
												<form action="" method="POST" enctype="multipart/form-data" id="form1" style="padding: 50px 10px 5px 5px;">
													
													<table>
													<td>
														<div>
															<table>
															<tbody>
																<tr>
																	<td>From :</td>
																	<td></td>
																	<td>
																		<input id="date" type="date" name="date">
																	</td>
																	<td>
																		<select id="hour" name="hour">
																		</select>
																	</td>
																	
																	<td>
																		<select id="min" name="min">
																		</select>
																	</td>
																	
																	<td>
																		<select id="sec" name="sec">
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>To :</td>
																	<td></td>
																	<td>
																		<input id="date2" type="date" name="date2">
																	</td>
																	<td>
																		<select id="hour2" name="hour2">
																		</select>
																	</td>
																	
																	<td>
																		<select id="min2" name="min2">
																		</select>
																	</td>
																	
																	<td>
																		<select id="sec2" name="sec2">
																		</select>
																	</td>
																</tr>
															</tbody>	
															</table>
														</div>
													</td>
													<td style="padding: 10px 10px 5px 20px;">
														<div>
															<table>
																<tr>
																<td style="padding: 10px 10px 5px 1px;">
																	<button class="bg-light border-primary rounded" type="submit" form="form1" name="output" value="output" onclick="return popup1()">
																	<div class="text-xs font-weight-bold text-primary" 
																		style=" font-size:20px; padding: 5px 5px 5px 5px;">
																		Export
																	</div>
																	</button></td>
																
																<td style="padding: 10px 10px 5px 3px;">
																	<button class="bg-light border-primary rounded" type="submit" form="form1" name="delete" value="delete" onclick="return popup2()">
																	<div class="text-xs font-weight-bold text-primary" 
																		style=" font-size:20px; padding: 5px 5px 5px 5px;">
																		Delete
																	</div>
																	</button></td>
																</tr>
															</table>
														</div>
													</td>
													</table>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
						
					</div>
					
					
					
                    


                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white content-zoom2" >
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Arduino Dashboard Beta@NCCUMISLAB18</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" onclick="clear_login_pass()">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-pie-demo.js"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script src="js/swipe.js"></script>
	<script>
	
		$('[id^="fan_switch"]').click(function(e){
			e.stopPropagation()
		});
		$('[id^="flying"]').click(function(e){
			e.stopPropagation()
		});
		
		
		
	
		
		
		
		function login(){
		var userName=getWithExpiry("login_username");
		var password=getWithExpiry("login_password");
		$.ajax({
			type: "POST",
			url: 'db_login.php',
			dataType: 'text',
			data: {	
				userName: userName,
				password: password
			},
			success: function (response) {
				if(response=="Login Success!"){
					console.log("success!");
				}else{
					console.log("Failed!");
					location.href="login.html";
				}
			}
			});
			
		}
		login();
		
		
		function clear_login_pass() {
			localStorage.removeItem("login_username");
			localStorage.removeItem("login_password");
			location.href="login.html"
		}
		
		
		
		function openCity(evt, cityName) {
		  // Declare all variables
		  var i, tabcontent, tablinks;

		  // Get all elements with class="tabcontent" and hide them
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		  }

		  // Get all elements with class="tablinks" and remove the class "active"
		  tablinks = document.getElementsByClassName("tablinks");
		  for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		  }

		  // Show the current tab, and add an "active" class to the link that opened the tab
		  document.getElementById(cityName).style.display = "block";
		  evt.currentTarget.className += " active";
		}
		
		/***
		function motor_switch_function(){
		  var checkBox = document.getElementById("motor_switch_toggle");
		  if (checkBox.checked == false){
			localStorage.setItem("motor_switch", "false");
			
		  }else{
			localStorage.setItem("motor_switch", "true");
			
			console.log($port);
		  } 
		}
		***/
		
		function motor_switch_function(){
		  var checkBox = document.getElementById("motor_switch_toggle");
		  if (checkBox.checked == false){
			localStorage.setItem("motor_switch", "false");
			jQuery.ajax({
				type: "POST",
				url: 'motor_control.php',
				dataType: 'json',
				data: {
					motor_turn: 'off'
				},
			});
		  }else{
			localStorage.setItem("motor_switch", "true");
			jQuery.ajax({
				type: "POST",
				url: 'motor_control.php',
				dataType: 'json',
				data: {
					motor_turn: 'on'
				},
			});
		  } 
		  
		}
		
		
		/***
		function fan_switch_function() {
		  var checkBox = document.getElementById("fan_switch_toggle");
		  var range=document.getElementById("flying");
		  if (checkBox.checked == false){
			var fan_slider_value=range.value;
			
			range.value = 0;
			range.disabled = true;
			localStorage.setItem("fan_switch", "false");
		  }else{
			range.disabled = false;
			localStorage.setItem("fan_switch", "true");
			
		  } 
		}
		
		function saveSliderValue() {
			var range=document.getElementById("flying");
			
			var fan_slider_value=range.value;
			console.log(fan_slider_value);
			localStorage.setItem("fan_slider_value", fan_slider_value);  
		}
		***/
		if(getSavedValue("motor_switch")=="false"){
			document.getElementById("motor_switch_toggle").checked = false;
			
		}else{
			document.getElementById("motor_switch_toggle").checked = true;
		}
		/***
		if(getSavedValue("fan_slider_value")!=null){
			var range=document.getElementById("flying");
			range.value = getSavedValue("fan_slider_value");
			document.getElementById("flying_value").innerText = getSavedValue("fan_slider_value");
		}
		
		***/
		
		
		
		$(document).ready(function(){
			$("#realtime1_1").load("realtime2.php");
			 setInterval(function(){
				$("#realtime1_1").load("realtime2.php");
			 }, 3000);
			 
		});
		$("#dht11_data_block").load("realtime_past_data.php");
		
		
		$(document).ready(function(){
			var last_id_global=-1;
			 setInterval(function(){
				$.get('realtime_past_data_append.php', function(data){
					if(last_id_global!=parseInt(data.split("<tr")[0])){
						if(last_id_global==-1){
							last_id_global=parseInt(data.split("<tr")[0]);
						}else{
							last_id_global=parseInt(data.split("<tr")[0]);
							$("#dht11_data_block").append(data.split(last_id_global).pop());
						}
					}
					
				});
			 }, 3000);
		});
		
		
		
		
		$(document).ready(function(){
			$("#fromto").load("fromto_realtime.php");
			 setInterval(function(){
				$("#fromto").load("fromto_realtime.php");
			 }, 20000);
		});
		
		
		$(document).ready(function(){
			$("#dht_chart_block").load("dht11_tmp_realtime_chart.php");
			 setInterval(function(){
				$("#dht_chart_block").load("dht11_tmp_realtime_chart.php");
			 }, 20000);
		});
		
		$(document).ready(function(){
			$("#dht_chart_block2").load("dht11_hmd_realtime_chart.php");
			 setInterval(function(){
				$("#dht_chart_block2").load("dht11_hmd_realtime_chart.php");
			 }, 20000);
		});
		
		
		
		function hideFunction(id){
		  var list=["collapseDHT","collapse2","collapse3","collapse4"];
		  list.splice(list.indexOf(id),1);
		  var a = document.getElementById(id);
		  
		  var x = document.getElementById(list[0]);
		  var y = document.getElementById(list[1]);
		  var z = document.getElementById(list[2]);
		  x.style.display = "none";
		  y.style.display = "none";
		  z.style.display = "none";
		  a.style.display = "";
		}
		
		
		function popup1(){
			return confirm("Are you sure you want to export?");
		}
		function popup2(){
			return confirm("Are you sure you want to delete?");
		}
		
		
		$(document).ready(function(){
			overlay();
			setInterval(function(){
				overlay();
			}, 3000);
		});
		
		function overlay(){
			var cookieValue = document.getElementById('dht11_block').getElementsByTagName("td")[0].innerText;
			var tmp_tsh_value = getSavedValue("tmp_tsh");
			//console.log(cookieValue, parseInt(tmp_tsh_value)); 
			if(!document.getElementById("dht11_card").classList.contains('card-warning')){
				if(parseInt(cookieValue) >= parseInt(tmp_tsh_value)){
					document.getElementById("dht11_card").classList.remove('card');
					document.getElementById("dht11_card").classList.add('card-warning');
					
					if(getSavedValue("line_toggle")=="true"){
						jQuery.ajax({
							type: "POST",
							url: 'linebot.php',
							dataType: 'json',
							data: {
								access_token: getSavedValue("access_token"),
								msg: 'Temperature high '+cookieValue
							},
						});
					}
					alert("Temperature high");
					
				}else{
					if(document.getElementById("dht11_card").classList.contains('card-warning') ){
						document.getElementById("dht11_card").classList.remove('card-warning');
						document.getElementById("dht11_card").classList.add('card');
					}
				}
			}else{
				if(parseInt(cookieValue) < parseInt(tmp_tsh_value)){
					document.getElementById("dht11_card").classList.remove('card-warning');
					document.getElementById("dht11_card").classList.add('card');
				}
			}
			
		}
		
		
		document.getElementById("tmp_tsh").value = getSavedValue("tmp_tsh");    // set the value to this input
		document.getElementById("hmd_tsh").value = getSavedValue("hmd_tsh");   // set the value to this input
		/* Here you can add more inputs to set value. if it's saved */
		
		
        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(x, y){
			document.getElementById("tsh_set_btn").innerText="saved";
            var id1 = x;  // get the sender's id to save it . 
            var val1 = document.getElementById(x).value; // get the value. 
			var id2 = y;
			var val2 = document.getElementById(y).value;
            localStorage.setItem(id1, val1);// Every time user writing something, the localStorage's value will override . 
			localStorage.setItem(id2, val2);
			
			
		}

        //get the saved value function - return the value of "v" from localStorage. 
        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return "";// You can change this to your defualt value. 
            }
            return localStorage.getItem(v);
        }
		
		
		function getWithExpiry(key) {
			const itemStr = localStorage.getItem(key)
			// if the item doesn't exist, return null
			if (!itemStr) {
				return null
			}
			const item = JSON.parse(itemStr)
			const now = new Date()
			// compare the expiry time of the item with the current time
			if (now.getTime() > item.expiry) {
				// If the item is expired, delete the item from storage
				// and return null
				localStorage.removeItem(key)
				return null
			}
			return item.value
		}
		
		var options="";
		for(var hour = 0 ; hour <=23; hour++){
			if( 0 <= hour && hour <= 9){
				options += "<option>0"+ hour.toString() +"</option>";
			}else{
				options += "<option>"+ hour.toString() +"</option>";
			}
		  
		}
		document.getElementById("hour").innerHTML = options;		
		document.getElementById("hour2").innerHTML = options;
		
		
		var options="";
		for(var min = 0 ; min <=59; min++){
			if( 0<= min && min <= 9){
				options += "<option>0"+ min.toString() +"</option>";
			}else{
				options += "<option>"+ min.toString() +"</option>";
			}
		  
		}
		document.getElementById("min").innerHTML = options;		
		document.getElementById("min2").innerHTML = options;			
				
		var options="";
		for(var sec = 0 ; sec <=59; sec++){
			if( 0 <= sec && sec <= 9){
				options += "<option>0"+ sec.toString() +"</option>";
			}else{
				options += "<option>"+ sec.toString() +"</option>";
			}
		  
		}
		document.getElementById("sec").innerHTML = options;		
		document.getElementById("sec2").innerHTML = options;
		
		
		function sortDht11Table(n) {
			var msg1 ="";
			if(getSavedValue("dht11_sort_toggle") == "ASC"){
				localStorage.setItem("dht11_sort_toggle", "DESC");
				
			}else{
				localStorage.setItem("dht11_sort_toggle", "ASC");
			}
			var order=getSavedValue("dht11_sort_toggle");
			if(n == 0){
				msg1="Temperature";
				$("#tmp_sort").removeClass();
				document.getElementById("tmp_sort").classList.add('fas');
				if( order == "ASC" ){
					document.getElementById("tmp_sort").classList.add('fa-sort-up');
				}else{
					document.getElementById("tmp_sort").classList.add('fa-sort-down');
				}
				
				$("#date_sort").removeClass();
				document.getElementById("date_sort").classList.add('fas');
				document.getElementById("date_sort").classList.add('fa-sort');
				
				$("#hmd_sort").removeClass();
				document.getElementById("hmd_sort").classList.add('fas');
				document.getElementById("hmd_sort").classList.add('fa-sort');
			}else if(n == 1){
				msg1="humidity";
				$("#hmd_sort").removeClass();
				document.getElementById("hmd_sort").classList.add('fas');
				if( order == "ASC" ){
					document.getElementById("hmd_sort").classList.add('fa-sort-up');
				}else{
					document.getElementById("hmd_sort").classList.add('fa-sort-down');
				}
				
				$("#tmp_sort").removeClass();
				document.getElementById("tmp_sort").classList.add('fas');
				document.getElementById("tmp_sort").classList.add('fa-sort');
				
				$("#date_sort").removeClass();
				document.getElementById("date_sort").classList.add('fas');
				document.getElementById("date_sort").classList.add('fa-sort');
			}
			else if(n == 2){
				msg1="date";
				$("#date_sort").removeClass();
				document.getElementById("date_sort").classList.add('fas');
				if( order == "ASC" ){
					document.getElementById("date_sort").classList.add('fa-sort-up');
				}else{
					document.getElementById("date_sort").classList.add('fa-sort-down');
				}
				
				$("#hmd_sort").removeClass();
				document.getElementById("hmd_sort").classList.add('fas');
				document.getElementById("hmd_sort").classList.add('fa-sort');
				
				$("#tmp_sort").removeClass();
				document.getElementById("tmp_sort").classList.add('fas');
				document.getElementById("tmp_sort").classList.add('fa-sort');
			}
			$.ajax({
				type: "POST",
				url: 'realtime_past_data_sort.php',
				dataType: 'text',
				data: {	
					msg: msg1,
					order: order
				},
				success: function (response) {
				  $("#dht11_data_block").html(response);
				  
				}
			});
					
		  //$("#dht11_data_block").load("realtime_past_data_sort.php");
		}
	
		function toggle(){
			if($('#line_toggle').is(':checked') == true){
				localStorage.setItem("line_toggle", "true");
				console.log("on");
			}else{
				localStorage.setItem("line_toggle", "false");
				console.log("off");
			}
			
		}	
		
		
		
		
		
		
	</script>
		
	   
</body>

</html>