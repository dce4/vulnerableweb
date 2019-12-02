<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Marvel Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body style="background-image:url('marvel.jpg');background-size:100%;">
<div style="margin-top:15%; color:white;font-weight:bold" align="center">
<h1 style="color: white;">Marvel Character Search</h1>
    <form action="search.php" method="GET">
        <input type="text" size="30" name="query" />
        <input type="submit" value="Search" />
    </form>

<?php
	include "config.php";   
	$query = $_GET['query'];
	$minlength = 0;	 // temporarily 0
	//$query = htmlspecialchars($query);                       // prevention for special chars
	//$query = mysqli_real_escape_string($connection,$query);  // prevention for sql injection

	if (strlen($query)>=$minlength){
		$mysql_query = "SELECT * FROM marvels WHERE name LIKE '%$query%'";
    	$raw_results = mysqli_query($connection,$mysql_query) or die(mysql_error());

    		while($results = mysqli_fetch_array($raw_results)){        // to receive multiple rows from SQL 
				$indexnum = count($results);
				$sql_row_names = ["ID","name","popularity","alignment","gender","height_m","weight_kg","hometown",
					  "intelligence","strength","speed","durability","energy_Projection","fighting_Skills"];	
				$row_names = ["ID","Name","Popularity","Alignment","Gender","Height","Weight","Hometown",
				  "Intelligence","Strength","Speed","Durability","Projection","Fighting"];

				for ($i=0; $i<=13; $i++){
					echo $row_names[$i]," : ";
					echo $results[$sql_row_names[$i]];
					echo "<br>\n";
						
		}//for
					echo "------------########------------","<br>\n";
	}//while
}//if
	else{
		echo "en az 3 karakter girin";
}		
	mysqli_close($connection); 
?>			
</div>
</body>
</html>
