<div style="width:80%;margin:auto;">
  <table class="view">
    <tbody>
      <?php
        if (isset($users)) {?>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Management</th>
          </tr>
          <?php foreach ($users as $user) {?>
            <tr>
              <td><?=$user->id;?></td>
              <td style="width:30%;"><?=$user->firstname.' '.$user->lastname;?></td>
              <td style="width:30%;"><?=$user->email;?></td>
              <td style="width:30%;"><?=$user->getRole();?></td>
              <td><a href="/user/edit/<?=$user->id;?>">Edit</a></td>
            </tr>
        <?php  }?>
        <tr>
          <td colspan="2"></td>
          <td colspan="3"><button type="button" name="button" onclick="document.location.href ='/user/create'" style="width:50%;margin-left:50%;">Create New User</button></td>
        </tr>
        <?php
      }else {?>
        <button type="button" name="button" onclick="document.location.href ='/user/create'" style="width:80%;margin-left: 10%;">Create New User</button>
      <?php }
       ?>
    </tbody>
  </table>
</div>
