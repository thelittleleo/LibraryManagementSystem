<?php
error_reporting( ~E_NOTICE );
session_start();
error_reporting(0);
include('includes/config.php');

$bookname=$_POST['bookname'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$price=$_POST['price'];

$imgFile = $_FILES['bimage']['name'];
$tmp_dir = $_FILES['bimage']['tmp_name'];
$imgSize = $_FILES['bimage']['size'];

echo $imgFile;
echo "<br/>";

echo "temp dir" . $tmp_dir;
echo "<br/>";

echo $imgSize;
echo "<br/>";



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

echo $ebookFile;
echo "<br/>";

echo "temp dir" . $book_dir_tmp;
echo "<br/>";

echo $book_size;
echo "<br/>";
//ebook upload

    $book_dir = 'books/'; // upload directory

    $bookExt = strtolower(pathinfo($ebookFile, PATHINFO_EXTENSION)); // get eBook extension
// valid eBook extensions
    $valid_book_extensions = array('pdf', 'doc', 'docx', 'epub'); // valid extensions

// rename uploading ebook
    $boxerBook = rand(1000, 1000000) . "." . $bookExt;

// allow valid ebook file formats


                move_uploaded_file($book_dir_tmp, $book_dir . $boxerBook);


// if no error occured, continue ....
// if (!isset($error_message)) {
//     $statement = $dbh->prepare('INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice,image,ebook) VALUES(:bookname,:category,:author,:isbn,:price,:bimage,:ebook)');

//     $statement->bindParam(':bookname', $bookname);
//     $statement->bindParam(':category', $category);
//     $statement->bindParam(':author', $author);
//     $statement->bindParam(':isbn', $isbn);
//     $statement->bindParam(':price', $price);
//     $statement->bindParam(':bimage', $boxerPic);
//     $statement->bindParam(':ebook', $boxerBook);
//     if(!$statement->execute())
//     {
//         print_r($statement->errorInfo());
//     }

//     $lastInsertId = $dbh->lastInsertId();
//     if($lastInsertId)
//     {
//         $_SESSION['msg']="Book Listed successfully";
//         header('location:manage-books.php');
//     }
//     else
//     {
//         $_SESSION['error']="Something went wrong. Please try again";
//         header('location:manage-books.php');
//     }
// }
