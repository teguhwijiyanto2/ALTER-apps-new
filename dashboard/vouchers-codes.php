<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';

$results_1 = DB::queryFirstRow("select * from vouchers where uuid=%s", $_GET['uuidx']);
//echo $results_1['uuid'];

$str_users_voucher_code = "0, ";
$results_2 = DB::query("select single_user_id from voucher_codes where uuid=%s AND single_user_id<>0", $_GET['uuidx']);
foreach ($results_2 as $row_2) {
	$str_users_voucher_code .= "'".$row_2['single_user_id']."',";
} // foreach ($results_2 as $row_2) {
$str_users_voucher_code = substr($str_users_voucher_code,0,-2);
//echo $str_users_voucher_code;

/*
$array_users_voucher_code = array();
$results_3 = DB::query("select single_user_id from voucher_codes where uuid=%i AND single_user_id NOT IN (".%s.")", $_GET['uuidx'], $str_users_voucher_code);
foreach ($results_3 as $row_3) {
	$array_users_voucher_code[] = "".$row_3['single_user_id']."";
} // foreach ($results_3 as $row_3) {
*/


$array_users_name = array();
$array_users_email = array();
$array_users_username = array();
$results_A = DB::query("SELECT * FROM users");
foreach ($results_A as $row_A) {
	$array_users_name[$row_A['id']] = "".$row_A['name']."";
	$array_users_email[$row_A['id']] = "".$row_A['email']."";
	$array_users_username[$row_A['id']] = "".$row_A['username']."";
} // foreach ($results_A as $row_A) {
//echo $array_users_username[$row_A['id']];


$str_option_users_voucher_code = "0, ";
$results_3 = DB::query("select id from users where id NOT IN (%s) AND name IS NOT NULL", $str_users_voucher_code);
foreach ($results_3 as $row_3) {
	$str_option_users_voucher_code .= "<option value='".$row_3['id']."'>".$array_users_name[$row_3['id']]."</option>";
} // foreach ($results_3 as $row_3) {
//echo $str_option_users_voucher_code;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>ALTER dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<!--
				<a href="../index.html" class="logo">
					<img src="assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
				</a>
				-->
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search in ALTER..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-envelope"></i>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										Messages 									
										<!--<a href="#" class="small">Mark all as read</a>-->
										<a href="#" class="small">Ini buat message to ALTER</a>
									</div>
								</li>
								<li>
									<div class="message-notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-img"> 
													<img src="assets/img/jm_denis.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Player 1</span>
													<span class="block">
														Susah pakai appsnya nih
													</span>
													<span class="time">5 minutes ago</span> 
												</div>
											</a>
											<a href="#">
												<div class="notif-img"> 
													<img src="assets/img/chadengle.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Player 2</span>
													<span class="block">
														Keren bro!
													</span>
													<span class="time">12 minutes ago</span> 
												</div>
											</a>
											<a href="#">
												<div class="notif-img"> 
													<img src="assets/img/mlane.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Jhon Doe</span>
													<span class="block">
														Request mabar di Senayan
													</span>
													<span class="time">18 minutes ago</span> 
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notifications</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													New user registered (Rahmad Darmawan)
												</span>
												<span class="time">1 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
											<div class="notif-content">
												<span class="block">
													AOV Cup 2024 Tournament, today!
												</span>
												<span class="time">10 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-img"> 
												<img src="assets/img/profile2.jpg" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Mr Tony & Mr Oliver just played FF together
												</span>
												<span class="time">16 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-img"> 
												<img src="assets/img/profile2.jpg" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Mr Tony post something to ALTER
												</span>
												<span class="time">26 minutes ago</span> 
											</div>
										</a>										
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Menu 1</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-database"></i>
													<span class="text">Menu 2</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Menu 3</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-interface-1"></i>
													<span class="text">Menu 4</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-list"></i>
													<span class="text">Menu 5</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-file"></i>
													<span class="text">Menu 6</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>ALTER</h4>
												<p class="text-muted">teguh@alterspace.gg</p><a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">My Profile</a>
										<!--<a class="dropdown-item" href="#">My Balance</a>-->
										<!--<a class="dropdown-item" href="#">Inbox</a>-->
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Account Setting</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="logout.php">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									ALTER
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
					<?php
						include "menu.inc.php";
					?>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Vouchers :: Codes</div>
								</div>
								<div class="card-body">
								
