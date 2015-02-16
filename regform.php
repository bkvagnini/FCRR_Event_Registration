<?php
$serverName = "MSSQL_SERVER_NAME"; //serverName\instanceName - for SQL Server, it can be blank, for SQL Express, must put the default instance
$connectionInfo = array( "Database"=>"eventRegistration", "UID"=>"SQL_USERNAME", "PWD"=>"SQL_PASSWORD");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo ".....Connection established. Transferring data now...<br />";
}
else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$registerdate = date('D, M dS,Y. H:i');
$eventname = 'scmath2012'; //CHANGE THIS OUT AS NEEDED...
$fname=dbfix($_POST['fname']);
$lname=dbfix($_POST['lname']);
$org=dbfix($_POST['org']);
$nametag=dbfix($_POST['nametag']);
$email=dbfix($_POST['email']);
$phone=dbfix($_POST['phone']);
$info=dbfix($_POST['info']);
 
 
//trims off unnecesssary white space and extra characters
function dbfix($val){
	$temp = trim($val);
	$temp = str_replace("'","\'",$temp);
	return $temp;
	}	

echo $temp;

$sql = "INSERT INTO dbo.eventreg (eventname,fname,lname,org,nametag,email,phone,registerdate,info) values (?,?,?,?,?,?,?,?,?)";
$params = array($eventname, $fname, $lname, $org, $nametag, $email, $phone, $registerdate, $info);

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
	 echo 'there was a problem with your form insert...';



	}
// This was for testing purposes
// Consume the first result (rows affected by INSERT) without calling sqlsrv_next_result.
// echo "Rows affected: ".sqlsrv_rows_affected($stmt)."<br />";
// echo 'You entered: ' . $params;

echo '<h3>Thank you!</h3>';

echo 'You registered for the October 5th, 2012 Math event on '. $registerdate . '<br />';
echo 'A confirmation email will be sent shortly...';

// close the connection  
sqlsrv_close( $conn );
?>
