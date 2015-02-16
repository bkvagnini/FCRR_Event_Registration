<?php
// Connect to MSSQL
$link = mssql_connect('DOMAIN\USERNAME', 'DOMAINPASSWORD');

if (!$link || !mssql_select_db('eventRegistration', $link)) {
    die('Unable to connect or select database!');
}

$result = mssql_query( $query ) ;
if (! $result) {
   die ("Could not query the database: <br />". mssql_error( ));
}

// Fetch and display the results
while ($result_row = mssql_fetch_row(($result) ) ) {
       echo ' Title: ' . $result_row[ 1] . ' <br />' ;
       echo ' Author: ' . $result_row[ 4] . ' <br /> ' ;
       echo ' Pages: ' . $result_row[ 2] . ' <br /><br />' ;
}

mssql_close($connection);
>
?>
