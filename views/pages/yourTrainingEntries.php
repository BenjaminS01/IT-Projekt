<h1>Your Training entrys</h1>

<p><?=  $this->_params['test'] ?></p>

<?php foreach ($this->_params['trainingEntry'] as $value): ?>
    <?= '<p>'.$value['trainingDate'].'</p><br>'?>

  <?php endforeach; ?>