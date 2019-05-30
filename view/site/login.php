<div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
        <div style = "margin:20px">
            <form action = " " method = "post">
                <label>UserName  :</label><input type = "text" name = "LoginForm[username]" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "LoginForm[password]" class = "box" /><br/><br />
                <button type = "submit">Submit</button>
                <br />
            </form>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
        </div>
</div>
