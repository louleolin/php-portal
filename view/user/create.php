
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
        <table class="create" style="width: 300px">
            <tr>
                <td>
                    First Name
                </td>
                <td>
                    <input type="text" name="User[firstname]" value="">
                </td>
            </tr>
            <tr>
                <td>
                    Last Name
                </td>
                <td>
                    <input type="text" name="User[lastname]" value="">
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="text" name="User[email]" value="">
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
                    <select name="User[role_id]">
                        <option value="">--Please-Select--</option>
                        <?php
                        foreach ($roles as $role) {
                            echo "<option value=\"$role->id\">$role->name</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit" name="create">Create</button>
        <button type="button" name="cancel" onclick="document.location.href ='/user/index'">Cancel</button>
    </form>

