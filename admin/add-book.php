<?php
error_reporting( ~E_NOTICE );
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}
else {

    if (isset($_POST['btnsave'])) {

        $bookname=$_POST['bookname'];
        $category=$_POST['category'];
        $author=$_POST['author'];
        $isbn=$_POST['isbn'];
        $price=$_POST['price'];

        
        $imgFile = $_FILES['bimage']['name'];
        $tmp_dir = $_FILES['bimage']['tmp_name'];
        $imgSize = $_FILES['bimage']['size'];

        if (empty($imgFile)) {
            $error_message = "Please select image file.";
        } else {
            $upload_dir = 'images/'; // upload directory

            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

// valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
            $boxerPic = rand(1000, 1000000) . "." . $imgExt;

// allow valid image file formats
            if (in_array($imgExt, $valid_extensions)) {
// Check file size '5MB'
                if ($imgSize < 5000000) {
                    move_uploaded_file($tmp_dir, $upload_dir . $boxerPic);
                } else {
                    $error_message = "Sorry, your file is too large.";
                }
            } else {
                $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        }

        $ebookFile = $_FILES['ebook']['name'];
        $book_dir_tmp = $_FILES['ebook']['tmp_name'];
        $book_size = $_FILES['ebook']['size'];



        //ebook upload
        if (empty($ebookFile)) {
            $error_message = "Please select ebook file.";
        } else {
            $book_dir = 'books/'; // upload directory

            $bookExt = strtolower(pathinfo($ebookFile, PATHINFO_EXTENSION)); // get eBook extension
            echo $bookExt;
// valid eBook extensions
            $valid_book_extensions = array('pdf', 'doc', 'docx', 'epub'); // valid extensions

// rename uploading ebook
            $boxerBook = rand(1000, 1000000) . "." . $bookExt;

// allow valid ebook file formats
            if (in_array($bookExt, $valid_book_extensions)) {
// Check file size '5MB'
                if ($book_size < 5000000000) {
                    try{
                        move_uploaded_file($book_dir_tmp, $book_dir . $boxerBook);
                    }
                    catch(Exception $e) {
                        echo 'Message: ' .$e->getMessage();
                      }
                } else {
                    $error_message = "Sorry, your file is too large.";
                }
            } else {
                $error_message = "Sorry, only PDF, DOC, EPUB files are allowed.";
            }
        }
// if no error occured, continue ....
        if (!isset($error_message)) {
            $statement = $dbh->prepare('INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice,image,ebook) VALUES(:bookname,:category,:author,:isbn,:price,:bimage,:ebook)');

            $statement->bindParam(':bookname', $bookname);
            $statement->bindParam(':category', $category);
            $statement->bindParam(':author', $author);
            $statement->bindParam(':isbn', $isbn);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':bimage', $boxerPic);
            $statement->bindParam(':ebook', $boxerBook);
            if(!$statement->execute())
            {
                print_r($statement->errorInfo());
            }

            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $_SESSION['msg']="Book Listed successfully";
                header('location:manage-books.php');
            }
            else
            {
                $_SESSION['error']="Something went wrong. Please try again";
                header('location:manage-books.php');
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Add Book</title>
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
                <h4 class="header-line">Add Book</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Book Info
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label>Book Name<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="bookname" autocomplete="off"  required />
                        </div>

                        <div class="form-group">
                            <label> Category<span style="color:red;">*</span></label>
                            <select class="form-control" name="category" required="required">
                                <option value=""> Select Category</option>
                                <?php
                                $status=1;
                                $sql = "SELECT * from  tblcategory where Status=:status";
                                $query = $dbh -> prepare($sql);
                                $query -> bindParam(':status',$status, PDO::PARAM_STR);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    {               ?>
                                        <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
                                    <?php }} ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label> Author<span style="color:red;">*</span></label>
                            <select class="form-control" name="author" required="required">
                                <option value=""> Select Author</option>
                                <?php

                                $sql = "SELECT * from  tblauthors ";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query->rowCount() > 0)
                                {
                                    foreach($results as $result)
                                    {               ?>
                                        <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
                                    <?php }} ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ISBN Number<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="isbn"  required="required" autocomplete="off"  />
                            <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                        </div>

                        <div class="form-group">
                            <label>Price<span style="color:red;">*</span></label>
                            <input class="form-control" type="text" name="price" autocomplete="off"   required="required" />
                        </div>
                        <label>Image</label>                      
                        <input class="input-group" type="file" name="bimage" accept="image/*" />
                        <label>e-Book(PDF)</label>  
                        <input class="input-group" type="file" name="ebook" accept="*" />
                        <button type="submit" name="btnsave" class="btn btn-success">Add</button>

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
