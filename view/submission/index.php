
    <table class="view">
      <tbody>
        <?php
          if (isset($submissions)) {?>
            <tr>
              <th>Title</th>
              <th>Content</th>
              <th>Create Time</th>
            </tr>
            <?php foreach ($submissions as $submission) {?>
              <tr>
                <td><a href="/submission/view/<?=$submission->id;?>"><?=$submission->title;?></a></td>
                <td><?=$submission->content;?></td>
                <td><?=$submission->create_time;?></td>
              </tr>
          <?php  }
          }
         ?>
      </tbody>
    </table>
    <a href="/submission/create"><button type="button" name="button">Create New Submission</button></a>
