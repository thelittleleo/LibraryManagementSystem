<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['confirm']))
{
    $book_id = $_SESSION['book_id'];
    $student_id = $_SESSION['stdid'];
    $txnid = $_POST["txid"];
    $null = null;
    $status = 0;

   $sql="INSERT INTO  tblbooksbuyrequest(id, student_id, book_id, status, txid) VALUES (:id,:studentid, :bookid, :status, :txid)";

   $query = $dbh->prepare($sql);
   $query->bindParam(':studentid', $student_id, PDO::PARAM_STR);
   $query->bindParam(':bookid',$book_id, PDO::PARAM_STR);
   $query->bindParam(':id',$null, PDO::PARAM_INT);
   $query->bindParam(':status',$status, PDO::PARAM_INT);
   $query->bindParam(':txid',$txnid, PDO::PARAM_INT);

   if($query->execute()){
       $_SESSION['updatemsg']="Book buying request send successfully";
       header('location:availablebooks.php');
   }else{
        print_r($query->errorInfo());
       $_SESSION['updatemsg']="Something went wrong";
       header('location:bookbuyrequest-confirmation.php');
   }

}