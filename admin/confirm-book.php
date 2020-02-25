<?php
session_start();
error_reporting(0);
include('includes/config.php');

$bookid=intval($_GET['bookId']);
$student_id = intval($_GET['studentId']);
$rowId = intval($_GET['uid']);
$null = null;

$sql="INSERT INTO  tblsoldbooks(id, sid, bid) VALUES (:id,:sid, :bid)";

   $query = $dbh->prepare($sql);
   $query->bindParam(':sid', $student_id, PDO::PARAM_STR);
   $query->bindParam(':bid',$bookid, PDO::PARAM_STR);
   $query->bindParam(':id',$null, PDO::PARAM_INT);

   if($query->execute()){
       $_SESSION['msg']="Buy Request confirmed";
       $sql2 = "UPDATE `tblbooksbuyrequest` SET `status` = '1' WHERE `tblbooksbuyrequest`.`id` = :id;";
       $query2 = $dbh->prepare($sql2);
       $query2->bindParam(':id',$rowId, PDO::PARAM_INT);
       $query2->execute();
       header('location:buy-request-list.php');
   }else{
        print_r($query->errorInfo());
       $_SESSION['msg']="Something went wrong";
       header('location:buy-request-list.php');
   }
