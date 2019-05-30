
<?php
if (isset($submission)) {?>
    <div style="width:70%;margin:auto;">
        <h1><?=$submission->title;?></h1>
          <br>
              <p><?=$submission->content;?></p>
            </div>
          <?php  }?>
