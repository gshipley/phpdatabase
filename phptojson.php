<!--
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
-->
<?php 
	/*$con = mysqli_connect("localhost","root","","Bump");
	$sql = "SELECT * FROM test";
	$result = mysqli_query($con, $sql);
	
	$json_array = array();

	while($row = mysqli_fetch_assoc($result)){
		$json_array[] = $row;
	}
	echo json_encode($json_array);*/
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");
	$con = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if ($con->connect_error) {
    	die('Connect Error: ' . $mysqli->connect_error);
	}
	
	$sql_test = "SELECT id,username, password, phone_num, gender FROM test";
	$result_test = mysqli_query($con, $sql_test);
	$sql_id = "SELECT id,disease,disease_date FROM disease";
	$result_disease = mysqli_query($con, $sql_id);
	$disease_string = "";
	//$row2 = mysqli_fetch_assoc($result_disease);
	$sql_id = "SELECT id,partner,partner_date FROM partner";
	$result_partner = mysqli_query($con, $sql_id);
	$partner_string = "";
	global $info;
	$allinfo = "";
	//$row3 = mysqli_fetch_assoc($result_partner);

	if (mysqli_num_rows($result_test) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result_test)) {
	    	
	    	while($row2 = mysqli_fetch_assoc($result_disease)){
		    	while($row["id"] == $row2["id"]){
		    		$disease_string .= "\"". $row2["disease"] ."\"".":"."\"".$row2["disease_date"]."\"";
		    		if( ($row2 = mysqli_fetch_assoc($result_disease)) && ($row["id"] == $row2["id"])  ){
		    			$disease_string .= ", ";
		    		}
		    		
		    	}
		    }
	    	while($row3 = mysqli_fetch_assoc($result_partner)){
		    	while($row["id"] == $row3["id"]){
		    		$partner_string .= "\"". $row3["partner"]. "\"".":". "\"".$row3["partner_date"]."\"";
		    		if( ($row3 = mysqli_fetch_assoc($result_partner)) && ($row["id"] == $row3["id"]) ){
		    			$partner_string .= ", ";
		    		}
		    		
		    	}
	    	}
	    	
		$password = '"password"';
	    	$phonenum = '"PhoneNum"';
	    	$gender = '"Gender"';
	    	$diseases = '"Diseases"';
	    	$partners = '"Partners"';
	        $info = "{"."\"" . $row["username"]."\"". ": {" .$password . " : " . "\"" . $row["password"]. "\"" . "," .$phonenum . " :". "\"" . $row["phone_num"] . "\"" . "," . $gender .":"  . $row["gender"] ."," . " ".$diseases . ":{". $disease_string . "}," . $partners . ":{" . $partner_string. "}}}";
	        $allinfo .= $info;
	        $disease_string = "";
	        $partner_string = "";
	        mysqli_data_seek($result_disease,0);
	        mysqli_data_seek($result_partner,0);

	        
	    }
	} else {
    echo "0 results";
	}
	$fp = fopen('results.json', 'w');
	fwrite($fp, json_encode($allinfo, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
	fclose($fp);


	//for ($x = 0; $x <= 10; $x++) {
    //	echo "The number is: $x <br>";
	//}
	//SELECT TOP 1 CustomerName FROM Customers
	
	//SELECT CustomerName FROM test;

	$json = "{ "." : { password : password,PhoneNum: number,Gender : true Diseases { type : date, type : date }Partners : {username : date,username : date} } }";
	//echo $json;


 ?>
<!--
</body>
</html>
-->
