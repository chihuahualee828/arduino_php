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
    <link href="css/sb-admin-2.css?rndstr=<%=getRandomStr()   %>" rel="stylesheet">

	

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" >
		<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-arduino sidebar sidebar-dark accordion toggled " id="accordionSidebar" >

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_main.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i ></i>
                </div>
				<div >Aquarium Monitor</div>
                <!--<div class="sidebar-brand-text mx-3">Arduino admin beta</div>-->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index_main.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
				<a class="nav-link" href="control.php">
                    <i class="fas fa-fw fa-fan"></i>
                    <span>Control</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->
		
		

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
				
				<!-- Topbar -->
				<!-- topbar = height -->
                <nav class="content-zoom2 navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars " style="color:#036467"></i>
                    </button>

                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">1+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <!--<i class="fas fa-file-alt text-white"></i>-->
                                        </div>
                                    </div>
									<!--
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
									-->
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
											<!--<i class="fas fa-donate text-white"></i>-->
                                        </div>
                                    </div>
									<!--
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
									-->
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <!--<i class="fas fa-exclamation-triangle text-white"></i>-->
                                        </div>
                                    </div>
									<!--
                                    <div>
									
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
									-->
                                </a>
                                <!--<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>-->
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
						<!-- .topbar .nav-item .nav-link .img-profile : icon radius-->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">NCCU</span>
                                <img class="img-profile rounded-circle"
                                    src="img/nervous-chihuahua.jpg" >
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
								<!--
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
								-->
                                <a class="dropdown-item" href="settings.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
								<!--
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
								-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
				
				
                <!-- Begin Page Content -->
                <div class="container-fluid content-zoom2" >

					
					<div class="row-master" >
					
                    <div class="row">
						
						
                        <!-- Earnings (Monthly) Card Example -->
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseDHT"
							aria-expanded="true" aria-controls="collapseDHT" onclick="">
							<span>
								<div class="card border-left-arduino shadow h-100 py-2" id="feed_card">
									<div class="card-body" >
										<div class="row no-gutters align-items-center" >
											
											<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
											style=" font-size:32px; padding: 10px 0px 10px 15px; float: left;" >餵食
											</div>
											
											
											<!--
											<div id="fan_switch" style="padding: 0px 10px 0px 100px;">
												<label class="switch" style="float:right;">
												  <input type="checkbox" id="fan_switch_toggle" onclick="fan_switch_function()">
												  <span class="slider round" ></span>
												</label>
											</div>
										    -->			
										</div>
										<div id="motor_switch" style="padding: 0px 0px 5px 0px; margin-left: 320px;">
											<button class="bg-light border-arduino" style="border-radius: 1.5rem; width:130px; height:70px;" id="feed_button" onclick="motor_switch_function2(); 
												changeButtonText('feed_button_text','Feed', 'Feeded!')">
												<div class=" text-arduino" 
													style=" font-size:27px; font-weight:bold; padding: 5px 5px 5px 5px;", id="feed_button_text">
													Feed
												</div>
											</button>
										</div>
									</div>
								</div>
							</span>
						</a>
						
						

					
						
                        <!-- Earnings (Monthly) Card Example -->
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse2"
							aria-expanded="true" aria-controls="collapse2" onclick="">
						<span>
                        <div>
                            <div class="card border-left-arduino shadow h-100 py-2" id="level_card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div >
                                            <div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" style="font-size:32px; padding: 10px 0px 10px 15px; float: left;">
                                                加水</div>
											
                                        </div>
										<div id="fan_switch2" style="padding: 15px 40px 0px 0px; margin-left: 320px;">
											<label class="switch" style="float:right;">
											  <input type="checkbox" id="fan_switch_toggle2" onclick="fan_switch_function()">
											  <span class="slider round" ></span>
											</label>
										</div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
						</span>
						</a>
				
					</div>
					
					
					
						
					<div class="row">
						
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse3"
							aria-expanded="true" aria-controls="collapse3" onclick="">
						<span>
                        <div>
                            <div class="card border-left-arduino shadow h-100 py-2" id="turb_card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div >
                                            <div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" style=" font-size:32px; padding: 10px 0px 10px 15px; float: left;">
											換水
                                            </div>
											
                                        </div>
										
										<div style="padding: 15px 40px 0px 0px; margin-left: 320px;">
											<form oninput="level.innerText = flevel.valueAsNumber" onchange="saveSliderValue()">
											<div id="fan_switch3">
												<label class="switch" style="float:right;">
												  <input type="checkbox" id="fan_switch_toggle3" onclick="fan_switch_function()">
												  <span class="slider round" ></span>
												</label>
											</div>
											</form>	
										</div>
                                        <div class="col-auto">
                                            <i class=""></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</span>
						</a>

						
					
						
                        <!-- Pending Requests Card Example -->
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse4"
							aria-expanded="true" aria-controls="collapse4" onclick="">
						<span>
                        <div>
                            <div class="card border-left-arduino shadow h-100 py-2" id="sensor4_card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div >
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style=" font-size:30px;">
                                                </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<table>
													<tr>
														<td style="padding: 10px 10px 5px 5px;"></td>
														<td></td>
														<td style="padding: 10px 10px 5px 100px;"></td>
														<td style="padding: 10px 10px 5px 15px;"></td>	
													</tr>
													<tr id="sensor4_block">
														<!--
															load from realtime
														-->
														<td style="padding: 5px 10px 5px 5px;"></td>
														<td></td>
														<td style="padding: 5px 10px 5px 100px;"></td>
														
													</tr>
												</table>
											</div>
											<!-- fan slider 4-->
											<div class="text-arduino" style="padding: 25px 0px 0px 0px;">
												<form oninput="level.innerText = flevel.valueAsNumber" onchange="saveSliderValue()">
												<table>
													<tr>
													
														<td ><label for="flying4"></label></td>
														
														<td style="padding: 0px 10px 3px 10px;">
															<input name="flevel" id="flying4" type="range" min="0" max="100" value="0"> 
														</td>
														<td style="padding: 0px 10px 7px 5px;">
															<output for="flying4" name="level" id="flying_value4">0</output>/100
														</td>
														
														<td style="padding: 0px 0px 0px 10px;">
															<div id="fan_switch4">
																<label class="switch" style="float:right;">
																  <input type="checkbox" id="fan_switch_toggle4" onclick="fan_switch_function()">
																  <span class="slider round" ></span>
																</label>
															</div>
														</td>
													</tr>
												</table>
												</form>	
											</div>
											<!-- fan slider -->
                                        </div>
                                        <div class="col-auto">
                                            <i class=""></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</span>
						</a>
						<!-- Content Row -->


						
					</div>
                    </div>	
					
					
					
					
						
							
				</div>
							
							
							
						
					
            </div>
					
					
					
					
					
                    


                </div>
            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
	
	
	<!-- Footer -->
	<footer class=" bg-white">
		<div class="container my-auto">
			<div class=" text-center my-auto" style=" font-size:10px;">
				<span>Aquarium Dashboard@NCCUMISLAB18</span>
			</div>
		</div>
	</footer>
	<!-- End of Footer -->
	

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
				if(response.includes("Login Success!")){
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
			localStorage.setItem("motor_switch", "true");ㄘㄣ
			
			console.log($port);
		  } 
		}
		***/
		
		/** for toggle only **/
		function motor_switch_function(){
		  var checkBox = document.getElementById("motor_switch_toggle");
		  if (checkBox.checked == false){
			localStorage.setItem("motor_switch", "false");
			jQuery.ajax({
				type: "POST",
				url: 'http://192.168.50.65/arduino_web/motor_control.php',
				dataType: 'json',
				data: {
					motor_turn: 'off'
				},
			});
		  }else{
			localStorage.setItem("motor_switch", "true");
			jQuery.ajax({
				type: "POST",
				url: 'http://192.168.50.65/arduino_web/motor_control.php',
				dataType: 'json',
				data: {
					motor_turn: 'on'
				},
			});
		  } 
		  
		}
		
		/** for onclick **/
		function motor_switch_function2(){
		  
			jQuery.ajax({
				type: "POST",
				url: 'http://192.168.50.65/arduino_web/motor_control.php',
				dataType: 'json',
				data: {
					motor_turn: 'on'
				},
			});
		}
		
		function changeButtonText(id,before,after){
			button_text = document.getElementById(id);
			/**
			const button_text_width = button_text.offsetWidth;
			const button_text_height = button_text.offsetHeight;
			**/
			button_text.innerText= after;
			/**
			button_text.style.width = `${button_text_width}px`;
			button_text.style.height = `${button_text_height}px`;
			**/
			setTimeout(function() { 
				back(button_text, before);
			}, 5000);
			function back(button, textToChangeBackTo){ 
				button_text.innerText= textToChangeBackTo;
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
		
		
		/** 馬達開關 toggle
		if(getSavedValue("motor_switch")=="false"){
			document.getElementById("motor_switch_toggle").checked = false;
			
		}else{
			document.getElementById("motor_switch_toggle").checked = true;
		}
		**/
		
		
		
		/***
		if(getSavedValue("fan_slider_value")!=null){
			var range=document.getElementById("flying");
			range.value = getSavedValue("fan_slider_value");
			document.getElementById("flying_value").innerText = getSavedValue("fan_slider_value");
		}
		
		***/
		
		
		/***
		$(document).ready(function(){
			$("#realtime1_1").load("realtime2.php");
			 setInterval(function(){
				$("#realtime1_1").load("realtime2.php");
			 }, 3000);
			 
		});
		***/
		$("#dht11_data_block").load("realtime_past_data.php");
		
		$(document).ready(function(){
			$("#realtime_level").load("realtime_level.php");
			 setInterval(function(){
				$("#realtime_level").load("realtime_level.php");
			 }, 3000);
			 
		});
		
		$(document).ready(function(){
			$("#realtime_turb").load("realtime_turb.php");
			 setInterval(function(){
				$("#realtime_turb").load("realtime_turb.php");
			 }, 3000);
			 
		});
		
		
		
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
		
		
		
		
		// set the value to this input
		// set the value to this input
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
		
		
		
				
				

	
		function toggle(){
			if($('#line_toggle').is(':checked') == true){
				localStorage.setItem("line_toggle", "true");
				console.log("on");
			}else{
				localStorage.setItem("line_toggle", "false");
				console.log("off");
			}
			
		}	
		
		
		document.addEventListener('touchstart', handleTouchStart, false);        
		document.addEventListener('touchmove', handleTouchMove, false);

		var xDown = null;                                                        
		var yDown = null;

		function getTouches(evt) {
		  return evt.touches ||             // browser API
				 evt.originalEvent.touches; // jQuery
		}                                                     
																				 
		function handleTouchStart(evt) {
			const firstTouch = getTouches(evt)[0];                                      
			xDown = firstTouch.clientX;                                      
			yDown = firstTouch.clientY;   	
		};                                                
																				 
		function handleTouchMove(evt) {
			if ( ! xDown || ! yDown ) {
				return;
			}

			var xUp = evt.touches[0].clientX;                                    
			var yUp = evt.touches[0].clientY;

			var xDiff = xDown - xUp;
			var yDiff = yDown - yUp;
																				 
			if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
				if ( xDiff > 0 ) {
					/* right swipe */ 
					console.log("swipe right!!");
					
					
				} else {
					/* left swipe */
					console.log("swipe left!!");
					$('#wrapper').animate({'left' : 500} , 100 , function(){
					   location.href = 'index_main.php';
					});
				}                       
			} else {
				if ( yDiff > 0 ) {
					/* down swipe */ 
					console.log("swipe down!!");
				} else { 
					/* up swipe */
					console.log("swipe up!!");
				}                                                                 
			}
			
			/* reset values */
			xDown = null;
			yDown = null;                                             
		};
		
		
		
		
		
	</script>
		
	   
</body>

</html>