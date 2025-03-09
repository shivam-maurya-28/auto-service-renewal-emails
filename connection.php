<?php
	$conn= new mysqli('localhost', 'root', '', 'assignment');
	if($conn->connect_error){
		echo "db connect error occured: ".$conn->connect_error;
	}
	else{
		// echo " db is connected successful";
	}
?>
