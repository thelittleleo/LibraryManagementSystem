<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','library');
// Establish database connection.
try
{
    $dbh = new PDO("mysql:host=localhost; dbname=library",'root','');
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>

