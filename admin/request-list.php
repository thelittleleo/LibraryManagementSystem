<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else{

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Issued Books</title>
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
                    <h4 class="header-line">Student's Request For Books</h4>
                </div>
                <div class="row">
                    <?php if($_SESSION['error']!="")
                    {?>
                        <div class="col-md-6">
                            <div class="alert alert-danger" >
                                <strong>Error :</strong>
                                <?php echo htmlentities($_SESSION['error']);?>
                                <?php echo htmlentities($_SESSION['error']="");?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($_SESSION['msg']!="")
                    {?>
                        <div class="col-md-6">
                            <div class="alert alert-success" >
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['msg']);?>
                                <?php echo htmlentities($_SESSION['msg']="");?>
                            </div>
                        </div>
                    <?php } ?>



                    <?php if($_SESSION['delmsg']!="")
                    {?>
                        <div class="col-md-6">
                            <div class="alert alert-success" >
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['delmsg']);?>
                                <?php echo htmlentities($_SESSION['delmsg']="");?>
                            </div>
                        </div>
                    <?php } ?>

                </div>


            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Issued Books
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Book Name </th>
                                        <th>Cover</th>
                                        <th>Request Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sql = "SELECT tblbooksrequest.id as uid, tblstudents.FullName, tblstudents.StudentId,
                                                  tblbooks.BookName, tblbooksrequest.status, tblbooks.image, tblbooks.ISBNNumber as isbn, tblbooks.id as bookid,
                                                  tblbooksrequest.request_time
                                                  FROM tblbooksrequest
                                                  join tblstudents on tblstudents.StudentId = tblbooksrequest.student_id
                                                  join tblbooks on tblbooks.id = tblbooksrequest.book_id
                                                  order by tblbooksrequest.status, tblbooksrequest.request_time DESC";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?php echo htmlentities($cnt);?></td>
                                                <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                                <td class="center"><?php echo htmlentities($result->StudentId);?></td>
                                                <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                                <td class="center"><image src="images/<?php echo htmlentities($result->image);?>"
                                                    width="60dpx" height="80dpx" alter="cover"></image></td>
                                                <td class="center"><?php echo htmlentities($result->request_time);?></td>

                                                <td class="center">
                                                    <?php
                                                    if(($result->status)==0){?><div class="bg-danger">
                                                        <?php  echo "Pending";?>
                                                    </div>
                                                        <?php
                                                    }else{ ?> <div class="bg-success">
                                                        <?php  echo "Approved";?>
                                                    </div>
                                                       <?php
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                     <?php
                                                        if(($result->status)==0){?>
                                                        <a href="issue-book-to-user.php?studentid=<?php echo htmlentities($result->StudentId);?>&bookid=<?php echo htmlentities($result->bookid);?>&uid=<?php echo htmlentities($result->uid);?>">
                                                        <button class="btn btn-primary"><i class="fa fa-edit "></i>Issue</button>
                                                    </a>
                                                        <a href="request-list.php?del=<?php echo htmlentities($result->StudentId);?>"
                                                           onclick="return confirm('Are you sure you want to cancel?');" >
                                                        <button class="btn btn-danger"><i class="fa fa-pencil"></i>Cancel</button>
                                                        </a>
                                                        </div>
                                                            <?php
                                                        }else{ 
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php $cnt=$cnt+1;
                                        }
                                    } ?>
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

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>
