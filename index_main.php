<?php
	//index_main.php是首頁
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
		
		header('Location: index_main.php');
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
    <link href="css/sb-admin-2.css?rndstr=<%=   getRandomStr()             %>" rel="stylesheet">
	 
	

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
				<!-- topbar = height -->
				
                <nav class="content-zoom2 navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars " style="color:#036467"></i>
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

                    <!-- Page Heading -->
					<!--
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Sensors Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
					-->
                    <!-- Content Row -->
					
					
					<div class="row-master" >
					
                    <div class="row">
						
						
                        <!-- Earnings (Monthly) Card Example -->
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseDHT"
							aria-expanded="true" aria-controls="collapseDHT" onclick="hideFunction('collapseDHT')">
							<span>
							<div >
								<div class="card border-left-arduino shadow h-100 py-2" id="dht11_card">
									<div class="card-body" >
										<div class="row no-gutters align-items-center" >
											<div >
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
												style=" font-size:30px;" >Temp(DS18b20)</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800">
													<table>
														<tr>
															<td style="padding: 10px 10px 5px 5px;">tmp</td>
															
														</tr>
														
														<tr id="dht11_block">
															<!--
																load from realtime.php
															-->
															<td style="padding: 5px 10px 5px 5px;"></td>
															<!--
																<td><button onclick="upd(<?php echo $rs[0];?>)">選取</button></td>
															-->
														</tr>
														
													</table>
												
												</div>
												
												<!-- fan slider -->
												<div class= "text-arduino" style="padding: 25px 0px 0px 0px;">
													<form oninput="level.innerText = flevel.valueAsNumber" onchange="saveSliderValue()">
													<table>
														<tr>
														
															<td ><label for="flying"></label></td>
															
															<td style="padding: 0px 10px 3px 10px;">
																<input name="flevel" id="flying" type="range" min="0" max="100" value="0"> 
															</td>
															<td style="padding: 0px 10px 7px 5px;">
																<output for="flying" name="level" id="flying_value">0</output>/100
															</td>
															
															<td style="padding: 0px 0px 0px 10px;">
																<div id="fan_switch">
																	<label class="switch" style="float:right;">
																	  <input type="checkbox" id="fan_switch_toggle" onclick="fan_switch_function()">
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
						
						
						<!-- 展開 Content Row  -->
						
						<div class="row-shrink  content-zoom2" >
								<div class="col-xl-8 col-lg-7">
								<div id="collapseDHT" class="collapse card border-left-arduino shadow h-10 py-2 animated--grow-in" >
									<div class="card-body " >
										<div class="row no-gutters align-items-center ">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
												style=" font-size:30px; padding: 10px 10px 25px 3px;"" >
													Threshold : </div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<div style="height:100px;">
													<table>
														<tr>
															<td style="padding: 10px 10px 5px 5px;">tmp</td>
															<td style="padding: 10px 10px 5px 5px;">
																<input type="text" name="tmp_tsh" placeholder="30" size="4" id="tmp_tsh" />
															</td>
															<td></td>
															<!--
															<td style="padding: 10px 10px 5px 60px;">humidity</td>
															<td style="padding: 10px 10px 5px 5px;">
																<input type="text" name="hmd_tsh" placeholder="40" size="4" id="hmd_tsh" />
															</td>
															<td></td>
															-->
															<td style="padding: 10px 10px 5px 30px;">
																<button class="bg-light border-arduino rounded" onclick="saveValue('tmp_tsh')" id="tsh_set_btn">set</button>
															</td>
														</tr>
														
													</table>	
													</div>
												</div>
												
												<div class="dropdown-divider"></div>
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
													style=" font-size:30px; padding: 10px 10px 25px 3px;" >
														Sensor : 
												</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<div style="height:100px;">
													<table>
														<tr>
															<td style="padding: 10px 10px 5px 5px;">Read Interval(sec):</td>
															<td style="padding: 10px 10px 5px 2px;">
																<input type="number" min="1" name="temp_interval" placeholder="3" size="4" id="temp_interval" />
															</td>
															<td></td>
															<td style="padding: 10px 10px 5px 10px;">
																<button class="bg-light border-arduino rounded" onclick="saveValue('temp_interval');set_interval_function('temp_interval')" id="temp_interval_set_btn">set</button>
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
															<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
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
												<div class="h5 mb-0 font-weight-bold text-gray-800  content-zoom2" >
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
																		<button class="bg-light border-arduino rounded" type="submit" form="form1" name="output" value="output" onclick="return popup1()" >
																		<div class="text-xs font-weight-bold text-primary" 
																			style=" font-size:20px; padding: 5px 5px 5px 5px;">
																			Export
																		</div>
																		</button></td>
																	
																	<td style="padding: 10px 10px 5px 3px;">
																		<button class="bg-light border-arduino rounded" type="submit" form="form1" name="delete" value="delete" onclick="return popup2()">
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
					
						
                        <!-- Earnings (Monthly) Card Example -->
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse2"
							aria-expanded="true" aria-controls="collapse2" onclick="hideFunction('collapse2')">
						<span>
                        <div>
                            <div class="card border-left-arduino shadow h-100 py-2" id="level_card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div >
                                            <div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" style=" font-size:30px;">
                                                Water Level</div>
												
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<table>
													<tr>
														<td style="padding: 10px 10px 5px 5px;">Level</td>
														<td></td>
														<td style="padding: 10px 10px 5px 80px;">Voltage</td>
														<td style="padding: 10px 10px 5px 48px;"></td>
													</tr>
													<tr id="level_block">
														<!--
															load from realtime
														-->
														<td style="padding: 5px 10px 5px 5px;"></td>
														<td></td>
														<td style="padding: 5px 10px 5px 80px;"></td>
													</tr>
												</table>
											</div>
											
											<!-- fan slider 2-->
											<div class="text-arduino" style="padding: 25px 0px 0px 0px;">
												<form oninput="level.innerText = flevel.valueAsNumber" onchange="saveSliderValue()">
												<table>
													<tr>
													
														<td ><label for="flying2"></label></td>
														
														<td style="padding: 0px 10px 3px 10px;">
															<input name="flevel" id="flying2" type="range" min="0" max="100" value="0"> 
														</td>
														<td style="padding: 0px 10px 7px 5px;">
															<output for="flying2" name="level" id="flying_value2">0</output>/100
														</td>
														
														<td style="padding: 0px 0px 0px 10px;">
															<div id="fan_switch2">
																<label class="switch" style="float:right;">
																  <input type="checkbox" id="fan_switch_toggle2" onclick="fan_switch_function()">
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
										<!--
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</span>
						</a>
						
						<!-- Content Row -->
						<div class="row-shrink">
								<div class="col-xl-8 col-lg-7">
								<div id="collapse2" class="collapse card border-left-arduino shadow h-10 py-2 animated--grow-in">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
													style=" font-size:30px; padding: 10px 10px 25px 3px;" >
														Threshold : 
												</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<div style="height:100px;">
													<table>
														<tr>
															<td style="padding: 10px 10px 5px 5px;">Level:</td>
															<!--
															<td style="padding: 10px 10px 5px 60px;">humidity</td>
															<td style="padding: 10px 10px 5px 5px;">
																<input type="text" name="hmd_tsh" placeholder="40" size="4" id="hmd_tsh" />
															</td>
															<td></td>
															-->
															
															<td >
																<div style="padding: 10px 10px 5px 20px;">
																	<select id="level_tsh" name="" onchange="saveSelected('level_tsh')" style="border-radius: 3.35px">
																		<option>--</option>
																		<option value="Empty">Empty</option>
																		<option value="Low">Low</option>
																		<option value="High">High</option>
																	</select>
																</div>
															</td>
															
														</tr>
														
													</table>	
													</div>
												</div>
												
												<div class="dropdown-divider"></div>
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
													style=" font-size:30px; padding: 10px 10px 25px 3px;" >
														Sensor : 
												</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<div style="height:100px;">
													<table>
														<tr>
															<td style="padding: 10px 10px 5px 5px;">Read Interval(sec):</td>
															<td style="padding: 10px 10px 5px 2px;">
																<input type="number" min="1"  name="level_interval" placeholder="5" size="4" id="level_interval"/>
															</td>
															<td></td>
															<td style="padding: 10px 10px 5px 10px;">
																<button class="bg-light border-arduino rounded" onclick="saveValue('level_interval');set_interval_function('level_interval')" id="level_interval_set_btn">set</button>
															</td>
															
															
														</tr>
														
													</table>	
													</div>
												</div>
												
												
												<div class="dropdown-divider"></div>
												<table>
													<tr>
													
													<td>
													<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
													style=" font-size:30px; padding: 10px 10px 25px 3px;" >
														Past Data : </div>
													</td>
													<td >
														<div style="padding: 10px 10px 25px 3px; ">
															<select id="sort" name="sortby" onchange="">
																<option>--</option>
																
															</select>
														</div>
													</td>
												</table>

												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<table >
														<tr>
															<td style="padding: 10px 10px 5px 5px;"></td>
															<td></td>
															<td style="padding: 10px 10px 5px 120px;"></td>
															<td></td>
															<td style="padding: 10px 5px 5px 120px;">timestamp</td>
															<td style="padding: 10px 100px 5px 700px;"></td>
														</tr>
													</table>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
						</div>
						
					</div>
					
					
					
						
					<div class="row">
						
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse3"
							aria-expanded="true" aria-controls="collapse3" onclick="hideFunction('collapse3')">
						<span>
                        <div>
                            <div class="card border-left-arduino shadow h-100 py-2" id="turb_card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div >
                                            <div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" style=" font-size:30px;">
											Turbidity
                                            </div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<table>
													<tr>
														<td style="padding: 10px 10px 5px 5px;">Voltage</td>
													</tr>
													<tr id="turb_block">
														<!--
															load from realtime
														-->
														<td style="padding: 5px 10px 5px 5px;"></td>
														
													</tr>
												</table>
											</div>
											<!-- fan slider 3-->
											<div class="text-arduino" style="padding: 25px 0px 0px 0px;">
												<form oninput="level.innerText = flevel.valueAsNumber" onchange="saveSliderValue()">
												<table>
													<tr>
													
														<td ><label for="flying3"></label></td>
														
														<td style="padding: 0px 10px 3px 10px;">
															<input name="flevel" id="flying3" type="range" min="0" max="100" value="0"> 
														</td>
														<td style="padding: 0px 10px 7px 5px;">
															<output for="flying3" name="level" id="flying_value3">0</output>/100
														</td>
														
														<td style="padding: 0px 0px 0px 10px;">
															<div id="fan_switch3">
																<label class="switch" style="float:right;">
																  <input type="checkbox" id="fan_switch_toggle3" onclick="fan_switch_function()">
																  <span class="slider round" ></span>
																</label>
															</div>
														</td>
													</tr>
												</table>
												</form>	
											</div>
											<!-- fan slider -->
                                            <div class="row no-gutters align-items-center">
											<!--
                                                <div class="col-auto">
													
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
													
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
											-->	
                                            </div>
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
						<div class="row-shrink">
								<div class="col-xl-8 col-lg-7">
								<div id="collapse3" class="collapse card border-left-arduino shadow h-10 py-2 animated--grow-in">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
											
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
													style=" font-size:30px; padding: 10px 10px 25px 3px;" >
														Sensor : 
												</div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<div style="height:100px;">
													<table>
														<tr>
															<td style="padding: 10px 10px 5px 5px;">Read Interval(sec):</td>
															<td style="padding: 10px 10px 5px 2px;">
																<input type="number" min="1" name="turb_interval" placeholder="5" size="4" id="turb_interval" />
															</td>
															<td></td>
															<td style="padding: 10px 10px 5px 10px;">
																<button class="bg-light border-arduino rounded" onclick="saveValue('turb_interval');set_interval_function('turb_interval')" id="turb_interval_set_btn">set</button>
															</td>
															
															
														</tr>
														
													</table>	
													</div>
												</div>
												
												<div class="dropdown-divider"></div>
												
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
												style=" font-size:30px; padding: 10px 10px 25px 3px;"" >
													Past Data : </div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<table >
														<tr>
															<td style="padding: 10px 10px 5px 5px;"></td>
															<td></td>
															<td style="padding: 10px 10px 5px 120px;"></td>
															<td></td>
															<td style="padding: 10px 5px 5px 120px;">timestamp</td>
															<td style="padding: 10px 100px 5px 700px;"></td>
														</tr>
													</table>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
							
						</div>
						
					
						
                        <!-- Pending Requests Card Example -->
						<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse4"
							aria-expanded="true" aria-controls="collapse4" onclick="hideFunction('collapse4')">
						<span>
                        <div>
                            <div class="card border-left-arduino shadow h-100 py-2" id="sensor4_card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div >
                                            <div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" style=" font-size:30px;">
                                                ORP</div>
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

						<div class="row-shrink">
								<div class="col-xl-8 col-lg-7">
								<div id="collapse4" class="collapse card border-left-arduino shadow h-10 py-2 animated--grow-in">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold text-arduino text-uppercase mb-1" 
												style=" font-size:30px; padding: 10px 10px 25px 3px;"" >
													Past Data : </div>
												<div class="h5 mb-0 font-weight-bold text-gray-800" >
													<table >
														<tr>
															<td style="padding: 10px 10px 5px 5px;"></td>
															<td></td>
															<td style="padding: 10px 10px 5px 120px;"></td>
															<td></td>
															<td style="padding: 10px 5px 5px 120px;">timestamp</td>
															<td style="padding: 10px 100px 5px 700px;"></td>
														</tr>
													</table>
													
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
                    
					
					
					
					
					
					
					
					

					
					
					
					
					
					
					
					
					
					
					
					
					
					
                    <!-- Content Row -->
					<!-- chart -->
					
					
 
					
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
							<!--
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Database load</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">DHT11 <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
							-->
                            <!-- Color System -->
							<!--
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
						-->
						<!--
                        <div class="col-lg-6 mb-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>
						-->
                            <!-- Approach -->
							<!--
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>
							-->
                        </div>
                    </div>
					

                </div>
                <!-- /.container-fluid -->
				

            </div>
            <!-- End of Main Content -->
			<!-- End of Content Wrapper -->
        
		
		
	
	
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
		
		function saveSelected(id) {
			var item=document.getElementById(id);
			localStorage.setItem(id, item.options[item.selectedIndex].value);  
			console.log(item.options[item.selectedIndex].value);
		}
		
		if(getSavedValue("level_tsh")!=null){
			$("#level_tsh").val(getSavedValue("level_tsh"));
			console.log(getSavedValue("level_tsh"));
		}
		
		
		if(getSavedValue("fan_switch")=="false"){
			document.getElementById("fan_switch_toggle").checked = false;
			document.getElementById("flying").disabled = true;
		}else{
			document.getElementById("fan_switch_toggle").checked = true;
			document.getElementById("flying").disabled = false;
		}
		
		if(getSavedValue("fan_slider_value")!=null){
			var range=document.getElementById("flying");
			range.value = getSavedValue("fan_slider_value");
			document.getElementById("flying_value").innerText = getSavedValue("fan_slider_value");
		}
		
		
		
		
		
		
		<!-- value realtime update -->
		
		$(document).ready(function(){
			$("#dht11_block").load("realtime.php");
			 setInterval(function(){
				$("#dht11_block").load("realtime.php");
			 }, 3000);
		});
		
		$(document).ready(function(){
			$("#level_block").load("realtime_level.php");
			 setInterval(function(){
				$("#level_block").load("realtime_level.php");
			 }, 3000);
		});
		
		$(document).ready(function(){
			$("#turb_block").load("realtime_turb.php");
			 setInterval(function(){
				$("#turb_block").load("realtime_turb.php");
			 }, 3000);
		});
		
		<!-- -->
		
		
		
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
		
		
		/** chart 
		
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
		**/
		
		function hideFunction(id){
		  var belowDiv;
		  var list=["collapseDHT","collapse2","collapse3","collapse4"];
		  var card_list = ["dht11_card","level_card","turb_card","sensor4_card"];
		  list.splice(list.indexOf(id),1);
		  var a = document.getElementById(id);
		  
		  var x = document.getElementById(list[0]);
		  var y = document.getElementById(list[1]);
		  var z = document.getElementById(list[2]);
		  x.style.display = "none";
		  y.style.display = "none";
		  z.style.display = "none";
		  
		  /**
		  if(id=="collapseDHT"){
			  belowDiv = document.getElementById(card_list[1])
		  }else if(id=="collapse2"){
			  belowDiv = document.getElementById(card_list[2]) 
		  }
		  belowDiv.insertBefore(a, belowDiv)
		  **/
		  a.style.display = "";
		  a.style.marginBottom = "100px";
		  a.style.marginTop = "-3px";
		  a.style.borderTopLeftRadius = "70px";
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
		
		if(getSavedValue("tmp_tsh")!=null){
			document.getElementById("tmp_tsh").value = getSavedValue("tmp_tsh");
		}
		
		if(getSavedValue("hmd_tsh")!=null){
			document.getElementById("hmd_tsh").value = getSavedValue("hmd_tsh");   // set the value to this input
		}
		
		if(getSavedValue("temp_interval")!=null){
			document.getElementById("temp_interval").value = getSavedValue("temp_interval");
		}
		
		if(getSavedValue("level_interval")!=null){
			document.getElementById("level_interval").value = getSavedValue("level_interval");
		}
		if(getSavedValue("turb_interval")!=null){
			document.getElementById("turb_interval").value = getSavedValue("turb_interval");
		}
		
		/* Here you can add more inputs to set value. if it's saved */
		
		
        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(x){
			//document.getElementById("tsh_set_btn").innerText="saved";
            var id1 = x;  // get the sender's id to save it . 
            var val1 = document.getElementById(x).value; // get the value. 
			//var id2 = y;
			//var val2 = document.getElementById(y).value;
            localStorage.setItem(id1, val1);// Every time user writing something, the localStorage's value will override . 
			//localStorage.setItem(id2, val2);
		}

        //get the saved value function - return the value of "v" from localStorage. 
        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return null;// You can change this to your defualt value. 
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
		
		
		function set_interval_function(id){
		  var saved_interval = getSavedValue(id);
		  if (saved_interval != null){
			console.log(saved_interval);
			jQuery.ajax({
				type: "POST",
				url: 'http://192.168.50.50/arduino_web/sensor_interval.php',
				dataType: 'json',
				data: {
					interval: [id, saved_interval]
				},
				success: function (response) {
					console.log(response);
				
				},
				error: function(response){
					console.log(response);
					console.log(response.responseText);
				}
			});
			
		  }
		  
		}
		
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
					$('#wrapper').animate({'right' : 400} , 100 , function(){
					   location.href = 'control_page.php';
					});
					
				} else {
					/* left swipe */
					console.log("swipe left!!");
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