<?php

function remove_email($email) {
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
    return false;
  }
  $file_path = "./participants.txt";
  $text = file_get_contents($file_path);
  $text = str_replace($email . "\n","",$text);
  $file = fopen($file_path, "w");
  fwrite($file, $text);
  fclose($file);
  return true;
}

function add_email($email) {
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
    return false;
  }
  remove_email($email);
  $file_path = "./participants.txt";
  $file = fopen($file_path, "a+");
  fwrite($file, $email . "\n");
  fclose($file);
  return true;
}

?>


<html>
<head>
  <title>Influence Weekly Reminder Tool</title>
</head>
<body>
  <?php
  if(isset($_GET["remove_email"])) {
    $email = $_GET["remove_email"];
    if(remove_email($email)) {
      echo "<h1>Your email $email has been removed from our mailing list.</h1>";
    } else {
      echo "<h1>Your email $email failed to be removed from our mailing list.</h1>";
    }
  }

  else if(isset($_POST["add_email"])) {
    $email = $_POST["add_email"];
    if(add_email($email)) {
        echo "<h1>Your email $email has been added to our mailing list.</h1>";
    } else {
        echo "<h1>Your email $email failed to be added to our mailing list.</h1>";
    }; // make sure this doesn't add email if it already exists. also make sure it escapes the input properly and only adds valid emails
  }

  else {
  ?>
  <h1>Add your email below to receive weekly influence reminders</h1>
  <form method="POST" action="./index.php">
    <input type="text" size=40 name="add_email" id="add_email">
    <input type="submit" value="Add">
  </form>
  <?php } ?>
</body>
</html>
