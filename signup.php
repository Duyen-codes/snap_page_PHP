<?php include 'includes/header.php' ?>
<section class="signup_section">
    <h2>Please sign up</h2>
    <form action="signup.php" method="post" class="signup_form">
        <div><input type="text" name="firstname" placeholder="First name..."></div>
        <div><input type="text" name="lastname" placeholder="Last name..."></div>
        <div><input type="text" name="email" placeholder="Email..."></div>
        <div>
            <input type="text" name="uid" placeholder="User name...">
        </div>
        <div><input type="text" name="pwd" placeholder="Password..."></div>
        <div><input type="text" name="pwdrepeat" placeholder="Repeat your password..."></div>
        <input type="submit" name="submit" value="Sign up">
    </form>
</section>
<?php
if (isset($_POST['submit'])) {
    $fName = $_POST['firstname'];
    $lName = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];
    // create database connection
    require_once 'db.php';
    // Sanitize user and password
    $fName = mysqli_escape_string($conn, $fName);
    $lName = mysqli_escape_string($conn, $lName);
    $username = mysqli_escape_string($conn, $username);
    $pwd = mysqli_escape_string($conn, $pwd);
    // Password encryption
    $hashFormat = "$2y$10$";
    $salt = "whateversalaldjalajejkgljalkdjakfjieetyisokay$";
    $hashFormatAndSalt = $hashFormat . $salt;
    $hashedpwd = crypt($pwd, $hashFormatAndSalt);

    // Create the record inside database
    $query = "INSERT INTO snapUser(fName, lName, userEmail, userUid, userPwd) VALUES ('$fName', '$lName', '$email', '$username', '$hashedpwd')";
    $result = mysqli_query($conn, $query);
    echo "<p>Signed up successfully!</p>";
    if (!$result) {
        die('Query insertion failed');
        header("location: signup.php");
        exit();
    }
}
?>
<?php include 'includes/footer.php' ?>