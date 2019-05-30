<div style="width:80%;margin:auto;">
  <table class="view">
    <tbody>
      <?php
        if (isset($submissions)) {?>
          <tr>
            <th>Title</th>
            <th>Create Time</th>
            <?=($_SESSION['login_user_role'] === 'admin')?'<th>Create User</th>':'';?>
            <th>Management</th>
          </tr>
          <?php foreach ($submissions as $submission) {?>
            <tr>
              <td><a href="/submission/view/<?=$submission->id;?>"><?=$submission->title;?></a></td>
              <td><?=$submission->create_time;?></td>
              <?=($_SESSION['login_user_role'] === 'admin')?'<td>'.$submission->getCreateUserName().'</td>':'';?>
              <td> <a href="/submission/delete/<?=$submission->id?>">Delete</a>  <a href="/submission/edit/<?=$submission->id?>">Edit</a></td>
            </tr>
        <?php  } ?>
        <tr>
          <td colspan="2"></td>
          <td colspan="<?=($_SESSION['login_user_role'] === 'admin')?'2':'1';?>"><button type="button" name="button" onclick="document.location.href ='/submission/create'" style="width:60%;margin-left:40%;">Create New Submission</button></td>
        </tr>
      <?php } else {?>
          <button type="button" name="button" onclick="document.location.href ='/submission/create'" style="width:80%;margin-left: 10%;">Create New Submission</button>
      <?php
    }
       ?>
    </tbody>
  </table>
</div>
