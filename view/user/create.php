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
        <input type="text" name="User[firstname]" value="">
        <input type="text" name="User[lastname]" value="">
        <input type="text" name="User[email]" value="">
        <input type="password" name="User[password]" value="">
          <select name="User[role_id]">
            <?php
            foreach ($roles as $role) {
              echo "<option value="$role->id">$role->name</option>";
            }
            ?>
          </select>
        <button type="submit" name="button">Create</button>
        <button type="button" name="button">Cancel</button>
    </form>
  </body>
</html>
