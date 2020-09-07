
<h3>Training</h3>

<table class="thead-dark">
     <tr> <td>Trainingsdatum: </td><td><?= $_POST['trainingDate']?></td></tr>
     <tr> <td>Trainingsbezeichnung: </td><td><?= $this->_params['viewAreaTimeslot'][0]['course']?></td></tr>
     <tr><td>Trainingszeit:</td>
     <td><?= $this->_params['viewAreaTimeslot'][0]['startTime'].'-'.$this->_params['viewAreaTimeslot'][0]['endTime']?></td>
     </tr>
     <tr><td>Raum: </td>
     <td><?=$this->_params['trainingArea']?></td>
     </tr>
</table>

<h3>Cardio  <?=var_dump($this->_params['test'])?></h3>

<table class="thead-dark">
      <td>Zeit: </td><td><?= $this->_params['cardioStartTime'].'-'.$this->_params['cardioEndTime']?></td>
</table>

<h3>Umkleide</h3>

<table class="thead-dark">
      <td>Raum: </td><td><?= $this->_params['changingRoom'][0]['labelling']?></td>
      <td>Zeit vor dem Training: </td><td><?= $this->_params['changingRoomBeforeStartTime'].'-'.$this->_params['changingRoomBeforeEndTime']?></td>
      <td>Zeit nach dem Training: </td><td><?= $this->_params['changingRoomAfterStartTime'].'-'.$this->_params['changingRoomAfterEndTime']?></td>


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

  <button type="submit" name="submitTrainingEntry" >Eintrag bestätigen</button>
</form>