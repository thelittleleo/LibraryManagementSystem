<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');
}
else{?>
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
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>
    <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Book List</h4>

                </div>
                <div class="row">
                    <?php if($_SESSION['errorbookconfirmationmessage']!="")
                    {?>
                        <div class="col-md-6">
                            <div class="alert alert-danger" >
                                <strong>Error :</strong>
                                <?php echo htmlentities($_SESSION['errorbookconfirmationmessage']);?>
                                <?php echo htmlentities($_SESSION['errorbookconfirmationmessage']="");?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($_SESSION['bookconfirmationmessage']!="")
                    {?>
                        <div class="col-md-6">
                            <div class="alert alert-success" >
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['bookconfirmationmessage']);?>
                                <?php echo htmlentities($_SESSION['bookconfirmationmessage']="");?>
                            </div>
                        </div>
                    <?php } ?>
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
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Books Listing
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Book Name</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <!-- <th>Status</th> -->
                                                <th>Picture</th>
                                                <th>Request For Issue</th>
                                                <th>Price</th>
                                                <th>Request For Buy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.Status, tblbooks.image, tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $result)
                                            {               ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?php echo htmlentities($cnt);?></td>
                                                    <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                                    <td class="center"><?php echo htmlentities($result->CategoryName);?></td>
                                                    <td class="center"><?php echo htmlentities($result->AuthorName);?></td>
                                                    <!-- <td class="center">
                                                        <?php
                                                        $check = $result->Status;
                                                        if($check == 1)
                                                        { ?>
                                                        <div class="bg-success">
                                                        <?php echo "Available"; ?>
                                                        </div>
                                                         <?php
                                                        }else{ ?>
                                                        <div class="bg-danger">
                                                        <?php echo "Not Available"; ?>
                                                        </div>
                                                         <?php
                                                        }
                                                        ?>
                                                    </td> -->
                                                    <td class="center"><img src="admin/images/<?php echo htmlentities($result->image)?>" width="60dpx" height="80dpx" alt="physics"></td>
                                                    <td class="center">
                                                        
                                                            <a href="bookrequest-confirmation.php?bookid=<?php echo htmlentities($result->bookid);?>">
                                                            <button class="btn btn-primary"><i class="fa fa-edit "></i> Request</button>
                                                     

                                                    </td>
                                                    <td class="center"><?php echo htmlentities($result->BookPrice);?> BDT</td>
                                                    <td class="center">
                                                        
                                                        <a href="bookbuyrequest-confirmation.php?bookid=<?php echo htmlentities($result->bookid);?>">
                                                        <button class="btn btn-primary"><i class="fa fa-edit "></i> Buy</button>
                                                </td>
                                                </tr>
                                                <?php $cnt=$cnt+1;}} ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
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

    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    <!-- CORE JQUERY  -->
    <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
    <!-- BOOTSTRAP SCRIPTS  -->
    <!-- <script src="assets/js/bootstrap.js"></script> -->
    <!-- CUSTOM SCRIPTS  -->
    <!-- <script src="assets/js/custom.js"></script> -->
    </body>
    </html>
<?php } ?>
