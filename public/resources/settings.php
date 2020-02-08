<?php
$dps='';
$link='';
$maction='show';
?>


<div class="row small-spacing">   
  <!-- /.col-xl-6 col-12 -->
  
  <div class="col-xl-6 col-12">
    <div class="box-content card white">
       <h4 class="box-title">Template <?=ucfirst($_GET['other'])?></h4>
      <!-- /.box-title -->
      <div class="card-content">
       
        <?php Template::form_data() ?>
       
      </div>
    </div>
  </div>
</div>
