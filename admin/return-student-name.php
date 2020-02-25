<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
    echo "hello";
    // function retrun_student_name() {
    //     $std_id = "SID019";
    //     $sql="SELECT FullName FROM `tblstudents` WHERE StudentId=:sid";
    //     $query = $dbh -> prepare($sql);
    //     $query-> bindParam(':sid', $std_id, PDO::PARAM_STR);
    //     if(!$query->execute())
    //     {
    //         echo "hello2";
    //         print_r($dbh->errorInfo());
    //     }
    //     else
    //     {
    //         echo "hello3";
    //         print_r($dbh->errorInfo());
    //     }
    //     $results=$query->fetchAll(PDO::FETCH_OBJ);
    //     print_r($results);
    //     foreach($results as $result)
    //     {
    //         $student_name = $result->FullName;
    //     }
    //     echo $student_name;
    //     return $student_name;
    // }
    
        $std_id = "SID019";
        $sql="SELECT FullName FROM `tblstudents` WHERE StudentId=:sid";
        $query = $dbh -> prepare($sql);
        $query-> bindParam(':sid', $std_id, PDO::PARAM_STR);
        if(!$query->execute())
        {
            echo "hello2";
            print_r($dbh->errorInfo());
        }
        else
        {
            echo "hello3";
            print_r($dbh->errorInfo());
        }
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        foreach($results as $result)
        {
            $student_name = $result->FullName;
        }
        echo "<br /> HI" . $student_name;
}