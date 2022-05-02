<?php include 'includes/header.php' ?>
<?php
$msg = "";
$imageFileType = '';
// Check if user has clicked upload button
if (isset($_POST['uploadfile'])) {
    $filename = $_FILES['choosefile']['name'];
    $tempname = $_FILES["choosefile"]["tmp_name"];
    $target_dir = "uploads/" . $filename;
    // connect with the database
    // create database connection
    require_once 'db.php';
    //Query to insert the submitted data
    $query = "INSERT INTO image (filename) values ('$filename')";
    // function to execute the above query
    $result = mysqli_query($conn, $query);
    // Add the image to the 'image folder'
    if (move_uploaded_file($tempname, $target_dir)) {
        $msg = "The file " . htmlspecialchars(basename($_FILES["choosefile"]["name"])) . " has been uploaded." . "<br/>";
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    } else {
        $msg = "Failed to upload image";
    }
    // Display image 
    $image = $_FILES['choosefile']['name'];
    $img = "uploads/" . $image;
    echo '<img src="' . $img . '">';
}

?>
<h2>Online EXIF data viewer</h2>
<p>Uncover hidden metadata from your photos.</p>
<p>Click to upload.</p>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="choosefile" value="" />
    <div>
        <input type="submit" name="uploadfile" value="UPLOAD">
        </input>
    </div>
    <?php echo $msg ?>
</form>