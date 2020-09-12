<h1>Kursplanung</h1>

<div class="course">
<div class="container">
<h3>Montag</h3>
<table class="table table-bordered">
  <tr>
        <th>Zeitslot</th>
        <th>Bereich</th>
        <th>Zeitraum</th>
      </tr>
  <?php foreach ($this->_params['Montag'] as $value): ?>
  <tr>
    <td ><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td ><?=$value['labelling']?></td>
    <td ><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>
</div>
<div class="container">
<h3>Dienstag</h3>
<table class="table table-bordered ">
<tr>
        <th>Zeitslot</th>
        <th>Bereich</th>
        <th>Zeitraum</th>
</tr>
  <?php foreach ($this->_params['Dienstag'] as $value): ?>
  <tr>
    <td ><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td ><?=$value['labelling']?></td>
    <td ><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>
</table>
</div>

<div class="container">
<h3>Mittwoch</h3>
<table class="table table-bordered">
<tr>
        <th>Zeitslot</th>
        <th>Bereich</th>
        <th>Zeitraum</th>
</tr>
  <?php foreach ($this->_params['Mittwoch'] as $value): ?>
  <tr>
    <td ><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td ><?=$value['labelling']?></td>
    <td ><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>
</table>
</div>
<div class="container">
<h3>Donnerstag</h3>
<table class="table table-bordered">
<tr>
        <th>Zeitslot</th>
        <th>Bereich</th>
        <th>Zeitraum</th>
</tr>
  <?php foreach ($this->_params['Donnerstag'] as $value): ?>
  <tr>
    <td><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td><?=$value['labelling']?></td>
    <td><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>
</div>
<div class="container">
<h3>Freitag</h3>
<table class="table table-bordered">
<tr>
        <th>Zeitslot</th>
        <th>Bereich</th>
        <th>Zeitraum</th>
</tr>
  <?php foreach ($this->_params['Freitag'] as $value): ?>
  <tr>
    <td ><?=$value['startTime'].'-'.$value['endTime']?></td>
    <td ><?=$value['labelling']?></td>
    <td ><?=$value['course']?></td>
  </tr>
  <?php endforeach; ?>

</table>
</div>
</div>