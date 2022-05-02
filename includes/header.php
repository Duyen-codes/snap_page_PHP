<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Snap PHP</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
  <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
</head>

<body>
  <header>
    <nav>
      <a href="index.php">
        <img src="./images/logo.svg" alt="snap logo" />
      </a>
      <button class="mobile-nav-toggle" aria-expanded="false"></button>
      <div class="primary-navigation" data-visible="false">
        <ul>
          <li><a href="photodata.php">Photo data</a></li>
          <li><a href="markdown.php">Markdown generator</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul class="cta">
          <?php
          // Check if user login or not 
          ?>
          <?php
          if (isset($_SESSION["user_Uid"])) {
            // check if user is logged in
            echo "<a href='account.php'>Profile page</a>";
            echo "<a href='logout.php'>Log out</a>";
          } else {
            // if user is not logged in
            echo "<a href='signup.php'>Sign up</a>";
            echo "<a href='login.php'>Log in</a>";
          }
          ?>
        </ul>
      </div>
    </nav>
  </header>