<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: account.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    include 'db.php';

    // SQL statement requesting data from 'snapUser' table
    $query = "SELECT * FROM snapUser where userUid='$username'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Login failed');
        exit();
    }

    // Assign data returned to $row variable 
    $row = mysqli_fetch_assoc($result);

    // compare hashed password from 'snapUser' table with $pwd user enter to form using password_verify
    $pwdHashed = $row['userPwd'];
    $checkPwd = password_verify($pwd, $row['userPwd']);
    if ($checkPwd == true) {

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["user_Uid"] = $row['userUid'];
        header("location: account.php");
        exit;
    }
}
?>

<?php include './includes/header.php' ?>
<section>
    <h2>Please login</h2>
    <form method="post" action="login.php" class="login_form">
        <div>
            <input type="text" name="uid" placeholder="Username">
        </div>
        <div>
            <input type="text" name="pwd" placeholder="Password...">
        </div>
        <input type="submit" value="LOG IN" name="submit">
    </form>
</section>
<?php include 'includes/footer.php' ?>