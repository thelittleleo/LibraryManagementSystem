<?php
error_reporting( ~E_NOTICE );
session_start();
error_reporting(0);
include('includes/config.php');

$student_id = $_GET['studentid'];
$book_id = $_GET['bookid'];
$uid = $_GET['uid'];
$id = null;
$rtsts = 0;
$statement = $dbh->prepare('INSERT INTO  tblissuedbookdetails(id,BookId,StudentID,RetrunStatus) VALUES(:id,:bookid,:studentid,:rtrs)');
$statement->bindParam(':id', $id);
$statement->bindParam(':bookid', $book_id);
$statement->bindParam(':studentid', $student_id);
$statement->bindParam(':rtrs', $rtsts);
if(!$statement->execute())
{
    print_r($statement->errorInfo());
}
else{
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        // echo 'confirm';
        $statement2 = $dbh->prepare("UPDATE tblbooksrequest SET status=1 WHERE id=:uid");
        $statement2->bindParam(':uid', $uid,PDO::PARAM_INT);
        if(!$statement2->execute())
        {
            echo 'here';
            print_r($statement2->errorInfo());
        }
        else{
            echo 'done';
        }
        $lastInsertId = $dbh->lastInsertId();
        echo $lastInsertId;
        $_SESSION['msg']="Book issued successfully";
        header('location:manage-books.php');
    }
    else
    {
        echo 'rejected';
        $_SESSION['error']="Something went wrong. Please try again";
        header('location:manage-books.php');
    }
}


?>