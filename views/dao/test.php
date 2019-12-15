<?php

/* @var $this \yii\View */

?>

<div class="row">
    <?php if($this->beginCache('view1',['duration'=>30])):?>
  <div class="col-md-6">
      <pre>
          <?=print_r($users);?>
      </pre>
  </div>
    <?php $this->endCache(); endif;?>
  <div class="col-md-6">
      <pre>
          <?=print_r($activityUser);?>
      </pre>

  </div>
  <div class="col-md-6">
      <pre>
        <?=print_r($activity);?>
      </pre>

  </div>
  <div class="col-md-6">
      <pre>
        В базе <?=$count;?> записей активности.
      </pre>
  </div>
  <div class="col-md-6">
      <pre>
        <?php
        foreach ($reader as $item){
          print_r($item);
        }
        ?>
      </pre>
  </div>
</div>
