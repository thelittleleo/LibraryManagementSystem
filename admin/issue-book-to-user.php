<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
    $student_id = $_GET['studentid'];
    $book_id = $_GET['bookid'];
    $uid = $_GET['uid'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!--MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">

    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issue a New Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Book
</div>
<div class="panel-body">
<form role="form" method="post">
    <?php

    ?>
<div class="form-group">
<label>Student id</label><label>&nbsp;-&nbsp;</label><label><?php echo htmlentities($student_id)?></label>
<br />
</div>
<div class="form-group">
<label>Student Name</label><label>&nbsp;-&nbsp;</label>
<label>
    <?php
                $sql="SELECT FullName FROM `tblstudents` WHERE StudentId=:sid";
                $query = $dbh -> prepare($sql);
                $query-> bindParam(':sid', $student_id, PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                foreach($results as $result)
                {
                    echo htmlentities($result->FullName);
                }
    ?>
</label>
<br />
</div>
<div class="form-group">
<label>Book Name</label><label>&nbsp;-&nbsp;</label>
<label>
    <?php
                $sql="SELECT BookName FROM `tblbooks` WHERE id=:bid";
                $query = $dbh -> prepare($sql);
                $query-> bindParam(':bid', $book_id, PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                foreach($results as $result)
                {
                    echo htmlentities($result->BookName);
                }
    ?>
</label>
</div>
<div class="form-group">
<image src="images/<?php
                    $sql="SELECT image FROM `tblbooks` WHERE id=:bid";
                    $query = $dbh -> prepare($sql);
                    $query-> bindParam(':bid', $book_id, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    foreach($results as $result)
                    {
                        echo htmlentities($result->image);
                    }
?>"width="160dpx" height="180dpx" alter="cover"></image>
</div>
<a href="confirm-issue.php?studentid=<?php echo htmlentities($student_id);?>&bookid=<?php echo htmlentities($book_id);?>&uid=<?php echo htmlentities($uid);?>">
<!-- <button class="btn btn-primary"><i class="fa fa-edit "></i>Confirm Issue</button> -->
Confirm
                                                    </a>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
