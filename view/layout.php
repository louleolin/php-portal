<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$title;?></title>
    <link rel="stylesheet" type="text/css" href="/assets/portal.css">
</head>
<body>
    <?php
        if (isset($user_role)){?>
            <div class="sidenav">
                <a href="/submission/index">Submissions</a>
                <?=($user_role == 'admin')? '<a href="/user/index">Users</a>':'';?>
                <a href="/site/logout">Logout</a>
            </div>

            <div class="content">
                <div style="margin:100px auto">
                    <?=$content;?>
                </div>
            </div>

    <?php
        }else{?>
            <div style="margin:300px auto;">
                <?=$content;?>
            </div>
    <?php
        }
    ?>
</body>
</html>
