<div class="container">
<br>
<h3>Für Ihr Training am <?= $_POST['trainingDate']?> haben wir folgende Trainingsplanung erstellt</h3>
<br>

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
        <td><?= $this->_params['changingRoom'][0]['labelling']?></td>
        <td><?= $this->_params['changingRoomBeforeStartTime'].'-'.$this->_params['changingRoomBeforeEndTime']?></td>
      </tr>
      <tr>
        <td>Erwärmung</td>
        <td>Cardiogeräte</td>
        <td><?= $this->_params['cardioStartTime'].'-'.$this->_params['cardioEndTime']?></td>
      </tr>
      <tr>
        <td><?=$this->_params['viewAreaTimeslot'][0]['course']?></td>
        <td><?=$this->_params['trainingArea']?></td>
        <td><?= $this->_params['viewAreaTimeslot'][0]['startTime'].'-'.$this->_params['viewAreaTimeslot'][0]['endTime']?></td>
      </tr>
      <tr>
        <td>Umkleide nach dem Training</td>
        <td><?= $this->_params['changingRoom'][0]['labelling']?></td>
        <td><?= $this->_params['changingRoomAfterStartTime'].'-'.$this->_params['changingRoomAfterEndTime']?></td>
      </tr>
    </tbody>
  </table>  

<form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=start'; ?>">
<input type="hidden" id="trainingDate2" name="trainingDate" value="<?= $_POST['trainingDate']?>">
      <input type="hidden" id="trainingType2" name="trainingDate" value="<?= $this->_params['trainingDate']?>">
      <input type="hidden" id="trainingType2" name="typeOfTraining" value="<?= $_POST['typeOfTraining']?>">
      <input type="hidden" id="trainingType2" name="changingRoom" value="<?= $this->_params['changingRoom'][0]['labelling']?>">
      <input type="hidden" id="trainingType2" name="changingRoomBeforeStartTime" value="<?= $this->_params['changingRoomBeforeStartTime']?>">
      <input type="hidden" id="trainingType2" name="changingRoomBeforeEndTime" value="<?= $this->_params['changingRoomBeforeEndTime']?>">
      <input type="hidden" id="trainingType2" name="changingRoomAfterStartTime" value="<?= $this->_params['changingRoomAfterStartTime']?>">
      <input type="hidden" id="trainingType2" name="changingRoomAfterEndTime" value="<?= $this->_params['changingRoomAfterEndTime']?>">
      <input type="hidden" id="trainingType2" name="cardioStartTime" value="<?= $this->_params['cardioStartTime']?>">
      <input type="hidden" id="trainingType2" name="cardioEndTime" value="<?= $this->_params['cardioEndTime']?>">
      <input type="hidden" id="trainingType2" name="memberId" value="<?= $this->_params['memberId']?>">
      <input type="hidden" id="trainingType2" name="areaTimeslotId" value="<?= $this->_params['viewAreaTimeslot'][0]['id']?>">   

  <button type="submit" name="submitTrainingEntry" class="btn btn-primary" >Eintrag bestätigen</button>
</form>
</div>