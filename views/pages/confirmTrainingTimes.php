
<h3>Training</h3>

<table class="thead-dark">
     <tr> <td>Trainingsdatum: </td><td><?= $_POST['trainingDate']?></td></tr>
     <tr> <td>Trainingsbezeichnung: </td><td><?= $_POST['typeOfTraining']?></td></tr>
     <tr><td>Trainingszeit:</td>
     <td><?= $this->_params['viewAreaTimeslot'][0]['startTime'].'-'.$this->_params['viewAreaTimeslot'][0]['endTime']?></td>
     </tr>
     <tr><td>Raum: </td>
     <td><?=$_POST['trainingArea']?></td>
     </tr>
</table>

<h3>Cardio</h3>

<table class="thead-dark">
      <td>Zeit: </td><td><?= $this->_params['cardioStartTime'].'-'.$this->_params['cardioEndTime']?></td>
</table>

<h3>Umkleide</h3>

<table class="thead-dark">
      <td>Raum: </td><td><?= $this->_params['changingRoom'][0]['labelling']?></td>
      <td>Zeit vor dem Training: </td><td><?= $this->_params['changingRoomBeforeStartTime'].'-'.$this->_params['changingRoomBeforeEndTime']?></td>
      <td>Zeit nach dem Training: </td><td><?=$this->_params['test']?></td>

</table>