<div style="width:80%;margin:auto;">
  <?php
      if (isset($error)) {
        echo "<div class='error'><ul>";
        foreach ($error as $error_info) {
            echo "<li>$error_info</li>";
        }
        echo "</ul></div>";
      }
   ?>
  <form class="" action="<?=isset($user)?'/user/edit/'.$user->id:'/user/create';?>" method="post">
      <table class="create">
          <tr>
              <td>
                  First Name
              </td>
              <td>
                  <input type="text" name="User[firstname]" value="<?=isset($user)?$user->firstname:'';?>">
              </td>
          </tr>
          <tr>
              <td>
                  Last Name
              </td>
              <td>
                  <input type="text" name="User[lastname]" value="<?=isset($user)?$user->lastname:'';?>">
              </td>
          </tr>
          <tr>
              <td>
                  Email
              </td>
              <td>
                  <input type="text" name="User[email]" value="<?=isset($user)?$user->email:'';?>" <?=isset($user)?'readonly':'';?>>
              </td>
          </tr>
          <tr>
              <td>
                  Password
              </td>
              <td>
                  <input type="password" name="User[password]" value="">
              </td>
          </tr>
          <tr>
              <td>
                  Role
              </td>
              <td>
                  <select name="User[role_id]" value=''>
                      <option value="">--Please-Select--</option>
                      <?php
                      foreach ($roles as $role) {
                          $selected = '';
                          if (isset($user)) {
                            if ($user->role_id === $role->id) {
                              $selected = 'selected';
                            }
                          }
                          echo "<option value=\"$role->id\" $selected >$role->name</option>";
                      }
                      ?>
                  </select>
              </td>
          </tr>
          <tr>
            <td>
              <button type="submit" name="create" style="width:70%;"><?=isset($user)?'Save':'Create';?></button>
            </td>
            <td>
              <button type="button" name="cancel" onclick="document.location.href ='/user/index'" style="width:70%;">Cancel</button></td>
          </tr>
      </table>
  </form>
</div>