<?php
	$array_item_category = array("1"=>"Mobile Prepaid", "2"=>"Mobile Data", "3"=>"Top Up Game", "4"=>"E Wallet", "5"=>"Voucher");	
?>
																
								<form action="vouchers-generate.php" method="post">

									<div class="row">
													
										<div class="col-md-6 col-lg-6">
											<div class="form-group">
												<label for="disableinput">VOUCHER DATA</label>
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Name</label>
												<input type="text" name="name" class="form-control" disabled value="<?php echo $results_1['name']; ?>">
											</div>											
											<div class="form-group form-group-default">
												<label for="disableinput">Description</label>
												<input type="text" name="description" class="form-control" disabled value="<?php echo $results_1['name']; ?>">
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Category</label>
												<select name="item_category" class="form-control" disabled>
												<?php
													foreach($array_item_category as $key => $val) {
														echo "<option value='$key'> $val </option>";
													} // foreach($array_item_category as $key => $val) {
														echo "<option value='".$results_1['item_category']."' selected> ".$array_item_category[$results_1['item_category']]." </option>";
												?>
												</select>												
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Type</label>
												<select name="discount_cashback_type" class="form-control" disabled>
													<option value="%"> % </option>
													<option value="IDR"> IDR </option>
													<?php
														echo "<option value='".$results_1['discount_cashback_type']."' selected> ".$results_1['discount_cashback_type']." </option>";
													?>
												</select>
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Value</label>
												<input type="number" name="voucher_value" class="form-control" disabled value="<?php echo $results_1['voucher_value']; ?>">
											</div>																						
											<div class="form-group form-group-default">
												<label for="disableinput">Date From</label>
												<input type="date" name="date_from" class="form-control" disabled value="<?php echo $results_1['date_from']; ?>">
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Date To</label>
												<input type="date" name="date_to" class="form-control" disabled value="<?php echo $results_1['date_to']; ?>">
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Minimum Purchase</label>
												<input type="number" name="min_purchase" class="form-control" disabled value="<?php echo $results_1['min_purchase']; ?>">
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Prefix</label>
												<input type="text" name="prefix" class="form-control" disabled value="<?php echo $results_1['prefix']; ?>">
											</div>

											<div class="form-group form-group-default">
												<label for="disableinput">Number of Voucher Codes</label>
												<input type="number" name="num_of_vouchers" class="form-control" disabled value="<?php echo $results_1['num_of_vouchers']; ?>">
											</div>
											<div class="form-group form-group-default">
												<label for="disableinput">Length of Unique Code</label>
												<input type="number" name="length_of_codes" class="form-control" disabled value="<?php echo $results_1['length_of_codes']; ?>">
											</div>
											
										</div>				
										
										<div class="col-md-6 col-lg-6">

											<div class="form-group">
												<label for="disableinput">VOUCHER CODES</label>
											</div>
											
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Voucher Code</th>
													<th>Give To</th>												
												</tr>
											</thead>							
											<tbody>
											
<?php
$no = 0;
$results_5 = DB::query("
select id, voucher_code, single_user_id from voucher_codes where uuid=%s order by id asc", $_GET['uuidx']);
foreach ($results_5 as $row_5) {
	$no++;
										
	if($row_5['single_user_id'] == 0) {
		$option_selected = "<option value='0' selected> - - Choose user - - </option>";
	}		
	else {
		$option_selected = "<option value='".$row_5['single_user_id']."' selected>".$array_users_name[$row_5['single_user_id']]."</option>";
	}		
										
	echo "
												<tr>
												    <td>".$no."</td>
													<td>".$row_5['voucher_code']."</td>
													<td>
														<select name='selSingleUserId_".$row_5['id']."' onchange=\"window.location.href='voucher-assign-user.php?voucher_id=".$row_5['id']."&voucher_uuid=".$_GET['uuidx']."&assign_to='+this.value+'';\">
															".$str_option_users_voucher_code."
															".$option_selected."
														</select>
													</td>												
												</tr>
	";
} // foreach ($results_2 as $row_2) {											
?>												

											</tbody>
										</table>
									</div>
											
											<div class="form-group">
												<a class="btn btn-danger" href="vouchers.php">Cancel</a>
											</div>
											
										</div>																						
										
									</div>
								
								</form>
								</div>

							</div>
						
						</div>
					</div>

				</div>
			</div>

		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="assets/js/setting-demo2.js"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>
</html>