<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['return']))
{
$rid=$_SESSION['rid'];
$rstatus=1;
$sql="update tblissuedbookdetails set RetrunStatus=:rstatus where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book Returned successfully";
header('location:manage-issued-books.php');
}
?>