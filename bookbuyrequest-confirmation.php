<?php
session_start();
error_reporting(0);
include('includes/config.php');
// include('includes/config-mysqli.php');
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');
}
else{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Add Author</title>
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
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Book Request Confirmation</h4>

            </div>

        </div>
        <?php if($_SESSION['updatemsg']!="")
        {?>
            <div class="col-md-6">
            <div class="alert alert-success" >
            <strong>Success :</strong> 
            <?php echo htmlentities($_SESSION['updatemsg']);?>
            <?php echo htmlentities($_SESSION['updatemsg']="");?>
            </div>
            </div>
    <?php } ?>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Confirm Request
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="confirmbuy.php">
                        <div class="form-group">
                            <label>Student ID</label>
                            <?php $student_id = $_SESSION['stdid'];?>
                            <input class="form-control" type="text" name="studentid" value="<?php echo $student_id;?>" disabled="disabled" required />
                            <br>
                            <label>Book</label>
                            <?php
                            $book_id =intval($_GET['bookid']);
                            $_SESSION['book_id'] = $book_id;
                            $sql = "SELECT * from  tblbooks where id=:bookid";
                            $query = $dbh -> prepare($sql);
                            $query->bindParam(':bookid',$book_id,PDO::PARAM_STR);

                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {               ?>
                                    <input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" required disabled="disabled" />
                                    <br>
                                    <img src="admin/images/<?php echo htmlentities($result->image)?>" alt="bookimage" width="100dpx" height="140dpx" align="center">
                                
                        </div>
                        <label>Price</label>
                        <input class="form-control" type="text" name="bookprice" disabled="disabled" value="<?php echo htmlentities($result->BookPrice);?> BDT"  required />
                        <br />
                        <label>bKash Transaction ID</label>
                        <input class="form-control" type="text" name="txid" autocomplete="off"  required />
                        <br />
                        <button type="submit" id="confirm" name="confirm" class="btn btn-info">Buy</button>
                        
                    </form>
                    <?php }} ?>
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