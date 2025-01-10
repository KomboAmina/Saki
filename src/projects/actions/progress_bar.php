<?php

$rate=(isset($rate)) ? $rate:0;

?>
<div class="progress rounded-0" role="progressbar"
 aria-label="Progress Bar" aria-valuenow="<?php echo $rate;?>" aria-valuemin="0" aria-valuemax="100">
  <div class="progress-bar-striped progress-bar-animated <?php echo $controller->model->getProgressBarColor($rate);?> rounded-0"
   style="width: <?php echo $rate;?>%"></div>
</div>
