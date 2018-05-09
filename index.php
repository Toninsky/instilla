
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
		
		.message {
			font-style:italic;
			margin-top:24px;
			color:#0366d6;
		}
		
		.error {color: #FF0000;}
	  
	</style>
</head>
<body>
<h1>Instilla - test app</h1>

<h2>Compare two websites homepage</h2>


<p><span>Both fields are required:</span></p>
<form method="post" action="action.php" name="form1" id="form1">  
  Website 1: <input type="url" name="website1" required="required" value="">
  <br><br>
   Website 2: <input type="url" name="website2" required="required" value="">
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>
