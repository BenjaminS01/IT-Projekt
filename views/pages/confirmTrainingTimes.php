<div class="container">
<br>
<h3>Für Ihr Training am <?= dateInRightOrder($_POST['trainingDate'])?> haben wir folgende Trainingsplanung erstellt</h3>
<br>

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
        <td><?= $this->_params['changingRoom'][0]['labelling']?></td>
        <td><?= timeInRightOrder($this->_params['changingRoomBeforeStartTime']).'-'.timeInRightOrder($this->_params['changingRoomBeforeEndTime'],true)?></td>
      </tr>
      <tr>
        <td>Erwärmung</td>
        <td>Cardiogeräte</td>
        <td><?= timeInRightOrder($this->_params['cardioStartTime']).'-'.timeInRightOrder($this->_params['cardioEndTime'],true)?></td>
      </tr>
      <tr>
        <td><?=$this->_params['viewAreaTimeslot'][0]['course']?></td>
        <td><?=$this->_params['trainingArea']?></td>
        <td><?= timeInRightOrder($this->_params['viewAreaTimeslot'][0]['startTime']).'-'.timeInRightOrder($this->_params['viewAreaTimeslot'][0]['endTime'],true)?></td>
      </tr>
      <tr>
        <td>Umkleide nach dem Training</td>
        <td><?= $this->_params['changingRoom'][0]['labelling']?></td>
        <td><?= timeInRightOrder($this->_params['changingRoomAfterStartTime']).'-'.timeInRightOrder($this->_params['changingRoomAfterEndTime'],true)?></td>
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

      <div class="box1">
  <button type="submit" name="submitTrainingEntry" class="btn btn-success" >Eintrag bestätigen</button>
  </div>
  </form>
          <div class="box">
            <form method="get">
            <input type="hidden"  name="c" value="pages">
        <input type="hidden"  name="a" value="kalender">
        <button type="submit"   class="btn btn-info">zurück zum Kalender</button>
            </form>
      </div>  


  <br>
  <br>

</div>