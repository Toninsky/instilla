<!DOCTYPE html>
<html lang="en">
<head>
  <title>Instilla - test app</title>
  <meta charset="utf-8">
	<style>
  
		body{
			font-family:Verdana, Geneva, sans-serif;
			font-size:13px;
			margin:12px;
		}	
	
		h1 {
			font-size:18px;
			font-weight:bold;
			color:#0366d6;
		}
	
		h2 {
			font-size:15px;
			font-weight:bold;
		}
		
		.error {color: #FF0000;}
	  
	</style>
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

    // first website
	$domain1 = str_replace("https://","",str_replace("http://","",$url1));
	echo $domain1;
	echo "<br>----------------<br>";

	// retrieve the href attributes within all the anchor tags
	$page1 = file_get_contents($url1);
	$dom1 = new DomDocument();
	$dom1->loadHTML($page1);
	$output1 = array();
	foreach ($dom1->getElementsByTagName('a') as $item) {
	   if (substr($item->getAttribute('href'), 0, 2) == "//") { 
			$output1[] = "http:". $item->getAttribute('href');
		} else if (substr($item->getAttribute('href'), 0, 1) == "/") { 
			$output1[] = $url1 . $item->getAttribute('href');
		} else {
		   $output1[] = $item->getAttribute('href');
		}
	}
    #var_dump($output1);

   // remove external links
   $inboundlink1 = array();
   foreach ($output1 as $value) {
		if (strstr($value,$domain1)) { 
			$inboundlink1[] = $value;
	
			/*
			#######################################################################
			Comment this code because goes in timeout: "Fatal error: Maximum execution time of 30 seconds exceeded"
			
			
			// crawl the website by one level depth, and retrieve the href attributes within all the anchor tags
			$page11 = file_get_contents($value);
			$dom11 = new DomDocument();
			$dom11->loadHTML($page11);
			foreach ($dom11->getElementsByTagName('a') as $item) {
			   if (substr($item->getAttribute('href'), 0, 2) == "//") { 
					if (strstr($item->getAttribute('href'),$domain1)) { 
						$inboundlink1[] = "http:". $item->getAttribute('href');
					}
				} else if (substr($item->getAttribute('href'), 0, 1) == "/") { 
					$inboundlink1[] = $url1 . $item->getAttribute('href');
				} else {
					if (strstr($item->getAttribute('href'),$domain1)) { 
				  		$inboundlink1[] = $item->getAttribute('href');
					}
				}
			}
	
			#######################################################################
			*/

		}
	}
	var_dump($inboundlink1);



	//  second website
	$domain2 = str_replace("https://","",str_replace("http://","",$url2));
	echo "<br>----------------<br>";
	echo $domain2;
	echo "<br>----------------<br>";

	// retrieve the href attributes within all the anchor tags
	$page2 = file_get_contents($url2);
	$dom2 = new DomDocument();
	$dom2->loadHTML($page2);
	$output2 = array();
	foreach ($dom2->getElementsByTagName('a') as $item) {
	   if (substr($item->getAttribute('href'), 0, 2) == "//") { 
			$output2[] = "http:". $item->getAttribute('href');
		} else if (substr($item->getAttribute('href'), 0, 1) == "/") { 
			$output2[] = $url2 . $item->getAttribute('href');
		} else {
		   $output2[] = $item->getAttribute('href');
		}
	}
    #var_dump($output2);

   // remove external links
   $inboundlink2 = array();
   foreach ($output2 as $value) {
		if (strstr($value,$domain2)) { 
			$inboundlink2[] = $value;
	
			/*
			#######################################################################
			Comment this code because goes in timeout: "Fatal error: Maximum execution time of 30 seconds exceeded"
			
			
			// crawl the website by one level depth, and retrieve the href attributes within all the anchor tags
			$page22 = file_get_contents($value);
			$dom22 = new DomDocument();
			$dom22->loadHTML($page22);
			foreach ($dom22->getElementsByTagName('a') as $item) {
			   if (substr($item->getAttribute('href'), 0, 2) == "//") { 
					if (strstr($item->getAttribute('href'),$domain2)) { 
						$inboundlink2[] = "http:". $item->getAttribute('href');
					}
				} else if (substr($item->getAttribute('href'), 0, 1) == "/") { 
					$inboundlink2[] = $url2 . $item->getAttribute('href');
				} else {
					if (strstr($item->getAttribute('href'),$domain2)) { 
				  		$inboundlink2[] = $item->getAttribute('href');
					}
				}
			}
	
			#######################################################################
			*/

		}
	}
	var_dump($inboundlink2);


	
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
		if (substr($website1, 0, 4) != "http") { 
			$website1 = "http://". $website1; 
		}
		if (substr($website2, 0, 4) != "http") { 
			$website2 = "http://". $website2; 
		}
		
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
