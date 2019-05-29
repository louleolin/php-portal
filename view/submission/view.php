<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Submissions</title>
  </head>
  <body>
    <table>
      <tbody>
        <?php
          if (isset($submission)) {?>
            <tr>
              <th>Title</th>
              <th>Content</th>
              <th>Create Time</th>
            </tr>
              <tr>
                <td><a href="submission/view/<?=$submission->id;?>"><?=$submission->title;?></a></td>
                <td><?=$submission->content;?></td>
                <td><?=$submission->create_time;?></td>
              </tr>
          <?php  }?>
      </tbody>
    </table>
  </body>
</html>
