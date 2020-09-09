

<h1>Willkommen zur Trainingsverwaltung</h1>


<br>
<br>

<h3>Kursplanung</h3>




  <h3>Montag</h3>
<table >
  <?php foreach ($this->_params['Montag'] as $value): ?>
  <tr>
    <td ><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td ><?=$value['labelling']?></td>
    <td ><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>

<h3>Dienstag</h3>
<table >
  <?php foreach ($this->_params['Dienstag'] as $value): ?>
  <tr>
    <td ><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td ><?=$value['labelling']?></td>
    <td ><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>


<h3>Mittwoch</h3>
<table >
  <?php foreach ($this->_params['Mittwoch'] as $value): ?>
  <tr>
    <td class="tg-4byr"><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td class="tg-4byr"><?=$value['labelling']?></td>
    <td class="tg-efv9"><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>

<h3>Donnersstag</h3>
<table >
  <?php foreach ($this->_params['Donnerstag'] as $value): ?>
  <tr>
    <td class="tg-4byr"><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td class="tg-4byr"><?=$value['labelling']?></td>
    <td class="tg-efv9"><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>

<h3>Freitag</h3>
<table >
  <?php foreach ($this->_params['Freitag'] as $value): ?>
  <tr>
    <td class="tg-4byr"><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td class="tg-4byr"><?=$value['labelling']?></td>
    <td class="tg-efv9"><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>

