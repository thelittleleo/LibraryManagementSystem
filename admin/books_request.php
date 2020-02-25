<?php  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>

<form action="books_request.php" method="post">
    <button name="request" type="submit" class="btn-success">Request</button>
</form>

<?php
if(isset($_POST['request'])){
    include('includes/config.php');
    $db = $_POST['db'];
    $sql = "INSER INTO tblbooksrequest(student_id, book_id, status) VALUE(1,1,1)";
    mysqli_query($db, $sql);
}
?>

</body>
</html>