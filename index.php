<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
<h1>Instilla - test app</h1>

<h2>Compare two websites homepage</h2>

<?php
// define variables and set to empty values
$website1Err = $website2Err = "";
$website1 = $website2 = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function findAndCompare($url1, $url2) {
 	echo "qui faccio le elaborazioni!";	
	echo "<h2>Your Input:</h2>";
	echo $url1;
	echo "<br>";
	echo $url2;
	echo "<br>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["website1"])) {
		$website1Err = "URL is required";
	} else {
		$website1 = test_input($_POST["website1"]);
		// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website1)) {
	  		$website1Err = "Invalid URL"; 
		}
	}

	if (empty($_POST["website2"])) {
		$website2Err = "URL is required";
	} else {
		$website2 = test_input($_POST["website2"]);
		// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website2)) {
		  $website2Err = "Invalid URL"; 
		}
	}

	if ($website1Err == "" && $website2Err == "") {
		findAndCompare($website1, $website2);
	} 

}





if ($_SERVER["REQUEST_METHOD"] != "POST" || $website1Err != "" || $website2Err != "") {
?>

<p><span>Both fields are required:</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="form1" id="form1">  
  Website 1: <input type="text" name="website1" value="<?php echo $website1;?>">
  <span class="error"><?php echo $website1Err;?></span>
  <br><br>
   Website 2: <input type="text" name="website2" value="<?php echo $website2;?>">
  <span class="error"><?php echo $website2Err;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
<?php
}
?>
</body>
</html>
