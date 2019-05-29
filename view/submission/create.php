<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Submissions - Create</title>
  </head>
  <body>
    <?php
        if (isset($error)) {
          echo "<div class='error'><ul>";
          foreach ($error as $error_info) {
              echo "<li>$error_info</li>";
          }
          echo "</ul></div>";
        }
     ?>
    <form class="" action="create" method="post">
        <input type="text" name="Submission[title]" value="">
        <input type="textfield" name="Submission[content]" value="">
        <button type="submit" name="button">Create</button>
        <button type="button" name="button">Cancel</button>
    </form>
  </body>
</html>
