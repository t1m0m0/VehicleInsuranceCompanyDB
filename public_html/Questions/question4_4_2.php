﻿<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.2</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<style>
input[type=button] {
    width: 10em;  
    height: 3em;
    border: 3px solid #a1a1a1;
    border-radius: 25px;
}
</style>

<body bgcolor="white">
<?php 
$host = "localhost"; 
$user = "db1u36"; // <-- Εδώ βάλετε την ομάδα σας  
$pass = "Jy03y9TC"; // <-- Εδώ βάλετε τον κωδικό σας
$db = $user; 
$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n"); 
$query = "SELECT veh_id FROM damage GROUP BY veh_id  HAVING COUNT(damage.mdareas)>=3"; // Εδω βρείσκω τους veh_id για πανω από 3 ζημιές.
$rs = pg_query($con, $query) or die("Cannot execute query 4.4.2: $query\n");

echo"<h2> Ερώτηση 4.4.2 </h2>
	<p>Βρείτε τα οχήματα που έχουν υποστεί τουλάχιστον 3 ζημιές και δώστε την περιγραφή τους για κάθε μια από αυτές.</p>
    <table border=\"1\" width=\"600\" >
	<tr> <td align=\"center\"><b>VEH_ID</b></td> <td align=\"center\"><b>DESCRIPTION</b></td> </tr>";


while ($ro = pg_fetch_object($rs)) {

		$VehidT=pg_escape_string($ro->veh_id);
		$query2 = "SELECT veh_id,description FROM damage,mdareas WHERE damage.veh_id='$VehidT' AND damage.mdareas=mdareas.code"; // Εδω βρείσκω τους veh_id για πανω από 3 ζημιές.
		$rs2 = pg_query($con, $query2) or die("Cannot execute query2 : $query2\n");
		
		while($ro2 = pg_fetch_object($rs2)){
		echo"
			<tr>
				<td align=\"center\">". $ro2->veh_id ."</td>
				<td align=\"center\">". $ro2->description ."</td>
			</tr>";	
		}
}

echo"
	</table></br></br>";

	
pg_close($con); 
?>

</body>
</html>
