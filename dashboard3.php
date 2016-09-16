
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8;"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="tester/bootstrap-switch.css"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="bootstrap/css/bootstrap-switch.css" rel="stylesheet">-->
	<link href="bootstrap/css/docs.min.css" rel="stylesheet">
	<link href="bootstrap/css/main.css" rel="stylesheet">
	
	<script src="bootstrap/js/jquery.min.js"></script>
	<script src="tester/bootstrap-switch.js"></script>
	
	<script src="bootstrap/js/jquery.validate.js"></script>
	<script src="bootstrap/js/additional-methods.js"></script>

	<link rel="stylesheet" href="bootstrap/css/jquery-ui.css">
	<script src="bootstrap/js/jquery-ui.js"></script>

	<script>
		$(document).ready(function() {
			$( "#helpdeskSlas" ).validate({
			  rules: {
				customerSatisfactionMonthly: {
				  required: true,
				  number: true
				},
				firstCallResolutionMonthly: {
					required: true,
					number: true
				},
				firstCallResolutionDaily: {
					required: true,
					number: true
				},
				abandonRateMonthly: {
					required: true,
					number: true
				},
				answerSpeedMonthly: {
					required: true,
					number: true
				},
				customerSatisfactionDaily: {
					required: true,
					number: true
				},
				abandonRateDaily: {
					required: true,
					number: true
				},
				answerSpeedDaily: {
					required: true,
					number: true
				},
				datepicker: {
					required: true,
					date: true
				},
				time: {
					required: true
				}
			  }
			});
		});
		
		$(function() {
			$( "#datepicker" ).datepicker();
		});
	</script>
	
	<style>
	#rcorner_main {
    border-radius: 15px;
    border: 2px solid black;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 415px;
	margin-left: 2em;
	}
	
	#rcorner_db {
    border-radius: 15px;
    border: 2px solid grey;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 400px;
	background: #036398;
	color: white;
	}
	
	#rcorner_lb {
    border-radius: 15px;
    border: 2px solid grey;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 400px;
	background: #1BC4E6;
	color: black;
	}
	
	#rcorner_dg {
    border-radius: 15px;
    border: 2px solid grey;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 400px;
	background: #d9601a;
	color: white;
	}

	#rcorner_lg {
    border-radius: 15px;
    border: 2px solid grey;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 400px;
	background: #e3854f;
	color: black;
	}

	#rcorner_do {
    border-radius: 15px;
    border: 2px solid grey;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 400px;
	background: #E78F3E;
	color: white;
	}

	#rcorner_lo {
    border-radius: 15px;
    border: 2px solid grey;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px; 
	padding-top: 2px;
	width: 400px;
	background: #DEBA44;
	color: black;
	}

	div.leftCol {
	  width:50%;
	  float:left;
	}
	div.rightCol {
	  width:50%;
	  float:right;
	}
	.error{
		color:red;
		font-style: italic;
		font-size: 13px;
	}
	</style>
</head>

<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $partner = $_POST['partner'];
   $partner_date = $_POST['partner_date'];
   
   //Put everyting in DB
	global $con;

	
	$con = mysqli_connect("localhost","root","","Bump");
	$sql_table_test = "SELECT id,username,password FROM test";

	$result_table_test = mysqli_query($con, $sql_table_test);
	while($row = mysqli_fetch_assoc($result_table_test)){
		$user_exists = false;
		if( ($username == $row["username"]) && ($password == $row["password"]) ){
			$id = $row["id"];
			$sql_chaz = "INSERT INTO partner (id,partner,partner_date) VALUES ('$id','$partner', '$partner_date')";
			if(!mysqli_query($con,$sql_chaz)){
				echo 'Not inserted';
				die( print_r( mysqli_error($con), true));
			}else{
				$user_exists = true;
				echo 'Inserted';
			}
		}
	}
	if(!$user_exists){
		echo 'Invalid credentials';
	}


	if( $con ) {

		
		mysqli_close($con);
		
	}else{
		echo "Connection could not be established.<br/>";
	}

}
?>
<div class="main">
<div class="leftCol">


<!--Service Desk Metrics-->
<div class="leftCol">
<div class="row" id="rcorner_main">
	<h1 class="h3">Bump Test <a style="color:grey" ></a></h1>

	<form id="helpdeskSlas" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	
    <div class="col-sm-6 col-lg-6"  >
		
	</div>
    <div class="col-sm-12 col-lg-12" style="padding:8px;"></div>
    <div>
		<div class="col-sm-6">
			<label for="edit-submitted-first-name">Username</label>
			<br>
			<input class="form-control form-text" type="text" name="username" value=""><br>
		</div>
    </div>
    <div>
      <div  class="col-sm-6">
               <label for="edit-submitted-first-name">Password</label>
               <br>
               <input class="form-control form-text" type="password" name="password" value=""><br>
         </div>
    </div>
    
    <div>
      <div  class="col-sm-6">
               <label for="edit-submitted-first-name">Partner</label>
               <br>
               <input class="form-control form-text" type="text" name="partner" value=""><br>
         </div>
    </div>
    <div class="col-sm-6"  >
				<label for= "edit-submitted-first-name">Partner Date: </label>
				<br>
				<input class="form-control form-text" type="text" name="partner_date" id="datepicker">
	</div>
	<div class="col-sm-12 col-lg-12" style="padding:3px;"></div>

    
    <div class='inner'><div  class="col-sm-6 form-item webform-component webform-component-textfield webform-component--Email"><input type="submit" value="Submit" name="submit" /></div></div>
</form>

</div>
</div>

</div>

</body>
</html>