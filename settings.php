<?php
	
	if (isset($_POST['error'])) {
	  echo "error:" .$_POST['error'];
	  echo "<br>";
	  echo "error_description:" .$_POST['error_description'];
	  echo "<br>";
	  exit;
	};
	$access_token="";
	$Push_Content['grant_type'] = "authorization_code";
	if(isset($_POST['code'])){
		$Push_Content['code'] = $_POST['code'];
	}
	$Push_Content['redirect_uri'] = "http://192.168.50.50/arduino_web/settings.php";
	$Push_Content['client_id'] = "sLpgsAhqt1P3boPHXxKUhe";
	$Push_Content['client_secret'] = "SVzAuYcloeitr7S40p5CxxCimm6o3zV4vTYbvLJsQtx";
	 // Auth Line Official Connect Step-1
	//print_r($Push_Content);
	//echo "<hr>";
	//echo json_encode($Push_Content);
	//echo "<hr>";
	$ch = curl_init("https://notify-bot.line.me/oauth/token");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Push_Content));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	   'Content-Type: application/x-www-form-urlencoded'
	));
	$response_json_str = curl_exec($ch);
	curl_close($ch);
	//echo $response_json_str.'<hr>';
	$response = json_decode($response_json_str, true);
	if (!isset($response['status']) || $response['status'] != 200 || !isset($response['access_token'])) {
		//echo 'Request failed';
	} else if (preg_match('/[^a-zA-Z0-9]/u', $response['access_token'])) {
		//echo 'Got wired access_token: '.$response['access_token']."<br>";
		//echo 'http_response_header'.$http_response_header."<br>";
		//echo 'response_json'.$response_json_str."<br>";
	} else {
		$access_token=$response['access_token'];
		//echo 'access_token: '.$access_token;
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
    <link href="css/sb-admin-2.css?rndstr=<%= getRandomStr()  %>" rel="stylesheet">
	
	

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
				<a class="nav-link" href="control_page.php">
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
                <nav class="content-zoom2 navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color:#036467"></i>
                    </button>

                    <!-- Topbar Search -->
					<!--
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
					-->
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

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
							<!--
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
								
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
							-->
                            <!-- Dropdown - Messages -->
							<!--
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
							-->
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
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
                                <a class="dropdown-item" href="#">
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
				
				
				<div class="" >
                    <div class="col-xl-13 col-lg-7">
						
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
								
								<a class="nav-link">
								<span>
								<div class="text-xs font-weight-bold mb-1 text-arduino" 
												style=" font-size:30px;" >Settings</div>
								</span>
								</a>
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">My Profile 
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area content-zoom2" style="padding: 0px 0px 0px 20px;">
										Line Link
										<button class="bg-light border-arduino rounded" style="float:right; margin-right: 5px;" 
										onclick="oAuth2()" id="line_link">
											<div class="text-xs font-weight-bold text-arduino" style=" font-size:15px;">
											Link
											</div>
										</button>
										
										<div class="setting-divider"></div>
                                    </div>
                                </div>
								<div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">App 
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" >
                                    <div class="chart-area content-zoom2" style="padding: 0px 0px 0px 20px;">
										Line Notify
										<label class="switch" style="float:right;" >
										  <input type="checkbox" id="line_toggle" onclick="toggle()" >
										  <span class="slider round" ></span>
										</label>
										<div class="setting-divider"></div>
										Connect to Database 
										<label class="switch" style="float:right;" >
										  <input type="checkbox" id="database_toggle" onclick="" >
										  <span class="slider round" ></span>
										</label>
										<div class="setting-divider"></div>
										<div style="padding: 0px 0px 30px 0px;">
											<div style="float:left">
												Notification
											</div>
											<label class="switch" style=" float:right;" >
											  <input type="checkbox" id="notification_toggle" onclick="" >
											  <span class="slider round" ></span>
											</label>
										</div>
										<div class="setting-divider" style="padding: 0px 0px 0px 0px;">
										</div>
                                    </div>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
		
		
		if('<?php echo $access_token; ?>'!=""){
			localStorage.setItem("access_token", '<?php echo $access_token; ?>');
		}
		
		console.log(getSavedValue("access_token"));
		
		if(getSavedValue("access_token") == ""){
			document.getElementById("line_link").innerText="Link";
		}else{
			document.getElementById("line_link").innerText="Linked";
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
		
		if(getSavedValue("line_toggle")=="false"){
			document.getElementById("line_toggle").checked = false;
		}else{
			document.getElementById("line_toggle").checked = true;
		}
		
		if(document.getElementById("line_link").innerText=="Link"){
			document.getElementById("line_toggle").checked = false;
			document.getElementById("line_toggle").disabled = true;
			localStorage.setItem("line_toggle", "false");
		}
		
		
		function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return "";// You can change this to your defualt value. 
            }
            return localStorage.getItem(v);
        }
		
		
		/*
		function redirect_line(){
			document.location.href="https://notify-bot.line.me/my/";
			
		}
		*/
		function oAuth2() {
			if(document.getElementById("line_link").innerText == "Link"){
				var URL = 'https://notify-bot.line.me/oauth/authorize?';
				URL += 'response_type=code';
				URL += '&client_id=sLpgsAhqt1P3boPHXxKUhe';
				URL += '&redirect_uri=http://192.168.50.50/arduino_web/settings.php';
				URL += '&scope=notify';
				URL += '&state=NO_STATE';
				URL += '&response_mode=form_post';
				window.location.href = URL;
			}else{
				if(confirm("unlink your Line?")==true){
					document.getElementById("line_link").innerText="Link";
					localStorage.setItem("access_token", "");
				}else{
					
				}
				
			}
            
			
        }
		/*
		function httpGet()
		{
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open( "GET", "https://notify-bot.line.me/oauth/authorize", false ); // false for synchronous request
			xmlHttp.send( null );
			return xmlHttp.responseText;
		}
		*/
	
	</script>
		
	   
</body>

</html>