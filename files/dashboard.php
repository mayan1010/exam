<?php
	session_start();
	
	if (!isset($_SESSION['student_details'])) {
    header("Location: ../index.php");
    exit();
	}
	
	if (isset($_SESSION['test_ongoing']) && $_SESSION['test_ongoing'] == "true") {
    header("Location: quiz.php");
    exit();
	}
?>

<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Quizller - Dashboard</title>
		
		<link rel="icon" type="image/png" href="../admin/assets/img/favicon.png">
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/header.css">
		<link rel="stylesheet" href="../css/util.css">
		<link rel="stylesheet" href="../css/main.css">
		
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="../vendor/bootstrap/js/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/tilt/tilt.jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
		
	</head>
	
	<body>
		
		<!-- Header -->
		<header class="header1">
			<div class="container-menu-header">
				<div class="wrap_header">
					
					<a href="../index.php" class="logo">
						<img src="../images/icons/logo.png" alt="logo">
					</a>
					
					<div class="header-icons">
						<a href="#" class="header-wrapicon1 dis-block">
							<img src="../images/icons/logout.png" class="header-icon1" alt="logout" onclick="logout()">
						</a>
					</div>
					
				</div>
			</div>
			
			<div class="wrap_header_mobile">
				
				<a href="../index.php" class="logo-mobile">
					<img src="../images/icons/logo.png" alt="logo">
				</a>
				
				<div class="btn-show-menu">
					<div class="header-icons-mobile">
						<a href="#">
							<img src="../images/icons/logout.png" class="header-icon1" onclick="logout()">
						</a>
					</div>
				</div>
				
			</div>
		</header>
		
		
		<section>
			<div class="limiter">
				<div class="container-login100" style="display:block;">
					<div class="container">
						<div class="row">
							<div class="col">
								
								<div class="card" style="padding-bottom:20px;">
									<div class="container">
										<div class="row">
											
											<div class="col-md-12" id="row" style="display:none;">
												
												<div class="card" style="background:#ededed;margin:20px 10px 0px 10px;">
													<div class="card-body">
														
														<div class="container">
															<div class="row">
																
																<div class="col-md-8">
																	<p id="test_name"></p>
																</div>
																
																<div class="col-md-4">
																	<a href="quiz.php">
																		<button class="btn btn-success" style="float:right;">Start Test</button>
																	</a>
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
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
		<script>
			
			$(document).ready(function(){
				
				$.ajax({
					type:'POST',
					url:'get_dashboard_contents.php',
					
					success:function(response){
						
						console.log(response);
						
						if(response.trim().length > 0){
							
							$('#row').show();
							$('#test_name').text(response);
							
						}
						
					}
					
				});
				
			});
			
			
			function logout(){
				
				$.ajax({
					
					type:'POST',
					url:'end_session.php',
					data:{ message:'1' },
					
					success:function(msg){
						
						alert(msg);
						
						Cookies.remove('last_question_was_answered');
						Cookies.remove('last_question');
						
						Cookies.set('test_submitted_status', msg.toString());
						
						window.location.replace("test_finished.php");
						
					}
					
				});
				
			}
			
		</script>
		
	</body>
</html>