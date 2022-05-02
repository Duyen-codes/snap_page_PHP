<?php include 'functions.php';
include 'db.php';
if (isset($_POST["contact"])) {
    //  receiver's email
    $to = 'hongduyen0705@gmail.com';

    // Assigining sanitized user inputS to created variables
    $fullName = sanitizeInputs($_POST["fullname"]);
    $fullName = mysqli_real_escape_string($conn, $_POST['fullname']);

    $email = sanitizeInputs($_POST["email"]);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $subject = sanitizeInputs($_POST["subject"]);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);

    $message = sanitizeInputs($_POST["message"]);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $headers = 'From: ' . $fullName . ', ' . $email . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

    // Sending data using PHP mail function
    // mail($to, $subject, $message, $headers);

    if (isset($fullName) && isset($email) && isset($subject) && isset($message) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        mail($to, $subject, $message, $headers);
        $sent = true;
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="contact_container">
    <? if (isset($sent)) {
        echo '<h3> Thanks for contacting use! We will be in touch with you shortly.</h3>';
    }  ?>
    <h2>Send Us a Message</h2>
    <form class="contact_form" action="contact.php" method="POST">
        <input type="text" name="fullname" placeholder="First and last name"><br>
        <input type="email" name="email" placeholder="Your email"><br>
        <input type="text" name="subject" placeholder="Subject"><br>
        <textarea type="text" name="message" placeholder="Write your message..." rows="5" cols="20"></textarea><br>
        <input name="contact" type="submit" value="Send Message">
    </form>
</div>