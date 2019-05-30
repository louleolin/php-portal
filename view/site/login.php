<div style = "margin:auto;min-height:300px;min-width:400px;height: 30%; width: 30%;border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
        <div style = "width:80%;height:80%; min-height:240px;margin:auto;">
            <form action = " " method = "post" style="width:100%;height:200px;margin:10% auto;">
                <table style="width:100%;height:70%;margin:auto;">
                  <tr>
                    <td>Email:</td>
                    <td><input type = "text" style="width:100%" name = "LoginForm[email]"/></td>
                  </tr>
                  <tr>
                    <td>Password:</td>
                    <td><input type = "password" style="width:100%" name = "LoginForm[password]"/></td>
                  </tr>
                  <tr>
                    <td colspan="2"><button type = "submit" style="width:100%">Sign In</button></td>
                  </tr>
                </table>
              <div style = " margin:10px 5px; font-size:17px; text-align:center;" class="error"><?php echo $error; ?></div>
            </form>
        </div>
</div>
