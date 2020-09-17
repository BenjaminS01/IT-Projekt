<div class="container">
<h1>Ihre Trainingszeiten für den <?=dateInRightOrder($_GET['trainingDate'])?></h1>
<div class="trainingDay">

  <?php foreach ($this->_params['trainingEntry'] as $value): ?>
  <?php $view =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('id = \''.$value['areaTimeslotId'].'\''); 
        ?>
        
<div class="container">
<h3><?=$view[0]['course'].', '.timeInRightOrder($view[0]['startTime']).'-'.timeInRightOrder($view[0]['endTime'],true)?></h3>
  <table class="table table-bordered">
    <thead >
      <tr>
        <th>Zeitslot</th>
        <th>Bereich</th>
        <th>Zeitraum</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Umkleide vor dem Training</td>
        <td><?= $value['changingRoom']?></td>
        <td><?= timeInRightOrder($value['changingRoomBeforeStartTime']).'-'.timeInRightOrder($value['changingRoomBeforeEndTime'],true)?></td>
      </tr>
      <tr>
        <td>Erwärmung</td>
        <td>Cardiogeräte</td>
        <td><?= timeInRightOrder($value['cardioStartTime']).'-'.timeInRightOrder($value['cardioEndTime'],true)?></td>
      </tr>
      <tr>
        <td><?=$view[0]['course']?></td>
        <td><?=$view[0]['labelling']?></td>
        <td><?= timeInRightOrder($view[0]['startTime']).'-'.timeInRightOrder($view[0]['endTime'],true)?></td>
      </tr>
      <tr>
        <td>Umkleide nach dem Training</td>
        <td><?= $value['changingRoom']?></td>
        <td><?= timeInRightOrder($value['changingRoomAfterStartTime']).'-'.timeInRightOrder($value['changingRoomAfterEndTime'],true)?></td>
      </tr>
    </tbody>
  </table>  
</div>
<div class="trainingDayButtons">
<div class="container">
          <?php if(strtotime(date("Y-m-d")) <= strtotime($_GET['trainingDate'])) : ?>

          <div class="box1">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=chooseTypeOfTraining'; ?>">
              <input type="hidden"  name="id" value="<?= $value['id']?>">
              <input type="hidden"  name="trainingDate" value="<?= $_GET['trainingDate']?>">
              <button type="submit" class="btn btn-warning">Trainingseintrag ändern</button>
            </form>
          </div>

          <?php endif; ?>

          <div class="box">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=deleteEntry'; ?>">
              <input type="hidden"  name="id" value="<?= $value['id']?>">
              <button type="submit" class="btn btn-danger">Trainingseintrag löschen</button>
            </form>
          </div>  
  </div>
  </div>
  <?php endforeach; ?>
  <br>
  <br>
  </div>
  </div>

