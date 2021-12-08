<?php

// make sure this function still works if the email isn't in the file
function remove_email($email) {
  // do some stuff
}

function add_email($email) {
  remove_email($email);
  // do some stuff
}

?>


<html>
<head>
  <title>Influence Weekly Reminder Tool</title>
</head>
<body>
  <?php if(isset($_GET["remove_email"])) {
    remove_email($_GET["remove_email"]);
  } else if(isset($_POST["add_email"])) {
    add_email($_POST["add_email"]); // make sure this doesn't add email if it already exists
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
