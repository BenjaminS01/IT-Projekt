
<h1>Deine Trainingszeiten für den <?=$_GET['trainingDate']?></h1>


  <?php foreach ($this->_params['trainingEntry'] as $value): ?>
  <?php $view =  \Trainingskalender\models\ViewAreaTimeslot
        ::find('id = \''.$value['areaTimeslotId'].'\''); 
        ?>
        
<div class="container">
<h3><?=$view[0]['course'].', '.$view[0]['startTime'].'-'.$view[0]['endTime']?></h3>
  <table class="table">
    <thead class="thead-dark">
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
  <?php endforeach; ?>


