<?php
	include_once("./config/database.php");

	$dataBase = new Database();
	$sql = "SELECT * FROM `catagory` WHERE `status`=1";
	$result = mysqli_query($dataBase->getConnection(),$sql);
	print_r($result);
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    $row = mysqli_fetch_array($result);
	    while($row = mysqli_fetch_array($result)) {
	    	echo $row['id'];
            echo $row['name']; 
	    }
	     
	    
	} else {
	    echo "0 results";
	}

	mysqli_close($dataBase->getConnection());
?>