<?php include './includes/header.php'; ?>
<main>
  <div class="hero-content">
    <h2>Make remote work</h2>
    <p>
      Get your team in sync, no matter your location. Streamline processes,
      create team rituals, and watch productivity soar. Learn more by
      subscribing to our newsletter.
    </p>
    <form action="index.php" method="post">
      <input type="text" placeholder="Email" name="email" />
      <input type="submit" value="Subscribe" name="submit" />
    </form>
    <div class="clients">
      <img src="./images/client-databiz.svg" alt="databiz" />
      <img src="./images/client-audiophile.svg" alt="" />
      <img src="./images/client-meet.svg" alt="meet" />
      <img src="./images/client-maker.svg" alt="" />
    </div>
  </div>
  <div class="hero-visual"></div>
</main>
<?php
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  require_once 'db.php';
  // Create record into snapSubscriber table
  $query = "INSERT INTO snapSubscriber(subscriberEmail)VALUES ('$email')";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die('Subcription failed');
    header("location: index.php");
    exit;
  }
} ?>
<?php include 'includes/footer.php' ?>