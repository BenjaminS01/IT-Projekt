<div class="container">
<h1>Deine Trainingszeiten für den <?=$_GET['trainingDate']?></h1>
<div class="trainingDay">

  <?php foreach ($this->_params['trainingEntry'] as $value): ?>
  <?php $view =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('id = \''.$value['areaTimeslotId'].'\''); 
        ?>
        
<div class="container">
<h3><?=$view[0]['course'].', '.$view[0]['startTime'].'-'.$view[0]['endTime']?></h3>
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
        <td><?= $value['changingRoomBeforeStartTime'].'-'.$value['changingRoomBeforeEndTime']?></td>
      </tr>
      <tr>
        <td>Erwärmung</td>
        <td>Cardiogeräte</td>
        <td><?= $value['cardioStartTime'].'-'.$value['cardioEndTime']?></td>
      </tr>
      <tr>
        <td><?=$view[0]['course']?></td>
        <td><?=$view[0]['labelling']?></td>
        <td><?= $view[0]['startTime'].'-'.$view[0]['endTime']?></td>
      </tr>
      <tr>
        <td>Umkleide nach dem Training</td>
        <td><?= $value['changingRoom']?></td>
        <td><?= $value['changingRoomAfterStartTime'].'-'.$value['changingRoomAfterEndTime']?></td>
      </tr>
    </tbody>
  </table>  
</div>
<div class="container">
          <div class="box1">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=chooseTypeOfTraining'; ?>">
              <input type="hidden"  name="id" value="<?= $value['id']?>">
              <input type="hidden"  name="trainingDate" value="<?= $_GET['trainingDate']?>">
              <button type="submit" class="btn btn-warning">Trainingseintrag ändern</button>
            </form>
          </div>
                     
          <div class="box">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=deleteEntry'; ?>">
              <input type="hidden"  name="id" value="<?= $value['id']?>">
              <button type="submit" class="btn btn-danger">Trainingseintrag löschen</button>
            </form>
          </div>  
  </div>
  <?php endforeach; ?>
  </div>
  </div>

