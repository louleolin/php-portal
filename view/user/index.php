<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Users</title>
  </head>
  <body>
    <table>
      <tbody>
        <?php
          if (isset($users)) {?>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
            </tr>
            <?php foreach ($users as $user) {?>
              <tr>
                <td><?=$user->id;?></td>
                <td><?=$user->firstname.' '.$user->lastname;?></td>
                <td><?=$user->email;?></td>
                <td><?=$user->getRole();?></td>
              </tr>
          <?php  }
          }
         ?>
      </tbody>
    </table>
    <a href="/submission/create"><button type="button" name="button">Create New Submission</button></a>
  </body>
</html>
