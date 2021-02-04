<?php

use yii\helpers\Url;


?>


<div class="post-preview">
    <a href="<?=Url::toRoute(['/company/view','id'=>$model->id])?>">
        <h2 class="post-title">
            <?=$model->name?>
        </h2>
    </a>
  <p style="font-size: medium">
      Address :  <?=$model->address?> <br>
      Phone :  <?=$model->phone?> <br>
  </p>
    <a href="<?=Url::toRoute(['/company/view','id'=>$model->id])?>">Tap to click more info</a>
    <p class="post-meta">Created by
        <strong><?=$model->createdBy->username?></strong>
        on <?=$model->created_at?></p>
</div>
<hr>
