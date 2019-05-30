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
  <form class="" action="<?=isset($submission)?'/submission/edit/'.$submission->id:'/submission/create'?>" method="post">
    <div>
      <input type="text" name="Submission[title]" value="<?=isset($submission)?$submission->title:'';?>" placeholder="Title..." style="width:100%;font-size:30px;">
    </div>
    <br>
    <div>
      <textarea name="Submission[content]" placeholder="Content..." style="width:100%; height:500px;font-size:20px;" rows="15"><?=isset($submission)?$submission->content:'';?></textarea>
    </div>
    <br>
    <div style="display:inline;">
          <button type="submit" name="button" style="width:49%;display:inline;"><?=isset($submission)?'Save':'Create';?></button>
          <button type="button" name="button" onclick="document.location.href ='/submission/index'" style="width:49%;display:inline;">Cancel</button>
    </div>
  </form>
</div>
