<?php

function remove_email($email) {
  $file_path = "./participants.txt";
  $file = fopen($file_path, "a+");
  $text = file_get_contents($file);
  $text = str_replace($email . "\n","",$text);
  ftruncate($file, 0);
  fwrite($file_path, $text);
  fclose($file);
}

function add_email($email) {
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
    return;
  }
  remove_email($email);
  $file_path = "./participants.txt";
  $file = fopen($file_path, "a+");
  fwrite($file, $email);
  fclose($file);
}

?>


<html>
<head>
  <title>Influence Weekly Reminder Tool</title>
</head>
<body>
  <?php if(isset($_GET["remove_email"])) {
    remove_email($_GET["remove_email"]);
    echo "<h1>Your email $_GET[\"remove_email\"] has been removed from our mailing list.</h1>";
  } else if(isset($_POST["add_email"])) {
    add_email($_POST["add_email"]); // make sure this doesn't add email if it already exists. also make sure it escapes the input properly and only adds valid emails
    echo "<h1>Your email $_POST[\"add_email\"] has been added to our mailing list.</h1>";
  } else {
  ?>
  <h1>Add your email below to receive weekly influence reminders</h1>
  <form method="POST" action="./index.php">
    <input type="text" name="add_email" id="add_email">
    <input type="submit" value="Add">
  </form>
  <?php } ?>
</body>
</html>
